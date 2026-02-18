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
        {!! $pengaturan_surat_tugas->kop->headerdescription !!}
    </header>


    <br>

    <main>
        <div>
            <h5 style="text-align: center">
                SURAT TUGAS
                <br>
                BADAN PENGURUS HARIAN SINODE GKKD
                <br>
                NOMOR : _________________________
            </h5>
        </div>
        <br>

        <p>Sehubungan dengan adanya <b>"Musyawarah Daerah PGLII Eks Karisidenan Semarang"</b>
            yang akan dilaksanakan pada tanggal {{ date('d-m-Y') }} bertempat di Jakarta, pukul
            08.00 - 17.00 dengan ini Sinode GKKD memberi tugas kepada :</p>

        <ol>
            <li>Bpk. Pdt. Purnama Sidhi, S.Th</li>
            <li>Bpk. Pdt. Sabar Berutu, S.Th</li>
        </ol>

        <p>Untuk melakukan tugas sebagai perwakilan dari Sinode GKKD dan juga mewakili GKKD Semarang pada Musyawarah Daerah
            PGLII Eks Karisidenan Semarang, serta melakukan dan memutuskan hal-hal yang diperlukan didalam acara tersebut.
            Demikian surat tugas ini, untuk dapat dipergunakan sebagaimana mestinya.</p>
        <br>
        <br>
        <p style='text-align: center'>
            Jakarta, {{ date('d-m-Y') }}<br>BADAN PENGURUS HARIAN SINODE GKKD
        </p>


        <div style="padding: 12px;display: flex; flex-direction: row; justify-content: center">
            @foreach ($pengaturan_surat_tugas->detail_ttd as $key => $item)
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
                <td>
                    {!! $pengaturan_surat_tugas->tembusan->tembusan_text !!}
                </td>
            </tr>
        </table>
        <br>
        <footer>
            {!! $pengaturan_surat_tugas->footer->footer !!}
        </footer>
    </main>
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
