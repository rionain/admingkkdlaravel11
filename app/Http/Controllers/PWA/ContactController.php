<?php

namespace App\Http\Controllers\PWA;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        $data = [
            'title'             => 'Contact',
            'menu_aktif'        => 'contact',
            'contact'           => Kontak::first()
        ];
        return view('pwa.contact', $data);
    }
    public function edit_contact()
    {
        $value = (object) request()->validate([
            'nama_gereja'   => 'required',
            'alamat_gereja' => 'required',
            'no_telp'       => 'required',
            'email'         => 'required',
            'fb'            => 'required',
            'twitter'       => 'required',
            'linkedin'      => 'required',
        ]);

        $kontak = Kontak::first();
        if (!$kontak) {
            $kontak = new Kontak;
        }

        $kontak->nama_gereja = $value->nama_gereja;
        $kontak->alamat_gereja = $value->alamat_gereja;
        $kontak->no_telp = $value->no_telp;
        $kontak->email = $value->email;
        $kontak->fb = $value->fb;
        $kontak->twitter = $value->twitter;
        $kontak->linkedin = $value->linkedin;

        $cek = $kontak->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }
}
