<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Kop;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use S3Helper;

class PengaturanKopSuratController extends Controller
{
    public function kop_surat()
    {
        $kop = Kop::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $data = [
            'kop'               => $kop,
            'title'             => 'Pengaturan Kop Surat',
            'menu_aktif'        => 'pengaturan_kop_surat',
        ];
        return view('pengaturan.pengaturan-kop-list', $data);
    }

    public function tambah_kop()
    {
        // Debugging: Log the request data and file sizes
        \Log::info('PengaturanKopSurat@tambah_kop request data:', request()->except(['fileKop']));
        if (request()->hasFile('fileKop')) {
            $file = request()->file('fileKop');
            \Log::info("File fileKop: size=" . $file->getSize() . " error=" . $file->getError() . " isValid=" . ($file->isValid() ? 'yes' : 'no'));
        } else {
            \Log::info("File fileKop missing or invalid");
        }

        $value = (object) request()->validate([
            'nama_kop_surat'            => 'required',
            'fieldTitleHeader'          => 'required',
            'fieldHeaderDescription'    => 'required',
            'fileKop'                   => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $kop = Kop::where('nama_kop_surat', $value->nama_kop_surat)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($kop) {
            return redirect()->back()->withInput()->with('gagal', 'Nama kop surat sudah ada');
        }


        $kop = new Kop;

        if (request()->hasFile('fileKop')) {
            $file = request()->file('fileKop');
            $filename = '/kop/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $kop->logo = $filename;
        } else {
            return redirect()->back()->withInput()->with('gagal', 'Foto gagal disimpan');
        }

        $kop->nama_kop_surat = $value->nama_kop_surat;
        $kop->title          = $value->fieldTitleHeader;
        $kop->deskripsi      = $value->fieldHeaderDescription;


        $linkkop = S3Helper::get($filename);

        $htmlkop = "
        <div style='font-family: Arial, Helvetica, sans-serif;'>
            <img style='padding: 0 20px;object-fit:contain;margin:0 auto;display:block' src='" . $linkkop . "' width='120px'>
            <div style='display:block;text-align: center;padding: 0 40px;margin:0 auto;max-width:85%'>
                <h3 style='margin:0;font-weight:1000;color:#6D0863 !important'>" . strtoupper(request('fieldTitleHeader')) . "</h2>
                <div style='line-height:1;color:#6D0863 !important'>" . request('fieldHeaderDescription') . "</div>
            </div>
        </div>
        ";
        $kop->headerdescription = $htmlkop;

        $cek = $kop->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_kop($kop_id)
    {
        // Debugging: Log the request data and file sizes
        \Log::info('PengaturanKopSurat@edit_kop request data:', request()->except(['fileKop']));
        if (request()->hasFile('fileKop')) {
            $file = request()->file('fileKop');
            \Log::info("File fileKop: size=" . $file->getSize() . " error=" . $file->getError() . " isValid=" . ($file->isValid() ? 'yes' : 'no'));
        } else {
            \Log::info("File fileKop missing or invalid");
        }

        $value = (object) request()->validate([
            'fieldTitleHeader'          => 'required',
            'fieldHeaderDescription'    => 'required',
            'fileKop'                   => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);



        $kop = Kop::where('kop_id', $kop_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kop) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $filename = '';
        if (request()->hasFile('fileKop')) {
            $file = request()->file('fileKop');
            $filename = '/kop/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $kop->logo = $filename;
        }

        $kop->title          = $value->fieldTitleHeader;
        $kop->deskripsi      = $value->fieldHeaderDescription;

        if (request()->hasFile('fileKop')) {
            $linkkop = S3Helper::get($filename);
        } else {
            $linkkop = S3Helper::get($kop->logo);
        }

        $htmlkop = "
            <div style='font-family: Arial, Helvetica, sans-serif;'>
                <img style='padding: 0 20px;object-fit:contain;margin:0 auto;display:block' src='" . $linkkop . "' width='120px'>
                <div style='display:block;text-align: center;padding: 0 40px;margin:0 auto;max-width:85%'>
                    <h3 style='margin:0;font-weight:1000;color:#6D0863 !important'>" . strtoupper(request('fieldTitleHeader')) . "</h2>
                    <div style='line-height:1;color:#6D0863 !important'>" . request('fieldHeaderDescription') . "</div>
                </div>
            </div>
        ";

        $kop->headerdescription = $htmlkop;


        $cek = $kop->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function lihat_kop($id)
    {
        $kop = Kop::where(['kop_id' => $id, 'deleted' => '0'])->first();
        return $kop->headerdescription;
    }

    public function export()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('tesexport');
        return $pdf->stream();
    }

    public function hapus_kop($kop_id = null)
    {
        if (!$kop_id) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $kop = Kop::where('kop_id', $kop_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kop) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $kop->deleted = 1;

        $cek = $kop->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_kop_surat_all()
    {
        $kop_surat = Kop::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $kop_surat,
        ]);
    }
    public function api_kop_surat_detail($kop_id)
    {
        $kop_surat = Kop::where('kop_id', $kop_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$kop_surat) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $kop_surat,
            ]);
        }
    }
}
