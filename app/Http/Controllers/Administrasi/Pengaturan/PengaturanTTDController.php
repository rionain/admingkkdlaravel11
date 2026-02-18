<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\TandaTangan;
use App\Models\UserApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use S3Helper;

class PengaturanTTDController extends Controller
{
    public function ttd_surat()
    {
        $data = [
            'title'             => 'Pengaturan Tanda Tangan Surat',
            'menu_aktif'        => 'pengaturan_tembusan_surat',
            'ttd'               => TandaTangan::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'approval'          => UserApproval::where(['active' => 1, 'deleted' => '0'])->get(),
        ];
        return view('pengaturan.pengaturan-ttd-list', $data);
    }


    public function tambah_ttd_surat()
    {
        $value = (object) request()->validate([
            'nama_ttd'      => 'required',
            'jabatan_ttd'   => 'required',
            'ttd'           => 'required|file|mimes:jpg,jpeg,png',
            'lfk_user_id'   => 'required',
        ]);
        $tanda_tangan = TandaTangan::where('nama_ttd', $value->nama_ttd)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($tanda_tangan) {
            return redirect()->back()->withInput()->with('gagal', 'Nama tanda tangan sudah ada');
        }

        $tanda_tangan = new TandaTangan;
        $tanda_tangan->nama_ttd = $value->nama_ttd;
        $tanda_tangan->jabatan_ttd = $value->jabatan_ttd;
        $tanda_tangan->lfk_user_id = $value->lfk_user_id;


        if (request()->hasFile('ttd')) {
            $file = request()->file('ttd');
            $filename = '/tanda_tangan/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $tanda_tangan->ttd = $filename;
        } else {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan foto');
        }

        $cek = $tanda_tangan->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }



    public function edit_ttd_surat($ttd_id)
    {
        if ($ttd_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tanda tangan tidak ditemukan');
        }

        $value = (object) request()->validate([
            'nama_ttd'      => 'required',
            'jabatan_ttd'   => 'required',
            'lfk_user_id'   => 'required',
        ]);


        if (request('ubahTtd')) {
            $value2 = (object) request()->validate([
                'ttd'           => 'required|file',
            ]);
        }



        $ttd_name = TandaTangan::where('nama_ttd', $value->nama_ttd)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($ttd_name && ($ttd_name->ttd_id != $ttd_id)) {
            return redirect()->back()->withInput()->with('gagal', 'Nama ttd sudah ada');
        }

        $ttd = TandaTangan::where(['deleted' => '0', 'active' => '1', 'ttd_id' => $ttd_id])->first();
        if (!$ttd) {
            return redirect()->back()->withInput()->with('gagal', 'Data Tanda Tangan ditemukan');
        }

        $ttd->nama_ttd = $value->nama_ttd;
        $ttd->jabatan_ttd = $value->jabatan_ttd;
        $ttd->lfk_user_id = $value->lfk_user_id;

        if (request('ttd')) {
            if (request()->hasFile('ttd')) {
                $file = request()->file('ttd');
                $filename = '/tanda_tangan/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

                $cek = Storage::cloud()->put($filename, file_get_contents($file));
                if (!$cek) {
                    return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
                }
                $ttd->ttd = $filename;
            } else {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan foto');
            }
        }

        $cek = $ttd->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }



    public function hapus_ttd_surat($ttd_id = null)
    {
        if ($ttd_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tanda tangan tidak ditemukan');
        }
        $tanda_tangan = TandaTangan::where('ttd_id', $ttd_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$tanda_tangan) {
            return redirect()->back()->withInput()->with('gagal', 'Data tanda tangan tidak ditemukan');
        }
        $tanda_tangan->deleted = 1;
        $cek = $tanda_tangan->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_ttd_all()
    {
        $ttd = TandaTangan::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get();

        return response()->json([
            'status' => true,
            'data' => $ttd,
        ]);
    }
    public function api_ttd_detail($ttd_id)
    {
        $ttd = TandaTangan::where('ttd_id', $ttd_id)->where(['deleted' => '0', 'active' => '1'])->first();

        if (!$ttd) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $ttd,
            ]);
        }
    }
}
