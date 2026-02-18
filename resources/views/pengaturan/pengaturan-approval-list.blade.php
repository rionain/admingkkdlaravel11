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
                            <h4 class="page-title">Approval</h4>
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
                            <div id="approvalModal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <form id="formApproval" method="POST"
                                        action="{{ url('/superadmin/administrasi/pengaturan/body-surat/tambah-body/') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"></button>
                                                <h4 class="modal-title">Tambah Approval</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nama" class="control-label">Nama
                                                                Approval</label>
                                                            <input type="text" class="form-control" id="nama"
                                                                name="nama" placeholder="Nama Approval.."
                                                                value="{{ old('nama') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email" class="control-label">Email
                                                                Approval (untuk login)
                                                            </label>
                                                            <input type="text" class="form-control" id="email"
                                                                name="email" placeholder="Email Approval.."
                                                                value="{{ old('email') }}">
                                                        </div>
                                                        <div class="form-group password-field">
                                                            <label for="password" class="control-label">Password
                                                                Approval (untuk login)
                                                            </label>
                                                            <input type="password" class="form-control" id="password"
                                                                name="password" placeholder="Password.."
                                                                value="{{ old('password') }}">
                                                        </div>
                                                        <div class="form-group password-field">
                                                            <label for="password_confirmation" class="control-label">
                                                                Konfirmasi Approval (untuk login)</label>
                                                            <input type="password" class="form-control"
                                                                id="password_confirmation" name="password_confirmation"
                                                                placeholder="Ulangi Password.."
                                                                value="{{ old('password_confirmation') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gender" class="control-label">Gender</label><br>
                                                            <input type="radio" name="gender" id="genderl"
                                                                value="l" checked>
                                                            Laki-laki
                                                            <input type="radio" name="gender" id="genderp"
                                                                value="p">
                                                            Perempuan

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone" class="control-label">Phone</label>
                                                            <input type="tel" class="form-control" name="phone"
                                                                id="phone" placeholder="085....." required
                                                                value="{{ old('phone') }}" value="{{ old('phone') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ttd" class="control-label">TTD</label>
                                                            <br>
                                                            <img src="" alt="" class="img-thumbnail"
                                                                style="display:none;max-width:200px;margin: auto"
                                                                id="ttd-edit-img">
                                                            <input type="file" class="form-control" name="ttd"
                                                                id="ttd">
                                                            <span class="text-error" id="ttd-edit-text"
                                                                style="display: none">*Kosongkan bila
                                                                tidak ingin
                                                                mengubah TTD</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jabatan" class="control-label">Jabatan</label>
                                                            <input type="tel" class="form-control" name="jabatan"
                                                                id="jabatan" placeholder="" required
                                                                value="{{ old('jabatan') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {!! modalFooterZircos() !!}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <button id="tambahApproval" class="btn btn-success waves-effect waves-light"
                                            data-toggle="modal" data-target="#approvalModal">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <table class="table table-striped add-edit-table table-bordered" id="datatable-editable">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Nama Approval</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">TTD</th>
                                        <th class="text-center table-action">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approval as $key => $item)
                                        <tr class="">
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ @$item->ttd->jabatan_ttd }}</td>
                                            <td>
                                                <img src="{{ S3Helper::get(@$item->ttd->ttd) }}" alt=""
                                                    class="img-thumbnail" style="max-width:50px;margin: auto">
                                            </td>
                                            <td class="actions text-center">
                                                <button href="#" data-toggle="modal" data-target="#approvalModal"
                                                    onclick="editApproval('{{ $item->user_id }}')"
                                                    title="Edit Approval Surat" class="btn btn-warning btn-action">
                                                    <i class="fa fa-pencil text-white"></i> {{ editText() }}
                                                </button>
                                                <button href="#" onclick="hapusApproval('{{ $item->user_id }}')"
                                                    class="btn btn-danger btn-action">
                                                    <i class="fa fa-trash text-white"></i> {{ deletetext() }}
                                                </button>
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
    <script src="{{ url('assets/js/pengaturan/approval.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
@endsection
