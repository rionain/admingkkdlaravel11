@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Sertifikat Pernikahan</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            @include('errorhandler')

                            <div id="modalSertifikat" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Sertifikat</h4>
                                        </div>
                                        <form action="" method="POST" enctype="multipart/form-data"
                                            id="formSertifikat">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_pernikahan" class="control-label">Tempat
                                                                pernikahan</label>
                                                            <input type="text" class="form-control"
                                                                id="tempat_pernikahan" name="tempat_pernikahan"
                                                                placeholder="Tempat pernikahan" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_pernikahan" class="control-label">Tanggal
                                                                pernikahan</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_pernikahan" name="tanggal_pernikahan"
                                                                placeholder="Tanggal pernikahan" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="foto" class="control-label">Foto</label>
                                                            <div id="edit-foto" style="display: none">
                                                                <img src="" alt="" style="width: 100px;"><br>
                                                                    <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                        mengubah foto</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="foto" name="foto">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="text-center">Pengantin Pria</h4>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="nama_pasangan_pria" class="control-label">Nama
                                                                Pria</label> <br>
                                                            <small class="text-danger">* Maksimal input 30 karakter</small>
                                                            <input type="text" class="form-control"
                                                                id="nama_pasangan_pria" name="nama_pasangan_pria"
                                                                placeholder="Nama pasangan pria" maxlength="30" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="tanda_tangan_pengantin_pria"
                                                                class="control-label">Tanda Tangan Pengantin Pria</label>
                                                            <div id="edit-tanda_tangan_pengantin_pria"
                                                                style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                    <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                        mengubah TTD</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="tanda_tangan_pengantin_pria"
                                                                name="tanda_tangan_pengantin_pria">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir_pasangan_pria"
                                                                class="control-label">Tempat lahir pria</label>
                                                            <input type="text" class="form-control"
                                                                id="tempat_lahir_pasangan_pria"
                                                                name="tempat_lahir_pasangan_pria"
                                                                placeholder="Tempat lahir pria" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir_pasangan_pria"
                                                                class="control-label">Tanggal lahir pria</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_lahir_pasangan_pria"
                                                                name="tanggal_lahir_pasangan_pria"
                                                                placeholder="Tanggal lahir pria" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir_baru_pasangan_pria"
                                                                class="control-label">Tanggal lahir baru pria</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_lahir_baru_pasangan_pria"
                                                                name="tanggal_lahir_baru_pasangan_pria"
                                                                placeholder="Tanggal lahir baru pasangan 1" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_baptis_pasangan_pria"
                                                                class="control-label">Tanggal baptis pria</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_baptis_pasangan_pria"
                                                                name="tanggal_baptis_pasangan_pria"
                                                                placeholder="Tanggal baptis pria" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="text-center">Pengantin Wanita</h4>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="nama_pasangan_wanita" class="control-label">Nama
                                                                wanita</label> <br>
                                                            <small class="text-danger">* Maksimal input 30 karakter</small>
                                                            <input type="text" class="form-control"
                                                                id="nama_pasangan_wanita" name="nama_pasangan_wanita"
                                                                placeholder="Nama pasangan wanita" maxlength="30"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="tanda_tangan_pengantin_wanita"
                                                                class="control-label">Tanda Tangan Pengantin Wanita</label>
                                                            <div id="edit-tanda_tangan_pengantin_wanita"
                                                                style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                    <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                        mengubah TTD</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="tanda_tangan_pengantin_wanita"
                                                                name="tanda_tangan_pengantin_wanita">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir_pasangan_wanita"
                                                                class="control-label">Tempat lahir wanita</label>
                                                            <input type="text" class="form-control"
                                                                id="tempat_lahir_pasangan_wanita"
                                                                name="tempat_lahir_pasangan_wanita"
                                                                placeholder="Tempat lahir wanita" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir_pasangan_wanita"
                                                                class="control-label">Tanggal lahir wanita</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_lahir_pasangan_wanita"
                                                                name="tanggal_lahir_pasangan_wanita"
                                                                placeholder="Tanggal lahir wanita" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir_baru_pasangan_wanita"
                                                                class="control-label">Tanggal lahir baru wanita</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_lahir_baru_pasangan_wanita"
                                                                name="tanggal_lahir_baru_pasangan_wanita"
                                                                placeholder="Tanggal lahir baru wanita" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_baptis_pasangan_wanita"
                                                                class="control-label">Tanggal baptis wanita</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_baptis_pasangan_wanita"
                                                                name="tanggal_baptis_pasangan_wanita"
                                                                placeholder="Tanggal baptis wanita" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="text-center">Pendeta</h4>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="nama_pendeta" class="control-label">Nama
                                                                Pendeta</label> <br>
                                                            <small class="text-danger">* Maksimal input 30 karakter</small>
                                                            <input type="text" class="form-control" id="nama_pendeta"
                                                                name="nama_pendeta" placeholder="Pelayan pengantin"
                                                                maxlength="30" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="tanda_tangan_pendeta" class="control-label">Tanda
                                                                Tangan Pendeta</label>
                                                            <div id="edit-tanda_tangan_pendeta" style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                    <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                        mengubah TTD</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="tanda_tangan_pendeta" name="tanda_tangan_pendeta">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="text-center">Saksi 1</h4>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="nama_saksi1" class="control-label">Nama Saksi
                                                                1</label> <br>
                                                                <small class="text-danger">* Maksimal input 30 karakter</small>
                                                            <input type="text" class="form-control" id="nama_saksi1"
                                                                name="nama_saksi1" placeholder="Nama saksi 1" maxlength="30" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="tanda_tangan_saksi1" class="control-label">Tanda
                                                                Tangan Saksi 1</label>
                                                            <div id="edit-tanda_tangan_saksi1" style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                    <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                        mengubah TTD</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="tanda_tangan_saksi1" name="tanda_tangan_saksi1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="text-center">Saksi 2</h4>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="nama_saksi2" class="control-label">Nama Saksi
                                                                2</label> <br>
                                                                <small class="text-danger">* Maksimal input 30 karakter</small>
                                                            <input type="text" class="form-control" id="nama_saksi2"
                                                                name="nama_saksi2" placeholder="Nama saksi 2" maxlength="30" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="tanda_tangan_saksi2" class="control-label">Tanda
                                                                Tangan Saksi 2</label>
                                                            <div id="edit-tanda_tangan_saksi2" style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                        mengubah TTD</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="tanda_tangan_saksi2" name="tanda_tangan_saksi2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_sertifikat_pernikahan" class="control-label">Jenis
                                                        sertifikat Pernikahan</label>
                                                    <select name="jenis_sertifikat_pernikahan"
                                                        id="jenis_sertifikat_pernikahan" class="form-control">
                                                        <option value="">Pilih Jenis</option>
                                                        <option value="pemberkatan">Pemberkatan</option>
                                                        <option value="peneguhan">Peneguhan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {!! modalFooterZircos() !!}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="m-b-30">
                                <button id="addSertifikat" type="button"
                                    class="btn btn-success waves-effect waves-light" data-toggle="modal"
                                    data-target="#modalSertifikat">
                                    Add <em class="mdi mdi-plus-circle-outline"></em>
                                </button>
                            </div>
                            <div style="overflow: auto">
                                <table class="table table-striped add-edit-table table-bordered"
                                    id="datatable-sertifikat">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No surat</th>
                                            <th>Sertifikat</th>
                                            <th>Pernikahan</th>
                                            <th>Pasangan Pria</th>
                                            <th>Pasangan Wanita</th>
                                            <th>Pendeta</th>
                                            <th>Saksi 1</th>
                                            <th>Saksi 2</th>
                                            <th>Status</th>
                                            <th>Alasan Demote</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sertifikat as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td style="min-width: 100px;">{{ $value->no_sertifikat }}</td>
                                                <td>{!! ucfirst($value->jenis_sertifikat_pernikahan) == 'Pemberkatan'
                                                    ? badge('primary', ucfirst($value->jenis_sertifikat_pernikahan))
                                                    : badge('success', ucfirst($value->jenis_sertifikat_pernikahan)) !!}</td>
                                                <td style="min-width: 300px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <b>{!! $value->tempat_pernikahan ?: badge('danger', 'Tempat pernikahan kosong') !!}</b><br>
                                                            {!! tanggal_indonesia(format_date($value->tanggal_pernikahan, 'Y-m-d')) ?:
                                                                badge('danger', 'Tgl pernikahan kosong') !!} <br>
                                                            @if ($value->foto)
                                                                <a href="{{ S3Helper::get($value->foto) }}"
                                                                    class="btn btn-xs btn-warning" target="_blank">Lihat
                                                                    Foto Pernikahan</a> <br>
                                                            @else
                                                                <div class="badge badge-xs badge-danger">Foto tidak ada
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="min-width: 300px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <b>{!! $value->nama_pasangan_pria ?: badge('danger', 'Nama pasangan pria kosong') !!}</b><br>
                                                            {!! $value->tempat_lahir_pasangan_pria ?: badge('danger', 'Tempat lahir kosong') !!}, {!! tanggal_indonesia(format_date($value->tanggal_lahir_pasangan_pria, 'Y-m-d')) ?:
                                                                badge('danger', 'Tgl lahir kosong') !!} <br>
                                                            @if ($value->tanda_tangan_pengantin_pria)
                                                                <a href="{{ S3Helper::get($value->tanda_tangan_pengantin_pria) }}"
                                                                    class="btn btn-xs btn-warning" target="_blank">Lihat
                                                                    TTD Pria</a> <br>
                                                            @else
                                                                <div class="badge badge-xs badge-danger">TTD tidak ada
                                                                </div> <br>
                                                            @endif
                                                            <br>
                                                            <b>Tgl baptis</b> : {!! tanggal_indonesia(format_date($value->tanggal_baptis_pasangan_pria, 'Y-m-d')) ?:
                                                                badge('danger', 'Tgl baptis kosong') !!} <br>
                                                            <b>Tgl lahir baru</b> : {!! tanggal_indonesia(format_date($value->tanggal_lahir_baru_pasangan_pria, 'Y-m-d')) ?:
                                                                badge('danger', 'Tgl lahir baru kosong') !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="min-width: 300px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <b>{!! $value->nama_pasangan_wanita ?: badge('danger', 'Nama pasangan wanita kosong') !!}</b><br>
                                                            {!! $value->tempat_lahir_pasangan_wanita ?: badge('danger', 'Tempat lahir kosong') !!}, {!! tanggal_indonesia(format_date($value->tanggal_lahir_pasangan_wanita, 'Y-m-d')) ?:
                                                                badge('danger', 'Tgl lahir kosong') !!} <br>
                                                            @if ($value->tanda_tangan_pengantin_wanita)
                                                                <a href="{{ S3Helper::get($value->tanda_tangan_pengantin_wanita) }}"
                                                                    class="btn btn-xs btn-warning" target="_blank">Lihat
                                                                    TTD Wanita</a> <br>
                                                            @else
                                                                <div class="badge badge-xs badge-danger">TTD tidak ada
                                                                </div> <br>
                                                            @endif
                                                            <br>
                                                            <b>Tgl baptis</b> : {!! tanggal_indonesia(format_date($value->tanggal_baptis_pasangan_wanita, 'Y-m-d')) ?:
                                                                badge('danger', 'Tgl baptis kosong') !!} <br>
                                                            <b>Tgl lahir baru</b> : {!! tanggal_indonesia(format_date($value->tanggal_lahir_baru_pasangan_wanita, 'Y-m-d')) ?:
                                                                badge('danger', 'Tgl lahir baru kosong') !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class='text-center' style="min-width: 170px;">
                                                    {!! $value->nama_pendeta ?: badge('danger', 'Nama pendeta kosong') !!} <br>
                                                    @if ($value->tanda_tangan_pendeta)
                                                        <a href="{{ S3Helper::get($value->tanda_tangan_pendeta) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat
                                                            TTD Pendeta</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger">TTD tidak ada
                                                        </div> <br>
                                                    @endif
                                                </td>
                                                <td class='text-center' style="min-width: 170px;">
                                                    {!! $value->nama_saksi1 ?: badge('danger', 'Nama saksi 1 kosong') !!} <br>
                                                    @if ($value->tanda_tangan_saksi1)
                                                        <a href="{{ S3Helper::get($value->tanda_tangan_saksi1) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat
                                                            TTD Saksi 1</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger">TTD tidak ada
                                                        </div> <br>
                                                    @endif
                                                </td>
                                                <td class='text-center' style="min-width: 170px;">
                                                    {!! $value->nama_saksi2 ?: badge('danger', 'Nama saksi 2 kosong') !!} <br>
                                                    @if ($value->tanda_tangan_saksi2)
                                                        <a href="{{ S3Helper::get($value->tanda_tangan_saksi2) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat
                                                            TTD Saksi 2</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger">TTD tidak ada
                                                        </div> <br>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($value->lfk_status_sertifikat_id == 1)
                                                        <span
                                                            class="badge badge-info">{{ @$value->status_sertifikat->status_sertifikat }}</span>
                                                    @elseif ($value->lfk_status_sertifikat_id == 2)
                                                        <span
                                                            class="badge badge-success">{{ @$value->status_sertifikat->status_sertifikat }}</span>
                                                    @elseif ($value->lfk_status_sertifikat_id == 3)
                                                        <span
                                                            class="badge badge-danger">{{ @$value->status_sertifikat->status_sertifikat }}</span>
                                                    @else
                                                        <span class="badge badge-danger">KOSONG</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($value->lfk_status_sertifikat_id == 3)
                                                        {{ $value->alasan_demote }}
                                                    @else
                                                        <span class="badge badge-danger">KOSONG</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($value->lfk_status_sertifikat_id == 2)
                                                        <a href="{{ url("admin-cabang/request-sertifikat/sertifikat-pernikahan/$value->sertifikat_pernikahan_id/print-view?jenis=$value->jenis_sertifikat_pernikahan") }}"
                                                            target="_blank"
                                                            class="btn btn-icon waves-effect waves-light btn-success m-b-5"
                                                            data-toggle="tooltip" data-placement="top" title="View PDF">
                                                            {{-- <i class="fa fa-file-pdf-o"></i> View {{ ucfirst($value->jenis_sertifikat_pernikahan) }} Nikah PDF --}}
                                                            <i class="fa fa-file-pdf-o"></i> View Sertifikat
                                                        </a>
                                                    @elseif ($value->lfk_status_sertifikat_id == 3)
                                                        <a href="#"
                                                            class="btn btn-icon waves-effect waves-light btn-info m-b-5"
                                                            data-placement="top" title="Edit" data-toggle="modal"
                                                            data-target="#modalSertifikat"
                                                            onclick="editSertifikat(`{{ $value->sertifikat_pernikahan_id }}`)">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- end: page -->

                </div> <!-- end Panel -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->


    </div>
@endsection

@section('script')
    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>

    <script>
        $('#datatable-sertifikat').DataTable();
    </script>
    <script>
        const modalSertifikat = 'modalSertifikat'
        const formSertifikat = 'formSertifikat'
        setSelect2('jenis_sertifikat_pernikahan');

        $(function() {
            sertifikatPernikahanValidation(formSertifikat)
        })

        $('#addSertifikat').on('click', function() {
            titleAction('Form Tambah Sertifikat', base_url('admin-cabang/request-sertifikat/sertifikat-pernikahan'))
        })

        $('#' + modalSertifikat).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            hiddenModal(modalSertifikat, 'nama_jemaat')
            hiddenModal(modalSertifikat, 'tanggal_pernikahan')
            hiddenModal(modalSertifikat, 'tempat_pernikahan')
            hiddenModal(modalSertifikat, 'nama_pasangan_pria')
            hiddenModal(modalSertifikat, 'tempat_lahir_pasangan_pria')
            hiddenModal(modalSertifikat, 'tanggal_lahir_pasangan_pria')
            hiddenModal(modalSertifikat, 'tanggal_lahir_baru_pasangan_pria')
            hiddenModal(modalSertifikat, 'tanggal_baptis_pasangan_pria')
            hiddenModal(modalSertifikat, 'nama_pasangan_wanita')
            hiddenModal(modalSertifikat, 'tempat_lahir_pasangan_wanita')
            hiddenModal(modalSertifikat, 'tanggal_lahir_pasangan_wanita')
            hiddenModal(modalSertifikat, 'tanggal_lahir_baru_pasangan_wanita')
            hiddenModal(modalSertifikat, 'tanggal_baptis_pasangan_wanita')
            hiddenModal(modalSertifikat, 'nama_pendeta')
            hiddenModal(modalSertifikat, 'nama_saksi1')
            hiddenModal(modalSertifikat, 'nama_saksi2')
            hiddenModal(modalSertifikat, 'jenis_sertifikat_pernikahan')

            setValSelect2(modalSertifikat, 'jenis_sertifikat_pernikahan', '');
            $('#' + formSertifikat + ' #edit-foto').css('display', 'none')
            $('#' + formSertifikat + ' #edit-tanda_tangan_pendeta').css('display', 'none')
            $('#' + formSertifikat + ' #edit-tanda_tangan_saksi1').css('display', 'none')
            $('#' + formSertifikat + ' #edit-tanda_tangan_saksi2').css('display', 'none')
            $('#' + formSertifikat + ' #edit-tanda_tangan_pengantin_wanita').css('display', 'none')
            $('#' + formSertifikat + ' #edit-tanda_tangan_pengantin_pria').css('display', 'none')
        })

        function editSertifikat(id) {
            titleAction('Edit Sertifikat Surat', base_url('admin-cabang/request-sertifikat/sertifikat-pernikahan/' + id))
            startloading('#' + modalSertifikat + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/admin-cabang/request-sertifikat/sertifikat-pernikahan/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                setVal(modalSertifikat, 'nama_jemaat', response.data.nama_jemaat)
                setVal(modalSertifikat, 'tanggal_pernikahan', response.data.tanggal_pernikahan)
                setVal(modalSertifikat, 'tempat_pernikahan', response.data.tempat_pernikahan)
                setVal(modalSertifikat, 'nama_pasangan_pria', response.data.nama_pasangan_pria)
                setVal(modalSertifikat, 'tempat_lahir_pasangan_pria', response.data.tempat_lahir_pasangan_pria)
                setVal(modalSertifikat, 'tanggal_lahir_pasangan_pria', response.data.tanggal_lahir_pasangan_pria)
                setVal(modalSertifikat, 'tanggal_lahir_baru_pasangan_pria', response.data
                    .tanggal_lahir_baru_pasangan_pria)
                setVal(modalSertifikat, 'tanggal_baptis_pasangan_pria', response.data.tanggal_baptis_pasangan_pria)
                setVal(modalSertifikat, 'nama_pasangan_wanita', response.data.nama_pasangan_wanita)
                setVal(modalSertifikat, 'tempat_lahir_pasangan_wanita', response.data.tempat_lahir_pasangan_wanita)
                setVal(modalSertifikat, 'tanggal_lahir_pasangan_wanita', response.data
                    .tanggal_lahir_pasangan_wanita)
                setVal(modalSertifikat, 'tanggal_lahir_baru_pasangan_wanita', response.data
                    .tanggal_lahir_baru_pasangan_wanita)
                setVal(modalSertifikat, 'tanggal_baptis_pasangan_wanita', response.data
                    .tanggal_baptis_pasangan_wanita)
                setVal(modalSertifikat, 'nama_pendeta', response.data.nama_pendeta)
                setVal(modalSertifikat, 'nama_saksi1', response.data.nama_saksi1)
                setVal(modalSertifikat, 'nama_saksi2', response.data.nama_saksi2)
                setValSelect2(modalSertifikat, 'jenis_sertifikat_pernikahan', response.data
                    .jenis_sertifikat_pernikahan);

                $('#' + formSertifikat + ' #edit-foto').css('display', 'block')
                $('#' + formSertifikat + ' #edit-foto img').attr('src', s3_url + response.data.foto)
                $('#' + formSertifikat + ' #edit-tanda_tangan_pendeta').css('display', 'block')
                $('#' + formSertifikat + ' #edit-tanda_tangan_pendeta img').attr('src', s3_url + response.data
                    .tanda_tangan_pendeta)
                $('#' + formSertifikat + ' #edit-tanda_tangan_saksi1').css('display', 'block')
                $('#' + formSertifikat + ' #edit-tanda_tangan_saksi1 img').attr('src', s3_url + response.data
                    .tanda_tangan_saksi1)
                $('#' + formSertifikat + ' #edit-tanda_tangan_saksi2').css('display', 'block')
                $('#' + formSertifikat + ' #edit-tanda_tangan_saksi2 img').attr('src', s3_url + response.data
                    .tanda_tangan_saksi2)
                $('#' + formSertifikat + ' #edit-tanda_tangan_pengantin_wanita').css('display', 'block')
                $('#' + formSertifikat + ' #edit-tanda_tangan_pengantin_wanita img').attr('src', s3_url + response
                    .data.tanda_tangan_pengantin_wanita)
                $('#' + formSertifikat + ' #edit-tanda_tangan_pengantin_pria').css('display', 'block')
                $('#' + formSertifikat + ' #edit-tanda_tangan_pengantin_pria img').attr('src', s3_url + response
                    .data.tanda_tangan_pengantin_pria)

                stoploading('#' + modalSertifikat + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                console.log('data: ' + data)
                console.log('status: ' + status)
                console.log('error: ' + error)
                // if (status == 'timeout') {
                //     CekKonfirmasi('Timeout!', '')
                // } else if (data.responseJSON.status == false) {
                //     CekKonfirmasi(data.responseJSON.message, '')
                // }
                stoploading('#' + modalSertifikat + ' .modal-dialog')
            });
        }

        function titleAction(title, action) {
            $('#' + modalSertifikat + ' .modal-title').html(title)
            $('#' + modalSertifikat + ' #' + formSertifikat).attr('action', action)
        }

        function tutupModal(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }

        function sertifikatPernikahanValidation(id) {
            $('#' + id).validate({
                rules: {
                    tempat_pernikahan: {
                        required: true
                    },
                    tanggal_pernikahan: {
                        required: true
                    },
                    // foto: {
                    //     required: true
                    // },
                    nama_pasangan_pria: {
                        required: true
                    },
                    // tanda_tangan_pengantin_pria: {
                    //     required: true
                    // },
                    tempat_lahir_pasangan_pria: {
                        required: true
                    },
                    tanggal_lahir_pasangan_pria: {
                        required: true
                    },
                    tanggal_lahir_baru_pasangan_pria: {
                        required: true
                    },
                    tanggal_baptis_pasangan_pria: {
                        required: true
                    },
                    nama_pasangan_wanita: {
                        required: true
                    },
                    // tanda_tangan_pengantin_wanita: {
                    //     required: true
                    // },
                    tempat_lahir_pasangan_wanita: {
                        required: true
                    },
                    tanggal_lahir_pasangan_wanita: {
                        required: true
                    },
                    tanggal_lahir_baru_pasangan_wanita: {
                        required: true
                    },
                    tanggal_baptis_pasangan_wanita: {
                        required: true
                    },
                    nama_pendeta: {
                        required: true
                    },
                    // tanda_tangan_pendeta: {
                    //     required: true
                    // },
                    nama_saksi1: {
                        required: true
                    },
                    // tanda_tangan_saksi1: {
                    //     required: true
                    // },
                    nama_saksi2: {
                        required: true
                    },
                    // tanda_tangan_saksi2: {
                    //     required: true
                    // },
                    jenis_sertifikat_pernikahan: {
                        required: true
                    }
                },
                messages: {
                    tempat_pernikahan: {
                        required: 'Tempat pernikahan tidak boleh kosong'
                    },
                    tanggal_pernikahan: {
                        required: 'Tanggal pernikahan tidak boleh kosong'
                    },
                    // foto: {
                    //     required: 'Foto tidak boleh kosong'
                    // },
                    nama_pasangan_pria: {
                        required: 'Nama pasangan pria tidak boleh kosong'
                    },
                    // tanda_tangan_pengantin_pria: {
                    //     required: ' tidak boleh kosong'
                    // },
                    tempat_lahir_pasangan_pria: {
                        required: 'Tempat lahir pria tidak boleh kosong'
                    },
                    tanggal_lahir_pasangan_pria: {
                        required: 'Tanggal lahir pria tidak boleh kosong'
                    },
                    tanggal_lahir_baru_pasangan_pria: {
                        required: 'Tanggal lahir baru pria tidak boleh kosong'
                    },
                    tanggal_baptis_pasangan_pria: {
                        required: 'Tanggal baptis pria tidak boleh kosong'
                    },
                    nama_pasangan_wanita: {
                        required: 'Nama pasangan wanita tidak boleh kosong'
                    },
                    // tanda_tangan_pengantin_wanita: {
                    //     required: ' tidak boleh kosong'
                    // },
                    tempat_lahir_pasangan_wanita: {
                        required: 'Tempat lahir wanita tidak boleh kosong'
                    },
                    tanggal_lahir_pasangan_wanita: {
                        required: 'Tanggal lahir wanita tidak boleh kosong'
                    },
                    tanggal_lahir_baru_pasangan_wanita: {
                        required: 'Tanggal lahir baru wanita tidak boleh kosong'
                    },
                    tanggal_baptis_pasangan_wanita: {
                        required: 'Tanggal baptis wanita tidak boleh kosong'
                    },
                    nama_pendeta: {
                        required: 'Pelayan pengantin tidak boleh kosong'
                    },
                    // tanda_tangan_pendeta: {
                    //     required: ' tidak boleh kosong'
                    // },
                    nama_saksi1: {
                        required: 'Nama saksi tidak boleh kosong'
                    },
                    // tanda_tangan_saksi1: {
                    //     required: ' tidak boleh kosong'
                    // },
                    nama_saksi2: {
                        required: 'Nama saksi 2 tidak boleh kosong'
                    },
                    // tanda_tangan_saksi2: {
                    //     required: ' tidak boleh kosong'
                    // },
                    jenis_sertifikat_pernikahan: {
                        required: 'Jenis sertifikat tidak boleh kosong'
                    }
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
