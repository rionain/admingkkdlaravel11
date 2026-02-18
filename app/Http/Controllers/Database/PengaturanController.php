<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function pengaturan()
    {
        $data = [
            'title'             => 'Pengaturan',
            'menu_aktif'        => 'pengaturan',
        ];

        return view('database-pengaturan', $data);
    }
}
