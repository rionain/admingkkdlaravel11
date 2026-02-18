<?php

namespace App\Http\Controllers\Approval\ApproveSurat;

use App\Http\Controllers\Controller;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproveSuratKeterangan extends Controller
{
    public function list_approval()
    {
        $approval_surat = RequestSurat::select('*', 'ttd_surat.lfk_user_id as approval_user_id')->where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'lfk_jenis_surat' => 1, 'surat_header.deleted' => '0', 'order_ttd' => DB::raw('(lfk_status_surat_id-1)')])
            ->join('template_master', 'surat_header.lfk_template_master', '=', 'template_master.template_master_id')
            ->join('template_master_detail_ttd', 'template_master.template_master_id', '=', 'template_master_detail_ttd.lfk_template_master_id')
            ->join('ttd_surat', 'template_master_detail_ttd.lfk_ttd_id', '=', 'ttd_surat.ttd_id')
            ->get();

        $data = [
            'title'             => 'Surat Keterangan',
            'menu_aktif'        => 'surat_keterangan',
            'approval_surat'    => $approval_surat,
        ];

        return view('approval-surat.surat-keterangan', $data);
    }
}
