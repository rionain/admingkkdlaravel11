@extends('layouts.layout')


@section('css')
@endsection

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Kontak</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            <div id="modalEditKontak" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">Edit Kontak</h4>
                                        </div>
                                        <form action="{{ url('/superadmin/pwa/contact') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Gereja</label>
                                                    <input id="nama_gereja" type="text" class="form-control"
                                                        name="nama_gereja"
                                                        value="{{ old('nama_gereja') ?: $contact->nama_gereja }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Gereja</label>
                                                    <input id="alamat_gereja" type="text" class="form-control"
                                                        name="alamat_gereja"
                                                        value="{{ old('alamat_gereja') ?: $contact->alamat_gereja }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>No Telp</label>
                                                    <input id="no_telp" type="text" class="form-control" name="no_telp"
                                                        value="{{ old('no_telp') ?: $contact->no_telp }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="email" type="text" class="form-control" name="email"
                                                        value="{{ old('email') ?: $contact->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>FB</label>
                                                    <input id="fb" type="text" class="form-control" name="fb"
                                                        value="{{ old('fb') ?: $contact->fb }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Twitter</label>
                                                    <input id="twitter" type="text" class="form-control" name="twitter"
                                                        value="{{ old('twitter') ?: $contact->twitter }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>LinkedIn</label>
                                                    <input id="linkedin" type="text" class="form-control" name="linkedin"
                                                        value="{{ old('linkedin') ?: $contact->linkedin }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {!! modalFooterZircos() !!}
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            {{-- End Modal Template --}}

                            <div class="">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Nama Gereja</th>
                                        <td>{{ $contact->nama_gereja }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Gereja</th>
                                        <td>{{ $contact->alamat_gereja }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telp</th>
                                        <td>{{ $contact->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $contact->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>FB</th>
                                        <td>{{ $contact->fb }}</td>
                                    </tr>
                                    <tr>
                                        <th>Twitter</th>
                                        <td>{{ $contact->twitter }}</td>
                                    </tr>
                                    <tr>
                                        <th>LinkedIn</th>
                                        <td>{{ $contact->linkedin }}</td>
                                    </tr>
                                </table>
                            </div>

                            <button id="edit" class="btn btn-success waves-effect waves-light m-auto" data-toggle="modal"
                                data-target="#modalEditKontak">Ubah <i class="mdi mdi-plus-circle-outline"></i></button>
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
@endsection
