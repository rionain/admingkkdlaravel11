@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Sertifikat Baptis</h4>
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
                                                    <label for="nama_jemaat" class="control-label">Nama Jemaat</label>
                                                    <input type="text" class="form-control" id="nama_jemaat"
                                                        name="nama_jemaat" placeholder="Nama jemaat" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_baptis" class="control-label">Tempat
                                                                Baptis</label>
                                                            <input type="text" class="form-control" id="tempat_baptis"
                                                                name="tempat_baptis" placeholder="Tempat baptis" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_baptis" class="control-label">Tanggal
                                                                Baptis</label>
                                                            <input type="date" class="form-control" id="tanggal_baptis"
                                                                name="tanggal_baptis" placeholder="Tanggal baptis" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir" class="control-label">Tempat
                                                                Lahir</label>
                                                            <input type="text" class="form-control" id="tempat_lahir"
                                                                name="tempat_lahir" placeholder="Tempat lahir" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir" class="control-label">Tanggal
                                                                Lahir</label>
                                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                                name="tanggal_lahir">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_ayah" class="control-label">Nama Ayah</label>
                                                            <input type="text" class="form-control" id="nama_ayah"
                                                                name="nama_ayah" placeholder="Nama ayah" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_ibu" class="control-label">Nama Ibu</label>
                                                            <input type="text" class="form-control" id="nama_ibu"
                                                                name="nama_ibu" placeholder="Nama ibu" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_pembaptis" class="control-label">Nama
                                                        Pembaptis</label> <br> <small class="text-danger">* Maksimal input
                                                        30 karakter</small>
                                                    <input type="text" class="form-control" id="nama_pembaptis"
                                                        name="nama_pembaptis" placeholder="Nama Pembaptis" maxlength="30"
                                                        required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="saksi1" class="control-label">Saksi 1</label>
                                                            <br> <small class="text-danger">* Maksimal input 30
                                                                karakter</small>
                                                            <input type="text" class="form-control" id="saksi1"
                                                                name="saksi1" placeholder="Saksi 1" maxlength="30"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="saksi2" class="control-label">Saksi 2</label>
                                                            <br> <small class="text-danger">* Maksimal input 30
                                                                karakter</small>
                                                            <input type="text" class="form-control" id="saksi2"
                                                                name="saksi2" placeholder="Saksi 2" maxlength="30"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ttdsaksi1" class="control-label">Foto Tanda Tangan
                                                                Saksi 1</label>
                                                            <div id="edit-ttdsaksi1" style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                <span class="text-danger"><small>* Kosongkan bila tidak
                                                                        ingin mengubah
                                                                        foto</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="ttdsaksi1" name="ttdsaksi1"
                                                                placeholder="TTD Saksi 1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ttdsaksi2" class="control-label">Foto Tanda Tangan
                                                                Saksi 2</label>
                                                            <div id="edit-ttdsaksi2" style="display: none">
                                                                <img src="" alt=""
                                                                    style="width: 100px;"><br>
                                                                <span class="text-danger"><small>* Kosongkan bila tidak
                                                                        ingin mengubah
                                                                        foto</small></span>
                                                            </div>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="ttdsaksi2" name="ttdsaksi2"
                                                                placeholder="TTD Saksi 2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto_jemaat" class="control-label">Foto Jemaat <small
                                                            class="text-danger">Ukuran 4:6</small></label>
                                                    <div id="edit-foto" style="display: none">
                                                        <img src="" alt="" style="width: 100px;"><br>
                                                        <span class="text-danger"><small>* Kosongkan bila tidak ingin
                                                                mengubah
                                                                foto</small></span>
                                                    </div>
                                                    <input type="file" accept="image/*" class="form-control"
                                                        id="foto_jemaat" name="foto_jemaat">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_pendeta" class="control-label">Nama Pendeta
                                                    </label> <br> <small class="text-danger">* Maksimal input 30
                                                        karakter</small>
                                                    <input type="text" class="form-control" id="nama_pendeta"
                                                        name="nama_pendeta" placeholder="Nama pendeta" maxlength="30">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_kota" class="control-label">Nama Kota</label>
                                                    <input type="text" class="form-control" id="nama_kota"
                                                        name="nama_kota" placeholder="Nama Kota">
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto_tanda_tangan" class="control-label">Foto Tanda
                                                        Tangan</label>
                                                    <div id="edit-foto_tanda_tangan" style="display: none">
                                                        <img src="" alt="" style="width: 100px;"><br>
                                                        <span class="text-danger">* kosongkan bila tidak ingin mengubah
                                                            foto</span>
                                                    </div>
                                                    <input type="file" class="form-control" id="foto_tanda_tangan"
                                                        name="foto_tanda_tangan" {!! AcceptImage() !!}>
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
                            {{-- End Modal Template --}}
                            <div style="overflow: auto">
                                <table class="table table-striped add-edit-table table-bordered"
                                    id="datatable-sertifikat">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No surat</th>
                                            <th>Jemaat</th>
                                            <th>Baptis</th>
                                            <th>Pembaptis</th>
                                            <th>Saksi 1</th>
                                            <th>Saksi 2</th>
                                            <th>pendeta</th>
                                            <th>Kota</th>
                                            <th>Status</th>
                                            <th>Alasan Demote</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sertifikat as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td style="min-width: 150px;">{{ $value->no_sertifikat }}</td>
                                                <td style="min-width: 300px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <b>{!! $value->nama_jemaat ?: badge('danger', 'Nama jemaat kosong') !!}</b><br>
                                                            {!! $value->tempat_lahir ?: badge('danger', 'Tempat lahir kosong') !!}, {!! tanggal_indonesia(format_date($value->tanggal_lahir, 'Y-m-d')) ?: badge('danger', 'Tgl lahir kosong') !!} <br>
                                                            @if ($value->foto_jemaat)
                                                                <a href="{{ S3Helper::get($value->foto_jemaat) }}"
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
                                                <td style="min-width: 150px;">
                                                    <b>{{ $value->tempat_baptis }}</b> <br>
                                                    {!! tanggal_indonesia(format_date($value->tanggal_baptis, 'Y-m-d')) ?: badge('danger', 'Tgl baptis kosong') !!}
                                                </td>
                                                <td>{{ $value->nama_pembaptis }}</td>
                                                <td class='text-center' style="min-width: 170px;">
                                                    {!! $value->saksi1 ?: badge('danger', 'Nama saksi 1 kosong') !!} <br>
                                                    @if ($value->foto_ttd_saksi_1)
                                                        <a href="{{ S3Helper::get($value->foto_ttd_saksi_1) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat TTD Saksi
                                                            1</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger">Foto tidak ada</div> <br>
                                                    @endif
                                                </td>
                                                <td class='text-center' style="min-width: 170px;">
                                                    {!! $value->saksi2 ?: badge('danger', 'Nama saksi 2 kosong') !!} <br>
                                                    @if ($value->foto_ttd_saksi_2)
                                                        <a href="{{ S3Helper::get($value->foto_ttd_saksi_2) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat TTD Saksi
                                                            2</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger">Foto tidak ada</div> <br>
                                                    @endif
                                                </td>
                                                <td class='text-center' style="min-width: 170px;">
                                                    {!! $value->nama_pendeta ?: badge('danger', 'Nama pendeta kosong') !!} <br>
                                                    @if ($value->foto_tanda_tangan)
                                                        <a href="{{ S3Helper::get($value->foto_tanda_tangan) }}"
                                                            class="btn btn-xs btn-warning" target="_blank">Lihat TTD
                                                            Pendeta</a> <br>
                                                    @else
                                                        <div class="badge badge-xs badge-danger">Foto tidak ada</div> <br>
                                                    @endif
                                                </td>
                                                <td style="min-width: 120px;">{{ $value->nama_kota }}</td>
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
                                                        <a href="{{ url("admin-cabang/request-sertifikat/sertifikat-baptis/$value->sertifikat_baptis_id/print-view") }}"
                                                            target="_blank"
                                                            class="btn btn-icon waves-effect waves-light btn-success m-b-5"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="View PDF"><i class="fa fa-file-pdf-o"></i> View PDF</a>
                                                    @elseif ($value->lfk_status_sertifikat_id == 3)
                                                        <a href="#"
                                                            class="btn btn-icon waves-effect waves-light btn-info m-b-5"
                                                            data-placement="top" title="Edit" data-toggle="modal"
                                                            data-target="#modalSertifikat"
                                                            onclick="editSertifikat(`{{ $value->sertifikat_baptis_id }}`)"><i
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

        $(function() {
            sertifikatBaptisValidation(formSertifikat)
        })

        $('#addSertifikat').on('click', function() {
            titleAction('Form Tambah Sertifikat', base_url('admin-cabang/request-sertifikat/sertifikat-baptis'))
        })

        $('#' + modalSertifikat).on('hidden.bs.modal', function() {
            titleAction('', base_url(''))
            hiddenModal(modalSertifikat, 'nama_jemaat')
            hiddenModal(modalSertifikat, 'tempat_baptis')
            hiddenModal(modalSertifikat, 'tanggal_baptis')
            hiddenModal(modalSertifikat, 'tempat_lahir')
            hiddenModal(modalSertifikat, 'tanggal_lahir')
            hiddenModal(modalSertifikat, 'nama_ayah')
            hiddenModal(modalSertifikat, 'nama_ibu')
            hiddenModal(modalSertifikat, 'nama_pendeta')
            hiddenModal(modalSertifikat, 'saksi1')
            hiddenModal(modalSertifikat, 'saksi2')
            hiddenModal(modalSertifikat, 'nama_pembaptis')
            hiddenModal(modalSertifikat, 'foto_jemaat')
            hiddenModal(modalSertifikat, 'foto_tanda_tangan')
            hiddenModal(modalSertifikat, 'nama_kota')

            $('#' + formSertifikat + ' #edit-foto').css('display', 'none')
            $('#' + formSertifikat + ' #edit-ttdsaksi1').css('display', 'none')
            $('#' + formSertifikat + ' #edit-ttdsaksi2').css('display', 'none')
            $('#' + formSertifikat + ' #edit-foto_tanda_tangan').css('display', 'none')
        })

        function editSertifikat(id) {
            titleAction('Edit Sertifikat Surat', base_url('admin-cabang/request-sertifikat/sertifikat-baptis/' + id))
            startloading('#' + modalSertifikat + ' .modal-dialog')
            var settings = {
                'url': base_url('api/v1/admin-cabang/request-sertifikat/sertifikat-baptis/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                setVal(modalSertifikat, 'nama_jemaat', response.data.nama_jemaat)
                setVal(modalSertifikat, 'tempat_baptis', response.data.tempat_baptis)
                setVal(modalSertifikat, 'tanggal_baptis', response.data.tanggal_baptis)
                setVal(modalSertifikat, 'tempat_lahir', response.data.tempat_lahir)
                setVal(modalSertifikat, 'tanggal_lahir', response.data.tanggal_lahir)
                setVal(modalSertifikat, 'nama_ayah', response.data.nama_ayah)
                setVal(modalSertifikat, 'nama_ibu', response.data.nama_ibu)
                setVal(modalSertifikat, 'nama_pembaptis', response.data.nama_pembaptis)
                setVal(modalSertifikat, 'saksi1', response.data.saksi1)
                setVal(modalSertifikat, 'saksi2', response.data.saksi2)
                setVal(modalSertifikat, 'nama_pendeta', response.data.nama_pendeta)
                setVal(modalSertifikat, 'nama_kota', response.data.nama_kota)

                $('#' + formSertifikat + ' #edit-foto').css('display', 'block')
                $('#' + formSertifikat + ' #edit-foto img').attr('src', s3_url + response.data.foto_jemaat)
                $('#' + formSertifikat + ' #edit-foto_tanda_tangan').css('display', 'block')
                $('#' + formSertifikat + ' #edit-foto_tanda_tangan img').attr('src', s3_url + response.data.foto_tanda_tangan)
                $('#' + formSertifikat + ' #edit-ttdsaksi1').css('display', 'block');
                $('#' + formSertifikat + ' #edit-ttdsaksi1 img').attr('src', s3_url + response.data.foto_ttd_saksi_1);
                $('#' + formSertifikat + ' #edit-ttdsaksi2').css('display', 'block');
                $('#' + formSertifikat + ' #edit-ttdsaksi2 img').attr('src', s3_url + response.data.foto_ttd_saksi_2);

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

        function sertifikatBaptisValidation(id) {
            $('#' + id).validate({
                rules: {
                    nama_jemaat: {
                        required: true
                    },
                    tempat_baptis: {
                        required: true
                    },
                    tanggal_baptis: {
                        required: true
                    },
                    tempat_baptis: {
                        required: true
                    },
                    tempat_lahir: {
                        required: true
                    },
                    tanggal_lahir: {
                        required: true
                    },
                    nama_ayah: {
                        required: true
                    },
                    nama_ibu: {
                        required: true
                    },
                    nama_pembaptis: {
                        required: true
                    },
                    saksi1: {
                        required: true
                    },
                    saksi2: {
                        required: true
                    },
                    // foto_jemaat: {
                    //     required: true
                    // },
                    nama_pendeta: {
                        required: true
                    },
                    nama_kota: {
                        required: true
                    },
                    // foto_tanda_tangan: {
                    //     required: true
                    // }

                },
                messages: {
                    nama_jemaat: {
                        required: 'Nama jemaat tidak boleh kosong'
                    },
                    tempat_baptis: {
                        required: 'Tempat baptis tidak boleh kosong'
                    },
                    tanggal_baptis: {
                        required: 'Tanggal baptis tidak boleh kosong'
                    },
                    tempat_baptis: {
                        required: 'Tempat baptis tidak boleh kosong'
                    },
                    tempat_lahir: {
                        required: 'Tempat lahir tidak boleh kosong'
                    },
                    tanggal_lahir: {
                        required: 'Tanggal lahir tidak boleh kosong'
                    },
                    nama_ayah: {
                        required: 'Nama ayah tidak boleh kosong'
                    },
                    nama_ibu: {
                        required: 'Nama ibu tidak boleh kosong'
                    },
                    nama_pembaptis: {
                        required: 'Nama pembaptis tidak boleh kosong'
                    },
                    saksi1: {
                        required: 'Saksi 1 tidak boleh kosong'
                    },
                    saksi2: {
                        required: 'Saksi 2 tidak boleh kosong'
                    },
                    foto_jemaat: {
                        required: 'Foto jemaat tidak boleh kosong'
                    },
                    nama_pendeta: {
                        required: 'Nama pendeta tidak boleh kosong'
                    },
                    nama_kota: {
                        required: 'Nama kota tidak boleh kosong'
                    },
                    foto_tanda_tangan: {
                        required: 'Foto tanda tangan tidak boleh kosong'
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
