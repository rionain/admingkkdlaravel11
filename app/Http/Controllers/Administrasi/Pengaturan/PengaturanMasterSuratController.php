<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Body;
use App\Models\Footer;
use App\Models\JenisSurat;
use App\Models\Kop;
use App\Models\MasterSurat;
use App\Models\MasterSuratDetailBody;
use App\Models\MasterSuratDetailTTD;
use App\Models\TandaTangan;
use App\Models\Tembusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengaturanMasterSuratController extends Controller
{
    public function master_surat()
    {
        $master_surat = MasterSurat::where(['deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $data = [
            'title'             => 'Pengaturan Master Surat',
            'menu_aktif'        => 'pengaturan_master_surat',
            'master_surat'      => $master_surat,
        ];
        return view('pengaturan.pengaturan-master-list', $data);
    }

    public function lihat_master_surat($template_master_id)
    {
        $master_surat = MasterSurat::where(['template_master_id' => $template_master_id, 'deleted' => '0'])->first();
        if (!$master_surat) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $data = [
            'title'             => 'Pengaturan Master Surat',
            'menu_aktif'        => 'pengaturan_master_surat',
            'master_surat'      => $master_surat,
        ];
        return view('pengaturan.pengaturan-master-lihat', $data);
    }

    public function tambah_master_view()
    {
        $kop = Kop::where(['active' => 1, 'deleted' => '0'])->get();
        $body = Body::where(['active' => 1, 'deleted' => '0'])->get();
        $approval = TandaTangan::where(['deleted' => '0', 'active' => '1'])->with('user')->get();
        $tembusan = Tembusan::where(['active' => 1, 'deleted' => '0'])->get();
        $footer = Footer::where(['active' => 1, 'deleted' => '0'])->get();
        $jenissurat = JenisSurat::where(['active' => 1])->get();
        $data = [
            'title'             => 'Master Surat',
            'menu_aktif'        => 'pengaturan_master_surat',
            'kop'               => $kop,
            'body'              => $body,
            'tembusan'          => $tembusan,
            'footer'            => $footer,
            'approval'          => $approval,
            'jenissurat'        => $jenissurat,
            'nosurat'           => 'SSR/062021/12',
            'tujuan'            => 'Bapak Alpin',
            'perihal'           => 'Penunjukan',
            'tanggalapprove'    => '26-03-2021',
            'ceklah'            => '${nosurat}'
        ];

        return view('pengaturan.pengaturan-master-tambah', $data);
    }

    public function simpan_master(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kop' => 'required',
            'body' => 'required',
            'approval' => 'required',
            'tembusan' => 'required',
            'footer' => 'required',
            'nama_master' => 'required',
            'jenis_surat' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->first()], 400);
        }

        $master_cek = MasterSurat::where('nama_master', $request->nama_master)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();

        if ($master_cek) {
            return response()->json(['error' => 'Nama master sudah ada'], 400);
        }

        $kop = (object) request('kop');
        $body = (array) request('body');
        $approval = (array) request('approval');
        $tembusan = (object) request('tembusan');
        $footer = (object) request('footer');
        $nama_master = request('nama_master');
        $jenis_surat = request('jenis_surat');

        $master = new MasterSurat;
        $master->nama_master            = $nama_master;
        $master->lfk_kop_id             = $kop->kop_id;
        $master->lfk_tembusan_id        = $tembusan->tembusan_id;
        $master->lfk_template_footer_id = $footer->template_footer_id;
        $master->jenis_surat_id         = $jenis_surat;


        if (!$master->save()) {
            return response()->json(['error' => 'Gagal menambah data'], 400);
        }

        $template_master_id = DB::getPdo()->lastInsertId();

        $data_body_final = [];
        foreach ($body as $key => $value) {
            if ($value == 'input') {
                $data_body['is_input_user'] = 1;
                $data_body['lfk_template_body'] = null;
            } else {
                $value = (object) $value;
                $data_body['is_input_user'] = 0;
                $data_body['lfk_template_body'] = $value->template_body_id;
            }

            $data_body['lfk_template_master_id']    = $template_master_id;
            $data_body['order_body']                = $key + 1;

            $data_body_final[] = $data_body;
        }
        $cek_body = MasterSuratDetailBody::insert($data_body_final);
        if (!$cek_body) {
            return response()->json(['error' => 'Gagal menambah data'], 400);
        }

        $data_ttd_final = [];
        foreach ($approval as $key => $value) {
            $value = (object) $value;
            $data_ttd['lfk_template_master_id']     = $template_master_id;
            $data_ttd['order_ttd']                  = $key + 1;
            $data_ttd['lfk_ttd_id']                 = $value->ttd_id;
            $data_ttd_final[] = $data_ttd;
        }
        $cek_ttd = MasterSuratDetailTTD::insert($data_ttd_final);
        if (!$cek_ttd) {
            return response()->json(['error' => 'Gagal menambah data'], 400);
        }


        return response()->json(['message' => 'Berhasil menambahkan data', 'data' => MasterSurat::where('template_master_id', $template_master_id)->with('detail_body', 'detail_ttd')->first()]);
    }

    public function berhasil()
    {
        return redirect('superadmin/administrasi/pengaturan/master-surat')->withInput()->with('berhasil', 'Berhasil menambah data');
    }

    public function edit_master()
    {
        $data = [
            'title'             => 'Edit Pengaturan Master Surat',
            'menu_aktif'        => 'pengaturan_master_surat',
        ];

        return view('pengaturan.edit-master-surat', $data);
    }

    public function hapus($template_master_id)
    {
        if (!$template_master_id) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }
        $template_master = MasterSurat::where('template_master_id', $template_master_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$template_master) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $template_master->deleted = 1;

        $cek = $template_master->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }

































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_master_surat_all()
    {
        $master_surat = MasterSurat::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $master_surat,
        ]);
    }
    public function api_master_surat_detail($template_master_id)
    {
        $master_surat = MasterSurat::where('template_master_id', $template_master_id)->where(['active' => 1, 'deleted' => '0'])->first();

        if (!$master_surat) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $master_surat,
            ]);
        }
    }
}
