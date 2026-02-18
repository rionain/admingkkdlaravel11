<?php

namespace App\Http\Controllers\Approval\ApproveSurat;

use App\Http\Controllers\Controller;
use App\Models\SuratPenunjukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproveSuratPenunjukan extends Controller
{
    public function list_approval()
    {
        $approval_surat = SuratPenunjukan::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'order_ttd' => DB::raw('(status_surat_id-1)')])
            ->join('pengaturan_surat_penunjukan', 'surat_penunjukan.pengaturan_surat_penunjukan_id', '=', 'pengaturan_surat_penunjukan.pengaturan_surat_penunjukan_id')
            ->join('pengaturan_surat_penunjukan_ttd', 'pengaturan_surat_penunjukan.pengaturan_surat_penunjukan_id', '=', 'pengaturan_surat_penunjukan_ttd.pengaturan_surat_penunjukan_id')
            ->join('ttd_surat', 'pengaturan_surat_penunjukan_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->orderBy('surat_penunjukan.surat_penunjukan_id', 'desc')
            ->get();

        $data = [
            'title'             => 'Surat Penunjukan',
            'menu_aktif'        => 'surat_penunjukan',
            'approval_surat'    => $approval_surat,
        ];

        return view('approval-surat.surat-penunjukan', $data);
    }

    public function approve_surat($surat_penunjukan_id)
    {
        $request_surat = SuratPenunjukan::where(['surat_penunjukan_id' => $surat_penunjukan_id])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        if ($request_surat->status_surat_id + 1 == $request_surat->pengaturan_surat_penunjukan->detail_ttd->count() + 2) {
            $request_surat->status_surat_id = 6;
            $request_surat->nomor_surat = "S-GKKD/$request_surat->surat_penunjukan_id/IV/" . date('Y');
        } else {
            $request_surat->status_surat_id++;
        }
        $cek = $request_surat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Gagal approve data');
        }


        return redirect()->back()->with('berhasil', 'Berhasil approve data');
    }

    public function demote_surat($surat_penunjukan_id)
    {
        $value = (object) request()->validate([
            'alasan_demote'   => 'required',
        ]);

        $request_surat = SuratPenunjukan::where(['surat_penunjukan_id' => $surat_penunjukan_id])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $request_surat->alasan_demote           = $value->alasan_demote;
        $request_surat->status_surat_id     = 5;

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
        $users = SuratPenunjukan::where([])->get();


        return response()->json([
            'status' => true,
            'data' => $users,
        ]);
    }
    public function api_detail($surat_penunjukan_id)
    {
        $users = SuratPenunjukan::where(['surat_penunjukan_id' => $surat_penunjukan_id])->first();

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
