<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Event;
use App\Models\Ibadah;
use App\Models\KakakPA;
use App\Models\KategoriGereja;
use App\Models\KategoriKomsel;
use App\Models\KelompokPA;
use App\Models\Komsel;
use App\Models\Kontak;
use App\Models\StatusEvent;
use App\Models\SubCabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use S3Helper;

class CabangController extends Controller
{
    public function cabang()
    {
        $tab = request('tab');
        $filter_cabang = request('filter_cabang');
        $filter_kategori_gereja = request('filter_kategori_gereja');

        $cabang = Cabang::where(['deleted' => '0', 'lfk_kategori_gereja_id' => '1'])->orderBy('created_date', 'DESC')->get();
        $all_cabang = Cabang::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $cabang_input = Cabang::where(['active' => 1, 'deleted' => '0'])->get();

        $where_ibadah = ['ibadah_header.deleted' => '0'];
        $where_komsel = ['komsel_header.deleted' => '0'];
        $where_kelompok_pa = ['kelompok_pa_header.deleted' => '0'];
        $where_event = ['event_header.deleted' => '0'];

        if ($tab == 'ibadah') {
            if ($filter_cabang && $filter_kategori_gereja) {
                $where_ibadah['lfk_cabang_id'] = $filter_cabang;
            } elseif ($filter_kategori_gereja) {
                $where_ibadah['lfk_kategori_gereja_id'] = $filter_kategori_gereja;
            }
        } elseif ($tab == 'komsel') {
            if ($filter_cabang && $filter_kategori_gereja) {
                $where_komsel['lfk_cabang_id'] = $filter_cabang;
            } elseif ($filter_kategori_gereja) {
                $where_komsel['lfk_kategori_gereja_id'] = $filter_kategori_gereja;
            }
        } elseif ($tab == 'kelompokpa') {
            if ($filter_cabang && $filter_kategori_gereja) {
                $where_kelompok_pa['kelompok_pa_header.lfk_cabang_id'] = $filter_cabang;
            } elseif ($filter_kategori_gereja) {
                $where_kelompok_pa['lfk_kategori_gereja_id'] = $filter_kategori_gereja;
            }
        } elseif ($tab == 'event') {
            if ($filter_cabang && $filter_kategori_gereja) {
                $where_event['lfk_cabang_id'] = $filter_cabang;
            } elseif ($filter_kategori_gereja) {
                $where_event['lfk_kategori_gereja_id'] = $filter_kategori_gereja;
            }
        }
        $ibadah = Ibadah::where($where_ibadah)
            ->select('*', 'ibadah_header.*')
            ->join('cabang_header', 'ibadah_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
            ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
            ->orderBy('ibadah_header.created_date', 'DESC')->get();

        $komsel = Komsel::where($where_komsel)
            ->select('*', 'komsel_header.*')
            ->join('cabang_header', 'komsel_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
            ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
            ->orderBy('komsel_header.created_date', 'DESC')->get();

        $kelompok_pa = KelompokPA::where($where_kelompok_pa)
            ->select('*', 'kelompok_pa_header.*')
            ->join('cabang_header', 'kelompok_pa_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
            ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
            ->orderBy('kelompok_pa_header.created_date', 'DESC')->get();
        $total_kakak_pa_pria = KelompokPA::where($where_kelompok_pa)
            ->select('lfk_kakak_pa_user_id')->distinct()
            ->join('user_header', 'kelompok_pa_header.lfk_kakak_pa_user_id', '=', 'user_header.user_id')
            ->join('cabang_header', 'kelompok_pa_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
            ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
            ->where('user_header.gender', 'l')
            ->groupBy('lfk_kakak_pa_user_id')
            ->get()->count();
        $total_kakak_pa_wanita = KelompokPA::where($where_kelompok_pa)
            ->select('lfk_kakak_pa_user_id')->distinct()
            ->join('user_header', 'kelompok_pa_header.lfk_kakak_pa_user_id', '=', 'user_header.user_id')
            ->join('cabang_header', 'kelompok_pa_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
            ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
            ->where('user_header.gender', 'p')
            ->groupBy('lfk_kakak_pa_user_id')
            ->get()->count();

        $event = Event::where($where_event)
            ->select('*', 'event_header.*')
            ->join('cabang_header', 'event_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
            ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
            ->orderBy('event_header.created_date', 'DESC')->get();

        $kakak_pa           = KakakPA::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $kategori_gereja    = KategoriGereja::where(['deleted' => '0', 'active' => 1])->get();
        $sub_cabang         = SubCabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $kategori_komsel    = KategoriKomsel::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'ASC')->get();

        $data = [
            'title'                 => 'Cabang',
            'menu_aktif'            => 'cabang',
            'kategori_gereja'       => $kategori_gereja,
            'cabang'                => $cabang,
            'all_cabang'            => $all_cabang,
            'cabang_input'          => $cabang_input,
            'ibadah'                => $ibadah,
            'komsel'                => $komsel,
            'kelompok_pa'           => $kelompok_pa,
            'event'                 => $event,
            'kakak_pa'              => $kakak_pa,
            'sub_cabang'            => $sub_cabang,
            'kategori_komsel'       => $kategori_komsel,
            'total_kakak_pa_pria'   => $total_kakak_pa_pria,
            'total_kakak_pa_wanita' => $total_kakak_pa_wanita,
            'status_event'          => StatusEvent::where(['deleted' => '0', 'active' => 1])->get(),
        ];
        // return $all_cabang;
        return view('database-cabang', $data);
    }

    public function sub_cabang($cabang_id)
    {
        $cabang = Cabang::where(['deleted' => '0', 'cabang_id' => $cabang_id])->orderBy('created_date', 'DESC')->first();
        if (!$cabang) {
            return redirect()->back()->withInput()->with('gagal', 'Data cabang tidak ditemukan');
        }

        $sub_cabang = SubCabang::where(['deleted' => '0', 'lfk_cabang_id' => $cabang_id])->get();
        $kategori_gereja = KategoriGereja::where(['deleted' => '0', 'active' => 1])->where('kategori_gereja_id', '!=', '1')->get();

        $data = [
            'title'             => 'Sub Cabang',
            'menu_aktif'        => 'cabang',
            'cabang'            => $cabang,
            'kategori_gereja'   => $kategori_gereja,
            'sub_cabang'        => $sub_cabang,
        ];

        return view('database-sub-cabang', $data);
    }






























    // ------------------------------------------------------------------------
    public function tambah_sub_cabang($cabang_id)
    {
        $value = (object) request()->validate([
            'nama_cabang' => 'required',
            'info_detail' => '',
            'lfk_kategori_gereja_id' => 'required'
        ]);
        // $cabang = Cabang::where('nama_cabang', $value->nama_cabang)
        //     ->where(['deleted' => '0'])
        //     ->orderBy('created_date', 'DESC')
        //     ->first();
        // if ($cabang) {
        //     return redirect()->back()->withInput()->with('gagal', 'Nama cabang sudah ada');
        // }
        $Cabang = new Cabang;
        $Cabang->nama_cabang = $value->nama_cabang;
        $Cabang->info_detail = $value->info_detail;
        $Cabang->lfk_kategori_gereja_id = $value->lfk_kategori_gereja_id;

        $cek = $Cabang->save();


        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        } else {
            $sub_cabang = new SubCabang;
            $sub_cabang->lfk_cabang_id = $cabang_id;
            $sub_cabang->sub_cabang = $Cabang->cabang_id;
            $data = $sub_cabang->save();

            if (!$data) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
            } else {
                return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
            }
        }
    }

    public function edit_sub_cabang($cabang_id, $sub_cabang_id = null)
    {
        if ($cabang_id == null) {
            return redirect('superadmin/database/database-cabang/cabang/' . $cabang_id . '/sub_cabang')->withInput()->with('gagal', 'Data cabang tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_cabang' => 'required',
            'lfk_kategori_gereja_id' => 'required',
            'info_detail' => '',
        ]);

        $cabang = Cabang::where(['cabang_id' => $sub_cabang_id, 'deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$cabang) {
            return redirect('superadmin/database/database-cabang/cabang/' . $cabang_id . '/sub_cabang')->withInput()->with('gagal', 'Data cabang tidak ditemukan');
        } elseif (Cabang::where(['nama_cabang' => $value->nama_cabang, 'deleted' => '0'])->first() && $cabang->nama_cabang != $value->nama_cabang) {
            return redirect('superadmin/database/database-cabang/cabang/' . $cabang_id . '/sub_cabang')->withInput()->with('gagal', 'Data cabang sudah ada');
        }

        $cabang->lfk_kategori_gereja_id = $value->lfk_kategori_gereja_id;
        $cabang->nama_cabang            = $value->nama_cabang;
        $cabang->info_detail            = $value->info_detail;
        $cek = $cabang->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang/cabang/' . $cabang_id . '/sub_cabang')->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect('superadmin/database/database-cabang/cabang/' . $cabang_id . '/sub_cabang')->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_sub_cabang($cabang_id, $sub_cabang_id = null)
    {
        if ($sub_cabang_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data sub cabang tidak ditemukan');
        }
        $sub_cabang = SubCabang::where('sub_cabang_id', $sub_cabang_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$sub_cabang) {
            return redirect()->back()->withInput()->with('gagal', 'Data sub cabang tidak ditemukan');
        }
        $sub_cabang->deleted = 1;
        $cek = $sub_cabang->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

    public function upgrade_cabang($cabang_id, $sub_cabang_id = null)
    {
        if ($sub_cabang_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data sub cabang tidak ditemukan');
        }
        $sub_cabang = SubCabang::where('sub_cabang', $sub_cabang_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$sub_cabang) {
            return redirect()->back()->withInput()->with('gagal', 'Data sub cabang tidak ditemukan');
        }
        $cabang = Cabang::where('cabang_id', $sub_cabang_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$cabang) {
            return redirect()->back()->withInput()->with('gagal', 'Data sub cabang tidak ditemukan');
        }

        if ($cabang->lfk_kategori_gereja_id === '3') {
            $cabang->lfk_kategori_gereja_id = '2';
            $data = $cabang->save();
        } else if ($cabang->lfk_kategori_gereja_id === '2') {
            $del = $sub_cabang->delete();
            if (!$del) {
                return redirect('superadmin/database/database-cabang/cabang/' . $cabang_id . '/sub_cabang')->withInput()->with('gagal', 'Gagal upgrade sub cabang');
            } else {
                $cabang->lfk_kategori_gereja_id = '1';
                $data = $cabang->save();
            }
        } else {
            return redirect()->back()->with('gagal', 'Gagal upgrade cabang');
        }

        if (!$data) {
            return redirect('superadmin/database/database-cabang/cabang/' . $cabang_id . '/sub_cabang')->withInput()->with('gagal', 'Gagal upgrade sub cabang');
        } else {
            return redirect()->back()->with('berhasil', 'Berhasil upgrade sub cabang');
        }
    }
    // ------------------------------------------------------------------------
    public function tambah_cabang()
    {
        $value = (object) request()->validate([
            'nama_cabang' => 'required',
            // 'lfk_kategori_gereja_id' => 'required',
            'info_detail' => '',
        ]);
        $cabang = Cabang::where('nama_cabang', $value->nama_cabang)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($cabang) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Nama cabang sudah ada');
        }
        $cabang = new Cabang;
        $cabang->nama_cabang = $value->nama_cabang;
        // $cabang->lfk_kategori_gereja_id = $value->lfk_kategori_gereja_id;
        $cabang->lfk_kategori_gereja_id = 1;
        $cabang->info_detail = $value->info_detail;

        $cek = $cabang->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_cabang($cabang_id = null)
    {
        if ($cabang_id == null) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Data cabang tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_cabang' => 'required',
            // 'lfk_kategori_gereja_id' => 'required',
            'info_detail' => '',
        ]);

        $cabang = Cabang::where(['cabang_id' => $cabang_id, 'deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$cabang) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Data cabang tidak ditemukan');
        } elseif (Cabang::where(['nama_cabang' => $value->nama_cabang, 'deleted' => '0'])->first() && $cabang->nama_cabang != $value->nama_cabang) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Data cabang sudah ada');
        }
        $cabang->nama_cabang = $value->nama_cabang;
        // $cabang->lfk_kategori_gereja_id = $value->lfk_kategori_gereja_id;
        $cabang->lfk_kategori_gereja_id = 1;
        $cabang->info_detail = $value->info_detail;
        $cek = $cabang->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_cabang($cabang_id = null)
    {
        if ($cabang_id == null) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Data cabang tidak ditemukan');
        }
        $cabang = Cabang::where('cabang_id', $cabang_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$cabang) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Data cabang tidak ditemukan');
        }
        $cabang->deleted = 1;
        $cek = $cabang->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect('superadmin/database/database-cabang?tab=cabang')->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
    // ------------------------------------------------------------------------

    public function tambah_ibadah()
    {
        $value = (object) request()->validate([
            'nama_ibadah'       => 'required',
            'ibadah_time_start' => 'required|date_format:H:i',
            'ibadah_time_end'   => 'required|date_format:H:i',
            'lfk_cabang_id'     => 'required',
            'kapasitasIbadah'   => '',
            'ibadah_day'        => 'required',
            'notes'             => '',
        ]);
        // $ibadah = Ibadah::where('nama_ibadah', $value->nama_ibadah)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        // if ($ibadah) {
        //     return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Nama ibadah sudah ada');
        // }
        $ibadah = new Ibadah;
        $ibadah->nama_ibadah        = $value->nama_ibadah;
        $ibadah->ibadah_time_start  = $value->ibadah_time_start;
        $ibadah->ibadah_time_end    = $value->ibadah_time_end;
        $ibadah->lfk_cabang_id      = $value->lfk_cabang_id;
        $ibadah->kapasitas_ibadah   = $value->kapasitasIbadah;
        $ibadah->ibadah_day         = $value->ibadah_day;
        $ibadah->notes              = $value->notes;
        $ibadah->ibadah_status      = strlen(request('activeIbadah')) ? 1 : 0;

        $cek = $ibadah->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function edit_ibadah($ibadah_id = null)
    {
        // return request();
        if ($ibadah_id == null) {
            return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_ibadah'       => 'required',
            'ibadah_time_start' => 'required|date_format:H:i',
            'ibadah_time_end'   => 'required|date_format:H:i',
            'lfk_cabang_id'     => 'required',
            'kapasitasIbadah'   => '',
            'ibadah_day'        => 'required',
            'notes'             => '',
        ]);
        $ibadah = Ibadah::where('ibadah_id', $ibadah_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$ibadah) {
            return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $ibadah->nama_ibadah        = $value->nama_ibadah;
        $ibadah->ibadah_time_start  = $value->ibadah_time_start;
        $ibadah->ibadah_time_end    = $value->ibadah_time_end;
        $ibadah->lfk_cabang_id      = $value->lfk_cabang_id;
        $ibadah->kapasitas_ibadah   = $value->kapasitasIbadah;
        $ibadah->ibadah_day         = $value->ibadah_day;
        $ibadah->notes              = $value->notes;
        $ibadah->ibadah_status             = strlen(request('activeIbadah')) ? 1 : 0;

        $cek = $ibadah->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_ibadah($ibadah_id = null)
    {
        if ($ibadah_id == null) {
            return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $ibadah = Ibadah::where('ibadah_id', $ibadah_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$ibadah) {
            return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $ibadah->deleted             = 1;

        $cek = $ibadah->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect('superadmin/database/database-cabang?tab=ibadah')->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
    // ------------------------------------------------------------------------

    public function tambah_komsel(Request $request)
    {
        $value = (object) request()->validate([
            'nama_komsel'               => 'required',
            'lfk_cabang_id'             => 'required',
            'jumlah_pria'               => 'required|numeric',
            'jumlah_wanita'             => 'required|numeric',
            'lfk_kategori_komsel_id'    => 'required',
        ]);
        $komsel = Komsel::where('nama_komsel', $value->nama_komsel)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($komsel) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Nama komsel sudah ada');
        }
        $komsel = new Komsel;
        $komsel->nama_komsel            = $value->nama_komsel;
        $komsel->lfk_cabang_id          = $value->lfk_cabang_id;
        $komsel->jumlah_pria            = $value->jumlah_pria;
        $komsel->jumlah_wanita          = $value->jumlah_wanita;
        $komsel->lfk_kategori_komsel_id = $value->lfk_kategori_komsel_id;

        $cek = $komsel->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_komsel(Request $request, $komsel_id = null)
    {
        if ($komsel_id == null) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_komsel'               => 'required',
            'lfk_cabang_id'             => 'required',
            'jumlah_pria'               => 'required|numeric',
            'jumlah_wanita'             => 'required|numeric',
            'lfk_kategori_komsel_id'    => 'required',
        ]);
        $komsel = Komsel::where('komsel_id', $komsel_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$komsel) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $komsel->nama_komsel            = $value->nama_komsel;
        $komsel->lfk_cabang_id          = $value->lfk_cabang_id;
        $komsel->jumlah_pria            = $value->jumlah_pria;
        $komsel->jumlah_wanita          = $value->jumlah_wanita;
        $komsel->lfk_kategori_komsel_id = $value->lfk_kategori_komsel_id;

        $cek = $komsel->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_komsel($komsel_id = null)
    {
        if ($komsel_id == null) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $komsel = Komsel::where('komsel_id', $komsel_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$komsel) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $komsel->deleted = 1;

        $cek = $komsel->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect('superadmin/database/database-cabang?tab=komsel')->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
    // ------------------------------------------------------------------------

    public function tambah_kelompok_pa()
    {
        $value = (object) request()->validate([
            'nama_kelompok'         => 'required',
            'lfk_kakak_pa_user_id'  => 'required',
            'lfk_cabang_id'         => 'required',
            'active'                => 'required',
        ]);
        $kelompok = KelompokPA::where('nama_kelompok', $value->nama_kelompok)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($kelompok) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Nama kelompok sudah ada');
        }
        $kelompok = new KelompokPA;
        $kelompok->nama_kelompok        = $value->nama_kelompok;
        $kelompok->lfk_kakak_pa_user_id = $value->lfk_kakak_pa_user_id;
        $kelompok->lfk_cabang_id        = $value->lfk_cabang_id;
        $kelompok->active               = $value->active;

        $cek = $kelompok->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_kelompok_pa(Request $request, $kelompok_pa_id = null)
    {
        if ($kelompok_pa_id == null) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_kelompok'             => 'required',
            'lfk_kakak_pa_user_id'      => 'required',
            'lfk_cabang_id'             => 'required',
            'active'                    => 'required',
        ]);
        $kelompok = KelompokPA::where('kelompok_pa_id', $kelompok_pa_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kelompok) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $kelompok->nama_kelompok        = $value->nama_kelompok;
        $kelompok->lfk_kakak_pa_user_id = $value->lfk_kakak_pa_user_id;
        $kelompok->lfk_cabang_id        = $value->lfk_cabang_id;
        $kelompok->active               = $value->active;

        $cek = $kelompok->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_kelompok_pa($kelompok_pa_id = null)
    {
        if ($kelompok_pa_id == null) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $kelompok = KelompokPA::where('kelompok_pa_id', $kelompok_pa_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kelompok) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $kelompok->deleted = 1;

        $cek = $kelompok->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect('superadmin/database/database-cabang?tab=kelompokpa')->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
    // ------------------------------------------------------------------------

    public function tambah_event()
    {
        $value = (object) request()->validate([
            'nama_event'            => 'required',
            'jenis_event'           => 'required',
            'tanggal_event_mulai'   => 'required',
            'tanggal_event_selesai' => 'required',
            'jam_event_mulai'       => 'required',
            'jam_event_selesai'     => 'required',

            'foto_event'            => 'file|mimes:jpg,jpeg,png|max:1024',
            'foto_banner'           => 'file|mimes:jpg,jpeg,png|max:1024',
            'proposal'              => 'file|mimes:pdf,doc,docx|max:2048',
            'lpj'                   => 'file|mimes:pdf,doc,docx|max:2048',

            'catatan'               => '',
            'lfk_cabang_id'         => 'required',
            'tujuan'                => 'required',
            'kuota_tersedia'        => 'required|numeric',
            'kehadiran'             => 'required|numeric',
            'lfk_status_event_id'   => 'required',
        ]);
        $event = Event::where('nama_event', $value->nama_event)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($event) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Nama event sudah ada');
        }
        $event = new Event;
        $event->nama_event              = $value->nama_event;
        $event->tanggal_event_mulai     = format_date($value->tanggal_event_mulai);
        $event->tanggal_event_selesai   = format_date($value->tanggal_event_selesai);
        $event->jam_event_mulai         = format_date($value->jam_event_mulai, 'H:i:s');
        $event->jam_event_selesai       = format_date($value->jam_event_selesai, 'H:i:s');
        $event->jenis_event             = $value->jenis_event;
        $event->catatan                 = $value->catatan;
        $event->lfk_cabang_id           = $value->lfk_cabang_id;
        $event->tujuan                  = $value->tujuan;
        $event->kuota_tersedia          = $value->kuota_tersedia;
        $event->kehadiran               = $value->kehadiran;
        $event->lfk_status_event_id     = $value->lfk_status_event_id;

        if (request()->hasFile('foto_event')) {
            $file = request()->file('foto_event');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $event->foto_event = $filename;
        } else {
            $event->foto_event = '';
            // return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Foto gagal disimpan');
        }

        if (request()->hasFile('foto_banner')) {
            $file = request()->file('foto_banner');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $event->foto_banner = $filename;
        } else {
            $event->foto_banner = '';
            // return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Foto gagal disimpan');
        }

        if (request()->hasFile('proposal')) {
            $file = request()->file('proposal');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $event->proposal = $filename;
        } else {
            $event->proposal = '';
            // return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Foto gagal disimpan');
        }

        if (request()->hasFile('lpj')) {
            $file = request()->file('lpj');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $event->lpj = $filename;
        } else {
            $event->lpj = '';
            // return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Foto gagal disimpan');
        }

        $cek = $event->save();
        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menambah data');
        }



        set_time_limit(120);

        $error = [];

        $kontak = Kontak::first();

        $data = [
            'event' => $event,
        ];

        if ($event) {
            Mail::send('emails.pemberitahuan-event', $data, function ($message) use ($kontak) {
                $message->to($kontak->email);
                $message->subject('Ulang tahun');
            });
            if (count(Mail::failures()) > 0) {
                $error[] = $kontak->email;
            }
        }


        $user = User::where(['lfk_cabang_id' => $event->lfk_cabang_id, 'lfk_role_id' => '2', 'deleted' => '0', 'active' => '1'])->get();

        if ($user) {
            foreach ($user as $key => $value_user) {
                Mail::send('emails.pemberitahuan-event', $data, function ($message) use ($value_user) {
                    $message->to($value_user->email);
                    $message->subject('Ulang tahun');
                });
                if (count(Mail::failures()) > 0) {
                    $error[] = $value_user->email;
                }
            }
        }
        if (count($error) > 0) {
            return redirect()->back()->with('gagal', 'Gagal mengirim email ke ', implode(', ', $error));
        }



        return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function edit_event($event_id = null)
    {
        if ($event_id == null) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_event'            => 'required',
            'jenis_event'           => 'required',
            'tanggal_event_mulai'   => 'required',
            'tanggal_event_selesai' => 'required',
            'jam_event_mulai'       => 'required',
            'jam_event_selesai'     => 'required',
            'foto_event'            => 'file|mimes:jpg,jpeg,png|max:1024',
            'foto_banner'           => 'file|mimes:jpg,jpeg,png|max:1024',
            'proposal'              => 'file|mimes:pdf,doc,docx|max:2048',
            'lpj'                   => 'file|mimes:pdf,doc,docx|max:2048',
            'catatan'               => '',
            'lfk_cabang_id'         => 'required',
            'tujuan'                => 'required',
            'kuota_tersedia'        => 'required|numeric',
            'kehadiran'             => 'required|numeric',
            'lfk_status_event_id'   => 'required',
        ]);

        $event = Event::where('event_id', $event_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$event) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Data event tidak ditemukan');
        }

        $event->nama_event              = $value->nama_event;
        $event->tanggal_event_mulai     = format_date($value->tanggal_event_mulai);
        $event->tanggal_event_selesai   = format_date($value->tanggal_event_selesai);
        $event->jam_event_mulai         = format_date($value->jam_event_mulai, 'H:i:s');
        $event->jam_event_selesai       = format_date($value->jam_event_selesai, 'H:i:s');
        $event->jenis_event             = $value->jenis_event;
        $event->catatan                 = $value->catatan;
        $event->lfk_cabang_id           = $value->lfk_cabang_id;
        $event->tujuan                  = $value->tujuan;
        $event->kuota_tersedia          = $value->kuota_tersedia;
        $event->kehadiran               = $value->kehadiran;
        $event->lfk_status_event_id     = $value->lfk_status_event_id;

        if (request()->hasFile('foto_event')) {
            $file = request()->file('foto_event');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            @S3Helper::delete($event->foto_event);
            $event->foto_event = $filename;
        }

        if (request()->hasFile('foto_banner')) {
            $file = request()->file('foto_banner');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            @S3Helper::delete($event->foto_banner);
            $event->foto_banner = $filename;
        }

        if (request()->hasFile('proposal')) {
            $file = request()->file('proposal');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            @S3Helper::delete($event->proposal);
            $event->proposal = $filename;
        }

        if (request()->hasFile('lpj')) {
            $file = request()->file('lpj');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            @S3Helper::delete($event->lpj);
            $event->lpj = $filename;
        }

        $cek    = $event->save();
        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal mengedit data');
        }

        return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('berhasil', 'Berhasil mengedit data');
    }

    public function hapus_event($event_id = null)
    {
        if ($event_id == null) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $event = Event::where('event_id', $event_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$event) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $event->deleted                 = 1;

        $cek = $event->save();

        if (!$cek) {
            return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('berhasil', 'Berhasil menghapus data');
    }















    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_sub_cabang_all($cabang_id)
    {
        $cabang = SubCabang::where(['deleted' => '0', 'lfk_cabang_id' => $cabang_id])->get();

        return response()->json([
            'status' => true,
            'data' => $cabang,
        ]);
    }
    public function api_sub_cabang_detail($cabang_id, $sub_cabang_id)
    {
        $cabang = SubCabang::where('sub_cabang_id', $sub_cabang_id)->where(['deleted' => '0'])->first();

        if (!$cabang) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $cabang,
            ]);
        }
    }



    public function api_cabang_all()
    {
        $cabang = Cabang::where(['deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $cabang,
        ]);
    }
    public function api_cabang_detail($cabang_id)
    {
        $cabang = Cabang::where('cabang_id', $cabang_id)->where(['deleted' => '0'])->first();

        if (!$cabang) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $cabang,
            ]);
        }
    }



    public function api_ibadah_all()
    {
        $ibadah = Ibadah::where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->get();

        return response()->json([
            'status' => true,
            'data' => $ibadah,
        ]);
    }
    public function api_ibadah_detail($ibadah_id)
    {
        $ibadah = Ibadah::where('ibadah_id', $ibadah_id)->where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->first();

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



    public function api_komsel_all()
    {
        $komsel = Komsel::where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->get();

        return response()->json([
            'status' => true,
            'data' => $komsel,
        ]);
    }
    public function api_komsel_detail($komsel_id)
    {
        $komsel = Komsel::where('komsel_id', $komsel_id)->where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->first();

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


    public function api_kelompok_pa_all()
    {
        $kelompok_pa = KelompokPA::where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }, 'kakak_pa'])->get();

        return response()->json([
            'status' => true,
            'data' => $kelompok_pa,
        ]);
    }
    public function api_kelompok_pa_detail($kelompok_pa_id)
    {
        $kelompok_pa = KelompokPA::where('kelompok_pa_id', $kelompok_pa_id)->where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }, 'kakak_pa'])->first();

        if (!$kelompok_pa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $kelompok_pa,
            ]);
        }
    }


    public function api_event_all()
    {
        $event = Event::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->where(['deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $event,
        ]);
    }
    public function api_event_detail($event_id)
    {
        $event = Event::with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->where('event_id', $event_id)->where(['deleted' => '0'])->first();

        if (!$event) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $event,
            ]);
        }
    }
}
