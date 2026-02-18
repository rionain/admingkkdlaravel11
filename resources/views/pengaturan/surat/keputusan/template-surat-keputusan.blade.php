@extends('layouts.layout-kosong')

@section('css')
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <style>
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        @page {
            margin: 0 2cm;
        }
    </style>
@endsection
@section('content')
    <header>
        {!! $pengaturan_surat_keputusan->kop->headerdescription !!}
    </header>

    <br>

    <main>
        <div>
            <h5 style="text-align: center">
                SURAT KEPUTUSAN
                <br>
                BADAN PENGURUS HARIAN SINODE GKKD
                <br>
                <u>TENTANG PENGANGKATAN BIDANG KEJEMAATAN</u>
                <br>
                NOMOR : _______________________
            </h5>
        </div>
        <br>

        {!! $pengaturan_surat_keputusan->pembukaan !!}

        <h5 style="margin-bottom: 0">Menimbang :</h5>
        <ol>
            <li>Setelah memperhatikan buah-buah kehidupan dan pelayanan Jemaat GKKD Pekanbaru</li>
            <li>Demi kemajuan pelayanan jemaat di GKKD Pekanbaru.</li>
        </ol>

        <h5 style="margin-bottom: 0">memperhatikan :</h5>
        <ol>
            <li>Anggaran Rumah Tangga GKKD Pasal 42 tentang Pendeta</li>
            <li>Surat Keputusan Nomor : S-GKKD/SKEP.PDM/230/XI-2015 tentang Penetapan Pdm. Benas B Hutajulu, ST, MA</li>
        </ol>


        <h5 style="margin-bottom: 0">memutuskan :</h5>
        <p>Mengangkat Pdt. Yopy Halomoan Sinaga, SP., M.Si. sebagai Ketua Bidang Kejemaatan<br></p>

        {!! $pengaturan_surat_keputusan->penutupan !!}
        <br>
        <br>
        <p style='text-align: center'>Jakarta, {{ date('d-m-Y') }}<br>BADAN PENGURUS HARIAN SINODE GKKD</p>


        <div style="padding: 12px;display: flex; flex-direction: row; justify-content: center">
            @foreach ($pengaturan_surat_keputusan->detail_ttd as $key => $item)
                <div style="flex: 1; text-align: center">
                    <img style='padding: 8px;object-fit:contain;' src='{{ S3Helper::get(@$item->ttd->ttd) }}'
                        height='120px'><br>
                    <span><b>{!! @$item->ttd->jabatan_ttd !!}</b><br>{!! @$item->ttd->user->nama !!}</span>
                </div>
            @endforeach
        </div>

        <table style='vertical-align: top'>
            <tr>
                <td style='vertical-align: top'>Tembusan</td>
                <td style='vertical-align: top; padding: 0 12px'>:</td>
                <td> {!! $pengaturan_surat_keputusan->tembusan->tembusan_text !!}</td>
            </tr>
        </table>
        <br>
    </main>

    <footer>
        {!! $pengaturan_surat_keputusan->footer->footer !!}
    </footer>
@endsection

@section('script')
    <!-- App js -->
    <script src="{{ url('assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('assets/js/jquery.app.js') }}"></script>

    <script>
        window.print();
        // const ival = setInterval(function() {
        //     window.close();
        //     clearInterval(ival);
        // }, 1000);
    </script>
@endsection
