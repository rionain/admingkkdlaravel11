<?php

namespace App\Http\Controllers\AdminCabang\Database;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Jemaat;
use App\Models\KategoriGereja;
use App\Models\KategoriPendeta;
use App\Models\Pendeta;
use App\Models\StatusJemaat;
use App\Models\SubCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendetaController extends Controller
{
    public function pendeta()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        // $pendeta = Pendeta::where(['pendeta.deleted' => '0', 'lfk_cabang_id' => auth()->user()->lfk_cabang_id])->orderBy('pendeta.created_date', 'DESC')->get();
        $pendeta = Jemaat::where(['jemaat.deleted' => '0', 'lfk_cabang_id' => $subcabangid])->where('lfk_status_jemaat_id', '<', '6')->join('cabang_header', 'jemaat.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('jemaat.created_date', 'DESC')->get();

        $cabang_input       = Cabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $kategori_gereja    = KategoriGereja::where(['deleted' => '0', 'active' => 1])->get();
        $sub_cabang         = SubCabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $status_jemaat      = StatusJemaat::where(['active' => 1, 'deleted' => '0'])->where('status_jemaat_id', '<=', '5')->orderBy('status_jemaat', 'ASC')->get();


        $data = [
            'title'             => 'Pendeta',
            'menu_aktif'        => 'pendeta',
            'pendeta'           => $pendeta,
            'kategori_pendeta'  => KategoriPendeta::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'kategori_gereja'   => KategoriGereja::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'cabang'            => Cabang::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'sub_cabang'        => SubCabang::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'status_jemaat'     => $status_jemaat,
        ];

        return view('admin-cabang.database.database-pendeta', $data);
    }

    public function tambah_pendeta(Request $request)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        validator(request()->all(), [
            'nama'                      => 'required',
            'pekerjaan'                 => 'required',
            'jenis_kelamin'             => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'no_hp'                     => 'required',
            'email'                     => 'required',
            'pendidikan_formal'         => '',
            'pendidikan_non_formal'     => '',
            'status_pernikahan'         => '',
            'alamat'                    => '',
            'keterampilan'              => '',
            'lfk_status_jemaat_id'      => 'required',
            'no_sk'                     => '',
            'jumlah_anak'               => '',
            'nama_pasangan'             => '',
            'karunia'                   => '',
        ]);

        $jemaat = new Jemaat;
        $jemaat->nama                       = request('nama');
        $jemaat->pekerjaan                  = request('pekerjaan');
        $jemaat->lfk_cabang_id              = $subcabangid;
        $jemaat->jenis_kelamin              = request('jenis_kelamin');
        $jemaat->tempat_lahir               = request('tempat_lahir');
        $jemaat->tanggal_lahir              = request('tanggal_lahir');
        $jemaat->no_hp                      = request('no_hp');
        $jemaat->email                      = request('email');
        $jemaat->alamat                     = request('alamat');
        $jemaat->pendidikan_formal          = request('pendidikan_formal');
        $jemaat->pendidikan_non_formal      = request('pendidikan_non_formal');
        $jemaat->status_pernikahan          = request('status_pernikahan');
        $jemaat->keterampilan               = request('keterampilan');
        $jemaat->lfk_status_jemaat_id       = request('lfk_status_jemaat_id');
        $jemaat->no_sk                      = request('no_sk');
        $jemaat->jumlah_anak                = request('jumlah_anak');
        $jemaat->nama_pasangan              = request('nama_pasangan');
        $jemaat->karunia                    = request('karunia');

        $cek = $jemaat->save();
        if ($cek) {
            return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal ditambahkan');
        }
    }

    public function edit_pendeta($pendeta_id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        $jemaat = Jemaat::where(['jemaat_id' => $pendeta_id, 'deleted' => '0'])->first();
        if (!$jemaat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        validator(request()->all(), [
            'nama'                      => 'required',
            'pekerjaan'                 => 'required',
            'jenis_kelamin'             => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'no_hp'                     => 'required',
            'email'                     => 'required',
            'pendidikan_formal'         => '',
            'pendidikan_non_formal'     => '',
            'status_pernikahan'         => '',
            'keterampilan'              => '',
            'alamat'                    => '',
            'lfk_status_jemaat_id'      => 'required',
            'no_sk'                     => '',
            'jumlah_anak'               => '',
            'nama_pasangan'             => '',
            'karunia'                   => '',
        ]);

        $jemaat->nama                       = request('nama');
        $jemaat->pekerjaan                  = request('pekerjaan');
        $jemaat->lfk_cabang_id              = $subcabangid;
        $jemaat->jenis_kelamin              = request('jenis_kelamin');
        $jemaat->tempat_lahir               = request('tempat_lahir');
        $jemaat->tanggal_lahir              = request('tanggal_lahir');
        $jemaat->no_hp                      = request('no_hp');
        $jemaat->email                      = request('email');
        $jemaat->alamat                     = request('alamat');
        $jemaat->pendidikan_formal          = request('pendidikan_formal');
        $jemaat->pendidikan_non_formal      = request('pendidikan_non_formal');
        $jemaat->status_pernikahan          = request('status_pernikahan');
        $jemaat->keterampilan               = request('keterampilan');
        $jemaat->lfk_status_jemaat_id       = request('lfk_status_jemaat_id');
        $jemaat->no_sk                      = request('no_sk');
        $jemaat->jumlah_anak                = request('jumlah_anak');
        $jemaat->nama_pasangan              = request('nama_pasangan');
        $jemaat->karunia                    = request('karunia');
        $cek = $jemaat->save();
        if ($cek) {
            return redirect()->back()->with('berhasil', 'Data berhasil diubah');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
    }

    public function hapus_jemaat($pendeta_id)
    {
        $jemaat = Jemaat::where(['jemaat_id' => $pendeta_id, 'deleted' => '0'])->first();

        if (!$jemaat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $jemaat->deleted = 1;
        $cek = $jemaat->save();
        if ($cek) {
            return redirect()->back()->with('berhasil', 'Data berhasil diubah');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
    }

    public function api_detail($jemaat_id)
    {
        $jemaat = Jemaat::where('jemaat_id', $jemaat_id)->where(['deleted' => '0'])->with(['cabang' => function ($query) {
            $query->with('kategori_gereja');
        }, 'status_jemaat'])->first();

        if (!$jemaat) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $jemaat,
            ]);
        }
    }
}
