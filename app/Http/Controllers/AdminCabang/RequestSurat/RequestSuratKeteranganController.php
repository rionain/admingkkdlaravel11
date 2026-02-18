<?php

namespace App\Http\Controllers\AdminCabang\RequestSurat;

use App\Http\Controllers\Controller;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestSuratKeteranganController extends Controller
{
    public function request_surat()
    {
        $user_id = Auth::user()->user_id;

        $data = [
            'title'             => 'Request Surat Keterangan',
            'menu_aktif'        => 'request_surat_keterangan',
            'surat'             => RequestSurat::where(['lfk_requester_user_id' => $user_id, 'lfk_jenis_surat' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get()
        ];

        return view('admin-cabang.request-surat.list-request-surat-keterangan', $data);
    }

    public function tambah_request_surat()
    {
        $value = (object) request()->validate([
            'nama_surat'        => 'required',
            'perihal'           => 'required',
            'nama_diajukan'     => 'required',
            'email_diajukan'    => 'required|email',
            'no_telp_diajukan'  => 'required',
            'alamat_diajukan'   => 'required',
        ]);

        $surat = new RequestSurat;
        $surat->lfk_jenis_surat         = 1;
        $surat->lfk_status_surat_id     = 1;
        $surat->ajuan_ke                = 1;
        $surat->lfk_requester_user_id   = auth()->user()->user_id;

        $surat->nama_surat              = $value->nama_surat;
        $surat->perihal                 = $value->perihal;
        $surat->nama_diajukan           = $value->nama_diajukan;
        $surat->email_diajukan          = $value->email_diajukan;
        $surat->no_telp_diajukan        = $value->no_telp_diajukan;
        $surat->alamat_diajukan         = $value->alamat_diajukan;
        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function lihat_surat($surat_id)
    {
        $user_id = Auth::user()->user_id;
        $request_surat = RequestSurat::where(['lfk_requester_user_id' => $user_id, 'surat_id' => $surat_id, 'deleted' => '0'])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'             => 'Surat',
            'menu_aktif'        => 'surat_keterangan',
            'request_surat'     => $request_surat,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('surat.surat-lihat', $data);
    }

    public function revisi_request_surat($surat_id)
    {
        $value = (object) request()->validate([
            'perihal'           => 'required',
            'nama_diajukan'     => 'required',
            'email_diajukan'    => 'required',
            'no_telp_diajukan'  => 'required',
            'alamat_diajukan'   => 'required',
        ]);

        $surat = RequestSurat::where(['surat_id' => $surat_id])->first();
        $surat->lfk_status_surat_id     = 1;
        $surat->ajuan_ke                = $surat->ajuan_ke + 1;

        $surat->perihal                 = $value->perihal;
        $surat->nama_diajukan           = $value->nama_diajukan;
        $surat->email_diajukan          = $value->email_diajukan;
        $surat->no_telp_diajukan        = $value->no_telp_diajukan;
        $surat->alamat_diajukan         = $value->alamat_diajukan;
        $cek = $surat->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_surat($surat_id)
    {
        $user_id = auth()->user()->user_id;
        $request_surat = RequestSurat::where(['lfk_requester_user_id' => $user_id, 'surat_id' => $surat_id, 'deleted' => '0'])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $request_surat->deleted = '1';
        $cek = $request_surat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal dihapus');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil dihapus');
    }








































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function api_all()
    {
        $jenis_surat = request('jenis_surat');

        if ($jenis_surat) {
            $users = RequestSurat::where(['lfk_jenis_surat' => request('jenis_surat'), 'active' => 1, 'deleted' => '0'])->get();
        } else {
            $users = RequestSurat::where(['active' => 1, 'deleted' => '0'])->get();
        }

        return response()->json([
            'status' => true,
            'data' => $users,
        ]);
    }
    public function api_detail($surat_id)
    {
        $users = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();

        if (!$users) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $users,
            ]);
        }
    }
}
