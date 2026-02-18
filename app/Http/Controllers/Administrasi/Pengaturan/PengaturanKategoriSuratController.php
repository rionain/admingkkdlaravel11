<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanKategoriSuratController extends Controller
{
    public function kategori_surat()
    {
        $data = [
            'title'             => 'Pengaturan Kategori Surat',
            'menu_aktif'        => 'pengaturan_kategori_surat',
        ];
        return view('pengaturan.pengaturan-kategori-list', $data);
    }

    public function edit_kategori()
    {
        $data = [
            'title'             => 'Edit Pengaturan Kategori Surat',
            'menu_aktif'        => 'pengaturan_kategori_surat',
        ];

        return view('pengaturan.edit-kategori-surat', $data);
    }
}
