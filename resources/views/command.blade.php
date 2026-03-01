@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Command</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-heading text-center">
                            <h3 class="text-center">List Command</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-center">PWA</h4>
                                    <div class="list-group">
                                        <a href="{{ url('superadmin/pengaturan/command/pwa/deploy') }}"
                                            class="list-group-item active">
                                            <h4 class="list-group-item-heading">Update repo</h4>
                                            <p class="list-group-item-text">klik untuk mengupdate repo</p>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-center">Superadmin</h4>
                                    <div class="list-group">
                                        <a href="{{ url('superadmin/pengaturan/command/superadmin/deploy') }}"
                                            class="list-group-item active">
                                            <h4 class="list-group-item-heading">Update repo</h4>
                                            <p class="list-group-item-text">klik untuk mengupdate repo</p>
                                        </a>
                                    </div>

                                </div>
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
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('plugins/moment/moment.js') }}"></script>
@endsection
