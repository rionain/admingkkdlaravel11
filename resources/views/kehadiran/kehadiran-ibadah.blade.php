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
                            <h4 class="page-title">Kehadiran Ibadah</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    {{-- <div class="m-b-30"> --}}
                                    <button id="tambahIbadah" class="btn btn-success waves-effect waves-light"
                                        data-toggle="modal" data-target="#kehadiranIbadah">{{ addText() }} <i
                                            class="mdi mdi-plus-circle-outline"></i></button>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-sm-6">
                                    {{-- <div class="m-b-30"> --}}
                                    <form action="" id="formCariKehadiranIbadah">
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
                                        <div class="row">
                                            <div class="col-md-4" style="margin-top: 10px;">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" name="tgl_awal" id="tgl_awal"
                                                            class="form-control" placeholder="Tanggal mulai"
                                                            value="{{ request('tgl_awal') }}" readonly>
                                                        <span class="input-group-addon bg-custom b-0"><i
                                                                class="mdi mdi-calendar text-white"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 text-center" style="margin-top: 10px;">
                                                <div style="margin-top: 10px !important;">
                                                    -
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="margin-top: 10px;">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" name="tgl_akhir" id="tgl_akhir"
                                                            class="form-control" placeholder="Tanggal akhir"
                                                            value="{{ request('tgl_akhir') }}" readonly>
                                                        <span class="input-group-addon bg-custom b-0"><i
                                                                class="mdi mdi-calendar text-white"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- </div> --}}
                                </div>
                            </div>

                            <table class="{{ styletable() }}" id="datatable-absibadah">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Kategori Gereja</th>
                                        <th class="text-center">Gereja</th>
                                        <th class="text-center">Ibadah</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Jumlah Pria</th>
                                        <th class="text-center">Jumlah Wanita</th>
                                        <th class="text-center">Jumlah Pria Baru</th>
                                        <th class="text-center">Jumlah Wanita Baru</th>
                                        <th class="text-center">Persembahan</th>
                                        <th class="text-center table-action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_jemaat = 0;
                                        $total_pria = 0;
                                        $total_wanita = 0;
                                        $total_pria_baru = 0;
                                        $total_wanita_baru = 0;
                                    @endphp
                                    @foreach ($kehadiran as $key => $value)
                                        @php
                                            $total_jemaat += $value->jumlah_pria + $value->jumlah_wanita + $value->jumlah_pria_baru + $value->jumlah_wanita_baru;
                                            $total_pria += $value->jumlah_pria;
                                            $total_wanita += $value->jumlah_wanita;
                                            $total_pria_baru += $value->jumlah_pria_baru;
                                            $total_wanita_baru += $value->jumlah_wanita_baru;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>{{ @$value->kategori_gereja }}</td>
                                            <td>{{ @$value->nama_cabang }}</td>
                                            <td>{{ @$value->nama_ibadah }}</td>
                                            <td class="text-center">{{ format_date($value->tanggal, 'd F Y') }}</td>
                                            <td class="text-right">{{ format_angka($value->jumlah_pria) ?: 0 }}</td>
                                            <td class="text-right">{{ format_angka($value->jumlah_wanita) ?: 0 }}
                                            </td>
                                            <td class="text-right">{{ format_angka($value->jumlah_pria_baru) ?: 0 }}
                                            </td>
                                            <td class="text-right">
                                                {{ format_angka($value->jumlah_wanita_baru) ?: 0 }}</td>
                                            <td class="text-right">Rp. {{ format_angka($value->persembahan ?: 0) }}
                                            </td>
                                            <td class="actions table-action text-center">
                                                <a href="#" class="btn btn-primary btn-action" data-toggle="modal"
                                                    data-target="#modalDetailIbadah"
                                                    onclick="detailKehadiranIbadah('{{ $value->ibadah_detail_id }}')">
                                                    <i class="fa fa-eye"></i> {{ detailText() }}
                                                </a>
                                                <a href="#" class="btn btn-warning btn-action" data-toggle="modal"
                                                    data-target="#kehadiranIbadah"
                                                    onclick="editKehadiranIbadah('{{ $value->ibadah_detail_id }}')">
                                                    <i class="fa fa-pencil"></i> {{ editText() }}
                                                </a>
                                                <a href="#" class="btn btn-danger btn-action"
                                                    onclick="delConf('{{ url('superadmin/kehadiran/ibadah/hapus/' . $value->ibadah_detail_id) }}')">
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
                                            <th>Total Jemaat</th>
                                            <td>:</td>
                                            <td>{{ format_angka($total_jemaat) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Pria</th>
                                            <td>:</td>
                                            <td>{{ format_angka($total_pria) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Wanita</th>
                                            <td>:</td>
                                            <td>{{ format_angka($total_wanita) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Pria baru</th>
                                            <td>:</td>
                                            <td>{{ format_angka($total_pria_baru) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Wanita baru</th>
                                            <td>:</td>
                                            <td>{{ format_angka($total_wanita_baru) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Gereja</th>
                                            <td>:</td>
                                            <td>
                                                {{ format_angka($kehadiran->groupBy('lfk_cabang_id')->count()) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end: page -->

                    </div> <!-- end Panel -->
                </div>

                <div id="kehadiranIbadah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true"></button>
                                <h4 class="modal-title">Tambah Kehadiran Ibadah</h4>
                            </div>
                            <form action="{{ url('/superadmin/kehadiran/ibadah') }}" method="POST"
                                enctype="multipart/form-data" id="formKehadiranIbadah">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="lfk_kategori_gereja_id" class="control-label">Pilih Kategori
                                            Gereja</label>
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
                                        <label for="lfk_cabang_id" class="control-label">Cabang</label>
                                        <select class="form-control" id="lfk_cabang_id" name="lfk_cabang_id">
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="lfk_ibadah_id" class="control-label">Ibadah</label>
                                                <select class="form-control" id="lfk_ibadah_id" name="lfk_ibadah_id">
                                                    <option value="">Pilih ibadah</option>
                                                    @foreach ($ibadah as $item)
                                                        <option value="{{ $item->ibadah_id }}"
                                                            data-chained="{{ $item->lfk_cabang_id }}"
                                                            {{ old('lfk_ibadah_id') == $item->ibadah_id ? 'selected' : '' }}>
                                                            {{ $item->nama_ibadah }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tanggal" class="control-label">Taggal</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_pria" class="control-label">Jumlah
                                                    pria</label>
                                                <input type="number" class="form-control" id="jumlah_pria"
                                                    name="jumlah_pria" minlength="1" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_wanita" class="control-label">Jumlah
                                                    wanita</label>
                                                <input type="number" class="form-control" id="jumlah_wanita"
                                                    name="jumlah_wanita" minlength="1" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_pria_baru" class="control-label">Jumlah
                                                    pria baru</label>
                                                <input type="number" class="form-control" id="jumlah_pria_baru"
                                                    name="jumlah_pria_baru" minlength="1" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_wanita_baru" class="control-label">Jumlah
                                                    wanita baru</label>
                                                <input type="number" class="form-control" id="jumlah_wanita_baru"
                                                    name="jumlah_wanita_baru" minlength="1" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="persembahan" class="control-label">Persembahan (Nominal)</label>
                                        <input type="text" class="form-control autogrow" id="persembahan"
                                            name="persembahan" placeholder="Rp. 0" onkeypress="return hanyaAngka(event)">
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="catatan" class="control-label">Catatan</label>
                                        <textarea class="form-control autogrow" id="catatan" name="catatan" placeholder="Alamat atau deskripsi instansi.."
                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="jumlah_pendeta" class="control-label">Jumlah pendeta</label>
                                        <input type="number" minlength="1" class="form-control autogrow"
                                            id="jumlah_pendeta" name="jumlah_pendeta" placeholder="0">
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="jumlah_pendeta_muda" class="control-label">Jumlah pendeta muda</label>
                                        <input type="number" minlength="1" class="form-control autogrow"
                                            id="jumlah_pendeta_muda" name="jumlah_pendeta_muda" placeholder="0">
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="jumlah_evangelis" class="control-label">Jumlah evangelis</label>
                                        <input type="number" minlength="1" class="form-control autogrow"
                                            id="jumlah_evangelis" name="jumlah_evangelis" placeholder="0">
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="tempat_ibadah" class="control-label">Tempat ibadah</label>
                                        <select name="tempat_ibadah" id="tempat_ibadah" class="form-control">
                                            <option value="">Pilih Tempat Ibadah</option>
                                            <option value="P">Permanen</option>
                                            <option value="SP">Semi Permanen</option>
                                            <option value="K">Kontrak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect"
                                        data-dismiss="modal">Tutup</button>
                                    {{-- <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button> --}}
                                    <div class="btn btn-success waves-effect waves-light" onclick="submitForm()">Simpan
                                    </div>
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
                                <h4 class="modal-title">Detail Kehadiran Ibadah</h4>
                            </div>
                            <div class="modal-body text-sm mx-2">
                                <table class="table table-sm table-borderless table-hover">
                                    <tr>
                                        <th>Kategori Gereja</th>
                                        <td>:</td>
                                        <td id="kategori_gereja">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Gereja</th>
                                        <td>:</td>
                                        <td id="cabang">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Ibadah</th>
                                        <td>:</td>
                                        <td id="ibadah">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>:</td>
                                        <td id="tanggal">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pria</th>
                                        <td>:</td>
                                        <td id="jumlah_pria">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Wanita</th>
                                        <td>:</td>
                                        <td id="jumlah_wanita">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pria baru</th>
                                        <td>:</td>
                                        <td id="jumlah_pria_baru">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Wanita Baru</th>
                                        <td>:</td>
                                        <td id="jumlah_wanita_baru">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Persembahan</th>
                                        <td>:</td>
                                        <td id="persembahan">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Catatan</th>
                                        <td>:</td>
                                        <td id="catatan">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendeta</th>
                                        <td>:</td>
                                        <td id="pendeta">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendeta Muda</th>
                                        <td>:</td>
                                        <td id="pendeta_muda">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Evangelis</th>
                                        <td>:</td>
                                        <td id="evangelis">{!! kosong() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Ibadah</th>
                                        <td>:</td>
                                        <td id="tempat_ibadah">{!! kosong() !!}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                {!! modalFooterDetailZircos() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->


    </div>
@endsection

@section('script')
    <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>

    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
    <script>
        $(document).ready(function() {
            setSelect2('filter_cabang');
            setSelect2('filter_kategori_gereja');
            $('#filter_cabang').chained('#filter_kategori_gereja');

            $('#datatable-absibadah').DataTable();
            $(`#lfk_cabang_id`).chained(`#lfk_kategori_gereja_id`);
            $(`#lfk_ibadah_id`).chained(`#lfk_cabang_id`);

            setSelect2('lfk_kategori_gereja_id')
            setSelect2('lfk_cabang_id')
            setSelect2('lfk_ibadah_id')
            $('#' + formCariKehadiranIbadah + ' #tgl_awal').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
            $('#' + formCariKehadiranIbadah + ' #tgl_akhir').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
        });

        const modalKehadiranIbadah = 'kehadiranIbadah'
        const formKehadiranIbadah = 'formKehadiranIbadah'
        const formCariKehadiranIbadah = 'formCariKehadiranIbadah'
        const modalDetailIbadah = 'modalDetailIbadah'

        $(function() {
            KehadiranIbadahValidation(formKehadiranIbadah)
        })

        $('#' + modalKehadiranIbadah + ' #persembahan').on('input', function() {
            if ($('#' + modalKehadiranIbadah + ' #persembahan').val() === '' || $('#' + modalKehadiranIbadah +
                    ' #persembahan').val() === null || $('#' + modalKehadiranIbadah + ' #persembahan').val() ===
                'Rp. ') {
                $('#' + modalKehadiranIbadah + ' #persembahan').val('')
            } else {
                $('#' + modalKehadiranIbadah + ' #persembahan').val(formatRupiah($('#' + modalKehadiranIbadah +
                    ' #persembahan').val()))
            }
        })

        $('#tambahIbadah').on('click', function() {
            titleAction('Tambah Kehadiran Ibadah', base_url('superadmin/kehadiran/ibadah'))
        })

        $('#' + modalKehadiranIbadah).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            setValSelect2(modalKehadiranIbadah, 'lfk_kategori_gereja_id', '')
            setValSelect2(modalKehadiranIbadah, 'lfk_cabang_id', '')
            setValSelect2(modalKehadiranIbadah, 'lfk_ibadah_id', '')
            setVal(modalKehadiranIbadah, 'tanggal', '')
            setVal(modalKehadiranIbadah, 'jumlah_pria', '')
            setVal(modalKehadiranIbadah, 'jumlah_wanita', '')
            setVal(modalKehadiranIbadah, 'jumlah_wanita', '')
            setVal(modalKehadiranIbadah, 'jumlah_pria_baru', '')
            setVal(modalKehadiranIbadah, 'jumlah_wanita_baru', '')
            setVal(modalKehadiranIbadah, 'persembahan', '')
            setVal(modalKehadiranIbadah, 'catatan', '')
            setVal(modalKehadiranIbadah, 'jumlah_pendeta', '')
            setVal(modalKehadiranIbadah, 'jumlah_pendeta_muda', '')
            setVal(modalKehadiranIbadah, 'jumlah_evangelis', '')
            setValSelect2(modalKehadiranIbadah, 'tempat_ibadah', '')
        })

        $('#' + modalDetailIbadah).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            setHtmlVal(modalDetailIbadah, 'cabang', kosong())
            setHtmlVal(modalDetailIbadah, 'sub_cabang', kosong())
            setHtmlVal(modalDetailIbadah, 'ibadah', kosong())
            setHtmlVal(modalDetailIbadah, 'tanggal', kosong())
            setHtmlVal(modalDetailIbadah, 'jumlah_pria', kosong())
            setHtmlVal(modalDetailIbadah, 'jumlah_wanita', kosong())
            setHtmlVal(modalDetailIbadah, 'jumlah_pria_baru', kosong())
            setHtmlVal(modalDetailIbadah, 'jumlah_wanita_baru', kosong())
            setHtmlVal(modalDetailIbadah, 'persembahan', kosong())
            setHtmlVal(modalDetailIbadah, 'kakak_pa', kosong())
            setHtmlVal(modalDetailIbadah, 'pendeta', kosong())
            setHtmlVal(modalDetailIbadah, 'pendeta_muda', kosong())
            setHtmlVal(modalDetailIbadah, 'evangelis', kosong())
            setHtmlVal(modalDetailIbadah, 'tempat_ibadah', kosong())
            setHtmlVal(modalDetailIbadah, 'catatan', kosong())
            setHtmlVal(modalKehadiranIbadah, 'jumlah_pendeta', kosong())
            setHtmlVal(modalKehadiranIbadah, 'jumlah_pendeta_muda', kosong())
            setHtmlVal(modalKehadiranIbadah, 'jumlah_evangelis', kosong())
            setHtmlVal(modalKehadiranIbadah, 'tempat_ibadah', kosong())
        })

        function editKehadiranIbadah(id) {
            titleAction('Edit Kehadiran Ibadah', base_url('superadmin/kehadiran/ibadah/edit/' + id))
            startloading('#' + modalKehadiranIbadah + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/superadmin/kehadiran/ibadah/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                setValSelect2(modalKehadiranIbadah, 'lfk_kategori_gereja_id', response.data.ibadah.cabang
                    .lfk_kategori_gereja_id)
                setValSelect2(modalKehadiranIbadah, 'lfk_cabang_id', response.data.ibadah.cabang.cabang_id)
                setValSelect2(modalKehadiranIbadah, 'lfk_ibadah_id', response.data.ibadah.ibadah_id)
                setVal(modalKehadiranIbadah, 'tanggal', response.data.tanggal)
                setVal(modalKehadiranIbadah, 'jumlah_pria', response.data.jumlah_pria)
                setVal(modalKehadiranIbadah, 'jumlah_wanita', response.data.jumlah_wanita)
                setVal(modalKehadiranIbadah, 'jumlah_pria_baru', response.data.jumlah_pria_baru)
                setVal(modalKehadiranIbadah, 'jumlah_wanita_baru', response.data.jumlah_wanita_baru)
                setVal(modalKehadiranIbadah, 'persembahan', formatRupiah(response.data.persembahan))

                setVal(modalKehadiranIbadah, 'catatan', response.data.catatan)

                setVal(modalKehadiranIbadah, 'jumlah_pendeta', response.data.jumlah_pendeta)
                setVal(modalKehadiranIbadah, 'jumlah_pendeta_muda', response.data.jumlah_pendeta_muda)
                setVal(modalKehadiranIbadah, 'jumlah_evangelis', response.data.jumlah_evangelis)
                setValSelect2(modalKehadiranIbadah, 'tempat_ibadah', response.data.tempat_ibadah)

                stoploading('#' + modalKehadiranIbadah + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                console.log('data: ' + data)
                console.log('status: ' + status)
                console.log('error: ' + error)
                // stoploading('#'+modalKehadiranIbadah+' .modal-dialog')
                if (status == 'timeout') {
                    CekKonfirmasi('Timeout!', '')
                } else if (data.responseJSON.status == false) {
                    CekKonfirmasi(data.responseJSON.message, '')
                }
            });
        }

        function deleteKehadiranIbadah(id) {
            delConf(base_url(''))
        }

        function detailKehadiranIbadah(id) {
            startloading('#' + modalDetailIbadah + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/superadmin/kehadiran/ibadah/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                setHtmlVal(modalDetailIbadah, 'kategori_gereja', response?.data?.ibadah?.cabang?.kategori_gereja
                    ?.kategori_gereja)
                setHtmlVal(modalDetailIbadah, 'cabang', response.data.ibadah.cabang.nama_cabang)
                setHtmlVal(modalDetailIbadah, 'ibadah', response.data.ibadah.nama_ibadah)
                setHtmlVal(modalDetailIbadah, 'tanggal', response.data.tanggal)
                setHtmlVal(modalDetailIbadah, 'jumlah_pria', response.data.jumlah_pria)
                setHtmlVal(modalDetailIbadah, 'jumlah_wanita', response.data.jumlah_wanita)
                setHtmlVal(modalDetailIbadah, 'jumlah_pria_baru', response.data.jumlah_pria_baru)
                setHtmlVal(modalDetailIbadah, 'jumlah_wanita_baru', response.data.jumlah_wanita_baru)
                setHtmlVal(modalDetailIbadah, 'persembahan', formatRupiah(response.data.persembahan))
                setHtmlVal(modalDetailIbadah, 'pendeta', response.data.jumlah_pendeta)
                setHtmlVal(modalDetailIbadah, 'pendeta_muda', response.data.jumlah_pendeta_muda)
                setHtmlVal(modalDetailIbadah, 'evangelis', response.data.jumlah_evangelis)
                setHtmlVal(modalDetailIbadah, 'tempat_ibadah', response.data.tempat_ibadah)
                setHtmlVal(modalDetailIbadah, 'catatan', response.data.catatan)
                stoploading('#' + modalDetailIbadah + ' .modal-dialog')

            }).
            fail(function(data, status, error) {
                console.log('data: ' + data)
                console.log('status: ' + status)
                console.log('error: ' + error)
                stoploading('#' + modalDetailIbadah + ' .modal-dialog')
                if (status == 'timeout') {
                    CekKonfirmasi('Timeout!', '')
                } else if (data.responseJSON.status == false) {
                    CekKonfirmasi(data.responseJSON.message, '')
                }
            });
        }

        function titleAction(title, action) {
            $('#' + modalKehadiranIbadah + ' .modal-title').html(title)
            $('#' + modalKehadiranIbadah + ' #' + formKehadiranIbadah).attr('action', action)
        }

        function KehadiranIbadahValidation(id) {

        }

        function submitForm() {
            $('#' + modalKehadiranIbadah + ' #persembahan').val(removeSpace($('#' + modalKehadiranIbadah + ' #persembahan')
                .val()))
            $('#' + modalKehadiranIbadah + ' #' + formKehadiranIbadah).submit()
        }
    </script>
@endsection
