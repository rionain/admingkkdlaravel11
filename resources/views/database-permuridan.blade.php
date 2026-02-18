@extends('layouts.layout')
@section('css')
    <link href="{{ url('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ url('plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/numberonlynoarrow.css') }}" rel="stylesheet">
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
                            <li class="{{ request('tab') == 'kakak_pa' || !request('tab') ? 'active' : '' }}"
                                onclick="tab_click('kakak_pa')">
                                <a href="#kakakpa" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Pembimbing PA</span>
                                </a>
                            </li>
                            {{-- <li class="{{ request('tab') == 'anak_pa' ? 'active' : '' }}" onclick="tab_click('anak_pa')">
                                <a href="#anakpa" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                                    <span class="hidden-xs">Anak PA</span>
                                </a>
                            </li> --}}
                            <li class="{{ request('tab') == 'bahan' ? 'active' : '' }}" onclick="tab_click('bahan')">
                                <a href="#bahan" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                    <span class="hidden-xs">Bahan</span>
                                </a>
                            </li>
                            <li class="{{ request('tab') == 'bab' ? 'active' : '' }}" onclick="tab_click('bab')">
                                <a href="#bab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                    <span class="hidden-xs">Bab</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane {{ request('tab') == 'kakak_pa' || !request('tab') ? 'active' : '' }}"
                                id="kakakpa">
                                <div class="card-box table-responsive">
                                    <div class="">
                                        {{-- ModalSample --}}
                                        <div id="addKakakData" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form
                                                    action="{{ url('superadmin/database/database-permuridan/kakak-pa') }}"
                                                    method="POST" id="addFormKakakPA">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                            <h4 class="modal-title">Tambah Pembimbing PA</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="nama" class="control-label">Nama
                                                                            Pembimbing PA</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nama" id="nama"
                                                                            placeholder="Nama Pembimbing PA" required
                                                                            value="{{ old('nama') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email" class="control-label">Email
                                                                            Pembimbing PA</label>
                                                                        <input type="email" class="form-control"
                                                                            name="email" id="email"
                                                                            placeholder="Email Pembimbing PA" required
                                                                            value="{{ old('email') }}">
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
                                                                        <label for="gender"
                                                                            class="control-label">Gender</label><br>
                                                                        <input type="radio" name="gender" id="gender"
                                                                            value="l"
                                                                            {{ old('gender') == 'l' ? 'checked' : '' }}>
                                                                        Laki-laki
                                                                        <input type="radio" name="gender"
                                                                            id="gender" value="p"
                                                                            {{ old('gender') == 'p' ? 'checked' : '' }}>
                                                                        Perempuan
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone"
                                                                            class="control-label">Phone</label>
                                                                        <input type="tel" class="form-control"
                                                                            name="phone" id="phone"
                                                                            onkeypress="return hanyaAngka(event)"
                                                                            placeholder="085....."
                                                                            value="{{ old('phone') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat"
                                                                            class="control-label">Alamat</label>
                                                                        <textarea name="alamat" id="alamat" cols="2" rows="2" class="form-control">{{ old('alamat') }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lfk_kategori_gereja_id"
                                                                            class="control-label">Pilih Kategori
                                                                            Gereja</label>
                                                                        <select id="lfk_kategori_gereja_id"
                                                                            class="form-control"
                                                                            name="lfk_kategori_gereja_id">
                                                                            <option value="">Pilih Kategori Gereja
                                                                            </option>
                                                                            @foreach ($kategori_gereja as $item)
                                                                                <option
                                                                                    value="{{ $item->kategori_gereja_id }}"
                                                                                    data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                                    {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                                    {{ $item->kategori_gereja }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lfk_cabang_id"
                                                                            class="control-label">Nama Gereja</label>
                                                                        <select class="form-control" id="lfk_cabang_id"
                                                                            name="lfk_cabang_id">
                                                                            <option value="">Pilih Gereja</option>
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
                                                    action="{{ url('superadmin/database/database-permuridan/kakak-pa') }}"
                                                    method="POST" id="editFormKakakPA">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                            <h4 class="modal-title">Tambah Pembimbing PA</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="nama" class="control-label">Nama
                                                                            Pembimbing PA</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nama" id="nama"
                                                                            placeholder="Nama Pembimbing PA" required
                                                                            value="{{ old('nama') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email" class="control-label">Email
                                                                            Pembimbing PA</label>
                                                                        <input type="text" class="form-control"
                                                                            name="email" id="email"
                                                                            placeholder="Email Pembimbing PA" required
                                                                            value="{{ old('email') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gender"
                                                                            class="control-label">Gender</label><br>
                                                                        <input type="radio" name="gender"
                                                                            id="gender" value="l"
                                                                            {{ old('gender') == 'l' ? 'checked' : '' }}>
                                                                        Laki-laki
                                                                        <input type="radio" name="gender"
                                                                            id="gender" value="p"
                                                                            {{ old('gender') == 'p' ? 'checked' : '' }}>
                                                                        Perempuan

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone"
                                                                            class="control-label">Phone</label>
                                                                        <input type="tel" class="form-control"
                                                                            name="phone" id="phone"
                                                                            placeholder="085....."
                                                                            onkeypress="return hanyaAngka(event)"
                                                                            value="{{ old('phone') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat"
                                                                            class="control-label">Alamat</label>
                                                                        <textarea name="alamat" id="alamat" cols="2" rows="2" class="form-control">{{ old('alamat') }}</textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="lfk_kategori_gereja_id"
                                                                            class="control-label">Pilih
                                                                            Kategori Gereja</label>
                                                                        <select id="lfk_kategori_gereja_id"
                                                                            class="form-control"
                                                                            name="lfk_kategori_gereja_id">
                                                                            <option value="">Pilih Kategori Gereja
                                                                            </option>
                                                                            @foreach ($kategori_gereja as $item)
                                                                                <option
                                                                                    value="{{ $item->kategori_gereja_id }}"
                                                                                    data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                                    {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                                    {{ $item->kategori_gereja }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="lfk_cabang_id"
                                                                            class="control-label">Nama Gereja</label>
                                                                        <select class="form-control" id="lfk_cabang_id"
                                                                            name="lfk_cabang_id">
                                                                            <option value="">Pilih Gereja</option>
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
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {!! modalFooterZircos() !!}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="modalEditPassword" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form
                                                    action="{{ url('superadmin/database/database-permuridan/kakak-pa') }}"
                                                    method="POST" id="formEditPassword">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                            <h4 class="modal-title">Edit Password Pembimbing PA</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="password"
                                                                            class="control-label">Password Pembimbing
                                                                            PA</label>
                                                                        <input type="password" class="form-control"
                                                                            name="password" id="password"
                                                                            autocomplete="new-password"
                                                                            placeholder="Password kakak PA"
                                                                            value="{{ old('password') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password_confirmation"
                                                                            class="control-label">Konfirmasi
                                                                            Password</label>
                                                                        <input type="password" class="form-control"
                                                                            name="password_confirmation"
                                                                            id="password_confirmation"
                                                                            placeholder="Konfirmasi password"
                                                                            value="{{ old('password_confirmation') }}">
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
                                                    <button id="tambahKakak"
                                                        class="btn btn-success waves-effect waves-light"
                                                        data-toggle="modal" data-target="#addKakakData">
                                                        Add <i class="mdi mdi-plus-circle-outline"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="m-b-30">
                                                    <form action="?tab=kakak_pa">
                                                        <div class="row ">
                                                            <div class="col-sm-4">
                                                                <select id="filter_kategori_gereja" class="form-control"
                                                                    name="filter_kategori_gereja">
                                                                    <option value="">Pilih kategori gereja</option>
                                                                    @foreach ($kategori_gereja as $item)
                                                                        <option value="{{ $item->kategori_gereja_id }}"
                                                                            {{ request('filter_kategori_gereja') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                            {{ $item->kategori_gereja }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <input type="hidden" name="tab" value="kakak_pa">
                                                                <select id="filter_cabang" class="form-control"
                                                                    name="filter_cabang">
                                                                    <option value="">Pilih cabang</option>
                                                                    @foreach ($cabang as $item)
                                                                        <option value="{{ $item->cabang_id }}"
                                                                            data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                            {{ request('filter_cabang') == $item->cabang_id ? 'selected' : '' }}>
                                                                            {{ $item->nama_cabang }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3 text-right">
                                                                <button type="submit"
                                                                    class="btn btn-default">Cari</button>
                                                                <a href="?tab=kakak_pa" class="btn btn-default">Reset</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="{{ styletable() }}" id="datatable-kakakpa">
                                            <thead>
                                                <tr>
                                                    <th class="text-center table-number">No</th>
                                                    <th class="text-center">Kategori Gereja</th>
                                                    <th class="text-center">Nama Gereja</th>
                                                    {{-- <th class="text-center">Sub Cabang</th> --}}
                                                    <th class="text-center">Nama Pembimbing PA</th>
                                                    <th class="text-center">Gender</th>
                                                    <th class="text-center">Phone</th>
                                                    <th class="text-center">Alamat</th>
                                                    <th class="text-center table-action">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kakak_pa as $key => $value)
                                                    <tr>
                                                        <td class="text-center">{{ ++$key }}</td>
                                                        <td>{{ @$value->kategori_gereja }}</td>
                                                        <td>{{ @$value->nama_cabang }}</td>
                                                        <td>{{ $value->nama }}</td>
                                                        <td class="">{!! $value->gender == 'l'
                                                            ? 'Laki - laki'
                                                            : ($value->gender == 'p'
                                                                ? 'Perempuan'
                                                                : '<span class="badge badge-danger">Kosong</span>') !!}</td>
                                                        <td>{{ $value->phone }}</td>
                                                        <td>{{ $value->alamat }}</td>
                                                        <td class="actions text-center table-action">
                                                            @if (!$value->password)
                                                                <button class="btn btn-success" data-toggle="modal"
                                                                    data-target="#modalEditPassword"
                                                                    onclick="editpass('{{ $value->user_id }}')"><i
                                                                        class="fa fa-key"></i> Edit Password</button>
                                                            @endif
                                                            <a href="{{ url("superadmin/database/database-permuridan/kakak-pa/$value->user_id/anak-pa", []) }}"
                                                                class="btn btn-primary btn-action"><i
                                                                    class="fa fa-list"></i> List Anak PA</a>
                                                            <a href="#" class="btn btn-warning btn-action"
                                                                data-toggle="modal" data-target="#editKakakData"
                                                                onclick="editKakakPA('{{ $value->user_id }}')"><i
                                                                    class="fa fa-pencil"></i> Edit</a>
                                                            <a href="{{ url('superadmin/database/database-permuridan/kakak-pa/hapus/' . $value->user_id, []) }}"
                                                                class="btn btn-danger btn-action"
                                                                onclick="return confirm('Apakah anda yakin?')"><i
                                                                    class="fa fa-trash-o"></i> Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="row my-0">
                                            <div class="col-md-5">
                                                <table class="table table-borderless table-sm">
                                                    <tr>
                                                        <th>Total Pembimbing PA</th>
                                                        <td>:</td>
                                                        <td>{{ $kakak_pa->count() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total gereja</th>
                                                        <td>:</td>
                                                        <td>{{ $kakak_pa->groupBy('lfk_cabang_id')->count() }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: page -->
                                </div> <!-- end Panel -->
                            </div>
                            {{-- <div class="tab-pane {{ request('tab') == 'anak_pa' ? 'active' : '' }}" id="anakpa">
                                <div class="panel">
                                    <div class="panel-body">

                                        <div id="addAnakData" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form
                                                    action="{{ url('superadmin/database/database-permuridan/anak-pa') }}"
                                                    method="POST" id="formAnakPA">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Tambah Anak PA</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="nama" class="control-label">Nama
                                                                            Anak PA</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nama" id="nama" placeholder="Nama anak PA"
                                                                            required value="{{ old('nama') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gender"
                                                                            class="control-label">Gender</label><br>
                                                                        <input type="radio" name="gender" id="gender"
                                                                            value="l"
                                                                            {{ old('gender') == 'l' ? 'checked' : '' }}>
                                                                        Laki-laki
                                                                        <input type="radio" name="gender" id="gender"
                                                                            value="p"
                                                                            {{ old('gender') == 'p' ? 'checked' : '' }}>
                                                                        Perempuan
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone"
                                                                            class="control-label">Phone</label>
                                                                        <input type="tel" class="form-control"
                                                                            name="phone" id="phone" placeholder="085....."
                                                                            required value="{{ old('phone') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat"
                                                                            class="control-label">Alamat</label>
                                                                        <textarea name="alamat" id="alamat" cols="2"
                                                                            rows="2" class="form-control"
                                                                            required>{{ old('alamat') }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lfk_kategori_gereja_id"
                                                                            class="control-label">Pilih
                                                                            Kategori Gereja</label>
                                                                        <select id="lfk_kategori_gereja_id"
                                                                            class="form-control"
                                                                            name="lfk_kategori_gereja_id">
                                                                            <option value="">Pilih Kategori Gereja</option>
                                                                            @foreach ($kategori_gereja as $item)
                                                                                <option
                                                                                    value="{{ $item->kategori_gereja_id }}"
                                                                                    data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                                    {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                                    {{ $item->kategori_gereja }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lfk_cabang_id"
                                                                            class="control-label">Cabang</label>
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
                                                                    <div class="form-group">
                                                                        <label for="lfk_sub_cabang_id"
                                                                            class="control-label">Pilih
                                                                            Sub Wilayah/Cabang</label>
                                                                        <select class="form-control"
                                                                            id="lfk_sub_cabang_id" name="lfk_sub_cabang_id">
                                                                            <option value="">Pilih sub cabang</option>
                                                                            @foreach ($sub_cabang as $item)
                                                                                <option
                                                                                    value="{{ $item->sub_cabang_id }}"
                                                                                    data-chained="{{ $item->lfk_cabang_id }}"
                                                                                    {{ old('lfk_sub_cabang_id') == $item->sub_cabang_id ? 'selected' : '' }}>
                                                                                    {{ $item->sub_cabang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kelompok_pa"
                                                                            class="control-label">Kelompok PA</label>
                                                                        <select id="kelompok_pa" name="kelompok_pa"
                                                                            class="form-control">
                                                                            <option value="">- Pilih Kelompok PA -</option>
                                                                            @foreach ($kelompok_pa as $item)
                                                                                <option
                                                                                    value="{{ $item->kelompok_pa_id }}"
                                                                                    data-chained="{{ $item->lfk_sub_cabang_id }}"
                                                                                    {{ old('kelompok_pa') == $item->kelompok_pa_id ? 'selected' : '' }}>
                                                                                    {{ $item->nama_kelompok }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lfk_bahan_pa_id"
                                                                            class="control-label">Bahan</label>
                                                                        <select id="lfk_bahan_pa_id" name="lfk_bahan_pa_id"
                                                                            class="form-control">
                                                                            <option value="">- Pilih bahan -</option>
                                                                            @foreach ($bahan_form as $item)
                                                                                <option value="{{ $item->bahan_pa_id }}"
                                                                                    data-chained="{{ $item->lfk_kelompok_pa_id }}"
                                                                                    {{ old('lfk_bahan_pa_id') == $item->bahan_pa_id ? 'selected' : '' }}>
                                                                                    {{ $item->title }}</option>
                                                                            @endforeach
                                                                        </select>
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
                                                    <button id="tambahAnak"
                                                        class="btn btn-success waves-effect waves-light"
                                                        data-toggle="modal" data-target="#addAnakData">Add <i
                                                            class="mdi mdi-plus-circle-outline"></i></button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="">
                                            <table
                                                class=" table
                                            table-striped add-edit-table table-bordered"
                                                id="datatable-anakpa">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nomor</th>
                                                        <th class="text-center">Nama Anak PA</th>
                                                        <th class="text-center">Gender</th>
                                                        <th class="text-center">Phone</th>
                                                        <th class="text-center">Cabang</th>
                                                        <th class="text-center">Sub Cabang</th>
                                                        <th class="text-center">Bahan</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($anak_pa as $key => $value)
                                                        <tr>
                                                            <td class="text-center">{{ ++$key }}</td>
                                                            <td class="text-center">{{ $value->nama }}</td>
                                                            <td class="text-center">{{ $value->gender }}</td>
                                                            <td class="text-center">{{ $value->phone }}</td>
                                                            <td class="text-center">
                                                                {{ @$value->sub_cabang->cabang->nama_cabang }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ @$value->sub_cabang->sub_cabang }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ @$value->anak_pa_detail->bahan->title }}</td>
                                                            <td class="actions text-center"
                                                                style="width: 100px; overflow: hidden; max-width: 120px;">
                                                                <div
                                                                    class="btn-group btn-group-justified m-b-10 text-center">
                                                                    <a href="#" class="btn btn-primary" data-toggle="modal"
                                                                        data-target="#addAnakData"
                                                                        onclick="editAnakPA(`{{ $value->user_id }}`)"><i
                                                                            class="fa fa-pencil"></i></a>
                                                                    <a href="{{ url('superadmin/database/database-permuridan/anak-pa/hapus/' . $value->user_id, []) }}"
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
                            </div> --}}
                            <div class="tab-pane {{ request('tab') == 'bahan' ? 'active' : '' }}" id="bahan">
                                <div class="card-box table-responsive">
                                    <div class="">
                                        <div id="addBahanData" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ url('superadmin/database/database-permuridan/bahan') }}"
                                                        method="POST" enctype="multipart/form-data" id="formBahan">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                            <h4 class="modal-title">Tambah Bahan</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="judul"
                                                                            class="control-label">Judul</label>
                                                                        <input type="text" class="form-control"
                                                                            id="judul" name="judul"
                                                                            placeholder="Judul"
                                                                            value="{{ old('judul') }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="tahun_terbit"
                                                                            class="control-label">Tahun Terbit</label>
                                                                        <input type="number" class="form-control"
                                                                            id="tahun_terbit" name="tahun_terbit"
                                                                            placeholder="{{ date('Y') }}"
                                                                            value="{{ old('tahun_terbit') }}"
                                                                            max="{{ date('Y') }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="file_bahan_pa" class="control-label">File
                                                                    bahan pa</label>
                                                                <p class="text-danger">* Kosongkan bila tidak
                                                                    ingin mengisi file</p>
                                                                <input type="file" class="form-control"
                                                                    id="file_bahan_pa" name="file_bahan_pa"
                                                                    placeholder="{{ date('Y') }}"
                                                                    value="{{ old('file_bahan_pa') }}">
                                                            </div>
                                                            <div class="form-group no-margin">
                                                                <label for="deskripsi"
                                                                    class="control-label">Deskripsi</label>
                                                                <textarea class="form-control autogrow" id="deskripsi" name="deskripsi" placeholder="Deskripsi"
                                                                    style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ old('deskripsi') }}</textarea>
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
                                                    <button id="tambahBahan"
                                                        class="btn btn-success waves-effect waves-light"
                                                        data-toggle="modal" data-target="#addBahanData">Add <i
                                                            class="mdi mdi-plus-circle-outline"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="{{ styletable() }}" id="datatable-bahan">
                                            <thead>
                                                <tr>
                                                    <th class="text-center table-number">No</th>
                                                    <th class="text-center">File Bahan PA</th>
                                                    <th class="text-center">Judul</th>
                                                    <th class="text-center">Tahun Terbit</th>
                                                    <th class="text-center">Deskripsi</th>
                                                    <th class="text-center table-action">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bahan as $key => $value)
                                                    <tr>
                                                        <td class="text-center">{{ ++$key }}</td>
                                                        <td class="text-center">
                                                            @if ($value->file_bahan_pa)
                                                                <a href="{{ S3Helper::get($value->file_bahan_pa) }}"
                                                                    class="btn btn-defaulr" target="_blank">Lihat</a>
                                                            @else
                                                                <span class="badge badge-danger">Kosong</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{ $value->judul }}</td>
                                                        <td class="text-center">{{ $value->tahun_terbit }}</td>
                                                        <td class="text-center">{{ $value->deskripsi }}</td>
                                                        </td>
                                                        <td class="actions text-center table-action">
                                                            <a href="#" class="btn btn-warning btn-action"
                                                                data-toggle="modal" data-target="#addBahanData"
                                                                onclick="editBahanPA('{{ $value->bahan_pa_id }}')">
                                                                <i class="fa fa-pencil"></i> {{ editText() }}
                                                            </a>
                                                            <a href="{{ url('superadmin/database/database-permuridan/bahan/hapus/' . $value->bahan_pa_id, []) }}"
                                                                class="btn btn-danger btn-action"
                                                                onclick="return confirm('Apakah anda yakin?')">
                                                                <i class="fa fa-trash"></i> {{ deleteText() }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- end: page -->

                                    </div> <!-- end Panel -->
                                </div>

                            </div>
                            <div class="tab-pane {{ request('tab') == 'bab' ? 'active' : '' }}" id="bab">
                                <div class="card-box table-responsive">
                                    <div class="">
                                        {{-- ModalSample --}}
                                        <div id="addBABData" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ url('http://localhost:8000/superadmin/database/database-permuridan/bab') }}"
                                                        method="post" id="formBAB">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                            <h4 class="modal-title">Tambah Bab</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="bab_pa_name" class="control-label">Nama BAB
                                                                    PA</label>
                                                                <input type="text" class="form-control"
                                                                    id="bab_pa_name" name="bab_pa_name"
                                                                    placeholder="Nama bab"
                                                                    value="{{ old('bab_pa_name') }}">
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
                                                    <button id="tambahBAB"
                                                        class="btn btn-success waves-effect waves-light"
                                                        data-toggle="modal" data-target="#addBABData">Add <i
                                                            class="mdi mdi-plus-circle-outline"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Modal Template --}}

                                        <table class="{{ styletable() }}" id="datatable-bab">
                                            <thead>
                                                <tr>
                                                    <th class="text-center table-number">No</th>
                                                    <th class="text-center">Bab</th>
                                                    <th class="text-center table-action">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bab as $key => $value)
                                                    <tr>
                                                        <td class="text-center">{{ ++$key }}</td>
                                                        <td>{{ $value->bab_pa_name }}</td>
                                                        <td class="actions text-center table-action">
                                                            <a href="#" class="btn btn-warning btn-action"
                                                                data-toggle="modal" data-target="#addBABData"
                                                                onclick="editBAB('{{ $value->bab_pa_id }}')"><i
                                                                    class="fa fa-pencil"></i> {{ editText() }}</a>
                                                            <a href="{{ url('superadmin/database/database-permuridan/bab/hapus/' . $value->bab_pa_id, []) }}"
                                                                class="btn btn-danger btn-action"
                                                                onclick="return confirm('Apakah anda yakin?')"><i
                                                                    class="fa fa-trash-o"></i> {{ deleteText() }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

    <script src="{{ asset('assets/js/kakak_pa.js') }}"></script>
    <script src="{{ asset('assets/js/anak_pa.js') }}"></script>
    <script src="{{ asset('assets/js/bahan.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- touchspin --}}
    <script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    {{-- form --}}
    <script src="{{ asset('assets/pages/jquery.form-touchspin.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable-kakakpa').DataTable();
            $('#datatable-anakpa').DataTable();
            $('#datatable-bab').DataTable();
            $('#datatable-bahan').DataTable();

            setSelect2('filter_cabang');
            setSelect2('filter_kategori_gereja');
            $('#filter_cabang').chained('#filter_kategori_gereja');
        });
    </script>

    <script>
        const addBABData = 'addBABData';
        const formBAB = 'formBAB';

        $('#tambahBAB').on('click', function() {
            titleAction('Form Tambah BAB', base_url(
                'superadmin/database/database-permuridan/bab'))
        });

        $('#' + addBABData).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            tutupModal(addBABData, 'bab_pa_name')
            $('.selectpicker').selectpicker('refresh')
        });

        function editBAB(id) {
            console.log(id)
            titleAction('Edit BAB', base_url('superadmin/database/database-permuridan/bab/' + id))
            startloading('#' + addBABData + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/superadmin/database/database-permuridan/bab/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                console.log(response.data)
                setVal(addBABData, 'bab_pa_name', response.data.bab_pa_name)

                $('.selectpicker').selectpicker('refresh')
                stoploading('#' + addBABData + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                // console.log('data: '+data)
                // console.log('status: '+status)
                // console.log('error: '+error)
                // if(status == 'timeout'){
                //     CekKonfirmasi('Timeout!', '')
                // } else if(data.responseJSON.status == false){
                //     CekKonfirmasi(data.responseJSON.message, '')
                // }
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
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
    <script>
        function tab_click(tab) {
            window.history.replaceState('asda', tab, `database-permuridan?tab=${tab}`);
        };
    </script>

    <script>
        const modalEditPassword = 'modalEditPassword'
        const formEditPassword = 'formEditPassword'

        $(function() {
            EditPasswordValidation(formEditPassword)
        })

        $('#tambahEditPassword').on('click', function() {
            titleAction('Form Tambah EditPassword', base_url(''))
        })

        $('#' + modalEditPassword).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
        })

        function editpass(id) {
            titleAction('Edit Edit Password', base_url('superadmin/database/database-permuridan/editpass/' + id))
        }

        function deleteEditPassword(id) {
            delConf(base_url(''))
        }

        function detailEditPassword(id) {

        }

        function titleAction(title, action) {
            $('#' + modalEditPassword + ' .modal-title').html(title)
            $('#' + modalEditPassword + ' #' + formEditPassword).attr('action', action)
        }

        function EditPasswordValidation(id) {
            $('#' + id).validate({
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
                highlight: function(input) {
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function(input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function(error, element) {
                    $(element).parents('.form-group').append(error);
                }
            })
        }
    </script>
@endsection
