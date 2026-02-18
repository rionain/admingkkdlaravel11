@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Anak PA</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            @include('errorhandler')

                            <div id="modalAnakPA" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Tambah Anak PA</h4>
                                        </div>
                                        <form
                                            action="{{ url("admin-cabang/database/database-permuridan/kakak-pa/$kakak_pa->nama/anak-pa") }}"
                                            method="POST" enctype="multipart/form-data" id="formAnakPA">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama Anak PA</label>
                                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama anak PA" required value="{{ old('nama') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender" class="control-label">Gender</label><br>
                                                    <input type="radio" name="gender" id="gender" value="l" {{ old('gender') == 'l' ? 'checked' : '' }}> Laki-laki
                                                    <input type="radio" name="gender" id="gender" value="p" {{ old('gender') == 'p' ? 'checked' : '' }}> Perempuan
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="control-label">Phone</label>
                                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="085....." required value="{{ old('phone') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat" class="control-label">Alamat</label>
                                                    <textarea name="alamat" id="alamat" cols="2" rows="2" class="form-control" required>{{ old('alamat') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelompok_pa" class="control-label">Kelompok PA</label> <br>
                                                    <a href="{{url('admin-cabang/database/database-cabang?tab=kelompok_pa')}}">
                                                        <small class="">Tambah kelompok pa</small>
                                                    </a>
                                                    <select id="kelompok_pa" name="kelompok_pa" class="form-control">
                                                        <option value="">- Pilih Kelompok PA -</option>
                                                        @foreach ($kelompok_pa as $item)
                                                            <option value="{{ $item->kelompok_pa_id }}" data-chained="{{ $item->lfk_sub_cabang_id }}"
                                                                {{ old('kelompok_pa') == $item->kelompok_pa_id ? 'selected' : '' }}>
                                                                {{ @$item->kakak_pa->nama }}({{ $item->nama_kelompok }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lfk_bahan_pa_id" class="control-label">Bahan</label>
                                                    <select id="lfk_bahan_pa_id" name="lfk_bahan_pa_id" class="form-control">
                                                        <option value="">- Pilih bahan -</option>
                                                        @foreach ($bahan_form as $item)
                                                            <option value="{{ $item->bahan_pa_id }}" data-chained="{{ $item->lfk_kelompok_pa_id }}" {{ old('lfk_bahan_pa_id') == $item->bahan_pa_id ? 'selected' : '' }}> {{ $item->judul }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {!! modalFooterZircos() !!}
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('admin-cabang/database/database-permuridan') }}" class="btn btn-success"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
                            {{-- {{ $anak_pa }} --}}
                            <table class="table table-bordered table-striped" style="max-width: 50%;margin-top: 20px">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $kakak_pa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $kakak_pa->email }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($anak_pa as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $value->nama }}</td>
                                            </tr>
                                        @endforeach --}}
                                </tbody>
                            </table>

                            <div class="m-b-30">
                                <button id="addAnakPA" type="button" class="btn btn-success waves-effect waves-light"
                                    data-toggle="modal" data-target="#modalAnakPA">Add <em
                                        class="mdi mdi-plus-circle-outline"></em></button>
                            </div>
                            {{-- End Modal Template --}}
                            <div class="">
                                <table class="table table-striped add-edit-table table-bordered" id="datatable-anak-pa">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Pembimbing PA</th>
                                            <th class="text-center">Kelompok PA</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Bahan</th>
                                            <th class="text-center table-action">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($anak_pa as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ "$value->nama_kakak_pa ($value->nama_kelompok)" }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->judul }}</td>
                                                <td class="actions text-center">
                                                    <a href="#" class="btn btn-primary btn-action" data-toggle="modal"
                                                        data-target="#modalAnakPA"
                                                        onclick="editAnakPA('{{ $kakak_pa->user_id }}','{{ $value->user_id }}')"><i
                                                            class="fa fa-pencil"></i> Edit</a>
                                                    <a href="{{ url('admin-cabang/database/database-permuridan/anak-pa/hapus/' . $value->user_id, []) }}"
                                                        class="btn btn-danger btn-action"
                                                        onclick="return confirm('Apakah anda yakin?')"><i
                                                            class="fa fa-trash-o"></i> Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- end: page -->

                </div> <!-- end Panel -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->


@endsection

@section('script')
    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>

    <script>
        $('#datatable-anak-pa').DataTable();
    </script>
    <script>
        const addAnakPAData = 'modalAnakPA';
        const formAnakPA = 'formAnakPA';

        $(`#${addAnakPAData} #kelompok_pa`).select2({
            theme: 'bootstrap'
        });
        $(`#${addAnakPAData} #lfk_bahan_pa_id`).select2({
            theme: 'bootstrap'
        });

        var kelompok_paCopy = $(`#${addAnakPAData} #kelompok_pa`).clone();
        var lfk_bahan_pa_id = $(`#${addAnakPAData} #lfk_bahan_pa_id`).clone();


        function editAnakPA(kakak_pa_id, anak_pa_id) {
            console.log(kakak_pa_id, anak_pa_id);
            titleActionAnakPA('Edit Anak PA', base_url(
                `admin-cabang/database/database-permuridan/kakak-pa/${kakak_pa_id}/anak-pa/${anak_pa_id}`))
            startloading('#' + addAnakPAData + ' .modal-dialog')
            var settings = {
                'url': base_url(
                    `api/v1/admin-cabang/database/database-permuridan/anak-pa/${anak_pa_id}`
                ),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };

            $.ajax(settings).done(function(response) {
                console.log(response)
                setVal(addAnakPAData, 'nama', response.data.nama)
                setVal(addAnakPAData, 'email', response.data.email)
                var $radios = $(`#${addAnakPAData} input:radio[name=gender]`);
                $radios.filter(`[value=${response.data.gender}]`).prop('checked', true);
                setVal(addAnakPAData, 'phone', response.data.phone)
                setVal(addAnakPAData, 'alamat', response.data.alamat)

                setValSelect2(addAnakPAData, 'kelompok_pa', response.data.anak_pa_detail?.lfk_kelompok_pa_id)
                setValSelect2(addAnakPAData, 'lfk_bahan_pa_id', response.data.anak_pa_detail?.lfk_bahan_pa_id)

                stoploading('#' + addAnakPAData + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + addAnakPAData + ' .modal-dialog')
            });
        }

        function titleActionAnakPA(title, action) {
            $('#' + addAnakPAData + ' .modal-title').html(title)
            $('#' + addAnakPAData + ' #' + formAnakPA).attr('action', action)
        }

        function tutupModal(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }

        function tambah(kakak_pa_id) {
            titleActionAnakPA('Form Tambah Anak PA', base_url(
                `admin-cabang/database/database-permuridan/kakak-pa/${kakak_pa_id}/anak-pa`));
        }


        $(document).ready(function() {

            setSelect2('kelompok_pa');
            setSelect2('lfk_bahan_pa_id');

            $('#' + addAnakPAData).on('hidden.bs.modal', function() {
                titleActionAnakPA('', base_url(''))
                tutupModal(addAnakPAData, 'nama')
                tutupModal(addAnakPAData, 'email')
                tutupModal(addAnakPAData, 'phone')
                tutupModal(addAnakPAData, 'alamat')
                setValSelect2(addAnakPAData, 'kelompok_pa', '')
                setValSelect2(addAnakPAData, 'lfk_bahan_pa_id', '')

            });
        });
    </script>
@endsection
