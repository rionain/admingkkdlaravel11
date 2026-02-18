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
        @yield('header')
    </header>


    {{-- Footer --}}
    <footer>
        @yield('footer')
    </footer>
    <br>

    <main style="text-align: justify">
        {{-- Perihal --}}
        <div>
            <h5 style="text-align: center">
                <u>SURAT TUGAS</u>
                {{-- <br> --}}
                {{-- BADAN PENGURUS HARIAN SINODE GKKD --}}
                <br>
                NOMOR : @yield('nomor_surat')
            </h5>
        </div>
        <br>

        <p>Sehubungan dengan adanya <b>"@yield('tugas')"</b>
            yang akan dilaksanakan pada tanggal @yield('tanggal_tugas') bertempat di @yield('tempat_tugas'),
            dengan ini Sinode GKKD memberi tugas kepada :</p>

        {{-- petugas --}}
        <h4 style="text-align: center">@yield('petugas')</h4>

        <p>Untuk melakukan tugas @yield('tugas') serta segala bentuk pelayanan
            yang diperlukan didalam pelayanan tersebut. Demikian surat tugas ini dibuatkan agar yang
            bersangkutan diatas dapat melakukan tugas pelayanannya dengan lebih maksimal ditempat
            bertugas.</p>
        <br>
        <br>
        {{-- Tanggal Input --}}
        <p style='text-align: center'>@yield('tempat_surat'), @yield('tanggal_surat')<br>BADAN PENGURUS HARIAN
            SINODE GKKD</p>


        {{-- TTD --}}
        <div style="padding: 12px;display: flex; flex-direction: row; justify-content: center">
            @yield('tanda_tangan')
        </div>

        {{-- Tembusan --}}
        <table style='vertical-align: top'>
            <tr>
                <td style='vertical-align: top'>Tembusan</td>
                <td style='vertical-align: top; padding: 0 12px'>:</td>
                <td>@yield('tembusan')</td>
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
