@extends('layouts.layout-kosong')

@section('css')
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <style>
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        @page {
            margin: 0 2cm;
        }
    </style>
@endsection
@section('content')
    {{-- {{ dd($request_surat->master_surat->toArray()) }} --}}
    <header>
        {{-- Master Surat --}}
        {!! $pengaturan_surat_penunjukan->kop->headerdescription !!}
    </header>


    {{-- Footer --}}
    <footer>
        {!! $pengaturan_surat_penunjukan->footer->footer !!}
    </footer>
    <br>

    <main>
        {{-- Perihal --}}
        <div>
            <h5 style="text-align: center">
                SURAT PENUNJUKAN SINODE GKKD
                <br>
                NOMOR : ___________________
            </h5>
        </div>
        <br>

        {{-- pembukaan --}}
        {!! $pengaturan_surat_penunjukan->pembukaan !!}

        {{-- isi_penunjukan --}}
        <ol>
            <li>Jemaat GKKD Pontianak yang berkedudukan di Jl.Purnama I. Komp.Pelangi Indah No.A4, Kel.Parit Tokaya,
                Kec.Pontianak Selatan, Pontianak Kal-Bar adalah benar bernaung di bawah Sinode GKKD.</li>
            <li>Pengurus GKKD Malang (Pahlawan Allah) adalah sebagai berikut
                :<br>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Drs.
                Marsauli<br>Tempat, Tanggal Lahir&nbsp; &nbsp; :&nbsp;Duri Kab. Bengkalis, 11 April
                1963<br>Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;: Jl.Ujung Pandang Komp.Kurnia 5B No B 9 Kel.Sungai Jawi Kec.Pontianak Kota,
                Pontianak-Kalbar<br>Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                :
                Ketua<br><br>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                : Yohanis Banamtuan<br>Tempat, Tanggal Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Neke, 21 Juli
                2021<br>Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp; :&nbsp;Jl Perdamaian Arikarya Indah 4, Komp Kurnia 8, No.A.2,
                Pontianak<br>Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;:&nbsp;Sekretaris<br><br>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                : Seriawaty<br>Tempat, Tanggal Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 27 mei
                1982<br>Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp; : Jl Perdamaian Arikarya Indah 4, Komp Kurnia 8, No.A.2,
                Pontianak<br>Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;: Bendahara</li>
        </ol>

        {{-- penutupan --}}
        {!! $pengaturan_surat_penunjukan->penutupan !!}
        <br>
        <br>
        {{-- Tanggal Input --}}
        <p style='text-align: center'>Jakarta, {{ date('d-m-Y') }}<br>BADAN PENGURUS HARIAN
            SINODE GKKD</p>


        {{-- TTD --}}
        <div style="padding: 12px;display: flex; flex-direction: row; justify-content: center">
            @foreach ($pengaturan_surat_penunjukan->detail_ttd as $key => $item)
                <div style="flex: 1; text-align: center">
                    <img style='padding: 8px;object-fit:contain;' src='{{ S3Helper::get(@$item->ttd->ttd) }}'
                        height='120px'><br>
                    <span><b>{!! @$item->ttd->jabatan_ttd !!}</b><br>{!! @$item->ttd->user->nama !!}</span>
                </div>
            @endforeach
        </div>

        {{-- Tembusan --}}
        <table style='vertical-align: top'>
            <tr>
                <td style='vertical-align: top'>Tembusan</td>
                <td style='vertical-align: top; padding: 0 12px'>:</td>
                <td>{!! $pengaturan_surat_penunjukan->tembusan->tembusan_text !!}</td>
            </tr>
        </table>
        <br>
    </main>
@endsection

@section('script')
    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>

    <script>
        window.print();
        // const ival = setInterval(function() {
        //     window.close();
        //     clearInterval(ival);
        // }, 1000);
    </script>
@endsection
