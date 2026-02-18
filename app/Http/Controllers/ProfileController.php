<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use S3Helper;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function get_file()
    {
        $q = request('q');
        // $cek = S3Helper::delete($q);
        // return (string) $cek;
        // $cek = Storage::disk('s3')->delete($q);

        // if ($cek['DeleteMarker']) {
        //     echo $q . ' was deleted or does not exist.' . PHP_EOL;
        // } else {
        //     exit('Error: ' . $q . ' was not deleted.' . PHP_EOL);
        // }
        try {
            $result = S3Helper::get($q);
            if (!$result) {
                return false;
            }
            return response($result['Body'])->header('Content-Type', $result['ContentType']);
        } catch (\Throwable $th) {
        }
    }

    public function profile()
    {
        $user = Auth::user();

        $data = [
            'title'             => 'Dashboard',
            'menu_aktif'        => 'dashboard',
            'user'              => $user,
        ];

        // return $data;
        return view('profile', $data);
    }


    public function edit_profile()
    {
        $value = (object) request()->validate([
            'nama' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
        ]);
        $auth = Auth::user();
        $user = User::where('user_id', $auth->user_id)->first();
        if (!$user) {
            return redirect()->back()->with('gagal', 'User tidak ditemukan');
        }

        $user->nama = $value->nama;
        $user->gender = $value->gender;
        $user->alamat = $value->alamat;


        $filename = '';
        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $filename = '/avatar/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }

            $user->profile_pic = $filename;
        }

        $cek = $user->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Gagal mengubah data');
        }
        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }
    public function edit_password()
    {
        $value = (object) request()->validate([
            'password_lama' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $auth = Auth::user();
        $user = User::where('user_id', $auth->user_id)->first();
        if (!$user) {
            return redirect()->back()->with('gagal', 'User tidak ditemukan');
        } elseif (!Hash::check($value->password_lama, $user->password)) {
            return redirect()->back()->with('gagal', 'Password lama salah');
        }

        $user->password = bcrypt($value->password);

        $cek = $user->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Gagal mengubah data');
        }
        return redirect()->back()->with('berhasil', 'Berhasil mengubah data');
    }
}
