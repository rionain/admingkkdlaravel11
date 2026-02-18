<?php

namespace App\Http\Controllers\Administrasi\Surat;

use App\Http\Controllers\Controller;
use App\Models\MasterSurat;
use App\Models\RequestSurat;
use App\Models\StatusSurat;
use Illuminate\Http\Request;

class SuratCustomController extends Controller
{
    public function surat_custom()
    {
        $request_surat = RequestSurat::where(['lfk_jenis_surat' => 5, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $status_surat  = StatusSurat::where(['active' => 1, 'deleted' => '0'])->get();
        $master_surat  = MasterSurat::where(['jenis_surat_id' => 5, 'active' => 1, 'deleted' => '0'])->get();
        $data = [
            'title'             => 'Surat Custom',
            'menu_aktif'        => 'surat_custom',
            'request_surat'     => $request_surat,
            'status_surat'      => $status_surat,
            'master_surat'      => $master_surat,
        ];

        return view('surat.surat-custom', $data);
    }
    public function lihat_surat_custom($surat_id)
    {
        $request_surat = RequestSurat::where(['surat_id' => $surat_id, 'lfk_jenis_surat' => 5, 'deleted' => '0'])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'             => 'Surat Custom',
            'menu_aktif'        => 'surat_custom',
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

        $surat->lfk_template_master     = $value->master_surat;

        $cek = $surat->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah template surat');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah template surat');
    }














































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_surat_custom_all()
    {
        $surat_custom = RequestSurat::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $surat_custom,
        ]);
    }
    public function api_surat_custom_detail($surat_id)
    {
        $surat_custom = RequestSurat::where('surat_id', $surat_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$surat_custom) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $surat_custom,
                'jumlah_approval' => count(@$surat_custom->master_surat->detail_ttd ?: []),
            ]);
        }
    }
}
