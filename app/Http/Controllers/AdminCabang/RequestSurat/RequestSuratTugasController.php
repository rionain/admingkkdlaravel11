<?php

namespace App\Http\Controllers\AdminCabang\RequestSurat;

use App\Http\Controllers\Controller;
use App\Models\SuratTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestSuratTugasController extends Controller
{
    public function request_surat()
    {
        $cabang_id = Auth::user()->lfk_cabang_id;

        $data = [
            'title'             => 'Request Surat tugas',
            'menu_aktif'        => 'request_surat_tugas',
            'surat'             => SuratTugas::where(['lfk_cabang_id' => $cabang_id])->join('user_header', 'user_header.user_id', '=', 'surat_tugas.user_id')->orderBy('surat_tugas.created_date', 'DESC')->get()
        ];

        return view('admin-cabang.request-surat.list-request-surat-tugas', $data);
    }

    public function tambah_request_surat()
    {
        $value = (object) request()->validate([
            'tugas'             => 'required',
            'tanggal_tugas'     => 'required',
            'tempat_tugas'      => 'required',
            'petugas'           => 'required',
        ]);

        $surat = new SuratTugas;
        $surat->status_surat_id             = 1;
        $surat->user_id                     = auth()->user()->user_id;

        $surat->tugas                       = $value->tugas;
        $surat->tanggal_tugas               = $value->tanggal_tugas;
        $surat->tempat_tugas                = $value->tempat_tugas;
        $surat->petugas                     = $value->petugas;

        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function revisi_request_surat($surat_id)
    {
        $value = (object) request()->validate([
            'tugas'             => 'required',
            'tanggal_tugas'     => 'required',
            'tempat_tugas'      => 'required',
            'petugas'           => 'required',
        ]);

        $surat = SuratTugas::where('surat_tugas_id', $surat_id)->where([])->first();
        $surat->status_surat_id             = 1;
        $surat->pengaturan_surat_tugas_id   = null;
        $surat->user_id                     = auth()->user()->user_id;

        $surat->tugas                       = $value->tugas;
        $surat->tanggal_tugas               = $value->tanggal_tugas;
        $surat->tempat_tugas                = $value->tempat_tugas;
        $surat->petugas                     = $value->petugas;
        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_surat($surat_id)
    {
        $surat = SuratTugas::where('surat_tugas_id', $surat_id)->first();
        if (!$surat) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $cek = $surat->delete();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
















































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_surat_tugas_all()
    {
        $cabang_id = Auth::user()->lfk_cabang_id;

        $surat_tugas = SuratTugas::where(['lfk_cabang_id' => $cabang_id])->join('user_header', 'user_header.user_id', '=', 'surat_tugas.user_id')->with('user')->orderBy('surat_tugas.created_date', 'DESC')->get();

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
