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
                            <h4 class="page-title">Master Surat</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            {{-- ModalSample --}}
                            <div id="masterSuratModal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Master</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="layoutPicker" class="control-label">Pilih
                                                            Layout</label>
                                                        <select id="layoutPicker" class="selectpicker"
                                                            data-style="btn-custom" data-live-search="true">
                                                            <option>Layout 1</option>
                                                            <option>Layout 2</option>
                                                            <option>Layout 3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="namaTemplateBody" class="control-label">Nama Template
                                                            Body</label>
                                                        <input type="text" class="form-control" id="namaTemplateBody"
                                                            placeholder="Nama Template Body..">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Title Header</label>
                                                        <input type="text" class="form-control" id="field-3"
                                                            placeholder="Nama Instansi, Nama Organisasi..">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Header
                                                            Description</label>
                                                        <textarea class="form-control autogrow" id="field-7"
                                                            placeholder="Alamat atau deskripsi instansi.."
                                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {!! modalFooterZircos() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <a href="{{ url('superadmin/administrasi/pengaturan/master-surat/tambah-master') }}"
                                            id="tambahMaster" class="btn btn-success waves-effect waves-light">Tambah <i
                                                class="mdi mdi-plus-circle-outline"></i></a>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <div class="">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-editable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Nama Master</th>
                                            <th class="text-center">Kop</th>
                                            <th class="text-center">Tembusan</th>
                                            <th class="text-center">Footer</th>
                                            <th class="text-center">Jenis Surat</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($master_surat as $key => $value)
                                            <tr class="">
                                                <td class="text-center">{{ ++$key }}</td>
                                                <td class="">{{ $value->nama_master }}</td>
                                                <td class="">{{ $value->kop->nama_kop_surat }}</td>
                                                <td class="">{{ $value->tembusan->nama_tembusan }}</td>
                                                <td class="">{{ $value->footer->nama_footer }}</td>
                                                <td class="">{{ $value->jenis_surat->nama_jenis }}</td>
                                                <td class="actions text-center"
                                                    style="width: 120px; overflow: hidden; max-width: 120px;">
                                                    <div class="btn-group btn-group-justified m-b-10 text-center">
                                                        <a href="{{ url('superadmin/administrasi/pengaturan/master-surat/lihat/' . $value->template_master_id, []) }}"
                                                            onclick="" class="btn btn-primary" target="_blank"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a href="{{ url('superadmin/administrasi/pengaturan/master-surat/hapus/' . $value->template_master_id, []) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Apakah anda yakin?')"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
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

    <script>
        function viewKop(id) {
            console.log(id)
        }
    </script>
    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
@endsection
