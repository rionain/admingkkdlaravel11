@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Approval Surat Penunjukan</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">

                            <div id="modalDemote" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Ajukan Surat</h4>
                                        </div>
                                        <form action="{{ url('approval/approve-surat/surat-custom') }}" method="POST"
                                            enctype="multipart/form-data" id="formDemote">
                                            @csrf
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="alasan_demote" class="control-label">Alasan</label>
                                                    <input type="text" class="form-control" id="alasan_demote"
                                                        name="alasan_demote" placeholder="Demote.." required
                                                        value="{{ old('alasan_demote') }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {!! modalFooterZircos() !!}
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <div class="">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-approve">
                                    <thead>
                                        <tr>
                                            <th class='text-center table-number'>No</th>
                                            <th class='text-center'>Kategori Gereja</th>
                                            <th class='text-center'>Cabang</th>
                                            <th class='text-center'>Requester</th>
                                            <th class='text-center'>Status Surat</th>
                                            <th class='text-center'>Alasan</th>
                                            <th class='text-center'>Status Template</th>
                                            <th class='text-center'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approval_surat as $key => $item)
                                            <tr class="">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ @$item->user->cabang->kategori_gereja->kategori_gereja }}</td>
                                                <td>{{ @$item->user->cabang->nama_cabang }}</td>
                                                <td>{{ @$item->user->nama }}</td>
                                                <td>{{ @$item->status_surat->nama_status }}</td>
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
                                                <td class="actions">
                                                    <button class="btn btn-primary" style="margin-bottom: 5px;"
                                                        onclick="window.open('{{ url('approval/approve-surat/surat-penunjukan/lihat/' . $item->surat_penunjukan_id, []) }}', 'newwindow', 'width=1000,height=700,left=450'); return;">
                                                        <i class="fa fa-eye"></i>
                                                        Lihat</button>
                                                    <a href="#" data-toggle="modal" data-target="#modalDemote"
                                                        class="on-default"
                                                        onclick="demote('{{ $item->surat_penunjukan_id }}')"><i
                                                            class="fa fa-times"></i></a>
                                                    <a href="{{ url('approval/approve-surat/surat-penunjukan/approve/' . $item->surat_penunjukan_id, []) }}"
                                                        class="on-default"
                                                        onclick="return confirm('Apakah anda yakin?')"><i
                                                            class="fa fa-check"></i></a>
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
    <!-- Examples -->
    <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>

    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>

    <script src="{{ url('assets/pages/jquery.datatables.approve.init.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>

    <script>
        const modalSurat = 'modalDemote'
        // const modalDetailKop    = 'modalDetailKop'
        const formSurat = 'formDemote'

        $('#' + modalSurat).on('hidden.bs.modal', function() {
            titleActionSurat('', base_url(''))
            tutupModalSurat(modalSurat, 'alasan_demote')
        });

        function demote(id) {
            titleActionSurat('Demote surat', base_url(
                'approval/approve-surat/surat-penunjukan/demote/' + id))
            startloading('#' + modalSurat + ' .modal-dialog')

            var settings = {
                'url': base_url('api/v1/approval/approve-surat/surat-penunjukan/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                setVal(modalSurat, 'alasan_demote', response.data.alasan_demote)

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
