@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Kop Surat</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->



                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <a href="/edit-kop" class="btn btn-success waves-effect waves-light m-b-5">
                                            <span>Edit</span> <i class="fa fa-pencil m-l-5"></i>

                                        </a>
                                    </div>
                                </div>
                            </div>

                            <table align="center">
                                <tr>
                                    <td>
                                        <h4>Name</h4>
                                    </td>
                                    <td>
                                        <h4>Gereja Kristen Kemah Daud</h4>
                                    </td>
                                </tr>
                            </table>

                            <h4>Name : Gereja Kristen Kemah Daud</h4>
                            <h4>Bottom Name Text : Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun 1991
                                Berita Negara RI No.39/1992, Tgl. 20 November 1992, Tambahan Berita Negara RI No. 42/AD
                                Anggota PGLII dengan Nomor Induk : 49/PII/Grj.1995</h4>
                            <h4>Logo Instansi : </h4>
                            <img src="assets/images/client-logo.png" width="120 " height="120">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box">
                            {{-- INI KOP --}}
                            <table align="center">
                                <tr>
                                    <center>
                                        <img src="{{ 'assets/images/client-logo.png' }}" width="50" height="50">
                                    </center>
                                </tr>
                                <td>
                                    <center>
                                        <h3 style="color: rgb(109, 8, 99)" size="6">SINODE GEREJA KRISTEN KEMAH DAUD</h3>
                                        <span
                                            style="color: rgb(109, 8, 99); font-family: Georgia, 'Times New Roman', Times, serif">
                                            Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun 1991
                                            Berita Negara RI No.39/1992, Tgl. 20 November 1992, Tambahan Berita Negara RI
                                            No. 42/AD Anggota PGLII dengan Nomor Induk : 49/PII/Grj.1995</span>
                                    </center>
                                </td>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                            </table>
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
    <script src="plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <script src="plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="plugins/tiny-editable/mindmup-editabletable.js"></script>
    <script src="plugins/tiny-editable/numeric-input-example.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script src="assets/pages/jquery.datatables.editable.init.js"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
@endsection
