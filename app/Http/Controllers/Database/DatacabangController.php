<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Event;
use App\Models\Ibadah;
use App\Models\KakakPA;
use App\Models\KategoriKomsel;
use App\Models\KelompokPA;
use App\Models\Komsel;
use App\Models\StatusEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use S3Helper;

class DatacabangController extends Controller
{
    public function cabang()
    {
        $subcabangid        = Auth::user()->lfk_cabang_id;
        $ibadah             = Ibadah::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $komsel             = Komsel::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $kelompok_pa        = KelompokPA::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $event              = Event::where(['deleted' => '0', 'lfk_cabang_id' => $subcabangid])->orderBy('created_date', 'DESC')->get();
        $kakak_pa           = KakakPA::where(['lfk_cabang_id' => $subcabangid, 'active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();
        $kategori_komsel    = KategoriKomsel::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'ASC')->get();
        $status_event       = StatusEvent::where(['active' => 1, 'deleted' => '0'])->orderBy('created_date', 'DESC')->get();

        $where_kelompok_pa  = ['kelompok_pa_header.deleted' => '0', 'kelompok_pa_header.lfk_cabang_id' => $subcabangid];
        $total_kakak_pa_pria = KelompokPA::where($where_kelompok_pa)
            ->join('user_header', 'kelompok_pa_header.lfk_kakak_pa_user_id', '=', 'user_header.user_id')
            ->where('user_header.gender', 'l')
            ->get()->count();
        $total_kakak_pa_wanita = KelompokPA::where($where_kelompok_pa)
            ->join('user_header', 'kelompok_pa_header.lfk_kakak_pa_user_id', '=', 'user_header.user_id')
            ->where('user_header.gender', 'p')
            ->get()->count();

        $data = [
            'title'                     => 'Cabang',
            'menu_aktif'                => 'cabang',
            'ibadah'                    => $ibadah,
            'komsel'                    => $komsel,
            'kelompok_pa'               => $kelompok_pa,
            'event'                     => $event,
            'kakak_pa'                  => $kakak_pa,
            'kategori_komsel'           => $kategori_komsel,
            'status_event'              => $status_event,
            'total_kakak_pa_pria'       => $total_kakak_pa_pria,
            'total_kakak_pa_wanita'     => $total_kakak_pa_wanita,
        ];

        return view('admin-cabang.datacabang.datacabang-cabang', $data);
    }

    // ------------------------------------------------------------------------

    public function tambah_ibadah()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        $value = (object) request()->validate([
            'nama_ibadah'       => 'required',
            'ibadah_time_start' => 'required|date_format:H:i',
            'ibadah_time_end'   => 'required|date_format:H:i',
            'kapasitasIbadah'   => '',
            'ibadah_day'        => 'required',
            'notes'             => '',
        ]);
        // $ibadah = Ibadah::where('nama_ibadah', $value->nama_ibadah)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        // if ($ibadah) {
        //     return redirect()->back()->withInput()->with('gagal', 'Nama ibadah sudah ada');
        // }
        $ibadah = new Ibadah;
        $ibadah->nama_ibadah        = $value->nama_ibadah;
        $ibadah->ibadah_time_start  = $value->ibadah_time_start;
        $ibadah->ibadah_time_end    = $value->ibadah_time_end;
        $ibadah->lfk_cabang_id      = $subcabangid;
        $ibadah->kapasitas_ibadah   = $value->kapasitasIbadah;
        $ibadah->ibadah_day         = $value->ibadah_day;
        $ibadah->notes              = $value->notes;
        $ibadah->active             = request('activeIbadah') ?: 0;

        $cek = $ibadah->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_ibadah($ibadah_id = null)
    {
        if ($ibadah_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_ibadah'           => 'required',
            'ibadah_time_start'     => 'required|date_format:H:i',
            'ibadah_time_end'       => 'required|date_format:H:i',
            'kapasitasIbadah'       => '',
            'ibadah_day'            => 'required',
            'notes'                 => '',
        ]);
        $ibadah = Ibadah::where('ibadah_id', $ibadah_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$ibadah) {
            return redirect()->back()->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $ibadah->nama_ibadah        = $value->nama_ibadah;
        $ibadah->ibadah_time_start  = $value->ibadah_time_start;
        $ibadah->ibadah_time_end    = $value->ibadah_time_end;
        $ibadah->kapasitas_ibadah   = $value->kapasitasIbadah;
        $ibadah->ibadah_day         = $value->ibadah_day;
        $ibadah->notes              = $value->notes;
        $ibadah->active             = request('activeIbadah') ?: 0;

        $cek = $ibadah->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_ibadah($ibadah_id = null)
    {
        if ($ibadah_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $ibadah = Ibadah::where('ibadah_id', $ibadah_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$ibadah) {
            return redirect()->back()->withInput()->with('gagal', 'Data ibadah tidak ditemukan');
        }
        $ibadah->deleted             = 1;

        $cek = $ibadah->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
    // ------------------------------------------------------------------------

    public function tambah_komsel()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $value = (object) request()->validate([
            'nama_komsel'               => 'required',
            'lfk_kategori_komsel_id'    => 'required',
            'jumlah_pria'               => 'required|numeric',
            'jumlah_wanita'             => 'required|numeric',
        ]);
        $komsel = Komsel::where('nama_komsel', $value->nama_komsel)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($komsel) {
            return redirect()->back()->withInput()->with('gagal', 'Nama komsel sudah ada');
        }
        $komsel = new Komsel;
        $komsel->nama_komsel            = $value->nama_komsel;
        $komsel->lfk_cabang_id          = $subcabangid;
        $komsel->lfk_kategori_komsel_id = $value->lfk_kategori_komsel_id;
        $komsel->jumlah_pria            = $value->jumlah_pria;
        $komsel->jumlah_wanita          = $value->jumlah_wanita;

        $cek = $komsel->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_komsel($komsel_id = null)
    {
        if ($komsel_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_komsel'               => 'required',
            'lfk_kategori_komsel_id'    => 'required',
            'jumlah_pria'               => 'required|numeric',
            'jumlah_wanita'             => 'required|numeric'
        ]);
        $komsel = Komsel::where('komsel_id', $komsel_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$komsel) {
            return redirect()->back()->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $komsel->nama_komsel            = $value->nama_komsel;
        $komsel->lfk_kategori_komsel_id = $value->lfk_kategori_komsel_id;
        $komsel->jumlah_pria            = $value->jumlah_pria;
        $komsel->jumlah_wanita          = $value->jumlah_wanita;

        $cek = $komsel->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_komsel($komsel_id = null)
    {
        if ($komsel_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $komsel = Komsel::where('komsel_id', $komsel_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$komsel) {
            return redirect()->back()->withInput()->with('gagal', 'Data komsel tidak ditemukan');
        }
        $komsel->deleted = 1;

        $cek = $komsel->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
    // ------------------------------------------------------------------------

    public function tambah_kelompok_pa()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $value = (object) request()->validate([
            'nama_kelompok'         => 'required',
            'lfk_kakak_pa_user_id'  => 'required',
            'active'                => 'required',
        ]);
        $kelompok = KelompokPA::where('nama_kelompok', $value->nama_kelompok)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($kelompok) {
            return redirect()->back()->withInput()->with('gagal', 'Nama kelompok sudah ada');
        }
        $kelompok = new KelompokPA;
        $kelompok->nama_kelompok = $value->nama_kelompok;
        $kelompok->lfk_kakak_pa_user_id = $value->lfk_kakak_pa_user_id;
        $kelompok->lfk_cabang_id = $subcabangid;
        $kelompok->active = $value->active;

        $cek = $kelompok->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_kelompok_pa($kelompok_pa_id = null)
    {
        if ($kelompok_pa_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_kelompok'         => 'required',
            'lfk_kakak_pa_user_id'  => 'required',
            'active'                => 'required',
        ]);
        $kelompok = KelompokPA::where('kelompok_pa_id', $kelompok_pa_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kelompok) {
            return redirect()->back()->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $kelompok->nama_kelompok = $value->nama_kelompok;
        $kelompok->lfk_kakak_pa_user_id = $value->lfk_kakak_pa_user_id;
        $kelompok->active = $value->active;

        $cek = $kelompok->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }
    public function hapus_kelompok_pa($kelompok_pa_id = null)
    {
        if ($kelompok_pa_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $kelompok = KelompokPA::where('kelompok_pa_id', $kelompok_pa_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$kelompok) {
            return redirect()->back()->withInput()->with('gagal', 'Data kelompok pa tidak ditemukan');
        }
        $kelompok->deleted = 1;

        $cek = $kelompok->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }
    // ------------------------------------------------------------------------

    public function tambah_event()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;

        $value = (object) request()->validate([
            'nama_event'            => 'required',
            'jenis_event'           => 'required',
            'tanggal_event_mulai'   => 'required',
            'tanggal_event_selesai' => 'required',
            'jam_event_mulai'       => 'required',
            'jam_event_selesai'     => 'required',
            'foto_event'            => 'file|mimes:jpg,jpeg,png|max:1024',
            'foto_banner'           => 'file|mimes:jpg,jpeg,png|max:1024',
            'proposal'              => 'file|mimes:pdf,doc,docx|max:1024',
            'lpj'                   => 'file|mimes:pdf,doc,docx|max:1024',
            'catatan'               => 'required',
            'tujuan'                => 'required',
            'kuota_tersedia'        => 'required',
            'kehadiran'             => 'required',
            'lfk_status_event_id'   => 'required',
        ]);

        $event = Event::where('nama_event', $value->nama_event)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if ($event) {
            return redirect()->back()->withInput()->with('gagal', 'Nama event sudah ada');
        }

        $event = new Event;
        $event->nama_event              = $value->nama_event;
        $event->tanggal_event_mulai     = format_date($value->tanggal_event_mulai);
        $event->tanggal_event_selesai   = format_date($value->tanggal_event_selesai);
        $event->jam_event_mulai         = format_date($value->jam_event_mulai, 'H:i:s');
        $event->jam_event_selesai       = format_date($value->jam_event_selesai, 'H:i:s');
        $event->jenis_event             = $value->jenis_event;
        $event->catatan                 = $value->catatan;
        $event->lfk_cabang_id           = $subcabangid;
        $event->tujuan                  = $value->tujuan;
        $event->kuota_tersedia          = $value->kuota_tersedia;
        $event->kehadiran               = $value->kehadiran;
        $event->lfk_status_event_id     = $value->lfk_status_event_id;

        if (request()->hasFile('foto_event')) {
            $file = request()->file('foto_event');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file foto event');
            }
            $event->foto_event = $filename;
        } else {
            $event->foto_banner = '';
            // return redirect()->back()->withInput()->with('gagal', 'Foto event gagal disimpan');
        }

        if (request()->hasFile('foto_banner')) {
            $file = request()->file('foto_banner');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();
            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file foto banner');
            }
            $event->foto_banner = $filename;
        } else {
            $event->foto_banner = '';
            // return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Foto banner gagal disimpan');
        }

        if (request()->hasFile('proposal')) {
            $file = request()->file('proposal');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();
            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file proposal');
            }
            $event->proposal = $filename;
        } else {
            $event->proposal = '';
            // return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Proposal gagal disimpan');
        }
        if (request()->hasFile('lpj')) {
            $file = request()->file('lpj');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();
            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file lpj');
            }
            $event->lpj = $filename;
        } else {
            $event->lpj = '';
            // return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Lpj gagal disimpan');
        }

        $cek = $event->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menambah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menambah data');
    }
    public function edit_event($event_id = null)
    {
        if ($event_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $value = (object) request()->validate([
            'nama_event'            => 'required',
            'jenis_event'           => 'required',
            'tanggal_event_mulai'   => 'required',
            'tanggal_event_selesai' => 'required',
            'jam_event_mulai'       => 'required',
            'jam_event_selesai'     => 'required',
            // 'foto_event'            => request('foto_event') ? 'required|file|mimes:jpg,jpeg,png' : '',
            'foto_event'            => 'file|mimes:jpg,jpeg,png|max:1024',
            'foto_banner'           => 'file|mimes:jpg,jpeg,png|max:1024',
            'proposal'              => 'file|mimes:pdf,doc,docx|max:2048',
            'lpj'                   => 'file|mimes:pdf,doc,docx|max:2048',
            'catatan'               => 'required',
            'tujuan'                => 'required',
            'kuota_tersedia'        => 'required',
            'kehadiran'             => 'required',
            'lfk_status_event_id'   => 'required',
        ]);
        $event = Event::where('event_id', $event_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$event) {
            return redirect()->back()->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $event->nama_event              = $value->nama_event;
        $event->tanggal_event_mulai     = format_date($value->tanggal_event_mulai);
        $event->tanggal_event_selesai   = format_date($value->tanggal_event_selesai);
        $event->jam_event_mulai         = format_date($value->jam_event_mulai, 'H:i:s');
        $event->jam_event_selesai       = format_date($value->jam_event_selesai, 'H:i:s');
        $event->jenis_event             = $value->jenis_event;
        $event->catatan                 = $value->catatan;
        $event->tujuan                  = $value->tujuan;
        $event->kuota_tersedia          = $value->kuota_tersedia;
        $event->kehadiran               = $value->kehadiran;
        $event->lfk_status_event_id     = $value->lfk_status_event_id;

        if (request()->hasFile('foto_event')) {
            $file = request()->file('foto_event');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect()->back()->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            @S3Helper::delete($event->foto_event);
            $event->foto_event = $filename;
        }

        if (request()->hasFile('foto_banner')) {
            $file = request()->file('foto_banner');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            // return  @S3Helper::delete($event->foto_banner);
            // return $event->foto_banner;
            @S3Helper::delete($event->foto_banner);
            $event->foto_banner = $filename;
        }
        if (request()->hasFile('proposal')) {
            $file = request()->file('proposal');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            @S3Helper::delete($event->proposal);
            $event->proposal = $filename;
        }
        if (request()->hasFile('lpj')) {
            $file = request()->file('lpj');
            $filename = '/event/' . date('YmdHis-') . Str::random(6) . "." . $file->getClientOriginalExtension();

            $cek = Storage::cloud()->put($filename, file_get_contents($file));
            if (!$cek) {
                return redirect('superadmin/database/database-cabang?tab=event')->withInput()->with('gagal', 'Gagal menyimpan file');
            }
            @S3Helper::delete($event->lpj);
            $event->lpj = $filename;
        }

        $cek = $event->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengedit data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengedit data');
    }
    public function hapus_event($event_id = null)
    {
        if ($event_id == null) {
            return redirect()->back()->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $event = Event::where('event_id', $event_id)->where(['deleted' => '0'])->orderBy('created_date', 'DESC')->first();
        if (!$event) {
            return redirect()->back()->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $event->deleted                 = 1;

        $cek = $event->save();

        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal menghapus data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil menghapus data');
    }















    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_ibadah_all()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $ibadah = Ibadah::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with(['kategori_gereja']);
        }])->get();

        return response()->json([
            'status' => true,
            'data' => $ibadah,
        ]);
    }
    public function api_ibadah_detail($ibadah_id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $ibadah = Ibadah::where('lfk_cabang_id', $subcabangid)->where('ibadah_id', $ibadah_id)->where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with(['kategori_gereja']);
        }])->first();

        if (!$ibadah) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $ibadah,
            ]);
        }
    }



    public function api_komsel_all()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $komsel = Komsel::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->get();

        return response()->json([
            'status' => true,
            'data' => $komsel,
        ]);
    }
    public function api_komsel_detail($komsel_id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $komsel = Komsel::where('lfk_cabang_id', $subcabangid)->where('komsel_id', $komsel_id)->where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }])->first();

        if (!$komsel) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $komsel,
            ]);
        }
    }


    public function api_kelompok_pa_all()
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $kelompok_pa = KelompokPA::where(['lfk_cabang_id' => $subcabangid, 'deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }, 'kakak_pa'])->get();

        return response()->json([
            'status' => true,
            'data' => $kelompok_pa,
        ]);
    }
    public function api_kelompok_pa_detail($kelompok_pa_id)
    {
        $subcabangid = Auth::user()->lfk_cabang_id;
        $kelompok_pa = KelompokPA::where('lfk_cabang_id', $subcabangid)->where('kelompok_pa_id', $kelompok_pa_id)->where(['deleted' => '0'])->with(['cabang' => function ($q) {
            $q->with('kategori_gereja');
        }, 'kakak_pa'])->first();

        if (!$kelompok_pa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $kelompok_pa,
            ]);
        }
    }


    public function api_event_all()
    {
        $event = Event::where(['deleted' => '0'])->get();

        return response()->json([
            'status' => true,
            'data' => $event,
        ]);
    }
    public function api_event_detail($event_id)
    {
        $event = Event::where('event_id', $event_id)->where(['deleted' => '0'])->first();

        if (!$event) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $event,
            ]);
        }
    }
}
