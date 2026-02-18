@extends('emails.template')
@section('title')
    Ulang tahun
@endsection
@section('content')
    <style>
        #tabel_ulang_tahun {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #tabel_ulang_tahun td,
        #tabel_ulang_tahun th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #tabel_ulang_tahun tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #tabel_ulang_tahun tr:hover {
            background-color: #ddd;
        }

        #tabel_ulang_tahun th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }

    </style>
    <h2 style="text-align: center">Ulang tahun</h2>
    <p style="text-align: justify">Berikut adalah list orang yang ulang tahun hari ini</p>
    <div style="">
        <table id="tabel_ulang_tahun">
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
            </tr>
            @foreach ($jemaat_ultah as $key => $item)
                <tr>
                    <td style="text-align: center">{{ ++$key }}</td>
                    <td>{{ @$item->status_jemaat->status_jemaat }}</td>
                    <td>{{ $item->nama }}</td>
                    <td style="text-align: center">
                        {{ $item->jenis_kelamin === 'l' ? 'Laki-laki' : 'Perempuan' }}
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
    <br>
    <p style="text-align: justify">
        E-mail ini dibuat otomatis, mohon tidak membalas. Jika butuh bantuan, silakan hubungi sinode
        Care.
    </p>
@endsection
