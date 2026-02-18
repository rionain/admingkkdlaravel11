@extends('layouts.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Surat Keputusan</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Surat Keputusan</b></h4>
                            <p class="text-muted font-13 m-b-30"></p>
                            {{-- <div class="table-responsive"> --}}
                            <table class="{{ styletable() }}" id="datatable-suratkeputusan">
                                <thead>
                                    <tr>
                                        <th class='text-center table-number'>No</th>
                                        <th class='text-center'>Kategori Gereja</th>
                                        <th class='text-center'>Cabang</th>
                                        <th class='text-center'>Requester</th>
                                        <th class='text-center'>Nama yang ditahbiskan</th>
                                        <th class='text-center'>jabatan</th>
                                        <th class='text-center'>Status Surat</th>
                                        <th class='text-center'>Alasan</th>
                                        <th class='text-center'>Status Template</th>
                                        <th class='text-center'>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request_surat as $key => $item)
                                        <tr class="">
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>{{ @$item->user->cabang->kategori_gereja->kategori_gereja }}</td>
                                            <td>{{ @$item->user->cabang->nama_cabang }}</td>
                                            <td>{{ @$item->user->nama }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->jabatan }}</td>
                                            <td>{{ @$item->status_surat->nama_status }}</td>
                                            <td>
                                                @if ($item->alasan_demote != null)
                                                    {{ $item->alasan_demote }}
                                                @else
                                                    <span class="badge badge-danger">Kosong</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->pengaturan_surat_keputusan_id)
                                                    <span class="badge badge-success">Sudah ada template</span>
                                                @else
                                                    <span class="badge badge-warning">Belum ada template</span>
                                                @endif
                                            </td>
                                            <td class="actions text-center">
                                                <button class="btn btn-primary" style="margin-bottom: 5px;"
                                                    onclick="window.open('{{ url('superadmin/administrasi/surat/surat-keputusan/lihat/' . $item->surat_keputusan_id, []) }}', 'newwindow', 'width=1000,height=700,left=450'); return;">
                                                    <i class="fa fa-eye"></i>
                                                    Lihat</button>
                                                @if ($item->status_surat_id == 6)
                                                    {{-- <a href="{{ url('superadmin/administrasi/surat/pdf/' . $item->surat_keputusan_id, []) }}"
                                                        class="btn btn-primary" style="margin-bottom: 5px;"><i
                                                            class="fa fa-download"></i>
                                                        Download
                                                    </a> --}}
                                                @else
                                                    @if ($item->pengaturan_surat_keputusan_id)
                                                        <button class="btn btn-success" style="margin-bottom: 5px;"
                                                            data-toggle="modal" data-target="#ubahStatus"
                                                            onclick="ubahStatus('{{ $item->surat_keputusan_id }}')"><i
                                                                class="fa fa-edit"></i>
                                                            Status</button>
                                                    @endif
                                                    <button class="btn btn-success" style="margin-bottom: 5px;"
                                                        data-toggle="modal" data-target="#settingTemplate"
                                                        onclick="showSettingTemplate('{{ $item->surat_keputusan_id }}')"><i
                                                            class="fa fa-edit"></i>
                                                        Template master</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- </div> --}}

                        </div>
                        <!-- end: page -->

                    </div> <!-- end Panel -->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->


    </div>
    <div id="ubahStatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{ url('superadmin/administrasi/surat/ubah-status/') }}" method="POST" id="formBody">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Ubah status</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="statusSurat">Status Surat</label><br>
                            <select id="statusSurat" name="statusSurat" class="form-control">
                                <option value="">- Pilih status surat -</option>
                            </select>
                        </div>
                        <div class="form-group" style="display: none" id="form-group-alasan">
                            <label for="alasan">Alasan</label><br>
                            <textarea name="alasan" id="alasan" cols="5" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! modalFooterZircos() !!}
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="settingTemplate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{ url('superadmin/administrasi/surat/surat-keputusan/edit-master-surat/') }}" method="POST"
                id="formSettingTemplate">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Master surat</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pengaturan_surat_keputusan_id">Master Surat</label><br>
                            <select id="pengaturan_surat_keputusan_id" name="pengaturan_surat_keputusan_id"
                                class="form-control" required>
                                <option value="">- Pilih master surat -</option>
                                @foreach ($pengaturan_surat_keputusan as $item)
                                    <option value="{{ $item->pengaturan_surat_keputusan_id }}">
                                        {{ $item->nama_pengaturan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_penetapan">Tempat Penetapan</label><br>
                            <input type="text" name="tempat_penetapan" id="tempat_penetapan" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penetapan">Tanggal Penetapan</label><br>
                            <input type="date" name="tanggal_penetapan" id="tanggal_penetapan" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! modalFooterZircos() !!}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <!-- Examples -->
    {{-- <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script> --}}

    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>

    {{-- <script src="{{ url('assets/pages/jquery.datatables.suratkeputusan.init.js') }}"></script> --}}

    {{-- <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script> --}}

    <script>
        $('#datatable-suratkeputusan').DataTable({});
        $('#statusSurat').change((e) => {
            if ($('#statusSurat').val() == 5) {
                $('#form-group-alasan').css('display', 'inline')
            } else {
                $('#form-group-alasan').css('display', 'none')
            }

        });
        const modalBody = 'ubahStatus'
        // const modalDetailKop    = 'modalDetailKop'
        const formBody = 'formBody'

        $('#' + modalBody).on('hidden.bs.modal', function() {
            titleActionStatusSurat('', base_url(''))
            tutupModalStatusSurat(modalBody, 'nama_body')
            tutupModalStatusSurat(modalBody, 'html_body')
            $('#form-group-alasan').css('display', 'none')
        })

        function ubahStatus(id) {
            titleActionStatusSurat('Edit status', base_url('superadmin/administrasi/surat/surat-keputusan/ubah-status/' +
                id + '?'))
            startloading('#' + modalBody + ' .modal-dialog')

            let data = {};
            var settings = {
                'url': base_url('api/v1/superadmin/administrasi/surat/surat-keputusan/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                data = response;
                $.ajax({
                    'url': base_url('api/v1/superadmin/pengaturan/status-surat'),
                    'method': 'GET',
                    'dataType': 'json',
                    'timeout': timeOut()
                }).done(function(response) {

                    let html = '<option value="">- Pilih status surat -</option>';
                    response.data.map((v, i) => {
                        if (data.jumlah_approval == 0) {
                            if (v.status_surat_id != 4 && v.status_surat_id != 3 && v
                                .status_surat_id != 2) {
                                html +=
                                    `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                            }
                        } else if (data.jumlah_approval == 1) {
                            if (v.status_surat_id != 4 && v.status_surat_id != 3) {
                                html +=
                                    `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                            }
                        } else if (data.jumlah_approval == 2) {
                            if (v.status_surat_id != 4) {
                                html +=
                                    `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                            }
                        } else {
                            html +=
                                `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                        }
                    });
                    $('#statusSurat').html(html)
                    console.log(data.data) //ini kadang kosoong
                    setVal(modalBody, 'statusSurat', data.data.status_surat_id) //problem disini
                    if (data.data.status_surat_id == 5) {
                        $('#form-group-alasan').css('display', 'inline')
                        $('#alasan').html(data?.data?.alasan)
                    } else {
                        $('#form-group-alasan').css('display', 'none')
                    }
                    stoploading('#' + modalBody + ' .modal-dialog')
                }).
                fail(function(data, status, error) {
                    stoploading('#' + modalBody + ' .modal-dialog')
                });
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalBody + ' .modal-dialog')
            });
            // ----------------------------------------------------------------------------------------------

        }

        function titleActionStatusSurat(title, action) {
            $('#' + modalBody + ' .modal-title').html(title)
            $('#' + modalBody + ' #' + formBody).attr('action', action)
        }

        function tutupModalStatusSurat(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>
    <script>
        const modalSettingTemplate = 'settingTemplate'
        // const modalDetailKop    = 'modalDetailKop'
        const formSettingTemplate = 'formSettingTemplate'

        $('#' + modalSettingTemplate).on('hidden.bs.modal', function() {
            titleActionSettingTemplate('', base_url(''))
            tutupModalSettingTemplate(modalSettingTemplate, 'pengaturan_surat_keputusan')
            tutupModalSettingTemplate(modalSettingTemplate, 'tempat_penetapan')
            tutupModalSettingTemplate(modalSettingTemplate, 'tanggal_penetapan')
        });

        function showSettingTemplate(id) {
            titleActionSettingTemplate('Setting Master Surat', base_url(
                'superadmin/administrasi/surat/surat-keputusan/ubah-template/' + id))
            startloading('#' + modalSettingTemplate + ' .modal-dialog')

            let data = {};
            var settings = {
                'url': base_url('api/v1/superadmin/administrasi/surat/surat-keputusan/' + id),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            };
            $.ajax(settings).done(function(response) {
                console.log(response)

                setVal(modalSettingTemplate, 'pengaturan_surat_keputusan_id', response?.data
                    ?.pengaturan_surat_keputusan_id)
                setVal(modalSettingTemplate, 'tempat_penetapan', response?.data?.tempat_penetapan)
                setVal(modalSettingTemplate, 'tanggal_penetapan', response?.data?.tanggal_penetapan)
                stoploading('#' + modalSettingTemplate + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalSettingTemplate + ' .modal-dialog')
            });
        }

        function titleActionSettingTemplate(title, action) {
            $('#' + modalSettingTemplate + ' .modal-title').html(title)
            $('#' + modalSettingTemplate + ' #' + formSettingTemplate).attr('action', action)
        }

        function tutupModalSettingTemplate(modal, id) {
            $('#' + modal + ' #' + id).val('')
            $('#' + modal + ' #' + id).removeClass('is-invalid')
        }
    </script>
@endsection
