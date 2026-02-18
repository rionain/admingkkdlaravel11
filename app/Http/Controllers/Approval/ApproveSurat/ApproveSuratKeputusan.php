<?php

namespace App\Http\Controllers\Approval\ApproveSurat;

use App\Http\Controllers\Controller;
use App\Models\RequestSurat;
use App\Models\SuratKeputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproveSuratKeputusan extends Controller
{
    public function list_approval()
    {
        $approval_surat = SuratKeputusan::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'order_ttd' => DB::raw('(status_surat_id-1)')])
            ->join('pengaturan_surat_keputusan', 'surat_keputusan.pengaturan_surat_keputusan_id', '=', 'pengaturan_surat_keputusan.pengaturan_surat_keputusan_id')
            ->join('pengaturan_surat_keputusan_ttd', 'pengaturan_surat_keputusan.pengaturan_surat_keputusan_id', '=', 'pengaturan_surat_keputusan_ttd.pengaturan_surat_keputusan_id')
            ->join('ttd_surat', 'pengaturan_surat_keputusan_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->orderBy('surat_keputusan.surat_keputusan_id', 'desc')
            ->get();

        $data = [
            'title'             => 'Surat keputusan',
            'menu_aktif'        => 'surat_keputusan',
            'approval_surat'    => $approval_surat,
        ];

        return view('approval-surat.surat-keputusan', $data);
    }

    public function approve_surat($surat_keputusan_id)
    {
        $request_surat = SuratKeputusan::where(['surat_keputusan_id' => $surat_keputusan_id])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        if ($request_surat->status_surat_id + 1 == $request_surat->pengaturan_surat_keputusan->detail_ttd->count() + 2) {
            $request_surat->status_surat_id = 6;
            $request_surat->nomor_surat = "S-GKKD/$request_surat->surat_keputusan_id/IV/" . date('Y');
        } else {
            $request_surat->status_surat_id++;
        }
        $cek = $request_surat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Gagal approve data');
        }


        return redirect()->back()->with('berhasil', 'Berhasil approve data');
    }

    public function demote_surat($surat_keputusan_id)
    {
        $value = (object) request()->validate([
            'alasan_demote'   => 'required',
        ]);

        $request_surat = SuratKeputusan::where(['surat_keputusan_id' => $surat_keputusan_id])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $request_surat->alasan_demote           = $value->alasan_demote;
        $request_surat->status_surat_id         = 5;

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
        $users = SuratKeputusan::where([])->get();


        return response()->json([
            'status' => true,
            'data' => $users,
        ]);
    }
    public function api_detail($surat_keputusan_id)
    {
        $users = SuratKeputusan::where(['surat_keputusan_id' => $surat_keputusan_id])->first();

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
