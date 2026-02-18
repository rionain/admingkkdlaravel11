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
                            <h4 class="page-title">Kehadiran Komsel</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            <div id="kehadiranKomsel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Kehadiran Komsel</h4>
                                        </div>
                                        <form action="{{ url('/superadmin/kehadiran/komsel') }}" method="POST" enctype="multipart/form-data" id="form-kehadiran-komsel">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group no-margin">
                                                    <label for="lfk_komsel_id" class="control-label">Komsel</label>
                                                    <select class="form-control" id="lfk_komsel_id" name="lfk_komsel_id">
                                                        <option value="">Pilih komsel</option>
                                                        @foreach ($komsel as $item)
                                                            <option value="{{ $item->komsel_id }}"
                                                                {{ $item->komsel_id == old('lfk_komsel_id') ? 'selected' : '' }}>{{ $item->nama_komsel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="komsel_date" class="control-label">Tanggal Komsel</label>
                                                    <input type="date" class="form-control autogrow" id="komsel_date"
                                                        name="komsel_date"
                                                        value="{{ old('komsel_date') ?: date('Y-m-d') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="jumlah_pria" class="control-label">Jumlah Pria</label>
                                                    <input type="number" min="0" minlength="1" class="form-control autogrow" id="jumlah_pria" name="jumlah_pria" placeholder="Jumlah Pria" value="{{ old('jumlah_pria') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="jumlah_wanita" class="control-label">Jumlah Wanita</label>
                                                    <input type="number" min="0" minlength="1" class="form-control autogrow" id="jumlah_wanita" name="jumlah_wanita"  placeholder="Jumlah Wanita" value="{{ old('jumlah_wanita') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="jumlah_pria_baru" class="control-label">Jumlah Pria Baru</label>
                                                    <input type="number" min="0" minlength="1" class="form-control autogrow" id="jumlah_pria_baru" name="jumlah_pria_baru" placeholder="Jumlah Pria Baru" value="{{ old('jumlah_pria_baru') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="jumlah_wanita_baru" class="control-label">Jumlah Wanita Baru</label>
                                                    <input type="number" min="0" minlength="1" class="form-control autogrow" id="jumlah_wanita_baru" name="jumlah_wanita_baru" placeholder="Jumlah Wanita Baru" value="{{ old('jumlah_wanita_baru') }}">
                                                </div>
                                                <div class="form-group no-margin">
                                                    <label for="catatan" class="control-label">Catatan</label>
                                                    <textarea class="form-control autogrow" id="catatan" name="catatan">{{ old('catatan') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <button id="tambahKomsel" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#kehadiranKomsel">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                                </div>
                                <div class="col-sm-6">
                                    <form action="" id="formCariKehadiranKomsel">
                                        <div class="row ">
                                            <div class="col-sm-4">
                                                <select id="filter_kategori_gereja" class="form-control" name="filter_kategori_gereja">
                                                    <option value="">Pilih kategori gereja</option>
                                                    @foreach ($kategori_gereja as $item)
                                                        <option value="{{ $item->kategori_gereja_id }}"
                                                            {{ request('filter_kategori_gereja') == $item->kategori_gereja_id ? 'selected' : '' }}> {{ $item->kategori_gereja }}
                                                        </option>
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
                                </div>
                            </div>

                            <div class="" style="overflow: auto">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-abskomsel">
                                    <thead>
                                        <tr>
                                            <th class="text-center table-number">No</th>
                                            <th class="text-center">Kategori Gereja</th>
                                            <th class="text-center">Gereja</th>
                                            <th class="text-center">Komsel</th>
                                            <th class="text-center">Tanggal Komsel</th>
                                            <th class="text-center">Jumlah Pria</th>
                                            <th class="text-center">Jumlah Wanita</th>
                                            <th class="text-center">Jumlah Pria Baru</th>
                                            <th class="text-center">Jumlah Wanita Baru</th>
                                            <th class="text-center">Catatan</th>
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
                                                <td>{{ $value->nama_komsel }}</td>
                                                <td class="text-center">{{ $value->komsel_date }}</td>
                                                <td class="text-center">{{ $value->jumlah_pria }}</td>
                                                <td class="text-center">{{ $value->jumlah_wanita }}</td>
                                                <td class="text-center">{{ $value->jumlah_pria_baru }}</td>
                                                <td class="text-center">{{ $value->jumlah_wanita_baru }}</td>
                                                <td>{{ $value->catatan }}</td>
                                                <td class="text-center table-action">
                                                    <a href="#" class="btn btn-warning btn-action" data-toggle="modal"
                                                        data-target="#kehadiranKomsel"
                                                        onclick="editKehadiranKomsel('{{ $value->komsel_detail_id }}')">
                                                        <i class="fa fa-pencil"></i> {{ edittext() }}
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-action"
                                                        onclick="delConf(`{{ url('superadmin/kehadiran/komsel/hapus/' . $value->komsel_detail_id) }}`)">
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
                                                <td>{{ $total_jemaat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Pria</th>
                                                <td>:</td>
                                                <td>{{ $total_pria }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Wanita</th>
                                                <td>:</td>
                                                <td>{{ $total_wanita }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Pria baru</th>
                                                <td>:</td>
                                                <td>{{ $total_pria_baru }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Wanita baru</th>
                                                <td>:</td>
                                                <td>{{ $total_wanita_baru }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Gereja</th>
                                                <td>:</td>
                                                <td>{{ $kehadiran->groupBy('lfk_cabang_id')->count() }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    {{-- <script src="{{ asset('assets/pages/jquery.datatables.abskomsel.init.js') }}"></script> --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
    <script>
        setSelect2('lfk_komsel_id')
        $('#filter_sub_cabang').chained('#filter_cabang');
        $('#datatable-abskomsel').DataTable();
    </script>

    <script>
        const kehadiranKomsel = 'kehadiranKomsel';
        const formKehadiranKomsel = 'form-kehadiran-komsel';
        const formCariKehadiranKomsel = 'formCariKehadiranKomsel';

        $(document).ready(function() {
            $('#' + formCariKehadiranKomsel + ' #tgl_awal').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
            $('#' + formCariKehadiranKomsel + ' #tgl_akhir').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
        })

        $('#tambahKomsel').on('click', function() {
            titleAction('Form Tambah', base_url( 'superadmin/kehadiran/komsel'))
        });

        $('#' + kehadiranKomsel).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            tutupModal(kehadiranKomsel, 'lfk_komsel_id')
            tutupModal(kehadiranKomsel, 'komsel_date')
            tutupModal(kehadiranKomsel, 'jumlah_pria')
            tutupModal(kehadiranKomsel, 'jumlah_wanita')
            tutupModal(kehadiranKomsel, 'jumlah_pria_baru')
            tutupModal(kehadiranKomsel, 'jumlah_wanita_baru')
            tutupModal(kehadiranKomsel, 'catatan')
            $('.selectpicker').selectpicker('refresh')
        });

        function editKehadiranKomsel(id) {
            titleAction('Form Edit', base_url('superadmin/kehadiran/komsel/' + id))
            startloading('#' + kehadiranKomsel + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/superadmin/kehadiran/komsel/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                console.log(response.data)
                setValSelect2(kehadiranKomsel, 'lfk_komsel_id', response.data.lfk_komsel_id)
                setVal(kehadiranKomsel, 'komsel_date', response.data.komsel_date)
                setVal(kehadiranKomsel, 'jumlah_pria', response.data.jumlah_pria)
                setVal(kehadiranKomsel, 'jumlah_wanita', response.data.jumlah_wanita)
                setVal(kehadiranKomsel, 'jumlah_pria_baru', response.data.jumlah_pria_baru)
                setVal(kehadiranKomsel, 'jumlah_wanita_baru', response.data.jumlah_wanita_baru)
                setVal(kehadiranKomsel, 'catatan', response.data.catatan)

                $('.selectpicker').selectpicker('refresh')
                stoploading('#' + kehadiranKomsel + ' .modal-dialog')
            }).fail(function(data, status, error) {
                // console.log('data: '+data)
                // console.log('status: '+status)
                // console.log('error: '+error)
                // if(status == 'timeout'){
                //     CekKonfirmasi('Timeout!', '')
                // } else if(data.responseJSON.status == false){
                //     CekKonfirmasi(data.responseJSON.message, '')
                // }
                stoploading('#' + kehadiranKomsel + ' .modal-dialog')
            });
        }

        function titleAction(title, action) {
            $('#' + kehadiranKomsel + ' .modal-title').html(title)
            $('#' + kehadiranKomsel + ' #' + formKehadiranKomsel).attr('action', action)
        }

        function tutupModal(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>
@endsection
