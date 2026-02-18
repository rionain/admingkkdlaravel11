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
    {{-- <header> --}}
    {{-- Master Surat --}}
    @yield('header')
    {{-- </header> --}}


    {{-- Footer --}}
    <footer>
        @yield('footer')
    </footer>
    <br>

    <main>
        {{-- Perihal --}}
        <div>
            <h5 style="text-align: center">
                SURAT PENUNJUKAN SINODE GKKD
                <br>
                NOMOR : @yield('nomor_surat')
            </h5>
        </div>
        <br>

        {{-- pembukaan --}}
        @yield('pembukaan')

        {{-- isi_penunjukan --}}
        <ol>
            <li>Jemaat GKKD @yield('nama_gereja') yang berkedudukan di @yield('alamat_lengkap_gereja') adalah benar bernaung
                dibawah Sinode GKKD.</li>
            <li>
                <p style="margin: 0">Pengurus GKKD @yield('nama_gereja') adalah sebagai berikut : </p>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('nama_ketua')
                                @yield('nama_ketua')
                            @else
                                ___________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat, tanggal lahir</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('tempat_lahir_ketua')
                                @yield('tempat_lahir_ketua')
                            @else
                                _______
                            @endif,
                            @hasSection('tanggal_lahir_ketua')
                                @yield('tanggal_lahir_ketua')
                            @else
                                ___________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('alamat_ketua')
                                @yield('alamat_ketua')
                            @else
                                ___________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>Ketua</td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('nama_sekretaris')
                                @yield('nama_sekretaris')
                            @else
                                ___________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat, tanggal lahir</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('tempat_lahir_sekretaris')
                                @yield('tempat_lahir_sekretaris')
                            @else
                                _______
                            @endif,
                            @hasSection('tanggal_lahir_sekretaris')
                                @yield('tanggal_lahir_sekretaris')
                            @else
                                ___________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('alamat_sekretaris')
                                @yield('alamat_sekretaris')
                            @else
                                ___________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>Sekretaris</td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('nama_bendahara')
                                @yield('nama_bendahara')
                            @else
                                ___________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat, tanggal lahir</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('tempat_lahir_bendahara')
                                @yield('tempat_lahir_bendahara')
                            @else
                                _______
                            @endif,
                            @hasSection('tanggal_lahir_bendahara')
                                @yield('tanggal_lahir_bendahara')
                            @else
                                ___________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>
                            @hasSection('alamat_bendahara')
                                @yield('alamat_bendahara')
                            @else
                                ___________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td style="width: 20px;text-align: center">:</td>
                        <td>Bendahara</td>
                    </tr>
                </table>
            </li>
        </ol>

        {{-- penutupan --}}
        @yield('penutupan')
        <br>
        <br>
        {{-- Tanggal Input --}}
        <p style='text-align: center'>@yield('tempat_penunjukan'), @yield('tanggal_penunjukan')<br>BADAN PENGURUS HARIAN
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
