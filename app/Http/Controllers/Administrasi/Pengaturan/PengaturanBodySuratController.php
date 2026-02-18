<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Body;
use Illuminate\Support\Facades\App;

class PengaturanBodySuratController extends Controller
{
    public function body_surat()
    {
        $body = Body::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $data = [
            'body'               => $body,
            'title'             => 'Pengaturan Body Surat',
            'menu_aktif'        => 'pengaturan_template_body',
        ];
        return view('pengaturan.pengaturan-body-list', $data);
    }

    public function view_body($id)
    {
        $body = Body::where('template_body_id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $body,
        ], 200);
    }

    public function tambah_body()
    {
        $value = (object) request()->validate([
            'nama_body' => 'required',
            'html_body' => 'required',
        ]);
        $body = Body::where('nama_body', $value->nama_body)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($body) {
            return redirect()->back()->withInput()->with('gagal', 'Nama body sudah ada');
        }

        $body = new Body;
        $body->nama_body = $value->nama_body;
        $body->html_body = $value->html_body;

        $cek = $body->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function edit_body($id)
    {
        if ($id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $value = (object) request()->validate([
            'html_body' => 'required',
        ]);
        $body = Body::where('template_body_id', $id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$body) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $body->html_body = $value->html_body;

        $cek = $body->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function lihat_body($id)
    {
        $body = Body::where(['template_body_id' => $id, 'deleted' => '0'])->first();
        return $body->headerdescription;
    }

    public function export()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('tesexport');
        return $pdf->stream();
    }



    public function hapus_body($id)
    {
        if (!$id) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $template_body = Body::where('template_body_id', $id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$template_body) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $template_body->deleted = 1;

        $cek = $template_body->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }






































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_template_body_all()
    {
        $template_body = Body::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $template_body,
        ]);
    }
    public function api_template_body_detail($template_body_id)
    {
        $template_body = Body::where('template_body_id', $template_body_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$template_body) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $template_body,
            ]);
        }
    }
}
