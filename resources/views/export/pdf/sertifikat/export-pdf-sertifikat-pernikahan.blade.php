@include('administrasi.sertifikat.pengaturan.lihat-sertifikat-style')

<div
    style="width: 100%; height:100vh;background-repeat: no-repeat;background-size: 100% 793.5px;background-image: url('{{ asset('assets/images/border.png') }}')">
    <table style="width:100%;" border="0">
        <tr>
            <td colspan="3">
                <div style="position: absolute;left: 50px;top: 80px">
                    Nomor : {{ $sertifikat_pernikahan->no_sertifikat }}
                </div>
                <div style="position: absolute;right: 50px;top: 80px">
                    <img src="data:image/png;base64,{{ $qrcode }}">
                </div>
                <div style="width: 85%;margin: auto">
                    <h1 style="text-align: center; text-transform: uppercase; margin-top: 40px;">
                        {{ ucfirst(request('jenis')) }} Nikah</h1>
                    <div id="header" style="text-align: center; margin-top: -15px;">
                        <img src="{{ $sertifikat->logo_header ? S3Helper::get($sertifikat->logo_header) : asset('assets/images/logo-sinode.png') }}"
                            style="width:80px">
                        <div style="margin-top: 10px;">
                            {!! $sertifikat->header_html ?: '<h3>Gereja Kristen Kemah Daud</h3>' !!}
                        </div>
                        <h3 style="margin: 0; margin-top: 5px;">Gereja Lokal :</h3>
                    </div>

                    <div id="info-pernyataan-jemaat" style="text-align: center;">
                        <div style="font-weight: bold; text-transform: uppercase; font-size: 18px; margin-top: 5px;">
                            {{ $sertifikat_pernikahan->cabang->nama_cabang ?: '_____________________________________________' }}
                        </div>
                        <p style="font-size: 14px;">
                            Menyatakan dengan ini bahwa hari ini
                            {{ ucfirst(hari($sertifikat_pernikahan->tanggal_pernikahan)) }}
                            tanggal
                            {{ tanggal_indonesia(format_date($sertifikat_pernikahan->tanggal_pernikahan, 'Y-m-d')) }}
                            di
                            {{ $sertifikat_pernikahan->tempat_pernikahan ?: '_________________' }} <br>telah menerima
                            {{ request('jenis') }} nikah.
                        </p>
                    </div>

                    <div style="text-align: center; font-weight: bold; font-size: 20px; margin-top: 0px;">"DALAM NAMA
                        ALLAH BAPA, ANAK
                        DAN ROH KUDUS"</div>
                </div>
            </td>
        </tr>
        <tr>
            <td width="25%">
                <div style="margin: auto; width: 200px;">
                    <img src="{{ $sertifikat_pernikahan->foto ? S3Helper::get($sertifikat_pernikahan->foto) : asset('assets/images/default-pernikahan.png') }}"
                        style="width: 220px; margin-right: 100px;">
                </div>
            </td>
            <td style="width: 50%;">
                <table style="margin: auto; width: 80%; font-size: 14px; padding-top: 10px; padding-left: 30px;">
                    <tr>
                        <td>Nama</td>
                        <td style="text-transform: none;">:
                            {{ $sertifikat_pernikahan->nama_pasangan_pria ?: '____________________________________' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat / tanggal lahir</td>
                        <td style="text-transform: capitalize;">:
                            {{ strtolower($sertifikat_pernikahan->tempat_lahir_pasangan_pria) ?: '____________________________________' }}
                            /
                            {{ tanggal_indonesia(format_date($sertifikat_pernikahan->tanggal_lahir_pasangan_pria, 'Y-m-d')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal lahir baru</td>
                        <td>:
                            {{ tanggal_indonesia(format_date($sertifikat_pernikahan->tanggal_lahir_baru_pasangan_pria, 'Y-m-d')) ?: '____________________________________' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal baptisan air</td>
                        <td>:
                            {{ tanggal_indonesia(format_date($sertifikat_pernikahan->tanggal_baptis_pasangan_pria, 'Y-m-d')) ?: '____________________________________' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" height="40">
                            <div style="margin-left: 0px; ">dengan</div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td style="text-transform: none;">:
                            {{ $sertifikat_pernikahan->nama_pasangan_wanita ?: '____________________________________' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat / tanggal lahir</td>
                        <td style="text-transform: capitalize;">:
                            {{ strtolower($sertifikat_pernikahan->tempat_lahir_pasangan_wanita) ?: '____________________________________' }}
                            /
                            {{ tanggal_indonesia(format_date($sertifikat_pernikahan->tanggal_lahir_pasangan_wanita, 'Y-m-d')) ?: '____________________________________' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal lahir baru</td>
                        <td>:
                            {{ tanggal_indonesia(format_date($sertifikat_pernikahan->tanggal_lahir_baru_pasangan_wanita, 'Y-m-d')) ?: '____________________________________' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal baptisan air</td>
                        <td>:
                            {{ tanggal_indonesia(format_date($sertifikat_pernikahan->tanggal_baptis_pasangan_wanita, 'Y-m-d')) ?: '____________________________________' }}
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <div style="margin: auto; width: 240px">
                    <img src="{{ $sertifikat->foto_kanan ? S3Helper::get($sertifikat->foto_kanan) : asset('assets/images/foto-baptis.jpg') }}"
                        style="width: 220px; height: 150px;">
                </div>
            </td>
        </tr>
    </table>
    <div style="width: 90%; margin: auto; margin-top: 10px;">
        <table style="" width='100%' border="0">
            <tr>
                <td height='70px' style="text-align: center; width:33.3%;">
                    @if ($sertifikat_pernikahan->tanda_tangan_pengantin_pria)
                        <img src="{{ $sertifikat_pernikahan->tanda_tangan_pengantin_pria ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_pengantin_pria) : asset('assets/images/foto-baptis.jpg') }}"
                            alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                    @else
                        <br><br><br>
                    @endif
                </td>
                <td style="text-align: center; width:33.3%;">
                    @if ($sertifikat_pernikahan->tanda_tangan_pengantin_wanita)
                        <img src="{{ $sertifikat_pernikahan->tanda_tangan_pengantin_wanita ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_pengantin_wanita) : asset('assets/images/foto-baptis.jpg') }}"
                            alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                    @else
                        <br><br><br>
                    @endif
                </td>
                <td style="text-align: center; width:33.3%;">
                    @if ($sertifikat_pernikahan->tanda_tangan_pendeta)
                        <img src="{{ $sertifikat_pernikahan->tanda_tangan_pendeta ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_pendeta) : asset('assets/images/foto-baptis.jpg') }}"
                            alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                    @else
                        <br><br><br>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <div style="text-transform: none;">
                        {{ setMaxChar(30, $sertifikat_pernikahan->nama_pasangan_pria) ?: '_________________' }}
                    </div>
                </td>
                <td style="text-align: center;">
                    <div style="text-transform: none;">
                        {{ setMaxChar(30, $sertifikat_pernikahan->nama_pasangan_wanita) ?: '_________________' }}
                    </div>
                </td>
                <td style="text-align: center;">
                    <div style="text-transform: none;">
                        {{ setMaxChar(30, $sertifikat_pernikahan->nama_pendeta) ?: '_________________' }}
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;">( Pengantin laki-laki )</td>
                <td style="text-align: center; font-weight: bold;">( Pengantin Perempuan )</td>
                <td style="text-align: center; font-weight: bold;">( Yang Melayani )</td>
            </tr>
        </table>
    </div>
    {{-- <div style="position: relative; margin-top: 10px;">
        <div style="position: absolute; width: 200px; height: 200px; left: 0px; top: 0px;">
            <div class="" style="text-align: center;">
                <div style="font-weight: bold;">Pengantin Pria</div>
                @if ($sertifikat_pernikahan->tanda_tangan_pengantin_pria)
                    <img src="{{ $sertifikat_pernikahan->tanda_tangan_pengantin_pria ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_pengantin_pria) : asset('assets/images/foto-baptis.jpg') }}"
                        alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                @else
                    <br><br><br>
                @endif
                <div style="text-transform: uppercase;">(
                    {{ $sertifikat_pernikahan->nama_pasangan_pria ?: '_________________' }} )</div>
            </div>
        </div>
        <div style="position: absolute; width: 200px; height: 200px; left: 230px; top: 0px;">
            <div class="" style="text-align: center;">
                <div style="font-weight: bold;">Pengantin Wanita</div>
                @if ($sertifikat_pernikahan->tanda_tangan_pengantin_wanita)
                    <img src="{{ $sertifikat_pernikahan->tanda_tangan_pengantin_wanita ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_pengantin_wanita) : asset('assets/images/foto-baptis.jpg') }}"
                        alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                @else
                    <br><br><br>
                @endif
                <div style="text-transform: uppercase;">(
                    {{ $sertifikat_pernikahan->nama_pasangan_wanita ?: '_________________' }} )</div>
            </div>
        </div>
        <div style="position: absolute; width: 200px; height: 200px; right: 460px; top: 0px;">
            <div class="" style="text-align: center;">
                <div style="font-weight: bold;">Pendeta</div>
                @if ($sertifikat_pernikahan->tanda_tangan_pendeta)
                    <img src="{{ $sertifikat_pernikahan->tanda_tangan_pendeta ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_pendeta) : asset('assets/images/foto-baptis.jpg') }}"
                        alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                @else
                    <br><br><br>
                @endif
                <div style="text-transform: uppercase;">(
                    {{ $sertifikat_pernikahan->nama_pendeta ?: '_________________' }} )</div>
            </div>
        </div>
        <div style="position: absolute; width: 200px; height: 200px; right: 230px; top: 0px;">
            <div class="" style="text-align: center;">
                <div style="font-weight: bold;">Saksi 1</div>
                @if ($sertifikat_pernikahan->tanda_tangan_saksi1)
                    <img src="{{ $sertifikat_pernikahan->tanda_tangan_saksi1 ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_saksi1) : asset('assets/images/foto-baptis.jpg') }}"
                        alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                @else
                    <br><br><br>
                @endif
                <div style="text-transform: uppercase;">(
                    {{ $sertifikat_pernikahan->nama_saksi1 ?: '_________________' }} )</div>
            </div>
        </div>
        <div style="position: absolute; width: 200px; height: 200px; right: 0px; top: 0px;">
            <div class="" style="text-align: center;">
                <div style="font-weight: bold;">Saksi 2</div>
                @if ($sertifikat_pernikahan->tanda_tangan_saksi2)
                    <img src="{{ $sertifikat_pernikahan->tanda_tangan_saksi2 ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_saksi2) : asset('assets/images/foto-baptis.jpg') }}"
                        alt="" style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                @else
                    <br><br><br>
                @endif
                <div style="text-transform: uppercase;">(
                    {{ $sertifikat_pernikahan->nama_saksi2 ?: '_________________' }} )
                </div>
            </div>
        </div>
    </div> --}}
</div>
<div
    style="width: 100%; height:100vh;background-repeat: no-repeat;background-size: 100% 793.5px;background-image: url('{{ asset('assets/images/border.png') }}'); position: relative;">
    <table
        style="padding: 0 0; margin:auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <tr>
            <td>
                <div style="width: 96%; margin-left: 15px;">
                    <h3 style="text-align: center;"><u>SAKSI :</u></h3>
                    <div id="info-pelayanan">
                        <table style="width: 60vw;">
                            <tr>
                                <td width="45%" height="120px" style="text-align: center;">
                                    @if ($sertifikat_pernikahan->tanda_tangan_saksi1)
                                        <img src="{{ $sertifikat_pernikahan->tanda_tangan_saksi1 ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_saksi1) : asset('assets/images/foto-baptis.jpg') }}"
                                            alt=""
                                            style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                                    @else
                                        <br><br><br>
                                    @endif
                                </td>
                                <td width="10%" style="text-align: center;">
                                </td>
                                <td style="text-align: center;">
                                    @if ($sertifikat_pernikahan->tanda_tangan_saksi2)
                                        <img src="{{ $sertifikat_pernikahan->tanda_tangan_saksi2 ? S3Helper::get($sertifikat_pernikahan->tanda_tangan_saksi2) : asset('assets/images/foto-baptis.jpg') }}"
                                            alt=""
                                            style="width: 100px; height: 50px; margin-top: 10px; margin-bottom: 10px;">
                                    @else
                                        <br><br><br>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 16px;">
                                    <div style="text-transform: none;">
                                        {{ setMaxChar(30, $sertifikat_pernikahan->nama_saksi1) ?: '_________________' }}
                                    </div>
                                </td>
                                <td></td>
                                <td style="text-align: center; font-size: 16px;">
                                    <div style="text-transform: none;">
                                        {{ setMaxChar(30, $sertifikat_pernikahan->nama_saksi2) ?: '_________________' }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 16px; font-weight: bold;">[ Orang Tua / Wali
                                    laki-laki ]</td>
                                <td></td>
                                <td style="text-align: center; font-size: 16px; font-weight: bold;">[ Orang Tua / Wali
                                    Perempuan ]</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
