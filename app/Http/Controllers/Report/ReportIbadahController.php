<?php

namespace App\Http\Controllers\Report;

use App\Exports\ExcelReportKehadiranIbadah;
use App\Http\Controllers\Controller;
use App\Models\Ibadah;
use App\Models\IbadahDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReportIbadahController extends Controller
{
    public function report()
    {
        $req_ibadah = request('ibadah');
        $dari = request('dari');
        $sampai = request('sampai');

        $report = IbadahDetail::where(['deleted' => '0'])->whereBetween('tanggal', [$dari, $sampai])->where(function ($query) use ($req_ibadah) {
            if ($req_ibadah) {
                $query->where('lfk_ibadah_id', $req_ibadah);
            }
        })->with('kakak_pa', 'anak_pa', 'ibadah')->get();

        $data = [
            'title'             => 'Report Ibadah',
            'menu_aktif'        => 'report_ibadah',
            'ibadah'            => Ibadah::where(['ibadah_status' => 1, 'active' => 1, 'deleted' => '0'])->get(),
            'report'            => $report,
        ];
        // dd($data['ibadah']->toArray());
        return view('report.report-ibadah', $data);
    }

    public function export_excel()
    {
        $date = date('YmdHis');

        $req_ibadah = request('ibadah');
        $dari = request('dari');
        $sampai = request('sampai');

        $report_ibadah = IbadahDetail::where(['deleted' => '0'])->whereBetween('tanggal', [$dari, $sampai])->where(function ($query) use ($req_ibadah) {
            if ($req_ibadah) {
                $query->where('lfk_ibadah_id', $req_ibadah);
            }
        })->with('kakak_pa', 'anak_pa', 'ibadah')->get();
        return Excel::download(new ExcelReportKehadiranIbadah($report_ibadah), "ReportKehadiranIbadah$date.xlsx");
    }
}
