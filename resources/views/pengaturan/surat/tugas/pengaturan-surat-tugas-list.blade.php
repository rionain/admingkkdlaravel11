@extends('layouts.layout')

@section('css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Body Surat</h4>
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
                                    <div class="m-b-30">
                                        <a href="{{ url('superadmin/pengaturan/surat/tugas/tambah') }}"
                                            class="btn btn-success waves-effect waves-light">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <table class="{{ styletable() }}" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Nama Pengaturan</th>
                                        <th class="text-center" width="300px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaturan as $key => $item)
                                        <tr class="">
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td class="text-left">{{ $item->nama_pengaturan }}</td>
                                            <td class="actions text-center">
                                                {{-- <div class="btn-group btn-group-justified m-b-10 text-center"> --}}
                                                <a href="{{ url("superadmin/pengaturan/surat/tugas/$item->pengaturan_surat_tugas_id/lihat") }}"
                                                    target="_blank" class="btn btn-primary btn-action text-white">
                                                    <i class="fa fa-eye text-white"></i> Lihat contoh
                                                </a>
                                                <a href="{{ url("superadmin/pengaturan/surat/tugas/$item->pengaturan_surat_tugas_id/edit") }}"
                                                    class="btn btn-warning btn-action text-white">
                                                    <i class="fa fa-pencil text-white"></i> {{ editText() }}
                                                </a>
                                                <a href="{{ url("superadmin/pengaturan/surat/tugas/$item->pengaturan_surat_tugas_id/hapus", []) }}"
                                                    class="btn btn-danger waves-effect waves-light btn-action"
                                                    onclick="return confirm('Apakah anda yakin?')">
                                                    <i class="fa fa-trash"></i> {{ deletetext() }}
                                                </a>
                                                {{-- </div> --}}
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
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

    <script>
        $('#datatable').DataTable({});
    </script>
@endsection
