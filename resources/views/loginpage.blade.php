<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An Administrative Web for SINODE GKKD">
    <meta name="author" content="kreasi tech">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ 'assets/images/favicon.ico' }}">
    <!-- App title -->
    <title>{{ $title }}</title>

    <!-- App css -->
    <link href="{{ 'assets/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'assets/css/core.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'assets/css/components.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'assets/css/icons.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'assets/css/pages.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'assets/css/menu.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'assets/css/responsive.css' }}" rel="stylesheet" type="text/css" />
    <script src="{{ 'assets/js/modernizr.min.js' }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/p-loading-master/dist/css/p-loading.min.css') . getDateLink() }}">

</head>


<body>

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
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="m-t-40 account-pages">
                            <div class="text-center account-logo-box">
                                <h3 class="text-uppercase font-bold text-info">
                                    <a href="" class="text-info">
                                        SINODE GKKD
                                    </a>
                                </h3>
                                <h5 class="text-info">LOGIN</h4>
                                    {{-- <h4 class="text-uppercase font-bold m-b-0">Sign In</h4> --}}
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" action="{{ url('login', []) }}" method="POST">
                                    @csrf
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" required="" name="email"
                                                value="{{ old('email') }}" placeholder="example@gmail.com">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" required="" name="password"
                                                value="{{ old('password') }}" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group text-center m-t-30">
                                        <div class="col-sm-12">
                                            <a href="{{ url('lupapassword') }}" class="text-muted"><i
                                                    class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-info waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <!-- end card-box-->

                        {{-- <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                                </div>
                            </div> --}}

                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
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
