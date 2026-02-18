<?php

namespace App\Http\Controllers\Kehadiran;

use App\Http\Controllers\Controller;
use App\Models\AnakPA;
use App\Models\Cabang;
use App\Models\Ibadah;
use App\Models\IbadahDetail;
use App\Models\KakakPA;
use App\Models\KategoriGereja;
use App\Models\SubCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KehadiranIbadahController extends Controller
{
    public function ibadah()
    {
        $filter_cabang = request('filter_cabang');
        $filter_kategori_gereja = request('filter_kategori_gereja');
        $tgl_awal = request('tgl_awal') ? format_date(request('tgl_awal')) : null;
        $tgl_akhir = request('tgl_akhir') ? format_date(request('tgl_akhir')) : null;

        $where = ['ibadah_header.deleted' => '0', 'ibadah_detail.deleted' => '0'];

        if ($filter_cabang && $filter_kategori_gereja) {
            $where['lfk_cabang_id'] = $filter_cabang;
        } elseif ($filter_kategori_gereja) {
            $where['lfk_kategori_gereja_id'] = $filter_kategori_gereja;
        }

        if ($tgl_awal && $tgl_akhir) {
            array_push($where, ['tanggal', '>=', "$tgl_awal"]);
            array_push($where, ['tanggal', '<=', "$tgl_akhir"]);
        } elseif ($tgl_awal) {
            array_push($where, ['tanggal', '>=', "$tgl_awal"]);
        }

        // return IbadahDetail::where($where)
        //     ->join('ibadah_header', 'ibadah_detail.lfk_ibadah_id', '=', 'ibadah_header.ibadah_id')
        //     ->join('cabang_header', 'ibadah_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
        //     ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
        //     ->orderBy('ibadah_detail.created_date', 'DESC')->toSql();

        $data = [
            'title'             => 'Kehadiran Ibadah',
            'menu_aktif'        => 'kehadiran_ibadah',
            'cabang'            => Cabang::where(['active' => 1, 'deleted' => '0'])->get(),
            'kehadiran'         => IbadahDetail::where($where)
                ->join('ibadah_header', 'ibadah_detail.lfk_ibadah_id', '=', 'ibadah_header.ibadah_id')
                ->join('cabang_header', 'ibadah_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
                ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
                ->orderBy('ibadah_detail.created_date', 'DESC')->get(),
            'ibadah'            => Ibadah::where(['ibadah_status' => 1, 'active' => 1, 'deleted' => '0'])->get(),
            'kakak_pa'          => KakakPA::where(['active' => 1, 'deleted' => '0'])->get(),
            'anak_pa'           => AnakPA::where(['active' => 1, 'deleted' => '0'])->get(),
            'kategori_gereja' => KategoriGereja::where(['deleted' => '0', 'active' => 1])->get(),
            'sub_cabang' => SubCabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];

        return view('kehadiran.kehadiran-ibadah', $data);
    }

    public function detailibadah(Request $request)
    {
    }

    public function tambah_ibadah()
    {
        $value = (object) request()->validate([
            'lfk_ibadah_id'         => 'required',
            'jumlah_pria'           => 'required',
            'jumlah_wanita'         => 'required',
            'jumlah_pria_baru'      => 'required',
            'jumlah_wanita_baru'    => 'required',
            'persembahan'           => 'required',
            'catatan'               => '',
            'jumlah_pendeta'        => '',
            'jumlah_pendeta_muda'   => '',
            'jumlah_evangelis'      => '',
            'tempat_ibadah'         => 'required',
            'tanggal'               => 'required',
        ]);
        $ibadah_detail = new IbadahDetail;

        $ibadah_detail->lfk_ibadah_id       = $value->lfk_ibadah_id;
        $ibadah_detail->jumlah_pria         = $value->jumlah_pria;
        $ibadah_detail->jumlah_wanita       = $value->jumlah_wanita;
        $ibadah_detail->jumlah_pria_baru    = $value->jumlah_pria_baru;
        $ibadah_detail->jumlah_wanita_baru  = $value->jumlah_wanita_baru;
        $ibadah_detail->persembahan                = $value->persembahan;
        $ibadah_detail->catatan             = $value->catatan;
        $ibadah_detail->jumlah_pendeta      = $value->jumlah_pendeta;
        $ibadah_detail->jumlah_pendeta_muda = $value->jumlah_pendeta_muda;
        $ibadah_detail->jumlah_evangelis    = $value->jumlah_evangelis;
        $ibadah_detail->tempat_ibadah       = $value->tempat_ibadah;
        $ibadah_detail->tanggal             = $value->tanggal;

        $cek = $ibadah_detail->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data');
    }
    public function edit_ibadah($ibadah_detail_id)
    {
        $ibadah_detail = IbadahDetail::where(['ibadah_detail_id' => $ibadah_detail_id, 'deleted' => '0'])->first();
        if (!$ibadah_detail) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $value = (object) request()->validate([
            'tanggal'               => 'required',
            'lfk_ibadah_id'         => 'required',
            'jumlah_pria'           => 'required',
            'jumlah_wanita'         => 'required',
            'jumlah_pria_baru'      => 'required',
            'jumlah_wanita_baru'    => 'required',
            'persembahan'           => 'required',
            'catatan'               => '',
            'jumlah_pendeta'        => '',
            'jumlah_pendeta_muda'   => '',
            'jumlah_evangelis'      => '',
            'tempat_ibadah'         => 'required',
        ]);

        $ibadah_detail->lfk_ibadah_id       = $value->lfk_ibadah_id;
        $ibadah_detail->jumlah_pria         = $value->jumlah_pria;
        $ibadah_detail->jumlah_wanita       = $value->jumlah_wanita;
        $ibadah_detail->jumlah_pria_baru    = $value->jumlah_pria_baru;
        $ibadah_detail->jumlah_wanita_baru  = $value->jumlah_wanita_baru;
        $ibadah_detail->persembahan         = $value->persembahan;
        $ibadah_detail->catatan             = $value->catatan;
        $ibadah_detail->tanggal             = $value->tanggal;
        $ibadah_detail->jumlah_pendeta      = $value->jumlah_pendeta;
        $ibadah_detail->jumlah_pendeta_muda = $value->jumlah_pendeta_muda;
        $ibadah_detail->jumlah_evangelis    = $value->jumlah_evangelis;
        $ibadah_detail->tempat_ibadah       = $value->tempat_ibadah;

        $cek = $ibadah_detail->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_ibadah($ibadah_detail_id = null)
    {
        if ($ibadah_detail_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $ibadah_detail = IbadahDetail::where('ibadah_detail_id', $ibadah_detail_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$ibadah_detail) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $ibadah_detail->deleted = 1;
        $cek = $ibadah_detail->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }













































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function api_ibadah_all()
    {
        $ibadah = IbadahDetail::with(['ibadah' => function ($join) {
            $join->with(['cabang' => function ($join) {
                $join->with('kategori_gereja');
            }]);
        }, 'kakak_pa'])->where(['deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $ibadah,
        ]);
    }
    public function api_ibadah_detail($ibadah_detail_id)
    {
        $ibadah = IbadahDetail::with(['ibadah' => function ($join) {
            $join->with(['cabang' => function ($join) {
                $join->with('kategori_gereja');
            }]);
        }, 'kakak_pa'])->where('ibadah_detail_id', $ibadah_detail_id)->where(['deleted' => '0'])->first();

        if (!$ibadah) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $ibadah,
            ]);
        }
    }
}
