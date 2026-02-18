@extends('layouts.layout')


@section('css')
    <link href="{{ asset('plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @php
        $user = Auth::user();
    @endphp
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Profile</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="text-center card-box">
                    <div class="member-card">
                        <img src="{{ Auth::check() && Auth::user()->profile_pic ? S3Helper::get(Auth::user()->profile_pic) : asset('assets/images/users/avatar-1.jpg') }}"
                            class="img-circle img-thumbnail" alt="profile-image">
                        <div style="padding: 8px" class="">
                            <span style="padding: 8px" class="badge badge-secondary">{{ Auth::user()->nama_role }}</span>
                            <h4 style="text-transform: uppercase" class="m-b-5">{{ $user->nama }}</h4>
                        </div>

                        <hr />

                        <div class="m-b-30">
                            <button id="btnProfile" data-toggle="modal" data-target="#editProfile"
                                class="btn btn-success waves-effect waves-light">Edit Profile <i
                                    class="mdi mdi mdi-lead-pencil"></i></button>
                            <button id="btnPassword" data-toggle="modal" data-target="#editPassword"
                                class="btn btn-danger waves-effect waves-light">Edit Password <i
                                    class="mdi mdi mdi-lead-pencil"></i></button>
                        </div>

                        <div class="text-left">
                            <table>
                                <tr>
                                    <td style="padding: 8px"><strong>Nama</strong></td>
                                    <td>&nbsp;&nbsp;:&nbsp;</td>
                                    <td><span class="m-l-15">{{ $user->nama }}</span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px"><strong>Phone</strong></td>
                                    <td>&nbsp;&nbsp;:&nbsp;</td>
                                    <td><span class="m-l-15">
                                            @if ($user->phone != null)
                                                {{ $user->phone }}
                                            @else
                                                <span class="badge badge-danger">Kosong</span>
                                            @endif
                                        </span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px"><strong>Email</strong></td>
                                    <td>&nbsp;&nbsp;:&nbsp;</td>
                                    <td><span class="m-l-15">{{ $user->email }}</span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px"><strong>Alamat</strong></td>
                                    <td>&nbsp;&nbsp;:&nbsp;</td>
                                    <td><span class="m-l-15">{{ $user->alamat }}</span></td>
                                </tr>
                                {{-- {{dd($user)}} --}}
                            </table>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div>
        </div>
    </div>

    <div id="editProfile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <form action="{{ url('profile/edit-profile', []) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Edit Profile</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama" class="control-label">Nama
                                        Lengkap</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Lengkap" value="{{ $user->nama }}">
                                </div>
                                <div class="form-group">
                                    <label>Gender:</label>
                                    <div class="radio">
                                        <input @if ($user->gender == 'l') checked @endif type="radio"
                                            name="gender" id="genderL" value="l" required="">
                                        <label for="genderl">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <input input @if ($user->gender == 'p') checked @endif type="radio"
                                            name="gender" id="genderP" value="p">
                                        <label for="genderp">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label>Foto</label>
                                    <p class="text-danger">*Kosongkan bila tidak ingin mengganti foto</p>
                                    <div class="col-sm-12 padding-left-0 padding-right-0">
                                        <input id="foto" type="file" class="filestyle" name="foto"
                                            accept="image/*" data-buttonname="btn-primary">
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label>Alamat</label>
                                    <div class="col-sm-12 padding-left-0 padding-right-0">
                                        <textarea id="alamat" class="form-control" name="alamat">{{ $user->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="editPassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{ url('profile/edit-password', []) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Ubah Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_lama" class="control-label">Password Lama</label>
                                    <input type="password" class="form-control" name="password_lama" id="password_lama"
                                        placeholder="Password Lama" value="">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password Baru" value="">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="control-label">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="Konfirmasi Password Baru" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src={{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

    <script src="{{ url('assets/pages/jquery.fileuploads.init.js') }}"></script>
    <script src="{{ url('/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>

    <script src="{{ url('/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
@endsection
