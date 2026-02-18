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

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">

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
                                <h5 class="text-info">GANTI PASSWORD</h4>
                                    {{-- <h4 class="text-uppercase font-bold m-b-0">Sign In</h4> --}}
                            </div>

                            <div class="account-content">

                                <form class="form-horizontal"
                                    action="{{ url("lupapassword/ganti_password/$user_id", []) }}" method="POST">
                                    @csrf
                                    <div>
                                        <h6> Password.</h6>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" required="" name="password"
                                                placeholder="password" id="password" onkeyup="check()">
                                        </div>
                                    </div>
                                    <div>
                                        <h6> Konfirmasi password.</h6>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" required=""
                                                name="password_confirmation" placeholder="password confirmation"
                                                id="password_confirmation" onkeyup="check()">
                                        </div>
                                    </div>
                                    <p class="text-danger" id="txt_error" style="display: none">*Password dan
                                        konfirmasi
                                        password tidak sama
                                    </p>

                                    <div class="form-group text-center m-t-30">
                                        <div class="col-sm-12">
                                            <a href="{{ url('login') }}" class="text-muted"><i
                                                    class="fa fa-lock m-r-5"></i> Back to login?</a>
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-info waves-effect waves-light"
                                                type="submit" id="btn_confirm" disabled>Ganti Password</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->


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
    @include('errorhandler')
    <script>
        function check() {
            const password = $('#password').val();
            const password_confirmation = $('#password_confirmation').val();

            if (password == '' || password_confirmation == '') {
                $('#txt_error').css('display', 'none');
                $('#btn_confirm').attr('disabled', true);
            } else if (password == password_confirmation) {
                $('#txt_error').css('display', 'none');
                $('#btn_confirm').attr('disabled', false);
            } else {
                $('#txt_error').css('display', 'inline');
                $('#btn_confirm').attr('disabled', true);
            }
            // console.log(password, password_confirmation)
        }
    </script>
</body>

</html>
