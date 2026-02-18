@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Body Surat</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box">
                            {{-- INI KOP --}}
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: center">
                                <img style="padding: 12px" align="left" src="{{ asset('assets/images/client-logo.png') }}"
                                    width="240px" height="240px">
                                <div style="text-align: center">
                                    <b>
                                        <br>
                                        <font size="4" color='#6D0863'>SINODE GEREJA KRISTEN KEMAH DAUD</font>
                                        <br>
                                    </b>
                                    <font size="2" color="#6D0863">Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun
                                        1991
                                        Berita Negara RI No.39/1992, Tgl. 20 November 1992, Tambahan Berita Negara RI No.
                                        42/AD
                                        Anggota PGLII dengan Nomor Induk : 49/PII/Grj.1995</font>
                                </div>
                            </div>

                            <hr width="100%" size="3">
                            <br>

                            <table>
                                <tr>
                                    <td>No</td>
                                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td>S-GKKD/022/IV/2021</td>
                                </tr>
                                <tr>
                                    <td>Perihal</td>
                                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td>Penunjukan Ketua Satuan Tugas Bencana NTT</td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            Kepada Yth, <br>
                            <b>--NAMA-- <br></b>
                            Di Tempat <br>
                            <br>
                            <br>
                            Dengan Hormat, <br>
                            Melalui surat ini, kami Sinode GKKD menunjuk yang bersangkutan dibawah ini sebagai Ketua Satgas
                            (Satuan Tugas) Bencana NTT perwakilan Sinode GKKD, yaitu <br>
                            <br>
                            <table>
                                <tr>
                                    <td><b>Nama</b></td>
                                    <td>&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;</td>
                                    <td><b>Tumpal Pangihutan</b></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top">Alamat</td>
                                    <td style="vertical-align: top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td style="vertical-align: top">Jl. Sesuatu yang panjang text cukup untuk menjadi dua
                                        barus sehingga saya bisa mengecek apakah ini sudah tertata dengan rapi, tapi
                                        sepertinya masih kurang jadi saya menambahkan lagi beberapa teks yang tidak penting
                                    </td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td>081221841290</td>
                                </tr>
                            </table>
                            <br>
                            Untuk itu kami SINODE GKKD akan bekerja sama dengan bapak dalam penangan bencana saat ini di NTT
                            dan NTB serta
                            sekitarnya, juga menjadi perwakilan untuk mengurus segala sesuatu yang diperlukan dengan
                            pihak-pihak
                            yang terkait. Demikian surat penunjukan diri dibuat untuk digunakan sesuai keperluannya. Atas
                            perhatian
                            Bapak, kami mengucapkan terimakasih.
                            <center>
                                Bandung,
                                <b>
                                    --Tanggal--
                                </b><br>
                                Badan Pengurus Harian SINODE GKKD
                            </center>
                            <br>
                            <div style="width:100%;">
                                <div
                                    style="display: flex; flex-direction: row; align-items: center; justify-content: center">
                                    <div class="container">
                                        <img src="{{ asset('assets/images/client-logo.png') }}"
                                            style="float:left;width:100%;height:120px;object-fit:contain;">
                                    </div>
                                    <div class="container">
                                        <img src="{{ asset('assets/images/client-logo.png') }}"
                                            style="float:left;width:100%;height:120px;object-fit:contain;">
                                    </div>
                                    <div
                                        style="width: 100%;background: chartreuse;position: absolute;left: 50%;bottom: 8px;transform: translate(-50%,-50%)">
                                        <div
                                            style="display: flex; flex-direction: row; align-items: center; justify-content: center">
                                            <div class="container">
                                                Muhammad Alfin Nahrowi
                                            </div>
                                            <div class="container">
                                                Rio Kisna
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- INI AKHIR KOP --}}
                        </div>
                    </div>
                </div>

                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->


    </div>
@endsection

@section('script')

    <!-- Examples -->
    <script src="{{ asset('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('plugins/tiny-editable/numeric-input-example.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

    <script src="{{ asset('assets/pages/jquery.datatables.editable.init.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
@endsection
