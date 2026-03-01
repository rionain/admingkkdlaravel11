@extends('layouts.layout')

@section('css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Setting User Admin</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box table-responsive">

                            {{-- @foreach (@$errors->all() as $error)
                                <span>{{ $error }}</span><br>
                            @endforeach --}}

                            <div id="modalSettingUsers" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah User</h4>
                                        </div>
                                        <form action="{{ url('/superadmin/admin') }}" method="POST"
                                            enctype="multipart/form-data" id="formSettingUsers">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group no-margin">
                                                    <label for="nama" class="control-label">Nama</label>
                                                    <input type="text" class="form-control autogrow" id="nama"
                                                        name="nama" placeholder="Nama" value="{{ old('nama') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="role_user" class="control-label">Role User</label>
                                                    <select class="form-control autogrow" id="role_user" name="role_user">
                                                        <option value="">Pilih Role User</option>
                                                        @foreach ($roles as $item)
                                                            <option value="{{ $item->role_id }}"
                                                                {{ old('role_user') == $item->role_id ? 'selected' : '' }}>
                                                                {{ $item->nama_role }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin" style="display: none" id="form-cabang">
                                                    <div class="form-group">
                                                        <label for="lfk_kategori_gereja_id" class="control-label">Pilih
                                                            Kategori Gereja</label>
                                                        <select id="lfk_kategori_gereja_id" class="form-control"
                                                            name="lfk_kategori_gereja_id">
                                                            <option value="">Pilih Kategori Gereja</option>
                                                            @foreach ($kategori_gereja as $item)
                                                                <option value="{{ $item->kategori_gereja_id }}"
                                                                    {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                    {{ $item->kategori_gereja }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lfk_cabang_id" class="control-label">Cabang</label>
                                                        <select class="form-control" id="lfk_cabang_id"
                                                            name="lfk_cabang_id">
                                                            <option value="">Pilih cabang</option>
                                                            @foreach ($cabang as $item)
                                                                <option value="{{ $item->cabang_id }}"
                                                                    data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                    {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                    {{ $item->nama_cabang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input type="email" class="form-control autogrow" id="email"
                                                        name="email" placeholder="Email" value="{{ old('email') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="gender" class="control-label">Gender</label>
                                                    <select class="form-control autogrow" id="gender" name="gender">
                                                        <option value="">Pilih Gender</option>
                                                        <option value="l"
                                                            {{ old('gender') == 'l' ? 'selected' : '' }}>
                                                            Laki - laki
                                                        </option>
                                                        <option value="p"
                                                            {{ old('gender') == 'p' ? 'selected' : '' }}>
                                                            Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="phone" class="control-label">No Telp</label>
                                                    <input type="tel" class="form-control autogrow" id="phone"
                                                        name="phone" placeholder="No Telp" value="{{ old('phone') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="alamat" class="control-label">Alamat</label>
                                                    <textarea name="alamat" id="alamat" cols="5" rows="5" class="form-control">{{ old('alamat') }}</textarea>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="foto" class="control-label">Foto</label>
                                                    <input type="file" accept="image/*" name="foto" id="foto"
                                                        class="form-control">
                                                    <span class="text-error">*Kosongkan bila tidak ingin mengubah
                                                        foto</span>
                                                </div>
                                                <div id="password-group">
                                                    <div class="form-group no-margin">
                                                        <label for="password" class="control-label">Password</label>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control" placeholder="****"
                                                            value="{{ old('password') }}">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="password_confirmation"
                                                            class="control-label">Konfirmasi
                                                            Password</label>
                                                        <input type="password" name="password_confirmation"
                                                            id="password_confirmation" class="form-control"
                                                            placeholder="****"
                                                            value="{{ old('password_confirmation') }}">
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
                                <div class="col-sm-10">
                                    <div class="m-b-30">
                                        <button id="tambahSettingUser" class="btn btn-success waves-effect waves-light"
                                            data-toggle="modal" data-target="#modalSettingUsers">Add <i
                                                class="mdi mdi-plus-circle-outline"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <select name="filter_role" id="filter_role" class="form-control">
                                                    <option value="">Filter Role</option>
                                                    @foreach ($roles as $item)
                                                        <option value="{{ $item->role_id }}">
                                                            {{ $item->nama_role }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <table class="{{ styletable() }}" id="datatable-user">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Profile</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">No Telp</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center table-action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $value)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>
                                                @if ($value->profile_pic)
                                                    <img src="{{ S3Helper::get($value->profile_pic) }}"
                                                        alt="foto{{ $key }}" width="100px">
                                            </td>
                                        @else
                                            <span class="badge badge-danger">Tidak ada gambar</span>
                                    @endif
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->gender == 'l' ? 'Laki - laki' : ($value->gender == 'p' ? 'Perempuan' : '') }}
                                    </td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->alamat }}</td>
                                    <td class="text-center">
                                        <span class="badge">{{ @$value->role_user->nama_role }}</span>
                                    </td>
                                    <td class="actions text-center">
                                        <a href="#" class="btn btn-warning btn-action"
                                            onclick="editSettingUser('{{ $value->user_id }}')" data-toggle="modal"
                                            data-target="#modalSettingUsers"><i class="fa fa-pencil"></i>
                                            {{ edittext() }}
                                        </a>
                                        <a href="{{ url('superadmin/admin/hapus/' . $value->user_id) }}"
                                            class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i
                                                class="fa fa-trash-o"></i> {{ deleteText() }}
                                        </a>
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
    <script src="{{ url('assets/pages/jquery.datatables.user.init.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
    <script>
        const modalSettingUsers = 'modalSettingUsers'
        const formSettingUsers = 'formSettingUsers'

        @if (request('filter_role') != '')
            setValSelect2('', 'filter_role', '{{ request('filter_role') }}');
        @endif

        setSelect2(`filter_role`);
        setSelect2(`${modalSettingUsers} #lfk_kategori_gereja_id`);
        setSelect2(`${modalSettingUsers} #lfk_cabang_id`);

        $(`#${modalSettingUsers} #lfk_cabang_id`).chained(`#${modalSettingUsers} #lfk_kategori_gereja_id`);

        $(`#role_user`).change((e) => {
            let role_user = $('#role_user').val();
            if (role_user == 1) {
                $('#form-cabang').css('display', 'none');
            } else {
                $('#form-cabang').css('display', 'block');
            }
        });

        $('#tambahSettingUser').on('click', function() {
            titleActionSettingUser('Form Tambah Setting User', base_url(
                'superadmin/admin'))
            $('#password-group').show()
        })

        $('#' + modalSettingUsers).on('hidden.bs.modal', function() {
            titleActionSettingUser('Form Tambah Setting User', base_url(
                'superadmin/setting/admin'))
            tutupModalSettingUser(modalSettingUsers, 'nama')
            tutupModalSettingUser(modalSettingUsers, 'email')
            tutupModalSettingUser(modalSettingUsers, 'gender')
            tutupModalSettingUser(modalSettingUsers, 'phone')
            tutupModalSettingUser(modalSettingUsers, 'alamat')
            tutupModalSettingUser(modalSettingUsers, 'role_user')
            tutupModalSettingUser(modalSettingUsers, 'foto')
            tutupModalSettingUser(modalSettingUsers, 'password')
            tutupModalSettingUser(modalSettingUsers, 'password_confirmation')
        })

        function editSettingUser(id) {
            $('#password-group').hide()
            titleActionSettingUser('Edit Setting User', base_url('superadmin/admin/' +
                id))
            startloading('#' + modalSettingUsers + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/superadmin/admin/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                setVal(modalSettingUsers, 'nama', response.data.nama)
                setVal(modalSettingUsers, 'email', response.data.email)
                setVal(modalSettingUsers, 'gender', response.data.gender)
                setVal(modalSettingUsers, 'phone', response.data.phone)
                setVal(modalSettingUsers, 'alamat', response.data.alamat)
                setVal(modalSettingUsers, 'role_user', response.data.lfk_role_id)
                if (response.data.lfk_role_id == 1) {
                    $('#form-cabang').css('display', 'none');
                } else {
                    $('#form-cabang').css('display', 'block');
                    setValSelect2(modalSettingUsers, 'lfk_kategori_gereja_id', response.data.cabang
                        .lfk_kategori_gereja_id)
                    setValSelect2(modalSettingUsers, 'lfk_cabang_id', response.data.lfk_cabang_id)
                }
                stoploading('#' + modalSettingUsers + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalSettingUsers + ' .modal-dialog')
            });
        }

        function titleActionSettingUser(title, action) {
            $('#' + modalSettingUsers + ' .modal-title').html(title)
            $('#' + modalSettingUsers + ' #' + formSettingUsers).attr('action', action)
        }

        function tutupModalSettingUser(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>
@endsection
