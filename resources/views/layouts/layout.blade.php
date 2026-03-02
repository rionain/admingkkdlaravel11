<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An Administrative Web for SINODE GKKD">
    <meta name="author" content="kreasi tech">

    @yield('css')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- App title -->
    <title>{{ @$title ?: 'Tidak ada title' }}</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/p-loading-master/dist/css/p-loading.min.css') . getDateLink() }}">
    <link rel="stylesheet" href="{{ asset('plugins/switchery/switchery.min.css') }}">
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('plugins/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/css/o-style.css') . getDateLink() }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    <script>
        const s3_url = `{{ env('AWS_URL') . env('AWS_BUCKET') }}`;
        // const s3_url = `{{ env('AWS_URL') . env('AWS_BUCKET') . '/' }}`;
    </script>

    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/fastclick.js') }}"></script> --}}
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('plugins/p-loading-master/dist/js/p-loading.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/o-script.js') . getDateLink() }}"></script>
    <script src="{{ asset('plugins/jquery.chained/jquery.chained.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>

    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.colVis.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
    </script>
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-lazyload/jquery.lazyload.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            console.log('test');
            $('img').lazyload();
        });
    </script>
</head>


<body class="fixed-left">

    <!-- Loader -->
    {{-- <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="spinner-wrapper">
                    <div class="rotator">
                        <div class="inner-spin"></div>
                        <div class="inner-spin"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Begin page -->
    <div id="wrapper">
        @include('layouts/topbar')
        @include('layouts/sidebar')
        @include('layouts/footer')
        @yield ('content')
    </div>
    <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

    @include('errorhandler')

    <!-- init -->
    <script src="{{ asset('assets/pages/jquery.datatables.init.js') }}"></script>

    <!-- App js -->
    <!-- App js -->
    <script src="{{ asset('assets/js/jquery.core.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}?v={{ time() }}"></script>
    @yield ('script')
    <script>
        var resizefunc = [];
        $(document).ready(function() {
            $('.dataTables_filter').addClass('pull-right');
            $('.dataTables_paginate').addClass('pull-right');
        })
    </script>

    {{-- ============================================================ --}}
    {{-- GLOBAL: Client-side file size & type validation              --}}
    {{-- Fires immediately when user selects any file input anywhere  --}}
    {{-- ============================================================ --}}
    <script>
    (function () {
        var MAX_MB = 5;
        var MAX_BYTES = MAX_MB * 1024 * 1024; // 5 242 880 bytes
        var ALLOWED_TYPES = ['image/jpeg', 'image/jpg', 'image/png'];

        function formatSize(bytes) {
            if (bytes >= 1048576) return (bytes / 1048576).toFixed(2) + ' MB';
            return (bytes / 1024).toFixed(0) + ' KB';
        }

        function validateFileInput(input) {
            if (!input.files || input.files.length === 0) return;
            var file = input.files[0];

            // Type check (only for image inputs – skip report / document inputs)
            var isImageInput = (input.accept || '').toLowerCase().indexOf('image') !== -1
                            || input.name === 'foto' || input.name === 'foto_jemaat'
                            || input.name === 'foto_tanda_tangan' || input.name === 'ttdsaksi1'
                            || input.name === 'ttdsaksi2' || input.name === 'fileKop'
                            || input.name === 'ttd';

            if (isImageInput && ALLOWED_TYPES.indexOf(file.type) === -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format File Tidak Valid',
                    html: '<b>' + file.name + '</b><br>Hanya gambar <b>JPG / PNG</b> yang diizinkan.',
                    confirmButtonColor: '#e74c3c'
                });
                input.value = '';
                return;
            }

            // Size check
            if (file.size > MAX_BYTES) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran File Terlalu Besar',
                    html:  '<b>' + file.name + '</b><br>'
                         + 'Ukuran file: <b class="text-danger">' + formatSize(file.size) + '</b><br>'
                         + 'Maksimum yang diizinkan: <b>' + MAX_MB + ' MB</b>',
                    confirmButtonColor: '#e74c3c'
                });
                input.value = '';
                return;
            }

            // OK – show small inline success feedback
            var existingFeedback = $(input).siblings('.file-size-feedback');
            if (existingFeedback.length) existingFeedback.remove();
            $(input).after(
                '<small class="file-size-feedback text-success">'
                + '<i class="fa fa-check-circle"></i> '
                + file.name + ' (' + formatSize(file.size) + ')'
                + '</small>'
            );
        }

        // Attach to all current + future file inputs (handles dynamically opened modals)
        $(document).on('change', 'input[type="file"]', function () {
            validateFileInput(this);
        });
    })();
    </script>
</body>

</html>
