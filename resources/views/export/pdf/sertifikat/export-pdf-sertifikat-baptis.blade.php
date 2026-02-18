@include('administrasi.sertifikat.pengaturan.lihat-sertifikat-style')

<div
    style="width: 100%; height:100vh;background-repeat: no-repeat;background-size: 100% 793.5px;background-image: url('{{ asset('assets/images/border.png') }}')">
    <table style="padding: 0 30px;margin:auto">
        <tr>
            <td>
                <div style="margin: auto;width: 140px">
                    <img src="{{ $sertifikat_baptis->foto_jemaat ? S3Helper::get($sertifikat_baptis->foto_jemaat) : asset('assets/images/users/400x600.png') }}"
                        style="width: 100%; height: 225px;object-fit: cover">
                </div>
            </td>
            <td>
                <div style="width: 96%;margin-top: 50px; margin-left: 15px;">
                    <div style="position: absolute;left: 50px;top: 80px">
                        Nomor : {{ $sertifikat_baptis->no_sertifikat ?: '____________________________' }}
                    </div>
                    <div style="position: absolute;right: 50px;top: 80px">
                        <img src="data:image/png;base64,{{ $qrcode }}">
                    </div>
                    <h1 style="text-align: center;">BAPTISAN AIR</h1>
                    <div id="header" style="text-align: center;margin-top: 0">
                        <img src="{{ $sertifikat->logo_header ? S3Helper::get($sertifikat->logo_header) : asset('assets/images/logo-sinode.png') }}"
                            style="width:80px">
                        {!! $sertifikat->header_html ?:
                            '<h3 style="margin-bottom: 5px;margin-top: 0">Gereja Kristen Kemah Daud</h3> <p style="margin: 0;font-size: 10">Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun 1991 </p>' !!}
                        <h3 style="margin-bottom: 8px; margin-top: 5px;">Gereja Lokal: {{ $sertifikat_baptis->cabang->nama_cabang }}</h3>
                    </div>
                    <div id="info-pernyataan-jemaat" style="text-align: center; margin-top: -5px;">
                        <h2 style="margin-bottom: 0px; text-transform: uppercase;">
                            {{ $sertifikat_baptis->nama_jemaat ?: '____________________________________________________________' }}
                        </h2>
                        <p style="font-size: 14px; margin-top: 5px;">
                            Menyatakan dengan ini bahwa pada tanggal
                            {{ tanggal_indonesia(format_date($sertifikat_baptis->tanggal_baptis, 'Y-m-d')) ?: '_________________' }}
                            di
                            {{ $sertifikat_baptis->tempat_baptis ?: '_________________' }} telah menerima baptisan
                            kudus
                            dalam
                            nama BAPA, ANAK dan ROH KUDUS yaitu Tuhan
                            Yesus Kristus.
                        </p>
                    </div>
                    <hr style="border: 3.5px solid black; margin-bottom:0;">
                    <hr style="border: 1px solid; margin-top: 2px">
                    <table style="width: 100%; margin-left: 20px;">
                        <tr>
                            <td width="20%">Lahir di</td>
                            <td>: {{ $sertifikat_baptis->tempat_lahir ?: '________________________________________' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Pada Tanggal</td>
                            <td>:
                                {{ tanggal_indonesia(format_date($sertifikat_baptis->tanggal_lahir, 'Y-m-d')) ?: '___________________________________________________' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Anak dari Bapak</td>
                            <td>:
                                {{ $sertifikat_baptis->nama_ayah ?: '___________________________________________________' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Anak dari Ibu</td>
                            <td>:
                                {{ $sertifikat_baptis->nama_ibu ?: '___________________________________________________' }}
                            </td>
                        </tr>
                    </table>
                    <div id="info-ayat" style="text-align: center">
                        <h4 style="margin-top:10px;">Telah mengaku pada Tuhan Yesus Kristus, Juru Selamat Dunia</h4>
                        <p style="max-height: 30px; font-size: 14px; margin-top: -10px;"><i>{!! $sertifikat->ayat_html ?:
                            'Sebab jika mengaku dengan mulutmu, bahwa Yesus adalah tuhan dan percaya dalam hatimu, bahwa Allah telah membangkitkan Dia dari antara orang mati, maka akan diselamatkan. (Roma 10:9)' !!} </i></p>
                    </div>
                    <div id="info-pelayanan">
                        <p style="font-size: 16px;">Baptisan Air dilayani oleh :</p>
                        <table style="width: 100%;">
                            <tr>
                                <td width="15%">Yang membaptis</td>
                                <td>:
                                    {{ setMaxChar(30, $sertifikat_baptis->nama_pembaptis) ?: '___________________________________________________' }}
                                </td>
                            </tr>
                            <tr>
                                <td width="15%">Saksi 1</td>
                                <td>
                                    :
                                    {{ setMaxChar(30, $sertifikat_baptis->saksi1) ?: '___________________________________________________' }}
                                </td>
                            </tr>
                            <tr>
                                <td width="15%">Saksi 2</td>
                                <td>
                                    :
                                    {{ setMaxChar(30, $sertifikat_baptis->saksi2) ?: '___________________________________________________' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="" style="position: relative">
                        <div class="" style="position: absolute; top: -50px; right: 0px;">
                            <div style="text-align: center;">
                                <div style="width: 350px; height: auto;">
                                    <center>
                                        {{ $sertifikat_baptis->nama_kota ?: 'Jakarta' }},
                                        @if ($sertifikat_baptis->tanggal_keluar_sertifikat)
                                            {{ tanggal_indonesia(format_date($sertifikat_baptis->tanggal_keluar_sertifikat, 'Y-m-d')) ?: 'Belum dikeluarkan' }}
                                        @else
                                            {!! badge('danger', 'Belum dikeluarkan') !!}
                                        @endif
                                    </center>
                                    @if ($sertifikat_baptis->foto_tanda_tangan)
                                        <img src="{{ $sertifikat_baptis->foto_tanda_tangan ? S3Helper::get($sertifikat_baptis->foto_tanda_tangan) : asset('assets/images/users/400x600.png') }}"
                                            alt=""
                                            {{-- style="width: 100px; max-height: 60px;margin-top: 10px; margin-bottom: 10px;"> --}}
                                            style="width: auto; max-height: 70px;margin-top: 10px; margin-bottom: 10px;">
                                    @else
                                        <br><br><br>
                                    @endif
                                    <div>
                                        (&nbsp;&nbsp;&nbsp;{{ setMaxChar(30, $sertifikat_baptis->nama_pendeta) ?: '_________________________' }}&nbsp;&nbsp;&nbsp;)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div style="margin: auto;width: 140px">
                    <img src="{{ $sertifikat->foto_kanan ? S3Helper::get($sertifikat->foto_kanan) : asset('assets/images/foto-baptis.jpg') }}"
                        style="width: 100%; height: 225px;object-fit: cover">
                </div>
            </td>
        </tr>
    </table>
</div>
<div
    style="width: 100%; height:100vh;background-repeat: no-repeat;background-size: 100% 793.5px;background-image: url('{{ asset('assets/images/border.png') }}'); position: relative;">
    <table style="padding: 0 0; margin:auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <tr>
            <td>
                <div style="width: 96%; margin-left: 15px;">
                    <h3 style="text-align: center;"><u>SAKSI :</u></h3>
                    <div id="info-pelayanan">
                        <table style="width: 60vw;" border="0">
                            <tr>
                                <td width="45%" height="120px" style="text-align: center;">
                                    @if ($sertifikat_baptis->foto_ttd_saksi_1)
                                        <img src="{{ $sertifikat_baptis->foto_ttd_saksi_1 ? S3Helper::get($sertifikat_baptis->foto_ttd_saksi_1) : asset('assets/images/foto-baptis.jpg') }}"
                                            alt="" style="width: auto; height: 80px; margin-top: 10px; margin-bottom: 10px;">
                                    @else
                                        <br><br><br>
                                    @endif
                                </td>
                                <td width="10%"></td>
                                {{-- <td></td> --}}
                                <td style="text-align: center;">
                                    @if ($sertifikat_baptis->foto_ttd_saksi_2)
                                        <img src="{{ $sertifikat_baptis->foto_ttd_saksi_2 ? S3Helper::get($sertifikat_baptis->foto_ttd_saksi_2) : asset('assets/images/foto-baptis.jpg') }}"
                                            alt="" style="width: auto; height: 80px; margin-top: 10px; margin-bottom: 10px;">
                                    @else
                                        <br><br><br>
                                    @endif
                                </td>
                            </tr>
                            {{-- <tr>
                                <td style="text-align: center; font-size: 16px;">______________________________</td>
                                <td></td>
                                <td style="text-align: center; font-size: 16px;">______________________________</td>
                            </tr> --}}
                            <tr>
                                <td style="text-align: center; font-size: 16px;">( {{ $sertifikat_baptis->saksi1 ?: '______________________________' }} )</td>
                                <td></td>
                                <td style="text-align: center; font-size: 16px;">( {{ $sertifikat_baptis->saksi2 ?: '______________________________' }} )</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
