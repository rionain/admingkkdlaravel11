<?php

namespace App\Http\Controllers;

use App\Models\Superadmin;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role_user->nama_role == 'Superadmin') {
                return redirect('superadmin/dashboard');
            } elseif (Auth::user()->role_user->nama_role == 'Admin Cabang') {
                return redirect('admin-cabang/dashboard');
            } elseif (Auth::user()->role_user->nama_role == 'Approval') {
                return redirect('approval/dashboard');
            } else {
                return redirect('superadmin/dashboard');
            }
        }
        $throttleKey = 'login-attempts:' . request()->ip();
        $strikes = RateLimiter::attempts($throttleKey);

        $data = [
            'title'             => 'Login',
            'message'           => 'tampilan login',
            'strikes'           => $strikes
        ];

        return view('loginpage', $data);
    }

    public function login_action()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $email = request('email');
        $password = request('password');
        $throttleKey = 'login-attempts:' . request()->ip();

        // 1. Check if we need Captcha (strikes >= 5)
        if (RateLimiter::attempts($throttleKey) >= 5) {
            $turnstileResponse = request('cf-turnstile-response');

            if (!$turnstileResponse) {
                return redirect()->back()->with('gagal', 'Selesaikan captcha terlebih dahulu')->withInput();
            }

            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => config('services.turnstile.secret_key'),
                'response' => $turnstileResponse,
                'remoteip' => request()->ip(),
            ]);

            if (!$response->successful() || !$response->json('success')) {
                return redirect()->back()->with('gagal', 'Captcha tidak valid, silakan coba lagi')->withInput();
            }
        }

        $user = User::where('email', $email)->where(function ($query) {
            $query->where('lfk_role_id', '!=', 3)->where('lfk_role_id', '!=', 4);
        })->where('deleted', '0')->first();

        if (!$user) {
            RateLimiter::hit($throttleKey, 3600); // 1 hour lockout if we hit it too hard
            return redirect()->back()->with('gagal', 'Email tidak ditemukan')->withInput();
        } elseif ($user->active != 1 || $user->active != '1') {
            return redirect()->back()->with('gagal', 'User tidak aktif')->withInput();
        } elseif ($user->deleted != 0 || $user->deleted != '0') {
            return redirect()->back()->with('gagal', 'User tidak ditemukan')->withInput();
        } elseif (!Auth::attempt($credentials)) {
            RateLimiter::hit($throttleKey, 3600);
            return redirect()->back()->with('gagal', 'Password tidak sama dengan database')->withInput();
        }

        // Success - clear strikes
        RateLimiter::clear($throttleKey);

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        $user_role = UserRole::all();
        // dd($user_role->toArray());
        foreach ($user_role as $key => $value) {
            $role_spatie = Role::where('name', $value->nama_role)->first();
            if (!$role_spatie) {
                $cek = Role::create(['name' => $value->nama_role]);
                if (!$cek) {
                    dd('gagal');
                }
            }
        }
        $user->assignRole($user->role_user->nama_role);
        if ($user->role_user->nama_role == 'Superadmin') {
            return redirect('superadmin/dashboard');
        } elseif ($user->role_user->nama_role == 'Admin Cabang') {
            return redirect('admin-cabang/dashboard');
        } elseif ($user->role_user->nama_role == 'Approval') {
            return redirect('approval/dashboard');
        } else {
            return redirect('superadmin/dashboard');
        }
    }































    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
