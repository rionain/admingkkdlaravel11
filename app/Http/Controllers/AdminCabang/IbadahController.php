<?php

namespace App\Http\Controllers\AdminCabang;

use App\Http\Controllers\Controller;
use App\Models\Ibadah;
use Illuminate\Http\Request;

class IbadahController extends Controller
{
    public function ibadah()
    {
        $subcabangid = auth()->user()->lfk_cabang_id;
        $ibadah = Ibadah::where(['ibadah_status' => 1, 'active' => 1, 'deleted' => '0', 'lfk_cabang_id' => $subcabangid])->orderBy('ibadah_day', 'DESC')->get();
        $data = [
            'title'             => 'Ibadah',
            'menu_aktif'        => 'ibadah',
            'ibadah'            => $ibadah,
        ];

        return view('admin-cabang.ibadah.list', $data);
    }
}
