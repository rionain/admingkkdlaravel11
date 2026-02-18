@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="page-title-box">
                    <h4 class="page-title">Report Permuridan Detail</h4>
                    @include('breadcrumb')
                    <div class="clearfix"></div>
                </div>
                <!-- end row -->

                <div class="panel">
                    <div class="panel-body">
                        <a href="{{ url('superadmin/report/permuridan') }}" class="btn btn-success"><i
                                class="fa fa-arrow-left"></i>
                            Back</a>

                        <div style="margin-top: 30px">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th width="15%">Kelompok PA</th>
                                    <td>{{ @$permuridan->kelompok_pa->nama_kelompok }}</td>
                                </tr>
                                <tr>
                                    <th width="15%">Bahan PA</th>
                                    <td>{{ @$permuridan->bahan_pa->judul }}</td>
                                </tr>
                                <tr>
                                    <th width="15%">BAB PA</th>
                                    <td>{{ @$permuridan->bab_pa->bab_pa_name }}</td>
                                </tr>
                                <tr>
                                    <th width="15%">Catatan</th>
                                    <td>{{ $permuridan->catatan }}</td>
                                </tr>
                                <tr>
                                    <th width="15%">Cabang</th>
                                    <td>{{ @$permuridan->cabang->nama_cabang }}</td>
                                </tr>
                            </table>
                        </div>

                        <a href="{{ url("superadmin/report/permuridan/$permuridan_id/export", []) }}"
                            class="btn btn-success waves-effect waves-light">Export <i class="fa fa-file-excel-o"></i></a>

                        <div class="">
                            <table class="table table-striped add-edit-table table-bordered"
                                id="datatable-permuridan-detail">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Anak PA</th>
                                        <th>Kehadiran</th>
                                        {{-- <th>Selesai</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ @$value->anak_pa->nama }}</td>
                                            <td>
                                                @if ($value->flag_hadir)
                                                    <span class="badge badge-success">Hadir</span>
                                                @else
                                                    <span class="badge badge-danger">Tidak Hadir</span>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                @if ($value->flag_lulus)
                                                    <span class="badge badge-success">Selesai</span>
                                                @else
                                                    <span class="badge badge-danger">Belum Selesai</span>
                                                @endif
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->


    </div>
@endsection

@section('script')
    <!-- App js -->
    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>
@endsection
