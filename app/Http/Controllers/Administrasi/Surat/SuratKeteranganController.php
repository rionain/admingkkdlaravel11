<?php

namespace App\Http\Controllers\Administrasi\Surat;

use App\Http\Controllers\Controller;
use App\Models\MasterSurat;
use App\Models\RequestSurat;
use App\Models\StatusSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use S3Helper;

class SuratKeteranganController extends Controller
{
    public function surat_keterangan()
    {
        $request_surat = RequestSurat::where(['lfk_jenis_surat' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $status_surat  = StatusSurat::where(['active' => 1, 'deleted' => '0'])->get();
        $master_surat  = MasterSurat::where(['jenis_surat_id' => 1, 'active' => 1, 'deleted' => '0'])->get();
        $data = [
            'title'             => 'Surat Keterangan',
            'menu_aktif'        => 'surat_keterangan',
            'request_surat'     => $request_surat,
            'status_surat'      => $status_surat,
            'master_surat'      => $master_surat,
        ];

        return view('surat.surat-keterangan', $data);
    }
    public function lihat_surat($surat_id)
    {
        $request_surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'             => 'Surat Keterangan',
            'menu_aktif'        => 'surat_keterangan',
            'request_surat'     => $request_surat,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('surat.surat-lihat', $data);
    }

    public function ubah_status($surat_id)
    {
        if (request('statusSurat') == 5) {
            $validation = [
                'statusSurat'   => 'required',
                'alasan'        => 'required',
            ];
        } else {
            $validation = [
                'statusSurat'   => 'required',
            ];
        }
        $value = (object) request()->validate($validation);

        $surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();

        $surat->lfk_status_surat_id     = $value->statusSurat;
        if ($value->statusSurat == 5) {
            $surat->demote_reason     = $value->alasan;
        }
        if ($value->statusSurat == 6) {
            $surat->no_surat = 'S-GKKD/022/IV/2021';
        }


        $cek = $surat->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah status');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah status');
    }

    public function ubah_master_surat($surat_id)
    {
        $validation = [
            'master_surat'   => 'required',
        ];

        $value = (object) request()->validate($validation);

        $surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();
        if ($surat->lfk_status_surat_id == 1) {
            $surat->lfk_status_surat_id = 2;
        }
        $surat->lfk_template_master     = $value->master_surat;

        $cek = $surat->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah template surat');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah template surat');
    }

    public function pdf($surat_id)
    {
        $request_surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();

        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }


        $data = [
            'title'             => 'Surat Keterangan',
            'menu_aktif'        => 'surat_keterangan',
            'request_surat'     => $request_surat,
        ];


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('surat.surat-export-pdf', $data);
        return $pdf->stream();
        return view('surat.surat-export-pdf', $data);
    }














































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_surat_keterangan_all()
    {
        $surat_keterangan = RequestSurat::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $surat_keterangan,
        ]);
    }
    public function api_surat_keterangan_detail($surat_id)
    {
        $surat_keterangan = RequestSurat::where('surat_id', $surat_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$surat_keterangan) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $surat_keterangan,
                'jumlah_approval' => count(@$surat_keterangan->master_surat->detail_ttd ?: []),
            ]);
        }
    }
}
