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
                            <h4 class="page-title">Request Surat Keputusan</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">

                            <div id="modalSurat" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Ajukan Surat</h4>
                                        </div>
                                        <form action="{{ url('admin-cabang/request-surat/surat-keterangan') }}"
                                            method="POST" enctype="multipart/form-data" id="formSurat">
                                            @csrf
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama_gereja">Nama Gereja</label>
                                                    <input type="text" class="form-control" id="nama_gereja"
                                                        name="nama_gereja" placeholder="Nama Gereja" required
                                                        value="{{ old('nama_gereja') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_persetujuan">Tanggal Persetujuan</label>
                                                    <input type="date" class="form-control" id="tanggal_persetujuan"
                                                        name="tanggal_persetujuan" placeholder="Tanggal Persetujuan"
                                                        required value="{{ old('tanggal_persetujuan') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_lengkap">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="nama_lengkap"
                                                        name="nama_lengkap" placeholder="Nama Lengkap" required
                                                        value="{{ old('nama_lengkap') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tempat_lahir"
                                                        name="tempat_lahir" placeholder="Tempat Lahir" required
                                                        value="{{ old('tempat_lahir') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tanggal_lahir"
                                                        name="tanggal_lahir" placeholder="Tanggal Lahir" required
                                                        value="{{ old('tanggal_lahir') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jabatan">Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                                        placeholder="Jabatan" required value="{{ old('jabatan') }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-light">Ajukan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">

                                        <button id="btnTambahRequestSurat" class="btn btn-success waves-effect waves-light"
                                            data-toggle="modal" data-target="#modalSurat">Request<i
                                                class="mdi mdi-plus-circle-outline"></i></button>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <div class="">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-reqsurat">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>nama lengkap</th>
                                            <th>Status Surat</th>
                                            <th>Alasan Demote</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surat as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>
                                                    @if ($item->status_surat_id == 5)
                                                        <span class="badge badge-danger">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @elseif ($item->status_surat_id == 1)
                                                        <span class="badge badge-info">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @elseif ($item->status_surat_id == 6)
                                                        <span class="badge badge-success">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            {{ @$item->status_surat->nama_status }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status_surat_id == 5)
                                                        {{ $item->alasan_demote }}
                                                    @else
                                                        <span class="badge badge-success">
                                                            KOSONG
                                                        </span>
                                                    @endif

                                                </td>
                                                <td class="actions text-center"
                                                    style="width: 100px; overflow: hidden; max-width: 120px;">
                                                    @if ($item->status_surat_id == 5)
                                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#modalSurat"
                                                            onclick="revisiSurat('{{ $item->surat_keputusan_id }}')">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    @elseif($item->status_surat_id == 6)
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <button class="btn btn-primary" style="margin-bottom: 5px;"
                                                                onclick="window.open('{{ url('admin-cabang/request-surat/surat-keputusan/lihat/' . $item->surat_keputusan_id, []) }}', 'newwindow', 'width=1000,height=700,left=450'); return;">
                                                                <i class="fa fa-eye"></i>
                                                                Lihat</button>
                                                        </div>
                                                    @else
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <a href="#"
                                                                onclick="delConf('{{ url('admin-cabang/request-surat/surat-keputusan/hapus/' . $item->surat_keputusan_id) }}')"
                                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    @endif
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
    <script src="{{ url('assets/pages/jquery.fileuploads.init.js') }}"></script>
    <script src="{{ url('/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ url('/assets/js/admcabang/reqsurat.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
        $('#datatable-reqsurat').DataTable({});
    </script>
    <script>
        function generateKop() {
            var kopsurattest = $('#fieldNameKop').val();
        }
    </script>
    <script>
        const modalSurat = 'modalSurat'
        // const modalDetailKop    = 'modalDetailKop'
        const formSurat = 'formSurat'

        $(`#btnTambahRequestSurat`).click(function() {
            titleActionSurat('Request surat', base_url('admin-cabang/request-surat/surat-keputusan'))
        });
        $('#' + modalSurat).on('hidden.bs.modal', function() {
            titleActionSurat('', base_url(''))
            tutupModalSurat(modalSurat, 'nama_gereja')
            tutupModalSurat(modalSurat, 'tanggal_persetujuan')
            tutupModalSurat(modalSurat, 'nama_lengkap')
            tutupModalSurat(modalSurat, 'tempat_lahir')
            tutupModalSurat(modalSurat, 'tanggal_lahir')
            tutupModalSurat(modalSurat, 'jabatan')
        });

        function revisiSurat(id) {
            titleActionSurat('Revisi surat', base_url(
                'admin-cabang/request-surat/surat-keputusan/revisi/' + id))
            startloading('#' + modalSurat + ' .modal-dialog')

            var settings = {
                'url': base_url('api/v1/admin-cabang/request-surat/surat-keputusan/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                setVal(modalSurat, 'nama_gereja', response.data.nama_gereja)
                setVal(modalSurat, 'tanggal_persetujuan', response.data.tanggal_persetujuan)
                setVal(modalSurat, 'nama_lengkap', response.data.nama_lengkap)
                setVal(modalSurat, 'tempat_lahir', response.data.tempat_lahir)
                setVal(modalSurat, 'tanggal_lahir', response.data.tanggal_lahir)
                setVal(modalSurat, 'jabatan', response.data.jabatan)

                stoploading('#' + modalSurat + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalSurat + ' .modal-dialog')
            });
        }

        function titleActionSurat(title, action) {
            $('#' + modalSurat + ' .modal-title').html(title)
            $('#' + modalSurat + ' #' + formSurat).attr('action', action)
        }

        function tutupModalSurat(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>
@endsection
