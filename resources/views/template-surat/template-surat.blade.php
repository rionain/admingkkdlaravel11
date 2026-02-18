@extends('layouts.layout-kosong')

@section('css')

    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <style>
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
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


    <main>
        {{-- Perihal --}}
        <table>
            <tr>
                <td>No</td>
                <td style="padding: 0 10px">:</td>
                <td>@yield('no_surat')</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td style="padding: 0 10px">:</td>
                <td>@yield('perihal')</td>
            </tr>
        </table>
        <br>

        {{-- Greeting --}}
        <p>Kepada Yth, <br><b>@yield('tujuan')</b><br>Di Tempat</p>

        {{-- Body --}}
        @yield('body')

        {{-- Tanggal Input --}}
        <p style='text-align: center'>Bandung, {{ date('d F Y') }}<br>BADAN PENGURUS HARIAN SINODE GKKD</p>


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

    <!-- Examples -->
    <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>


    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('assets/pages/jquery.datatables.editable.init.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

    <script>
        window.print();
        // const ival = setInterval(function() {
        //     window.close();
        //     clearInterval(ival);
        // }, 1000);
    </script>
@endsection
