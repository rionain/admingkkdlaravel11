@extends('layouts.layout')

@section('content')
    <div class="content-page">

        <div class="content">
            <div class="container">
                <div class="page-title-box">
                    <h4 class="page-title">Pengaturan Sertifikat</h4>
                    @include('breadcrumb')
                    <div class="clearfix"></div>
                </div>
                @include('errorhandler')


                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="logo_header" class="control-label">Logo header</label>
                                        @if ($sertifikat->logo_header)
                                            <img src="{{ S3Helper::get($sertifikat->logo_header) }}" class="img-responsive"
                                                width="20%">
                                        @endif
                                        <span class="text-danger">* Kosongkan bila tidak ingin mengubah gambar</span>
                                        <input type="file" class="form-control" id="logo_header" name="logo_header"
                                            accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="header_html" class="control-label">Header</label>
                                        <textarea type="text" class="form-control" id="header_html" name="header_html" placeholder="Header">{{ old('header_html') ?: $sertifikat->header_html }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_kanan" class="control-label">Foto kanan</label>
                                        @if ($sertifikat->foto_kanan)
                                            <img src="{{ S3Helper::get($sertifikat->foto_kanan) }}" class="img-responsive"
                                                width="20%">
                                        @endif
                                        <span class="text-danger">* Kosongkan bila tidak ingin mengubah gambar</span>
                                        <input type="file" class="form-control" id="foto_kanan" name="foto_kanan"
                                            accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="ayat1_html" class="control-label">Ayat 1</label>
                                        <textarea class="form-control" id="ayat1_html" name="ayat1_html" placeholder="Ayat">{{ old('ayat1_html') ?: $sertifikat->ayat1_html }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi_html" class="control-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi_html" name="deskripsi_html" placeholder="Ayat">{{ old('deskripsi_html') ?: $sertifikat->deskripsi_html }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ayat2_html" class="control-label">Ayat</label>
                                        <textarea class="form-control" id="ayat2_html" name="ayat2_html" placeholder="Ayat">{{ old('ayat2_html') ?: $sertifikat->ayat2_html }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <a href="{{ url('superadmin/administrasi/sertifikat/pengaturan/sertifikat-penyerahan-anak/print-view') }}"
                            target="_blank" class="btn btn-success">Lihat contoh</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="modalPengaturanSertifikat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('superadmin/administrasi/sertifikat/pengaturan/sertifikat-penyerahan-anak') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="text_ayat" class="control-label">Text Ayat</label>
                                    <input type="text" class="form-control" id="text_ayat" name="text_ayat"
                                        placeholder="Sertifikat">
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
@endsection

@section('script')
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function() {
            let summernote_header_html = $('#header_html').summernote({
                minHeight: '200px'
            });
            summernote_header_html.summernote('code', $('#header_html').data('value'));
            let summernote_ayat1_html = $('#ayat1_html').summernote({
                minHeight: '200px'
            });
            summernote_ayat1_html.summernote('code', $('#ayat1_html').data('value'));
            let summernote_deskripsi_html = $('#deskripsi_html').summernote({
                minHeight: '200px'
            });
            summernote_deskripsi_html.summernote('code', $('#deskripsi_html').data('value'));
        });
    </script>
@endsection
