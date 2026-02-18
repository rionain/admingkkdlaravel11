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

    <main>
        {{-- Perihal --}}
        <div>
            <h5 style="text-align: center">
                <u>SURAT KEPUTUSAN</u>
                <br>
                NOMOR : @yield('nomor_surat')
                <br>
                TENTANG
                <br>
                Penetapan @yield('jabatan') Gereja Kristen Kemah Daud
                <hr style="border: 1px solid black">
            </h5>
        </div>

        {{-- pembukaan --}}
        @yield('pembukaan')

        {{-- menimbang --}}
        <h5 style="margin-bottom: 0">Menimbang :</h5>
        <ol>
            <li>
                Setelah memperhatikan buah-buah kehidupan dan pelayanan Jemaat GKKD @yield('nama_gereja')
            </li>
            <li>
                Demi kemajuan pelayanan jemaat di GKKD @yield('nama_gereja')
            </li>
        </ol>

        {{-- memperhatikan --}}
        <h5 style="margin-bottom: 0">Memperhatikan :</h5>
        <ol>
            <li>
                Anggaran Rumah Tangga GKKD Pasal 42 tentang Pendeta;
            </li>
            <li>
                Surat Keputusan Nomor : S-GKKD/SKEP.PDM/230/XI-2015 tentang Penetapan Pdm. Benas B Hutajulu, ST, MA;
            </li>
            <li>
                Surat Pengajuan calon Pendeta dari GKKD @yield('nama_gereja') @yield('tanggal_persetujuan');
            </li>
            <li>
                Hasil Rapat BPH Sinode GKKD pada tanggal 7 September 2021.
            </li>
        </ol>

        {{-- memutuskan --}}
        <h5 style="text-align: center;">MEMUTUSKAN :</h5>
        <p style="text-align: justify">
            Dalam nama BAPA, ANAK dan ROH KUDUS yaitu TUHAN YESUS KRISTUS, Sinode Gereja
            Kristen Kemah Daud, mengangkat dan menetapkan ke dalam jabatan @yield('jabatan') :
        </p>
        <p style="text-align: center">
            <b>@yield('nama_lengkap')</b>
            <br>
            Tempat, Tanggal Lahir : @yield('tempat_lahir'), @yield('tanggal_lahir')
        </p>
        <p style="text-align: justify">
            Dengan demikian @yield('nama_lengkap') berkewajiban memenuhi tugas pelayanan dan tanggung
            jawabnya kepada Tuhan, Penatua, Jemaat GKKD @yield('nama_gereja') dan Sinode GKKD.
        </p>

        {{-- penutupan --}}
        @yield('penutupan')
        <br>
        <br>
        {{-- Tanggal Input --}}
        <p style='text-align: center'>@hasSection('tempat_penetapan')
                @yield('tempat_penetapan')
            @else
                ________


            @endif,
            @hasSection('tanggal_penetapan')
                @yield('tanggal_penetapan')

            @else
                ___________
            @endif
            <br>BADAN PENGURUS HARIAN
            SINODE GKKD
        </p>


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
