<?php

namespace App\Http\Controllers\AdminCabang\RequestSurat;

use App\Http\Controllers\Controller;
use App\Models\SuratKeputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestSuratKeputusanController extends Controller
{
    public function request_surat()
    {
        $cabang_id = Auth::user()->lfk_cabang_id;

        $data = [
            'title'             => 'Request Surat Keputusan',
            'menu_aktif'        => 'request_surat_keputusan',
            'surat'             => SuratKeputusan::where(['lfk_cabang_id' => $cabang_id])->join('user_header', 'user_header.user_id', '=', 'surat_keputusan.user_id')->orderBy('surat_keputusan.created_date', 'DESC')->get()
        ];

        return view('admin-cabang.request-surat.list-request-surat-keputusan', $data);
    }

    public function tambah_request_surat()
    {
        $value = (object) request()->validate([
            'nama_gereja'               => 'required',
            'tanggal_persetujuan'       => 'required',
            'nama_lengkap'              => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'jabatan'                   => 'required',
        ]);

        $surat = new SuratKeputusan;
        $surat->status_surat_id         = 1;
        $surat->user_id                 = auth()->user()->user_id;

        $surat->nama_gereja             = $value->nama_gereja;
        $surat->tanggal_persetujuan     = $value->tanggal_persetujuan;
        $surat->nama_lengkap            = $value->nama_lengkap;
        $surat->tempat_lahir            = $value->tempat_lahir;
        $surat->tanggal_lahir           = $value->tanggal_lahir;
        $surat->jabatan                 = $value->jabatan;
        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function revisi_request_surat($surat_id)
    {
        $value = (object) request()->validate([
            'nama_gereja'               => 'required',
            'tanggal_persetujuan'       => 'required',
            'nama_lengkap'              => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'jabatan'                   => 'required',
        ]);

        $surat = SuratKeputusan::where('surat_keputusan_id', $surat_id)->where([])->first();
        $surat->status_surat_id                     = 1;
        $surat->pengaturan_surat_keputusan_id       = null;
        $surat->user_id                             = auth()->user()->user_id;

        $surat->nama_gereja             = $value->nama_gereja;
        $surat->tanggal_persetujuan     = $value->tanggal_persetujuan;
        $surat->nama_lengkap            = $value->nama_lengkap;
        $surat->tempat_lahir            = $value->tempat_lahir;
        $surat->tanggal_lahir           = $value->tanggal_lahir;
        $surat->jabatan                 = $value->jabatan;
        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_surat($surat_id)
    {
        $surat = SuratKeputusan::where('surat_keputusan_id', $surat_id)->first();
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
    public function api_surat_keputusan_all()
    {
        $cabang_id = Auth::user()->lfk_cabang_id;

        $surat_keputusan = SuratKeputusan::where(['lfk_cabang_id' => $cabang_id])->join('user_header', 'user_header.user_id', '=', 'surat_keputusan.user_id')->with('user')->orderBy('surat_keputusan.created_date', 'DESC')->get();

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
