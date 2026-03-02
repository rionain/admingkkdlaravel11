<?php

namespace App\Providers;

use Aws\S3\S3Client;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter as S3Adapter;
use League\Flysystem\AwsS3V3\PortableVisibilityConverter as AwsS3PortableVisibilityConverter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Visibility;
use League\MimeTypeDetection\ExtensionMimeTypeDetector;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Register a safe S3 driver that uses ExtensionMimeTypeDetector
        // instead of FinfoMimeTypeDetector (which requires the fileinfo PHP
        // extension — not always available on shared cPanel hosting).
        Storage::extend('s3-safe', function ($app, $config) {
            $s3Config = $config + ['version' => 'latest'];

            if (! empty($s3Config['key']) && ! empty($s3Config['secret'])) {
                $s3Config['credentials'] = Arr::only($s3Config, ['key', 'secret']);

                if (! empty($s3Config['token'])) {
                    $s3Config['credentials']['token'] = $s3Config['token'];
                }
            }

            $s3Config = Arr::except($s3Config, ['token']);

            $root       = (string) ($s3Config['root'] ?? '');
            $visibility = new AwsS3PortableVisibilityConverter(
                $config['visibility'] ?? Visibility::PUBLIC
            );
            $streamReads = $s3Config['stream_reads'] ?? false;

            $client  = new S3Client($s3Config);
            $adapter = new S3Adapter(
                $client,
                $s3Config['bucket'],
                $root,
                $visibility,
                new ExtensionMimeTypeDetector(), // ← no finfo needed
                $config['options'] ?? [],
                $streamReads
            );

            return new FilesystemAdapter(
                new Flysystem($adapter, Arr::only($config, [
                    'directory_visibility',
                    'disable_asserts',
                    'retain_visibility',
                    'temporary_url',
                    'url',
                    'visibility',
                ])),
                $adapter,
                $s3Config,
                $client
            );
        });
    }
}
