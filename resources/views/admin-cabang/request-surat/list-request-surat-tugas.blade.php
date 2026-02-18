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
                            <h4 class="page-title">Request Surat Tugas</h4>
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
                                                    <label for="tugas" class="control-label">Tugas</label>
                                                    <input type="text" name="tugas" id="tugas" class="form-control"
                                                        value="{{ old('tugas') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_tugas" class="control-label">Tanggal
                                                        Tugas</label>
                                                    <input type="date" name="tanggal_tugas" id="tanggal_tugas"
                                                        class="form-control" value="{{ old('tanggal_tugas') }}">
                                                </div>
                                                {{-- tempat_tugas --}}
                                                <div class="form-group">
                                                    <label for="tempat_tugas" class="control-label">Tempat Tugas</label>
                                                    <input type="text" name="tempat_tugas" id="tempat_tugas"
                                                        class="form-control" value="{{ old('tempat_tugas') }}">
                                                </div>
                                                {{-- petugas textarea --}}
                                                <div class="form-group">
                                                    <label for="petugas" class="control-label">Petugas</label>
                                                    <textarea name="petugas" id="petugas" cols="30" rows="10"
                                                        class="form-control">{{ old('petugas') }}</textarea>
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
                                            <th class='text-center table-number'>No</th>
                                            <th class='text-center'>Requester</th>
                                            <th class='text-center'>tugas</th>
                                            <th class='text-center'>Status Surat</th>
                                            <th class='text-center'>Alasan</th>
                                            <th class='text-center'>Status Template</th>
                                            <th class='text-center'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surat as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ ++$key }}</td>
                                                <td>{{ @$item->user->nama }}</td>
                                                <td>
                                                    {{ @$item->tugas }}
                                                </td>
                                                <td class="text-center">
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
                                                    @if ($item->alasan_demote != null)
                                                        {{ $item->alasan_demote }}
                                                    @else
                                                        <span class="badge badge-danger">Kosong</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->pengaturan_surat_tugas_id)
                                                        <span class="badge badge-success">Sudah ada template</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum ada template</span>
                                                    @endif
                                                </td>
                                                <td class="actions text-center"
                                                    style="width: 100px; overflow: hidden; max-width: 120px;">
                                                    @if ($item->status_surat_id == 5)
                                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#modalSurat"
                                                            onclick="revisiSurat('{{ $item->surat_tugas_id }}')">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    @elseif($item->status_surat_id == 6)
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <button class="btn btn-primary" style="margin-bottom: 5px;"
                                                                onclick="window.open('{{ url('admin-cabang/request-surat/surat-tugas/lihat/' . $item->surat_tugas_id, []) }}', 'newwindow', 'width=1000,height=700,left=450'); return;">
                                                                <i class="fa fa-eye"></i>
                                                                Lihat</button>
                                                        </div>
                                                    @else
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <a href="#"
                                                                onclick="delConf('{{ url('admin-cabang/request-surat/surat-tugas/hapus/' . $item->surat_tugas_id) }}')"
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
    </script>
    <script>
        function generateKop() {
            var kopsurattest = $('#fieldNameKop').val();
        }
        $(`#datatable-reqsurat`).DataTable({})

        $('#petugas').summernote({
            minHeight: '200px'
        });
        $('#petugas').summernote('code', $('#petugas').val());
    </script>
    <script>
        const modalSurat = 'modalSurat'
        // const modalDetailKop    = 'modalDetailKop'
        const formSurat = 'formSurat'

        $(`#btnTambahRequestSurat`).click(function() {
            titleActionSurat('Request surat', base_url('admin-cabang/request-surat/surat-tugas'))
        });
        $('#' + modalSurat).on('hidden.bs.modal', function() {
            titleActionSurat('', base_url(''))
            tutupModalSurat(modalSurat, 'tugas')
            tutupModalSurat(modalSurat, 'tanggal_tugas')
            tutupModalSurat(modalSurat, 'tempat_tugas')
            tutupModalSurat(modalSurat, 'petugas')

            $('#petugas').summernote('code', $('#petugas').val());
        });

        function revisiSurat(id) {
            titleActionSurat('Revisi surat', base_url(
                'admin-cabang/request-surat/surat-tugas/revisi/' + id))
            startloading('#' + modalSurat + ' .modal-dialog')

            var settings = {
                'url': base_url('api/v1/admin-cabang/request-surat/surat-tugas/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                setVal(modalSurat, 'tugas', response.data.tugas)
                setVal(modalSurat, 'tanggal_tugas', response.data.tanggal_tugas)
                setVal(modalSurat, 'tempat_tugas', response.data.tempat_tugas)
                setVal(modalSurat, 'petugas', response.data.petugas)

                $('#petugas').summernote('code', $('#petugas').val());

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
