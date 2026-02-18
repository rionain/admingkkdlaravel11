<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="/" class="logo"><span>Sinode<span>GKKD</span></span><i class="mdi mdi-layers"></i></a>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">

            <!-- Navbar-left -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <button class="button-menu-mobile open-left waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
            </ul>

            <!-- Right(Notification) -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown user-box">
                    <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown"
                        aria-expanded="true">
                        <img src="{{ Auth::check() && Auth::user()->profile_pic ? S3Helper::get(Auth::user()->profile_pic) : asset('assets/images/users/avatar-1.jpg') }}"
                            alt="img" class="img-circle user-img" style="background: white">
                    </a>

                    <ul
                        class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                        <li>
                            <h5>{{ Auth::check() ? Auth::user()->nama : 'Belum login' }}</h5>
                        </li>
                        <li>
                            <a href="{{ url('profile') }}"><i class="ti-user m-r-5"></i>
                                Profile</a>
                            {{-- @role('Superadmin')
                            <a href="{{ url('superadmin/profile') }}"><i class="ti-user m-r-5"></i>
                                Profile</a>
                            @endrole
                            @role('Admin Cabang')
                            <a href="{{ url('admin-cabang/profile') }}"><i class="mdi mdi-face-profile m-r-5"></i>
                                Profile</a>
                            @endrole
                            @role('Approval')
                            <a href="{{ url('approval/profile') }}"><i class="mdi mdi-face-profile m-r-5"></i>
                                Profile</a>
                            @endrole --}}
                        </li>
                        <li><a href="{{ url('logout') }}"><i class="mdi mdi-logout m-r-5"></i> Logout</a></li>
                    </ul>
                </li>

            </ul> <!-- end navbar-right -->

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
<!-- Top Bar End -->
