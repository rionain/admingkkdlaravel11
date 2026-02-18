@extends('layouts.layout')


@section('css')
    <link href="{{ asset('plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />
    <style>
        .colcontainer {
            display: flex;
            width: 100%;
        }

        .colitem {
            flex: 1;
            padding: 16px;
        }

    </style>
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="colcontainer">
                        <div class="col-md-3 colitem">
                            <a href="{{ url('admin-cabang/database/database-cabang?tab=event') }}">
                                <div class="card-box widget-box-one" style="height: 150px">
                                    <i class="mdi mdi-chart-areaspline widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Event
                                        </p>
                                        <h2>{{ $event_schedule }}</h2>
                                    </div>
                                    <a
                                        href="{{ url('admin-cabang/database/database-cabang?tab=event') }}">Selengkapnya</a>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-md-3 colitem">
                            <a href="{{ url('admin-cabang/ibadah') }}">
                                <div class="card-box widget-box-one" style="height: 150px">
                                    <i class="mdi mdi-account-convert widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="User Today">
                                            Total
                                            Ibadah</p>
                                        <h2>{{ $total_ibadah }}</h2>
                                    </div>
                                    <a href="{{ url('admin-cabang/ibadah') }}">Selengkapnya</a>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-md-3 colitem">
                            <div class="card-box widget-box-one" style="height: 150px">
                                <i class="mdi mdi-av-timer widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                        title="Request Per Minute">Total Request Surat
                                    </p>
                                    <h2 class="text-center"><span class="badge badge-danger"
                                            style="font-size: 2.5rem !important">Ditolak {{ $total_surat_ditolak }}</span>
                                        <span class="badge badge-success" style="font-size: 2.5rem !important">Diterima
                                            {{ $total_surat_diterima }}</span>
                                    </h2>
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-3 colitem">
                            <div class="card-box widget-box-one" style="height: 150px">
                                <i class="mdi mdi-av-timer widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                        title="Request Per Minute">Total Sertifikat
                                    </p>
                                    <h2 class="text-center"><span class="badge badge-danger"
                                            style="font-size: 2.5rem !important">Ditolak
                                            {{ $total_sertifikat_ditolak }}</span>
                                        <span class="badge badge-success" style="font-size: 2.5rem !important">Diterima
                                            {{ $total_sertifikat_diterima }}</span>
                                    </h2>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
                <!-- end row -->



            </div> <!-- container -->

            {{-- <div class="content"> --}}
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="calendar"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>
                    </div>
                    <!-- end col-12 -->
                </div> <!-- end row -->
            </div> <!-- container -->
            {{-- </div> <!-- content --> --}}


        </div>
    @endsection

    @section('script')
        <script>
            var events = {!! $events !!};
        </script>
        <!-- Counter js  -->
        {{-- <script src="{{ asset('plugins/waypoints/jquery.waypoints.min.js') }}"></script>
    < src="{{ asset('plugins/counterup/jquery.counterup.min.js"></') }}script> --}}

        <!--Morris Chart-->
        <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>

        <!-- Dashboard init -->
        <script src="{{ asset('assets/pages/jquery.dashboard.js') }}"></script>


        <!-- Jquery-Ui -->
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- BEGIN PAGE SCRIPTS -->
        <script src="{{ asset('plugins/moment/moment.js') }}"></script>
        <script src='{{ asset('plugins/fullcalendar/js/fullcalendar.min.js') }}'></script>
        <script src="{{ asset('assets/pages/jquery.fullcalendar.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>
        <script src="{{ asset('assets/js/index.js') }}"></script>


    @endsection
