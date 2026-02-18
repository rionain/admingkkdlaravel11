<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Kontak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{
    public function ulang_tahun_jemaat(Request $request)
    {
        set_time_limit(120);

        $error = [];
        $jemaat_ultah           = Jemaat::where('jemaat.deleted', '0')
            ->where('jemaat.lfk_status_jemaat_id', '<', '6')
            ->whereMonth('tanggal_lahir', date('m'))
            ->where(DB::raw('DAY(tanggal_lahir)'), date('d'))
            ->orderBy('nama', 'ASC')
            ->get();

        $kontak = Kontak::first();

        $data = [
            'jemaat_ultah' => $jemaat_ultah,
        ];

        if ($jemaat_ultah->count()) {
            Mail::send('emails.ulang-tahun-jemaat', $data, function ($message) use ($kontak) {
                $message->to($kontak->email);
                $message->subject('Ulang tahun');
            });
            if (count(Mail::failures()) > 0) {
                $error[] = $kontak->email;
            }
        }

        // --------------------------------------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------------------------------------

        $jemaat_ultah           = Jemaat::where('jemaat.deleted', '0')
            ->whereMonth('tanggal_lahir', date('m'))
            ->where(DB::raw('DAY(tanggal_lahir)'), date('d'))
            ->orderBy('nama', 'ASC')
            ->groupBy('lfk_cabang_id')
            ->get();
        if ($jemaat_ultah->count()) {
            foreach ($jemaat_ultah as $key => $value) {
                $jemaat_ultah_cabang = Jemaat::where('jemaat.deleted', '0')
                    ->where('lfk_cabang_id', $value->lfk_cabang_id)
                    ->whereMonth('tanggal_lahir', date('m'))
                    ->where(DB::raw('DAY(tanggal_lahir)'), date('d'))
                    ->orderBy('nama', 'ASC')
                    ->get();

                $data = [
                    'jemaat_ultah' => $jemaat_ultah_cabang,
                ];
                $user = User::where(['lfk_cabang_id' => $value->lfk_cabang_id, 'lfk_role_id' => '2', 'deleted' => '0', 'active' => '1'])->get();

                if ($user) {
                    foreach ($user as $key => $value_user) {
                        Mail::send('emails.ulang-tahun-jemaat', $data, function ($message) use ($value_user) {
                            $message->to($value_user->email);
                            $message->subject('Ulang tahun');
                        });
                        if (count(Mail::failures()) > 0) {
                            $error[] = $value_user->email;
                        }
                    }
                }
            }
        }
        if (count($error) > 0) {
            return format_json(false, 'Gagal mengirim email ke ', $error);
        }

        return format_json(true, 'Berhasil mengirim email');
    }
}
