<?php

namespace App\Http\Controllers;

use App\Models\Superadmin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LupaPasswordController extends Controller
{
    public function lupapassword()
    {
        $data = [
            'title'             => 'Lupa password',
            'message'           => 'Lupa passowrd'
        ];

        return view('forgot-password', $data);
    }

    public function lupapassword_action()
    {
        request()->validate([
            'email'         => 'required|email',
        ]);

        $data_user = User::where('email', request()->input('email'))->where(function ($query) {
            $query->where('lfk_role_id', '!=', 3)->where('lfk_role_id', '!=', 4);
        })->where('deleted', '0')->first();
        if (!$data_user) {
            return redirect()->back()->with('gagal', 'Email tidak ditemukan');
        }
        $data_user->is_forget_password = true;
        $data_user->forget_password_expired = Carbon::now()->addDay(7);
        $data_user->save();
        $data = [
            'nama' => $data_user->nama,
            'email' => $data_user->email,
            'phone' => $data_user->phone,
            'user_id' => $data_user->user_id,
            'forget_password_expired' => $data_user->forget_password_expired,
        ];
        try {
            Mail::send('emails.lupapassword', $data, function ($message) use ($data_user) {
                // $message->from('john@johndoe.com', 'John Doe');
                // $message->sender($data_user->email, $data_user->nama_lengkap);
                $message->to($data_user->email, $data_user->nama);
                $message->subject('Lupa password');
                // $message->priority(1);
            });
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('gagal', 'Gagal mengirim email');
        }

        if (count(Mail::failures()) > 0) {
            return redirect()->back()->with('gagal', 'Gagal mengirim email');
        }
        return redirect()->back()->with('berhasil', 'Silahkan cek email anda');
    }

    public function ganti_password($user_id)
    {
        $user = User::where(DB::raw("md5(user_id)"), $user_id)->first();
        if (!$user->is_forget_password) {
            return redirect('/login');
        } elseif (format_date($user->forget_password_expired) <= date('Y-m-d')) {
            return redirect('/login')->with('gagal', 'Masa request lupa password telah habis');
        }
        $data = [
            'user' => $user,
            'user_id' => $user_id,
            'title' => 'Ganti Password'
        ];
        return view('ganti-password', $data);
    }

    public function ganti_password_action($user_id)
    {
        $value = (object) request()->validate([
            'password'         => 'required|min:8|confirmed',
        ]);
        $user = User::where(DB::raw("md5(user_id)"), $user_id)->first();
        $user->is_forget_password       = false;
        $user->forget_password_expired  = null;
        $user->password                 = bcrypt($value->password);
        $cek = $user->save();
        if (!$cek) {
            return redirect('/login')->with('gagal', 'Ubah pasword gagal');
        }
        return redirect('/login')->with('berhasil', 'Ubah pasword berhasil');
    }
}
