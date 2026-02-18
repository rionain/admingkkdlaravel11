@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Proposal Doa</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            {{-- ModalSample --}}
                            @include('proposal.modal')
                            {{-- end modal --}}

                            <div class="" style=" overflow: auto">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-proposal">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Proposal</th>
                                            <th class="text-center">Jenis Proposal</th>
                                            <th class="text-center">Requester</th>
                                            <th class="text-center">Status Proposal</th>
                                            <th class="text-center">Alasan</th>
                                            <th class="text-center">Tanggal Approve</th>
                                            <th class="text-center">Proposal</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proposal as $key => $item)
                                            <tr class="">
                                                <td class="
                                                text-center">
                                                    {{ ++$key }}</td>
                                                <td class="text-center">{{ $item->nama_proposal }}</td>
                                                <td class="text-center">{{ @$item->jenis_proposal->jenis_proposal }}
                                                </td>
                                                <td class="text-center">{{ @$item->user->nama }}</td>
                                                <td class="text-center">
                                                    @if ($item->lfk_status_proposal_id == 3)
                                                        <span
                                                            class="badge badge-success">{{ @$item->status_proposal->status_proposal }}</span>
                                                    @elseif ($item->lfk_status_proposal_id == 2)
                                                        <span
                                                            class="badge badge-danger">{{ @$item->status_proposal->status_proposal }}</span>
                                                    @elseif ($item->lfk_status_proposal_id == 1)
                                                        <span
                                                            class="badge badge-warning">{{ @$item->status_proposal->status_proposal }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-info">{{ @$item->status_proposal->status_proposal }}</span>
                                                    @endif

                                                </td>
                                                <td class="text-center">{{ $item->demote_reason }}</td>
                                                <td class="text-center">
                                                    @if ($item->lfk_status_proposal_id == 3)
                                                        {{ $item->approval_date }}
                                                    @else
                                                        <span class="badge badge-danger">Belum disetujui</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    @if ($item->proposal_link)
                                                        <a class="btn btn-default" target="_blank"
                                                            href="{{ S3Helper::get($item->proposal_link) }}">Lihat</a>
                                                    @else
                                                        <span class="badge badge-danger">Tidak ada</span>
                                                    @endif
                                                </td>
                                                <td class="actions text-center">
                                                    <div class="btn-group">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-warning"
                                                                    data-toggle="modal" data-target="#modalProposal"
                                                                    onclick="editProposal(`{{ $item->proposal_id }}`)"><i
                                                                        class="fa fa-pencil"></i></button>
                                                            </div>
                                                            {{-- <div class="col-6">
                                                                <button type="button" class="btn btn-danger"><i
                                                                        class="fa fa-trash-o"></i></button>
                                                            </div> --}}
                                                        </div>

                                                    </div>
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

    <script src="{{ url('assets/pages/jquery.datatables.proposal.init.js') }}"></script>

    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>

    @include('proposal.script')
@endsection
