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
                            <h4 class="page-title">Database Jemaat</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet">
                            <div class="portlet-heading bg-success">
                                <h3 class="portlet-title">
                                    <i class="mdi mdi-cake "></i> Ulang Tahun Hari Ini ({{ date('d M Y') }})
                                </h3>
                                <div class="portlet-widgets">
                                    {{ $jemaat_ultah->count() }} Jemaat
                                    <span class="divider"></span><a data-toggle="collapse" data-parent="#accordion1" href="#bg-success"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span><a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bg-success" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <table class="{{ styletable() }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center table-number">No</th>
                                                <th class="text-center">Status jemaat</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Jenis Kelamin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jemaat_ultah as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ @$value->status_jemaat->status_jemaat }}</td>
                                                    <td>{{ $value->nama }}</td>
                                                    <td class='text-center'>
                                                        {{ $value->jenis_kelamin === 'l' ? 'Laki-laki' : 'Perempuan' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Jemaat</b></h4>
                            <p class="text-muted font-13 m-b-30"></p>
                            <div id="modalJemaat" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Jemaat</h4>
                                        </div>
                                        <form action="{{ url('/superadmin/database/database-jemaat') }}" method="POST"
                                            enctype="multipart/form-data" id="formJemaat">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="lfk_status_jemaat_id" class="control-label">Status Jemaat</label>
                                                    <select class="form-control" id="lfk_status_jemaat_id" name="lfk_status_jemaat_id">
                                                        <option value="">Pilih Status Jemaat</option>
                                                        @foreach ($status_jemaat as $item)
                                                            <option value="{{ $item->status_jemaat_id }}">
                                                                {{ $item->status_jemaat }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin" id="no_sk_input" style="display: none">
                                                    <label for="no_sk" class="control-label">No SK</label>
                                                    <input type="text" class="form-control autogrow" id="no_sk" name="no_sk" placeholder="No SK" value="">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="nama" class="control-label">Nama</label>
                                                    <input type="text" class="form-control autogrow" id="nama" name="nama" placeholder="Nama" value="">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="pekerjaan" class="control-label">Pekerjaan</label>
                                                    <input type="text" class="form-control autogrow" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lfk_kategori_gereja_id" class="control-label">Pilih
                                                        Kategori Gereja</label>
                                                    <select id="lfk_kategori_gereja_id" class="form-control"
                                                        name="lfk_kategori_gereja_id">
                                                        <option value="">Pilih Kategori Gereja</option>
                                                        @foreach ($kategori_gereja as $item)
                                                            <option value="{{ $item->kategori_gereja_id }}">
                                                                {{ $item->kategori_gereja }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lfk_cabang_id" class="control-label">Cabang</label>
                                                    <select class="form-control" id="lfk_cabang_id" name="lfk_cabang_id">
                                                        <option value="">Pilih cabang</option>
                                                        @foreach ($cabang_input as $item)
                                                            <option value="{{ $item->cabang_id }}" data-chained="{{ $item->lfk_kategori_gereja_id }}"> {{ $item->nama_cabang }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Gender</label>
                                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm">
                                                        <option value="">Pilih gender</option>
                                                        <option value="l">Laki-laki</option>
                                                        <option value="p">Perempuan</option>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label for='tempat_lahir'>Tempat Lahir</label>
                                                        <div class='form-group'>
                                                            <div class='form-line'>
                                                                <input type='text' id='tempat_lahir' name='tempat_lahir' class='form-control' placeholder='Tempat'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <label for='tanggal_lahir'>Tanggal Lahir</label>
                                                        <div class='form-group'>
                                                            <div class='form-line'>
                                                                <input type='date' id='tanggal_lahir' name='tanggal_lahir' class='form-control' placeholder='00-00-0000' max="{{ date('Y-m-d') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for='no_hp'>No HP</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="08...">
                                                </div>
                                                <div class="form-group">
                                                    <label for='email'>Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                </div>
                                                <div class='form-group'>
                                                    <label for='alamat'>Alamat</label>
                                                    <textarea id='alamat' name='alamat' class='form-control' rows="5"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_pernikahan">Status Pernikahan</label>
                                                    <select name="status_pernikahan" id="status_pernikahan" class="form-control form-control-sm">
                                                        <option value="">Pilih status pernikahan</option>
                                                        <option value="belum menikah">Belum Menikah</option>
                                                        <option value="sudah menikah">Sudah Menikah</option>
                                                        <option value="duda">Duda</option>
                                                        <option value="janda">Janda</option>
                                                    </select>
                                                </div>
                                                <div class="" id="menikah_field" style="display: none;">
                                                    <div class="form-group">
                                                        <label for='jumlah_anak'>Jumlah Anak</label>
                                                        <input type="text" class="form-control" id="jumlah_anak" name="jumlah_anak" placeholder="Jumlah anak">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for='nama_pasangan'>Nama Pasangan</label>
                                                        <input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" placeholder="Nama pasangan">
                                                    </div>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="pendidikan_formal" class="control-label">Pendidikan Formal</label> <br>
                                                    <small>Contoh: Universitas Indonesia, Fakultas Hukum</small>
                                                    <input type="text" class="form-control autogrow" id="pendidikan_formal" name="pendidikan_formal" placeholder="Pendidikan formal" value="">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="pendidikan_non_formal" class="control-label">Pendidikan Non Formal</label> <br>
                                                    <small>Contoh: Kursus, menjahit, Elmodista Surabaya</small>
                                                    <input type="text" class="form-control autogrow" id="pendidikan_non_formal" name="pendidikan_non_formal" placeholder="Pendidikan terakhir" value="">
                                                </div>
                                                <label for='keterampilan'>Keterampilan</label>
                                                <div class='form-group'>
                                                    <textarea id='keterampilan' name='keterampilan' class='form-control' rows="1"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for='karunia'>Karunia Yang Dimiliki</label>
                                                    <input type="text" class="form-control" id="karunia" name="karunia" placeholder="Karunia">
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
                                        <button id="tambahSettingUser" class="btn btn-success waves-effect waves-light"
                                            id="tambahJemaat" data-toggle="modal" data-target="#modalJemaat">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </button>
                                        {{-- <span class="badge badge-success">cek</span> --}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <form action="" id="form-filter-jemaat">
                                            <div class="row ">
                                                <div class="col-sm-4">
                                                    <select id="filter_kategori_gereja" class="form-control"
                                                        name="filter_kategori_gereja">
                                                        <option value="">Pilih kategori gereja</option>
                                                        @foreach ($kategori_gereja as $item)
                                                            <option value="{{ $item->kategori_gereja_id }}"
                                                                {{ request('filter_kategori_gereja') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                {{ $item->kategori_gereja }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="hidden" name="tab" value="kakak_pa">
                                                    <select id="filter_cabang" class="form-control" name="filter_cabang">
                                                        <option value="">Pilih Gereja</option>
                                                        @foreach ($cabang_input as $item)
                                                            <option value="{{ $item->cabang_id }}"
                                                                data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                {{ request('filter_cabang') == $item->cabang_id ? 'selected' : '' }}>
                                                                {{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 text-right">
                                                    <button type="submit" class="btn btn-default">Cari</button>
                                                    <a href="?" class="btn btn-default">Reset</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div style="overflow: auto">
                                <table class="{{ styletable() }}" id="datatable-jemaat">
                                    <thead>
                                        <tr>
                                            <th class="text-center table-number">No</th>
                                            <th class="text-center">Kategori Gereja</th>
                                            <th class="text-center">Gereja</th>
                                            <th class="text-center">Status jemaat</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Tempat Tanggal Lahir</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Pekerjaan</th>
                                            <th class="text-center">Status Pernikahan</th>
                                            <th class="text-center">No HP</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Pendidikan Formal</th>
                                            <th class="text-center">Pendidikan Non Formal</th>
                                            <th class="text-center">Keterampilan</th>
                                            <th class="text-center">Jumlah Anak</th>
                                            <th class="text-center">Karunia</th>
                                            <th class="text-center table-action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jemaat as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ ++$key }}</td>
                                                <td>{{ $value->kategori_gereja }}</td>
                                                <td>{{ $value->nama_cabang }}</td>
                                                <td>{{ @$value->status_jemaat->status_jemaat }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td class='text-center'>
                                                    {{ $value->jenis_kelamin === 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                <td class='text-center'>
                                                    {{ $value->tempat_lahir . ', ' . $value->tanggal_lahir }}</td>
                                                <td>{{ $value->alamat }}</td>
                                                <td>{{ $value->pekerjaan }}</td>
                                                <td>{{ $value->status_pernikahan }}</td>
                                                <td>{{ $value->no_hp }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->pendidikan_formal }}</td>
                                                <td>{{ $value->pendidikan_non_formal }}</td>
                                                <td>{{ $value->keterampilan }}</td>
                                                <td>{{ $value->jumlah_anak }}</td>
                                                <td>{{ $value->karunia }}</td>
                                                <td class="actions text-center">
                                                    <a href="#" class="btn btn-primary btn-action"
                                                        onclick="detailJemaat('{{ $value->jemaat_id }}')"
                                                        data-toggle="modal" data-target="#modalDetailJemaat">
                                                        <i class="fa fa-info-circle"></i> {{ detailtext() }}
                                                    </a>
                                                    <a href="#" class="btn btn-warning btn-action"
                                                        onclick="editJemaat('{{ $value->jemaat_id }}')"
                                                        data-toggle="modal" data-target="#modalJemaat">
                                                        <i class="fa fa-pencil"></i> {{ edittext() }}
                                                    </a>
                                                    <a href="{{ url("superadmin/database/database-jemaat/$value->jemaat_id/hapus") }}"
                                                        class="btn btn-danger btn-action"
                                                        onclick="return confirm('Apakah anda yakin?')">
                                                        <i class="fa fa-trash-o"></i> {{ deleteText() }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Jumlah Gereja</th>
                                            <td>:</td>
                                            <td>{{ $jemaat->groupBy('lfk_cabang_id')->count() }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: page -->

                    <div id="modalDetailJemaat" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true"></button>
                                    <h4 class="modal-title">Detail Jemaat</h4>
                                </div>
                                <div class="modal-body text-sm mx-2">
                                    <table class="table table-sm table-borderless table-hover">
                                        <tr>
                                            <th>Status Jemaat</th>
                                            <td>:</td>
                                            <td id="status_jemaat">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Kategori gereja</th>
                                            <td>:</td>
                                            <td id="kategori_gereja">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama gereja</th>
                                            <td>:</td>
                                            <td id="nama_cabang">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td id="nama">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>:</td>
                                            <td id="jenis_kelamin">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Tanggal Lahir</th>
                                            <td>:</td>
                                            <td id="ttd">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>alamat</th>
                                            <td>:</td>
                                            <td id="alamat">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>pekerjaan</th>
                                            <td>:</td>
                                            <td id="pekerjaan">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Pernikahan</th>
                                            <td>:</td>
                                            <td id="status_pernikahan">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Pasangan</th>
                                            <td>:</td>
                                            <td id="nama_pasangan">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>No HP</th>
                                            <td>:</td>
                                            <td id="no_hp">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td id="email">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan Formal</th>
                                            <td>:</td>
                                            <td id="pendidikan_formal">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan Non Formal</th>
                                            <td>:</td>
                                            <td id="pendidikan_non_formal">{!! kosong() !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterampilan</th>
                                            <td>:</td>
                                            <td id="keterampilan">{!! kosong() !!}</td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="modal-footer">
                                    {!! modalFooterDetail() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end row -->
                </div> <!-- container -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="text-center">Jemaat</h3>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>Total Semua Jemaat</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('lfk_status_jemaat_id', 6)->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Jemaat Dewasa Pria</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'l')->where('lfk_status_jemaat_id', 6)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Jemaat Dewasa Wanita</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'p')->where('lfk_status_jemaat_id', 6)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Jemaat Anak - anak Pria</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'l')->where('lfk_status_jemaat_id', 7)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Jemaat Anak - anak Wanita</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'p')->where('lfk_status_jemaat_id', 7)->count() }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="text-center">Penatua</h3>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>Total Semua Penatua</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('lfk_status_jemaat_id', 1)->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Penatua Pria</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'l')->where('lfk_status_jemaat_id', 1)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Penatua Wanita</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'p')->where('lfk_status_jemaat_id', 1)->count() }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="text-center">Pendeta</h3>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>Total Semua Pendeta</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('lfk_status_jemaat_id', 2)->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pendeta Pria</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'l')->where('lfk_status_jemaat_id', 2)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pendeta Wanita</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'p')->where('lfk_status_jemaat_id', 2)->count() }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="text-center">Pendeta Muda</h3>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>Total Semua Pendeta Muda</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('lfk_status_jemaat_id', 3)->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pendeta Muda Pria</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'l')->where('lfk_status_jemaat_id', 3)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pendeta Muda Wanita</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'p')->where('lfk_status_jemaat_id', 3)->count() }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="text-center">Evangelis</h3>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>Total Semua Evangelis</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('lfk_status_jemaat_id', 4)->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Evangelis Pria</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'l')->where('lfk_status_jemaat_id', 4)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Evangelis Wanita</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'p')->where('lfk_status_jemaat_id', 4)->count() }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="text-center">Diakonia (diaken)</h3>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>Total Semua Diakonia (diaken)</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('lfk_status_jemaat_id', 5)->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Diakonia (diaken) Pria</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'l')->where('lfk_status_jemaat_id', 5)->count() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Diakonia (diaken) Wanita</th>
                                        <td>:</td>
                                        <td>{{ $jemaat->where('jenis_kelamin', 'p')->where('lfk_status_jemaat_id', 5)->count() }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- content -->


        </div>
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
    {{-- <script src="{{ url('assets/pages/jquery.datatables.user.init.js') }}"></script> --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('#datatable-jemaat').DataTable()
    </script>
    <script>
        const modalJemaat = 'modalJemaat'
        const modalDetailJemaat = 'modalDetailJemaat'
        const formJemaat = 'formJemaat'
        const formFilterJemaat = 'form-filter-jemaat'

        $(function() {
            JemaatValidation(formJemaat)
            setSelect2(modalJemaat + ' #jenis_kelamin')
            $(`#${modalJemaat} #lfk_cabang_id`).chained(`#${modalJemaat} #lfk_kategori_gereja_id`);

            setSelect2(modalJemaat + ' #lfk_kategori_gereja_id')
            setSelect2(modalJemaat + ' #lfk_cabang_id')

            setSelect2('filter_cabang');
            setSelect2('filter_kategori_gereja');
            $('#filter_cabang').chained('#filter_kategori_gereja');
        })

        $('#tambahJemaat').on('click', function() {})

        $('#' + modalJemaat + ' #status_pernikahan').on('change', function() {
            if ($('#' + modalJemaat + ' #status_pernikahan').val() === 'sudah menikah') {
                $('#' + modalJemaat + ' #menikah_field').css('display', 'block')
            } else {
                $('#' + modalJemaat + ' #menikah_field').css('display', 'none')
            }
        })

        $('#' + modalJemaat).on('hidden.bs.modal', function() {
            setVal(modalJemaat, 'nama', '')
            setVal(modalJemaat, 'pekerjaan', '')
            setVal(modalJemaat, 'lfk_status_jemaat_id', '')
            setVal(modalJemaat, 'no_sk', '')

            // setValSelect2(modalJemaat, 'lfk_kategori_gereja_id', '')
            // setValSelect2(modalJemaat, 'lfk_kategori_gereja_id', '')
            setValSelect2(modalJemaat, 'lfk_cabang_id', '')
            setVal(modalJemaat, 'pendidikan_formal', '')
            setVal(modalJemaat, 'pendidikan_non_formal', '')
            setValSelect2(modalJemaat, 'jenis_kelamin', '')
            setVal(modalJemaat, 'status_pernikahan', '')
            setVal(modalJemaat, 'tempat_lahir', '')
            setVal(modalJemaat, 'tanggal_lahir', '')
            setVal(modalJemaat, 'no_hp', '')
            setVal(modalJemaat, 'email', '')
            setVal(modalJemaat, 'keterampilan', '')
            setVal(modalJemaat, 'alamat', '')
            setVal(modalJemaat, 'nama_pasangan', '')
            setVal(modalJemaat, 'karunia', '')

            $('#' + modalJemaat + ' #lfk_status_jemaat_id' + '-error').hide()
            $('#' + modalJemaat + ' #no_sk' + '-error').hide()
            $('#' + modalJemaat + ' #nama' + '-error').hide()
            $('#' + modalJemaat + ' #pekerjaan' + '-error').hide()
            $('#' + modalJemaat + ' #lfk_kategori_gereja_id' + '-error').hide()
            $('#' + modalJemaat + ' #lfk_cabang_id' + '-error').hide()
            $('#' + modalJemaat + ' #pendidikan_formal' + '-error').hide()
            $('#' + modalJemaat + ' #pendidikan_non_formal' + '-error').hide()
            $('#' + modalJemaat + ' #jenis_kelamin' + '-error').hide()
            $('#' + modalJemaat + ' #status_pernikahan' + '-error').hide()
            $('#' + modalJemaat + ' #tempat_lahir' + '-error').hide()
            $('#' + modalJemaat + ' #tanggal_lahir' + '-error').hide()
            $('#' + modalJemaat + ' #alamat' + '-error').hide()
            $('#' + modalJemaat + ' #nama_pasangan' + '-error').hide()
            $('#' + modalJemaat + ' #no_hp' + '-error').hide()
            $('#' + modalJemaat + ' #email' + '-error').hide()
            $('#' + modalJemaat + ' #keterampilan' + '-error').hide()

            $('#' + modalJemaat + ' #menikah_field').css('display', 'none')
        })

        $('#' + modalDetailJemaat).on('hidden.bs.modal', function() {
            setHtmlVal(modalDetailJemaat, 'kategori_gereja', kosong())
            setHtmlVal(modalDetailJemaat, 'nama_cabang', kosong())
            setHtmlVal(modalDetailJemaat, 'sub_cabang', kosong())
            setHtmlVal(modalDetailJemaat, 'nama', kosong())
            setHtmlVal(modalDetailJemaat, 'jenis_kelamin', kosong())
            setHtmlVal(modalDetailJemaat, 'alamat', kosong())
            setHtmlVal(modalDetailJemaat, 'pekerjaan', kosong())
            setHtmlVal(modalDetailJemaat, 'status_pernikahan', kosong())
            setHtmlVal(modalDetailJemaat, 'no_hp', kosong())
            setHtmlVal(modalDetailJemaat, 'email', kosong())
            setHtmlVal(modalDetailJemaat, 'pendidikan_formal', kosong())
            setHtmlVal(modalDetailJemaat, 'pendidikan_non_formal', kosong())
            setHtmlVal(modalDetailJemaat, 'keterampilan', kosong())
            setHtmlVal(modalDetailJemaat, 'ttd', kosong())
            setHtmlVal(modalDetailJemaat, 'nama_jemaat', kosong())
            setHtmlVal(modalDetailJemaat, 'nama_pasangan', kosong())
        })

        $('#' + modalJemaat + ' #lfk_status_jemaat_id').on('change', function() {
            console.log('ubah select status')
            if ($('#' + modalJemaat + ' #lfk_status_jemaat_id').val() === '6' || $('#' + modalJemaat +
                    ' #lfk_status_jemaat_id').val() === '7') {
                $('#' + modalJemaat + ' #no_sk_input').css('display', 'none')
            } else {
                $('#' + modalJemaat + ' #no_sk_input').css('display', 'block')
            }
        })

        function editJemaat(id) {
            titleAction('Edit Jemaat', base_url(
                `superadmin/database/database-jemaat/${id}`))
            startloading('#' + modalJemaat + ' .modal-dialog')
            var settings = {
                'url': base_url(`api/v1/superadmin/database/database-jemaat/${id}`),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                if (response.data.lfk_status_jemaat_id === '6' || response.data.lfk_status_jemaat_id === '7') {
                    $('#' + modalJemaat + ' #no_sk_input').css('display', 'none')
                } else {
                    $('#' + modalJemaat + ' #no_sk_input').css('display', 'block')
                    setVal(modalJemaat, 'no_sk', response.data.no_sk)
                }
                setVal(modalJemaat, 'lfk_status_jemaat_id', response.data.lfk_status_jemaat_id)
                setVal(modalJemaat, 'nama', response.data.nama)
                setVal(modalJemaat, 'pekerjaan', response.data.pekerjaan)
                setValSelect2(modalJemaat, 'lfk_kategori_gereja_id', response.data.cabang?.lfk_kategori_gereja_id)
                setValSelect2(modalJemaat, 'lfk_cabang_id', response.data.lfk_cabang_id)
                setVal(modalJemaat, 'pendidikan_formal', response.data.pendidikan_formal)
                setVal(modalJemaat, 'pendidikan_non_formal', response.data.pendidikan_non_formal)
                setValSelect2(modalJemaat, 'jenis_kelamin', response.data.jenis_kelamin)
                if (response.data.status_pernikahan === 'sudah menikah') {
                    $('#' + modalJemaat + ' #menikah_field').css('display', 'block')
                } else {
                    $('#' + modalJemaat + ' #menikah_field').css('display', 'none')
                }
                setVal(modalJemaat, 'status_pernikahan', response.data.status_pernikahan)
                setVal(modalJemaat, 'tempat_lahir', response.data.tempat_lahir)
                setVal(modalJemaat, 'tanggal_lahir', response.data.tanggal_lahir)
                setVal(modalJemaat, 'no_hp', response.data.no_hp)
                setVal(modalJemaat, 'email', response.data.email)
                setVal(modalJemaat, 'keterampilan', response.data.keterampilan)
                setVal(modalJemaat, 'alamat', response.data.alamat)
                setVal(modalJemaat, 'jumlah_anak', response.data.jumlah_anak)
                setVal(modalJemaat, 'nama_pasangan', response.data.nama_pasangan)
                setVal(modalJemaat, 'karunia', response.data.karunia)

                stoploading('#' + modalJemaat + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalJemaat + ' .modal-dialog')
            });
        }

        function deleteJemaat(id) {
            delConf(base_url(''))
        }

        function detailJemaat(id) {
            startloading('#' + modalDetailJemaat + ' .modal-dialog')
            var settings = {
                'url': base_url(`api/v1/superadmin/database/database-jemaat/${id}`),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                setHtmlVal(modalDetailJemaat, 'status_jemaat', response.data?.status_jemaat?.status_jemaat)
                setHtmlVal(modalDetailJemaat, 'kategori_gereja', response.data?.cabang?.kategori_gereja
                    ?.kategori_gereja)
                setHtmlVal(modalDetailJemaat, 'nama_cabang', response.data?.cabang?.nama_cabang)
                setHtmlVal(modalDetailJemaat, 'sub_cabang', response.data?.sub_cabang?.sub_cabang)
                setHtmlVal(modalDetailJemaat, 'nama', response.data.nama)
                setHtmlVal(modalDetailJemaat, 'jenis_kelamin', response.data.jenis_kelamin == 'l' ? 'Laki-laki' :
                    'Perempuan')
                setHtmlVal(modalDetailJemaat, 'alamat', response.data.alamat)
                setHtmlVal(modalDetailJemaat, 'pekerjaan', response.data.pekerjaan)
                setHtmlVal(modalDetailJemaat, 'status_pernikahan', response.data.status_pernikahan)
                setHtmlVal(modalDetailJemaat, 'no_hp', response.data.no_hp)
                setHtmlVal(modalDetailJemaat, 'email', response.data.email)
                setHtmlVal(modalDetailJemaat, 'pendidikan_formal', response.data.pendidikan_formal)
                setHtmlVal(modalDetailJemaat, 'pendidikan_non_formal', response.data.pendidikan_non_formal)
                setHtmlVal(modalDetailJemaat, 'keterampilan', response.data.keterampilan)
                setHtmlVal(modalDetailJemaat, 'nama_pasangan', response.data.nama_pasangan)
                setHtmlVal(modalDetailJemaat, 'ttd', response.data.tempat_lahir + ', ' + response.data
                    .tanggal_lahir)
                stoploading('#' + modalDetailJemaat + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                console.log('data: ' + data)
                console.log('status: ' + status)
                console.log('error: ' + error)
                stoploading('#' + modalDetailJemaat + ' .modal-dialog')
                if (status == 'timeout') {
                    CekKonfirmasi('Timeout!', '')
                } else if (data.responseJSON.status == false) {
                    CekKonfirmasi(data.responseJSON.message, '')
                }
            });
        }

        function titleAction(title, action) {
            $('#' + modalJemaat + ' .modal-title').html(title)
            $('#' + modalJemaat + ' #' + formJemaat).attr('action', action)
        }

        function JemaatValidation(id) {
            $('#' + id).validate({
                rules: {
                    nama: {
                        required: true
                    },
                    pekerjaan: {
                        required: true
                    },
                    jenis_kelamin: {
                        required: true
                    },
                    tempat_lahir: {
                        required: true
                    },
                    tanggal_lahir: {
                        required: true
                    },
                    lfk_kategori_gereja_id: {
                        required: true
                    },
                    lfk_cabang_id: {
                        required: true
                    },
                    no_hp: {
                        // required: true
                    },
                    email: {
                        // required: true
                    },
                    lfk_status_jemaat_id: {
                        required: true
                    },
                    pendidikan_formal: {
                        required: true
                    },
                },
                messages: {
                    nama: {
                        required: 'Nama tidak boleh kosong'
                    },
                    pekerjaan: {
                        required: 'Pekerjaan tidak boleh kosong'
                    },
                    jenis_kelamin: {
                        required: 'Jenis kelamin tidak boleh kosong'
                    },
                    tempat_lahir: {
                        required: 'Tempat lahir tidak boleh kosong'
                    },
                    tanggal_lahir: {
                        required: 'Tanggal lahir tidak boleh kosong'
                    },
                    lfk_kategori_gereja_id: {
                        required: 'Kategori gereja tidak boleh kosong'
                    },
                    lfk_cabang_id: {
                        required: 'Cabang tidak boleh kosong'
                    },
                    no_hp: {
                        // required: 'No hp cabang tidak boleh kosong'
                    },
                    email: {
                        // required: 'Email cabang tidak boleh kosong'
                    },
                    lfk_status_jemaat_id: {
                        required: 'Status jemaat tidak boleh kosong'
                    },
                    pendidikan_formal: {
                        required: 'Pendidikan formal tidak boleh kosong'
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            })
        }
    </script>
@endsection
