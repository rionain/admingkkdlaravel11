<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <div class="user-details">
                <div class="overlay"></div>
                <div class="text-center">
                    <img src="{{ Auth::check() && Auth::user()->profile_pic ? S3Helper::get(Auth::user()->profile_pic) : asset('assets/images/users/avatar-1.jpg') }}"
                        alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div>
                        <a href="{{ url('profile') }}" class="text-center">
                            {{ Auth::check() ? Auth::user()->nama : 'Belum login' }} <br>
                            <span class="badge badge-secondary">{{ Auth::user()->nama_role }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <ul>
                <li class="menu-title">Navigation</li>

                @role('Superadmin')
                    <li class="has_sub">
                        <a href="{{ url('superadmin/dashboard') }}"
                            class="waves-effect {{ request()->segment(2) == 'administrasi' ? 'active subdrop' : '' }}"><i
                                class="mdi mdi-view-dashboard"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i><span>
                                Administrasi
                            </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li class="has_sub">
                                <a href="javascript:void(0);"
                                    class="waves-effect {{ request()->segment(3) == 'surat' ? 'active subdrop' : '' }}"><span>
                                        Surat </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    {{-- <li><a
                                            href="{{ url('superadmin/administrasi/surat/surat-keterangan') }}">Keterangan</a>
                                    </li> --}}
                                    <li><a href="{{ url('superadmin/administrasi/surat/surat-penunjukan') }}">Penunjukan</a>
                                    </li>
                                    <li><a href="{{ url('superadmin/administrasi/surat/surat-keputusan') }}">Keputusan</a>
                                    </li>
                                    <li><a href="{{ url('superadmin/administrasi/surat/surat-tugas') }}">Tugas</a>
                                    </li>
                                    {{-- <li><a href="{{ url('superadmin/administrasi/surat/surat-custom') }}">Custom</a></li> --}}
                                </ul>
                            </li>
                            {{-- <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><span> Proposal </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('superadmin/administrasi/proposal/event') }}">Event</a></li>
                                <li><a href="{{ url('superadmin/administrasi/proposal/seminar') }}">Seminar</a></li>
                                <li><a href="{{ url('superadmin/administrasi/proposal/konser') }}">Konser</a></li>
                                <li><a href="{{ url('superadmin/administrasi/proposal/doa') }}">Doa</a></li>
                                <li><a href="{{ url('superadmin/administrasi/proposal/lain') }}">Lain</a></li>
                            </ul>
                        </li> --}}

                            <li class="has_sub">
                                <a href="javascript:void(0);"
                                    class="waves-effect {{ request()->segment(3) == 'sertifikat' ? 'active subdrop' : '' }}"><span>
                                        Sertifikat </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ url('superadmin/administrasi/sertifikat/baptis') }}">
                                            Baptis
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('superadmin/administrasi/sertifikat/penyerahan-anak') }}">
                                            Penyerahan Anak
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('superadmin/administrasi/sertifikat/pernikahan') }}">
                                            Pernikahan
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <li class="has_sub">
                        <a href="javascript:void(0);"
                            class="waves-effect {{ request()->segment(2) == 'database' ? 'active subdrop' : '' }}"><i
                                class="mdi mdi-database"></i> <span>
                                Database
                            </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('superadmin/database/database-cabang') }}">Cabang</a></li>
                            <li><a href="{{ url('superadmin/database/database-permuridan') }}">Permuridan</a></li>
                            <li><a href="{{ url('superadmin/database/database-jemaat') }}">Jemaat</a></li>
                            <li><a href="{{ url('superadmin/database/database-pendeta') }}">Pendeta</a></li>
                            {{-- <li><a href="{{ url('superadmin/database/database-pengaturan') }}">Pengaturan</a></li> --}}
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);"
                            class="waves-effect {{ request()->segment(2) == 'kehadiran' ? 'active subdrop' : '' }}"><i
                                class="mdi mdi-calendar"></i> <span>
                                Kehadiran
                            </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('superadmin/kehadiran/ibadah') }}">Ibadah</a></li>
                            <li><a href="{{ url('superadmin/kehadiran/komsel') }}">Komsel</a></li>
                            <li><a href="{{ url('superadmin/kehadiran/permuridan') }}">Permuridan</a></li>
                        </ul>
                    </li>

                    {{-- <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-school"></i><span> Training
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="email-inbox.html"> Kelas</a></li>
                        <li><a href="email-read.html"> Siswa</a></li>
                        <li><a href="email-compose.html"> Materi</a></li>
                        <li><a href="email-compose.html"> Pengaturan</a></li>
                    </ul>
                </li> --}}

                    <li class="has_sub">
                        <a href="javascript:void(0);"
                            class="waves-effect {{ request()->segment(2) == 'report' ? 'active subdrop' : '' }}"><i
                                class="mdi mdi-file-document"></i><span>
                                Summary Report </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('superadmin/report/ibadah') }}">Ibadah</a></li>
                            <li><a href="{{ url('superadmin/report/komsel') }}">Komsel</a></li>
                            <li><a href="{{ url('superadmin/report/permuridan') }}">Permuridan</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="{{ url('superadmin/admin') }}" class="waves-effect"><i class="fa fa-user"></i>
                            <span>
                                Admin
                            </span>
                        </a>
                    </li>
                    <li class="has_sub">
                        <a href="{{ url('superadmin/approval-surat') }}" class="waves-effect"><i class="fa fa-user"></i>
                            <span>
                                Approval
                            </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);"
                            class="waves-effect {{ request()->segment(2) == 'pengaturan' ? 'active subdrop' : '' }}"><i
                                class="mdi mdi-settings"></i><span> Pengaturan
                            </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li class="menu-title">General</li>
                            @if (env('IS_COMMAND') == true)
                                <li><a href="{{ url('superadmin/pengaturan/command', []) }}"
                                        class="waves-effect">Command</a>
                                </li>
                            @endif
                            <li class="has_sub">
                                <a href="{{ url('superadmin/pwa/contact', []) }}" class="waves-effect">
                                    Contact
                                </a>
                                {{-- <ul class="list-unstyled">
                                        <li><a href="{{ url('superadmin/pwa/contact', []) }}">Contact</a></li>
                                        <li><a href="icons-colored.html">Footer</a></li>
                                        <li><a href="icons-materialdesign.html">About</a></li>
                                    </ul> --}}
                            </li>

                            <li class="menu-title">Administrasi</li>
                            <li><a href="{{ url('superadmin/pengaturan/kop-surat', []) }}" class="waves-effect">Kop
                                    Surat</a>
                            </li>
                            <li><a href="{{ url('superadmin/pengaturan/tembusan-surat', []) }}"
                                    class="waves-effect">Tembusan Surat</a>
                            </li>
                            <li><a href="{{ url('superadmin/pengaturan/footer-surat', []) }}" class="waves-effect">Footer
                                    Surat</a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);"
                                    class="waves-effect {{ request()->segment(3) == 'pengaturan' ? 'active subdrop' : '' }}"><span>
                                        Pengaturan Surat</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('superadmin/pengaturan/surat/penunjukan') }}">Penunjukan</a></li>
                                    <li><a href="{{ url('superadmin/pengaturan/surat/keputusan') }}">Keputusan</a></li>
                                    <li><a href="{{ url('superadmin/pengaturan/surat/tugas') }}">Tugas</a></li>
                                </ul>
                            </li>
                            {{-- <li class="has_sub">
                                <a href="javascript:void(0);"
                                    class="waves-effect {{ request()->segment(3) == 'pengaturan' ? 'active subdrop' : '' }}"><span>
                                        Pengaturan Surat Custom</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('superadmin/administrasi/pengaturan/body-surat') }}">Template
                                            Body</a></li>
                                    <li><a href="{{ url('superadmin/administrasi/pengaturan/master-surat') }}">Master
                                            Surat</a></li>
                                </ul>
                            </li> --}}

                            <li class="has_sub">
                                <a href="javascript:void(0);"
                                    class="waves-effect {{ request()->segment(3) == 'sertifikat' && request()->segment(4) == 'pengaturan' ? 'active subdrop' : '' }}"><span>
                                        Pengaturan Sertifikat </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a
                                            href="{{ url('superadmin/administrasi/sertifikat/pengaturan/sertifikat-baptis') }}">
                                            Baptis
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ url('superadmin/administrasi/sertifikat/pengaturan/sertifikat-penyerahan-anak') }}">
                                            Penyerahan Anak
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ url('superadmin/administrasi/sertifikat/pengaturan/sertifikat-pernikahan') }}">
                                            Pernikahan
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                @endrole
                @role('Admin Cabang')
                    <li class="has_sub">
                        <a href="{{ url('admin-cabang/dashboard') }}" class="waves-effect"><i
                                class="mdi mdi-view-dashboard"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-database"></i> <span>
                                Database
                            </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('admin-cabang/database/database-cabang') }}">Cabang</a></li>
                            <li><a href="{{ url('admin-cabang/database/database-permuridan') }}">Permuridan</a></li>
                            <li><a href="{{ url('admin-cabang/database/database-jemaat') }}">Jemaat</a></li>
                            <li><a href="{{ url('admin-cabang/database/database-pendeta') }}">Pendeta</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);"
                            class="waves-effect {{ request()->segment(2) == 'kehadiran' ? 'active subdrop' : '' }}"><i
                                class="mdi mdi-calendar"></i> <span>
                                Kehadiran
                            </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('admin-cabang/kehadiran/ibadah') }}">Ibadah</a></li>
                            <li><a href="{{ url('admin-cabang/kehadiran/komsel') }}">Komsel</a></li>
                            <li><a href="{{ url('admin-cabang/kehadiran/permuridan') }}">Permuridan</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="{{ url('admin-cabang/ibadah') }}" class="waves-effect"><i class="fa fa-star"></i>
                            <span>
                                List Ibadah
                            </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-palette"></i><span> Request
                                Surat </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            {{-- <li><a href="{{ url('admin-cabang/request-surat/surat-keterangan') }}">Keterangan</a>
                            </li> --}}
                            <li><a href="{{ url('admin-cabang/request-surat/surat-penunjukan') }}">Penunjukan</a>
                            </li>
                            <li><a href="{{ url('admin-cabang/request-surat/surat-keputusan') }}">Keputusan</a>
                            </li>
                            <li><a href="{{ url('admin-cabang/request-surat/surat-tugas') }}">Tugas</a>
                            </li>
                            {{-- <li><a href="{{ url('admin-cabang/request-surat/surat-custom') }}">Custom</a></li> --}}
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-palette"></i><span> Request
                                Sertifikat </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ url('admin-cabang/request-sertifikat/sertifikat-baptis') }}">Baptis</a>
                            </li>
                            <li>
                                <a href="{{ url('admin-cabang/request-sertifikat/sertifikat-penyerahan-anak') }}">Penyerahan
                                    Anak</a>
                            </li>
                            <li>
                                <a
                                    href="{{ url('admin-cabang/request-sertifikat/sertifikat-pernikahan') }}">Pernikahan</a>
                            </li>
                        </ul>
                    </li>
                @endrole

                @role('Approval')
                    <li class="has_sub">
                        <a href="{{ url('approval/dashboard') }}" class="waves-effect"><i
                                class="mdi mdi-view-dashboard"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>

                    {{-- <li class="has_sub">
                        <a href="{{ url('approval/ibadah') }}" class="waves-effect"><i class="fa fa-star"></i>
                            <span>
                                List Ibadah
                            </span>
                        </a>
                    </li> --}}

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-palette"></i><span> Approve
                                Surat </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            {{-- <li><a href="{{ url('approval/approve-surat/surat-keterangan') }}">Keterangan</a></li> --}}
                            <li><a href="{{ url('approval/approve-surat/surat-penunjukan') }}">Penunjukan</a></li>
                            <li><a href="{{ url('approval/approve-surat/surat-keputusan') }}">Keputusan</a></li>
                            <li><a href="{{ url('approval/approve-surat/surat-tugas') }}">Tugas</a></li>
                            {{-- <li><a href="{{ url('approval/approve-surat/surat-custom') }}">Custom</a></li> --}}
                        </ul>
                    </li>
                @endrole

                <li class="has_sub">
                    <a href="{{ url('logout') }}" class="waves-effect"><i class="mdi mdi-logout"></i>
                        <span>
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

        {{-- <div class="help-box">
            <h5 class="text-muted m-t-0">For Help ?</h5>
            <p class=""><span class=" text-dark"><b>Email:</b></span> <br /> support@support.com</p>
            <p class="m-b-0"><span class="text-dark"><b>Call:</b></span> <br /> (+123) 123 456 789</p>
        </div> --}}

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
