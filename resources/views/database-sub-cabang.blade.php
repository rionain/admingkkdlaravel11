@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Sub Cabang</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            <a href="{{ url('superadmin/database/database-cabang') }}" class="btn btn-success"><i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                            <div style="margin-top:20px;margin-bottom:20px">
                                <table class="table table-bordered table-striped" style="max-width: 50%">
                                    <tr>
                                        <th width="15%">Kategori</th>
                                        <td>{{ @$cabang->kategori_gereja->kategori_gereja }}</td>
                                    </tr>
                                    <tr>
                                        <th width="15%">Nama cabang</th>
                                        <td><span class="badge badge-success">{{ $cabang->nama_cabang }}</span></td>
                                    </tr>
                                    <tr>
                                        <th width="15%">Info Detail</th>
                                        <td>{!! $cabang->info_detail !!}</td>
                                    </tr>
                                </table>
                            </div>


                            <div class="">
                                <button id="tambahSubCabang" class="btn btn-primary" style="margin-bottom: 20px"
                                    data-toggle="modal" data-target="#modalSubCabang"
                                    onclick="tambahSubCabang('{{ $cabang->cabang_id }}')"><i class="fa fa-plus"></i>
                                    Tambah</button>


                                {{-- ModalSample --}}
                                <div id="modalSubCabang" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <form id="formSubCabang"
                                            action="{{ url("superadmin/database/database-cabang/cabang/$cabang->cabang_id/sub_cabang") }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Cabang</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="lfk_kategori_gereja_id" class="control-label">Pilih Kategori Gereja</label>
                                                                <select id="lfk_kategori_gereja_id" class="form-control" name="lfk_kategori_gereja_id">
                                                                    <option value="">Pilih Kategori Gereja</option>
                                                                    @foreach ($kategori_gereja as $item)
                                                                        <option value="{{ $item->kategori_gereja_id }}"
                                                                            {{ old('lfk_kategori_gereja_id') == $item->kategori_gereja_id ? 'selected' : '' }}>
                                                                            {{ $item->kategori_gereja }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_cabang" class="control-label">Nama Sub Cabang</label>
                                                                <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" placeholder="Nama sub cabang">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="info_detail" class="control-label">Info Detail</label>
                                                                <textarea type="text" class="form-control" name="info_detail" id="info_detail" placeholder="Masukkan info tambahan"></textarea>
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
                                {{-- End Modal --}}

                                <table class="{{ styletable() }}" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center table-number">No</th>
                                            <th class="text-center" width="20%">Nama Sub Cabang</th>
                                            <th class="text-center" width="20%">Kategori</th>
                                            <th class="text-center">Info Detail</th>
                                            <th class="text-center table-action">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub_cabang as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ ++$key }}</td>
                                                <td>{{ @$value->cabang->nama_cabang }}</td>
                                                <td>{{ @$value->cabang->kategori_gereja->kategori_gereja }}</td>
                                                <td>{{ @$value->cabang->info_detail }}</td>
                                                <td class="actions text-center table-action">
                                                    {{-- @if (@$value->cabang->kategori_gereja->kategori_gereja_id == '3')
                                                        <button class="btn btn-success" onclick='confirmAlert("info", "Upgrade Sub Cabang", `{{url("superadmin/database/database-cabang/cabang/$value->lfk_cabang_id/sub_cabang/$value->sub_cabang/upgrade_cabang")}}`, "Upgrade")'>Upgrade</button>
                                                    @else --}}
                                                        <button class="btn btn-success" onclick='confirmAlert("info", "Upgrade Sub Cabang", `{{url("superadmin/database/database-cabang/cabang/$value->lfk_cabang_id/sub_cabang/$value->sub_cabang/upgrade_cabang")}}`, "Upgrade")'> <i class="fa fa-arrow-up"></i> Upgrade</button>
                                                    {{-- @endif --}}
                                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalSubCabang" onclick="editSubCabang('{{ $cabang->cabang_id }}','{{ $value->sub_cabang }}')" title="Edit Body Surat">
                                                        <i class="fa fa-pencil"></i> {{ editText() }}
                                                    </a>
                                                    <a href="#" class="btn btn-danger" onclick='delConf(`{{ url("superadmin/database/database-cabang/cabang/$value->lfk_cabang_id/sub_cabang/$value->sub_cabang_id/hapus") }}`)'>
                                                        <i class="fa fa-trash-o"></i> {{ deleteText() }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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
    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>

    <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>

    {{-- <script src="{{ asset('assets/pages/jquery.datatables.subcabang.init.js') }}"></script> --}}

    <script src="{{ asset('assets/js/subcabang.js') }}"></script>
    <script>
        $(document).ready(function() {
            setSelect2('modalSubCabang #lfk_kategori_gereja_id')
            $('#datatable').DataTable({
                "columns": [{
                        searchable: false
                    },
                    null,
                    {
                        searchable: false
                    },
                    {
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
