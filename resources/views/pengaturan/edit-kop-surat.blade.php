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
                            <div class="p-20">
                                <form class="form-horizontal " action="#">
                                    <div class="form-group">
                                        <label>Nama Instansi</label>
                                        <input type="text" class="form-control" required placeholder="nama instansi.." />
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Instansi</label>
                                        <input type="text" class="form-control" required
                                            placeholder="alamat instansi.." />
                                    </div>
                                    <div class="form-group">
                                        <label>Telp</label>
                                        <input type="tel" class="form-control" required placeholder="no telp.." />
                                    </div>
                                </form>
                            </div>
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
    <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>

    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>

    <script src="{{ url('assets/pages/jquery.datatables.editable.init.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
@endsection
