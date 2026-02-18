@include('administrasi.sertifikat.pengaturan.lihat-sertifikat-style')

<table style="width:100%;">
    <tr>
        <td colspan="3">
            <div style="position: absolute;left: 20px;top: 60px">
                Nomor : ____________________________
            </div>
            <div style="width: 85%;margin: auto">
                <h1 style="text-align: center;">{{ ucfirst(request('jenis')) }} Nikah</h1>
                <div id="header" style="text-align: center;margin-top: 0">
                    <img src="{{ $sertifikat->logo_header ? public_path('storage/' . $sertifikat->logo_header) : public_path('assets/images/logo-sinode.png') }}"
                        style="width:80px">
                    {!! $sertifikat->header_html ?: '<h3>Gereja Kristen Kemah Daud</h3>' !!}
                    <h3 style="margin: 0;">Jemaat :</h3>
                </div>

                <div id="info-pernyataan-jemaat" style="text-align: center">
                    <p>_____________________________________________</p>
                    <p style="line-height: 30px">
                        Menyatakan dengan ini bahwa hari ini _______ tanggal _________________ di
                        _________________ telah menerima {{ request('jenis') }} nikah.
                    </p>
                </div>

                <h3 style="text-align: center">"DALAM NAMA ALLAH BAPA, ANAK DAN ROH KUDUS"</h3>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%">
            <div style="margin: auto;width: 140px">
                <img src="{{ public_path('assets/images/users/400x600.png') }}" style="width: 140px">
            </div>
        </td>
        <td style="width: 60%">
            <table style="margin: auto;">
                <tr>
                    <td>Nama</td>
                    <td>: ____________________________________
                    </td>
                </tr>
                <tr>
                    <td>Tempat / tanggal lahir</td>
                    <td>: ____________________________________
                    </td>
                </tr>
                <tr>
                    <td>Tanggal lahir baru</td>
                    <td>: ____________________________________
                    </td>
                </tr>
                <tr>
                    <td>Tanggal baptis air</td>
                    <td>: ____________________________________
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="margin-left: 20px">dengan</p>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: ____________________________________
                    </td>
                </tr>
                <tr>
                    <td>Tempat / tanggal lahir</td>
                    <td>: ____________________________________
                    </td>
                </tr>
                <tr>
                    <td>Tanggal lahir baru</td>
                    <td>: ____________________________________
                    </td>
                </tr>
                <tr>
                    <td>Tanggal baptis air</td>
                    <td>: ____________________________________
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <div style="margin: auto;width: 140px">
                <img src="{{ $sertifikat->foto_kanan ? public_path('storage/' . $sertifikat->foto_kanan) : public_path('assets/images/foto-baptis.jpg') }}"
                    style="width: 140px">
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <table style="text-align: center;margin-top: 60;margin-left: auto;margin-right: auto">
                <tr>
                    <th>_________________</th>
                </tr>
                <tr>
                    <th>( Pengantin pria )</th>
                </tr>
            </table>
        </td>
        <td>
            <table style="text-align: center;margin-top: 60;margin-left: auto;margin-right: auto">
                <tr>
                    <th>_________________</th>
                </tr>
                <tr>
                    <th>( Pengantin wanita )</th>
                </tr>
            </table>
        </td>
        <td>
            <table style="text-align: center;margin-top: 60;margin-left: auto;margin-right: auto">
                <tr>
                    <th>_________________</th>
                </tr>
                <tr>
                    <th>( Pengantin melayani )</th>
                </tr>
            </table>
        </td>
    </tr>
</table>
