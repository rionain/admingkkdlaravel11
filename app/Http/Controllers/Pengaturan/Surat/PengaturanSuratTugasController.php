<?php

namespace App\Http\Controllers\Pengaturan\Surat;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\Kop;
use App\Models\PengaturanSuratTugas;
use App\Models\PengaturanSuratTugasTTD;
use App\Models\TandaTangan;
use App\Models\Tembusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanSuratTugasController extends Controller
{
    public function list()
    {
        $pengaturan = PengaturanSuratTugas::orderBy('created_date', 'DESC')->get();


        $data = [
            'title'             => 'Pengaturan surat tugas',
            'menu_aktif'        => 'pengaturan_surat_tugas',
            'pengaturan'        => $pengaturan,
        ];

        return view('pengaturan.surat.tugas.pengaturan-surat-tugas-list', $data);
    }

    public function lihat($pengaturan_surat_tugas_id)
    {
        $pengaturan_surat_tugas = PengaturanSuratTugas::find($pengaturan_surat_tugas_id);
        if (!$pengaturan_surat_tugas) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'                             => 'Pengaturan Surat tugas',
            'menu_aktif'                        => 'pengaturan_surat_tugas',
            'pengaturan_surat_tugas'       => $pengaturan_surat_tugas,
        ];

        error_reporting(0);
        // or error_reporting(E_ALL & ~E_NOTICE); to show errors but not notices
        ini_set("display_errors", 0);

        return view('pengaturan.surat.tugas.template-surat-tugas', $data);
    }

    public function tambah()
    {
        $kop                = Kop::where(['active' => 1, 'deleted' => '0'])->get();
        $tembusan           = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();
        $footer             = Footer::where(['active' => 1, 'deleted' => '0'])->get();
        $tanda_tangan       = TandaTangan::where(['active' => 1, 'deleted' => '0'])->with('user')->get();

        $data = [
            'title'             => 'Pengaturan surat tugas',
            'menu_aktif'        => 'pengaturan_surat_tugas',
            'kop'               => $kop,
            'tembusan'          => $tembusan,
            'footer'            => $footer,
            'tanda_tangan'      => $tanda_tangan,
            'pengaturan'        => (object)[],
        ];

        return view('pengaturan.surat.tugas.pengaturan-surat-tugas-tambah', $data);
    }

    public function tambah_action()
    {
        $value = (object) request()->validate([
            'nama_pengaturan'   => 'required',
            'kop_id'            => 'required',
            'ttd_id'            => 'required',
            'tembusan_id'       => 'required',
            'footer_id'         => 'required',
        ]);

        DB::beginTransaction();

        try {
            $pengaturan = (object)[];
            $pengaturan->nama_pengaturan = $value->nama_pengaturan;
            $pengaturan->kop_id = json_decode($value->kop_id)->kop_id;
            $pengaturan->tembusan_id = json_decode($value->tembusan_id)->tembusan_id;
            $pengaturan->footer_id = json_decode($value->footer_id)->template_footer_id;
            PengaturanSuratTugas::insert((array)$pengaturan);
            $pengaturan_id =  DB::getPdo()->lastInsertId();

            $data = [];
            foreach ($value->ttd_id as $key => $item) {
                $data[$key] = ['ttd_id' => json_decode($item)->ttd_id, 'order_ttd' => $key + 1, 'pengaturan_surat_tugas_id' => $pengaturan_id];
            }
            PengaturanSuratTugasTTD::insert((array)$data);


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }
        return redirect()->back()->with('berhasil', 'Data berhasil ditambahkan');
    }


    public function edit($pengaturan_surat_tugas_id)
    {
        $pengaturan = PengaturanSuratTugas::find($pengaturan_surat_tugas_id);

        $kop                = Kop::where(['active' => 1, 'deleted' => '0'])->get();
        $tembusan           = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();
        $footer             = Footer::where(['active' => 1, 'deleted' => '0'])->get();
        $tanda_tangan       = TandaTangan::where(['active' => 1, 'deleted' => '0'])->with('user')->get();

        $data = [
            'title'             => 'Pengaturan surat tugas',
            'menu_aktif'        => 'pengaturan_surat_tugas',
            'kop'               => $kop,
            'tembusan'          => $tembusan,
            'footer'            => $footer,
            'tanda_tangan'      => $tanda_tangan,
            'pengaturan'        => $pengaturan,
        ];

        return view('pengaturan.surat.tugas.pengaturan-surat-tugas-tambah', $data);
    }
    public function edit_action($pengaturan_surat_tugas_id)
    {
        $value = (object) request()->validate([
            'nama_pengaturan'   => 'required',
            'kop_id'            => 'required',
            'ttd_id'            => 'required',
            'tembusan_id'       => 'required',
            'footer_id'         => 'required',
        ]);

        DB::beginTransaction();

        try {
            $pengaturan = (object)[];
            $pengaturan->nama_pengaturan = $value->nama_pengaturan;
            $pengaturan->kop_id = json_decode($value->kop_id)->kop_id;
            $pengaturan->tembusan_id = json_decode($value->tembusan_id)->tembusan_id;
            $pengaturan->footer_id = json_decode($value->footer_id)->template_footer_id;
            PengaturanSuratTugas::where('pengaturan_surat_tugas_id', $pengaturan_surat_tugas_id)->update((array)$pengaturan);

            $data = [];

            PengaturanSurattugasTTD::where(['pengaturan_surat_tugas_id' => $pengaturan_surat_tugas_id])->delete();
            foreach ($value->ttd_id as $key => $item) {
                $data[$key] = ['ttd_id' => json_decode($item)->ttd_id, 'order_ttd' => $key + 1, 'pengaturan_surat_tugas_id' => $pengaturan_surat_tugas_id];
            }
            PengaturanSurattugasTTD::insert((array)$data);


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }
        return redirect()->back()->with('berhasil', 'Data berhasil diubah');
    }
    public function hapus($pengaturan_surat_tugas_id)
    {
        $pengaturan = PengaturanSuratTugas::find($pengaturan_surat_tugas_id);
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
