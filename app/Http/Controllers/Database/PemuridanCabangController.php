<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\AnakPA;
use App\Models\AnakPADetail;
use App\Models\BAB;
use App\Models\Bahan;
use App\Models\Cabang;
use App\Models\KelompokPA;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PemuridanCabangController extends Controller
{
    public function permuridan()
    {

        $subcabangid = Auth::user()->lfk_cabang_id;
        $data = [
            'title'         => 'Permuridan',
            'menu_aktif'    => 'permuridan',
            'kakak_pa'      => User::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0', 'lfk_role_id' => 3])->orderBy('created_date', 'DESC')->get(),
            'anak_pa'       => User::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0', 'lfk_role_id' => 4])->orderBy('created_date', 'DESC')->get(),
            'kakak_pa_form' => User::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0', 'active' => '1', 'lfk_role_id' => 3])->get(),
            'bahan_form'    => Bahan::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'bab'           => BAB::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'kelompok_pa'   => KelompokPA::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];

        return view('admin-cabang.datacabang.datacabang-permuridan', $data);
    }

    public function editpass($id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        $value = (object) request()->validate([
            'password'  => 'required|min:8',
        ]);

        $data_user              = User::where('user_id', $id)->first();
        $data_user->password    = bcrypt($value->password);

        $cek = $data_user->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }

    public function list_anak_pa($kakak_pa_id)
    {
        $data = [
            'title'             => 'Anak PA',
            'menu_aktif'        => 'anak_pa',
            'kakak_pa'          => User::where(['deleted' => '0', 'lfk_role_id' => 3, 'user_id' => $kakak_pa_id])->first(),
            'anak_pa'           => AnakPADetail::select('user_header.*', 'kelompok_pa_header.*', 'kakak_pa.nama as nama_kakak_pa', 'bahan_pa_header.*')->join('bahan_pa_header', 'bahan_pa_header.bahan_pa_id', '=', 'anak_pa.lfk_bahan_pa_id')->join('user_header', 'user_header.user_id', '=', 'anak_pa.lfk_user_id')->join('kelompok_pa_header', 'kelompok_pa_header.kelompok_pa_id', '=', 'anak_pa.lfk_kelompok_pa_id')->join('user_header as kakak_pa', 'kelompok_pa_header.lfk_kakak_pa_user_id', '=', 'kakak_pa.user_id')->where(['kakak_pa.user_id' => $kakak_pa_id, 'user_header.lfk_role_id' => 4])->get(),
            'bahan_form'        => Bahan::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'bab'               => BAB::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'kelompok_pa'       => KelompokPA::where(['active' => 1, 'deleted' => '0', 'lfk_kakak_pa_user_id'  => $kakak_pa_id])->orderBy('created_date', 'DESC')->get(),
        ];

        return view('admin-cabang.datacabang.anak_pa_by_kakak_pa_admin_cabang', $data);
    }

    // ------------------------------------------------------------------------
    // logic
    // ------------------------------------------------------------------------

    public function tambah_kakak_pa()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $value = (object) request()->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'password'  => '',
            'gender'    => 'required',
            'phone'     => '',
            'alamat'    => '',
        ]);

        $kakak_pa = User::where('email', $value->email)->first();
        if ($kakak_pa) {
            return redirect()->back()->withInput()->with('gagal', 'Email sudah digunakan');
        }

        $kakak_pa = new User;
        $kakak_pa->lfk_role_id      = 3;
        $kakak_pa->nama             = $value->nama;
        $kakak_pa->email            = $value->email;
        $kakak_pa->gender           = $value->gender;
        $kakak_pa->phone            = $value->phone;
        $kakak_pa->alamat           = $value->alamat;
        $kakak_pa->lfk_cabang_id    = $subcabangid;

        // if($value->password != '') {
        //     $kakak_pa->password     = bcrypt($value->password);
        // }
        $cek = $kakak_pa->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data');
    }
    public function edit_kakak_pa($user_id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $value = (object) request()->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'gender'    => 'required',
            'phone'     => '',
            'alamat'    => '',
        ]);

        $kakak_pa = User::where('user_id', $user_id)->first();
        if (!$kakak_pa) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $kakak_pa->nama = $value->nama;
        $kakak_pa->email = $value->email;
        $kakak_pa->gender = $value->gender;
        $kakak_pa->phone = $value->phone;
        $kakak_pa->alamat = $value->alamat;
        $kakak_pa->lfk_cabang_id = $subcabangid;

        $cek = $kakak_pa->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_kakak_pa($user_id = null)
    {
        if ($user_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $kakak_pa = User::where('user_id', $user_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kakak_pa) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $kakak_pa->deleted = 1;
        $cek = $kakak_pa->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

    public function tambah_anak_pa()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $value = (object) request()->validate([
            'nama'      => 'required',
            'gender'    => 'required',
            'phone'     => 'required|numeric',
            'alamat'    => 'required',
            'kelompok_pa'    => 'required',
            'lfk_bahan_pa_id' => 'required',
        ]);



        DB::beginTransaction();
        try {
            $anak_pa                            = (object)[];

            $anak_pa->lfk_role_id               = 4;
            $anak_pa->nama                      = $value->nama;
            $anak_pa->gender                    = $value->gender;
            $anak_pa->phone                     = $value->phone;
            $anak_pa->alamat                    = $value->alamat;
            $anak_pa->lfk_cabang_id         = $subcabangid;
            $anak_pa->active                    = 1;
            $anak_pa->deleted                   = '0';
            $anak_pa->created_date              = Carbon::now();
            $anak_pa->updated_date              = Carbon::now();
            User::insert((array)$anak_pa);
            $anak_pa_id = DB::getPdo()->lastInsertId();
            $anak_pa_detail = [
                'lfk_user_id' => $anak_pa_id,
                'lfk_kelompok_pa_id' => $value->kelompok_pa,
                'lfk_bahan_pa_id' => $value->lfk_bahan_pa_id,
            ];
            AnakPADetail::insert($anak_pa_detail);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }

        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data');
    }
    public function edit_anak_pa($user_id, $anak_pa_user_id)
    {
        $value = (object) request()->validate([
            'nama'      => 'required',
            'gender'    => 'required',
            'phone'     => 'required|numeric',
            'alamat'    => 'required',
            'kelompok_pa'  => 'required',
            'lfk_bahan_pa_id' => 'required',
        ]);

        $anak_pa = User::where('user_id', $anak_pa_user_id)->first();
        if (!$anak_pa) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $anak_pa_detail = AnakPADetail::where('lfk_user_id', $anak_pa_user_id)->first();
        if (!$anak_pa_detail) {
            $anak_pa_detail = new AnakPADetail;
            $anak_pa_detail->lfk_user_id = $anak_pa->anak_pa_user_id;
        }
        $anak_pa->nama = $value->nama;
        $anak_pa->gender = $value->gender;
        $anak_pa->phone = $value->phone;
        $anak_pa->alamat = $value->alamat;

        $anak_pa_detail->lfk_bahan_pa_id = $value->lfk_bahan_pa_id;
        $anak_pa_detail->lfk_kelompok_pa_id = $value->kelompok_pa;

        $cek1 = $anak_pa->save();
        $cek2 = $anak_pa_detail->save();
        if (!$cek1 || !$cek2) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_anak_pa($user_id = null)
    {
        if ($user_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $anak_pa = User::where('user_id', $user_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$anak_pa) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $anak_pa->deleted = 1;
        $cek = $anak_pa->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }









































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    // kakak pa
    public function api_kakak_pa_all()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $kakak_pa = User::where(['lfk_cabang_id' => $subcabangid, 'active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $kakak_pa,
        ]);
    }
    public function api_kakak_pa_detail($user_id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $kakak_pa = User::where('lfk_cabang_id', $subcabangid)->where('user_id', $user_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$kakak_pa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $kakak_pa,
            ]);
        }
    }
    // anak pa
    public function api_anak_pa_all()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $anak_pa = User::with('anak_pa_detail')->where(['lfk_cabang_id' => $subcabangid, 'active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $anak_pa,
        ]);
    }
    public function api_anak_pa_detail($user_id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $anak_pa = User::with('anak_pa_detail')->where('lfk_cabang_id', $subcabangid)->where('user_id', $user_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$anak_pa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $anak_pa,
            ]);
        }
    }
    // bahan
    public function api_bahan_all()
    {
        $bahan = Bahan::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $bahan,
        ]);
    }
    public function api_bahan_detail($bahan_pa_id)
    {
        $bahan = Bahan::where('bahan_pa_id', $bahan_pa_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$bahan) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $bahan,
            ]);
        }
    }
    // bab
    public function api_bab_all()
    {
        $bab = BAB::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $bab,
        ]);
    }
    public function api_bab_detail($bab_pa_id)
    {
        $bab = BAB::where('bab_pa_id', $bab_pa_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$bab) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $bab,
            ]);
        }
    }
}
