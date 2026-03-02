<?php

namespace App\Http\Controllers\Administrasi\Sertifikat;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\KategoriGereja;
use App\Models\PengaturanSertifikatPernikahan;
use App\Models\SertifikatPernikahan;
use App\Models\StatusSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use S3Helper;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SertifikatPernikahanController extends Controller
{
    public function list()
    {
        $sertifikat         = SertifikatPernikahan::orderBy('created_date', 'DESC')->get();
        $status_sertifikat  = StatusSertifikat::where(['deleted' => '0', 'active' => 1])->get();
        $kategori_gereja    = KategoriGereja::where(['deleted' => '0', 'active' => 1])->get();
        $cabang             = Cabang::where(['deleted' => '0', 'active' => 1])->get();

        $data = [
            'title'             => 'Sertifikat',
            'menu_aktif'        => 'sertifikat_pernikahan',
            'sertifikat'        => $sertifikat,
            'status_sertifikat' => $status_sertifikat,
            'kategori_gereja'   => $kategori_gereja,
            'cabang'            => $cabang,
        ];
        return view('administrasi.sertifikat.sertifikat-pernikahan', $data);
    }

    public function tambah(Request $request)
    {
        // Debugging: Log the request data and file sizes
        $fileFields = ['foto', 'tanda_tangan_pengantin_pria', 'tanda_tangan_pengantin_wanita', 'tanda_tangan_pendeta', 'tanda_tangan_saksi1', 'tanda_tangan_saksi2'];
        \Log::info('SertifikatPernikahan@tambah request data:', $request->except($fileFields));
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                \Log::info("File $field: size=" . $file->getSize() . " error=" . $file->getError() . " isValid=" . ($file->isValid() ? 'yes' : 'no'));
            } else {
                \Log::info("File $field missing or invalid");
            }
        }

        $request->validate([
            'tanggal_pernikahan'                    => 'required|date',
            'tempat_pernikahan'                     => 'required',
            'nama_pasangan_pria'                    => 'required',
            'tempat_lahir_pasangan_pria'            => 'required',
            'tanggal_lahir_pasangan_pria'           => 'required|date',
            'tanggal_lahir_baru_pasangan_pria'      => 'required|date',
            'tanggal_baptis_pasangan_pria'          => 'required|date',
            'nama_pasangan_wanita'                  => 'required',
            'tempat_lahir_pasangan_wanita'          => 'required',
            'tanggal_lahir_pasangan_wanita'         => 'required|date',
            'tanggal_lahir_baru_pasangan_wanita'    => 'required|date',
            'tanggal_baptis_pasangan_wanita'        => 'required|date',
            'nama_pendeta'                          => 'required',
            'nama_saksi1'                           => 'required',
            'nama_saksi2'                           => 'required',
            'lfk_status_sertifikat_id'              => 'required',
            'alasan_demote'                         => 'nullable',
            'lfk_cabang_id'                         => 'required',
            'no_sertifikat'                         => 'required',
            'jenis_sertifikat_pernikahan'           => 'required',
            'foto'                                  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_pengantin_pria'           => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_pengantin_wanita'         => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_pendeta'                  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_saksi1'                   => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_saksi2'                   => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);



        $sertifikat = new SertifikatPernikahan;
        $sertifikat->tanggal_pernikahan                     = $request->tanggal_pernikahan;
        $sertifikat->tempat_pernikahan                      = $request->tempat_pernikahan;
        $sertifikat->nama_pasangan_pria                     = $request->nama_pasangan_pria;
        $sertifikat->tempat_lahir_pasangan_pria             = $request->tempat_lahir_pasangan_pria;
        $sertifikat->tanggal_lahir_pasangan_pria            = $request->tanggal_lahir_pasangan_pria;
        $sertifikat->tanggal_lahir_baru_pasangan_pria       = $request->tanggal_lahir_baru_pasangan_pria;
        $sertifikat->tanggal_baptis_pasangan_pria           = $request->tanggal_baptis_pasangan_pria;
        $sertifikat->nama_pasangan_wanita                   = $request->nama_pasangan_wanita;
        $sertifikat->tempat_lahir_pasangan_wanita           = $request->tempat_lahir_pasangan_wanita;
        $sertifikat->tanggal_lahir_pasangan_wanita          = $request->tanggal_lahir_pasangan_wanita;
        $sertifikat->tanggal_lahir_baru_pasangan_wanita     = $request->tanggal_lahir_baru_pasangan_wanita;
        $sertifikat->tanggal_baptis_pasangan_wanita         = $request->tanggal_baptis_pasangan_wanita;
        $sertifikat->nama_pendeta                           = $request->nama_pendeta;
        $sertifikat->nama_saksi1                            = $request->nama_saksi1;
        $sertifikat->nama_saksi2                            = $request->nama_saksi2;
        $sertifikat->lfk_status_sertifikat_id               = $request->lfk_status_sertifikat_id;
        $sertifikat->alasan_demote                          = $request->alasan_demote;
        $sertifikat->lfk_cabang_id                          = $request->lfk_cabang_id;
        $sertifikat->no_sertifikat                          = $request->no_sertifikat;
        $sertifikat->jenis_sertifikat_pernikahan            = $request->jenis_sertifikat_pernikahan;

        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/sertifikat/foto_jemaat-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto = $filename;
        } else {
            $sertifikat->foto = '';
        }

        if (request()->hasFile('tanda_tangan_pengantin_pria')) {
            $file = request()->file('tanda_tangan_pengantin_pria');
            $filename = '/sertifikat/tanda_tangan_pengantin_pria-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file TTD pria');
            }
            $sertifikat->tanda_tangan_pengantin_pria = $filename;
        } else {
            $sertifikat->tanda_tangan_pengantin_pria = '';
        }

        if (request()->hasFile('tanda_tangan_pengantin_wanita')) {
            $file = request()->file('tanda_tangan_pengantin_wanita');
            $filename = '/sertifikat/tanda_tangan_pengantin_wanita-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file TTD wanita');
            }
            $sertifikat->tanda_tangan_pengantin_wanita = $filename;
        } else {
            $sertifikat->tanda_tangan_pengantin_wanita = '';
        }

        if (request()->hasFile('tanda_tangan_pendeta')) {
            $file = request()->file('tanda_tangan_pendeta');
            $filename = '/sertifikat/tanda_tangan_pendeta-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file TTD pendeta');
            }
            $sertifikat->tanda_tangan_pendeta = $filename;
        } else {
            $sertifikat->tanda_tangan_pendeta = '';
        }

        if (request()->hasFile('tanda_tangan_saksi1')) {
            $file = request()->file('tanda_tangan_saksi1');
            $filename = '/sertifikat/tanda_tangan_saksi1-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file TTD saksi 1');
            }
            $sertifikat->tanda_tangan_saksi1 = $filename;
        } else {
            $sertifikat->tanda_tangan_saksi1 = '';
        }

        if (request()->hasFile('tanda_tangan_saksi2')) {
            $file = request()->file('tanda_tangan_saksi2');
            $filename = '/sertifikat/tanda_tangan_saksi2-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file TTD saksi 2');
            }
            $sertifikat->tanda_tangan_saksi2 = $filename;
        } else {
            $sertifikat->tanda_tangan_saksi2 = '';
        }

        $cek = $sertifikat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal ditambahkan');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $sertifikat_pernikahan_id)
    {
        // Debugging: Log the request data and file sizes
        $fileFields = ['foto', 'tanda_tangan_pengantin_pria', 'tanda_tangan_pengantin_wanita', 'tanda_tangan_pendeta', 'tanda_tangan_saksi1', 'tanda_tangan_saksi2'];
        \Log::info('SertifikatPernikahan@edit request data:', $request->except($fileFields));
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                \Log::info("File $field: size=" . $file->getSize() . " error=" . $file->getError() . " isValid=" . ($file->isValid() ? 'yes' : 'no'));
            } else {
                \Log::info("File $field missing or invalid");
            }
        }

        $request->validate([
            'tanggal_pernikahan'                    => 'required|date',
            'tempat_pernikahan'                     => 'required',
            'nama_pasangan_pria'                    => 'required',
            'tempat_lahir_pasangan_pria'            => 'required',
            'tanggal_lahir_pasangan_pria'           => 'required|date',
            'tanggal_lahir_baru_pasangan_pria'      => 'required|date',
            'tanggal_baptis_pasangan_pria'          => 'required|date',
            'nama_pasangan_wanita'                  => 'required',
            'tempat_lahir_pasangan_wanita'          => 'required',
            'tanggal_lahir_pasangan_wanita'         => 'required|date',
            'tanggal_lahir_baru_pasangan_wanita'    => 'required|date',
            'tanggal_baptis_pasangan_wanita'        => 'required|date',
            'nama_pendeta'                          => 'required',
            'lfk_status_sertifikat_id'              => 'required',
            'alasan_demote'                         => 'nullable',
            'lfk_cabang_id'                         => 'required',
            'no_sertifikat'                         => 'required',
            'jenis_sertifikat_pernikahan'           => 'required',
            'foto'                                  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_pengantin_pria'           => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_pengantin_wanita'         => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_pendeta'                  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_saksi1'                   => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tanda_tangan_saksi2'                   => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $sertifikat = SertifikatPernikahan::find($sertifikat_pernikahan_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $sertifikat->tanggal_pernikahan                     = $request->tanggal_pernikahan;
        $sertifikat->tempat_pernikahan                      = $request->tempat_pernikahan;
        $sertifikat->nama_pasangan_pria                     = $request->nama_pasangan_pria;
        $sertifikat->tempat_lahir_pasangan_pria             = $request->tempat_lahir_pasangan_pria;
        $sertifikat->tanggal_lahir_pasangan_pria            = $request->tanggal_lahir_pasangan_pria;
        $sertifikat->tanggal_lahir_baru_pasangan_pria       = $request->tanggal_lahir_baru_pasangan_pria;
        $sertifikat->tanggal_baptis_pasangan_pria           = $request->tanggal_baptis_pasangan_pria;
        $sertifikat->nama_pasangan_wanita                   = $request->nama_pasangan_wanita;
        $sertifikat->tempat_lahir_pasangan_wanita           = $request->tempat_lahir_pasangan_wanita;
        $sertifikat->tanggal_lahir_pasangan_wanita          = $request->tanggal_lahir_pasangan_wanita;
        $sertifikat->tanggal_lahir_baru_pasangan_wanita     = $request->tanggal_lahir_baru_pasangan_wanita;
        $sertifikat->tanggal_baptis_pasangan_wanita         = $request->tanggal_baptis_pasangan_wanita;
        $sertifikat->nama_pendeta                           = $request->nama_pendeta;
        $sertifikat->nama_saksi1                            = $request->nama_saksi1;
        $sertifikat->nama_saksi2                            = $request->nama_saksi2;
        $sertifikat->lfk_status_sertifikat_id               = $request->lfk_status_sertifikat_id;
        $sertifikat->alasan_demote                          = $request->alasan_demote;
        $sertifikat->lfk_cabang_id                          = $request->lfk_cabang_id;
        $sertifikat->no_sertifikat                          = $request->no_sertifikat;
        $sertifikat->jenis_sertifikat_pernikahan            = $request->jenis_sertifikat_pernikahan;

        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/sertifikat/foto_jemaat-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->foto = $filename;
        }

        if (request()->hasFile('tanda_tangan_pengantin_pria')) {
            $file = request()->file('tanda_tangan_pengantin_pria');
            $filename = '/sertifikat/tanda_tangan_pengantin_pria-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->tanda_tangan_pengantin_pria = $filename;
        }

        if (request()->hasFile('tanda_tangan_pengantin_wanita')) {
            $file = request()->file('tanda_tangan_pengantin_wanita');
            $filename = '/sertifikat/tanda_tangan_pengantin_wanita-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->tanda_tangan_pengantin_wanita = $filename;
        }

        if (request()->hasFile('tanda_tangan_pendeta')) {
            $file = request()->file('tanda_tangan_pendeta');
            $filename = '/sertifikat/tanda_tangan_pendeta-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->tanda_tangan_pendeta = $filename;
        }

        if (request()->hasFile('tanda_tangan_saksi1')) {
            $file = request()->file('tanda_tangan_saksi1');
            $filename = '/sertifikat/tanda_tangan_saksi1-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->tanda_tangan_saksi1 = $filename;
        }

        if (request()->hasFile('tanda_tangan_saksi2')) {
            $file = request()->file('tanda_tangan_saksi2');
            $filename = '/sertifikat/tanda_tangan_saksi2-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            $sertifikat->tanda_tangan_saksi2 = $filename;
        }

        $cek = $sertifikat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil diubah');
    }

    public function hapus($sertifikat_pernikahan_id)
    {
        $sertifikat = SertifikatPernikahan::find($sertifikat_pernikahan_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $cek = $sertifikat->delete();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Data gagal dihapus');
        }
        return redirect()->back()->with('berhasil', 'Data berhasil dihapus');
    }

    public function print_view($sertifikat_pernikahan_id)
    {
        $sertifikat = PengaturanSertifikatPernikahan::firstOrCreate([
            'pengaturan_sertifikat_pernikahan_id' => 1,
        ]);
        $sertifikat_pernikahan = SertifikatPernikahan::find($sertifikat_pernikahan_id);

        // @S3Helper::saveAs($sertifikat->logo_header, $sertifikat->logo_header);
        // @S3Helper::saveAs($sertifikat->foto_kanan, $sertifikat->foto_kanan);
        // @S3Helper::saveAs($sertifikat_pernikahan->foto, $sertifikat_pernikahan->foto);
        // @S3Helper::saveAs($sertifikat_pernikahan->tanda_tangan_pengantin_pria, $sertifikat_pernikahan->tanda_tangan_pengantin_pria);
        // @S3Helper::saveAs($sertifikat_pernikahan->tanda_tangan_pengantin_wanita, $sertifikat_pernikahan->tanda_tangan_pengantin_wanita);
        // @S3Helper::saveAs($sertifikat_pernikahan->tanda_tangan_pendeta, $sertifikat_pernikahan->tanda_tangan_pendeta);
        // @S3Helper::saveAs($sertifikat_pernikahan->tanda_tangan_saksi1, $sertifikat_pernikahan->tanda_tangan_saksi1);
        // @S3Helper::saveAs($sertifikat_pernikahan->tanda_tangan_saksi2, $sertifikat_pernikahan->tanda_tangan_saksi2);

        $qrcode = base64_encode(QrCode::format('png')->size(100)->generate(url("administrasi/sertifikat/pernikahan/$sertifikat_pernikahan->sertifikat_pernikahan_id/print-view")));

        $data = [
            'sertifikat'                => $sertifikat,
            'sertifikat_pernikahan'     => $sertifikat_pernikahan,
            'qrcode'                    => $qrcode,
            // 'qrcode'                    => '',
        ];
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadView('export.pdf.sertifikat.export-pdf-sertifikat-pernikahan', $data)->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return view('export.pdf.sertifikat.export-pdf-sertifikat-pernikahan', $data);
    }






































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_sertifikat_all()
    {
        $proposal_doa = SertifikatPernikahan::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->all();

        return response()->json([
            'status' => true,
            'data' => $proposal_doa,
        ]);
    }
    public function api_sertifikat_detail($sertifikat_pernikahan_id)
    {
        $proposal_doa = SertifikatPernikahan::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->find($sertifikat_pernikahan_id);

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
