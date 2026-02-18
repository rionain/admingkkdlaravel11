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
                            <h4 class="page-title">List Ibadah</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    @foreach ($ibadah as $key => $value)
                        <div class="col-md-4">
                            <div class="panel">
                                <div class="panel-body">

                                    <h2 class="text-center">{{ $value->ibadah_day }}</h2>
                                    <p class="text-center mt-2"><i class="fa fa-star"></i> {{ $value->nama_ibadah }}
                                    </p>
                                    <p class="text-center">
                                        <i class="fa fa-times"></i>
                                        {{ format_date($value->ibadah_time_start, 'H:i') }} <b>-</b>
                                        {{ format_date($value->ibadah_time_end, 'H:i') }}
                                    </p>
                                    <p class="text-center"><i class="fa fa-users"></i>
                                        {{ $value->kapasitas_ibadah }}</p>
                                    <p class="text-center">
                                        @if ($value->ibadah_status == 1)
                                            <span
                                                class="badge badge-success">{{ $value->ibadah_status == 1 ? 'Aktif' : 'Tidak aktif' }}</span>
                                        @else
                                            <span
                                                class="badge badge-danger">{{ $value->ibadah_status == 1 ? 'Aktif' : 'Tidak aktif' }}</span>
                                        @endif
                                    </p>
                                </div>
                                <!-- end: page -->
                            </div> <!-- end Panel -->
                        </div>
                    @endforeach
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
