@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Sertifikat Penyerahan Anak</h4>
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
                                                <div class="form-group">
                                                    <label for="tanggal_penyerahan_anak" class="control-label">Tanggal
                                                        Penyerahan Anak</label>
                                                    <input type="date" class="form-control" id="tanggal_penyerahan_anak"
                                                        name="tanggal_penyerahan_anak" placeholder="Tanggal Penyerahan Anak"
                                                        required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_jemaat" class="control-label">Nama
                                                                Jemaat</label>
                                                            <input type="text" class="form-control" id="nama_jemaat"
                                                                name="nama_jemaat" placeholder="Nama jemaat" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="jenis_kelamin" class="control-label">Jenis
                                                                Kelamin</label>
                                                            <select class="form-control" id="jenis_kelamin"
                                                                name="jenis_kelamin" required>
                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                <option value="l">Laki-Laki</option>
                                                                <option value="p">Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir" class="control-label">Tempat
                                                                Lahir</label>
                                                            <input type="text" class="form-control" id="tempat_lahir"
                                                                name="tempat_lahir" placeholder="Tempat Lahir" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir" class="control-label">Tanggal
                                                                Lahir</label>
                                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                                name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_ayah" class="control-label">Nama Ayah</label> <br>
                                                            <small class="text-danger">* Maksimal input 30 karakter
                                                            </small>
                                                            <input type="text" class="form-control" id="nama_ayah"
                                                                name="nama_ayah" placeholder="Nama Ayah" maxlength="30"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_ibu" class="control-label">Nama Ibu</label> <br>
                                                            <small class="text-danger">* Maksimal input 30 karakter
                                                            </small>
                                                            <input type="text" class="form-control" id="nama_ibu"
                                                                name="nama_ibu" placeholder="Nama Ibu" maxlength="30"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nama_pendeta" class="control-label">Nama Pendeta</label> <br>
                                                    <small class="text-danger">* Maksimal input 40 karakter
                                                    </small>
                                                    <input type="text" class="form-control" id="nama_pendeta"
                                                        name="nama_pendeta" placeholder="Nama Pendeta" maxlength="40"
                                                        required>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="saksi_pembimbing1" class="control-label">Saksi
                                                                Pembimbing 1</label> <br> <small class="text-danger">* Maksimal
                                                                    input 30 karakter </small>
                                                            <input type="text" class="form-control"
                                                                id="saksi_pembimbing1" name="saksi_pembimbing1"
                                                                placeholder="Saksi Pembimbing 1" maxlength="30">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ttdsaksi1" class="control-label">Foto TTD Saksi
                                                                Pembimbing 1</label>
                                                            <div id="edit-ttdsaksi1" style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                    mengubah foto</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="ttdsaksi1" name="ttdsaksi1"
                                                                placeholder="TTD Saksi Pembimbing 1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="saksi_pembimbing2" class="control-label">Saksi
                                                                Pembimbing 2</label> <br> <small class="text-danger">* Maksimal
                                                                    input 30 karakter </small>
                                                            <input type="text" class="form-control"
                                                                id="saksi_pembimbing2" name="saksi_pembimbing2"
                                                                placeholder="Saksi Pembimbing 2" maxlength="30">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ttdsaksi2" class="control-label">Foto TTD Saksi
                                                                Pembimbing 2</label>
                                                            <div id="edit-ttdsaksi2" style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                    mengubah foto</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="ttdsaksi2" name="ttdsaksi2"
                                                                placeholder="TTD Saksi Pembimbing 2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto" class="control-label">Foto</label>
                                                    <div id="edit-foto" style="display: none">
                                                        <img src="" alt="" style="width: 100px;">
                                                        <br>
                                                        <span class="text-danger">* kosongkan bila tidak ingin mengubah
                                                            foto</span>
                                                    </div>
                                                    <input type="file" accept="image/*" class="form-control"
                                                        id="foto" name="foto">
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
                                    data-target="#modalSertifikat">Add <em
                                        class="mdi mdi-plus-circle-outline"></em></button>
                            </div>

                            <div style="overflow: auto">
                                <table class="table table-striped add-edit-table table-bordered"
                                    id="datatable-sertifikat">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No surat</th>
                                            <th>Jemaat</th>
                                            <th>Tanggal penyerahan anak</th>
                                            <th>Pendeta</th>
                                            <th>Saksi pembimbing 1</th>
                                            <th>Saksi pembimbing 2</th>
                                            <th>Status</th>
                                            <th>Alasan Demote</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sertifikat as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td style="min-width: 120px;">{{ $value->no_sertifikat }}</td>
                                                <td style="min-width: 300px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <b>{!! $value->nama_jemaat ?: badge('danger', 'Nama jemaat kosong') !!}</b><br>
                                                            {!! $value->tempat_lahir ?: badge('danger', 'Tempat lahir kosong') !!}, {!! tanggal_indonesia(format_date($value->tanggal_lahir, 'Y-m-d')) ?: badge('danger', 'Tgl lahir kosong') !!} <br>
                                                            {{ $value->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}
                                                            <br>
                                                            @if ($value->foto)
                                                                <a href="{{ S3Helper::get($value->foto) }}"
                                                                    class="btn btn-xs btn-warning" target="_blank">Lihat
                                                                    Foto Jemaat</a> <br>
                                                            @else
                                                                <div class="badge badge-xs badge-danger">Foto tidak ada
                                                                </div>
                                                            @endif
                                                            <br>
                                                            <b>Ayah</b> : {!! $value->nama_ayah ?: badge('danger', 'Nama ayah kosong') !!} <br>
                                                            <b>Ibu</b> : {!! $value->nama_ibu ?: badge('danger', 'Nama ibu kosong') !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{!! tanggal_indonesia(format_date($value->tanggal_penyerahan_anak, 'Y-m-d')) ?:
                                                    badge('danger', 'Tgl lahir kosong') !!}</td>
                                                <td>{{ $value->nama_pendeta }}</td>
                                                <td>
                                                    {!! $value->saksi_pembimbing1 ?: badge('danger', 'Nama saksi pembimbing 1 kosong') !!} <br>
                                                    @if ($value->foto_ttd_saksi_pembimbing_1)
                                                        <a href="{{ S3Helper::get($value->foto_ttd_saksi_pembimbing_1) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat TTD Saksi
                                                            Pembimbing 1</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger" style="margin-top: 4px;">
                                                            Foto tidak ada</div> <br>
                                                    @endif
                                                </td>
                                                <td>
                                                    {!! $value->saksi_pembimbing2 ?: badge('danger', 'Nama saksi pembimbing 2 kosong') !!} <br>
                                                    @if ($value->foto_ttd_saksi_pembimbing_2)
                                                        <a href="{{ S3Helper::get($value->foto_ttd_saksi_pembimbing_2) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat TTD Saksi
                                                            Pembimbing 2</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger" style="margin-top: 4px;">
                                                            Foto tidak ada</div> <br>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($value->lfk_status_sertifikat_id == 1)
                                                        <span class="badge badge-info">
                                                            {{ @$value->status_sertifikat->status_sertifikat }}
                                                        </span>
                                                    @elseif ($value->lfk_status_sertifikat_id == 2)
                                                        <span class="badge badge-success">
                                                            {{ @$value->status_sertifikat->status_sertifikat }}
                                                        </span>
                                                    @elseif ($value->lfk_status_sertifikat_id == 3)
                                                        <span class="badge badge-danger">
                                                            {{ @$value->status_sertifikat->status_sertifikat }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            KOSONG
                                                        </span>
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
                                                        <a href="{{ url("admin-cabang/request-sertifikat/sertifikat-penyerahan-anak/$value->sertifikat_penyerahan_anak_id/print-view") }}"
                                                            target="_blank"
                                                            class="btn btn-icon waves-effect waves-light btn-success m-b-5"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="View PDF"><i class="fa fa-file-pdf-o"></i> View PDF</a>
                                                    @elseif ($value->lfk_status_sertifikat_id == 3)
                                                        <a href="#"
                                                            class="btn btn-icon waves-effect waves-light btn-info m-b-5"
                                                            data-placement="top" title="Edit" data-toggle="modal"
                                                            data-target="#modalSertifikat"
                                                            onclick="editSertifikat(`{{ $value->sertifikat_penyerahan_anak_id }}`)"><i
                                                                class="fa fa-edit"></i> Edit</a>
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

        $('#addSertifikat').on('click', function() {
            titleAction('Form Tambah Sertifikat', base_url(
                'admin-cabang/request-sertifikat/sertifikat-penyerahan-anak'))
        })

        $('#' + modalSertifikat).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            tutupModal(modalSertifikat, 'nama_jemaat')
            tutupModal(modalSertifikat, 'tanggal_penyerahan_anak')
            tutupModal(modalSertifikat, 'jenis_kelamin')
            tutupModal(modalSertifikat, 'tempat_lahir')
            tutupModal(modalSertifikat, 'tanggal_lahir')
            tutupModal(modalSertifikat, 'nama_ayah')
            tutupModal(modalSertifikat, 'nama_ibu')
            tutupModal(modalSertifikat, 'nama_pendeta')
            tutupModal(modalSertifikat, 'saksi_pembimbing1')
            tutupModal(modalSertifikat, 'saksi_pembimbing2')

            $('#' + formSertifikat + ' #edit-foto').css('display', 'none')
            $('#' + formSertifikat + ' #edit-ttdsaksi1').css('display', 'none')
            $('#' + formSertifikat + ' #edit-ttdsaksi2').css('display', 'none')
        })

        function editSertifikat(id) {
            titleAction('Edit Sertifikat Surat', base_url('admin-cabang/request-sertifikat/sertifikat-penyerahan-anak/' +
                id))
            startloading('#' + modalSertifikat + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/admin-cabang/request-sertifikat/sertifikat-penyerahan-anak/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                setVal(modalSertifikat, 'nama_jemaat', response.data.nama_jemaat)
                setVal(modalSertifikat, 'tanggal_penyerahan_anak', response.data.tanggal_penyerahan_anak)
                setVal(modalSertifikat, 'jenis_kelamin', response.data.jenis_kelamin)
                setVal(modalSertifikat, 'tempat_lahir', response.data.tempat_lahir)
                setVal(modalSertifikat, 'tanggal_lahir', response.data.tanggal_lahir)
                setVal(modalSertifikat, 'nama_ayah', response.data.nama_ayah)
                setVal(modalSertifikat, 'nama_ibu', response.data.nama_ibu)
                setVal(modalSertifikat, 'nama_pendeta', response.data.nama_pendeta)
                setVal(modalSertifikat, 'saksi_pembimbing1', response.data.saksi_pembimbing1)
                setVal(modalSertifikat, 'saksi_pembimbing2', response.data.saksi_pembimbing2)

                $('#' + formSertifikat + ' #edit-foto').css('display', 'block')
                $('#' + formSertifikat + ' #edit-foto img').attr('src', s3_url + response.data.foto)
                $('#' + formSertifikat + ' #edit-ttdsaksi1').css('display', 'block')
                $('#' + formSertifikat + ' #edit-ttdsaksi1 img').attr('src', s3_url + response.data
                    .foto_ttd_saksi_pembimbing_1)
                $('#' + formSertifikat + ' #edit-ttdsaksi2').css('display', 'block')
                $('#' + formSertifikat + ' #edit-ttdsaksi2 img').attr('src', s3_url + response.data
                    .foto_ttd_saksi_pembimbing_2)

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
    </script>
@endsection
