<?php

namespace App\Http\Controllers\Pengaturan\Surat;

use App\Http\Controllers\Controller;
use App\Models\Kop;
use App\Models\PengaturanSuratPenunjukan;
use App\Models\Tembusan;
use App\Models\Footer;
use App\Models\PengaturanSuratPenunjukanTTD;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanSuratPenunjukanController extends Controller
{
    public function list()
    {
        $pengaturan = PengaturanSuratPenunjukan::orderBy('created_date', 'DESC')->get();


        $data = [
            'title'             => 'Pengaturan surat penunjukan',
            'menu_aktif'        => 'pengaturan_surat_penunjukan',
            'pengaturan'        => $pengaturan,
        ];

        return view('pengaturan.surat.penunjukan.pengaturan-surat-penunjukan-list', $data);
    }

    public function lihat($pengaturan_surat_penunjukan_id)
    {
        $pengaturan_surat_penunjukan = PengaturanSuratPenunjukan::find($pengaturan_surat_penunjukan_id);
        if (!$pengaturan_surat_penunjukan) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'                             => 'Pengaturan Surat Penunjukan',
            'menu_aktif'                        => 'pengaturan_surat_penunjukan',
            'pengaturan_surat_penunjukan'       => $pengaturan_surat_penunjukan,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('pengaturan.surat.penunjukan.template-surat-penunjukan', $data);
    }

    public function tambah()
    {
        $kop                = Kop::where(['active' => 1, 'deleted' => '0'])->get();
        $tembusan           = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();
        $footer             = Footer::where(['active' => 1, 'deleted' => '0'])->get();
        $tanda_tangan       = TandaTangan::where(['active' => 1, 'deleted' => '0'])->with('user')->get();

        $data = [
            'title'             => 'Pengaturan surat penunjukan',
            'menu_aktif'        => 'pengaturan_surat_penunjukan',
            'kop'               => $kop,
            'tembusan'          => $tembusan,
            'footer'            => $footer,
            'tanda_tangan'      => $tanda_tangan,
            'pengaturan'        => (object)[],
        ];

        return view('pengaturan.surat.penunjukan.pengaturan-surat-penunjukan-tambah', $data);
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
            PengaturanSuratPenunjukan::insert((array)$pengaturan);
            $pengaturan_id =  DB::getPdo()->lastInsertId();

            $data = [];
            foreach ($value->ttd_id as $key => $item) {
                $data[$key] = ['ttd_id' => json_decode($item)->ttd_id, 'order_ttd' => $key + 1, 'pengaturan_surat_penunjukan_id' => $pengaturan_id];
            }
            PengaturanSuratPenunjukanTTD::insert((array)$data);


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }
        return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
    }


    public function edit($pengaturan_surat_penunjukan_id)
    {
        $pengaturan = PengaturanSuratPenunjukan::find($pengaturan_surat_penunjukan_id);

        $kop                = Kop::where(['active' => 1, 'deleted' => '0'])->get();
        $tembusan           = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();
        $footer             = Footer::where(['active' => 1, 'deleted' => '0'])->get();
        $tanda_tangan       = TandaTangan::where(['active' => 1, 'deleted' => '0'])->with('user')->get();

        $data = [
            'title'             => 'Pengaturan surat penunjukan',
            'menu_aktif'        => 'pengaturan_surat_penunjukan',
            'kop'               => $kop,
            'tembusan'          => $tembusan,
            'footer'            => $footer,
            'tanda_tangan'      => $tanda_tangan,
            'pengaturan'        => $pengaturan,
        ];

        return view('pengaturan.surat.penunjukan.pengaturan-surat-penunjukan-tambah', $data);
    }
    public function edit_action($pengaturan_surat_penunjukan_id)
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
            PengaturanSuratPenunjukan::where('pengaturan_surat_penunjukan_id', $pengaturan_surat_penunjukan_id)->update((array)$pengaturan);

            $data = [];

            PengaturanSuratPenunjukanTTD::where(['pengaturan_surat_penunjukan_id' => $pengaturan_surat_penunjukan_id])->delete();
            foreach ($value->ttd_id as $key => $item) {
                $data[$key] = ['ttd_id' => json_decode($item)->ttd_id, 'order_ttd' => $key + 1, 'pengaturan_surat_penunjukan_id' => $pengaturan_surat_penunjukan_id];
            }
            PengaturanSuratPenunjukanTTD::insert((array)$data);


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }
        return redirect()->back()->with('berhasil', 'Data berhasil diubah');
    }
    public function hapus($pengaturan_surat_penunjukan_id)
    {
        $pengaturan = PengaturanSuratPenunjukan::find($pengaturan_surat_penunjukan_id);
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
