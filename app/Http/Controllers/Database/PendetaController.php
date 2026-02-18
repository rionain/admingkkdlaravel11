<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Jemaat;
use App\Models\KategoriGereja;
use App\Models\KategoriPendeta;
use App\Models\Pendeta;
use App\Models\StatusJemaat;
use App\Models\SubCabang;
use Illuminate\Http\Request;

class PendetaController extends Controller
{
    public function pendeta()
    {
        $filter_cabang = request('filter_cabang');
        $filter_kategori_gereja = request('filter_kategori_gereja');
        // if ($filter_cabang && $filter_kategori_gereja) {
        //     $pendeta = Pendeta::where(['pendeta.deleted' => '0', 'lfk_cabang_id' => $filter_cabang])->join('cabang_header', 'pendeta.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('pendeta.created_date', 'DESC')->get();
        // } elseif ($filter_kategori_gereja) {
        //     $pendeta = Pendeta::where(['pendeta.deleted' => '0', 'lfk_kategori_gereja_id' => $filter_kategori_gereja])->join('cabang_header', 'pendeta.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('pendeta.created_date', 'DESC')->get();
        // } else {
        //     $pendeta = Pendeta::where(['pendeta.deleted' => '0'])->join('cabang_header', 'pendeta.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('pendeta.created_date', 'DESC')->get();
        // }
        if ($filter_cabang && $filter_kategori_gereja) {
            $pendeta = Jemaat::where(['jemaat.deleted' => '0', 'lfk_cabang_id' => $filter_cabang])->where('lfk_status_jemaat_id', '<', '6')->join('cabang_header', 'jemaat.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('jemaat.created_date', 'DESC')->get();
        } elseif ($filter_kategori_gereja) {
            $pendeta = Jemaat::where(['jemaat.deleted' => '0', 'lfk_kategori_gereja_id' => $filter_kategori_gereja])->where('lfk_status_jemaat_id', '<', '6')->join('cabang_header', 'jemaat.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('jemaat.created_date', 'DESC')->get();
        } else {
            $pendeta = Jemaat::where(['jemaat.deleted' => '0'])->where('lfk_status_jemaat_id', '<', '6')->join('cabang_header', 'jemaat.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('jemaat.created_date', 'DESC')->get();
        }

        $data = [
            'title'             => 'Pendeta',
            'menu_aktif'        => 'pendeta',
            'pendeta'           => $pendeta,
            'kategori_pendeta'  => KategoriPendeta::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'kategori_gereja'   => KategoriGereja::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'cabang'            => Cabang::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'sub_cabang'        => SubCabang::where(['deleted' => '0', 'active' => 1])->orderBy('created_date', 'DESC')->get(),
            'status_jemaat'     => StatusJemaat::where(['active' => 1, 'deleted' => '0'])->where('status_jemaat_id', '<=', '5')->orderBy('status_jemaat', 'ASC')->get(),
            'cabang_input'      => Cabang::where(['active' => 1, 'deleted' => '0'])->get()
        ];

        return view('database.database-pendeta', $data);
    }

    public function tambah_pendeta()
    {
        validator(request()->all(), [
            'lfk_kategori_pendeta_id'   => 'required',
            'nama_pendeta'              => 'required',
            'no_sk'                     => 'required',
            'jenis_kelamin'             => 'required',
            'lfk_kategori_gereja_id'    => 'required',
            'lfk_cabang_id'             => 'required',
            'lfk_cabang_id'         => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'alamat'                    => '',
            'status_pernikahan'         => '',
            'nama_istri_suami'          => '',
            'karunia'                   => '',
            'pendidikan_formal'         => '',
            'pendidikan_non_formal'     => '',
            'jumlah_anak'               => '',
            'pekerjaan'                 => '',
        ]);

        $pendeta = new Pendeta;
        $pendeta->lfk_kategori_pendeta_id   = request('lfk_kategori_pendeta_id');
        $pendeta->nama_pendeta              = request('nama_pendeta');
        $pendeta->no_sk                     = request('no_sk');
        $pendeta->jenis_kelamin             = request('jenis_kelamin');
        $pendeta->lfk_cabang_id         = request('lfk_cabang_id');
        $pendeta->tempat_lahir              = request('tempat_lahir');
        $pendeta->tanggal_lahir             = request('tanggal_lahir');
        $pendeta->alamat                    = request('alamat');
        $pendeta->status_pernikahan         = request('status_pernikahan');
        $pendeta->nama_istri_suami          = request('nama_istri_suami');
        $pendeta->karunia                   = request('karunia');
        $pendeta->pendidikan_formal         = request('pendidikan_formal');
        $pendeta->pendidikan_non_formal     = request('pendidikan_non_formal');
        $pendeta->jumlah_anak               = request('jumlah_anak');
        $pendeta->pekerjaan                 = request('pekerjaan');
        $cek = $pendeta->save();
        if ($cek) {
            return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal ditambahkan');
        }
    }

    public function edit_pendeta($pendeta_id)
    {
        $pendeta = Pendeta::where(['pendeta_id' => $pendeta_id, 'deleted' => '0'])->first();
        if (!$pendeta) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        validator(request()->all(), [
            'lfk_kategori_pendeta_id'   => 'required',
            'nama_pendeta'              => 'required',
            'no_sk'                     => 'required',
            'jenis_kelamin'             => 'required',
            'lfk_kategori_gereja_id'    => 'required',
            'lfk_cabang_id'             => 'required',
            'lfk_cabang_id'         => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'alamat'                    => '',
            'status_pernikahan'         => '',
            'nama_istri_suami'          => '',
            'karunia'                   => '',
            'pendidikan_formal'         => '',
            'pendidikan_non_formal'     => '',
            'jumlah_anak'               => '',
            'pekerjaan'                 => '',
        ]);

        $pendeta->lfk_kategori_pendeta_id   = request('lfk_kategori_pendeta_id');
        $pendeta->nama_pendeta              = request('nama_pendeta');
        $pendeta->no_sk                     = request('no_sk');
        $pendeta->jenis_kelamin             = request('jenis_kelamin');
        $pendeta->lfk_cabang_id         = request('lfk_cabang_id');
        $pendeta->tempat_lahir              = request('tempat_lahir');
        $pendeta->tanggal_lahir             = request('tanggal_lahir');
        $pendeta->alamat                    = request('alamat');
        $pendeta->status_pernikahan         = request('status_pernikahan');
        $pendeta->nama_istri_suami          = request('nama_istri_suami');
        $pendeta->karunia                   = request('karunia');
        $pendeta->pendidikan_formal         = request('pendidikan_formal');
        $pendeta->pendidikan_non_formal     = request('pendidikan_non_formal');
        $pendeta->jumlah_anak               = request('jumlah_anak');
        $pendeta->pekerjaan                 = request('pekerjaan');
        $cek = $pendeta->save();
        if ($cek) {
            return redirect()->back()->with('berhasil', 'Data berhasil diubah');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
    }

    public function hapus_pendeta($pendeta_id)
    {
        $pendeta = Pendeta::where(['pendeta_id' => $pendeta_id, 'deleted' => '0'])->first();

        if (!$pendeta) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $pendeta->deleted = 1;
        $cek = $pendeta->save();
        if ($cek) {
            return redirect()->back()->with('berhasil', 'Data berhasil diubah');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal diubah');
        }
    }







































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_all()
    {
        $pendeta = Pendeta::where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with(['kategori_gereja']);
        }, 'kategori_pendeta'])->get();

        return response()->json([
            'status' => true,
            'data' => $pendeta,
        ]);
    }
    public function api_detail($pendeta_id)
    {
        $pendeta = Pendeta::where('pendeta_id', $pendeta_id)->where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with(['kategori_gereja']);
        }, 'kategori_pendeta'])->first();

        if (!$pendeta) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $pendeta,
            ]);
        }
    }
}
