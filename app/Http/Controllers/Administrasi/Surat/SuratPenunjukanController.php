<?php

namespace App\Http\Controllers\Administrasi\Surat;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSuratPenunjukan;
use App\Models\SuratPenunjukan;
use App\Models\StatusSurat;
use Illuminate\Http\Request;

class SuratPenunjukanController extends Controller
{
    public function surat_penunjukan()
    {
        $surat_penunjukan = SuratPenunjukan::where([])->orderBy('created_date', 'DESC')->get();
        $status_surat  = StatusSurat::where([])->get();
        $pengaturan_surat_penunjukan  = PengaturanSuratPenunjukan::where(['active' => 1,])->get();
        $data = [
            'title'                         => 'Surat Penunjukan',
            'menu_aktif'                    => 'surat_penunjukan',
            'surat_penunjukan'                 => $surat_penunjukan,
            'status_surat'                  => $status_surat,
            'pengaturan_surat_penunjukan'   => $pengaturan_surat_penunjukan,
        ];

        return view('surat.surat_penunjukan.surat-penunjukan', $data);
    }
    public function lihat_surat($surat_penunjukan_id)
    {
        $surat_penunjukan = SuratPenunjukan::where(['surat_penunjukan_id' => $surat_penunjukan_id])->first();
        if (!$surat_penunjukan) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'             => 'Surat Penunjukan',
            'menu_aktif'        => 'surat_penunjukan',
            'surat_penunjukan'     => $surat_penunjukan,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('surat.surat_penunjukan.lihat-surat-penunjukan', $data);
    }

    public function ubah_status($surat_penunjukan_id)
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

        $surat = SuratPenunjukan::where(['surat_penunjukan_id' => $surat_penunjukan_id])->first();

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

    public function ubah_pengaturan($surat_penunjukan_id)
    {
        $validation = [
            'pengaturan_surat_penunjukan_id'    => 'required',
            'tempat_penunjukan'                 => 'required',
            'tanggal_penunjukan'                => 'required',
        ];

        $value = (object) request()->validate($validation);

        $surat = SuratPenunjukan::where(['surat_penunjukan_id' => $surat_penunjukan_id])->first();

        if (!$surat->status_surat_id == 1 || $surat->status_surat_id == '1')
            $surat->status_surat_id                 = 2;
        $surat->pengaturan_surat_penunjukan_id      = $value->pengaturan_surat_penunjukan_id;
        $surat->tempat_penunjukan                   = $value->tempat_penunjukan;
        $surat->tanggal_penunjukan                  = $value->tanggal_penunjukan;

        $cek = $surat->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah template surat');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah template surat');
    }














































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_surat_penunjukan_all()
    {
        $surat_penunjukan = SuratPenunjukan::where([])->get();

        return response()->json([
            'status' => true,
            'data' => $surat_penunjukan,
        ]);
    }
    public function api_surat_penunjukan_detail($surat_penunjukan_id)
    {
        $surat_penunjukan = SuratPenunjukan::where('surat_penunjukan_id', $surat_penunjukan_id)->where([])->first();

        if (!$surat_penunjukan) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $surat_penunjukan,
                'jumlah_approval' => count(@$surat_penunjukan->pengaturan_surat_penunjukan->detail_ttd ?: []),
            ]);
        }
    }
}
