@include('administrasi.sertifikat.pengaturan.lihat-sertifikat-style')

<div
    style="width: 100%; height:100vh;background-repeat: no-repeat;background-size: 100% 793.5px;background-image: url('{{ asset('assets/images/border.png') }}')">
    <table style="padding: 0 30px;margin:auto">
        <tr>
            <td>
                <div style="margin: auto;width: 140px;margin-top:120px">
                    <img src="{{ $sertifikat_penyerahan_anak->foto ? S3Helper::get($sertifikat_penyerahan_anak->foto) : asset('assets/images/users/400x600.png') }}"
                        style="width: 100%;object-fit: cover">
                </div>
            </td>
            <td>
                <div style="position: absolute;left: 50px;top: 80px">
                    Nomor : {{ $sertifikat_penyerahan_anak->no_sertifikat ?: '____________________________' }}
                </div>
                <div style="position: absolute;right: 50px;top: 80px">
                    <img src="data:image/png;base64,{{ $qrcode }}">
                </div>
                <h2 style="text-align: center; margin-top: 40px; text-transform: uppercase;">Penyerahan Anak</h2>
                <div id="header" style="text-align: center; margin-top: -10px;">
                    <img src="{{ $sertifikat->logo_header ? S3Helper::get($sertifikat->logo_header) : asset('assets/images/logo-sinode.png') }}"
                        style="width:80px">
                        <div style="margin-top: 10px;">
                        {!! $sertifikat->header_html ?:
                            '<h3 style="margin-bottom: 5px;margin-top: 0">Gereja Kristen Kemah Daud</h3> <p style="margin: 0;font-size: 10">Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun 1991 </p>' !!}

                        </div>
                    <h3 style="margin: 0; margin-top: 5px;">Gereja Lokal :</h3>
                </div>

                <div id="info-pernyataan-jemaat" style="text-align: center; margin-left: 25px; margin-right: 25px;">
                    <div style="font-weight: bold; text-transform: uppercase; font-size: 20px; padding: 10px 0px; margin-top: -5px; margin-bottom: -5px;">
                        {{ $sertifikat_penyerahan_anak->cabang->nama_cabang ?: '____________________________________________________________' }}
                    </div>
                    <div class="margin-top: -100px;">
                    {!! $sertifikat->ayat1_html ?:
                        '<h4><i>"... Biarkan anak-anak itu datang kepadaKu; jangan menghalang-halangi mereka, sebab orang-orang itulah yang empunya Kerajaan Surga." <u>Markus 10:14</u></i></h4>' !!}
                    </div>
                    <p style="margin-top: -10px; text-transform: capitalize; font-size: 14px;">
                        Berdasarkan Firman Tuhan Yesus Kristus, maka pada hari ini <br>
                        {{ $sertifikat_penyerahan_anak->tanggal_penyerahan_anak ? strtolower(hari($sertifikat_penyerahan_anak->tanggal_penyerahan_anak)) : '____________________________' }}
                        tanggal
                        {{ tanggal_indonesia(format_date($sertifikat_penyerahan_anak->tanggal_penyerahan_anak, 'Y-m-d')) ?: '____________________________' }}
                        <br>
                    </p>

                    <p style="width:100%; margin:auto; font-size:12; margin-top: 0px;">
                        <i>Dalam ibadah Raya Jemaat, <br>dengan iman percaya yang teguh, dalam kesadaran yang utuh <br>berbekal pengharapan yang penuh</i>
                    </p>
                    <p style="font-size: 14px;">Melalui hambaNya diserahkan seorang anak
                        @if ($sertifikat_penyerahan_anak->jenis_kelamin)
                            {!! $sertifikat_penyerahan_anak->jenis_kelamin == 'l'
                                ? 'Laki-laki/<s>Perempuan</s>'
                                : '<s>Laki-laki</s>/Perempuan' !!}
                        @else
                            laki-laki/perempuan
                        @endif
                        *) bernama :
                    </p>

                    <p style="margin-top: -10px; font-weight: bold; text-transform: uppercase; font-size: 14px;">
                        {{ $sertifikat_penyerahan_anak->nama_jemaat ?: '____________________________________________________________' }}
                    </p>
                    <table style="width: 50%;text-align: left;margin: auto; margin-top: -10px; font-size: 14;">
                        <tr>
                            <td width="20%">Lahir di</td>
                            <td>: {{ $sertifikat_penyerahan_anak->tempat_lahir ?: '_______________________________' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Tanggal</td>
                            <td>:
                                {{ tanggal_indonesia(format_date($sertifikat_penyerahan_anak->tanggal_lahir, 'Y-m-d')) ?: '_______________________________' }}
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="deskripsi" style="width:80%; margin:auto; text-align: center; margin-top: -10px;">
                    <div style="font-size: 14px;">
                        {!! $sertifikat->deskripsi_html ?:
                            '<p>Kedalam pangkuan, Pelukan, Jamahan serta Berkat Yesus Kristus Tuhan. Selaku orang tua, maka dalam takut dan percaya akan Tuhan, berjanji untuk memelihara, mendidik dan menghantarkan anak ini kepada pangkuan dan keputusan pripadinya terhadap Yesus Kristus Sebagai Tuhan dan Juru Selamat</p>' !!}
                    </div>
                    <p style="width:100%; margin:auto; font-size:12; margin-top: -10px;">
                        <i>Kiranya Tuhan meneguhkan janji ini </br>Yang melakukan Penyerahan Anak.</i>
                    </p>
                </div>
            </td>
            <td>
                <div style="margin: auto;width: 140px;margin-top:120px">
                    <img src="{{ $sertifikat->foto_kanan ? S3Helper::get($sertifikat->foto_kanan) : asset('assets/images/foto-baptis.jpg') }}"
                        style="width: 100%;object-fit: cover">
                </div>
            </td>
        </tr>
    </table>

    <div id="info-ortu-hambatuhan-saksipembimbing">
        <table style="width: 90%; margin: auto;" border="0">
            <tr>
                <td style="width: 40%; padding-left: 20px;">
                    <p style="font-style: italic; margin: 0; margin-left: 60px; font-size: 14px;">Orang tua,</p>
                    <table style="font-size: 14px;">
                        <tr>
                            <td width="40"><i>Ayah</i></td>
                            <td width="10px">:</td>
                            <td>{{ setMaxChar(30, $sertifikat_penyerahan_anak->nama_ayah) ?: '_______________' }}</td>
                        </tr>
                        <tr>
                            <td width="40"><i>Ibu</i></td>
                            <td width="10px">:</td>
                            <td>{{ setMaxChar(30, $sertifikat_penyerahan_anak->nama_ibu) ?: '_______________' }}</td>
                        </tr>
                    </table>
                </td>
                <td></td>
                <td style="width: 40%">
                    <p style="font-style: italic; margin: 0; font-size: 14px; margin-left: 120px;">Saksi / Pembimbing,</p>
                    <table style="margin-left: 104px; font-size: 14px;">
                        <tr>
                            <td width="10px;">*</td>
                            <td colspan="2">{{ setMaxChar(30, $sertifikat_penyerahan_anak->saksi_pembimbing1) ?: '_______________________' }}</td>
                        </tr>
                        <tr width="10px;">
                            <td width="10px;">*</td>
                            <td colspan="2">{{ setMaxChar(30, $sertifikat_penyerahan_anak->saksi_pembimbing2) ?: '_______________________' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin: auto; margin-top: -50px;">
            <tr>
                <td style="width: 20%; padding-left: 20px;">
                </td>
                <td>
                    <p style="text-align:center;font-style: italic;margin: 0">Hamba Tuhan,</p>
                    <div style="text-align: center; margin-top: 45px;">
                        <i>{{ setMaxChar(40, $sertifikat_penyerahan_anak->nama_pendeta) ?: '_______________' }}</i>
                    </div>
                    <div style="text-align: center; font-size: 12px;">
                        <i>
                            "Didiklah anak muda menurut jalan yang patut baginya maka pada masa tuanyapun, ia </br>tidak akan
                            menyimpang dari jalan itu"
                            <u>Amsal 22 : 6</u>
                        </i>
                    </div>
                </td>
                <td style="width: 20%">
                </td>
            </tr>
        </table>
    </div>
</div>
<div
    style="width: 100%; height:100vh;background-repeat: no-repeat;background-size: 100% 793.5px;background-image: url('{{ asset('assets/images/border.png') }}'); position: relative;">
    <table style="padding: 0 0; margin:auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <tr>
            <td>
                <div style="width: 96%; margin-left: 15px;">
                    <h3 style="text-align: center;"><u>SAKSI :</u></h3>
                    <div id="info-pelayanan">
                        <table style="width: 60vw;">
                            <tr>
                                <td width="45%" height="120px" style="text-align: center;">
                                    @if ($sertifikat_penyerahan_anak->foto_ttd_saksi_pembimbing_1)
                                        <img src="{{ $sertifikat_penyerahan_anak->foto_ttd_saksi_pembimbing_1 ? S3Helper::get($sertifikat_penyerahan_anak->foto_ttd_saksi_pembimbing_1) : asset('assets/images/foto-baptis.jpg') }}"
                                            alt="" style="width: auto; height: 80px; margin-top: 10px; margin-bottom: 10px;">
                                    @else
                                        <br><br><br>
                                    @endif
                                </td>
                                <td width="10%"></td>
                                <td style="text-align: center;">
                                    @if ($sertifikat_penyerahan_anak->foto_ttd_saksi_pembimbing_2)
                                        <img src="{{ $sertifikat_penyerahan_anak->foto_ttd_saksi_pembimbing_2 ? S3Helper::get($sertifikat_penyerahan_anak->foto_ttd_saksi_pembimbing_2) : asset('assets/images/foto-baptis.jpg') }}"
                                            alt="" style="width: auto; height: 80px; margin-top: 10px; margin-bottom: 10px;">
                                    @else
                                        <br><br><br>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 16px;">( {{ setMaxChar(30, $sertifikat_penyerahan_anak->saksi_pembimbing1) ?: '______________________________' }} )</td>
                                <td></td>
                                <td style="text-align: center; font-size: 16px;">( {{ setMaxChar(30, $sertifikat_penyerahan_anak->saksi_pembimbing2) ?: '______________________________' }} )</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
