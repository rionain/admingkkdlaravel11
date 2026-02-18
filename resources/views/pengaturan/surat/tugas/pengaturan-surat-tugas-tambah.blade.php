@extends('layouts.layout')

@section('css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Form</h4>
                            @include('breadcrumb')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="card-box table-responsive">
                        <a href="{{ url('superadmin/pengaturan/surat/tugas') }}" class="btn btn-success">Kembali</a>
                        @csrf
                        <div class="row" style="margin-top:50px">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nama_pengaturan" class="control-label">Nama Pengaturan</label>
                                    <input type="text" class="form-control" id="nama_pengaturan" name="nama_pengaturan"
                                        value="{{ old('nama_pengaturan') ?: @$pengaturan->nama_pengaturan }}">
                                </div>
                                <div class="form-group">
                                    <label for="kop_id" class="control-label">Kop Surat</label>
                                    <select class="form-control" id="kop_id" name="kop_id" onchange="loadHtml()">
                                        <option value="">Pilih Kop Surat</option>
                                        @foreach ($kop as $item)
                                            <option value="{{ $item }}"
                                                @if (old('kop_id') == $item) selected
                                            @elseif (@$pengaturan->kop_id == $item->kop_id)
                                                selected @endif>
                                                {{ $item->nama_kop_surat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tembusan_id" class="control-label">Tembusan Surat</label>
                                    <select class="form-control" id="tembusan_id" name="tembusan_id" onchange="loadHtml()">
                                        <option value="">Pilih Tembusan Surat</option>
                                        @foreach ($tembusan as $item)
                                            <option value="{{ $item }}"
                                                @if (old('tembusan_id') == $item) selected
                                            @elseif (@$pengaturan->tembusan_id == $item->tembusan_id)
                                                selected @endif>
                                                {{ $item->nama_tembusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ttd_id" class="control-label">Tanda tangan Surat</label>
                                    <select class="form-control" id="ttd_id" name="ttd_id[]" multiple="multiple"
                                        onchange="loadHtml()">
                                        @foreach ($tanda_tangan as $item)
                                            <option value="{{ $item }}"
                                                @if (old('ttd_id')) @foreach (old('ttd_id') as $item_ttd)
                                                        @if ($item == $item_ttd)
                                                            selected
                                                            @break @endif
                                                @endforeach
                                            @elseif (@$pengaturan->detail_ttd)
                                                @foreach (@$pengaturan->detail_ttd as $item_ttd) @if ($item->ttd_id == $item_ttd->ttd_id)
                                                            selected
                                                            @break @endif @endforeach
                                        @endif
                                        >
                                        {{ $item->user->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="footer_id" class="control-label">Footer Surat</label>
                                    <select class="form-control" id="footer_id" name="footer_id" onchange="loadHtml()">
                                        <option value="">Pilih Footer</option>
                                        @foreach ($footer as $item)
                                            <option value="{{ $item }}"
                                                @if (old('footer_id') == $item) selected
                                            @elseif (@$pengaturan->footer_id == $item->template_footer_id)
                                                selected @endif>
                                                {{ $item->nama_footer }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-box table-responsive">
                        <div id="html"></div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>


    </div>
@endsection

@section('script')
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>
    <script src="{{ url('plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
    <script src="{{ url('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $('#kop_id').select2();
        $('#tembusan_id').select2();
        $('#ttd_id').select2();
        $('#footer_id').select2();
    </script>

    <script>
        var html = '';
        var kop = '';
        var tembusan = '';
        var ttd = '';
        var footer = '';



        function loadHtml() {
            kop = $('#kop_id').val() ? JSON.parse($('#kop_id').val()).headerdescription : '';
            tembusan = $('#tembusan_id').val() ? JSON.parse($('#tembusan_id').val()).tembusan_text : '';
            footer = $('#footer_id').val() ? JSON.parse($('#footer_id').val()).footer : '';

            ttd = $('#ttd_id').val();
            ttd = Array.isArray(ttd) ? ttd.map((item) => {
                item = JSON.parse(item)
                console.log(item)
                return `
                <div style="flex: 1; text-align: center">
                    <img style='padding: 8px;object-fit:contain;' src='${s3_url+item.ttd}' height='120px'><br>
                    <span><b>${item?.jabatan_ttd}</b><br>${item?.user?.nama}</span>
                </div>
            `
            }) : ''


            html = `
                <header>
                    ${kop}
                </header>

                <main>
                    <div>
                        <h5 style="text-align: center">
                            SURAT TUGAS
                            <br>
                            BADAN PENGURUS HARIAN SINODE GKKD
                            <br>
                            NOMOR : __________________
                        </h5>
                    </div>
                    <br>

                    <p>Sehubungan dengan adanya <b>"Musyawarah Daerah PGLII Eks Karisidenan Semarang"</b>
                        yang akan dilaksanakan pada tanggal {{ date('d-m-Y') }} bertempat di Jakarta, pukul
                        07.00 - 08.00 dengan ini Sinode GKKD memberi tugas kepada :</p>

                    <ol><li>Bpk. Pdt. Purnama Sidhi, S.Th</li><li>Bpk. Pdt. Sabar Berutu, S.Th</li></ol>

                    <p>Untuk melakukan tugas sebagai perwakilan dari Sinode GKKD dan juga mewakili GKKD Semarang pada Musyawarah Daerah PGLII Eks Karisidenan Semarang, serta melakukan dan memutuskan hal-hal yang diperlukan didalam acara tersebut. Demikian surat tugas ini, untuk
                        dapat dipergunakan sebagaimana mestinya.</p>
                    <br>
                    <br>
                    <p style='text-align: center'>Jakarta, {{ date('d-m-Y') }}<br>BADAN PENGURUS HARIAN
                        SINODE GKKD</p>


                    <div style="padding: 12px;display: flex; flex-direction: row; justify-content: center">
                        ${ttd}
                    </div>

                    <table style='vertical-align: top'>
                        <tr>
                            <td style='vertical-align: top'>Tembusan</td>
                            <td style='vertical-align: top; padding: 0 12px'>:</td>
                            <td>${tembusan}</td>
                        </tr>
                    </table>
                    <br>
                </main>

                <footer>
                    ${footer}
                </footer>

            `;
            $('#html').html(html);
        }
        loadHtml();
    </script>
@endsection
