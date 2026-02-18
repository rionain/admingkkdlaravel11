<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An Administrative Web for SINODE GKKD">
    <meta name="author" content="kreasi tech">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- App title -->
    <title>{{ $title }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('assets/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Legacy App css -->
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/p-loading-master/dist/css/p-loading.min.css') . getDateLink() }}">

    <!-- Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <style>
        /* Fix for legacy core.css conflict */
        .container {
            width: 100% !important;
            max-width: 1320px; /* Standard BS5 max-width */
        }
        .wrapper-page {
            margin: 0 auto;
            max-width: 420px;
            width: 100%;
        }
    </style>
</head>


<body class="bg-light">

    <!-- Loader -->
    <div id="preloader">
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
    </div>

    <!-- HOME -->
    <section class="min-vh-100 d-flex align-items-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="wrapper-page">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-info text-white text-center py-4 border-0 rounded-top">
                                <h3 class="text-uppercase fw-bold mb-0">
                                    <a href="" class="text-white text-decoration-none">
                                        SINODE GKKD
                                    </a>
                                </h3>
                                <small class="text-white-50">LOGIN</small>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ url('login', []) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input class="form-control bg-light" type="email" required="" name="email"
                                            id="email" value="{{ old('email') }}" placeholder="example@gmail.com">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-bold">Password</label>
                                        <input class="form-control bg-light" type="password" required="" name="password"
                                            id="password" value="{{ old('password') }}" placeholder="Password">
                                    </div>

                                    <div class="mb-3 text-center">
                                        <a href="{{ url('lupapassword') }}" class="text-muted text-decoration-none small">
                                            <i class="fa fa-lock me-1"></i> Forgot your password?
                                        </a>
                                    </div>

                                @if($strikes >= 5)
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>
                                    </div>
                                @endif

                                <div class="d-grid gap-2 mt-4">
                                        <button class="btn btn-info text-white fw-bold py-2 shadow-sm waves-effect waves-light"
                                            type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- END HOME -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery and Bootstrap 5 Bundle (includes Popper) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/o-script.js') . getDateLink() }}"></script>
    @include('errorhandler')

</body>

</html>
