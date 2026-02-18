<?php

namespace App\Http\Controllers\AdminCabang\RequestSurat;

use App\Http\Controllers\Controller;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestSuratCustomController extends Controller
{
    public function request_surat()
    {
        $user_id = Auth::user()->user_id;

        $data = [
            'title'             => 'Request Surat Custom',
            'menu_aktif'        => 'request_surat_custom',
            'surat'             => RequestSurat::where(['lfk_requester_user_id' => $user_id, 'lfk_jenis_surat' => 5, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get()
        ];

        return view('admin-cabang.request-surat.list-request-surat-custom', $data);
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
        $surat->lfk_jenis_surat         = 5;
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
}
