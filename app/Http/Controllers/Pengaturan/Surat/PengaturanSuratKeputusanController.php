<?php

namespace App\Http\Controllers\Pengaturan\Surat;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\Kop;
use App\Models\PengaturanSuratKeputusan;
use App\Models\PengaturanSuratKeputusanTTD;
use App\Models\TandaTangan;
use App\Models\Tembusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanSuratKeputusanController extends Controller
{
    public function list()
    {
        $pengaturan = PengaturanSuratKeputusan::orderBy('created_date', 'DESC')->get();


        $data = [
            'title'             => 'Pengaturan surat keputusan',
            'menu_aktif'        => 'pengaturan_surat_keputusan',
            'pengaturan'        => $pengaturan,
        ];

        return view('pengaturan.surat.keputusan.pengaturan-surat-keputusan-list', $data);
    }

    public function lihat($pengaturan_surat_keputusan_id)
    {
        $pengaturan_surat_keputusan = PengaturanSuratKeputusan::find($pengaturan_surat_keputusan_id);
        if (!$pengaturan_surat_keputusan) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'                             => 'Pengaturan Surat keputusan',
            'menu_aktif'                        => 'pengaturan_surat_keputusan',
            'pengaturan_surat_keputusan'       => $pengaturan_surat_keputusan,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('pengaturan.surat.keputusan.template-surat-keputusan', $data);
    }

    public function tambah()
    {
        $kop                = Kop::where(['active' => 1, 'deleted' => '0'])->get();
        $tembusan           = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();
        $footer             = Footer::where(['active' => 1, 'deleted' => '0'])->get();
        $tanda_tangan       = TandaTangan::where(['active' => 1, 'deleted' => '0'])->with('user')->get();

        $data = [
            'title'             => 'Pengaturan surat keputusan',
            'menu_aktif'        => 'pengaturan_surat_keputusan',
            'kop'               => $kop,
            'tembusan'          => $tembusan,
            'footer'            => $footer,
            'tanda_tangan'      => $tanda_tangan,
        ];

        return view('pengaturan.surat.keputusan.pengaturan-surat-keputusan-tambah', $data);
    }

    public function tambah_action()
    {
        $value = (object) request()->validate([
            'nama_pengaturan'   => 'required',
            'kop_id'            => 'required',
            'pembukaan'         => 'required',
            'penutupan'         => 'required',
            'ttd_id'            => 'required',
            'tembusan_id'       => 'required',
            'footer_id'         => 'required',
        ]);

        DB::beginTransaction();

        try {
            $pengaturan = (object)[];
            $pengaturan->nama_pengaturan = $value->nama_pengaturan;
            $pengaturan->kop_id = json_decode($value->kop_id)->kop_id;
            $pengaturan->pembukaan = $value->pembukaan;
            $pengaturan->penutupan = $value->penutupan;
            $pengaturan->tembusan_id = json_decode($value->tembusan_id)->tembusan_id;
            $pengaturan->footer_id = json_decode($value->footer_id)->template_footer_id;
            PengaturanSuratKeputusan::insert((array)$pengaturan);
            $pengaturan_id =  DB::getPdo()->lastInsertId();

            $data = [];
            foreach ($value->ttd_id as $key => $item) {
                $data[$key] = ['ttd_id' => json_decode($item)->ttd_id, 'order_ttd' => $key + 1, 'pengaturan_surat_keputusan_id' => $pengaturan_id];
            }
            PengaturanSuratKeputusanTTD::insert((array)$data);


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }
        return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
    }


    public function edit($pengaturan_surat_keputusan_id)
    {
        $pengaturan = PengaturanSuratKeputusan::find($pengaturan_surat_keputusan_id);

        $kop                = Kop::where(['active' => 1, 'deleted' => '0'])->get();
        $tembusan           = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();
        $footer             = Footer::where(['active' => 1, 'deleted' => '0'])->get();
        $tanda_tangan       = TandaTangan::where(['active' => 1, 'deleted' => '0'])->with('user')->get();

        $data = [
            'title'             => 'Pengaturan surat keputusan',
            'menu_aktif'        => 'pengaturan_surat_keputusan',
            'kop'               => $kop,
            'tembusan'          => $tembusan,
            'footer'            => $footer,
            'tanda_tangan'      => $tanda_tangan,
            'pengaturan'        => $pengaturan,
        ];

        return view('pengaturan.surat.keputusan.pengaturan-surat-keputusan-tambah', $data);
    }
    public function edit_action($pengaturan_surat_keputusan_id)
    {
        $value = (object) request()->validate([
            'nama_pengaturan'   => 'required',
            'kop_id'            => 'required',
            'pembukaan'         => 'required',
            'penutupan'         => 'required',
            'ttd_id'            => 'required',
            'tembusan_id'       => 'required',
            'footer_id'         => 'required',
        ]);

        DB::beginTransaction();

        try {
            $pengaturan = (object)[];
            $pengaturan->nama_pengaturan = $value->nama_pengaturan;
            $pengaturan->kop_id = json_decode($value->kop_id)->kop_id;
            $pengaturan->pembukaan = $value->pembukaan;
            $pengaturan->penutupan = $value->penutupan;
            $pengaturan->tembusan_id = json_decode($value->tembusan_id)->tembusan_id;
            $pengaturan->footer_id = json_decode($value->footer_id)->template_footer_id;
            PengaturanSuratKeputusan::where('pengaturan_surat_keputusan_id', $pengaturan_surat_keputusan_id)->update((array)$pengaturan);

            $data = [];

            PengaturanSuratkeputusanTTD::where(['pengaturan_surat_keputusan_id' => $pengaturan_surat_keputusan_id])->delete();
            foreach ($value->ttd_id as $key => $item) {
                $data[$key] = ['ttd_id' => json_decode($item)->ttd_id, 'order_ttd' => $key + 1, 'pengaturan_surat_keputusan_id' => $pengaturan_surat_keputusan_id];
            }
            PengaturanSuratkeputusanTTD::insert((array)$data);


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }
        return redirect()->back()->with('berhasil', 'Data berhasil diubah');
    }
    public function hapus($pengaturan_surat_keputusan_id)
    {
        $pengaturan = PengaturanSuratKeputusan::find($pengaturan_surat_keputusan_id);
        if ($pengaturan) {
            $cek = $pengaturan->delete();
            if ($cek) {
                return redirect()->back()->with('berhasil', 'Data berhasil dihapus');
            } else {
                return redirect()->back()->with('gagal', 'Data gagal dihapus');
            }
        } else {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
    }
}
