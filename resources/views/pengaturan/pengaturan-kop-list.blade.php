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
                            <h4 class="page-title">Kop Surat</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Pengaturan Kop Surat</b></h4>
                            <p class="text-muted font-13 m-b-30"></p>

                            {{-- <div class="card-box table-responsive"> --}}
                            <div class="">
                                {{-- ModalSample --}}
                                <div id="kopModal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"></button>
                                                <h4 class="modal-title">Tambah Kop</h4>
                                            </div>
                                            <form data-parsley-validate novalidate
                                                action="{{ url('/superadmin/pengaturan/kop-surat/tambah-kop') }}"
                                                method="POST" enctype="multipart/form-data" id="formKop">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="nama_kop_surat" class="control-label">Nama
                                                                    Kop<span class="text-danger">*</span></label>
                                                                <input parsley-trigger="change" required type="text"
                                                                    class="form-control" id="nama_kop_surat"
                                                                    name="nama_kop_surat" placeholder="Nama Kop..">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fieldTitleHeader" class="control-label">Title
                                                                    Header</label>
                                                                <input type="text" class="form-control"
                                                                    id="fieldTitleHeader" name="fieldTitleHeader"
                                                                    placeholder="Nama Instansi, Nama Organisasi..">
                                                            </div>
                                                            <div class="form-group no-margin">
                                                                <label for="fieldHeaderDescription"
                                                                    class="control-label">Header
                                                                    Description</label>
                                                                <textarea class="form-control autogrow"
                                                                    id="fieldHeaderDescription"
                                                                    name="fieldHeaderDescription"
                                                                    placeholder="Alamat atau deskripsi instansi.."
                                                                    style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-10">
                                                        <div class="form-group clearfix">
                                                            <label>Logo Kop</label>
                                                            <div class="col-sm-12 padding-left-0 padding-right-0">
                                                                <input id="fileKop" accept="image/*" type="file"
                                                                    class="filestyle" name="fileKop"
                                                                    data-buttonname="btn-primary">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {!! modalFooterZircos() !!}
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div id="lihatKop" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="width: 80%">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div id="lihatKopText"></div>
                                            </div>
                                            <div class="modal-body">
                                                <div id="lihatKopHtml"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="m-b-30">
                                            <button id="tambahKop" class="btn btn-success waves-effect waves-light"
                                                data-toggle="modal" data-target="#kopModal">
                                                Add <i class="mdi mdi-plus-circle-outline"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Template --}}

                                <table class="{{ styletable() }}" id="datatable-kop">
                                    <thead>
                                        <tr>
                                            <th class="text-center table-number">No</th>
                                            <th class="text-center">Nama Kop Surat</th>
                                            <th class="text-center">header description</th>
                                            <th class="text-center">Tanggal Pembuatan</th>
                                            <th class="text-center table-action">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kop as $key => $item)
                                            <tr class="">
                                                <td class="text-center">{{ ++$key }}</td>
                                                <td>{{ $item->nama_kop_surat }}</td>
                                                <td class="text-center">
                                                    <div class="panel">
                                                        {!! $item->headerdescription !!}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ format_date($item->created_date, 'd F Y, H:i:s') }}</td>
                                                <td class="actions text-center" class="text-center">
                                                    <div>
                                                        <button href="#" class="btn btn-primary btn-action"
                                                            data-toggle="modal" data-target="#lihatKop"
                                                            onclick="lihatKopAction('{{ $item->kop_id }}')">
                                                            <i class="fa fa-eye"></i> {{ showText() }}
                                                        </button>
                                                        <button href="#" class="btn btn-warning btn-action"
                                                            data-toggle="modal" data-target="#kopModal"
                                                            onclick="editKop('{{ $item->kop_id }}')">
                                                            <i class="fa fa-edit"></i> {{ editText() }}
                                                        </button>
                                                        <button href="#" class="btn btn-danger btn-action"
                                                            onclick="delConf('{{ url('superadmin/pengaturan/kop-surat/hapus/' . $item->kop_id) }}')">
                                                            <i class="fa fa-trash"></i> {{ deleteText() }}
                                                        </button>
                                                    </div>
                                                    {{-- <div class="btn-group" role="group">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <button href="#" class="btn btn-primary" data-toggle="modal"
                                                                    data-target="#lihatKop"
                                                                    onclick="lihatKopAction('{{ $item->kop_id }}')"><i
                                                                        class="fa fa-eye"></i></button>
                                                            </div>
                                                            <div class="col-4">
                                                                <button href="#" class="btn btn-warning" data-toggle="modal"
                                                                    data-target="#kopModal"
                                                                    onclick="editKop('{{ $item->kop_id }}')"><i
                                                                        class="fa fa-edit"></i></button>
                                                            </div>
                                                            <div class="col-4">
                                                                <button
                                                                    href="{{ url('superadmin/pengaturan/kop-surat/hapus/' . $item->kop_id) }}"
                                                                    class="btn btn-danger"
                                                                    onclick="return confirm('Apakah anda yakin?')"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end: page -->

                        </div> <!-- end Panel -->
                    </div>
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
    <script src="{{ url('assets/pages/jquery.datatables.kop.init.js') }}"></script>
    <script src="{{ url('assets/pages/jquery.fileuploads.init.js') }}"></script>
    <script src="{{ url('/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ url('assets/js/kop.js') }}"></script>
    <script type="text/javascript" src="{{ url('/plugins/parsleyjs/parsley.min.js') }}"></script>


    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
    <script>
        function generateKop() {
            var kopsurattest = $('#fieldNameKop').val();
        }
    </script>
    <script>
        function lihatKopAction(id) {
            startloading('#lihatKop .modal-dialog')
            var settings = {
                'url': base_url('api/v1/superadmin/pengaturan/kop-surat/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                $('#lihatKopText').html(`<h2 class="text-center">${response.data.nama_kop_surat}</h2>`)
                $('#lihatKopHtml').html(response.data.headerdescription)
                stoploading('#lihatKop .modal-dialog')
            }).
            fail(function(data, status, error) {
                console.log('data: ' + data)
                console.log('status: ' + status)
                console.log('error: ' + error)
                if (status == 'timeout') {
                    CekKonfirmasi('Timeout!', '')
                } else if (data.responseJSON.status == false) {
                    CekKonfirmasi(data.responseJSON.message, '')
                }
                stoploading('#lihatKop .modal-content')
            });
        }
    </script>
@endsection
