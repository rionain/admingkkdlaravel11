<?php

namespace App\Http\Controllers\Administrasi\Surat;

use App\Http\Controllers\Controller;
use App\Models\MasterSurat;
use App\Models\PengaturanSuratKeputusan;
use App\Models\StatusSurat;
use App\Models\SuratKeputusan;
use Illuminate\Http\Request;

class SuratKeputusanController extends Controller
{
    public function surat_keputusan()
    {
        $request_surat = SuratKeputusan::where([])->orderBy('created_date', 'DESC')->get();
        $status_surat  = StatusSurat::where([])->get();
        $pengaturan_surat_keputusan  = PengaturanSuratKeputusan::where(['active' => 1])->get();
        $data = [
            'title'             => 'Surat Keputusan',
            'menu_aktif'        => 'surat_keputusan',
            'request_surat'     => $request_surat,
            'status_surat'      => $status_surat,
            'pengaturan_surat_keputusan'      => $pengaturan_surat_keputusan,
        ];

        return view('surat.surat_keputusan.surat-keputusan', $data);
    }
    public function lihat_surat($surat_keputusan_id)
    {
        $request_surat = SuratKeputusan::where(['surat_keputusan_id' => $surat_keputusan_id])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'             => 'Surat Keputusan',
            'menu_aktif'        => 'surat_keputusan',
            'request_surat'     => $request_surat,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('surat.surat_keputusan.lihat-surat-keputusan', $data);
    }

    public function ubah_status($surat_keputusan_id)
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

        $surat = SuratKeputusan::where(['surat_keputusan_id' => $surat_keputusan_id])->first();

        $surat->status_surat_id     = $value->statusSurat;
        if ($value->statusSurat == 5) {
            $surat->alasan_demote     = $value->alasan;
        }

        if ($value->statusSurat == 6) {
            $surat->status_surat_id = 6;
            $surat->nomor_surat = "S-GKKD/$surat->surat_tugas_id/IV/" . date('Y');
        }


        $cek = $surat->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah status');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah status');
    }

    public function ubah_pengaturan($surat_keputusan_id)
    {
        $validation = [
            'pengaturan_surat_keputusan_id'     => 'required',
            'tempat_penetapan'                  => 'required',
            'tanggal_penetapan'                 => 'required',
        ];

        $value = (object) request()->validate($validation);

        $surat = SuratKeputusan::where(['surat_keputusan_id' => $surat_keputusan_id])->first();

        if (!$surat->status_surat_id == 1 || $surat->status_surat_id == '1')
            $surat->status_surat_id                 = 2;
        $surat->pengaturan_surat_keputusan_id       = $value->pengaturan_surat_keputusan_id;
        $surat->tempat_penetapan                    = $value->tempat_penetapan;
        $surat->tanggal_penetapan                   = $value->tanggal_penetapan;

        $cek = $surat->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah template surat');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah template surat');
    }














































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_surat_keputusan_all()
    {
        $surat_keputusan = SuratKeputusan::where([])->get();

        return response()->json([
            'status' => true,
            'data' => $surat_keputusan,
        ]);
    }
    public function api_surat_keputusan_detail($surat_keputusan_id)
    {
        $surat_keputusan = SuratKeputusan::where('surat_keputusan_id', $surat_keputusan_id)->where([])->first();

        if (!$surat_keputusan) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $surat_keputusan,
                'jumlah_approval' => count(@$surat_keputusan->pengaturan_surat_keputusan->detail_ttd ?: []),
            ]);
        }
    }
}
