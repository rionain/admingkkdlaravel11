<?php

namespace App\Http\Controllers\Administrasi\Sertifikat\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSertifikatPernikahan as ModelsPengaturanSertifikatPernikahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use S3Helper;
use Illuminate\Support\Str;

class PengaturanSertifikatPernikahan extends Controller
{
    public function list()
    {
        $sertifikat = ModelsPengaturanSertifikatPernikahan::firstOrCreate([
            'pengaturan_sertifikat_pernikahan_id' => 1,
        ]);

        $data = [
            'title'             => 'Pengaturan Sertifikat Pernikahan',
            'menu_aktif'        => 'pengaturan_sertifikat_pernikahan',
            'sertifikat'        => $sertifikat,
        ];
        return view('administrasi.sertifikat.pengaturan.pengaturan-sertifikat-pernikahan', $data);
    }
    public function edit()
    {
        $value = (object) request()->validate([
            'logo_header' => 'nullable|image|mimes:jpeg,png,jpg',
            'header_html' => 'required|string',
            'foto_kanan' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        $sertifikat = ModelsPengaturanSertifikatPernikahan::first();
        if (request()->hasFile('logo_header')) {
            $file = request()->file('logo_header');
            $filename = '/sertifikat/pengaturan_sertifikat/logo_header-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $sertifikat->logo_header = $filename;
        }
        if (request()->hasFile('foto_kanan')) {
            $file = request()->file('foto_kanan');
            $filename = '/sertifikat/pengaturan_sertifikat/foto_kanan-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $sertifikat->foto_kanan = $filename;
        }

        $sertifikat->header_html = $value->header_html;

        $cek = $sertifikat->save();
        if ($cek) {
            return redirect()->back()->with('berhasil', 'Berhasil mengubah pengaturan sertifikat pernikahan');
        } else {
            return redirect()->back()->with('gagal', 'Gagal mengubah pengaturan sertifikat pernikahan');
        }
    }

    public function print_view()
    {
        $sertifikat = ModelsPengaturanSertifikatPernikahan::firstOrCreate([
            'pengaturan_sertifikat_pernikahan_id' => 1,
        ]);
        // return asset('storage' . $sertifikat->logo_header);

        @S3Helper::saveAs($sertifikat->logo_header, $sertifikat->logo_header);
        @S3Helper::saveAs($sertifikat->foto_kanan, $sertifikat->foto_kanan);

        // dd($sertifikat);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('administrasi.sertifikat.pengaturan.lihat-sertifikat-pernikahan', ['sertifikat' => $sertifikat])->setPaper('a4', 'landscape');
        return $pdf->stream();
        return view('administrasi.sertifikat.pengaturan.lihat-sertifikat-pernikahan', ['sertifikat' => $sertifikat]);
    }
}
