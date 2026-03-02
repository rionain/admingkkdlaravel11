<?php

namespace App\Http\Controllers\Administrasi\Sertifikat;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\KategoriGereja;
use App\Models\PengaturanSertifikatPenyerahanAnak;
use App\Models\SertifikatPenyerahanAnak as ModelsSertifikatPenyerahanAnak;
use App\Models\StatusSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use S3Helper;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SertifikatPenyerahanAnak extends Controller
{
    public function list()
    {
        $sertifikat = ModelsSertifikatPenyerahanAnak::orderBy('created_date', 'DESC')->get();
        $status_sertifikat  = StatusSertifikat::where(['deleted' => '0', 'active' => 1])->get();
        $kategori_gereja    = KategoriGereja::where(['deleted' => '0', 'active' => 1])->get();
        $cabang             = Cabang::where(['deleted' => '0', 'active' => 1])->get();

        $data = [
            'title'             => 'Sertifikat',
            'menu_aktif'        => 'sertifikat_penyerahan_anak',
            'sertifikat'        => $sertifikat,
            'status_sertifikat' => $status_sertifikat,
            'kategori_gereja'   => $kategori_gereja,
            'cabang'            => $cabang,
        ];
        return view('administrasi.sertifikat.sertifikat-penyerahan-anak', $data);
    }

    public function tambah(Request $request)
    {
        // Debugging: Log the request data and file sizes
        $fileFields = ['foto', 'ttdsaksi1', 'ttdsaksi2'];
        \Log::info('SertifikatPenyerahanAnak@tambah request data:', $request->except($fileFields));
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                \Log::info("File $field: size=" . $file->getSize() . " error=" . $file->getError() . " isValid=" . ($file->isValid() ? 'yes' : 'no'));
            } else {
                \Log::info("File $field missing or invalid");
            }
        }

        $request->validate([
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
            'foto'                      => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'ttdsaksi1'                 => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'ttdsaksi2'                 => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'lfk_status_sertifikat_id'  => 'required',
            'alasan_demote'             => 'nullable',
            'lfk_cabang_id'             => 'required',
            'no_sertifikat'             => 'required',
        ]);


        $sertifikat = new ModelsSertifikatPenyerahanAnak;
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
        $sertifikat->lfk_status_sertifikat_id   = $request->lfk_status_sertifikat_id;
        $sertifikat->alasan_demote              = $request->alasan_demote;
        $sertifikat->lfk_cabang_id              = $request->lfk_cabang_id;
        $sertifikat->no_sertifikat              = $request->no_sertifikat;

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
        // Debugging: Log the request data and file sizes
        $fileFields = ['foto', 'ttdsaksi1', 'ttdsaksi2'];
        \Log::info('SertifikatPenyerahanAnak@edit request data:', $request->except($fileFields));
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                \Log::info("File $field: size=" . $file->getSize() . " error=" . $file->getError() . " isValid=" . ($file->isValid() ? 'yes' : 'no'));
            } else {
                \Log::info("File $field missing or invalid");
            }
        }

        $request->validate([
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
            'foto'                      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'ttdsaksi1'                 => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'ttdsaksi2'                 => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'lfk_status_sertifikat_id'  => 'required',
            'alasan_demote'             => 'nullable',
            'lfk_cabang_id'             => 'required',
            'no_sertifikat'             => 'required',
        ]);

        $sertifikat = ModelsSertifikatPenyerahanAnak::find($sertifikat_penyerahan_anak_id);
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
        $sertifikat->lfk_status_sertifikat_id   = $request->lfk_status_sertifikat_id;
        $sertifikat->alasan_demote              = $request->alasan_demote;
        $sertifikat->lfk_cabang_id              = $request->lfk_cabang_id;
        $sertifikat->no_sertifikat              = $request->no_sertifikat;

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

    public function hapus($sertifikat_penyerahan_anak_id)
    {
        $sertifikat = ModelsSertifikatPenyerahanAnak::find($sertifikat_penyerahan_anak_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $cek = $sertifikat->delete();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal dihapus');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil dihapus');
    }

    public function print_view($sertifikat_penyerahan_anak_id)
    {
        $sertifikat = PengaturanSertifikatPenyerahanAnak::firstOrCreate(['pengaturan_sertifikat_penyerahan_anak_id' => 1]);
        $sertifikat_penyerahan_anak = ModelsSertifikatPenyerahanAnak::find($sertifikat_penyerahan_anak_id);
        // return asset('storage' . $sertifikat->logo_header);

        // @S3Helper::saveAs($sertifikat->logo_header, $sertifikat->logo_header);
        // @S3Helper::saveAs($sertifikat->foto_kanan, $sertifikat->foto_kanan);
        // @S3Helper::saveAs($sertifikat_penyerahan_anak->foto, $sertifikat_penyerahan_anak->foto);

        // dd($sertifikat);
        $qrcode = base64_encode(QrCode::format('png')->size(100)->generate(url("administrasi/sertifikat/penyerahan-anak/$sertifikat_penyerahan_anak->sertifikat_penyerahan_anak_id/print-view")));

        $data = [
            'sertifikat'                    => $sertifikat,
            'sertifikat_penyerahan_anak'    => $sertifikat_penyerahan_anak,
            'qrcode'                        => $qrcode,
            // 'qrcode'                        => '',
        ];
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadView('export.pdf.sertifikat.export-pdf-sertifikat-penyerahan-anak', $data)->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return view('export.pdf.sertifikat.export-pdf-sertifikat-penyerahan-anak', $data);
    }






































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_sertifikat_all()
    {
        $proposal_doa = ModelsSertifikatPenyerahanAnak::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->all();

        return response()->json([
            'status' => true,
            'data' => $proposal_doa,
        ]);
    }
    public function api_sertifikat_detail($sertifikat_penyerahan_anak_id)
    {
        $proposal_doa = ModelsSertifikatPenyerahanAnak::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->find($sertifikat_penyerahan_anak_id);

        if (!$proposal_doa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $proposal_doa,
            ]);
        }
    }
}
