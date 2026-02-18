@extends('layouts.layout')

@section('css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />

@endsection
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
                    <div class="col-md-12">
                        <div class="card-box table-responsive">
                            {{-- ModalSample --}}
                            <div id="bodySuratModal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Body Template</h4>
                                        </div>
                                        <form id="formBody" method="POST"
                                            action="{{ url('/superadmin/administrasi/pengaturan/body-surat/tambah-body/') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nama_body" class="control-label">Nama
                                                                Template Body</label>
                                                            <input type="text" class="form-control" id="nama_body"
                                                                name="nama_body" placeholder="Nama Template Body..">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="html_body" class="control-label">Body Text</label>
                                                            <div class="centered">
                                                                <div class="row row-editor">
                                                                    <div class="editor-container">
                                                                        <textarea class="editor" name="html_body"
                                                                            id="html_body">
                                                                                                        </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {!! modalFooterZircos() !!}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <button id="tambahBody" class="btn btn-success waves-effect waves-light"
                                            data-toggle="modal" data-target="#bodySuratModal">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <table class="{{ styletable() }}" id="datatable-editable">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Nama Template Body Surat</th>
                                        <th class="text-center">Tanggal Pembuatan</th>
                                        <th class="text-center table-action">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($body as $key => $item)
                                        <tr class="">
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td class="text-center">{{ $item->nama_body }}</td>
                                            <td class="text-center">{{ $item->created_date }}</td>
                                            <td class="actions text-center">
                                                {{-- <div class="btn-group btn-group-justified m-b-10 text-center"> --}}
                                                <button href="" data-toggle="modal" data-target="#bodySuratModal"
                                                    onclick="editBody('{{ $item->template_body_id }}')"
                                                    title="Edit Body Surat" class="btn btn-warning btn-action text-white">
                                                    <i class="fa fa-pencil text-white"></i> {{ editText() }}
                                                </button>
                                                <button href="#"
                                                    onclick="delConf('{{ url('superadmin/administrasi/pengaturan/body-surat/hapus/' . $item->template_body_id, []) }}')"
                                                    class="btn btn-danger waves-effect waves-light btn-action">
                                                    <i class="fa fa-trash"></i> {{ deletetext() }}
                                                </button>
                                                {{-- </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end: page -->

                    </div> <!-- end Panel -->
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
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>


    {{-- ckeditor --}}
    <script src="{{ url('plugins/ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
    <script src="{{ url('assets/js/ckeditor.js') }}"></script>
    <script src="{{ url('assets/js/body.js') }}"></script>
@endsection
