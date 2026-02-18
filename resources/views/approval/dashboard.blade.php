@extends('layouts.layout')


@section('css')
    <link href="{{ asset('plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />
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

                    <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-chart-areaspline widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Event
                                </p>
                                <h2>{{ $event_schedule }}</h2>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-account-convert widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Total
                                    Ibadah</p>
                                <h2>{{ $total_ibadah }}</h2>
                            </div>
                        </div>
                    </div><!-- end col -->


                    <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-av-timer widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                    title="Request Per Minute">Total Surat Diterima
                                </p>
                                <h2>
                                    {{ $total_surat_diterima }}
                                </h2>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-av-timer widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                    title="Request Per Minute">Total Surat Ditolak
                                </p>
                                <h2>
                                    {{ $total_surat_ditolak }}
                                </h2>
                            </div>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->



            </div> <!-- container -->

            <div class="content">
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
            </div> <!-- content -->


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
