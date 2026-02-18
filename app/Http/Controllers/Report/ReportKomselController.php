<?php

namespace App\Http\Controllers\Report;

use App\Exports\ExcelReportKehadiranKomsel;
use App\Http\Controllers\Controller;
use App\Models\Komsel;
use App\Models\KomselDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportKomselController extends Controller
{
    public function report()
    {
        $req_komsel = request('komsel');
        $dari = request('dari');
        $sampai = request('sampai');

        $report = KomselDetail::where(['deleted' => '0'])->whereBetween('komsel_date', [$dari, $sampai])->where(function ($query) use ($req_komsel) {
            if ($req_komsel) {
                $query->where('lfk_komsel_id', $req_komsel);
            }
        })->with('komsel')->get();

        $data = [
            'title'             => 'Report Komsel',
            'menu_aktif'        => 'report_komsel',
            'komsel'            => Komsel::where(['deleted' => '0'])->get(),
            'report'            => $report,
        ];
        // dd($data['komsel']->toArray());
        return view('report.report-komsel', $data);
    }

    public function export_excel()
    {
        $date = date('YmdHis');

        $req_komsel = request('komsel');
        $dari = request('dari');
        $sampai = request('sampai');

        $report_komsel = KomselDetail::where(['deleted' => '0'])->whereBetween('komsel_date', [$dari, $sampai])->where(function ($query) use ($req_komsel) {
            if ($req_komsel) {
                $query->where('lfk_komsel_id', $req_komsel);
            }
        })->with('komsel')->get();
        return Excel::download(new ExcelReportKehadiranKomsel($report_komsel), "ReportKehadiranKomsel$date.xlsx");
    }
}
