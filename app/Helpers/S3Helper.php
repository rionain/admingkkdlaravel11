<?php

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\File;

function s3()
{
    return new S3Client([
        'version' => 'latest',
        'region'  => env('AWS_DEFAULT_REGION'),
        'endpoint' => env('AWS_ENDPOINT'),
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key'    => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
        ],
    ]);
}

class S3Helper
{
    public static function get($file)
    {
        $file = trim($file, '/');
        // dd(env('AWS_URL') . env('AWS_BUCKET') . '/' . $file);
        return env('AWS_URL') . env('AWS_BUCKET') . '/' . $file;
        // try {

        //     $retrive = s3()->getObject([
        //         'Bucket' => env('AWS_BUCKET'),
        //         'Key'    => $file,
        //         // 'SaveAs' => 'testkey_local'
        //     ]);

        //     return $retrive;
        // } catch (S3Exception $e) {
        //     return false;
        // }
    }

    public static function getAll()
    {
        try {
            $objects = s3()->listObjects([
                'Bucket' => env('AWS_BUCKET'),
            ]);
            foreach ($objects['Contents']  as $object) {
                echo $object['Key'] . PHP_EOL;

                echo "<pre>";
                print_r($object['Key'] . PHP_EOL);
                echo "</pre>";
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    public static function save($file_name, $file)
    {
        try {
            $retrive = s3()->putObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key'    => $file_name,
                'SourceFile' => $file,
            ]);

            return $retrive;
        } catch (S3Exception $e) {
            return false;
        }
    }

    public static function saveAs($file, $save_directory)
    {
        if (!$file) {
            return false;
        }
        $file = trim($file, '/');
        if (!file_exists(public_path("storage" . dirname($save_directory)))) {
            mkdir(public_path("storage" . dirname($save_directory)), 0777, true);
        }

        try {
            $retrive = s3()->getObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key'    => $file,
                'SaveAs' => public_path("storage" . $save_directory),
            ]);

            return $retrive;
        } catch (S3Exception $e) {
            return false;
        }
    }

    public static function delete($file)
    {
        if ($file == '') {
            return false;
        }

        $cek = S3Helper::get($file);
        if ($cek == false) {
            return false;
        }

        try {
            $result = s3()->deleteObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key'    => $file,
            ]);

            return true;
        } catch (S3Exception $e) {
            return false;
        }
    }
}
