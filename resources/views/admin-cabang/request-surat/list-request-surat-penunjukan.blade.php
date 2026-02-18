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
                            <h4 class="page-title">Request Surat Penunjukan</h4>
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
                                                {{-- nama_gereja --}}
                                                <div class="form-group">
                                                    <label for="nama_gereja">Nama Gereja</label>
                                                    <input type="text" class="form-control" id="nama_gereja"
                                                        name="nama_gereja" placeholder="Nama Gereja" required
                                                        value="{{ old('nama_gereja') }}">
                                                </div>
                                                {{-- alamat_lengkap_gereja --}}
                                                <div class="form-group">
                                                    <label for="alamat_lengkap_gereja">Alamat Lengkap Gereja</label>
                                                    <textarea class="form-control" id="alamat_lengkap_gereja"
                                                        name="alamat_lengkap_gereja" rows="3"
                                                        placeholder="Alamat Lengkap Gereja"
                                                        required>{{ old('alamat') }}</textarea>
                                                </div>
                                                <hr>
                                                <h5 class="text-center">Ketua</h5>
                                                <div class="form-group">
                                                    <label for="nama_ketua">Nama Ketua</label>
                                                    <input type="text" class="form-control" id="nama_ketua"
                                                        name="nama_ketua" placeholder="Nama Ketua" required
                                                        value="{{ old('nama_ketua') }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir_ketua">Tempat Lahir Ketua</label>
                                                            <input type="text" class="form-control"
                                                                id="tempat_lahir_ketua" name="tempat_lahir_ketua"
                                                                placeholder="Tempat Lahir Ketua" required
                                                                value="{{ old('tempat_lahir_ketua') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir_ketua">Tanggal Lahir Ketua</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_lahir_ketua" name="tanggal_lahir_ketua" required
                                                                value="{{ old('tanggal_lahir_ketua') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat_ketua">Alamat Ketua</label>
                                                    <textarea class="form-control" id="alamat_ketua" name="alamat_ketua"
                                                        rows="3" placeholder="Alamat Ketua"
                                                        required>{{ old('alamat_ketua') }}</textarea>
                                                </div>
                                                <hr>
                                                <h5 class="text-center">Sekretaris</h5>
                                                <div class="form-group">
                                                    <label for="nama_sekretaris">Nama Sekretaris</label>
                                                    <input type="text" class="form-control" id="nama_sekretaris"
                                                        name="nama_sekretaris" placeholder="Nama Sekretaris" required
                                                        value="{{ old('nama_sekretaris') }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir_sekretaris">Tempat Lahir
                                                                Sekretaris</label>
                                                            <input type="text" class="form-control"
                                                                id="tempat_lahir_sekretaris" name="tempat_lahir_sekretaris"
                                                                placeholder="Tempat Lahir Sekretaris" required
                                                                value="{{ old('tempat_lahir_sekretaris') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir_sekretaris">Tanggal Lahir
                                                                Sekretaris</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_lahir_sekretaris"
                                                                name="tanggal_lahir_sekretaris" required
                                                                value="{{ old('tanggal_lahir_sekretaris') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat_sekretaris">Alamat Sekretaris</label>
                                                    <textarea class="form-control" id="alamat_sekretaris"
                                                        name="alamat_sekretaris" rows="3" placeholder="Alamat Sekretaris"
                                                        required>{{ old('alamat_sekretaris') }}</textarea>
                                                </div>
                                                <hr>
                                                <h5 class="text-center">Bendahara</h5>
                                                <div class="form-group">
                                                    <label for="nama_bendahara">Nama Bendahara</label>
                                                    <input type="text" class="form-control" id="nama_bendahara"
                                                        name="nama_bendahara" placeholder="Nama Bendahara" required
                                                        value="{{ old('nama_bendahara') }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir_bendahara">Tempat Lahir
                                                                Bendahara</label>
                                                            <input type="text" class="form-control"
                                                                id="tempat_lahir_bendahara" name="tempat_lahir_bendahara"
                                                                placeholder="Tempat Lahir Bendahara" required
                                                                value="{{ old('tempat_lahir_bendahara') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir_bendahara">Tanggal Lahir
                                                                Bendahara</label>
                                                            <input type="date" class="form-control"
                                                                id="tanggal_lahir_bendahara" name="tanggal_lahir_bendahara"
                                                                required value="{{ old('tanggal_lahir_bendahara') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat_bendahara">Alamat Bendahara</label>
                                                    <textarea class="form-control" id="alamat_bendahara"
                                                        name="alamat_bendahara" rows="3" placeholder="Alamat Bendahara"
                                                        required>{{ old('alamat_bendahara') }}</textarea>
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
                                            <th class='text-center'>Nama gereja</th>
                                            <th class='text-center'>Nama ketua</th>
                                            <th class='text-center'>Nama sekretaris</th>
                                            <th class='text-center'>Nama bendata</th>
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
                                                <td>{{ @$item->nama_gereja }}</td>
                                                <td>{{ @$item->nama_ketua }}</td>
                                                <td>{{ @$item->nama_sekretaris }}</td>
                                                <td>{{ @$item->nama_bendahara }}</td>
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
                                                    @if ($item->pengaturan_surat_penunjukan_id)
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
                                                            onclick="revisiSurat('{{ $item->surat_penunjukan_id }}')">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    @elseif($item->status_surat_id == 6)
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <button class="btn btn-primary" style="margin-bottom: 5px;"
                                                                onclick="window.open('{{ url('admin-cabang/request-surat/surat-penunjukan/lihat/' . $item->surat_penunjukan_id, []) }}', 'newwindow', 'width=1000,height=700,left=450'); return;">
                                                                <i class="fa fa-eye"></i>
                                                                Lihat</button>
                                                        </div>
                                                    @else
                                                        <div class="btn-group btn-group-justified m-b-10 text-center">
                                                            <a href="#"
                                                                onclick="delConf('{{ url('admin-cabang/request-surat/surat-penunjukan/hapus/' . $item->surat_penunjukan_id) }}')"
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
    </script>
    <script>
        const modalSurat = 'modalSurat'
        // const modalDetailKop    = 'modalDetailKop'
        const formSurat = 'formSurat'

        $(`#btnTambahRequestSurat`).click(function() {
            titleActionSurat('Request surat', base_url('admin-cabang/request-surat/surat-penunjukan'))
        });
        $('#' + modalSurat).on('hidden.bs.modal', function() {
            titleActionSurat('', base_url(''))
            tutupModalSurat(modalSurat, 'nama_gereja')
            tutupModalSurat(modalSurat, 'alamat_lengkap_gereja')
            tutupModalSurat(modalSurat, 'nama_ketua')
            tutupModalSurat(modalSurat, 'tempat_lahir_ketua')
            tutupModalSurat(modalSurat, 'tanggal_lahir_ketua')
            tutupModalSurat(modalSurat, 'alamat_ketua')
            tutupModalSurat(modalSurat, 'nama_sekretaris')
            tutupModalSurat(modalSurat, 'tempat_lahir_sekretaris')
            tutupModalSurat(modalSurat, 'tanggal_lahir_sekretaris')
            tutupModalSurat(modalSurat, 'alamat_sekretaris')
            tutupModalSurat(modalSurat, 'nama_bendahara')
            tutupModalSurat(modalSurat, 'tempat_lahir_bendahara')
            tutupModalSurat(modalSurat, 'tanggal_lahir_bendahara')
            tutupModalSurat(modalSurat, 'alamat_bendahara')
        });

        function revisiSurat(id) {
            titleActionSurat('Revisi surat', base_url(
                'admin-cabang/request-surat/surat-penunjukan/revisi/' + id))
            startloading('#' + modalSurat + ' .modal-dialog')

            var settings = {
                'url': base_url('api/v1/admin-cabang/request-surat/surat-penunjukan/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                setVal(modalSurat, 'nama_gereja', response.data.nama_gereja)
                setVal(modalSurat, 'alamat_lengkap_gereja', response.data.alamat_lengkap_gereja)
                setVal(modalSurat, 'nama_ketua', response.data.nama_ketua)
                setVal(modalSurat, 'tempat_lahir_ketua', response.data.tempat_lahir_ketua)
                setVal(modalSurat, 'tanggal_lahir_ketua', response.data.tanggal_lahir_ketua)
                setVal(modalSurat, 'alamat_ketua', response.data.alamat_ketua)
                setVal(modalSurat, 'nama_sekretaris', response.data.nama_sekretaris)
                setVal(modalSurat, 'tempat_lahir_sekretaris', response.data.tempat_lahir_sekretaris)
                setVal(modalSurat, 'tanggal_lahir_sekretaris', response.data.tanggal_lahir_sekretaris)
                setVal(modalSurat, 'alamat_sekretaris', response.data.alamat_sekretaris)
                setVal(modalSurat, 'nama_bendahara', response.data.nama_bendahara)
                setVal(modalSurat, 'tempat_lahir_bendahara', response.data.tempat_lahir_bendahara)
                setVal(modalSurat, 'tanggal_lahir_bendahara', response.data.tanggal_lahir_bendahara)
                setVal(modalSurat, 'alamat_bendahara', response.data.alamat_bendahara)

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
