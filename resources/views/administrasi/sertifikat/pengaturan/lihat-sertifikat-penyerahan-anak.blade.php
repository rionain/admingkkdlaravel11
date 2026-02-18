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
            <h1 style="text-align: center;">Penyerahan Anak</h1>
            <div id="header" style="text-align: center;margin-top: 0">
                <img src="{{ $sertifikat->logo_header ? public_path('storage/' . $sertifikat->logo_header) : public_path('assets/images/logo-sinode.png') }}"
                    style="width:80px">
                {!! $sertifikat->header_html ?: '<h3 style="margin-bottom: 5px;margin-top: 0">Gereja Kristen Kemah Daud</h3> <p style="margin: 0;font-size: 10">Kementrian Agama RI Dirjen Bimas Kristen No. 110 Tahun 1991 </p>' !!}
                <h3 style="margin: 0;">Jemaat :</h3>
            </div>

            <div id="info-pernyataan-jemaat" style="text-align: center">
                <p>____________________________________________________________</p>
                {!! $sertifikat->ayat1_html ?: '<h3><i>"... Biarkan anak-anak itu datang kepadaKu; jangan menghalang-halangi mereka, sebab orang-orang itulah yang empunya Kerajaan Surga." <u>Markus 10:14</u></i></h3>' !!}
                <p>
                    Berdasarkan Firman Tuhan Yesus Kristus, maka pada hari ini <br>
                    ____________________________ tanggal ____________________________ <br>
                </p>

                <p style="width:40%;margin:auto; font-size:10"><i>Dalam ibadah Raya Jemaat, dengan imam percaya yang
                        teguh, dalam
                        kesadaran yang
                        utuh
                        berbekal
                        pengharapan yang penuh</i>
                </p>
                <p>Melalui hambaNya diserahkan seorang anak laki-laki/perempuan *) bernama :</p>
                <p>____________________________________________________________</p>
                <table style="width: 50%;text-align: left;margin: auto">
                    <tr>
                        <td width="20%">Lahir di</td>
                        <td>: _______________________________
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">Tanggal</td>
                        <td>: _______________________________
                        </td>
                    </tr>
                </table>
            </div>

            <div id="deskripsi" style="text-align: center">
                {!! $sertifikat->deskripsi_html ?: '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam dignissimos consectetur ipsam animi reprehenderit dolorem quae necessitatibus eos accusantium, amet iste natus! At, soluta esse possimus provident natus repudiandae aperiam.</p>' !!}
                <p style="width:40%;margin:auto; font-size:10"><i>Dalam ibadah Raya Jemaat,
                        dengan imam percaya yang
                        teguh, dalam
                        kesadaran yang
                        utuh
                        berbekal</i>
                </p>
            </div>
        </td>
        <td>

            <div style="margin: auto;width: 140px">
                <img src="{{ $sertifikat->foto_kanan ? public_path('storage/' . $sertifikat->foto_kanan) : public_path('assets/images/foto-baptis.jpg') }}"
                    style="width: 140px">
            </div>

        </td>
    </tr>
</table>

<div id="info-ortu-hambatuhan-saksipembimbing" style="font-size: 10">
    <table style="width: 90%;margin: auto">
        <tr>
            <td style="width: 20%">
                <p style="text-align:center;font-style: italic;margin: 0">Orang tua,</p>
                <table>
                    <tr>
                        <td width="40"><i>Ayah</i></td>
                        <td>: _______________
                        </td>
                    </tr>
                    <tr>
                        <td width="40"><i>Ibu</i></td>
                        <td>
                            : _______________
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <p style="text-align:center;font-style: italic;margin: 0">Hamba Tuhan,</p>
                <table>
                    <tr>
                        <td colspan="2" style="text-align:center"><i>Pdt. : _______________</i></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea deleniti blanditiis quibusdam
                            enim error laboriosam fugiat? Dicta, dolorem? Voluptatibus rem accusantium nihil ex quas
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 20%">
                <p style="text-align:center;font-style: italic;margin: 0">Saksi / Pembimbing,</p>
                <table>
                    <tr>
                        <td colspan="2">* _______________________</td>
                    </tr>
                    <tr>
                        <td colspan="2">* _______________________</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
