<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class PengaturanFooterSuratController extends Controller
{
    public function footer_surat()
    {
        $data = [
            'title'             => 'Pengaturan Footer Surat',
            'menu_aktif'        => 'pengaturan_footer_surat',
            'footer'            => Footer::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get()
        ];
        return view('pengaturan.pengaturan-footer-list', $data);
    }

    public function tambah_footer_surat()
    {
        $value = (object) request()->validate([
            'nama_footer'       => 'required',
            'html_footer'       => 'required',
        ]);

        $footer = Footer::where('nama_footer', $value->nama_footer)->first();
        if ($footer) {
            return redirect()->back()->withInput()->with('gagal', 'Nama sudah digunakan');
        }

        $footer = new Footer;
        $footer->nama_footer  = $value->nama_footer;
        $footer->footer       = "
        <style>
            .line1 p,
            .line1 h1,
            .line1 h2,
            .line1 h3,
            line1 h4,
            line1 h5{
                line-height:1 !important;
            }
        </style>
        <div class='line1'>
            $value->html_footer
        </div>";

        $cek = $footer->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data');
    }

    public function edit_footer($id)
    {
        if ($id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $value = (object) request()->validate([
            'nama_footer' => 'required',
            'html_footer' => 'required',
        ]);

        $footer_name = Footer::where('nama_footer', $value->nama_footer)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($footer_name && ($footer_name->template_footer_id != $id)) {
            return redirect()->back()->withInput()->with('gagal', 'Nama footer sudah ada');
        }

        $footer = Footer::where('template_footer_id', $id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$footer) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $footer->nama_footer = $value->nama_footer;
        $footer->footer       = "
        <style>
            .line1 p,
            .line1 h1,
            .line1 h2,
            .line1 h3,
            line1 h4,
            line1 h5{
                line-height:1 !important;
            }
        </style>
        <div class='line1'>
            $value->html_footer
        </div>";

        $cek = $footer->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }


    public function hapus_footer_surat($template_footer_id)
    {
        if (!$template_footer_id) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $template_footer = Footer::where('template_footer_id', $template_footer_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$template_footer) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $template_footer->deleted = 1;

        $cek = $template_footer->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_footer_all()
    {
        $footer = Footer::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $footer,
        ]);
    }
    public function api_footer_detail($template_footer_id)
    {
        $footer = Footer::where('template_footer_id', $template_footer_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$footer) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $footer,
            ]);
        }
    }
}
