<?php

namespace App\Http\Controllers\Administrasi\Surat;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSuratTugas;
use App\Models\StatusSurat;
use App\Models\SuratTugas;
use Illuminate\Http\Request;

class SuratTugasController extends Controller
{
    public function surat_tugas()
    {
        $surat_tugas = SuratTugas::where([])->orderBy('created_date', 'DESC')->get();
        $status_surat  = StatusSurat::where([])->get();
        $pengaturan_surat_tugas  = PengaturanSuratTugas::where(['active' => 1,])->get();
        $data = [
            'title'                         => 'Surat tugas',
            'menu_aktif'                    => 'surat_tugas',
            'surat_tugas'                 => $surat_tugas,
            'status_surat'                  => $status_surat,
            'pengaturan_surat_tugas'   => $pengaturan_surat_tugas,
        ];

        return view('surat.surat_tugas.surat-tugas', $data);
    }
    public function lihat_surat($surat_tugas_id)
    {
        $surat_tugas = SuratTugas::where(['surat_tugas_id' => $surat_tugas_id])->first();
        if (!$surat_tugas) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'             => 'Surat tugas',
            'menu_aktif'        => 'surat_tugas',
            'surat_tugas'     => $surat_tugas,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('surat.surat_tugas.lihat-surat-tugas', $data);
    }

    public function ubah_status($surat_tugas_id)
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

        $surat = SuratTugas::where(['surat_tugas_id' => $surat_tugas_id])->first();

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

    public function ubah_pengaturan($surat_tugas_id)
    {
        $validation = [
            'pengaturan_surat_tugas_id'     => 'required',
            'tempat_surat'                  => 'required',
            'tanggal_surat'                 => 'required'
        ];

        $value = (object) request()->validate($validation);

        $surat = SuratTugas::where(['surat_tugas_id' => $surat_tugas_id])->first();

        if (!$surat->status_surat_id == 1 || $surat->status_surat_id == '1')
            $surat->status_surat_id             = 2;
        $surat->pengaturan_surat_tugas_id       = $value->pengaturan_surat_tugas_id;
        $surat->tempat_surat                    = $value->tempat_surat;
        $surat->tanggal_surat                   = $value->tanggal_surat;

        $cek = $surat->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah template surat');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah template surat');
    }














































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_surat_tugas_all()
    {
        $surat_tugas = SuratTugas::where([])->get();

        return response()->json([
            'status' => true,
            'data' => $surat_tugas,
        ]);
    }
    public function api_surat_tugas_detail($surat_tugas_id)
    {
        $surat_tugas = SuratTugas::where('surat_tugas_id', $surat_tugas_id)->where([])->first();

        if (!$surat_tugas) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $surat_tugas,
                'jumlah_approval' => count(@$surat_tugas->pengaturan_surat_tugas->detail_ttd ?: []),
            ]);
        }
    }
}
