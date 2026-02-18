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
                            <h4 class="page-title">Database Cabang</h4>
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
                            <li class="{{ request('tab') == 'cabang' || !request('tab') ? 'active' : '' }}"
                                onclick="tab_click('cabang')" id="tab-cabang">
                                <a href="#cabang" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Cabang</span>
                                </a>
                            </li>
                            <li class="{{ request('tab') == 'ibadah' ? 'active' : '' }}" onclick="tab_click('ibadah')">
                                <a href=" #ibadah" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                                    <span class="hidden-xs">Ibadah</span>
                                </a>
                            </li>
                            <li class="{{ request('tab') == 'komsel' ? 'active' : '' }}" onclick="tab_click('komsel')">
                                <a href=" #komsel" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                    <span class="hidden-xs">Komsel</span>
                                </a>
                            </li>
                            <li class="{{ request('tab') == 'kelompokpa' ? 'active' : '' }}"
                                onclick="tab_click('kelompokpa')">
                                <a href=" #kelompokpa" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                    <span class="hidden-xs">Kelompok PA</span>
                                </a>
                            </li>
                            <li class="{{ request('tab') == 'event' ? 'active' : '' }}" onclick="tab_click('event')">
                                <a href=" #event" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                    <span class="hidden-xs">Event</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane {{ request('tab') == 'cabang' || !request('tab') ? 'active' : '' }}"
                                id="cabang">
                                <div class="card-box table-responsive">
                                    <div id="addCabangData" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <form id="formCabang"
                                                action="{{ url('superadmin/database/database-cabang/cabang') }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                        <h4 class="modal-title">Tambah Cabang</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama_cabang" class="control-label">Nama
                                                                Cabang</label>
                                                            <input type="text" class="form-control" name="nama_cabang"
                                                                id="nama_cabang" placeholder="Nama cabang">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="info_detail" class="control-label">Info
                                                                Detail</label>
                                                            <textarea type="text" class="form-control" name="info_detail" id="info_detail"
                                                                placeholder="Masukkan info tambahan"></textarea>
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
                                                <button id="tambahCabang" class="btn btn-success waves-effect waves-light"
                                                    data-toggle="modal" data-target="#addCabangData">
                                                    {{ addText() }} <i class="mdi mdi-plus-circle-outline"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="{{ styletable() }}" id="datatable-cabang">
                                        <thead>
                                            <tr>
                                                <th class="text-center table-number">No</th>
                                                <th class="text-center">Kategori Gereja</th>
                                                <th class="text-center">Nama Cabang</th>
                                                <th class="text-center">Info Detail</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cabang as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="">
                                                        {{ @$value->kategori_gereja->kategori_gereja }}</td>
                                                    <td class="">{{ $value->nama_cabang }}</td>
                                                    <td class="">{{ $value->info_detail }}</td>
                                                    <td class="actions text-center">
                                                        <a href="{{ url("superadmin/database/database-cabang/cabang/$value->cabang_id/sub_cabang") }}"
                                                            class="btn btn-success btn-action" title="List Sub Cabang">
                                                            <i class="fa fa-list"></i> Sub Cabang
                                                        </a>
                                                        <a href="#" class="btn btn-warning btn-action"
                                                            data-toggle="modal" data-target="#addCabangData"
                                                            onclick="editCabang('{{ $value->cabang_id }}')"
                                                            title="Edit Body Surat">
                                                            <i class="fa fa-pencil"></i> {{ editText() }}
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-action"
                                                            onclick="delConf('{{ url('superadmin/database/database-cabang/cabang/hapus/' . $value->cabang_id) }}')">
                                                            <i class="fa fa-trash-o"></i> {{ deleteText() }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane {{ request('tab') == 'ibadah' ? 'active' : '' }}" id="ibadah">
                                <div class="card-box table-responsive">
                                    <div id="addIbadahData" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form id="formIbadah"
                                                    action="{{ url('superadmin/database/database-cabang/ibadah', []) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                        <h4 class="modal-title">Tambah Ibadah</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    {{-- <label for="nama_ibadah" class="control-label">Nama Ibadah</label>
                                                                    <input type="text" class="form-control" id="nama_ibadah" placeholder="Nama Ibadah.." name="nama_ibadah" value="{{ old('nama_ibadah') }}"> --}}
                                                                    <label for='nama_ibadah'>Ibadah</label>
                                                                    <select id='nama_ibadah' name='nama_ibadah'
                                                                        class='form-control show-tick'>
                                                                        <option value=''>Pilih Ibadah</option>
                                                                        <option value='Ibadah Umum'>Ibadah Umum</option>
                                                                        <option value='Ibadah Youth/Pemuda'>Ibadah
                                                                            Youth/Pemuda</option>
                                                                        <option value='Ibadah Keluarga'>Ibadah Keluarga
                                                                        </option>
                                                                        <option value='Ibadah Karyawan'>Ibadah Karyawan
                                                                        </option>
                                                                        <option value='Ibadah Lansia'>Ibadah Lansia
                                                                        </option>
                                                                        <option value='Ibadah Anak/Sekolah Minggu'>Ibadah
                                                                            Anak/Sekolah Minggu</option>
                                                                        <option value='Ibadah Lain-lain'>Ibadah Lain-lain
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Jam Mulai</label>
                                                                    <input id="ibadah_time_start" type="text"
                                                                        class="form-control" name="ibadah_time_start"
                                                                        placeholder="00:00" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Jam Selesai</label>
                                                                    <input id="ibadah_time_end" type="text"
                                                                        class="form-control" name="ibadah_time_end"
                                                                        placeholder="00:00" required readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_kategori_gereja_id"
                                                                class="control-label">Pilih Kategori Gereja</label>
                                                            <select id="lfk_kategori_gereja_id" class="form-control"
                                                                name="lfk_kategori_gereja_id">
                                                                <option value="">Pilih Kategori Gereja</option>
                                                                @foreach ($kategori_gereja as $item)
                                                                    <option value="{{ $item->kategori_gereja_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_gereja }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_cabang_id" class="control-label">Nama
                                                                Gereja</label>
                                                            <select class="form-control" id="lfk_cabang_id"
                                                                name="lfk_cabang_id">
                                                                <option value="">Pilih Gereja</option>
                                                                @foreach ($all_cabang as $item)
                                                                    <option value="{{ $item->cabang_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama_cabang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">Kapasitas Ibadah</label>
                                                            <input id="kapasitasIbadah" type="number" value="0"
                                                                name="kapasitasIbadah" data-bts-min="0"
                                                                data-bts-init-val="" data-bts-step="1"
                                                                data-bts-decimal="0"
                                                                data-bts-force-step-divisibility="round"
                                                                data-bts-step-interval-delay="500" data-bts-prefix=""
                                                                data-bts-postfix="" data-bts-prefix-extra-class=""
                                                                data-bts-postfix-extra-class="" data-bts-booster="true"
                                                                data-bts-boostat="10" data-bts-max-boosted-step="false"
                                                                data-bts-mousewheel="true"
                                                                data-bts-button-down-class="btn btn-default"
                                                                data-bts-button-up-class="btn btn-default" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ibadah_day" class="control-label">Hari</label>
                                                            <select id="ibadah_day" class="selectpicker"
                                                                data-live-search="true" data-style="btn-custom"
                                                                name="ibadah_day">
                                                                <option value="">Pilih hari</option>
                                                                <option value="senin">Senin</option>
                                                                <option value="selasa">Selasa</option>
                                                                <option value="rabu">Rabu</option>
                                                                <option value="kamis">Kamis</option>
                                                                <option value="jumat">Jumat</option>
                                                                <option value="sabtu">Sabtu</option>
                                                                <option value="minggu">Minggu</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="notes">Catatan</label>
                                                            <textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="activeIbadah" class="control-label">Aktif</label>
                                                            <br>
                                                            <label class="c-switch">
                                                                <input id="activeIbadah" checked type="checkbox"
                                                                    name="activeIbadah" />
                                                                <span class="c-slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! modalFooterZircos() !!}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="modalDetailIbadah" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                    <h4 class="modal-title">Detail Ibadah</h4>
                                                </div>
                                                <div class="modal-body text-sm mx-2">
                                                    <table class="table table-sm table-borderless table-hover">
                                                        <tr>
                                                            <th>Kategori Gereja</th>
                                                            <td>:</td>
                                                            <td id="kategori_gereja">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama Gereja</th>
                                                            <td>:</td>
                                                            <td id="nama_gereja">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama Ibadah</th>
                                                            <td>:</td>
                                                            <td id="nama_ibadah">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Hari</th>
                                                            <td>:</td>
                                                            <td id="hari">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jam Mulai</th>
                                                            <td>:</td>
                                                            <td id="jam_mulai">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jam Selesai</th>
                                                            <td>:</td>
                                                            <td id="jam_selesai">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kapasitas</th>
                                                            <td>:</td>
                                                            <td id="kapasitas">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Notes</th>
                                                            <td>:</td>
                                                            <td id="notes">{!! kosong() !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td>:</td>
                                                            <td id="status_ibadah">{!! kosong() !!}</td>
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    {!! modalFooterDetail() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="m-b-30">
                                                <button id="tambahIbadah" class="btn btn-success waves-effect waves-light"
                                                    data-toggle="modal" data-target="#addIbadahData">
                                                    Add <i class="mdi mdi-plus-circle-outline"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="m-b-30">
                                                <form action="?tab=ibadah" id="form-filter-ibadah">
                                                    <div class="row ">
                                                        <div class="col-sm-5">
                                                            <input type="hidden" name="tab" value="ibadah">
                                                            <select id="filter_kategori_gereja" class="form-control"
                                                                name="filter_kategori_gereja">
                                                                <option value="">Pilih Kategori Gereja</option>
                                                                @foreach ($kategori_gereja as $item)
                                                                    <option value="{{ $item->kategori_gereja_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_gereja }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-control" id="filter_cabang"
                                                                name="filter_cabang">
                                                                <option value="">Pilih Gereja</option>
                                                                @foreach ($all_cabang as $item)
                                                                    <option value="{{ $item->cabang_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama_cabang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <button type="submit" class="btn btn-default">Cari</button>
                                                            <a href="?tab=ibadah" class="btn btn-default">Reset</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="{{ styletable() }}" id="datatable-ibadah">
                                        <thead>
                                            <tr>
                                                <th class="text-center table-number">No</th>
                                                <th class="text-center">kategori gereja</th>
                                                <th class="text-center">nama gereja</th>
                                                <th class="text-center">nama Ibadah</th>
                                                <th class="text-center">Hari</th>
                                                <th class="text-center">jam Mulai</th>
                                                <th class="text-center">jam Selesai</th>
                                                <th class="text-center">kapasitas</th>
                                                <th class="text-center">Notes</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center table-action">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ibadah as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="">{{ @$value->kategori_gereja }}</td>
                                                    <td class="">{{ @$value->nama_cabang }}</td>
                                                    <td class="">{{ $value->nama_ibadah }}</td>
                                                    <td class="text-center">{{ $value->ibadah_day }}</td>
                                                    <td class="text-center">
                                                        {{ format_date($value->ibadah_time_start, 'H:i') }}</td>
                                                    <td class="text-center">
                                                        {{ format_date($value->ibadah_time_end, 'H:i') }}</td>
                                                    <td class="text-center">{{ $value->kapasitas_ibadah }}</td>
                                                    <td>{{ $value->notes }}</td>
                                                    <td class="text-center">
                                                        @if ($value->ibadah_status == 1)
                                                            <span
                                                                class="badge badge-success">{{ $value->ibadah_status == 1 ? 'Aktif' : 'Tidak aktif' }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-danger">{{ $value->ibadah_status == 1 ? 'Aktif' : 'Tidak aktif' }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="actions text-center table-action">
                                                        <a href="#" class="btn btn-primary mb-1 btn-action"
                                                            data-toggle="modal" data-target="#modalDetailIbadah"
                                                            onclick="detailIbadah('{{ $value->ibadah_id }}')">
                                                            <i class="fa fa-info-circle"></i> {{ detailText() }}
                                                        </a>
                                                        <a href="#" class="btn btn-warning mb-1 btn-action"
                                                            data-toggle="modal" data-target="#addIbadahData"
                                                            onclick="editIbadah('{{ $value->ibadah_id }}')">
                                                            <i class="fa fa-pencil"></i> {{ editText() }}
                                                        </a>
                                                        <a href="#" class="btn btn-danger mb-1 btn-action"
                                                            onclick="delConf('{{ url('superadmin/database/database-cabang/ibadah/hapus/' . $value->ibadah_id) }}')">
                                                            <i class="fa fa-trash-o"></i> {{ deleteText() }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row my-0">
                                        <div class="col-md-5">
                                            <table class="table table-borderless table-sm">
                                                <tr>
                                                    <th>Total Ibadah</th>
                                                    <td>:</td>
                                                    <td>{{ $ibadah->count() }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <th>Total Gereja</th>
                                                    <td>:</td>
                                                    <td>0</td>
                                                </tr> --}}
                                                <tr>
                                                    <th>Total Cabang</th>
                                                    <td>:</td>
                                                    <td>{{ $ibadah->groupBy('lfk_cabang_id')->count() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Sub Cabang</th>
                                                    <td>:</td>
                                                    <td>{{ $ibadah->groupBy('lfk_sub_cabang_id')->count() }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ request('tab') == 'komsel' ? 'active' : '' }}" id="komsel">
                                <div class="card-box table-responsive">
                                    <div id="addKomselData" class="modal fade" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Komsel</h4>
                                                </div>
                                                <form id="formKomsel"
                                                    action="{{ url('superadmin/database/database-cabang/komsel', []) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="nama_komsel" class="control-label">Nama
                                                                        komsel</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_komsel" name="nama_komsel"
                                                                        placeholder="Nama komsel">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="lfk_kategori_gereja_id"
                                                                        class="control-label">Pilih Kategori Gereja</label>
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
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="lfk_cabang_id" class="control-label">Nama
                                                                        Gereja</label>
                                                                    <select class="form-control" id="lfk_cabang_id"
                                                                        name="lfk_cabang_id">
                                                                        <option value="">Pilih Gereja</option>
                                                                        @foreach ($all_cabang as $item)
                                                                            <option value="{{ $item->cabang_id }}"
                                                                                data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                                {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                                {{ $item->nama_cabang }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="lfk_kategori_komsel_id"
                                                                        class="control-label">Kategori Komsel</label>
                                                                    <select id="lfk_kategori_komsel_id"
                                                                        class="form-control"
                                                                        name="lfk_kategori_komsel_id">
                                                                        <option value="">Pilih Kategori Komsel
                                                                        </option>
                                                                        @foreach ($kategori_komsel as $item)
                                                                            <option
                                                                                value="{{ $item->kategori_komsel_id }}">
                                                                                {{ $item->nama_kategori_komsel }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="jumlah_pria" class="control-label">Jumlah
                                                                        Pria</label>
                                                                    <input type="number" class="form-control"
                                                                        id="jumlah_pria" name="jumlah_pria"
                                                                        placeholder="0" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="jumlah_wanita"
                                                                        class="control-label">Jumlah Wanita</label>
                                                                    <input type="number" class="form-control"
                                                                        id="jumlah_wanita" name="jumlah_wanita"
                                                                        placeholder="0" required>
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
                                                <button id="tambahKomsel" class="btn btn-success waves-effect waves-light"
                                                    data-toggle="modal" data-target="#addKomselData">
                                                    Add <i class="mdi mdi-plus-circle-outline"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="m-b-30">
                                                <form action="?tab=komsel" id="form-filter-komsel">
                                                    <div class="row ">
                                                        <div class="col-sm-5">
                                                            <input type="hidden" name="tab" value="komsel">
                                                            <select id="filter_kategori_gereja" class="form-control"
                                                                name="filter_kategori_gereja">
                                                                <option value="">Pilih Kategori Gereja</option>
                                                                @foreach ($kategori_gereja as $item)
                                                                    <option value="{{ $item->kategori_gereja_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_gereja }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-control" id="filter_cabang"
                                                                name="filter_cabang">
                                                                <option value="">Pilih Gereja</option>
                                                                @foreach ($all_cabang as $item)
                                                                    <option value="{{ $item->cabang_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama_cabang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <button type="submit" class="btn btn-default">Cari</button>
                                                            <a href="?tab=komsel" class="btn btn-default">Reset</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-striped add-edit-table table-bordered"
                                        id="datatable-komsel">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Kategori Gereja</th>
                                                <th class="text-center">Nama Gereja</th>
                                                <th class="text-center">Kategori Komsel</th>
                                                <th class="text-center">Nama Komsel</th>
                                                <th class="text-center">Jumlah Pria</th>
                                                <th class="text-center">Jumlah Wanita</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center table-action">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_jumlah_pria_komsel = 0;
                                                $total_jumlah_wanita_komsel = 0;
                                                $total_jumlah_anggota_komsel = 0;
                                            @endphp
                                            @foreach ($komsel as $key => $value)
                                                @php
                                                    $total_jumlah_pria_komsel += $value->jumlah_pria;
                                                    $total_jumlah_wanita_komsel += $value->jumlah_wanita;
                                                    $total_jumlah_anggota_komsel += $value->jumlah_pria + $value->jumlah_wanita;
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td> {{ @$value->kategori_gereja }} </td>
                                                    <td> {{ @$value->nama_cabang }} </td>
                                                    <td class="">
                                                        {{ @$value->kategori_komsel->nama_kategori_komsel }}</td>
                                                    <td>{{ $value->nama_komsel }}</td>
                                                    <td class="text-center">{{ $value->jumlah_pria ?: 0 }}</td>
                                                    <td class="text-center">{{ $value->jumlah_wanita ?: 0 }}</td>
                                                    <td class="text-center">
                                                        {{ $value->jumlah_wanita + $value->jumlah_pria }}</td>
                                                    <td class="actions text-center table-action">
                                                        <a href="#" class="btn btn-warning btn-action"
                                                            data-toggle="modal" data-target="#addKomselData"
                                                            onclick="editKomsel('{{ $value->komsel_id }}')">
                                                            <i class="fa fa-pencil"></i> {{ editText() }}
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-action"
                                                            onclick="delConf('{{ url('superadmin/database/database-cabang/komsel/hapus/' . $value->komsel_id) }}')">
                                                            <i class="fa fa-trash-o"></i> {{ deleteText() }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <th>Total komsel</th>
                                                    <td>:</td>
                                                    <td>{{ $komsel->count() }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="">total pria</th>
                                                    <td>:</td>
                                                    <td>{{ $total_jumlah_pria_komsel }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="">total wanita</th>
                                                    <td>:</td>
                                                    <td>{{ $total_jumlah_wanita_komsel }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="">total anggota</th>
                                                    <td>:</td>
                                                    <td>{{ $total_jumlah_anggota_komsel }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="">total cabang</th>
                                                    <td>:</td>
                                                    <td>{{ $komsel->groupBy('lfk_cabang_id')->count() }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="">total sub cabang</th>
                                                    <td>:</td>
                                                    <td>{{ $komsel->groupBy('lfk_sub_cabang_id')->count() }}</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ request('tab') == 'kelompokpa' ? 'active' : '' }}" id="kelompokpa">
                                <div class="card-box table-responsive">
                                    <div id="addKelompokpaData" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Tambah Kelompok PA</h4>
                                                </div>
                                                <form id="formKelompokpa"
                                                    action="{{ url('superadmin/database/database-cabang/kelompok-pa', []) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama_kelompok" class="control-label">Nama
                                                                kelompok</label>
                                                            <input type="text" class="form-control" id="nama_kelompok"
                                                                placeholder="Nama kelompok" name="nama_kelompok"
                                                                value="{{ old('nama_kelompok') }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_kategori_gereja_id"
                                                                class="control-label">Pilih Kategori Gereja</label>
                                                            <select id="lfk_kategori_gereja_id" class="form-control"
                                                                name="lfk_kategori_gereja_id">
                                                                <option value="">Pilih Kategori Gereja</option>
                                                                @foreach ($kategori_gereja as $item)
                                                                    <option value="{{ $item->kategori_gereja_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_gereja }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_cabang_id" class="control-label">Nama
                                                                Gereja</label>
                                                            <select class="form-control" id="lfk_cabang_id"
                                                                name="lfk_cabang_id">
                                                                <option value="">Pilih Gereja</option>
                                                                @foreach ($all_cabang as $item)
                                                                    <option value="{{ $item->cabang_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama_cabang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_kakak_pa_user_id"
                                                                class="control-label">Pembimbing PA</label>
                                                            <select class="form-control" id="lfk_kakak_pa_user_id"
                                                                name="lfk_kakak_pa_user_id">
                                                                <option value="">Pilih Pembimbing PA</option>
                                                                @foreach ($kakak_pa as $item)
                                                                    <option value="{{ $item->user_id }}"
                                                                        data-chained="{{ $item->lfk_cabang_id }}"
                                                                        {{ $item->user_id == old('lfk_kakak_pa_user_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="active">Status Aktif</label>
                                                            <select name="active" id="active"
                                                                class="form-control form-control-sm">
                                                                <option value="">Pilih status</option>
                                                                <option value="1">Aktif</option>
                                                                <option value="0">Non-aktif</option>
                                                            </select>
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
                                                <button id="tambahKelompokpa"
                                                    class="btn btn-success waves-effect waves-light" data-toggle="modal"
                                                    data-target="#addKelompokpaData">
                                                    Add <i class="mdi mdi-plus-circle-outline"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="m-b-30">
                                                <form action="?tab=kelompokpa" id="form-filter-kelompokpa">
                                                    <div class="row ">
                                                        <div class="col-sm-5">
                                                            <input type="hidden" name="tab" value="kelompokpa">
                                                            <select id="filter_kategori_gereja" class="form-control"
                                                                name="filter_kategori_gereja">
                                                                <option value="">Pilih Kategori Gereja</option>
                                                                @foreach ($kategori_gereja as $item)
                                                                    <option value="{{ $item->kategori_gereja_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_gereja }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-control" id="filter_cabang"
                                                                name="filter_cabang">
                                                                <option value="">Pilih Gereja</option>
                                                                @foreach ($all_cabang as $item)
                                                                    <option value="{{ $item->cabang_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama_cabang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <button type="submit" class="btn btn-default">Cari</button>
                                                            <a href="?tab=kelompokpa" class="btn btn-default">Reset</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="{{ styletable() }}" id="datatable-kelompokpa">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama Kelompok</th>
                                                <th class="text-center">Kategori Gereja</th>
                                                <th class="text-center">Nama Gereja</th>
                                                <th class="text-center">Nama Pembimbing PA</th>
                                                <th class="text-center">Gender</th>
                                                <th class="text-center">Jumlah Anggota / Anak PA</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center table-action">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_jumlah_anggota_kelompok_pa = 0;
                                            @endphp
                                            @foreach ($kelompok_pa as $key => $value)
                                                @php
                                                    $total_jumlah_anggota_kelompok_pa += @$value->anak_pa->count();
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="">{{ $value->nama_kelompok }}</td>
                                                    <td class="">{{ @$value->kategori_gereja }}</td>
                                                    <td class="">{{ @$value->nama_cabang }}</td>
                                                    <td class="">{{ @$value->kakak_pa->nama }}</td>
                                                    <td class="">{!! @$value->kakak_pa->gender == 'l'
                                                        ? 'Laki - laki'
                                                        : (@$value->kakak_pa->gender == 'p'
                                                            ? 'Perempuan'
                                                            : '<span class="badge badge-danger">Kosong</span>') !!}</td>
                                                    <td class="text-center">{{ @$value->anak_pa->count() }}</td>
                                                    <td class="text-center">
                                                        {!! $value->active == '1'
                                                            ? '<span class="badge badge-success">Aktif</span>'
                                                            : '<span class="badge badge-danger">Tidak Aktif</span>' !!}
                                                    </td>
                                                    <td class="actions text-center table-action">
                                                        <a href="#" class="btn btn-warning btn-action"
                                                            data-toggle="modal" data-target="#addKelompokpaData"
                                                            onclick="editKelompokpa('{{ $value->kelompok_pa_id }}')">
                                                            <i class="fa fa-pencil"></i> {{ editText() }}
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-action"
                                                            onclick="delConf('{{ url('superadmin/database/database-cabang/kelompok-pa/hapus/' . $value->kelompok_pa_id) }}')">
                                                            <i class="fa fa-trash"></i> {{ deleteText() }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <th>Jumlah Kelompok PA</th>
                                                    <td>:</td>
                                                    <td>{{ $kelompok_pa->count() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Anggota</th>
                                                    <td>:</td>
                                                    <td>{{ $total_jumlah_anggota_kelompok_pa }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Pembimbing PA Pria</th>
                                                    <td>:</td>
                                                    <td>
                                                        {{ $total_kakak_pa_pria }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Pembimbing PA Wanita</th>
                                                    <td>:</td>
                                                    <td>
                                                        {{ $total_kakak_pa_wanita }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Total Pembimbing PA</th>
                                                    <td>:</td>
                                                    <td>{{ $kelompok_pa->groupBy('lfk_kakak_pa_user_id')->count() }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ request('tab') == 'event' ? 'active' : '' }}" id="event">
                                <div class="card-box table-responsive">
                                    <div id="addEventData" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form id="formEvent"
                                                    action="{{ url('superadmin/database/database-cabang/event', []) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                        <h4 class="modal-title">Tambah Event</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nama_event" class="control-label">Nama
                                                                        event</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_event" placeholder="Nama event"
                                                                        name="nama_event"
                                                                        value="{{ old('nama_event') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="jenis_event" class="control-label">Jenis
                                                                        event</label>
                                                                    <select class="form-control" id="jenis_event"
                                                                        name="jenis_event">
                                                                        <option value="">Pilih jenis event</option>
                                                                        <option value="doa"
                                                                            {{ old('jenis_event') == 'doa' ? 'selected' : '' }}>
                                                                            Doa </option>
                                                                        <option value="kunjungan"
                                                                            {{ old('jenis_event') == 'kunjungan' ? 'selected' : '' }}>
                                                                            Kunjungan </option>
                                                                        <option value="retreat"
                                                                            {{ old('jenis_event') == 'retreat' ? 'selected' : '' }}>
                                                                            Retreat </option>
                                                                        <option value="ibadah"
                                                                            {{ old('jenis_event') == 'ibadah' ? 'selected' : '' }}>
                                                                            Ibadah</option>
                                                                        <option value="kebaktian padang"
                                                                            {{ old('jenis_event') == 'kebaktian padang' ? 'selected' : '' }}>
                                                                            Kebaktian Padang</option>
                                                                        <option value="KKR"
                                                                            {{ old('jenis_event') == 'KKR' ? 'selected' : '' }}>
                                                                            KKR</option>
                                                                        <option value="seminar"
                                                                            {{ old('jenis_event') == 'seminar' ? 'selected' : '' }}>
                                                                            Seminar</option>
                                                                        <option value="talkshow"
                                                                            {{ old('jenis_event') == 'talkshow' ? 'selected' : '' }}>
                                                                            Talkshow</option>
                                                                        <option value="pelatihan/training"
                                                                            {{ old('jenis_event') == 'pelatihan/training' ? 'selected' : '' }}>
                                                                            Pelatihan/Training</option>
                                                                        <option value="lain-lain"
                                                                            {{ old('jenis_event') == 'lain-lain' ? 'selected' : '' }}>
                                                                            Lain-lain</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tanggal_event_mulai"
                                                                        class="control-label">Tanggal event mulai</label>
                                                                    <input type="date" class="form-control"
                                                                        id="tanggal_event_mulai"
                                                                        name="tanggal_event_mulai"
                                                                        value="{{ old('tanggal_event_mulai') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tanggal_event_selesai"
                                                                        class="control-label">Tanggal event selesai</label>
                                                                    <input type="date" class="form-control"
                                                                        id="tanggal_event_selesai"
                                                                        name="tanggal_event_selesai"
                                                                        value="{{ old('tanggal_event_selesai') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="jam_event_mulai" class="control-label">Jam
                                                                        event mulai</label>
                                                                    <input type="text" class="form-control"
                                                                        id="jam_event_mulai" name="jam_event_mulai"
                                                                        value="{{ old('jam_event_mulai') }}" required
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="jam_event_selesai"
                                                                        class="control-label">Jam event selesai</label>
                                                                    <input type="text" class="form-control"
                                                                        id="jam_event_selesai" name="jam_event_selesai"
                                                                        value="{{ old('jam_event_selesai') }}" required
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="foto_event" class="control-label">Foto
                                                                        event</label>
                                                                    {!! DescriptionImage() !!}
                                                                    <input type="file" accept="image/*"
                                                                        class="form-control" id="foto_event"
                                                                        name="foto_event"
                                                                        value="{{ old('foto_event') }}"
                                                                        {!! AcceptImage() !!}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="foto_banner" class="control-label">Foto
                                                                        Banner/flyer</label>
                                                                    {!! DescriptionImage() !!}
                                                                    <input type="file" accept="image/*"
                                                                        class="form-control" id="foto_banner"
                                                                        name="foto_banner"
                                                                        value="{{ old('foto_banner') }}"
                                                                        {!! AcceptImage() !!}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="proposal"
                                                                        class="control-label">Proposal</label>
                                                                    {!! DescriptionFile() !!}
                                                                    <input type="file" class="form-control"
                                                                        id="proposal" name="proposal"
                                                                        value="{{ old('proposal') }}"
                                                                        {!! AcceptFile() !!}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="lpj"
                                                                        class="control-label">LPJ</label>
                                                                    {!! DescriptionFile() !!}
                                                                    <input type="file" class="form-control"
                                                                        id="lpj" name="lpj"
                                                                        value="{{ old('lpj') }}"
                                                                        {!! AcceptFile() !!}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group no-margin">
                                                                    <label for="catatan"
                                                                        class="control-label">Catatan</label>
                                                                    <textarea class="form-control autogrow" id="catatan" placeholder="Catatan" name="catatan"
                                                                        style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 50px;">{{ old('catatan') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_kategori_gereja_id"
                                                                class="control-label">Pilih Kategori Gereja</label>
                                                            <select id="lfk_kategori_gereja_id" class="form-control"
                                                                name="lfk_kategori_gereja_id">
                                                                <option value="">Pilih Kategori Gereja</option>
                                                                @foreach ($kategori_gereja as $item)
                                                                    <option value="{{ $item->kategori_gereja_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_gereja }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_cabang_id" class="control-label">Nama
                                                                Gereja</label>
                                                            <select class="form-control" id="lfk_cabang_id"
                                                                name="lfk_cabang_id">
                                                                <option value="">Pilih Gereja</option>
                                                                @foreach ($all_cabang as $item)
                                                                    <option value="{{ $item->cabang_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama_cabang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tujuan" class="control-label">Tujuan</label>
                                                            <input type="text" class="form-control" id="tujuan"
                                                                name="tujuan" value="{{ old('tujuan') }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="kuota_tersedia"
                                                                class="control-label">Kuota</label>
                                                            <input type="number" class="form-control"
                                                                id="kuota_tersedia" name="kuota_tersedia"
                                                                value="{{ old('kuota_tersedia') }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="kehadiran" class="control-label">Target
                                                                Kehadiran</label>
                                                            <input type="number" class="form-control" id="kehadiran"
                                                                name="kehadiran" value="{{ old('kehadiran') }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lfk_status_event_id" class="control-label">Pilih
                                                                Status Event</label>
                                                            <select class="form-control" id="lfk_status_event_id"
                                                                name="lfk_status_event_id">
                                                                <option value="">Pilih Status Event</option>
                                                                @foreach ($status_event as $item)
                                                                    <option value="{{ $item->status_event_id }}"
                                                                        {{ old('lfk_status_event_id') == $item->status_event_id ? 'selected' : '' }}>
                                                                        {{ $item->status_event }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
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
                                                <button id="tambahEventCabang" type="button"
                                                    class="btn btn-success waves-effect waves-light" data-toggle="modal"
                                                    data-target="#addEventData">
                                                    Add <em class="mdi mdi-plus-circle-outline"></em>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="m-b-30">
                                                <form action="?tab=event" id="form-filter-event">
                                                    <div class="row ">
                                                        <div class="col-sm-5">
                                                            <input type="hidden" name="tab" value="event">
                                                            <select id="filter_kategori_gereja" class="form-control"
                                                                name="filter_kategori_gereja">
                                                                <option value="">Pilih Kategori Gereja</option>
                                                                @foreach ($kategori_gereja as $item)
                                                                    <option value="{{ $item->kategori_gereja_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_gereja }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-control" id="filter_cabang"
                                                                name="filter_cabang">
                                                                <option value="">Pilih Gereja</option>
                                                                @foreach ($all_cabang as $item)
                                                                    <option value="{{ $item->cabang_id }}"
                                                                        data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                        {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                        {{ $item->nama_cabang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <button type="submit" class="btn btn-default">Cari</button>
                                                            <a href="?tab=ibadah" class="btn btn-default">Reset</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="{{ styletable() }}" id="datatable-event">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">foto event</th>
                                                <th class="text-center">foto banner</th>
                                                <th class="text-center">Proposal</th>
                                                <th class="text-center">LPJ</th>
                                                <th class="text-center">Nama Event</th>
                                                <th class="text-center">jenis event</th>
                                                <th class="text-center">tanggal event</th>
                                                <th class="text-center">jam event</th>
                                                <th class="text-center">Nama Gereja</th>
                                                <th class="text-center">catatan</th>
                                                <th class="text-center">tujuan</th>
                                                <th class="text-center">kuota</th>
                                                <th class="text-center">target kehadiran</th>
                                                <th class="text-center">status</th>
                                                <th class="text-center table-action">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($event as $key => $item)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="text-center">
                                                        @if ($item->foto_event == '')
                                                            <small class="badge badge-danger">kosong</small>
                                                        @else
                                                            <a href="{{ S3Helper::get($item->foto_event) }}"
                                                                class="btn btn-default" target="_blank">Lihat</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->foto_banner == '')
                                                            <small class="badge badge-danger">kosong</small>
                                                        @else
                                                            <a href="{{ S3Helper::get($item->foto_banner) }}"
                                                                class="btn btn-default" target="_blank">Lihat</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->proposal == '')
                                                            <small class="badge badge-danger">kosong</small>
                                                        @else
                                                            <a href="{{ S3Helper::get($item->proposal) }}"
                                                                class="btn btn-default" target="_blank">Lihat</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->lpj == '')
                                                            <small class="badge badge-danger">kosong</small>
                                                        @else
                                                            <a href="{{ S3Helper::get($item->lpj) }}"
                                                                class="btn btn-default" target="_blank">Lihat</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $item->nama_event }}</td>
                                                    <td class="text-center">{{ $item->jenis_event }}</td>
                                                    <td class="text-center">{{ $item->tanggal_event_mulai }} -
                                                        {{ $item->tanggal_event_selesai }}</td>
                                                    <td class="text-center">{{ $item->jam_event_mulai }} -
                                                        {{ $item->jam_event_selesai }}</td>
                                                    <td class="text-center"> {{ @$item->nama_cabang }} </td>
                                                    <td>{{ $item->catatan }}</td>
                                                    <td>{{ $item->tujuan }}</td>
                                                    <td class="text-center">{{ $item->kuota_tersedia }}</td>
                                                    <td class="text-center">{{ $item->kehadiran }}</td>
                                                    <td class='text-center'>
                                                        @if (@$item->status_event->status_event == 'Dalam persiapan')
                                                            <span
                                                                class="badge badge-primary">{{ @$item->status_event->status_event }}</span>
                                                        @elseif (@$item->status_event->status_event == 'Sedang berlangsung')
                                                            <span
                                                                class="badge badge-warning">{{ @$item->status_event->status_event }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-success">{{ @$item->status_event->status_event }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="actions text-center table-action">
                                                        <a href="#" class="btn btn-warning btn-action"
                                                            data-toggle="modal" data-target="#addEventData"
                                                            onclick="editEvent('{{ $item->event_id }}')">
                                                            <i class="fa fa-pencil"></i> {{ editText() }}
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-action"
                                                            onclick="delConf('{{ url('superadmin/database/database-cabang/event/hapus/' . $item->event_id) }}')">
                                                            <i class="fa fa-trash-o"></i> {{ deleteText() }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <th>Jumlah Event</th>
                                                    <td>:</td>
                                                    <td>{{ $event->count() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Cabang</th>
                                                    <td>:</td>
                                                    <td>{{ $event->groupBy('lfk_cabang_id')->count() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Sub Cabang</th>
                                                    <td>:</td>
                                                    <td>{{ $event->groupBy('lfk_sub_cabang_id')->count() }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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

    {{-- picker --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- touchspin --}}
    <script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    {{-- form --}}
    <script src="{{ asset('assets/pages/jquery.form-touchspin.init.js') }}"></script>
    <script src="{{ asset('assets/js/cabang.js') }}"></script>
    <script src="{{ asset('assets/js/ibadah.js') }}"></script>
    <script src="{{ asset('assets/js/komsel.js') }}"></script>
    <script src="{{ asset('assets/js/kelompokpa.js') }}"></script>
    <script src="{{ asset('assets/js/event.js') }}"></script>

    <script>
        console.log("{{ request()->get('tab') }}")
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('#datatable-cabang').DataTable();
        $('#datatable-ibadah').DataTable();
        $('#datatable-komsel').DataTable();
        $('#datatable-kelompokpa').DataTable();
        $('#datatable-event').DataTable();

        $(`#form-filter-ibadah #filter_cabang`).chained(`#form-filter-ibadah #filter_kategori_gereja`);
        $(`#form-filter-komsel #filter_cabang`).chained(`#form-filter-komsel #filter_kategori_gereja`);
        $(`#form-filter-kelompokpa #filter_cabang`).chained(`#form-filter-kelompokpa #filter_kategori_gereja`);
        $(`#form-filter-event #filter_cabang`).chained(`#form-filter-event #filter_kategori_gereja`);

        setValSelect2('', "form-filter-{{ request()->get('tab') }} #filter_kategori_gereja",
            "{{ request()->get('filter_kategori_gereja') }}")
        setValSelect2('', "form-filter-{{ request()->get('tab') }} #filter_cabang",
            "{{ request()->get('filter_cabang') }}")

        $(`#form-filter-ibadah #filter_kategori_gereja`).select2({
            theme: 'bootstrap'
        });
        $(`#form-filter-ibadah #filter_cabang`).select2({
            theme: 'bootstrap'
        });

        $(`#form-filter-komsel #filter_kategori_gereja`).select2({
            theme: 'bootstrap'
        });
        $(`#form-filter-komsel #filter_cabang`).select2({
            theme: 'bootstrap'
        });

        $(`#form-filter-kelompokpa #filter_kategori_gereja`).select2({
            theme: 'bootstrap'
        });
        $(`#form-filter-kelompokpa #filter_cabang`).select2({
            theme: 'bootstrap'
        });

        $(`#form-filter-event #filter_kategori_gereja`).select2({
            theme: 'bootstrap'
        });
        $(`#form-filter-event #filter_cabang`).select2({
            theme: 'bootstrap'
        });
    </script>

    <script>
        function tab_click(tab) {
            window.history.replaceState('asda', tab, `database-cabang?tab=${tab}`);
        };
    </script>
@endsection
