<?php

namespace App\Http\Controllers\AdminCabang\Kehadiran;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\KategoriGereja;
use App\Models\Komsel;
use App\Models\KomselDetail;
use App\Models\SubCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCabangKehadiranKomselController extends Controller
{
    public function komsel()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        $tgl_awal = request('tgl_awal') ? format_date(request('tgl_awal')) : null;
        $tgl_akhir = request('tgl_akhir') ? format_date(request('tgl_akhir')) : null;

        $where = ['komsel_header.deleted' => '0', 'komsel_detail.deleted' => '0'];

        if ($tgl_awal && $tgl_akhir) {
            array_push($where, ['komsel_date', '>=', "$tgl_awal"]);
            array_push($where, ['komsel_date', '<=', "$tgl_akhir"]);
        } elseif ($tgl_awal) {
            array_push($where, ['komsel_date', '>=', "$tgl_awal"]);
        }

        $data = [
            'title'             => 'Kehadiran Komsel',
            'menu_aktif'        => 'kehadiran_komsel',
            'kehadiran'         => KomselDetail::where($where)
                ->select('*', 'komsel_detail.*')
                ->join('komsel_header', 'komsel_detail.lfk_komsel_id', '=', 'komsel_header.komsel_id')
                ->where('komsel_header.lfk_cabang_id', $subcabangid)
                ->orderBy('komsel_detail.created_date', 'DESC')->get(),
            'komsel'            => Komsel::where(['active' => 1, 'deleted' => '0', 'lfk_cabang_id' => $subcabangid])->get(),
            'cabang'            => Cabang::where(['active' => 1, 'deleted' => '0'])->get(),
            'kategori_gereja'   => KategoriGereja::where(['deleted' => '0', 'active' => 1])->get(),
            'sub_cabang'        => SubCabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];

        return view('admin-cabang.kehadiran.kehadiran-komsel', $data);
    }

    public function tambah_komsel(Request $request)
    {
        $value = (object) request()->validate([
            'lfk_komsel_id'         => 'required',
            'komsel_date'           => 'required',
            'jumlah_pria'           => '',
            'jumlah_wanita'         => '',
            'jumlah_pria_baru'      => '',
            'jumlah_wanita_baru'    => '',
            'catatan'               => '',
        ]);


        // $data = [
        //     'jumlah_pria'           => nullNumber($value->jumlah_pria),
        //     'jumlah_wanita'         => nullNumber($value->jumlah_wanita),
        //     'jumlah_pria_baru'      => nullNumber($value->jumlah_pria_baru),
        //     'jumlah_wanita_baru'    => nullNumber($value->jumlah_wanita_baru),
        // ];
        // return $data;

        $komsel = new KomselDetail;
        $komsel->lfk_komsel_id      = $value->lfk_komsel_id;
        $komsel->komsel_date        = $value->komsel_date;
        $komsel->jumlah_pria        = nullNumber($value->jumlah_pria);
        $komsel->jumlah_wanita      = nullNumber($value->jumlah_wanita);
        $komsel->jumlah_pria_baru   = nullNumber($value->jumlah_pria_baru);
        $komsel->jumlah_wanita_baru = nullNumber($value->jumlah_wanita_baru);
        $komsel->catatan            = $value->catatan;

        $cek = $komsel->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data');
    }

    public function edit_komsel($komsel_detail_id)
    {
        $komsel = KomselDetail::where('komsel_detail_id', $komsel_detail_id)->first();
        $value = (object) request()->validate([
            'lfk_komsel_id'     => 'required',
            'komsel_date'       => 'required',
            'jumlah_pria'           => '',
            'jumlah_wanita'         => '',
            'jumlah_pria_baru'      => '',
            'jumlah_wanita_baru'    => '',
            'catatan'               => '',
        ]);

        $komsel->lfk_komsel_id      = $value->lfk_komsel_id;
        $komsel->komsel_date        = $value->komsel_date;
        $komsel->jumlah_pria        = nullNumber($value->jumlah_pria);
        $komsel->jumlah_wanita      = nullNumber($value->jumlah_wanita);
        $komsel->jumlah_pria_baru   = nullNumber($value->jumlah_pria_baru);
        $komsel->jumlah_wanita_baru = nullNumber($value->jumlah_wanita_baru);
        $komsel->catatan            = $value->catatan;

        $cek = $komsel->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_komsel($komsel_detail_id = null)
    {
        if ($komsel_detail_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $komsel_detail = KomselDetail::where('komsel_detail_id', $komsel_detail_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$komsel_detail) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $komsel_detail->deleted = 1;
        $cek = $komsel_detail->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }













































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function api_komsel_all()
    {
        $komsel = KomselDetail::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $komsel,
        ]);
    }
    public function api_komsel_detail($komsel_detail_id)
    {
        $komsel = KomselDetail::where('komsel_detail_id', $komsel_detail_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$komsel) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $komsel,
            ]);
        }
    }
}
