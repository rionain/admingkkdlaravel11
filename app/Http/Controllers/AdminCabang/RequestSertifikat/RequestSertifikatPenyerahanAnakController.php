<?php

namespace App\Http\Controllers\AdminCabang\RequestSertifikat;

use App\Http\Controllers\Controller;
use App\Models\SertifikatPenyerahanAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RequestSertifikatPenyerahanAnakController extends Controller
{
    public function list()
    {
        $sertifikat = SertifikatPenyerahanAnak::where('lfk_cabang_id', auth()->user()->lfk_cabang_id)->orderBy('created_date', 'desc')->get();

        $data = [
            'title'             => 'Sertifikat',
            'menu_aktif'        => 'sertifikat_penyerahan_anak',
            'sertifikat'        => $sertifikat,
        ];
        return view('admin-cabang.request-sertifiikat.sertifikat-penyerahan-anak', $data);
    }

    public function tambah(Request $request)
    {
        validator($request->all())->validate([
            'nama_jemaat'               => 'required',
            'tanggal_penyerahan_anak'   => 'required|date',
            'jenis_kelamin'             => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required|date',
            'nama_ayah'                 => 'required',
            'nama_ibu'                  => 'required',
            'nama_pendeta'              => 'required',
            'saksi_pembimbing1'         => 'nullable',
            'saksi_pembimbing2'         => 'nullable',
            'foto'                      => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $sertifikat = new SertifikatPenyerahanAnak;
        $sertifikat->nama_jemaat                = $request->nama_jemaat;
        $sertifikat->tanggal_penyerahan_anak    = $request->tanggal_penyerahan_anak;
        $sertifikat->jenis_kelamin              = $request->jenis_kelamin;
        $sertifikat->tempat_lahir               = $request->tempat_lahir;
        $sertifikat->tanggal_lahir              = $request->tanggal_lahir;
        $sertifikat->nama_ayah                  = $request->nama_ayah;
        $sertifikat->nama_ibu                   = $request->nama_ibu;
        $sertifikat->nama_pendeta               = $request->nama_pendeta;
        $sertifikat->saksi_pembimbing1          = $request->saksi_pembimbing1;
        $sertifikat->saksi_pembimbing2          = $request->saksi_pembimbing2;
        $sertifikat->lfk_cabang_id              = auth()->user()->lfk_cabang_id;
        $sertifikat->lfk_status_sertifikat_id   = 1;

        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/sertifikat/foto_jemaat-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto = $filename;
        }

        if (request()->hasFile('ttdsaksi1')) {
            $file = request()->file('ttdsaksi1');
            $filename = '/sertifikat/foto_ttd_saksi_pembimbing_1-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_pembimbing_1 = $filename;
        }

        if (request()->hasFile('ttdsaksi2')) {
            $file = request()->file('ttdsaksi2');
            $filename = '/sertifikat/foto_ttd_saksi_pembimbing_2-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_pembimbing_2 = $filename;
        }

        $cek = $sertifikat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal ditambahkan');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $sertifikat_penyerahan_anak_id)
    {
        validator($request->all())->validate([
            'nama_jemaat'               => 'required',
            'tanggal_penyerahan_anak'   => 'required|date',
            'jenis_kelamin'             => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required|date',
            'nama_ayah'                 => 'required',
            'nama_ibu'                  => 'required',
            'nama_pendeta'              => 'required',
            'saksi_pembimbing1'         => 'nullable',
            'saksi_pembimbing2'         => 'nullable',
            'foto'                      => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        $sertifikat = SertifikatPenyerahanAnak::find($sertifikat_penyerahan_anak_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $sertifikat->nama_jemaat                = $request->nama_jemaat;
        $sertifikat->tanggal_penyerahan_anak    = $request->tanggal_penyerahan_anak;
        $sertifikat->jenis_kelamin              = $request->jenis_kelamin;
        $sertifikat->tempat_lahir               = $request->tempat_lahir;
        $sertifikat->tanggal_lahir              = $request->tanggal_lahir;
        $sertifikat->nama_ayah                  = $request->nama_ayah;
        $sertifikat->nama_ibu                   = $request->nama_ibu;
        $sertifikat->nama_pendeta               = $request->nama_pendeta;
        $sertifikat->saksi_pembimbing1          = $request->saksi_pembimbing1;
        $sertifikat->saksi_pembimbing2          = $request->saksi_pembimbing2;
        $sertifikat->lfk_status_sertifikat_id   = 1;

        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/sertifikat/foto_jemaat-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto = $filename;
        }

        if (request()->hasFile('ttdsaksi1')) {
            $file = request()->file('ttdsaksi1');
            $filename = '/sertifikat/foto_ttd_saksi_pembimbing_1-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_pembimbing_1 = $filename;
        }

        if (request()->hasFile('ttdsaksi2')) {
            $file = request()->file('ttdsaksi2');
            $filename = '/sertifikat/foto_ttd_saksi_pembimbing_2-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto_ttd_saksi_pembimbing_2 = $filename;
        }

        $cek = $sertifikat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil diubah');
    }
}
