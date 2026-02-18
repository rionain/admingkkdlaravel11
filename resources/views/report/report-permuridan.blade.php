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
                            <h4 class="page-title">Report Permuridan</h4>
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
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon2">Pembimbing PA</span>
                                                <select name="kakakpa" id="kakakpa" class="form-control">
                                                    <option value="">Pilih Pembimbing pa</option>
                                                    @foreach ($kakak_pa as $item)
                                                        <option value="{{ $item->user_id }}"
                                                            {{ request('kakakpa') == $item->user_id ? 'selected' : '' }}>
                                                            {{ $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 100%;margin-top: 20px;text-align: center">
                                        <div class="btn-group">
                                            @if (request('dari') || request('sampai'))
                                                <a href="{{ url('superadmin/report/permuridan', []) }}"
                                                    class="btn btn-default"><i class="fa fa-refresh"></i></a>
                                            @endif
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-search"></i></button>
                                            @if (request('dari') || request('sampai'))
                                                <a href="{{ url('superadmin/report/permuridan/export?dari=' . request('dari') . '&sampai=' . request('sampai') . '&kakakpa=' . request('kakakpa')) }}"
                                                    class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                    Export</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- End Modal Template --}}

                            @if (request('dari') || request('sampai'))
                                <div class="">
                                    <table class="table table-striped add-edit-table table-bordered"
                                        id="datatable-permuridan">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Catatan</th>
                                                <th class="text-center">Kelompok PA</th>
                                                <th class="text-center">Pembimbing PA</th>
                                                <th class="text-center">Bahan PA</th>
                                                <th class="text-center">BAB PA</th>
                                                <th class="text-center">Kategori Gereja</th>
                                                <th class="text-center">Gereja</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($report as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="text-center">{{ $value->catatan }}</td>
                                                    <td class="text-center">
                                                        {{ @$value->kelompok_pa->nama_kelompok }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ @$value->kelompok_pa->kakak_pa->nama }}
                                                    </td>
                                                    <td class="text-center">{{ @$value->bahan_pa->judul }}</td>
                                                    <td class="text-center">{{ @$value->bab_pa->bab_pa_name }}</td>
                                                    <td class="text-center">
                                                        {{ @$value->cabang->kategori_gereja->kategori_gereja }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ @$value->cabang->nama_cabang }}
                                                    </td>
                                                    <td class="text-center">
                                                        {!! $value->tanggal ? format_date($value->tanggal, 'D, d F Y') : '<span class="badge badge-danger">Kosong</span>' !!}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ url("superadmin/report/permuridan/$value->permuridan_id/detail") }}"
                                                                class="btn btn-primary">
                                                                <i class="fa fa-info"></i>
                                                            </a>
                                                        </div>
                                                    </td>
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
        setSelect2('kakakpa');
        $('#datatable-permuridan').DataTable();
        $('#dari').change((e) => {
            $('#sampai').attr('min', $('#dari').val());
        });
    </script>
@endsection
