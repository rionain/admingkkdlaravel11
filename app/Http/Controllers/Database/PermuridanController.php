<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\AnakPA;
use App\Models\AnakPADetail;
use App\Models\BAB;
use App\Models\Bahan;
use App\Models\Cabang;
use App\Models\KakakPA;
use App\Models\KategoriGereja;
use App\Models\KelompokPA;
use App\Models\SubCabang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PermuridanController extends Controller
{
    public function permuridan()
    {
        $filter_cabang = request('filter_cabang');
        $filter_kategori_gereja = request('filter_kategori_gereja');

        $kakak_pa = [];
        if ($filter_cabang && $filter_kategori_gereja) {
            $kakak_pa = User::where(['user_header.deleted' => '0', 'lfk_role_id' => 3, 'lfk_cabang_id' => $filter_cabang])->join('cabang_header', 'user_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('user_header.created_date', 'DESC')->get();
        } elseif ($filter_kategori_gereja) {
            $kakak_pa = User::where(['user_header.deleted' => '0', 'lfk_role_id' => 3,  'lfk_kategori_gereja_id' => $filter_kategori_gereja])->join('cabang_header', 'user_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('user_header.created_date', 'DESC')->get();
        } else {
            $kakak_pa = User::where(['user_header.deleted' => '0', 'lfk_role_id' => 3])->join('cabang_header', 'user_header.lfk_cabang_id', '=', 'cabang_header.cabang_id')->join('kategori_gereja', 'cabang_header.lfk_kategori_gereja_id', '=', 'kategori_gereja.kategori_gereja_id')->orderBy('user_header.created_date', 'DESC')->get();
        }

        $data = [
            'title'             => 'Permuridan',
            'menu_aktif'        => 'permuridan',
            'kakak_pa'          => $kakak_pa,
            'anak_pa'           => User::where(['deleted' => '0', 'lfk_role_id' => 4])->orderBy('created_date', 'DESC')->get(),
            'bahan'             => Bahan::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'bahan_form'        => Bahan::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'bab'               => BAB::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'cabang'            => Cabang::where(['active' => 1, 'deleted' => '0'])->get(),
            'kakak_pa_form'     => User::where(['deleted' => '0', 'active' => '1', 'lfk_role_id' => 3])->get(),
            'kelompok_pa'       => KelompokPA::where(['active' => 1, 'deleted' => '0'])->get(),
            'kategori_gereja'   => KategoriGereja::where(['deleted' => '0', 'active' => 1])->get(),
            'sub_cabang'        => SubCabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];

        return view('database-permuridan', $data);
    }

    function anak_pa_by_kakak_pa($user_id)
    {
        $kakak_pa = User::where(['user_header.deleted' => '0', 'lfk_role_id' => 3, 'user_id' => $user_id])->orderBy('user_header.created_date', 'DESC')->first();

        $data = [
            'title'             => 'Permuridan',
            'menu_aktif'        => 'permuridan',
            'kelompok_pa'       => KelompokPA::where(['active' => 1, 'deleted' => '0', 'lfk_kakak_pa_user_id' => $user_id])->get(),
            'bahan_form'        => Bahan::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
            'anak_pa'           => DB::table('anak_pa')->select('user_header.*', 'kelompok_pa_header.*', 'kakak_pa.nama as nama_kakak_pa', 'bahan_pa_header.*')->join('user_header', 'anak_pa.lfk_user_id', 'user_header.user_id')->join('bahan_pa_header', 'anak_pa.lfk_bahan_pa_id', 'bahan_pa_header.bahan_pa_id')->join('kelompok_pa_header', 'anak_pa.lfk_kelompok_pa_id', 'kelompok_pa_header.kelompok_pa_id')->join('user_header as kakak_pa', 'kelompok_pa_header.lfk_kakak_pa_user_id', '=', 'kakak_pa.user_id')->where(['kelompok_pa_header.lfk_kakak_pa_user_id' => $kakak_pa->user_id, 'user_header.lfk_role_id' => 4, 'user_header.deleted' => '0'])->get(),
            'kakak_pa'          => $kakak_pa,
        ];

        return view('database.anak_pa_by_kakak_pa', $data);
    }

    public function editpass($id)
    {
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


    // ------------------------------------------------------------------------
    // logic
    // ------------------------------------------------------------------------
    public function tambah_kakak_pa()
    {
        $value = (object) request()->validate([
            'nama'          => 'required',
            'email'         => 'required|email',
            'password'      => '',
            'gender'        => 'required',
            'phone'         => '',
            'alamat'        => '',
            'lfk_cabang_id' => 'required',
        ]);

        $kakak_pa = User::where('email', $value->email)->first();

        if ($kakak_pa) {
            return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('gagal', 'Email sudah digunakan');
        }

        $kakak_pa = new User;
        $kakak_pa->lfk_role_id      = 3;
        $kakak_pa->nama             = $value->nama;
        $kakak_pa->email            = $value->email;
        $kakak_pa->gender           = $value->gender;
        $kakak_pa->phone            = $value->phone;
        $kakak_pa->alamat           = $value->alamat;
        $kakak_pa->lfk_cabang_id    = $value->lfk_cabang_id;

        // if($value->password != '') {
        //     $kakak_pa->password     = bcrypt($value->password);
        // }
        $cek = $kakak_pa->save();
        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->with('berhasil', 'Berhasil menyimpan data');
    }

    public function edit_kakak_pa($user_id)
    {
        $value = (object) request()->validate([
            'nama'          => 'required',
            'email'         => 'required|email',
            'gender'        => 'required',
            'phone'         => '',
            'alamat'        => '',
            'lfk_cabang_id' => 'required',
        ]);

        $kakak_pa = User::where('user_id', $user_id)->first();
        if (!$kakak_pa) {
            return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $kakak_pa->nama             = $value->nama;
        $kakak_pa->email            = $value->email;
        $kakak_pa->gender           = $value->gender;
        $kakak_pa->phone            = $value->phone;
        $kakak_pa->alamat           = $value->alamat;
        $kakak_pa->lfk_cabang_id    = $value->lfk_cabang_id;

        $cek = $kakak_pa->save();
        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_kakak_pa($user_id = null)
    {
        if ($user_id == null) {
            return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $kakak_pa = User::where('user_id', $user_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kakak_pa) {
            return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $kakak_pa->deleted = 1;
        $cek = $kakak_pa->save();

        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect("superadmin/database/database-permuridan?tab=kakak_pa")->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

    public function tambah_anak_pa()
    {
        $value = (object) request()->validate([
            'nama'              => 'required',
            'gender'            => 'required',
            'phone'             => 'required|numeric',
            'alamat'            => 'required',
            'lfk_cabang_id' => 'required',
            'kelompok_pa'       => 'required',
            'lfk_bahan_pa_id'   => 'required',
        ]);



        DB::beginTransaction();
        try {
            $anak_pa                            = (object)[];

            $anak_pa->lfk_role_id               = 4;
            $anak_pa->nama                      = $value->nama;
            $anak_pa->gender                    = $value->gender;
            $anak_pa->phone                     = $value->phone;
            $anak_pa->alamat                    = $value->alamat;
            $anak_pa->lfk_cabang_id             = $value->lfk_cabang_id;
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
            'lfk_cabang_id'    => 'required',
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
            $anak_pa_detail->lfk_user_id = $anak_pa->user_id;
        }
        $anak_pa->nama = $value->nama;
        $anak_pa->gender = $value->gender;
        $anak_pa->phone = $value->phone;
        $anak_pa->alamat = $value->alamat;
        $anak_pa->lfk_cabang_id = $value->lfk_cabang_id;

        $anak_pa_detail->lfk_bahan_pa_id = $value->lfk_bahan_pa_id;
        $anak_pa_detail->lfk_kelompok_pa_id = $value->kelompok_pa;

        $cek1 = $anak_pa->save();
        $cek2 = $anak_pa_detail->save();
        if (!$cek1 || !$cek2) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_anak_pa($user_id, $anak_pa_user_id)
    {
        if ($anak_pa_user_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $anak_pa = User::where('user_id', $anak_pa_user_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
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

    public function tambah_bahan()
    {
        $value = (object) request()->validate([
            'judul'                     => 'required',
            'tahun_terbit'              => 'required|numeric|max:' . date('Y'),
            'deskripsi'                 => 'nullable',
            'file_bahan_pa'             => 'nullable',
        ]);

        $bahan = new Bahan;

        $bahan->judul               = $value->judul;
        $bahan->tahun_terbit        = $value->tahun_terbit;
        $bahan->deskripsi           = $value->deskripsi;

        if (request()->hasFile('file_bahan_pa')) {
            $file = request()->file('file_bahan_pa');
            $filename = '/bahan/bahan-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $bahan->file_bahan_pa = $filename;
        }

        $cek = $bahan->save();
        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=bahan")->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect("superadmin/database/database-permuridan?tab=bahan")->with('berhasil', 'Berhasil menyimpan data');
    }
    public function edit_bahan($bahan_pa_id)
    {
        $value = (object) request()->validate([
            'judul'                     => 'required',
            'tahun_terbit'              => 'required|numeric|max:' . date('Y'),
            'deskripsi'                 => 'nullable',
            'file_bahan_pa'             => 'nullable',
        ]);

        $bahan = Bahan::where('bahan_pa_id', $bahan_pa_id)->first();
        if (!$bahan) {
            return redirect("superadmin/database/database-permuridan?tab=bahan")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $bahan->judul               = $value->judul;
        $bahan->tahun_terbit        = $value->tahun_terbit;
        $bahan->deskripsi           = $value->deskripsi;

        if (request()->hasFile('file_bahan_pa')) {
            $file = request()->file('file_bahan_pa');
            $filename = '/bahan/bahan-' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $bahan->file_bahan_pa = $filename;
        }


        $cek = $bahan->save();
        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=bahan")->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect("superadmin/database/database-permuridan?tab=bahan")->with('berhasil', 'Berhasil menyimpan data');
    }
    public function hapus_bahan($bahan_pa_id = null)
    {
        if ($bahan_pa_id == null) {
            return redirect("superadmin/database/database-permuridan?tab=bahan")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $bahan = Bahan::where('bahan_pa_id', $bahan_pa_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$bahan) {
            return redirect("superadmin/database/database-permuridan?tab=bahan")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $bahan->deleted = 1;
        $cek = $bahan->save();

        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=bahan")->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect("superadmin/database/database-permuridan?tab=bahan")->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

    public function tambah_bab()
    {
        $value = (object) request()->validate([
            'bab_pa_name'           => 'required',
        ]);

        $bab = new BAB;

        $bab->bab_pa_name       = $value->bab_pa_name;


        $cek = $bab->save();
        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=bab")->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect("superadmin/database/database-permuridan?tab=bab")->with('berhasil', 'Berhasil menyimpan data');
    }
    public function edit_bab($bab_pa_id)
    {
        $value = (object) request()->validate([
            'bab_pa_name'           => 'required',
        ]);

        $bab = BAB::where('bab_pa_id', $bab_pa_id)->first();

        $bab->bab_pa_name       = $value->bab_pa_name;


        $cek = $bab->save();
        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=bab")->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect("superadmin/database/database-permuridan?tab=bab")->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_bab($bab_pa_id = null)
    {
        if ($bab_pa_id == null) {
            return redirect("superadmin/database/database-permuridan?tab=bab")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $bab = BAB::where('bab_pa_id', $bab_pa_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$bab) {
            return redirect("superadmin/database/database-permuridan?tab=bab")->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $bab->deleted = 1;
        $cek = $bab->save();

        if (!$cek) {
            return redirect("superadmin/database/database-permuridan?tab=bab")->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect("superadmin/database/database-permuridan?tab=bab")->withInput()->with('berhasil', 'Berhasil menghapus data');
    }









































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    // kakak pa
    public function api_kakak_pa_all()
    {
        $kakak_pa = User::with(['cabang'])->where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $kakak_pa,
        ]);
    }
    public function api_kakak_pa_detail($user_id)
    {
        $kakak_pa = User::with(['cabang'])->where('user_id', $user_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$kakak_pa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
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
        $anak_pa = User::with(['cabang', 'anak_pa_detail'])->where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $anak_pa,
        ]);
    }
    public function api_anak_pa_detail($user_id)
    {
        $anak_pa = User::with(['cabang', 'anak_pa_detail'])->where('user_id', $user_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$anak_pa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
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
            ], 400);
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
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $bab,
            ]);
        }
    }
}
