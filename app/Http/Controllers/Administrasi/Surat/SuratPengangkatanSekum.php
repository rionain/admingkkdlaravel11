<?php

namespace App\Http\Controllers\Administrasi\Surat;

use App\Http\Controllers\Controller;
use App\Models\MasterSurat;
use App\Models\RequestSurat;
use Illuminate\Http\Request;

class SuratPengangkatanSekum extends Controller
{
    public function surat_pengangkatan_sekum()
    {
        $request_surat = RequestSurat::where(['lfk_jenis_surat' => 6, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        // $status_surat  = StatusSurat::where(['active' => 1, 'deleted' => '0'])->get();
        $master_surat  = MasterSurat::where(['jenis_surat_id' => 2, 'active' => 1, 'deleted' => '0'])->get();
        $data = [
            'title'             => 'Surat Penunjukan',
            'menu_aktif'        => 'surat_pengangkatan_sekum',
            'request_surat'     => $request_surat,
            // 'status_surat'      => $status_surat,
            'master_surat'      => $master_surat,
        ];

        return view('surat.surat-pengangkatan-sekum', $data);
    }
    public function lihat()
    {
        // $request_surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();
        // if (!$request_surat) {
        //     return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        // }

        $data = [
            'title'             => 'Surat Keterangan',
            'menu_aktif'        => 'surat_keterangan',
            // 'request_surat'     => $request_surat,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('surat.surat-lihat-pengangkatan-sekum', $data);
    }
}
