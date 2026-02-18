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
                            <h4 class="page-title">TTD Surat</h4>
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
                            <div id="ttdModal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah TTD</h4>
                                        </div>
                                        <form id="formTtd"
                                            action="{{ url('/superadmin/administrasi/pengaturan/ttd-surat') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nama_ttd" class="control-label">Nama
                                                                TTD</label>
                                                            <input type="text" class="form-control" id="nama_ttd"
                                                                name="nama_ttd" placeholder="Nama TTD..">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="lfk_user_id" class="control-label">Approval</label>
                                                            <select class="form-control" id="lfk_user_id"
                                                                name="lfk_user_id">
                                                                <option value="">Pilih Approval</option>
                                                                @foreach ($approval as $item)
                                                                    <option value="{{ $item->user_id }}"
                                                                        {{ $item->user_id == old('lfk_user_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="jabatan_ttd" class="control-label">Jabatan</label>
                                                            <input type="text" class="form-control" id="jabatan_ttd"
                                                                name="jabatan_ttd" placeholder="Jabatan.."
                                                                value="{{ old('jabatan_ttd') }}">
                                                        </div>
                                                        <div class="form-group checkboxUbah">
                                                            <label for="ubahTtd" class="control-label">Ubah ttd</label><br>
                                                            <button class="btn btn-primary" type="button"
                                                                id="showUpload">Show</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-10 fileUpload">
                                                    <div class="form-group clearfix" id="inputfile">
                                                        <label>Gambar TTD</label>
                                                        <div class="col-sm-12 padding-left-0 padding-right-0">
                                                            <input id="ttd" type="file" class="filestyle"
                                                                name="ttd" data-buttonname="btn-primary"
                                                                accept="image/*">
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
                                        <button id="tambahTTD" class="btn btn-success waves-effect waves-light"
                                            data-toggle="modal" data-target="#ttdModal">Add <i
                                                class="mdi mdi-plus-circle-outline"></i></button>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <div class="" style="overflow: auto">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-ttd">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Nama TTD Surat</th>
                                            <th class="text-center">Nama Approval</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">TTD</th>
                                            <th class="text-center">Tanggal Pembuatan</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ttd as $key => $item)
                                            <tr class="">
                                                <td style="text-align: center">{{ ++$key }}</td>
                                                <td style="text-align: center">{{ $item->nama_ttd }}</td>
                                                <td style="text-align: center">{{ $item->user->nama }}</td>
                                                <td style="text-align: center">{{ $item->jabatan_ttd }}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ S3Helper::get($item->ttd) }}" target="_blank">
                                                        <img src="{{ S3Helper::get($item->ttd) }}" alt=""
                                                            width="50px">
                                                    </a>
                                                </td>
                                                <td style="text-align: center">
                                                    {{ format_date($item->created_date, 'd F Y, H:i:s') }}</td>
                                                <td class="actions text-center"
                                                    style="width: 120px; overflow: hidden; max-width: 120px;">
                                                    <div class="btn-group btn-group-justified m-b-10 text-center">
                                                        <a href="" data-toggle="modal" data-target="#ttdModal"
                                                            onclick="editTtd('{{ $item->ttd_id }}')"
                                                            title="Edit Approval Surat" class="btn btn-primary"><i
                                                                class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('superadmin/administrasi/pengaturan/ttd-surat/hapus/' . $item->ttd_id) }}"
                                                            class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

    {{-- pagejs --}}
    <script src="{{ url('assets/pages/jquery.datatables.ttd.init.js') }}"></script>
    <script src="{{ url('assets/pages/jquery.fileuploads.init.js') }}"></script>
    <script src="{{ url('/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>

    <script src="{{ url('assets/js/pengaturan/ttd.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
@endsection
