<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Tembusan;
use Illuminate\Http\Request;

class PengaturanTembusanController extends Controller
{
    public function tembusan_surat()
    {
        $data = [
            'title'             => 'Pengaturan Tembusan Surat',
            'menu_aktif'        => 'pengaturan_tembusan_surat',
            'tembusan_surat'    => Tembusan::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];
        return view('pengaturan.pengaturan-tembusan-list', $data);
    }

    public function tambah_tembusan_surat()
    {
        $value = (object) request()->validate([
            'nama_tembusan' => 'required',
            'html_tembusan' => 'required',
        ]);
        $tembusan = Tembusan::where('nama_tembusan', $value->nama_tembusan)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($tembusan) {
            return redirect()->back()->withInput()->with('gagal', 'Nama tembusan sudah ada');
        }

        $tembusan = new Tembusan;
        $tembusan->nama_tembusan = $value->nama_tembusan;
        $tembusan->tembusan_text = $value->html_tembusan;

        $cek = $tembusan->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }


    public function edit_tembusan($id)
    {
        if ($id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $value = (object) request()->validate([
            'nama_tembusan' => 'required',
            'html_tembusan' => 'required',
        ]);

        $tembusan_name = Tembusan::where('nama_tembusan', $value->nama_tembusan)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($tembusan_name && ($tembusan_name->tembusan_id != $id)) {
            return redirect()->back()->withInput()->with('gagal', 'Nama tembusan sudah ada');
        }

        $tembusan = Tembusan::where('tembusan_id', $id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$tembusan) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $tembusan->nama_tembusan = $value->nama_tembusan;
        $tembusan->tembusan_text = $value->html_tembusan;

        $cek = $tembusan->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }


    public function hapus_tembusan_surat($tembusan_id)
    {
        if (!$tembusan_id) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $template_tembusan = tembusan::where('tembusan_id', $tembusan_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$template_tembusan) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $template_tembusan->deleted = 1;

        $cek = $template_tembusan->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_tembusan_all()
    {
        $tembusan = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $tembusan,
        ]);
    }
    public function api_tembusan_detail($tembusan_id)
    {
        $tembusan = Tembusan::where('tembusan_id', $tembusan_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$tembusan) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $tembusan,
            ]);
        }
    }
}
