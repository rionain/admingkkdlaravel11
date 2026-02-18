<?php

namespace App\Http\Controllers\AdminCabang\Kehadiran;

use App\Http\Controllers\Controller;
use App\Models\AnakPA;
use App\Models\AnakPADetail;
use App\Models\BAB;
use App\Models\Bahan;
use App\Models\Cabang;
use App\Models\KategoriGereja;
use App\Models\KelompokPA;
use App\Models\Permuridan;
use App\Models\PermuridanDetail;
use App\Models\SubCabang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminCabangKehadiranPermuridanController extends Controller
{
    public function permuridan()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        $tgl_awal = request('tgl_awal') ? format_date(request('tgl_awal')) : null;
        $tgl_akhir = request('tgl_akhir') ? format_date(request('tgl_akhir')) : null;

        if ($tgl_awal && $tgl_akhir) {
            array_push($where, ['tanggal', '>=', "$tgl_awal"]);
            array_push($where, ['tanggal', '<=', "$tgl_akhir"]);
        } elseif ($tgl_awal) {
            array_push($where, ['tanggal', '>=', "$tgl_awal"]);
        }

        $where = ['permuridan_header.deleted' => '0', 'permuridan_header.lfk_cabang_id' => $subcabangid];
        $data = [
            'title'             => 'Kehadiran Permuridan',
            'menu_aktif'        => 'kehadiran_permuridan',
            'kehadiran'         => Permuridan::where($where)
                ->join('cabang_header', 'permuridan_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')
                ->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')
                ->orderBy('permuridan_header.created_date', 'DESC')->get(),
            'anak_pa'           => AnakPA::where(['active' => 1, 'deleted' => '0'])->get(),
            'kategori_gereja'   => KategoriGereja::where(['deleted' => '0', 'active' => 1])->get(),
            'kelompok'          => KelompokPA::where(['active' => 1, 'deleted' => '0', 'lfk_cabang_id' => $subcabangid])->get(),
            'bahan'             => Bahan::where(['active' => 1, 'deleted' => '0'])->get(),
            'bab'               => BAB::where(['active' => 1, 'deleted' => '0'])->get(),
            'cabang'            => Cabang::where(['active' => 1, 'deleted' => '0'])->get(),
            'sub_cabang'        => SubCabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];
        return view('admin-cabang.kehadiran.kehadiran-permuridan', $data);
    }

    public function tambah_permuridan()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        $value = (object) request()->validate([
            'kelompok'          => 'required',
            'bahan'             => 'required',
            'bab'               => 'required',
            'catatan'           => '',
            'tanggal'           => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $permuridan = (object)[];
            $permuridan->lfk_kelompok_pa_id     = $value->kelompok;
            $permuridan->lfk_bahan_pa_id        = $value->bahan;
            $permuridan->lfk_bab_pa_id          = $value->bab;
            $permuridan->catatan                = $value->catatan;
            $permuridan->tanggal                = $value->tanggal;
            $permuridan->lfk_cabang_id          = $subcabangid;
            $permuridan->active                 = 1;
            $permuridan->deleted                = '0';
            $permuridan->created_date           = Carbon::now();
            $permuridan->updated_date           = Carbon::now();
            Permuridan::insert((array)$permuridan);
            $permuridan_id = DB::getPdo()->lastInsertId();


            $permuridan_detail = [];
            $anak_pa = AnakPADetail::where(['lfk_kelompok_pa_id' => $value->kelompok, 'active' => 1, 'deleted' => '0'])->join('user_header', 'user_header.user_id', '=', 'anak_pa.lfk_user_id')->get();

            foreach ($anak_pa as $key => $item) {
                $flag_hadir = false;
                if (in_array($item->lfk_user_id, (array) request('anak_pa'))) {
                    $flag_hadir = true;
                }
                $permuridan_detail_object = [];
                $permuridan_detail_object['lfk_permuridan_id']       = $permuridan_id;
                $permuridan_detail_object['lfk_anak_pa_user_id']     = $item->lfk_user_id;
                $permuridan_detail_object['flag_hadir']              = $flag_hadir;
                $permuridan_detail_object['active']                  = 1;
                $permuridan_detail_object['deleted']                 = '0';
                $permuridan_detail_object['created_date']            = Carbon::now();
                $permuridan_detail_object['updated_date']            = Carbon::now();
                $permuridan_detail[] = $permuridan_detail_object;
            }
            PermuridanDetail::insert($permuridan_detail);


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }
        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data');
    }

    public function hapus_permuridan($permuridan_id = null)
    {
        if ($permuridan_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $permuridan = Permuridan::where('permuridan_id', $permuridan_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$permuridan) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $permuridan->deleted = 1;
        $cek = $permuridan->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }


    // ------------------------------------------------------------------------
    // DETAIL
    // ------------------------------------------------------------------------

    public function permuridan_detail($permuridan_id)
    {
        $subcabangid    = Auth::user()->lfk_cabang_id;
        $permuridan     = Permuridan::where(['permuridan_id' => $permuridan_id, 'deleted' => '0', 'lfk_cabang_id' => $subcabangid])->first();
        $data = [
            'title'         => 'Kehadiran Permuridan Detail',
            'menu_aktif'    => 'kehadiran_permuridan_detail',
            'permuridan'    => $permuridan,
            'kehadiran'     => PermuridanDetail::where(['lfk_permuridan_id' => $permuridan_id, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'anak_pa'       => AnakPA::where(['lfk_kelompok_pa_id' => $permuridan->lfk_kelompok_pa_id, 'lfk_bahan_pa_id' => $permuridan->lfk_bahan_pa_id, 'active' => 1, 'deleted' => '0'])->get(),
        ];
        return view('admin-cabang.kehadiran.kehadiran-permuridan-detail', $data);
    }
    public function tambah_permuridan_detail($permuridan_id = null)
    {
        $value = (object) request()->validate([
            'anak_pa'       => 'required',
            'flag_hadir'    => 'required',
            'flag_lulus'    => 'required',
        ]);
        $permuridan = Permuridan::where(['permuridan_id' => $permuridan_id, 'deleted' => '0'])->first();
        if (!$permuridan) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $permuridan_detail = PermuridanDetail::where(['lfk_permuridan_id' => $permuridan_id, 'lfk_anak_pa_user_id' => $value->anak_pa])->where(['deleted' => '0'])->first();
        if ($permuridan_detail) {
            return redirect()->back()->withInput()->with('gagal', 'Anak pa sudah ada');
        }

        $permuridan_detail = new PermuridanDetail;
        $permuridan_detail->lfk_permuridan_id = $permuridan_id;
        $permuridan_detail->lfk_anak_pa_user_id = $value->anak_pa;
        $permuridan_detail->flag_hadir = $value->flag_hadir;
        $permuridan_detail->flag_lulus = $value->flag_lulus;
        $cek = $permuridan_detail->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function hapus_permuridan_detail($permuridan_id = null, $permuridan_detail_id = null)
    {
        if ($permuridan_id == null || $permuridan_detail_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $permuridan_detail = PermuridanDetail::where(['lfk_permuridan_id' => $permuridan_id, 'permuridan_detail_id' => $permuridan_detail_id])->where(['deleted' => '0'])->first();
        if (!$permuridan_detail) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $permuridan_detail->deleted = 1;
        $cek = $permuridan_detail->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

    public function ganti_flag_permuridan_detail($permuridan_id = null, $permuridan_detail_id = null)
    {
        if ($permuridan_id == null || $permuridan_detail_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $permuridan_detail = PermuridanDetail::where(['lfk_permuridan_id' => $permuridan_id, 'permuridan_detail_id' => $permuridan_detail_id])->where(['deleted' => '0'])->first();
        if (!$permuridan_detail) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }


        if ($permuridan_detail->flag_hadir == '1') {
            $permuridan_detail->flag_hadir = '0';
        } elseif ($permuridan_detail->flag_hadir === "0") {
            $permuridan_detail->flag_hadir = '1';
        } else {
            return redirect()->back();
        }

        $cek = $permuridan_detail->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function api_permuridan_all()
    {
        $permuridan = PermuridanDetail::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $permuridan,
        ]);
    }
    public function api_permuridan_detail($permuridan_detail_id)
    {
        $permuridan = PermuridanDetail::where('permuridan_detail_id', $permuridan_detail_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$permuridan) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $permuridan,
            ]);
        }
    }
    public function api_permuridan_get_user()
    {
        $kelompok = request('kelompok');
        $bahan = request('bahan');
        $bab = request('bab');

        $user = AnakPADetail::where(['lfk_kelompok_pa_id' => $kelompok, 'active' => 1, 'deleted' => '0'])->join('user_header', 'user_header.user_id', '=', 'anak_pa.lfk_user_id')->get();

        return response()->json([
            'status' => true,
            'data' => $user,
        ]);
    }
}
