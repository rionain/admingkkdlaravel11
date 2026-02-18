<?php

namespace App\Http\Controllers\Approval\ApproveSurat;

use App\Http\Controllers\Controller;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproveSuratCustom extends Controller
{
    public function list_approval()
    {
        $approval_surat = RequestSurat::select('*', 'ttd_surat.lfk_user_id as approval_user_id')->where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'lfk_jenis_surat' => 5, 'surat_header.deleted' => '0', 'order_ttd' => DB::raw('(lfk_status_surat_id-1)')])
            ->join('template_master', 'surat_header.lfk_template_master', '=', 'template_master.template_master_id')
            ->join('template_master_detail_ttd', 'template_master.template_master_id', '=', 'template_master_detail_ttd.lfk_template_master_id')
            ->join('ttd_surat', 'template_master_detail_ttd.lfk_ttd_id', '=', 'ttd_surat.ttd_id')
            ->get();

        $data = [
            'title'             => 'Surat Custom',
            'menu_aktif'        => 'surat_custom',
            'approval_surat'    => $approval_surat,
        ];

        return view('approval-surat.surat-custom', $data);
    }

    public function lihat_surat($surat_id)
    {
        $request_surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        $data = [
            'title'             => 'Surat Keterangan',
            'menu_aktif'        => 'surat_keterangan',
            'request_surat'     => $request_surat,
        ];

        return view('surat.surat-lihat', $data);
    }

    public function approve_surat($surat_id)
    {
        $request_surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        if ($request_surat->lfk_status_surat_id + 1 == $request_surat->master_surat->detail_ttd->count() + 2) {
            $request_surat->lfk_status_surat_id = 6;
            $request_surat->no_surat = 'S-GKKD/022/IV/2021';
        } else {
            $request_surat->lfk_status_surat_id++;
        }
        $cek = $request_surat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Gagal approve data');
        }


        return redirect()->back()->with('berhasil', 'Berhasil approve data');
    }

    public function demote_surat($surat_id)
    {
        $value = (object) request()->validate([
            'demote_reason'   => 'required',
        ]);

        $request_surat = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $request_surat->demote_reason           = $value->demote_reason;
        $request_surat->lfk_status_surat_id     = 5;

        $cek = $request_surat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Gagal demote surat');
        }


        return redirect()->back()->with('berhasil', 'Berhasil demote surat');
    }




































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function api_all()
    {
        $jenis_surat = request('jenis_surat');

        if ($jenis_surat) {
            $users = RequestSurat::where(['lfk_jenis_surat' => request('jenis_surat'), 'active' => 1, 'deleted' => '0'])->get();
        } else {
            $users = RequestSurat::where(['active' => 1, 'deleted' => '0'])->get();
        }

        return response()->json([
            'status' => true,
            'data' => $users,
        ]);
    }
    public function api_detail($surat_id)
    {
        $users = RequestSurat::where(['surat_id' => $surat_id, 'deleted' => '0'])->first();

        if (!$users) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $users,
            ]);
        }
    }
}
