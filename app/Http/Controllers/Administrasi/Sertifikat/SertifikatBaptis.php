<?php

namespace App\Http\Controllers\Administrasi\Sertifikat;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\KategoriGereja;
use App\Models\PengaturanSertifikatBaptis;
use App\Models\SertifikatBaptis as ModelsSertifikatBaptis;
use App\Models\StatusSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use S3Helper;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SertifikatBaptis extends Controller
{
    public function list()
    {
        $sertifikat         = ModelsSertifikatBaptis::orderBy('created_date', 'DESC')->get();
        $status_sertifikat  = StatusSertifikat::where(['deleted' => '0', 'active' => 1])->get();
        $kategori_gereja    = KategoriGereja::where(['deleted' => '0', 'active' => 1])->get();
        $cabang             = Cabang::where(['deleted' => '0', 'active' => 1])->get();

        $data = [
            'title'             => 'Sertifikat',
            'menu_aktif'        => 'sertifikat_baptis',
            'sertifikat'        => $sertifikat,
            'status_sertifikat' => $status_sertifikat,
            'kategori_gereja'   => $kategori_gereja,
            'cabang'            => $cabang,
        ];
        return view('administrasi.sertifikat.sertifikat-baptis', $data);
    }

    public function tambah(Request $request)
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
            'nama_pembaptis'            => 'required',
            'saksi1'                    => 'required',
            'saksi2'                    => 'required',
            'foto'                      => 'required|image|mimes:jpeg,png,jpg',
            'lfk_status_sertifikat_id'  => 'required',
            'alasan_demote'             => '',
            'lfk_cabang_id'             => 'required',
            'no_sertifikat'             => 'nullable',
        ]);

        $sertifikat = new ModelsSertifikatBaptis;
        $sertifikat->nama_jemaat        = $request->nama_jemaat;
        $sertifikat->tanggal_baptis     = $request->tanggal_baptis;
        $sertifikat->tempat_baptis      = $request->tempat_baptis;
        $sertifikat->tempat_lahir       = $request->tempat_lahir;
        $sertifikat->tanggal_lahir      = $request->tanggal_lahir;
        $sertifikat->nama_ayah          = $request->nama_ayah;
        $sertifikat->nama_ibu           = $request->nama_ibu;
        $sertifikat->nama_pendeta       = $request->nama_pendeta;
        $sertifikat->saksi1             = $request->saksi1;
        $sertifikat->saksi2             = $request->saksi2;
        $sertifikat->lfk_status_sertifikat_id = $request->lfk_status_sertifikat_id;
        $sertifikat->alasan_demote      = $request->alasan_demote;
        $sertifikat->lfk_cabang_id      = $request->lfk_cabang_id;
        $sertifikat->no_sertifikat      = $request->no_sertifikat;
        $sertifikat->nama_pembaptis     = $request->nama_pembaptis;
        $sertifikat->nama_kota          = $request->nama_kota;

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
        // else {
        //     return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
        // }

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
            'nama_pembaptis'            => 'required',
            'saksi1'                    => 'required',
            'saksi2'                    => 'required',
            'foto_jemaat'               => 'nullable|image|mimes:jpeg,png,jpg',
            'nama_pendeta'              => 'required',
            'nama_kota'                 => 'required',
            'foto_tanda_tangan'         => 'required',
            'ttdsaksi1'                 => 'required',
            'ttdsaksi2'                 => 'required',
            'lfk_status_sertifikat_id'  => 'required',
            'alasan_demote'             => '',
            'lfk_cabang_id'             => 'required',
            'no_sertifikat'             => 'nullable',
        ]);
        $sertifikat = ModelsSertifikatBaptis::find($sertifikat_baptis_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $sertifikat->nama_jemaat                = $request->nama_jemaat;
        $sertifikat->tanggal_baptis             = $request->tanggal_baptis;
        $sertifikat->tempat_baptis              = $request->tempat_baptis;
        $sertifikat->tempat_lahir               = $request->tempat_lahir;
        $sertifikat->tanggal_lahir              = $request->tanggal_lahir;
        $sertifikat->nama_ayah                  = $request->nama_ayah;
        $sertifikat->nama_ibu                   = $request->nama_ibu;
        $sertifikat->nama_pendeta               = $request->nama_pendeta;
        $sertifikat->saksi1                     = $request->saksi1;
        $sertifikat->saksi2                     = $request->saksi2;
        $sertifikat->alasan_demote              = $request->alasan_demote;
        $sertifikat->lfk_cabang_id              = $request->lfk_cabang_id;
        $sertifikat->no_sertifikat              = $request->no_sertifikat;
        $sertifikat->nama_pembaptis             = $request->nama_pembaptis;
        $sertifikat->nama_kota                  = $request->nama_kota;
        $sertifikat->lfk_status_sertifikat_id   = $request->lfk_status_sertifikat_id;
        if ($request->lfk_status_sertifikat_id == '2' || $request->lfk_status_sertifikat_id == 2) {
            $sertifikat->tanggal_keluar_sertifikat =  @date('Y-m-d H:i:s');
        }

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

        // Storage::delete('/sertifikat/foto_jemaat-20240216102553-z2axAf.jpg');

        $cek = $sertifikat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil diubah');
    }

    public function hapus($sertifikat_baptis_id)
    {
        $sertifikat = ModelsSertifikatBaptis::find($sertifikat_baptis_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $cek = $sertifikat->delete();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal dihapus');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil dihapus');
    }

    public function print_view($sertifikat_baptis_id)
    {
        $sertifikat = PengaturanSertifikatBaptis::firstOrCreate([
            'pengaturan_sertifikat_baptis_id' => 1,
        ]);
        $sertifikat_baptis = ModelsSertifikatBaptis::find($sertifikat_baptis_id);
        // return asset('storage' . $sertifikat->logo_header);

        // @S3Helper::saveAs($sertifikat->logo_header, $sertifikat->logo_header);
        // @S3Helper::saveAs($sertifikat->foto_kanan, $sertifikat->foto_kanan);
        // @S3Helper::saveAs($sertifikat_baptis->foto_jemaat, $sertifikat_baptis->foto_jemaat);
        // @S3Helper::saveAs($sertifikat_baptis->foto_tanda_tangan, $sertifikat_baptis->foto_tanda_tangan);

        // dd($sertifikat);
        $qrcode = base64_encode(QrCode::format('png')->size(100)->generate(url("administrasi/sertifikat/baptis/$sertifikat_baptis->sertifikat_baptis_id/print-view")));

        $data = [
            'sertifikat'            => $sertifikat,
            'sertifikat_baptis'     => $sertifikat_baptis,
            'qrcode'                => $qrcode
            // 'qrcode'                => ''
        ];
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadView('export.pdf.sertifikat.export-pdf-sertifikat-baptis', $data)->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return view('export.pdf.sertifikat.export-pdf-sertifikat-baptis', $data);
    }






































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_sertifikat_all()
    {
        $sertifikat = ModelsSertifikatBaptis::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->all();

        return response()->json([
            'status' => true,
            'data' => $sertifikat,
        ]);
    }
    public function api_sertifikat_detail($sertifikat_baptis_id)
    {
        $sertifikat = ModelsSertifikatBaptis::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->find($sertifikat_baptis_id);

        if (!$sertifikat) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $sertifikat,
            ]);
        }
    }
}
