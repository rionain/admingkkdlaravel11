@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="page-title-box">
                    <h4 class="page-title">Kehadiran Permuridan Detail</h4>
                    @include('breadcrumb')
                    <div class="clearfix"></div>
                </div>
                <!-- end row -->

                <div class="panel">
                    <div class="panel-body">
                        <a href="{{ url('admin-cabang/kehadiran/permuridan') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>
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
                                    <th width="15%">Kategori Gereja</th>
                                    <td>{{ @$permuridan->cabang->kategori_gereja->kategori_gereja }}</td>
                                </tr>
                                <tr>
                                    <th width="15%">Gereja</th>
                                    <td>{{ @$permuridan->cabang->nama_cabang }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ format_date($permuridan->tanggal, 'd F Y') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div id="kehadiranPermuridanDetail" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                        <h4 class="modal-title">Tambah Kehadiran Permuridan</h4>
                                    </div>
                                    <form
                                        action="{{ url("admin-cabang/kehadiran/permuridan/$permuridan->permuridan_id/detail") }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group no-margin">
                                                <label for="anak_pa" class="control-label">Anak PA</label>
                                                <select name="anak_pa" id="anak_pa" class="form-control">
                                                    <option value="">Pilih anak pa</option>
                                                    @foreach ($anak_pa as $key => $item)
                                                        <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="flag_hadir" class="control-label">Kehadiran</label><br>
                                                <input type="radio" name="flag_hadir" id="flag_hadirT" value="1">
                                                Hadir
                                                <input type="radio" name="flag_hadir" id="flag_hadirF" value="0">
                                                Tidak hadir
                                            </div><br>
                                            <div class="form-group">
                                                <label for="flag_lulus" class="control-label">Selesai</label><br>
                                                <input type="radio" name="flag_lulus" id="flag_lulusT" value="1">
                                                Selesai
                                                <input type="radio" name="flag_lulus" id="flag_lulusF" value="0">
                                                Belum selesai
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

                        <button id="tambahPermuridanDetail" class="btn btn-success waves-effect waves-light"
                            data-toggle="modal" data-target="#kehadiranPermuridanDetail">Add <i
                                class="mdi mdi-plus-circle-outline"></i></button>

                        <div style="margin-top: 20px">
                            <table class="table table-striped add-edit-table table-bordered"
                                id="datatable-permuridan-detail">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Anak PA</th>
                                        <th>Kehadiran</th>
                                        {{-- <th>Selesai</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ dd($kehadiran) }} --}}
                                    @foreach ($kehadiran as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ @$value->anak_pa->nama }}</td>
                                            <td>
                                                <a
                                                    onclick='confirmAlert(`warning`,`Apakah anda yakin ingin mengganti flag kehadiran?`,`{{ url("admin-cabang/kehadiran/permuridan/$permuridan->permuridan_id/detail/$value->permuridan_detail_id/ganti-flag-hadir") }}`,`Ya`)'>
                                                    @if ($value->flag_hadir == '1')
                                                        <span class="btn btn-success">Hadir</span>
                                                    @elseif ($value->flag_hadir === "0")
                                                        <span class="btn btn-danger">Tidak Hadir</span>
                                                    @else
                                                        <span class="btn btn-warning">Kosong</span>
                                                    @endif
                                                </a>
                                            </td>
                                            {{-- <td>
                                                @if ($value->flag_lulus === '1')
                                                    <span class="badge badge-success">Selesai</span>
                                                @elseif ($value->flag_lulus == "0")
                                                    <span class="badge badge-danger">Belum Selesai</span>
                                                @else
                                                    <span class="badge badge-warning">Kosong</span>
                                                @endif
                                            </td> --}}
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ url("admin-cabang/kehadiran/permuridan/$permuridan->permuridan_id/detail/$value->permuridan_detail_id/hapus") }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah anda yakin?')"><i
                                                            class="fa fa-trash-o"></i>
                                                    </a>
                                                </div>
                                            </td>
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
    <script>
        $('#datatable-permuridan-detail').DataTable();
    </script>
@endsection
