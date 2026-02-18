<?php

namespace App\Http\Controllers\AdminCabang\RequestSurat;

use App\Http\Controllers\Controller;
use App\Models\RequestSurat;
use App\Models\SuratPenunjukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestSuratPenunjukanController extends Controller
{
    public function request_surat()
    {
        $cabang_id = Auth::user()->lfk_cabang_id;

        $data = [
            'title'             => 'Request Surat Penunjukan',
            'menu_aktif'        => 'request_surat_penunjukan',
            'surat'             => SuratPenunjukan::where(['lfk_cabang_id' => $cabang_id])->join('user_header', 'user_header.user_id', '=', 'surat_penunjukan.user_id')->orderBy('surat_penunjukan.created_date', 'DESC')->get()
        ];

        return view('admin-cabang.request-surat.list-request-surat-penunjukan', $data);
    }

    public function tambah_request_surat()
    {
        $value = (object) request()->validate([
            'nama_gereja'                   => 'required',
            'alamat_lengkap_gereja'         => 'required',
            'nama_ketua'                    => 'required',
            'tempat_lahir_ketua'            => 'required',
            'tanggal_lahir_ketua'           => 'required',
            'alamat_ketua'                  => 'required',
            'nama_sekretaris'               => 'required',
            'tempat_lahir_sekretaris'       => 'required',
            'tanggal_lahir_sekretaris'      => 'required',
            'alamat_sekretaris'             => 'required',
            'nama_bendahara'                => 'required',
            'tempat_lahir_bendahara'        => 'required',
            'tanggal_lahir_bendahara'       => 'required',
            'alamat_bendahara'              => 'required',
        ]);

        $surat = new SuratPenunjukan;
        $surat->status_surat_id             = 1;
        $surat->user_id                     = auth()->user()->user_id;

        $surat->nama_gereja                 = $value->nama_gereja;
        $surat->alamat_lengkap_gereja       = $value->alamat_lengkap_gereja;
        $surat->nama_ketua                  = $value->nama_ketua;
        $surat->tempat_lahir_ketua          = $value->tempat_lahir_ketua;
        $surat->tanggal_lahir_ketua         = $value->tanggal_lahir_ketua;
        $surat->alamat_ketua                = $value->alamat_ketua;
        $surat->nama_sekretaris             = $value->nama_sekretaris;
        $surat->tempat_lahir_sekretaris     = $value->tempat_lahir_sekretaris;
        $surat->tanggal_lahir_sekretaris    = $value->tanggal_lahir_sekretaris;
        $surat->alamat_sekretaris           = $value->alamat_sekretaris;
        $surat->nama_bendahara              = $value->nama_bendahara;
        $surat->tempat_lahir_bendahara      = $value->tempat_lahir_bendahara;
        $surat->tanggal_lahir_bendahara     = $value->tanggal_lahir_bendahara;
        $surat->alamat_bendahara            = $value->alamat_bendahara;

        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function revisi_request_surat($surat_id)
    {
        $value = (object) request()->validate([
            'nama_gereja'                   => 'required',
            'alamat_lengkap_gereja'         => 'required',
            'nama_ketua'                    => 'required',
            'tempat_lahir_ketua'            => 'required',
            'tanggal_lahir_ketua'           => 'required',
            'alamat_ketua'                  => 'required',
            'nama_sekretaris'               => 'required',
            'tempat_lahir_sekretaris'       => 'required',
            'tanggal_lahir_sekretaris'      => 'required',
            'alamat_sekretaris'             => 'required',
            'nama_bendahara'                => 'required',
            'tempat_lahir_bendahara'        => 'required',
            'tanggal_lahir_bendahara'       => 'required',
            'alamat_bendahara'              => 'required',
        ]);

        $surat = SuratPenunjukan::where('surat_penunjukan_id', $surat_id)->where([])->first();
        $surat->status_surat_id                     = 1;
        $surat->pengaturan_surat_penunjukan_id      = null;
        $surat->user_id                             = auth()->user()->user_id;

        $surat->nama_gereja                 = $value->nama_gereja;
        $surat->alamat_lengkap_gereja       = $value->alamat_lengkap_gereja;
        $surat->nama_ketua                  = $value->nama_ketua;
        $surat->tempat_lahir_ketua          = $value->tempat_lahir_ketua;
        $surat->tanggal_lahir_ketua         = $value->tanggal_lahir_ketua;
        $surat->alamat_ketua                = $value->alamat_ketua;
        $surat->nama_sekretaris             = $value->nama_sekretaris;
        $surat->tempat_lahir_sekretaris     = $value->tempat_lahir_sekretaris;
        $surat->tanggal_lahir_sekretaris    = $value->tanggal_lahir_sekretaris;
        $surat->alamat_sekretaris           = $value->alamat_sekretaris;
        $surat->nama_bendahara              = $value->nama_bendahara;
        $surat->tempat_lahir_bendahara      = $value->tempat_lahir_bendahara;
        $surat->tanggal_lahir_bendahara     = $value->tanggal_lahir_bendahara;
        $surat->alamat_bendahara            = $value->alamat_bendahara;
        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_surat($surat_id)
    {
        $surat = SuratPenunjukan::where('surat_penunjukan_id', $surat_id)->first();
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
    public function api_surat_penunjukan_all()
    {
        $cabang_id = Auth::user()->lfk_cabang_id;

        $surat_penunjukan = SuratPenunjukan::where(['lfk_cabang_id' => $cabang_id])->join('user_header', 'user_header.user_id', '=', 'surat_penunjukan.user_id')->with('user')->orderBy('surat_penunjukan.created_date', 'DESC')->get();

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
