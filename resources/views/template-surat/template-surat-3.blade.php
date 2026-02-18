@extends('layouts.layout-kosong')

@section('css')

    {{-- <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" /> --}}
    <style>
        .page-footer,
        .page-footer-space {
            height: 50px;
        }

        .page-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            color: purple !important;
            font-weight: bold;
            /* border-top: 1px solid black; */
            /* for demo */
        }

        header {
            /* border-bottom: 1px solid black; */
        }

        .page {
            page-break-after: always;
            padding: 0px 40px;
        }

        @page {
            margin: 10mm
        }

        @media print {
            thead {
                display: table-header-group;
            }
            tfoot {
                display: table-footer-group;
            }
            button {
                display: none;
            }
            body {
                margin: 0;
            }
        }
        .header-content{
            width: 100%;
            text-align: center;
        }
        .logo-header{
            width: 40px;
        }
        .text-title-header{
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            color: purple !important;
        }
        .text-title-subheader{
            font-size: 10px;
            color: purple !important;
        }
        .footer-color{
            color: purple !important;
            text-align: center;
            font-size: 12px;
        }
        .watermark{
            position: absolute;
            width: 600px;
            opacity: 0.2;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .max-content{
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    {{-- {{ dd($request_surat->master_surat->toArray()) }} --}}




    {{-- ================================================= --}}

    <body>
        <div class="max-content">
            <img src="https://raw.githubusercontent.com/ozhora/ozhora.github.io/master/logo-sinode.png" alt="" class="watermark">
        </div>
        <div class="page-footer">
            {{-- @yield('footer') --}}
            <div class="footer-color">
                Alamat : Jalan Ahmad Yani No. 221-223. Ruko Segitiga Mas Blok F7, Kota BAndung, 40113 <br>
                Email : sinodegkkd@gmail.com | Website : www.sinodegkkd.org
            </div>
        </div>

        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="page">
                            <header>
                                {{-- Master Surat --}}
                                {{-- @yield('header') --}}
                                <div class="header-content">
                                    <img src="https://raw.githubusercontent.com/ozhora/ozhora.github.io/master/logo-sinode.png" alt="" class="logo-header">
                                    <div class="text-title-header">Sinode gereja kristen kemah daud</div>
                                    <div class="text-title-subheader">
                                        Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun 1991 <br>
                                        Berita Negara RI No.93/ 1992, Tgl.20 November 1992, Tambahan Berita Negara RI No.42/ AD <br>
                                        Anggota PGLII dengan Nomor Induk : 49/PII/Grj. 1995
                                    </div>
                                </div>
                            </header>


                            <main>
                                {{-- Perihal --}}
                                <table style="margin-top: 8mm">
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
                                <div class="body_surat" style="margin-top: 10mm">
                                    @yield('body')
                                    {{-- Tanggal Input --}}
                                    <p style='text-align: center'>Bandung, {{ tanggal_indonesia(date('Y-m-d')) }}<br>BADAN PENGURUS HARIAN
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
                                </div>
                                <br>
                            </main>
                        </div>
                    </td>
                </tr>
            </tbody>

            {{-- <tfoot>
                <tr>
                    <td>
                        <div class="page-footer-space"></div>
                    </td>
                </tr>
            </tfoot> --}}
        </table>
    </body>
    {{-- ================================================= --}}
@endsection

@section('script')


    <!-- Examples -->
    {{-- <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>


    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('assets/pages/jquery.datatables.editable.init.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script> --}}

    <script>
        window.print();
        // const ival = setInterval(function() {
        //     window.close();
        //     clearInterval(ival);
        // }, 5000);
    </script>
@endsection
