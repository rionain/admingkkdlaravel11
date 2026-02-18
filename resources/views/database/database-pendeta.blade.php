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
                            <h4 class="page-title">Database Pendeta</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Pendeta</b></h4>
                            <p class="text-muted font-13 m-b-30"></p>
                            <div id="modalPendeta" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Pendeta</h4>
                                        </div>
                                        <form action="{{ url('/superadmin/database/database-jemaat') }}" method="POST"
                                            enctype="multipart/form-data" id="formPendeta">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="lfk_status_jemaat_id" class="control-label">Status Pendeta</label>
                                                    <select class="form-control" id="lfk_status_jemaat_id" name="lfk_status_jemaat_id">
                                                        <option value="">Pilih Status Pendeta</option>
                                                        @foreach ($status_jemaat as $item)
                                                            <option value="{{ $item->status_jemaat_id }}">
                                                                {{ $item->status_jemaat }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin" id="no_sk_input">
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
                                                    <label for="lfk_kategori_gereja_id" class="control-label">Pilih Kategori Gereja</label>
                                                    <select id="lfk_kategori_gereja_id" class="form-control" name="lfk_kategori_gereja_id">
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
                                                            <option value="{{ $item->cabang_id }}"
                                                                data-chained="{{ $item->lfk_kategori_gereja_id }}">
                                                                {{ $item->nama_cabang }}
                                                            </option>
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
                                                    <label for='jumlah_anak'>Jumlah Anak</label>
                                                    <input type="text" class="form-control" id="jumlah_anak" name="jumlah_anak" placeholder="Jumlah anak">
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
                                        {{-- <button class="btn btn-success waves-effect waves-light" id="tambahPendeta"
                                            data-toggle="modal" data-target="#modalPendeta">
                                            {{ addText() }} <i class="mdi mdi-plus-circle-outline"></i>
                                        </button> --}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <form action="?" id="form-filter-komsel">
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
                                                        <option value="">Pilih cabang</option>
                                                        @foreach ($cabang as $item)
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
                                </div>
                            </div>

                            <table class="{{ styletable() }}" id="datatable-pendeta">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Kategori Gereja</th>
                                        <th class="text-center">Nama Gereja</th>
                                        <th class="text-center">Status pendeta</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">No SK</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tempat, Tanggal Lahir</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Status Pernikahan</th>
                                        <th class="text-center">Karunia</th>
                                        <th class="text-center">Pendidikan Formal</th>
                                        <th class="text-center">Pendidikan Non Formal</th>
                                        <th class="text-center">Jumlah Anak</th>
                                        <th class="text-center">Pekerjaan</th>
                                        <th class="text-center table-action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendeta as $key => $value)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>{{ $value->kategori_gereja }}</td>
                                            <td>{{ $value->nama_cabang }}</td>
                                            <td>{{ @$value->status_jemaat->status_jemaat }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->no_sk }}</td>
                                            <td>{{ $value->jenis_kelamin === 'l' ? 'Laki - laki' : 'Perempuan' }}
                                            </td>
                                            <td>{{ $value->tempat_lahir . ', ' . $value->tanggal_lahir }}</td>
                                            <td>{{ $value->alamat }}</td>
                                            <td>{{ $value->status_pernikahan }}</td>
                                            <td>{{ $value->karunia }}</td>
                                            <td>{{ $value->pendidikan_formal }}</td>
                                            <td>{{ $value->pendidikan_non_formal }}</td>
                                            <td>{{ $value->jumlah_anak }}</td>
                                            <td>{{ $value->pekerjaan }}</td>
                                            <td class="actions text-center">
                                                {{-- <a href="#" class="btn btn-primary btn-action"
                                                    onclick="detailPendeta('{{ $value->pendeta_id }}')" data-toggle="modal"
                                                    data-target="#modalDetailPendeta"><i class="fa fa-info-circle"></i>
                                                    {{ detailtext() }}
                                                </a> --}}
                                                <a href="#" class="btn btn-warning btn-action"
                                                    onclick="editPendeta('{{ $value->jemaat_id }}')" data-toggle="modal"
                                                    data-target="#modalPendeta"><i class="fa fa-pencil"></i>
                                                    {{ edittext() }}
                                                </a>
                                                <button class="btn btn-danger" onclick="deletePendeta('{{ $value->jemaat_id }}')"><i
                                                        class="fa fa-trash-o"></i> {{ deleteText() }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-5">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Jumlah Pendeta</th>
                                            <td>:</td>
                                            <td>{{ $pendeta->count() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Pendeta Pria</th>
                                            <td>:</td>
                                            <td>{{ $pendeta->where('jenis_kelamin', 'l')->count() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Pendeta Wanita</th>
                                            <td>:</td>
                                            <td>{{ $pendeta->where('jenis_kelamin', 'p')->count() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Gereja</th>
                                            <td>:</td>
                                            <td>{{ $pendeta->groupBy('lfk_cabang_id')->count() }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end: page -->

                        <div id="modalDetailPendeta" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                        <h4 class="modal-title">Detail Pendeta</h4>
                                    </div>
                                    <div class="modal-body text-sm mx-2">
                                        <table class="table table-sm table-borderless table-hover">
                                            <tr>
                                                <th>Nama Pendeta</th>
                                                <td>:</td>
                                                <td id="nama_pendeta">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Kategori</th>
                                                <td>:</td>
                                                <td id="kategori_pendeta">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>No SK</th>
                                                <td>:</td>
                                                <td id="no_sk">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>:</td>
                                                <td id="jenis_kelamin">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Kategori Gereja</th>
                                                <td>:</td>
                                                <td id="kategori_gereja">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Gereja</th>
                                                <td>:</td>
                                                <td id="nama_cabang">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat tanggal Lahir</th>
                                                <td>:</td>
                                                <td id="ttl">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>alamat</th>
                                                <td>:</td>
                                                <td id="alamat">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Pernikahan</th>
                                                <td>:</td>
                                                <td id="status_pernikahan">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Istri/Suami</th>
                                                <td>:</td>
                                                <td id="nama_istri_suami">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>karunia</th>
                                                <td>:</td>
                                                <td id="karunia">{!! kosong() !!}</td>
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
                                                <th>jumlah Anak</th>
                                                <td>:</td>
                                                <td id="jumlah_anak">{!! kosong() !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td>:</td>
                                                <td id="pekerjaan">{!! kosong() !!}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        {!! modalFooterDetail() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

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
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('#datatable-pendeta').DataTable()
    </script>
    <script>
        const modalPendeta = 'modalPendeta'
        const formPendeta = 'formPendeta'
        const formFilterKomsel = 'form-filter-komsel'

        $(`#${modalPendeta} #lfk_cabang_id`).chained(`#${modalPendeta} #lfk_kategori_gereja_id`);

        $(function() {
            PendetaValidation(formPendeta)
            setSelect2(modalPendeta + ' #lfk_kategori_gereja_id')
            setSelect2(modalPendeta + ' #lfk_cabang_id')
            setSelect2(modalPendeta + ' #lfk_kategori_gereja_id')
            setSelect2(modalPendeta + ' #lfk_kategori_pendeta_id')
            setSelect2(modalPendeta + ' #jenis_kelamin')
            setSelect2(modalPendeta + ' #status_pernikahan')

            setSelect2('filter_cabang');
            setSelect2('filter_kategori_gereja');
            $('#filter_cabang').chained('#filter_kategori_gereja');
        })

        $('#tambahPendeta').on('click', function() {
            titleAction('Form Tambah Pendeta', base_url('superadmin/database/database-jemaat'))
        })

        $('#' + modalPendeta).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            setValSelect2(modalPendeta, 'lfk_kategori_pendeta_id', '')
            setVal(modalPendeta, 'nama_pendeta', '')
            setVal(modalPendeta, 'no_sk', '')
            setValSelect2(modalPendeta, 'jenis_kelamin', '')
            setValSelect2(modalPendeta, 'lfk_kategori_gereja_id', '')
            setValSelect2(modalPendeta, 'lfk_cabang_id', '')
            setValSelect2(modalPendeta, 'lfk_kategori_pendeta_id', '')
            setVal(modalPendeta, 'tempat_lahir', '')
            setVal(modalPendeta, 'tanggal_lahir', '')
            setVal(modalPendeta, 'alamat', '')
            setValSelect2(modalPendeta, 'status_pernikahan', '')
            setVal(modalPendeta, 'nama_istri_suami', '')
            setVal(modalPendeta, 'karunia', '')
            setVal(modalPendeta, 'pendidikan_formal', '')
            setVal(modalPendeta, 'pendidikan_non_formal', '')
            setVal(modalPendeta, 'jumlah_anak', '')
            setVal(modalPendeta, 'pekerjaan', '')


            $('#' + modalPendeta + ' #lfk_kategori_pendeta_id' + '-error').hide()
            $('#' + modalPendeta + ' #nama_pendeta' + '-error').hide()
            $('#' + modalPendeta + ' #no_sk' + '-error').hide()
            $('#' + modalPendeta + ' #jenis_kelamin' + '-error').hide()
            $('#' + modalPendeta + ' #lfk_kategori_gereja_id' + '-error').hide()
            $('#' + modalPendeta + ' #lfk_cabang_id' + '-error').hide()
            $('#' + modalPendeta + ' #lfk_kategori_pendeta_id' + '-error').hide()
            $('#' + modalPendeta + ' #tempat_lahir' + '-error').hide()
            $('#' + modalPendeta + ' #tanggal_lahir' + '-error').hide()
            $('#' + modalPendeta + ' #alamat' + '-error').hide()
            $('#' + modalPendeta + ' #status_pernikahan' + '-error').hide()
            $('#' + modalPendeta + ' #nama_istri_suami' + '-error').hide()
            $('#' + modalPendeta + ' #karunia' + '-error').hide()
            $('#' + modalPendeta + ' #pendidikan_formal' + '-error').hide()
            $('#' + modalPendeta + ' #pendidikan_non_formal' + '-error').hide()
            $('#' + modalPendeta + ' #jumlah_anak' + '-error').hide()
            $('#' + modalPendeta + ' #pekerjaan' + '-error').hide()
        })

        function editPendeta(id) {
            titleAction('Edit Pendeta', base_url(`superadmin/database/database-jemaat/${id}`))
            startloading('#' + modalPendeta + ' .modal-dialog')
            var settings = {
                'url': base_url(`api/v1/superadmin/database/database-jemaat/${id}`),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                if(response.data.lfk_status_jemaat_id === '6' || response.data.lfk_status_jemaat_id === '7') {
                    $('#'+modalPendeta+' #no_sk_input').css('display', 'none')
                } else {
                    $('#'+modalPendeta+' #no_sk_input').css('display', 'block')
                    setVal(modalPendeta, 'no_sk', response.data.no_sk)
                }
                setVal(modalPendeta, 'lfk_status_jemaat_id', response.data.lfk_status_jemaat_id)
                setVal(modalPendeta, 'nama', response.data.nama)
                setVal(modalPendeta, 'pekerjaan', response.data.pekerjaan)
                setValSelect2(modalPendeta, 'lfk_kategori_gereja_id', response.data.cabang?.lfk_kategori_gereja_id)
                setValSelect2(modalPendeta, 'lfk_cabang_id', response.data.lfk_cabang_id)
                setVal(modalPendeta, 'pendidikan_formal', response.data.pendidikan_formal)
                setVal(modalPendeta, 'pendidikan_non_formal', response.data.pendidikan_non_formal)
                setValSelect2(modalPendeta, 'jenis_kelamin', response.data.jenis_kelamin)
                setVal(modalPendeta, 'status_pernikahan', response.data.status_pernikahan)
                setVal(modalPendeta, 'tempat_lahir', response.data.tempat_lahir)
                setVal(modalPendeta, 'tanggal_lahir', response.data.tanggal_lahir)
                setVal(modalPendeta, 'no_hp', response.data.no_hp)
                setVal(modalPendeta, 'email', response.data.email)
                setVal(modalPendeta, 'keterampilan', response.data.keterampilan)
                setVal(modalPendeta, 'alamat', response.data.alamat)
                setVal(modalPendeta, 'jumlah_anak', response.data.jumlah_anak)
                setVal(modalPendeta, 'karunia', response.data.karunia)

                stoploading('#' + modalPendeta + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalPendeta + ' .modal-dialog')
            });
        }

        function deletePendeta(id) {
            delConf(base_url('superadmin/database/database-jemaat/'+id+'/hapus'))
        }

        function detailPendeta(id) {
            console.log('edit pendeta')

        }

        function titleAction(title, action) {
            $('#' + modalPendeta + ' .modal-title').html(title)
            $('#' + modalPendeta + ' #' + formPendeta).attr('action', action)
        }

        function PendetaValidation(id) {
            $('#' + id).validate({
                rules: {
                    nama: {
                        required: true
                    },
                    kategori: {
                        required: true
                    },
                    no_sk: {
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
                    cabang: {
                        required: true
                    },
                    alamat: {
                        required: true
                    },
                },
                messages: {
                    nama: {
                        required: 'Nama tidak boleh kosong'
                    },
                    kategori: {
                        required: 'Kategori tidak boleh kosong'
                    },
                    no_sk: {
                        required: 'No SK tidak boleh kosong'
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
                    cabang: {
                        required: 'Cabang tidak boleh kosong'
                    },
                    alamat: {
                        required: 'Alamat tidak boleh kosong'
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
