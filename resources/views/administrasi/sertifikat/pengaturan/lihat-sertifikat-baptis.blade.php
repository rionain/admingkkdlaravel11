@include('administrasi.sertifikat.pengaturan.lihat-sertifikat-style')

<table>
    <tr>
        <td>
            <div style="margin: auto;width: 140px">
                <img src="{{ public_path('assets/images/users/400x600.png') }}" style="width: 140px">
            </div>
        </td>
        <td>
            <div style="position: absolute;left: 20px;top: 60px">
                Nomor : ____________________________
            </div>
            <h1 style="text-align: center;">Baptisan Air</h1>
            <div id="header" style="text-align: center;margin-top: 0">
                <img src="{{ $sertifikat->logo_header ? public_path('storage/' . $sertifikat->logo_header) : public_path('assets/images/logo-sinode.png') }}"
                    style="width:80px">
                {!! $sertifikat->header_html ?: '<h3 style="margin-bottom: 5px;margin-top: 0">Gereja Kristen Kemah Daud</h3> <p style="margin: 0;font-size: 10">Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun 1991 </p>' !!}
                <h3 style="margin: 0;">Jemaat :</h3>
            </div>

            <div id="info-pernyataan-jemaat" style="text-align: center">
                <p>____________________________________________________________</p>
                <p style="line-height: 30px">
                    Menyatakan dengan ini bahwa pada tanggal _________________ di
                    _________________ telah menerima baptisan kudus dalam nama BAPA, ANAK dan ROH KUDUS yaitu Tuhan
                    Yesus Kristus.
                </p>
            </div>

            <hr style="border: 3.5px solid black; margin-bottom:0">
            <hr style="border: 1px solid; margin-top: 2px">

            <table style="width: 100%;">
                <tr>
                    <td width="20%">Lahir di</td>
                    <td>: ___________________________________________________
                    </td>
                </tr>
                <tr>
                    <td width="20%">Pada Tanggal</td>
                    <td>: ___________________________________________________
                    </td>
                </tr>
                <tr>
                    <td width="20%">Anak dari Bapak</td>
                    <td>: ___________________________________________________
                    </td>
                </tr>
                <tr>
                    <td width="20%">Anak dari Ibu</td>
                    <td>: ___________________________________________________
                    </td>
                </tr>
            </table>

            <div id="info-ayat" style="text-align: center">
                <h4>Telah mengaku pada Tuhan Yesus Kristus, Juru Selamat Dunia</h4>
                <p style="max-height: 30px"><i>{!! $sertifikat->ayat_html ?: 'Sebab jika mengaku dengan mulutmu, bahwa Yesus adalah tuhan dan percaya dalam hatimu, bahwa Allah telah membangkitkan Dia dari antara orang mati, maka akan diselamatkan. (Roma 10:9)' !!} </i></p>
            </div>
            <div id="info-pelayanan">
                <p>Baptisan kudus dilayani oleh :</p>
                <table style="width: 100%;">
                    <tr>
                        <td width="20%">Pdt. / Ev.</td>
                        <td>: ___________________________________________________
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">Saksi</td>
                        <td>
                            : ___________________________________________________
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">Saksi</td>
                        <td>
                            : ___________________________________________________
                        </td>
                    </tr>
                </table>
            </div>

            <p style="text-align: right;margin-top: 50px">(________________________)</p>
        </td>
        <td>

            <div style="margin: auto;width: 140px">
                <img src="{{ $sertifikat->foto_kanan ? public_path('storage/' . $sertifikat->foto_kanan) : public_path('assets/images/foto-baptis.jpg') }}"
                    style="width: 140px">
            </div>

        </td>
    </tr>
</table>
