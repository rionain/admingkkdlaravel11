@extends('layouts.layout')


@section('css')
    <link href="{{ asset('plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Report Komsel</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            {{-- @include('errorhandler')

                            <div id="reportModal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Report</h4>
                                        </div>
                                        <form
                                            action="{{ url('/superadmin/administrasi/pengaturan/kop-surat/tambah-kop') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nama_report_surat" class="control-label">Nama
                                                                Report</label>
                                                            <input type="text" class="form-control" id="nama_report_surat"
                                                                name="nama_report_surat" placeholder="Nama Report..">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fieldTitleHeader" class="control-label">Title
                                                                Header</label>
                                                            <input type="text" class="form-control" id="fieldTitleHeader"
                                                                name="fieldTitleHeader"
                                                                placeholder="Nama Instansi, Nama Organisasi..">
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="fieldHeaderDescription" class="control-label">Header
                                                                Description</label>
                                                            <textarea class="form-control autogrow"
                                                                id="fieldHeaderDescription" name="fieldHeaderDescription"
                                                                placeholder="Alamat atau deskripsi instansi.."
                                                                style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-10">
                                                    <div class="form-group clearfix">
                                                        <label>Logo Report</label>
                                                        <div class="col-sm-12 padding-left-0 padding-right-0">
                                                            <input id="fileReport" type="file" class="filestyle"
                                                                name="fileReport" data-buttonname="btn-primary">
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
                            </div> --}}
                            <div class="m-b-30">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">Dari</span>
                                                <input type="date" name="dari" id="dari" class="form-control"
                                                    value="{{ request('dari') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon2">Sampai</span>
                                                <input type="date" name="sampai" id="sampai" class="form-control"
                                                    min="{{ request('dari') }}" value="{{ request('sampai') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">Komsel</span>
                                                <select name="komsel" id="komsel" class="form-control">
                                                    <option value="">Pilih komsel</option>
                                                    @foreach ($komsel as $item)
                                                        <option value="{{ $item->komsel_id }}"
                                                            {{ request('komsel') == $item->komsel_id ? 'selected' : '' }}>
                                                            {{ $item->nama_komsel }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 100%;margin-top: 20px;text-align: center">
                                        <div class="btn-group">
                                            @if (request('dari') || request('sampai'))
                                                <a href="{{ url('superadmin/report/komsel', []) }}"
                                                    class="btn btn-default"><i class="fa fa-refresh"></i></a>
                                            @endif
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-search"></i></button>
                                            @if (request('dari') || request('sampai'))
                                                <a href="{{ url('superadmin/report/komsel/export?komsel=' . request('komsel') . '&dari=' . request('dari') . '&sampai=' . request('sampai')) }}"
                                                    class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                    Export</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- End Modal Template --}}
                            @if (request('dari') || request('sampai') || request('komsel'))
                                <div class="">
                                    <table class="table table-striped add-edit-table table-bordered" id="datatable-komsel">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Gereja</th>
                                                <th>Gereja</th>
                                                <th>Komsel</th>
                                                <th>Tanggal Komsel</th>
                                                <th>Jumlah Pria</th>
                                                <th>Jumlah Wanita</th>
                                                <th>Jumlah Pria Baru</th>
                                                <th>Jumlah Wanita Baru</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($report as $key => $value)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ @$value->komsel->cabang->nama_cabang }}</td>
                                                    <td>{{ @$value->komsel->cabang->kategori_gereja->kategori_gereja }}
                                                    </td>
                                                    <td>{{ @$value->komsel->nama_komsel }}</td>
                                                    <td>{{ $value->komsel_date }}</td>
                                                    <td>{{ $value->jumlah_pria }}</td>
                                                    <td>{{ $value->jumlah_wanita }}</td>
                                                    <td>{{ $value->jumlah_pria_baru }}</td>
                                                    <td>{{ $value->jumlah_wanita_baru }}</td>
                                                    <td>{{ $value->catatan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <!-- end: page -->

                    </div> <!-- end Panel -->
                </div>
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
    <script src="{{ url('assets/pages/jquery.fileuploads.init.js') }}"></script>
    <script src="{{ url('/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>


    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
    <script>
        $(document).ready(function() {
            setSelect2('komsel');

            $('#datatable-komsel').DataTable();
            $('#dari').change((e) => {
                $('#sampai').attr('min', $('#dari').val());
            });
        });
    </script>
@endsection
