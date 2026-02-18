<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ibadah;
use App\Models\Proposal;
use App\Models\RequestSurat;
use App\Models\SuratKeputusan;
use App\Models\SuratPenunjukan;
use App\Models\SuratTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $tahun = request('tahun') ?: date('Y');

        $event_schedule = Event::where(['active' => 1, 'deleted' => '0'])->whereYear('created_date', $tahun)->count();
        $events = Event::where(['active' => 1, 'deleted' => '0'])->get();
        $ibadah = Ibadah::where(['ibadah_status' => 1, 'active' => 1, 'deleted' => '0'])->orderBy('ibadah_day', 'DESC')->count();

        $surat_diterima = SuratTugas::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'status_surat_id' => 6])
            ->join('pengaturan_surat_tugas', 'surat_tugas.pengaturan_surat_tugas_id', '=', 'pengaturan_surat_tugas.pengaturan_surat_tugas_id')
            ->join('pengaturan_surat_tugas_ttd', 'pengaturan_surat_tugas.pengaturan_surat_tugas_id', '=', 'pengaturan_surat_tugas_ttd.pengaturan_surat_tugas_id')
            ->join('ttd_surat', 'pengaturan_surat_tugas_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->count();
        $surat_diterima += SuratKeputusan::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'status_surat_id' => 6])
            ->join('pengaturan_surat_keputusan', 'surat_keputusan.pengaturan_surat_keputusan_id', '=', 'pengaturan_surat_keputusan.pengaturan_surat_keputusan_id')
            ->join('pengaturan_surat_keputusan_ttd', 'pengaturan_surat_keputusan.pengaturan_surat_keputusan_id', '=', 'pengaturan_surat_keputusan_ttd.pengaturan_surat_keputusan_id')
            ->join('ttd_surat', 'pengaturan_surat_keputusan_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->count();
        $surat_diterima += SuratPenunjukan::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'status_surat_id' => 6])
            ->join('pengaturan_surat_penunjukan', 'surat_penunjukan.pengaturan_surat_penunjukan_id', '=', 'pengaturan_surat_penunjukan.pengaturan_surat_penunjukan_id')
            ->join('pengaturan_surat_penunjukan_ttd', 'pengaturan_surat_penunjukan.pengaturan_surat_penunjukan_id', '=', 'pengaturan_surat_penunjukan_ttd.pengaturan_surat_penunjukan_id')
            ->join('ttd_surat', 'pengaturan_surat_penunjukan_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->count();

        $surat_ditolak = SuratTugas::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'status_surat_id' => 5])
            ->join('pengaturan_surat_tugas', 'surat_tugas.pengaturan_surat_tugas_id', '=', 'pengaturan_surat_tugas.pengaturan_surat_tugas_id')
            ->join('pengaturan_surat_tugas_ttd', 'pengaturan_surat_tugas.pengaturan_surat_tugas_id', '=', 'pengaturan_surat_tugas_ttd.pengaturan_surat_tugas_id')
            ->join('ttd_surat', 'pengaturan_surat_tugas_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->count();
        $surat_ditolak += SuratKeputusan::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'status_surat_id' => 5])
            ->join('pengaturan_surat_keputusan', 'surat_keputusan.pengaturan_surat_keputusan_id', '=', 'pengaturan_surat_keputusan.pengaturan_surat_keputusan_id')
            ->join('pengaturan_surat_keputusan_ttd', 'pengaturan_surat_keputusan.pengaturan_surat_keputusan_id', '=', 'pengaturan_surat_keputusan_ttd.pengaturan_surat_keputusan_id')
            ->join('ttd_surat', 'pengaturan_surat_keputusan_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->count();
        $surat_ditolak += SuratPenunjukan::where(['ttd_surat.lfk_user_id' => Auth::user()->user_id, 'status_surat_id' => 5])
            ->join('pengaturan_surat_penunjukan', 'surat_penunjukan.pengaturan_surat_penunjukan_id', '=', 'pengaturan_surat_penunjukan.pengaturan_surat_penunjukan_id')
            ->join('pengaturan_surat_penunjukan_ttd', 'pengaturan_surat_penunjukan.pengaturan_surat_penunjukan_id', '=', 'pengaturan_surat_penunjukan_ttd.pengaturan_surat_penunjukan_id')
            ->join('ttd_surat', 'pengaturan_surat_penunjukan_ttd.ttd_id', '=', 'ttd_surat.ttd_id')
            ->count();

        $data = [
            'title'             => 'Dashboard',
            'menu_aktif'        => 'dashboard',
            'event_schedule'    => $event_schedule,
            'events'            => $events,
            'total_ibadah'      => $ibadah,
            'total_surat_ditolak' => $surat_ditolak,
            'total_surat_diterima' => $surat_diterima,
        ];
        return view('approval.dashboard', $data);
    }
}
