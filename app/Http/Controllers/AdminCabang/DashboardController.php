<?php

namespace App\Http\Controllers\AdminCabang;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ibadah;
use App\Models\Proposal;
use App\Models\RequestSurat;
use App\Models\SertifikatBaptis;
use App\Models\SertifikatPenyerahanAnak;
use App\Models\SertifikatPernikahan;
use App\Models\SuratKeputusan;
use App\Models\SuratPenunjukan;
use App\Models\SuratTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $cabangid = Auth::user()->lfk_cabang_id;

        $event_schedule = Event::where(['active' => 1, 'deleted' => '0', 'lfk_cabang_id' => $cabangid])->count();
        $events = Event::where(['active' => 1, 'deleted' => '0', 'lfk_cabang_id' => $cabangid])->get();
        $ibadah = Ibadah::where(['ibadah_status' => 1, 'active' => 1, 'deleted' => '0', 'lfk_cabang_id' => $cabangid])->orderBy('ibadah_day', 'DESC')->count();
        $proposal = Proposal::where(['lfk_requester_user_id' => auth()->user()->user_id, 'deleted' => '0']);

        $surat_diterima = SuratKeputusan::where(['lfk_cabang_id' => $cabangid, 'status_surat_id' => 6])->join('user_header', 'user_header.user_id', '=', 'surat_keputusan.user_id')->count();
        $surat_diterima += SuratPenunjukan::where(['lfk_cabang_id' => $cabangid, 'status_surat_id' => 6])->join('user_header', 'user_header.user_id', '=', 'surat_penunjukan.user_id')->count();
        $surat_diterima += SuratTugas::where(['lfk_cabang_id' => $cabangid, 'status_surat_id' => 6])->join('user_header', 'user_header.user_id', '=', 'surat_tugas.user_id')->count();

        $surat_ditolak = SuratKeputusan::where(['lfk_cabang_id' => $cabangid, 'status_surat_id' => 5])->join('user_header', 'user_header.user_id', '=', 'surat_keputusan.user_id')->count();
        $surat_ditolak += SuratPenunjukan::where(['lfk_cabang_id' => $cabangid, 'status_surat_id' => 5])->join('user_header', 'user_header.user_id', '=', 'surat_penunjukan.user_id')->count();
        $surat_ditolak += SuratTugas::where(['lfk_cabang_id' => $cabangid, 'status_surat_id' => 5])->join('user_header', 'user_header.user_id', '=', 'surat_tugas.user_id')->count();

        $sertifikat_baptis_diterima = SertifikatBaptis::where(['lfk_cabang_id' => auth()->user()->lfk_cabang_id])->where('lfk_status_sertifikat_id', '2')->count();
        $sertifikat_penyerahan_anak_diterima = SertifikatPenyerahanAnak::where(['lfk_cabang_id' => auth()->user()->lfk_cabang_id])->where('lfk_status_sertifikat_id', '2')->count();
        $sertifikat_pernikahan_diterima = SertifikatPernikahan::where(['lfk_cabang_id' => auth()->user()->lfk_cabang_id])->where('lfk_status_sertifikat_id', '2')->count();

        $sertifikat_baptis_ditolak = SertifikatBaptis::where(['lfk_cabang_id' => auth()->user()->lfk_cabang_id])->where('lfk_status_sertifikat_id', '3')->count();
        $sertifikat_penyerahan_anak_ditolak = SertifikatPenyerahanAnak::where(['lfk_cabang_id' => auth()->user()->lfk_cabang_id])->where('lfk_status_sertifikat_id', '3')->count();
        $sertifikat_pernikahan_ditolak = SertifikatPernikahan::where(['lfk_cabang_id' => auth()->user()->lfk_cabang_id])->where('lfk_status_sertifikat_id', '3')->count();

        $data = [
            'title'                                 => 'Dashboard',
            'menu_aktif'                            => 'dashboard',
            'event_schedule'                        => $event_schedule,
            'events'                                => $events,
            'total_ibadah'                          => $ibadah,
            'total_surat_ditolak'                   => $surat_ditolak,
            'total_surat_diterima'                  => $surat_diterima,
            'total_proposal_ditolak'                => $proposal->where('lfk_status_proposal_id', 2)->count(),
            'total_proposal_diterima'               => $proposal->where('lfk_status_proposal_id', 3)->count(),
            'total_sertifikat_diterima'             => $sertifikat_baptis_diterima + $sertifikat_penyerahan_anak_diterima + $sertifikat_pernikahan_diterima,
            'total_sertifikat_ditolak'              => $sertifikat_baptis_ditolak + $sertifikat_penyerahan_anak_ditolak + $sertifikat_pernikahan_ditolak,
        ];
        return view('admin-cabang.dashboard', $data);
    }
}
