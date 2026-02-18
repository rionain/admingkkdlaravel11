@extends('layouts.layout')

@section('css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Tembusan Surat</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box table-responsive">
                            {{-- ModalSample --}}
                            <div id="tembusanModal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <form id="formTembusan" method="post"
                                        action="{{ url('superadmin/pengaturan/tembusan-surat', []) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"></button>
                                                <h4 class="modal-title">Tambah Tembusan Surat</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nama_tembusan" class="control-label">Nama
                                                                Tembusan Surat</label>
                                                            <input type="text" class="form-control" id="nama_tembusan"
                                                                placeholder="Nama Tembusan Surat.." name="nama_tembusan">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="html_tembusan" class="control-label">Tembusan
                                                                Teks</label>
                                                            <div class="centered">
                                                                <div class="row row-editor">
                                                                    <div class="editor-container">
                                                                        <textarea class="editor"
                                                                            name="html_tembusan"
                                                                            id="html_tembusan"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect"
                                                    data-dismiss="modal">Tutup</button>
                                                <button onclick="budal()"
                                                    class="btn btn-success waves-effect waves-light">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <button id="tambahTembusan" class="btn btn-success waves-effect waves-light"
                                            data-toggle="modal" data-target="#tembusanModal">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Template --}}

                            <table class="{{ styletable() }}" id="datatable-tembusan">
                                <thead>
                                    <tr>
                                        <th class="text-center table-number">No</th>
                                        <th class="text-center">Nama Template Body Surat</th>
                                        <th class="text-center">Preview</th>
                                        <th class="text-center table-action">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tembusan_surat as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>{{ $item->nama_tembusan }}</td>
                                            <td>
                                                <div class="panel" style="padding:20px">
                                                    {!! $item->tembusan_text !!}
                                                </div>
                                            </td>
                                            <td class="actions text-center">
                                                <a href="" data-toggle="modal" data-target="#tembusanModal"
                                                    onclick="editTembusan('{{ $item->tembusan_id }}')"
                                                    title="Edit Tembusan Surat" class="btn btn-warning btn-action">
                                                    <i class="fa fa-pencil"></i> {{ edittext() }}
                                                </a>
                                                <a href="{{ url('superadmin/pengaturan/tembusan-surat/hapus/' . $item->tembusan_id, []) }}"
                                                    class="btn btn-danger btn-action"
                                                    onclick="return confirm('Apakah anda yakin?')">
                                                    <i class="fa fa-trash"></i> {{ deleteText() }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script src="{{ url('assets/pages/jquery.datatables.tembusan.init.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

    {{-- ckeditor --}}
    <script src="{{ url('plugins/ckeditor5/build/ckeditor.js') }}"></script>

    <script>
        function viewKop(id) {
            console.log(id)
        }
    </script>
    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
    <script>
        let CKEDITOR;
        ClassicEditor
            .create(document.querySelector('.editor'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'fontColor',
                        'underline',
                        '|',
                        'alignment',
                        'outdent',
                        'indent',
                        'numberedList',
                        '|',
                        'undo',
                        'redo'
                    ]
                },
                language: 'id',
                licenseKey: '',



            })
            .then(editor => {
                CKEDITOR = editor;




            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: ky3aoucb1o1u-kr8wvj1ww14r');
                console.error(error);
            });
    </script>
    <script src="{{ url('assets/js/pengaturan/tembusan.js') }}"></script>
@endsection
