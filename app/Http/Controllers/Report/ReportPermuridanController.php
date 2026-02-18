<?php

namespace App\Http\Controllers\Report;

use App\Exports\ExcelReportKehadiranPermuridan;
use App\Exports\ExcelReportKehadiranPermuridanDetail;
use App\Http\Controllers\Controller;
use App\Models\AnakPA;
use App\Models\KakakPA;
use App\Models\Permuridan;
use App\Models\PermuridanDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportPermuridanController extends Controller
{
    public function report()
    {
        $cabang = request('cabang');
        $dari = request('dari');
        $sampai = request('sampai');
        $kakakpa = request('kakakpa');


        $report = Permuridan::where(['permuridan_header.deleted' => '0'])->whereBetween('permuridan_header.tanggal', [$dari, $sampai])->where(function ($query) use ($cabang) {
            // $query->where('permuridan_header.lfk_cabang_id', 'like', "%$cabang");
        })->join('kelompok_pa_header', 'permuridan_header.lfk_kelompok_pa_id', '=', 'kelompok_pa_header.kelompok_pa_id');
        if ($kakakpa) {
            $report = $report->where('lfk_kakak_pa_user_id', "$kakakpa");
        }
        $report = $report->get();

        $data = [
            'title'             => 'Report permuridan',
            'menu_aktif'        => 'report_permuridan',
            'permuridan'            => PermuridanDetail::where(['active' => 1, 'deleted' => '0'])->get(),
            'report'            => $report,
            'kakak_pa'            => KakakPA::where(['deleted' => '0'])->get(),
        ];
        // dd($data['kakak_pa']->toArray());
        return view('report.report-permuridan', $data);
    }

    public function export_excel()
    {
        $date = date('YmdHis');

        $cabang = request('cabang');
        $dari = request('dari');
        $sampai = request('sampai');
        $kakakpa = request('kakakpa');


        $report = Permuridan::where(['permuridan_header.deleted' => '0'])->whereBetween('permuridan_header.tanggal', [$dari, $sampai])->where(function ($query) use ($cabang) {
            // $query->where('permuridan_header.lfk_cabang_id', 'like', "%$cabang");
        })->join('kelompok_pa_header', 'permuridan_header.lfk_kelompok_pa_id', '=', 'kelompok_pa_header.kelompok_pa_id');
        if ($kakakpa) {
            $report = $report->where('lfk_kakak_pa_user_id', "$kakakpa");
        }
        $report = $report->get();

        return Excel::download(new ExcelReportKehadiranPermuridan($report), "ReportKehadiranPermuridan$date.xlsx");
    }








    // ------------------------------------------------------------------------
    // DETAIL
    // ------------------------------------------------------------------------

    public function permuridan_detail($permuridan_id)
    {
        $permuridan = Permuridan::where(['permuridan_id' => $permuridan_id, 'deleted' => '0'])->first();

        $data = [
            'title'             => 'Kehadiran Permuridan Detail',
            'menu_aktif'        => 'kehadiran_permuridan_detail',
            'permuridan'        => $permuridan,
            'permuridan_id'     => $permuridan_id,
            'report'            => PermuridanDetail::where(['lfk_permuridan_id' => $permuridan_id, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get(),
        ];
        // return $data['kehadiran'];
        return view('report.report-permuridan-detail', $data);
    }

    public function export_permuridan_detail($permuridan_id)
    {
        $date = date('YmdHis');

        $report = PermuridanDetail::where(['deleted' => '0', 'lfk_permuridan_id' => $permuridan_id])->get();
        return Excel::download(new ExcelReportKehadiranPermuridanDetail($report), "ReportKehadiranPermuridanDetail$date.xlsx");
    }
}
