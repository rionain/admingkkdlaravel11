<?php

namespace App\Http\Controllers\GeneralSetting;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\KategoriGereja;
use App\Models\RoleUsers;
use App\Models\SubCabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function user()
    {
        $filter_role = request('filter_role');

        $superadmin = User::where(['lfk_role_id' => 1, 'deleted' => '0', ['user_id', '!=', auth()->user()->user_id]])->orderBy('created_date', 'DESC')->get();
        $admincabang = User::where(['lfk_role_id' => 2, 'deleted' => '0', ['user_id', '!=', auth()->user()->user_id]])->orderBy('created_date', 'DESC')->get();

        if ($filter_role == 1) {
            $users = $superadmin;
        } elseif ($filter_role == 2) {
            $users = $admincabang;
        } else {
            $users = $superadmin->merge($admincabang);
        }


        $data = [
            'title'             => 'User',
            'menu_aktif'        => 'User',
            'message'           => 'User',
            'users'             => $users,
            'roles'             => RoleUsers::where(['active' => 1, 'deleted' => '0'])->where('role_id', '<', 3)->get(),
            'cabang'             => Cabang::where(['active' => 1, 'deleted' => '0'])->get(),
            'kategori_gereja'   => KategoriGereja::where(['deleted' => '0', 'active' => 1])->get(),
            'sub_cabang'        => SubCabang::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];

        return view('setting.setting-user', $data);
    }

    public function tambah_user()
    {
        $value = (object) request()->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'gender'    => 'required',
            'lfk_cabang_id'    => request('role_user') != 1 ? 'required' : '',
            'phone'     => 'required|max:100',
            'alamat'    => 'required',
            'foto'      => request('foto') ? 'required|file|mimes:jpg,jpeg,png' : '',
            'role_user' => 'required',
            'password'  => 'required|confirmed',
        ]);

        $user = User::where('email', $value->email)->first();
        if (!$user) {
            $user = new User;
        } elseif ($user->deleted == 0 || $user->deleted == '0') {
            return redirect()->back()->withInput()->with('gagal', 'Data sudah ada');
        } elseif ($user->deleted == 1 || $user->deleted == '1') {
            $user->deleted          = '0';
        }

        $user->nama          = request('nama');
        $user->email         = request('email');
        $user->gender        = request('gender');
        $user->lfk_cabang_id = request('lfk_cabang_id');
        $user->phone         = request('phone');
        $user->alamat        = request('alamat');
        $user->lfk_role_id   = request('role_user');
        $user->password      = bcrypt(request('password'));

        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/profile/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $user->profile_pic = $filename;
        }
        // else {
        //     return redirect()->back()->withInput()->with('gagal', 'Foto gagal disimpan');
        // }

        $cek = $user->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data');
    }


    public function edit_user($user_id)
    {
        $value = (object) request()->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'gender'    => 'required',
            'lfk_cabang_id'    => request('role_user') != 1 ? 'required' : '',
            'phone'     => 'required|max:100',
            'alamat'    => 'required',
            'foto'      => request('foto') ? 'required|file|mimes:jpg,jpeg,png' : '',
            'role_user' => 'required',
        ]);

        $user = User::where(['user_id' => $user_id, 'deleted' => '0'])->first();
        if (!$user) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $user->nama          = request('nama');
        $user->email         = request('email');
        $user->gender        = request('gender');
        $user->lfk_cabang_id = request('lfk_cabang_id');
        $user->phone         = request('phone');
        $user->alamat        = request('alamat');
        $user->lfk_role_id   = request('role_user');

        if (request('foto')) {
            if (request()->hasFile('foto')) {
                $file = request()->file('foto');
                $filename = '/profile/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

                $cek = Storage::cloud()->put($filename, file_get_contents($file));
                if (!$cek) {
                    return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
                }

                $user->profile_pic = $filename;
            } else {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan foto');
            }
        }

        $cek = $user->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengedit data');
        }

        return redirect()->back()->with('berhasil', 'Berhasil mengedit data');
    }
    public function hapus_user($user_id = null)
    {
        if ($user_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $user = User::where('user_id', $user_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$user) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $user->deleted = 1;
        $cek = $user->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }


































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function api_users_all()
    {
        $users = User::where(['active' => 1, 'deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->get();

        return response()->json([
            'status' => true,
            'data' => $users,
        ]);
    }
    public function api_users_detail($user_id)
    {
        $users = User::where('user_id', $user_id)->where(['active' => 1, 'deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->first();

        if (!$users) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $users,
            ]);
        }
    }
}
