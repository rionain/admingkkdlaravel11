<?php

namespace App\Http\Controllers\AdminCabang\RequestSertifikat;

use App\Http\Controllers\Controller;
use App\Models\SertifikatBaptis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RequestSertifikatBaptisController extends Controller
{
    public function list()
    {
        $cabang_id = auth()->user()->lfk_cabang_id;
        $sertifikat = SertifikatBaptis::where('lfk_cabang_id', $cabang_id)->orderBy('created_date', 'DESC')->get();
        $data = [
            'title'             => 'Sertifikat',
            'menu_aktif'        => 'sertifikat_baptis',
            'sertifikat'        => $sertifikat,
        ];
        return view('admin-cabang.request-sertifiikat.sertifikat-baptis', $data);
    }

    public function tambah(Request $request)
    {
        validator($request->all())->validate([
            'nama_jemaat'           => 'required',
            'tanggal_baptis'        => 'required|date',
            'tempat_baptis'         => 'required',
            'tempat_lahir'          => 'required',
            'tanggal_lahir'         => 'required|date',
            'nama_ayah'             => 'required',
            'nama_ibu'              => 'required',
            'saksi1'                => 'required',
            'saksi2'                => 'required',
            'foto_jemaat'           => 'required|mimes:jpeg,png,jpg|max:1024',
            'nama_pembaptis'        => 'required',
            'nama_pendeta'          => 'required',
            'nama_kota'             => 'required',
            'foto_tanda_tangan'     => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
            // 'foto_tanda_tangan'     => 'required|mimes:jpeg,png,jpg|max:1024'
        ]);

        $sertifikat = new SertifikatBaptis;
        $sertifikat->nama_jemaat        = $request->nama_jemaat;
        $sertifikat->tanggal_baptis     = $request->tanggal_baptis;
        $sertifikat->tempat_baptis      = $request->tempat_baptis;
        $sertifikat->tempat_lahir       = $request->tempat_lahir;
        $sertifikat->tanggal_lahir      = $request->tanggal_lahir;
        $sertifikat->nama_ayah          = $request->nama_ayah;
        $sertifikat->nama_ibu           = $request->nama_ibu;
        $sertifikat->saksi1             = $request->saksi1;
        $sertifikat->saksi2             = $request->saksi2;
        $sertifikat->nama_pembaptis     = $request->nama_pembaptis;
        $sertifikat->nama_pendeta       = $request->nama_pendeta;
        $sertifikat->nama_kota          = $request->nama_kota;
        $sertifikat->lfk_cabang_id      = auth()->user()->lfk_cabang_id;
        $sertifikat->lfk_status_sertifikat_id = 1;

        if (request()->hasFile('foto_jemaat')) {
            $file = request()->file('foto_jemaat');
            $filename = '/sertifikat/foto_jemaat-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file jemaat');
            }
            $sertifikat->foto_jemaat = $filename;
        } else {
            // return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file foto jemaat');
            // $sertifikat->foto_jemaat = '';
        }

        if (request()->hasFile('foto_tanda_tangan')) {
            $file = request()->file('foto_tanda_tangan');
            $filename = '/sertifikat/foto_tanda_tangan-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file tanda tangan');
            }
            $sertifikat->foto_tanda_tangan = $filename;
        } else {
            // return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file tanda tangan 2');
            // $sertifikat->foto_tanda_tangan = '';
        }

        if (request()->hasFile('ttdsaksi1')) {
            $file = request()->file('ttdsaksi1');
            $filename = '/sertifikat/foto_ttd_saksi_1-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_1 = $filename;
        }

        if (request()->hasFile('ttdsaksi2')) {
            $file = request()->file('ttdsaksi2');
            $filename = '/sertifikat/foto_ttd_saksi_2-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_2 = $filename;
        }

        $cek = $sertifikat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal ditambahkan');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $sertifikat_baptis_id)
    {
        validator($request->all())->validate([
            'nama_jemaat'               => 'required',
            'tanggal_baptis'            => 'required|date',
            'tempat_baptis'             => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required|date',
            'nama_ayah'                 => 'required',
            'nama_ibu'                  => 'required',
            'nama_pendeta'              => 'required',
            'saksi1'                    => 'required',
            'saksi2'                    => 'required',
            'foto_jemaat'               => 'nullable|image|mimes:jpeg,png,jpg',
            'nama_pembaptis'            => 'required',
            'nama_kota'                 => 'required',
            'foto_tanda_tangan'         => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        $sertifikat = SertifikatBaptis::find($sertifikat_baptis_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $sertifikat->nama_jemaat        = $request->nama_jemaat;
        $sertifikat->tanggal_baptis     = $request->tanggal_baptis;
        $sertifikat->tempat_baptis      = $request->tempat_baptis;
        $sertifikat->tempat_lahir       = $request->tempat_lahir;
        $sertifikat->tanggal_lahir      = $request->tanggal_lahir;
        $sertifikat->nama_ayah          = $request->nama_ayah;
        $sertifikat->nama_ibu           = $request->nama_ibu;
        $sertifikat->nama_pembaptis     = $request->nama_pembaptis;
        $sertifikat->saksi1             = $request->saksi1;
        $sertifikat->saksi2             = $request->saksi2;
        $sertifikat->nama_pendeta       = $request->nama_pendeta;
        $sertifikat->nama_kota          = $request->nama_kota;
        $sertifikat->lfk_status_sertifikat_id = 1;

        if (request()->hasFile('foto_jemaat')) {
            $file = request()->file('foto_jemaat');
            $filename = '/sertifikat/foto_jemaat-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_jemaat = $filename;
        }
        if (request()->hasFile('foto_tanda_tangan')) {
            $file = request()->file('foto_tanda_tangan');
            $filename = '/sertifikat/foto_tanda_tangan-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_tanda_tangan = $filename;
        }

        if (request()->hasFile('ttdsaksi1')) {
            $file = request()->file('ttdsaksi1');
            $filename = '/sertifikat/foto_ttd_saksi_1-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_1 = $filename;
        }

        if (request()->hasFile('ttdsaksi2')) {
            $file = request()->file('ttdsaksi2');
            $filename = '/sertifikat/foto_ttd_saksi_2-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_2 = $filename;
        }

        $cek = $sertifikat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil diubah');
    }
}
