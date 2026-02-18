<?php

namespace App\Http\Controllers;

use App\Models\KakakPA;
use App\Models\AnakPA;
use App\Models\Cabang;
use App\Models\DashboardHistory;
use App\Models\Event;
use App\Models\Ibadah;
use App\Models\Jemaat;
use App\Models\KelompokPA;
use App\Models\Komsel;
use App\Models\Pendeta;
use App\Models\StatusSurat;
use App\Models\SubCabang;
use App\Models\Superadmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $event_schedule = Event::where(['active' => 1, 'deleted' => '0'])->count();
        $events = Event::where(['active' => 1, 'deleted' => '0'])->get();
        $total_kelompok_pa = KelompokPA::where(['active' => 1, 'deleted' => '0'])->count();
        $total_kakak_pa = KakakPA::where(['active' => 1, 'deleted' => '0'])->count();
        $total_anggota_pa = AnakPA::where(['active' => 1, 'deleted' => '0'])->count() + $total_kakak_pa;
        $total_kehadiran_pa = 0;
        $total_cabang   = Cabang::where(['active' => '1', 'deleted' => '0'])->count();
        $total_ibadah   = Ibadah::where(['active' => 1, 'deleted' => '0'])->count();
        $total_komsel   = Komsel::where(['active' => 1, 'deleted' => '0'])->count();
        $total_jemaat   = Jemaat::where(['active' => 1, 'deleted' => '0'])->count();
        $total_pendeta        = Jemaat::where(['active' => 1, 'jemaat.deleted' => '0'])->where('lfk_status_jemaat_id', '<', '6')->count();
        $dashboard_history          = DashboardHistory::where(['tanggal' => Carbon::yesterday()])->first();
        $dashboard_history_today    = DashboardHistory::where(['tanggal' => Carbon::today()])->first();

        //create if yesterday hasn't login yet
        if (!$dashboard_history) {
            $dashboard_history = new DashboardHistory();
            $dashboard_history->tanggal             = Carbon::yesterday();
            $dashboard_history->jumlah_event        = $event_schedule;
            $dashboard_history->jumlah_kelompok_pa  = $total_kelompok_pa;
            $dashboard_history->jumlah_anak_pa      = $total_anggota_pa;
            $dashboard_history->jumlah_kakak_pa     = $total_kakak_pa;
            $dashboard_history->jumlah_cabang       = $total_cabang;
            $dashboard_history->jumlah_ibadah       = $total_ibadah;
            $dashboard_history->jumlah_komsel       = $total_komsel;
            $dashboard_history->jumlah_jemaat       = $total_jemaat;
            $dashboard_history->jumlah_pendeta      = $total_pendeta;
            $dashboard_history->save();
            $dashboard_history                      = DashboardHistory::where(['tanggal' => Carbon::yesterday()])->first();
        }

        //to update every open dashboard
        if (!$dashboard_history_today) {
            $dashboard_history_today = new DashboardHistory();
            $dashboard_history_today->tanggal = Carbon::now();
        }
        $dashboard_history_today->jumlah_event          = $event_schedule;
        $dashboard_history_today->jumlah_kelompok_pa    = $total_kelompok_pa;
        $dashboard_history_today->jumlah_anak_pa        = $total_anggota_pa;
        $dashboard_history_today->jumlah_kakak_pa       = $total_kakak_pa;
        $dashboard_history_today->jumlah_cabang         = $total_cabang;
        $dashboard_history_today->jumlah_ibadah         = $total_ibadah;
        $dashboard_history_today->jumlah_komsel         = $total_komsel;
        $dashboard_history_today->jumlah_jemaat         = $total_jemaat;
        $dashboard_history_today->jumlah_pendeta        = $total_pendeta;
        $dashboard_history_today->save();

        $jemaat_ultah       = jemaat::where('jemaat.deleted', '0')->whereMonth('tanggal_lahir', date('m'))->where(DB::raw('DAY(tanggal_lahir)'), date('d'))->orderBy('nama', 'ASC')->get();
        $data = [
            'title'                 => 'Dashboard',
            'menu_aktif'            => 'dashboard',
            'event_schedule'        => $event_schedule,
            'events'                => $events,
            'total_kelompok_pa'     => $total_kelompok_pa,
            'total_anggota_pa'      => $total_anggota_pa,
            'total_kakak_pa'        => $total_kakak_pa,
            'total_kehadiran_pa'    => $total_kehadiran_pa,
            'total_cabang'          => $total_cabang,
            'total_ibadah'          => $total_ibadah,
            'total_komsel'          => $total_komsel,
            'total_jemaat'          => $total_jemaat,
            'total_pendeta'         => $total_pendeta,
            'dashboard_history'     => $dashboard_history,
            'jemaat_ultah'          => $jemaat_ultah,
        ];
        return view('index', $data);
    }














































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function api_status_surat_all()
    {
        $status_surat = StatusSurat::where(['active' => 1, 'deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $status_surat,
        ]);
    }
}
