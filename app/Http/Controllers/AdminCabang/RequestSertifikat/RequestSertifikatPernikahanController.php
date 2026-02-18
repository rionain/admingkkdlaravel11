<?php

namespace App\Http\Controllers\AdminCabang\RequestSertifikat;

use App\Http\Controllers\Controller;
use App\Models\SertifikatPernikahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RequestSertifikatPernikahanController extends Controller
{
    public function list()
    {
        $sertifikat = SertifikatPernikahan::where('lfk_cabang_id', auth()->user()->lfk_cabang_id)->orderBy('created_date', 'desc')->get();
        $data = [
            'title'             => 'Sertifikat',
            'menu_aktif'        => 'sertifikat_pernikahan',
            'sertifikat'        => $sertifikat,
        ];
        return view('admin-cabang.request-sertifiikat.sertifikat-pernikahan', $data);
    }

    public function tambah(Request $request)
    {
        validator($request->all())->validate([
            // 'nama_jemaat'                           => 'required',
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
            'jenis_sertifikat_pernikahan'           => 'required',
            'nama_saksi1'                           => 'required',
            'nama_saksi2'                           => 'required',
        ]);

        $sertifikat = new SertifikatPernikahan;
        // $sertifikat->nama_jemaat                            = $request->nama_jemaat;
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
        $sertifikat->lfk_cabang_id                          = auth()->user()->lfk_cabang_id;
        $sertifikat->lfk_status_sertifikat_id               = 1;
        $sertifikat->jenis_sertifikat_pernikahan            = $request->jenis_sertifikat_pernikahan;
        $sertifikat->nama_saksi1                            = $request->nama_saksi1;
        $sertifikat->nama_saksi2                            = $request->nama_saksi2;

        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/sertifikat/foto_pernikahan-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file foto');
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
        validator($request->all())->validate([
            // 'nama_jemaat'                        => 'required',
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
            'jenis_sertifikat_pernikahan'           => 'required',
            'nama_saksi1'                           => 'required',
            'nama_saksi2'                           => 'required',
        ]);
        $sertifikat = SertifikatPernikahan::find($sertifikat_pernikahan_id);
        if (!$sertifikat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $sertifikat->nama_jemaat                            = $request->nama_jemaat;
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
        $sertifikat->lfk_status_sertifikat_id               = 1;
        $sertifikat->jenis_sertifikat_pernikahan            = $request->jenis_sertifikat_pernikahan;
        $sertifikat->nama_pendeta                           = $request->nama_pendeta;
        $sertifikat->nama_saksi1                            = $request->nama_saksi1;
        $sertifikat->nama_saksi2                            = $request->nama_saksi2;

        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/sertifikat/foto_pernikahan-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

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
}
