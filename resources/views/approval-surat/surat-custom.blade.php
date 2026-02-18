@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Approval Surat Custom</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">

                            @include('approval-surat.isi-modal-demote')

                            <div class="">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-approve">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Approval</th>
                                            <th>Nama Surat</th>
                                            <th>Perihal</th>
                                            <th>Requester</th>
                                            <th>Status</th>
                                            <th>Alasan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approval_surat as $key => $item)
                                            <tr class="">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->approval_user_id }}</td>
                                                <td>{{ $item->nama_surat }}</td>
                                                <td>{{ $item->perihal }}</td>
                                                <td>{{ $item->user->nama }}</td>
                                                <td>{{ $item->status_surat->nama_status }}</td>
                                                <td>{{ $item->demote_reason }}</td>
                                                <td class="actions">
                                                    <a href="{{ url('approval/approve-surat/lihat/' . $item->surat_id, []) }}"
                                                        class="on-default" target="_blank"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#modalDemote"
                                                        class="on-default"
                                                        onclick="demote('{{ $item->surat_id }}')"><i
                                                            class="fa fa-times"></i></a>
                                                    <a href="{{ url('approval/approve-surat/approve/' . $item->surat_id, []) }}"
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

    @include('approval-surat.script')
@endsection
