@extends('layouts.layout')

@section('css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <script>
        const nosurat = "{{ $nosurat }}";
        const tujuan = "{{ $tujuan }}";
        const perihal = "{{ $perihal }}";
        const tanggalapprove = "{{ $tanggalapprove }}";
        const ceklah = "{{ $ceklah }}";
    </script>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Master Surat</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="panel">

                    <form id="formMaster" method="POST"
                        action="{{ url('/superadmin/administrasi/pengaturan/master-surat/tambah-master/simpan') }}">

                        {{-- suratNama --}}
                        <div id="addMasterModal" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                        <h4 class="modal-title">Tambah Master</h4>
                                    </div>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_master" class="control-label">Nama
                                                        Master Surat</label>
                                                    <input type="text" class="form-control" id="nama_master"
                                                        name="nama_master" placeholder="Nama Master Surat.." required>
                                                </div>
                                                <div class="form-group body-picker-1">
                                                    <label for="jenisSuratPicker" class="control-label">Pilih
                                                        Jenis</label>
                                                    <select id="jenisSuratPicker" class="selectpicker"
                                                        name="jenisSuratPicker" data-style="btn-custom"
                                                        data-live-search="true" required>
                                                        <option value="">--Pilih Jenis Surat--</option>
                                                        @foreach ($jenissurat as $item)
                                                            <option value="{{ $item->jenis_surat_id }}">
                                                                {{ $item->nama_jenis }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {!! modalFooterZircos() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- masterModalEnd --}}
                        <div class="panel-body">
                            <div class="container">

                                <div class="form-group kop-picker">
                                    <label for="kopPicker" class="control-label">Pilih Kop</label>
                                    <select id="kopPicker" class="selectpicker" name="kopPicker" {{-- onchange="lihatSurat()" --}}
                                        data-style="btn-custom" data-live-search="true" onchange="tambahKop()" required>
                                        <option value="0">- Pilih Kop -</option>
                                        @foreach ($kop as $item)
                                            <option value="{{ $item }}">
                                                {{ $item->nama_kop_surat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group body-picker-1">
                                    <label for="bodyPicker" class="control-label">Pilih Body</label>
                                    <select id="bodyPicker" class="selectpicker" name="bodyPicker" data-style="btn-custom"
                                        data-live-search="true" required>
                                        <option value="">--Pilih Body--</option>
                                        <option value="input" id="inputUser">User Input</option>
                                        @foreach ($body as $item)
                                            <option value="{{ $item }}">
                                                {{ $item->nama_body }}</option>
                                        @endforeach
                                    </select>
                                    <div class="">
                                        <button onclick="tambahBody()" class="btn btn-primary">Tambah Body</button>
                                        <button onclick="resetBody()" class="btn btn-danger">Reset Body</button>
                                    </div>
                                    <div class="panel" style="margin-top: 20px">
                                        <div class="panel-body">
                                            <p>List body</p>
                                            <ul id="bodyList">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group approval-1">
                                    <label for="approvalPicker" class="control-label">Pilih Approval</label>
                                    <select id="approvalPicker" class="selectpicker" name="approvalPicker"
                                        data-style="btn-custom" data-live-search="true" required>
                                        <option value="">--Pilih Approval--</option>
                                        @foreach ($approval as $item)
                                            <option value="{{ $item }}">
                                                {{ $item->nama_ttd }}</option>
                                        @endforeach
                                    </select>
                                    <div class="">
                                        <button onclick="tambahApproval()" class="btn btn-primary">Tambah Approval</button>
                                        <button onclick="resetApproval()" class="btn btn-danger">Reset Approval</button>
                                    </div>
                                    <div class="panel" style="margin-top: 20px">
                                        <div class="panel-body">
                                            <p>List approval</p>
                                            <ul id="approvalList">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group tembusan-picker">
                                    <label for="tembusanPicker" class="control-label">Pilih Tembusan</label>
                                    <select id="tembusanPicker" class="selectpicker" name="tembusanPicker"
                                        data-style="btn-custom" data-live-search="true" onchange="tambahTembusan()"
                                        required>
                                        <option value="">--Pilih Tembusan--</option>
                                        @foreach ($tembusan as $item)
                                            <option value="{{ $item }}">
                                                {{ $item->nama_tembusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group footer-picker">
                                    <label for="footerPicker" class="control-label">Pilih Footer</label>
                                    <select id="footerPicker" class="selectpicker" name="footerPicker"
                                        data-style="btn-custom" data-live-search="true" onchange="tambahFooter()"
                                        required>
                                        <option value="">--Pilih Footer--</option>
                                        @foreach ($footer as $item)
                                            <option value="{{ $item }}">
                                                {{ $item->nama_footer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="container">
                                {{-- <button type="button" class="btn btn-success waves-effect waves-light" onclick="cekSurat()"
                                data-dismiss="modal">Lihat</button> --}}
                                <a class="btn btn-danger waves-effect waves-light" onclick="reset()">Reset</a>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="panel">
                    <div class="panel-body" id="isi">

                    </div>
                    <div class="panel-footer">
                        <a href="" id="tambahMaster" class="btn btn-info waves-effect waves-light"
                            data-toggle="modal" data-target="#addMasterModal">Simpan <i
                                class="mdi mdi-content-save"></i></a>
                    </div>
                </div>
                <!-- end row -->
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->


    </div>
@endsection

@section('script')
    <!-- Examples -->
    <script src="{{ url('plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ url('plugins/tiny-editable/numeric-input-example.js') }}"></script>


    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('assets/pages/jquery.datatables.editable.init.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

    {{-- <script src="{{ url('assets/js/pengaturan/master.js') }}"></script> --}}

    <script>
        function viewKop(id) {
            console.log(id)
        }
    </script>
    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    </script>
    <script>
        let kop = {};
        let body = [];
        let approval = [];
        let tembusan = {};
        let footer = {};


        function tambahKop() {
            kop = JSON.parse($('#kopPicker').val());
            cekSurat();
        }

        function tambahBody() {
            if ($('#bodyPicker').val() == '') {
                return
            }
            let tambah_body = $('#bodyPicker').val() != 'input' ? JSON.parse($('#bodyPicker').val()) : 'input';
            body = [...body, tambah_body]

            let html_body = ''

            body.map((val, i) => {
                if (val == 'input') {
                    html_body += `<li>User input</li>`
                } else {
                    let nama = val.nama_body;

                    html_body += `<li>${nama}</li>`
                }
            })
            $('#bodyList').html(html_body)
            cekSurat()
        }

        function resetBody() {
            body = []
            $('#bodyList').html('')
            cekSurat()
        }

        function tambahApproval() {
            if ($('#approvalPicker').val() == '') {
                return
            }
            let tambah_approval = JSON.parse($('#approvalPicker').val());
            approval = [...approval, tambah_approval]

            let html_approval = ''

            approval.map((val, i) => {
                let nama = val.nama_ttd;
                console.log(nama);

                html_approval += `<li>${nama}</li>`
            })
            $('#approvalList').html(html_approval)
            cekSurat()

        }

        function resetApproval() {
            approval = []
            $('#approvalList').html('')
            cekSurat()
        }

        function tambahTembusan() {
            tembusan = JSON.parse($('#tembusanPicker').val());
            cekSurat();
        }

        function tambahFooter() {
            footer = JSON.parse($('#footerPicker').val());
            cekSurat();
        }

        function cekSurat() {
            let upperinput =
                `<table>
                <tr>
                    <td>No</td>
                    <td style="padding: 0 10px">:</td>
                    <td>No Surat</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td style="padding: 0 10px">:</td>
                    <td>Perihal</td>
                </tr>
            </table>
            <br>`;

            let greetinginput = `<p>Kepada Yth, <br><b>Tujuan</b><br>Di Tempat</p>`;

            let tanggalinput =
                `<p style='text-align: center'>Bandung, Tanggal Approve<br>BADAN PENGURUS HARIAN SINODE GKKD</p>`;
            tembusantext =
                `<table style='vertical-align: top'>
                    <tr>
                        <td style='vertical-align: top'>Tembusan</td>
                        <td style= 'vertical-align: top; padding: 0 12px'>:</td>
                        <td>${tembusan.tembusan_text?tembusan.tembusan_text:''}</td>
                    </tr>
                </table>`

            let stringSurat = (kop.headerdescription ? kop.headerdescription : '') + upperinput + greetinginput;
            body.map((v, i) => {
                if (v == 'input') {
                    stringSurat += `
                    <br>
                    <table style='margin-left:50px'>
                        <tr>
                            <td>Nama</td>
                            <td style="padding: 0 10px">:</td>
                            <td>Mohamad Alfin Nahrowi</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td style="padding: 0 10px">:</td>
                            <td>Jr. Cikapayang No. 632, Padang</td>
                        </tr>
                    </table>
                    <br>
                    `
                } else {
                    stringSurat += v.html_body ? v.html_body : ''
                }
            });


            let tandaTangan = `<div style="padding: 12px;display: flex; flex-direction: row; justify-content: center">`;
            approval.map((v, i) => {
                tandaTangan += `
                <div style="flex: 1; text-align: center">
                    <img style='padding: 8px;object-fit:contain;' src='${s3_url+v.ttd}' height='120px'><br>
                    <span><b>${v.jabatan_ttd}</b><br>${v.user.nama}</span>
                </div>`;
            });
            tandaTangan += `</div>`;

            stringSurat += tanggalinput + tandaTangan + tembusantext + (footer.footer ? footer.footer : '');
            $('#isi').html(stringSurat);
        }

        function reset() {
            console.log('reset');
            let kop = {};
            let body = [];
            let approval = [];
            let tembusan = {};
            let footer = {};

            spVal('kopPicker', '')
            spVal('bodyPicker', '')
            spVal('approvalPicker', '')
            spVal('tembusanPicker', '')
            spVal('footerPicker', '')

            $('#bodyList').html('')
            $('#approvalList').html('')
            $('#isi').html('')
        }
        reset()

        $('#formMaster').submit(function(e) {
            e.preventDefault();

            let cek = {
                _token: "{{ csrf_token() }}",
                nama_master: $('#nama_master').val(),
                jenis_surat: $('#jenisSuratPicker').val(),
                kop,
                body,
                approval,
                tembusan,
                footer
            };
            console.log('cek', cek);
            $.ajax({
                type: "POST",
                url: "{{ url('api/v1/superadmin/administrasi/pengaturan/master-surat/tambah-master/simpan') }}",
                data: cek,
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    window.location.href =
                        '{{ url('superadmin/administrasi/pengaturan/master-surat/berhasil-tambah') }}'
                },
                error(xhr, status, error) {
                    $('#berhasil').css('display', 'none')
                    $('#gagal').css('display', 'inline')
                    alert(xhr.responseJSON.error);
                    $('#textGagal').html(xhr.responseJSON.error)
                    console.log(xhr.responseJSON);
                }
            });

        });
    </script>
@endsection
