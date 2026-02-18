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
                            <h4 class="page-title">Kehadiran Permuridan</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="panel">
                        <div class="panel-body">

                            <div id="kehadiranPermuridan" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Kehadiran Permuridan</h4>
                                        </div>
                                        <form action="{{ url('/admin-cabang/kehadiran/permuridan') }}" method="POST"
                                            enctype="multipart/form-data" id="form-kehadiran-permuridan">
                                            @csrf
                                            <div class="modal-body">
                                                {{-- <div class="form-group">
                                                    <label for="lfk_kategori_gereja_id" class="control-label">Pilih
                                                        Kategori Gereja</label>
                                                    <select id="lfk_kategori_gereja_id" class="form-control"
                                                        name="lfk_kategori_gereja_id" onchange="showAnakPA()">
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
                                                    <select class="form-control" id="lfk_cabang_id" name="lfk_cabang_id"
                                                        onchange="showAnakPA()">
                                                        <option value="">Pilih cabang</option>
                                                        @foreach ($cabang as $item)
                                                            <option value="{{ $item->cabang_id }}"
                                                                data-chained="{{ $item->lfk_kategori_gereja_id }}"
                                                                {{ $item->cabang_id == old('lfk_cabang_id') ? 'selected' : '' }}>
                                                                {{ $item->nama_cabang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="form-group no-margin">
                                                    <label for="kelompok" class="control-label">Kelompok</label>
                                                    <select class="form-control autogrow" id="kelompok" name="kelompok"
                                                        onchange="showAnakPA()">
                                                        <option value="">Pilih kelompok</option>
                                                        @foreach ($kelompok as $item)
                                                            <option value="{{ $item->kelompok_pa_id }}"
                                                                data-chained="{{ $item->lfk_cabang_id }}"
                                                                {{ $item->kelompok_pa_id == old('kelompok') ? 'selected' : '' }}>
                                                                {{ $item->kakak_pa->nama }}
                                                                ({{ $item->nama_kelompok }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="bahan" class="control-label">Bahan</label>
                                                    <select class="form-control autogrow" id="bahan" name="bahan">
                                                        <option value="">Pilih bahan</option>
                                                        @foreach ($bahan as $item)
                                                            <option value="{{ $item->bahan_pa_id }}"
                                                                data-chained="{{ $item->lfk_kelompok_pa_id }}"
                                                                {{ $item->bahan_pa_id == old('bahan') ? 'selected' : '' }}>
                                                                {{ $item->judul }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="bab" class="control-label">BAB</label>
                                                    <select class="form-control autogrow" id="bab" name="bab">
                                                        <option value="" disabled>Pilih bab</option>
                                                        @foreach ($bab as $item)
                                                            <option value="{{ $item->bab_pa_id }}"
                                                                {{ $item->bab_pa_id == old('bab') ? 'selected' : '' }}>
                                                                {{ $item->bab_pa_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="tanggal" class="control-label">Tanggal permuridan</label>
                                                    <input type="date" class="form-control autogrow" id="tanggal"
                                                        name="tanggal" value="{{ old('tanggal') }}">
                                                </div>
                                                <label for="anak_pa" class="control-label">Anak PA</label>
                                                <div class="form-group no-margin" id="checkbox-anakpa">

                                                    {{-- @foreach ($anak_pa as $key => $item)
                                                        <input type="checkbox" name="anak_pa[{{ $key }}]"
                                                            id="anak_pa[{{ $key }}]"
                                                            value="{{ $item->user_id }}">
                                                        <label
                                                            for="anak_pa[{{ $key }}]">{{ $item->nama }}</label><br>
                                                    @endforeach --}}
                                                </div>

                                                <div class="form-group">
                                                    <label for="catatan" class="control-label">Catatan</label>
                                                    <textarea class="form-control autogrow" id="catatan"
                                                        name="catatan">{{ old('catatan') }}</textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-light">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <button id="tambahPermuridan" class="btn btn-success waves-effect waves-light"
                                        data-toggle="modal" data-target="#kehadiranPermuridan">
                                        Add <i class="mdi mdi-plus-circle-outline"></i>
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <form action="" id="formCariKehadiranPemuridan">
                                        <div class="row ">
                                            {{-- <div class="col-sm-4">
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
                                            </div> --}}
                                            {{-- <div class="col-sm-3 text-right">
                                                <button type="submit" class="btn btn-default">Cari</button>
                                                <a href="?" class="btn btn-default">Reset</a>
                                            </div> --}}
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
                                            <div class="col-md-3 text-right" style="margin-top: 10px;">
                                                <button type="submit" class="btn btn-default">Cari</button>
                                                <a href="?" class="btn btn-default">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- </div> --}}
                                </div>
                            </div>

                            <table class="{{ styletable() }}" id="datatable-abspermuridan">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Kelompok PA</th>
                                        <th class="text-center">Bahan PA</th>
                                        <th class="text-center">BAB PA</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Catatan</th>
                                        <th class="text-center table-action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kehadiran as $key => $value)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>{{ @$value->kelompok_pa->nama_kelompok }}</td>
                                            <td>{{ @$value->bahan_pa->judul }}</td>
                                            <td>{{ @$value->bab_pa->bab_pa_name }}</td>
                                            <td class="text-center">
                                                {!! $value->tanggal ? format_date($value->tanggal, 'D, d F Y') : '<span class="badge badge-danger">Kosong</span>' !!}
                                            </td>
                                            <td>{{ $value->catatan }}</td>
                                            <td class="text-center">
                                                <a href="{{ url("admin-cabang/kehadiran/permuridan/$value->permuridan_id/detail") }}"
                                                    class="btn btn-primary btn-action"><i class="fa fa-list"></i>
                                                    List Detail Permuridan
                                                </a>
                                                {{-- <a href="#" class="btn btn-warning btn-action" data-toggle="modal"
                                                    data-target="#kehadiranPermuridan"><i class="fa fa-pencil"></i>
                                                    {{ editText() }}</a> --}}
                                                <a href="#" class="btn btn-danger btn-action"
                                                    onclick="delConf('{{ url('admin-cabang/kehadiran/permuridan/' . $value->permuridan_id . '/hapus') }}')"><i
                                                        class="fa fa-trash"></i> {{ deletetext() }}</a>
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
    <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>

    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('plugins/moment/moment.js') }}"></script>
    {{-- <script src="{{ asset('assets/pages/jquery.datatables.abspermuridan.init.js') }}"></script> --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
    <script>
        setSelect2('filter_cabang');
        setSelect2('filter_kategori_gereja');
        $('#filter_cabang').chained('#filter_kategori_gereja');

        $('#datatable-abspermuridan').DataTable();
        $(`#lfk_cabang_id`).chained(`#lfk_kategori_gereja_id`);
        $('#kelompok').chained('#lfk_cabang_id');

        $(`#lfk_kategori_gereja_id`).select2({
            theme: 'bootstrap'
        });
        $(`#lfk_cabang_id`).select2({
            theme: 'bootstrap'
        });
        $(`#lfk_sub_cabang_id`).select2({
            theme: 'bootstrap'
        });
        $(`#kelompok`).select2({
            theme: 'bootstrap'
        });
        $(`#bahan`).select2({
            theme: 'bootstrap'
        });
        $(`#bab`).select2({
            theme: 'bootstrap'
        });

        showAnakPA()

        function showAnakPA() {
            let kelompok = $('#kelompok').val();
            let bahan = $('#bahan').val();
            let bab = $('#bab').val();

            startloading('#kehadiranPermuridan .modal-dialog')
            $.ajax({
                type: "GET",
                url: `{{ url('api/v1/admin-cabang/kehadiran/permuridan/get-user') }}?kelompok=${kelompok}`,
                dataType: "JSON",
                success: function(response) {
                    let html = ''
                    response.data.map((v, i) => {
                        html += `
                        <input type="checkbox" name="anak_pa[${ i }]" id="anak_pa[${ i }]" value="${ v.user_id }">
                        <label for="anak_pa[${ i }]">${ v.nama }</label><br>
                        `;
                    })
                    $('#checkbox-anakpa').html(html)

                    stoploading('#kehadiranPermuridan .modal-dialog')
                },
                error(e) {
                    console.log(e.responseJSON)

                    stoploading('#kehadiranPermuridan .modal-dialog')
                }
            });
        }
    </script>
    <script>
        const kehadiranPermuridan = 'kehadiranPermuridan';
        const formKehadiranPermuridan = 'form-kehadiran-permuridan';
        const formCariKehadiranPemuridan = 'formCariKehadiranPemuridan';

        $(document).ready(function() {
            $('#' + formCariKehadiranPemuridan + ' #tgl_awal').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
            $('#' + formCariKehadiranPemuridan + ' #tgl_akhir').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
        })

        $('#tambahPermuridan').on('click', function() {
            titleAction('Form Tambah', base_url(
                'admin-cabang/kehadiran/permuridan'))
        });

        $('#' + kehadiranPermuridan).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            tutupModal(kehadiranPermuridan, 'lfk_komsel_id')
        });

        function editKehadiranPermuridan(id) {
            titleAction('Edit Bahan', base_url('admin-cabang/kehadiran/permuridan/' + id))
            startloading('#' + kehadiranPermuridan + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/admin-cabang/kehadiran/permuridan/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                console.log(response.data)
                setVal(kehadiranPermuridan, 'lfk_komsel_id', response.data.lfk_komsel_id)
                stoploading('#' + kehadiranPermuridan + ' .modal-dialog')
            }).fail(function(data, status, error) {
                // console.log('data: '+data)
                // console.log('status: '+status)
                // console.log('error: '+error)
                // if(status == 'timeout'){
                //     CekKonfirmasi('Timeout!', '')
                // } else if(data.responseJSON.status == false){
                //     CekKonfirmasi(data.responseJSON.message, '')
                // }
                stoploading('#' + kehadiranPermuridan + ' .modal-dialog')
            });
        }

        function titleAction(title, action) {
            $('#' + kehadiranPermuridan + ' .modal-title').html(title)
            $('#' + kehadiranPermuridan + ' #' + formKehadiranPermuridan).attr('action', action)
        }

        function tutupModal(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>
@endsection
