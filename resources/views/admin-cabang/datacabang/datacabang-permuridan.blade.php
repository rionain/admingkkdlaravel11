@extends('layouts.layout')
@section('css')
    <link href="{{ url('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ url('plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/numberonlynoarrow.css') }}" rel="stylesheet">
    <style>
        .center-item {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, 0%);
        }

    </style>
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Database Permuridan</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Database</h4>
                        <ul class="nav nav-tabs">
                            <li class="{{ request('tab') == 'kakak_pa' || !request('tab') ? 'active' : '' }}" onclick="tab_click('kakak_pa')">
                                <a href="#kakakpa" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Pembimbing PA</span>
                                </a>
                            </li>
                            {{-- <li class="">
                                <a href="#anakpa" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                                    <span class="hidden-xs">Anak PA</span>
                                </a>
                            </li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane {{ request('tab') == 'kakak_pa' || !request('tab') ? 'active' : '' }}"
                                id="kakakpa">
                                <div class="panel">
                                    <div class="panel-body">
                                        {{-- ModalSample --}}
                                        <div id="addKakakData" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form
                                                    action="{{ url('admin-cabang/database/database-permuridan/kakak-pa') }}"
                                                    method="POST" id="addFormKakakPA">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Tambah Pembimbing PA</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="nama" class="control-label">Nama Pembimbing PA</label>
                                                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pembimbing PA" required value="{{ old('nama') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email" class="control-label">Email Pembimbing PA</label>
                                                                        <input type="email" class="form-control" autocomplete="off" name="email" id="email" placeholder="Email Pembimbing PA" required value="{{ old('email') }}">
                                                                    </div>
                                                                    {{-- <div id="password-group">
                                                                        <div class="form-group">
                                                                            <label for="password" class="control-label">Password Kakak PA</label>
                                                                            <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" placeholder="Password kakak PA" value="{{ old('password') }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password_confirmation" class="control-label">Konfirmasi Password</label>
                                                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password" value="{{ old('password_confirmation') }}">
                                                                        </div>
                                                                    </div> --}}
                                                                    <div class="form-group">
                                                                        <label for="gender" class="control-label">Gender</label><br>
                                                                        <input type="radio" name="gender" id="gender" value="l" {{ old('gender') == 'l' ? 'checked' : '' }}> Laki-laki
                                                                        <input type="radio" name="gender" id="gender" value="p" {{ old('gender') == 'p' ? 'checked' : '' }}> Perempuan
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone" class="control-label">Phone</label>
                                                                        <input type="tel" class="form-control" name="phone" id="phone" onkeypress="return hanyaAngka(event)" placeholder="085....." value="{{ old('phone') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat" class="control-label">Alamat</label>
                                                                        <textarea name="alamat" id="alamat" cols="2" rows="2" class="form-control">{{ old('alamat') }}</textarea>
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
                                        <div id="editKakakData" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form
                                                    action="{{ url('admin-cabang/database/database-permuridan/kakak-pa') }}"
                                                    method="POST" id="editFormKakakPA">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Tambah Pembimbing PA</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="nama" class="control-label">Nama Pembimbing PA</label>
                                                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pembimbing PA" required value="{{ old('nama') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email" class="control-label">Email Pembimbing PA</label>
                                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Pembimbing PA" required value="{{ old('email') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gender" class="control-label">Gender</label><br>
                                                                        <input type="radio" name="gender" id="gender" value="l" {{ old('gender') == 'l' ? 'checked' : '' }}> Laki-laki
                                                                        <input type="radio" name="gender" id="gender" value="p" {{ old('gender') == 'p' ? 'checked' : '' }}> Perempuan
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone" class="control-label">Phone</label>
                                                                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="085....." onkeypress="return hanyaAngka(event)" value="{{ old('phone') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat" class="control-label">Alamat</label>
                                                                        <textarea name="alamat" id="alamat" cols="2" rows="2" class="form-control" >{{ old('alamat') }}</textarea>
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
                                        <div id="modalEditPassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form action="{{ url('admin-cabang/database/database-permuridan/kakak-pa') }}" method="POST" id="formEditPassword">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Edit Password Pembimbing PA</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="password" class="control-label">Password Pembimbing PA</label>
                                                                        <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" placeholder="Password Pembimbing PA" value="{{ old('password') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password_confirmation" class="control-label">Konfirmasi Password</label>
                                                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password" value="{{ old('password_confirmation') }}">
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
                                                    <button id="tambahKakak" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#addKakakData">
                                                        Add <i class="mdi mdi-plus-circle-outline"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <table class="table table-striped add-edit-table table-bordered"
                                                id="datatable-kakakpa">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center table-number">No</th>
                                                        <th class="text-center">Nama Pembimbing PA</th>
                                                        <th class="text-center">Gender</th>
                                                        <th class="text-center">Phone</th>
                                                        <th class="text-center table-action">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kakak_pa as $key => $value)
                                                        <tr>
                                                            <td class="text-center">{{ ++$key }}</td>
                                                            <td>{{ $value->nama }}</td>
                                                            <td class="text-center">
                                                                {{ $value->gender === 'l' ? 'Laki-laki' : 'perempuan' }}
                                                            </td>
                                                            <td>{{ $value->phone }}</td>
                                                            </td>
                                                            <td class="actions text-center table-action">
                                                                <div>
                                                                    @if ($value->password == '')
                                                                        <button class="btn btn-success" data-toggle="modal" data-target="#modalEditPassword" onclick="editpass('{{$value->user_id}}')"><i class="fa fa-key"></i> Edit Password</button>
                                                                    @endif
                                                                    <a href="{{ url("admin-cabang/database/database-permuridan/kakak-pa/$value->user_id/anak-pa", []) }}" class="btn btn-primary"><i class="fa fa-list"></i>{{ listText() }}</a>
                                                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editKakakData" onclick="editKakakPA('{{ $value->user_id }}')"><i class="fa fa-pencil"></i>{{ editText() }}</a>
                                                                    <a href="{{ url('admin-cabang/database/database-permuridan/kakak-pa/hapus/' . $value->user_id, []) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash-o"></i>{{ deleteText() }}</a>
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
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->


            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('plugins/tiny-editable/numeric-input-example.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-pickers.init.js') }}"></script>

    <script src="{{ asset('assets/js/admcabang/kakak_pa.js') }}"></script>
    <script src="{{ asset('assets/js/admcabang/anak_pa.js') }}"></script>
    <script src="{{ asset('assets/js/admcabang/bahan.js') }}"></script>

    <script src="{{ asset('assets/pages/jquery.datatables.kakakpacabang.init.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.datatables.anakpacabang.init.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- touchspin --}}
    <script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    {{-- form --}}
    <script src="{{ asset('assets/pages/jquery.form-touchspin.init.js') }}"></script>

    <script>
        function tab_click(tab) {
            window.history.replaceState('asda', tab, `database-permuridan?tab=${tab}`);
        };
    </script>
    <script>
        const addBABData = 'addBABData';
        const formBAB = 'formBAB';

        $('#tambahBAB').on('click', function() {
            titleAction('Form Tambah BAB', base_url( 'admin-cabang/database/database-permuridan/bab'))
        });

        $('#' + addBABData).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            tutupModal(addBABData, 'bab_pa_name')
            tutupModal(addBABData, 'lfk_bahan_pa_id')
            $('.selectpicker').selectpicker('refresh')
        });

        function editBAB(id) {
            console.log(id)
            titleAction('Edit BAB', base_url('admin-cabang/database/database-permuridan/bab/' + id))
            startloading('#' + addBABData + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/admin-cabang/database/database-permuridan/bab/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                console.log(response.data)
                setVal(addBABData, 'bab_pa_name', response.data.bab_pa_name)
                setVal(addBABData, 'lfk_bahan_pa_id', response.data.lfk_bahan_pa_id)

                $('.selectpicker').selectpicker('refresh')
                stoploading('#' + addBABData + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + addBABData + ' .modal-dialog')
            });
        }

        function titleAction(title, action) {
            $('#' + addBABData + ' .modal-title').html(title)
            $('#' + addBABData + ' #' + formBAB).attr('action', action)
        }

        function tutupModal(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>

    <script>
        const modalEditPassword   = 'modalEditPassword'
        const formEditPassword    = 'formEditPassword'

        $(function(){
            EditPasswordValidation(formEditPassword)
        })

        $('#tambahEditPassword').on('click', function(){
            titleAction('Form Tambah EditPassword', base_url(''))
        })

        $('#'+modalEditPassword).on('hidden.bs.modal', function(){
            titleAction('', base_url(''))
        })

        function editpass(id){
            titleAction('Edit Edit Password', base_url('admin-cabang/database/database-permuridan/editpass/'+id))
        }

        function deleteEditPassword(id){
            delConf(base_url(''))
        }

        function detailEditPassword(id){

        }

        function titleAction(title, action){
            $('#'+modalEditPassword+' .modal-title').html(title)
            $('#'+modalEditPassword+' #'+formEditPassword).attr('action', action)
        }

        function EditPasswordValidation(id){
            $('#'+id).validate({
                rules: {
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#modalEditPassword #password",
                        minlength: 8
                    }
                },
                messages: {
                    password: {
                        required: 'Password tidak boleh kosong'
                    },
                    password_confirmation: {
                        required: 'Password confirmation tidak boleh kosong',
                        equalTo: "Password tidak sesuai",
                    }
                },
                highlight: function (input) {
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.form-group').append(error);
                }
            })
        }
    </script>
@endsection
