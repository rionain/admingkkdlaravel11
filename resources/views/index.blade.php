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
                @if ($jemaat_ultah->count() != 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="mdi mdi-cake "></i>
                                <h4>Happy birthday!</h4>
                                <strong> {{ $jemaat_ultah->count() }} Jemaat berulang tahun hari ini.</strong> <br>
                                <a href="{{ url('superadmin/database/database-jemaat') }}">
                                    <small class="text-white">Lihat Selengkapnya</small>
                                </a>
                            </div>
                        </div>

                    </div>
                @endif
                <div class="row">

                    <div class="col-md-3">
                        <a href="{{ url('superadmin/database/database-cabang') }}">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-church widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        Gereja
                                    </p>
                                    <h2>{{ $total_cabang }}</h2>
                                    <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_cabang }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('superadmin/database/database-cabang?tab=ibadah') }}">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-book widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        Ibadah
                                    </p>
                                    <h2>{{ $total_ibadah }}</h2>
                                    <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_ibadah }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('superadmin/database/database-cabang?tab=komsel') }}">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-group widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        Komsel
                                    </p>
                                    <h2>{{ $total_komsel }}</h2>
                                    <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_komsel }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('superadmin/database/database-cabang?tab=kelompokpa') }}">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-account-multiple widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        kelompok PA
                                    </p>
                                    <h2>{{ $total_kelompok_pa }}</h2>
                                    <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_kelompok_pa }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('superadmin/database/database-cabang?tab=event') }}">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-account-multiple widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        Event
                                    </p>
                                    <h2>{{ $event_schedule }}</h2>
                                    <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->event_schedule }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('superadmin/database/database-jemaat') }}">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-account-multiple widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        Jemaat
                                    </p>
                                    <h2>{{ $total_jemaat }}</h2>
                                    <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_jemaat }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('superadmin/database/database-pendeta') }}">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-account-multiple widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        Pendeta
                                    </p>
                                    <h2>{{ $total_pendeta }}</h2>
                                    <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_pendeta }}</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-chart-areaspline widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Event
                                </p>
                                <h2>{{ $event_schedule }}
                                    @if ($event_schedule > $dashboard_history->jumlah_event)
                                        <small><i class="mdi mdi-arrow-up text-success"></i></small>
                                    @elseif($event_schedule == $dashboard_history->jumlah_event)
                                        <small><i class="mdi mdi-equal text-warning"></i></small>
                                    @else
                                        <small><i class="mdi mdi-arrow-down text-danger"></i></small>
                                    @endif
                                </h2>
                                <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_event }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-account-convert widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Total
                                    kelompok pa</p>
                                <h2>{{ $total_kelompok_pa }}
                                    @if ($total_kelompok_pa > $dashboard_history->jumlah_kelompok_pa)
                                        <small><i class="mdi mdi-arrow-up text-success"></i></small>
                                    @elseif($total_kelompok_pa == $dashboard_history->jumlah_kelompok_pa)
                                        <small><i class="mdi mdi-equal text-warning"></i></small>
                                    @else
                                        <small><i class="mdi mdi-arrow-down text-danger"></i></small>
                                    @endif
                                </h2>
                                <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_kelompok_pa }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-av-timer widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                    title="Request Per Minute">Total anggota pa</p>
                                <h2>{{ $total_anggota_pa }}
                                    @if ($total_anggota_pa > $dashboard_history->jumlah_anak_pa)
                                        <small><i class="mdi mdi-arrow-up text-success"></i></small>
                                    @elseif($total_anggota_pa == $dashboard_history->jumlah_anak_pa)
                                        <small><i class="mdi mdi-equal text-warning"></i></small>
                                    @else
                                        <small><i class="mdi mdi-arrow-down text-danger"></i></small>
                                    @endif
                                </h2>
                                <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_anak_pa }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-box widget-box-one">
                            <i class="mdi mdi-account-multiple widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Total Users">
                                    Total kakak pa</p>
                                <h2>{{ $total_kakak_pa }}
                                    @if ($total_kakak_pa > $dashboard_history->jumlah_kakak_pa)
                                        <small><i class="mdi mdi-arrow-up text-success"></i></small>
                                    @elseif($total_kakak_pa == $dashboard_history->jumlah_kakak_pa)
                                        <small><i class="mdi mdi-equal text-warning"></i></small>
                                    @else
                                        <small><i class="mdi mdi-arrow-down text-danger"></i></small>
                                    @endif
                                </h2>
                                <p class="text-muted m-0"><b>Last:</b> {{ $dashboard_history->jumlah_kakak_pa }}</p>
                            </div>
                        </div>
                    </div> --}}

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
