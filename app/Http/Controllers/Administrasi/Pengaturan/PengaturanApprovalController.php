<?php

namespace App\Http\Controllers\Administrasi\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\TandaTangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaturanApprovalController extends Controller
{
    public function approval()
    {
        $data = [
            'title'             => 'Pengaturan Approval Surat',
            'menu_aktif'        => 'pengaturan_approval_surat',
            'approval'          => User::where(['deleted' => '0', 'active' => '1', 'lfk_role_id' => 5])->get(),
        ];
        return view('pengaturan.pengaturan-approval-list', $data);
    }

    public function tambah_approval()
    {
        $value = (object) request()->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required|confirmed|min:8',
            'gender'    => 'required',
            'phone'     => 'required|numeric',
            'jabatan'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $approval = User::where('email', $value->email)->first();
            if (!$approval) {
                $approval = new User;
            } elseif ($approval->deleted == 0 || $approval->deleted == '0') {
                return redirect()->back()->withInput()->with('gagal', 'Email sudah digunakan');
            } elseif ($approval->deleted == 1 || $approval->deleted == '1') {
                $approval->deleted          = '0';
            }

            $approval->lfk_role_id = 5;
            $approval->nama = $value->nama;
            $approval->email = $value->email;
            $approval->password = bcrypt($value->password);
            $approval->gender = $value->gender;
            $approval->phone = $value->phone;

            $cek = $approval->save();
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
            }
            // ------------------------------------------------------------------------
            // Approval TTD
            // ------------------------------------------------------------------------
            $approval_ttd = TandaTangan::where('lfk_user_id', $approval->user_id)->first();
            if (!$approval_ttd) {
                $approval_ttd = new TandaTangan;
            }

            $approval_ttd->lfk_user_id = $approval->user_id;
            $approval_ttd->jabatan_ttd = $value->jabatan;

            if (request()->hasFile('ttd')) {
                $file = request()->file('ttd');
                $filename = '/tanda_tangan/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

                $cek = Storage::cloud()->put($filename, file_get_contents($file));
                if (!$cek) {
                    return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
                }
                $approval_ttd->ttd = $filename;
            } else {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan foto');
            }

            $approval_ttd->save();
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }

        return redirect()->back()->with('berhasil', 'Berhasil menyimpan data ' . $approval->user_id);
    }

    public function edit_approval($approval_id)
    {
        if ($approval_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $value = (object) request()->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'gender'    => 'required',
            'phone'     => 'required|numeric',
            'jabatan'   => 'required',
        ]);
        DB::beginTransaction();
        try {
            $approval = User::where(['user_id' => $approval_id, 'deleted' => '0', 'active' => '1', 'lfk_role_id' => 5])->first();
            if (!$approval) {
                return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
            }

            $approval->nama = $value->nama;
            $approval->email = $value->email;
            $approval->password = bcrypt($value->email);
            $approval->gender = $value->gender;
            $approval->phone = $value->phone;

            $cek = $approval->save();

            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
            }
            // ------------------------------------------------------------------------
            // Approval TTD
            // ------------------------------------------------------------------------
            $approval_ttd = TandaTangan::where('lfk_user_id', $approval->user_id)->first();
            if (!$approval_ttd) {
                $approval_ttd = new TandaTangan;
            }

            $approval_ttd->lfk_user_id = $approval->user_id;
            $approval_ttd->jabatan_ttd = $value->jabatan;

            if (request()->hasFile('ttd')) {
                $file = request()->file('ttd');
                $filename = '/tanda_tangan/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

                $cek = Storage::cloud()->put($filename, file_get_contents($file));
                if (!$cek) {
                    return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
                }
                $approval_ttd->ttd = $filename;
            }

            $approval_ttd->save();
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan data');
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->withInput()->with('gagal', $e->getMessage());
        }


        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }

    public function hapus_approval($approval_id)
    {
        $approval = User::where(['user_id' => $approval_id, 'deleted' => '0', 'active' => '1', 'lfk_role_id' => 5])->first();
        if (!$approval) {
            return redirect()->back()->withInput()->with('gagal', 'Data tidak ditemukan');
        }

        $approval->deleted = 1;
        $cek = $approval->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Approval berhasil dihapus');
    }











    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_approval_all()
    {
        $approval = User::where(['deleted' => '0', 'active' => '1', 'lfk_role_id' => 5])->with('ttd')->get();

        return response()->json([
            'status' => true,
            'data' => $approval,
        ]);
    }
    public function api_approval_detail($approval_id)
    {
        $approval = User::where('user_id', $approval_id)->where(['deleted' => '0', 'active' => '1', 'lfk_role_id' => 5])->with('ttd')->first();

        if (!$approval) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $approval,
            ]);
        }
    }
}
