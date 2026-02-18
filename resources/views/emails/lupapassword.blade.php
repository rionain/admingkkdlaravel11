@extends('emails.template')
@section('title') Lupa Password @endsection
@section('content')

    <h2 style="text-align: center">LUPA PASSWORD</h2>
    <p>Halo Sinodian,</p>
    <h4 style="text-align: justify">Klik link dibawah ini untuk mereset akun anda</h4>
    <div style="width: 100%;text-align: center;margin: 50px 0">
        <p style="font-style: italic;color: #E74C3C">*expired to {{ $forget_password_expired }}</p>
        <a style="border-radius: 20px;background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;"
            href="{{ url('lupapassword/ganti_password', ['user_id' => md5($user_id)]) }}">
            Klik disini
        </a>
    </div>
    <p style="text-align: justify">Mohon jangan sebarkan link ini ke siapapun, termasuk pihak yang
        mengatasnamakan sinode.
    </p>
    <br>
    <p style="text-align: justify">
        E-mail ini dibuat otomatis, mohon tidak membalas. Jika butuh bantuan, silakan hubungi sinode
        Care.
    </p>

@endsection
