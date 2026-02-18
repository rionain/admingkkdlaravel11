@extends('layouts.layout')


@section('css')
    <link href="{{ asset('plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Request Surat Custom</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">

                            @include('admin-cabang.request-surat.isi-modal')

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">

                                        <button id="btnTambahRequestSurat" class="btn btn-success waves-effect waves-light"
                                            data-toggle="modal" data-target="#modalSurat">Request<i
                                                class="mdi mdi-plus-circle-outline"></i></button>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <div class="">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-reqsurat">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Surat</th>
                                            <th>Perihal</th>
                                            <th>Nama yang diajukan</th>
                                            <th>No Telp yang diajukan</th>
                                            <th>Email yang diajukan</th>
                                            <th>Status Surat</th>
                                            <th>Alasan Demote</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surat as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->nama_surat }}</td>
                                                <td>{{ $item->perihal }}</td>
                                                <td>{{ $item->nama_diajukan }}</td>
                                                <td>{{ $item->no_telp_diajukan }}</td>
                                                <td>{{ $item->email_diajukan }}</td>
                                                <td>
                                                    @if ($item->lfk_status_surat_id == 5)
                                                        <span class="badge badge-danger">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @elseif ($item->lfk_status_surat_id == 1)
                                                        <span class="badge badge-info">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @elseif ($item->lfk_status_surat_id == 6)
                                                        <span class="badge badge-success">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->lfk_status_surat_id == 5)
                                                        <span class="badge badge-danger">
                                                            {{ $item->demote_reason }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">
                                                            KOSONG
                                                        </span>
                                                    @endif

                                                </td>
                                                <td class="actions text-center"
                                                    style="width: 100px; overflow: hidden; max-width: 120px;">
                                                    @if ($item->lfk_status_surat_id == 5)
                                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#modalSurat"
                                                            onclick="revisiSurat('{{ $item->surat_id }}')">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    @elseif($item->lfk_status_surat_id == 6)
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <a href="{{ url('admin-cabang/request-surat/lihat/' . $item->surat_id, []) }}"
                                                                target="_blank" class="btn btn-success"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </div>
                                                    @else
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <a href="#"
                                                                onclick="delConf('{{ url('admin-cabang/request-surat/hapus/' . $item->surat_id) }}')"
                                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end: page -->

                    </div> <!-- end Panel -->
                </div>
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
    <script src="{{ url('assets/pages/jquery.datatables.reqsurat.init.js') }}"></script>
    <script src="{{ url('assets/pages/jquery.fileuploads.init.js') }}"></script>
    <script src="{{ url('/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ url('/assets/js/admcabang/reqsurat.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
    <script>
        function generateKop() {
            var kopsurattest = $('#fieldNameKop').val();
        }
    </script>
    <script>
        const modalSurat = 'modalSurat'
        // const modalDetailKop    = 'modalDetailKop'
        const formSurat = 'formSurat'

        $(`#btnTambahRequestSurat`).click(function() {
            titleActionSurat('Request surat', base_url('admin-cabang/request-surat/surat-custom'))
        });
        $('#' + modalSurat).on('hidden.bs.modal', function() {
            titleActionSurat('', base_url(''))
            tutupModalSurat(modalSurat, 'nama_surat')
            tutupModalSurat(modalSurat, 'perihal')
            tutupModalSurat(modalSurat, 'nama_diajukan')
            tutupModalSurat(modalSurat, 'email_diajukan')
            tutupModalSurat(modalSurat, 'no_telp_diajukan')
            tutupModalSurat(modalSurat, 'alamat_diajukan')
        });

        function revisiSurat(id) {
            titleActionSurat('Revisi surat', base_url(
                'admin-cabang/request-surat/revisi/' + id))
            startloading('#' + modalSurat + ' .modal-dialog')

            var settings = {
                'url': base_url('api/v1/admin-cabang/request-surat/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                setVal(modalSurat, 'nama_surat', response.data.nama_surat)
                setVal(modalSurat, 'perihal', response.data.perihal)
                setVal(modalSurat, 'nama_diajukan', response.data.nama_diajukan)
                setVal(modalSurat, 'email_diajukan', response.data.email_diajukan)
                setVal(modalSurat, 'no_telp_diajukan', response.data.no_telp_diajukan)
                setVal(modalSurat, 'alamat_diajukan', response.data.alamat_diajukan)

                stoploading('#' + modalSurat + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalSurat + ' .modal-dialog')
            });
        }

        function titleActionSurat(title, action) {
            $('#' + modalSurat + ' .modal-title').html(title)
            $('#' + modalSurat + ' #' + formSurat).attr('action', action)
        }

        function tutupModalSurat(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>
@endsection
