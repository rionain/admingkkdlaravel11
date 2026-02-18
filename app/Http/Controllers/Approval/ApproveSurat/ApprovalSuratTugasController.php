<?php

namespace App\Http\Controllers\Approval\ApproveSurat;

use App\Http\Controllers\Controller;
use App\Models\SuratTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalSuratTugasController extends Controller
{
    public function list_approval()
    {
        $approval_surat = SuratTugas::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'order_ttd' => DB::raw('(status_surat_id-1)')])
            ->join('pengaturan_surat_tugas', 'surat_tugas.pengaturan_surat_tugas_id', '=', 'pengaturan_surat_tugas.pengaturan_surat_tugas_id')
            ->join('pengaturan_surat_tugas_ttd', 'pengaturan_surat_tugas.pengaturan_surat_tugas_id', '=', 'pengaturan_surat_tugas_ttd.pengaturan_surat_tugas_id')
            ->join('ttd_surat', 'pengaturan_surat_tugas_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->orderBy('surat_tugas.surat_tugas_id', 'desc')
            ->get();

        $data = [
            'title'             => 'Surat tugas',
            'menu_aktif'        => 'surat_tugas',
            'approval_surat'    => $approval_surat,
        ];

        return view('approval-surat.surat-tugas', $data);
    }

    public function approve_surat($surat_tugas_id)
    {
        $request_surat = SuratTugas::where(['surat_tugas_id' => $surat_tugas_id])->first();
        if (!$request_surat) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }

        if ($request_surat->status_surat_id + 1 == $request_surat->pengaturan_surat_tugas->detail_ttd->count() + 2) {
            $request_surat->status_surat_id = 6;
            $request_surat->nomor_surat = "S-GKKD/$request_surat->surat_tugas_id/IV/" . date('Y');
        } else {
            $request_surat->status_surat_id++;
        }
        $cek = $request_surat->save();
        if (!$cek) {
            return redirect()->back()->with('gagal', 'Gagal approve data');
        }


        return redirect()->back()->with('berhasil', 'Berhasil approve data');
    }

    public function demote_surat($surat_tugas_id)
    {
        $value = (object) request()->validate([
            'alasan_demote'   => 'required',
        ]);

        $request_surat = SuratTugas::where(['surat_tugas_id' => $surat_tugas_id])->first();
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
        $users = SuratTugas::where([])->get();


        return response()->json([
            'status' => true,
            'data' => $users,
        ]);
    }
    public function api_detail($surat_tugas_id)
    {
        $users = SuratTugas::where(['surat_tugas_id' => $surat_tugas_id])->first();

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
