@extends('template-surat.template-export-surat')

@section('header')
    @php
    S3Helper::saveAs($request_surat->master_surat->kop->logo, $request_surat->master_surat->kop->logo);
    @endphp
    <div style='display: flex; flex-direction: row; align-items: center; justify-content: center'>
        <img style='padding: 0 20px;object-fit:contain;' align='left'
            src='{{ public_path('storage/' . $request_surat->master_surat->kop->logo) }}' width='120px' height='120px'>
        <div style='text-align: center;padding: 0 40px;flex:1;'>
            <b><br>
                <font size='4' color='#6D0863'>{{ $request_surat->master_surat->kop->title }}</font>
                <br>
            </b>
            <div style='line-height:1;color:#6D0863'>{{ $request_surat->master_surat->kop->deskripsi }}</div>
        </div>
    </div>
    {{-- {!! $request_surat->master_surat->kop->headerdescription !!} --}}
@endsection

@section('footer')
    {!! $request_surat->master_surat->footer->footer !!}
@endsection

@section('tujuan')
    {{ $request_surat->nama_diajukan }}
@endsection

@section('no_surat') {!! $request_surat->no_surat !!} @endsection

@section('perihal') {!! $request_surat->perihal !!} @endsection

@section('body')
    @foreach ($request_surat->master_surat->detail_body as $item)
        @if ((int) $item->is_input_user == 1)
            <table style='margin-left:50px'>
                @if ($request_surat->nama_diajukan)
                    <tr>
                        <td>Nama</td>
                        <td style="padding: 0 10px">:</td>
                        <td>{{ $request_surat->nama_diajukan }}</td>
                    </tr>
                @endif
                @if ($request_surat->tempat_lahir_diajukan && $request_surat->tanggal_lahir_diajukan)
                    <tr>
                        <td>TTL</td>
                        <td style="padding: 0 10px">:</td>
                        <td>{{ $request_surat->tempat_lahir_diajukan }} {{ $request_surat->tanggal_lahir_diajukan }}
                        </td>
                    </tr>
                @endif
                @if ($request_surat->alamat_diajukan)
                    <tr>
                        <td>Alamat</td>
                        <td style="padding: 0 10px">:</td>
                        <td>{{ $request_surat->alamat_diajukan }}</td>
                    </tr>
                @endif
                @if ($request_surat->no_telp_diajukan)
                    <tr>
                        <td>No Telp</td>
                        <td style="padding: 0 10px">:</td>
                        <td>{{ $request_surat->no_telp_diajukan }}</td>
                    </tr>
                @endif
                @if ($request_surat->email_diajukan)
                    <tr>
                        <td>Email</td>
                        <td style="padding: 0 10px">:</td>
                        <td>{{ $request_surat->email_diajukan }}</td>
                    </tr>
                @endif
            </table>
        @else
            {!! $item->template_body->html_body !!}
        @endif
    @endforeach
@endsection

@section('tanda_tangan')
    @php
    $jumlah_ttd = count($request_surat->master_surat->detail_ttd);
    $break_ttd = 0;
    if ($request_surat->lfk_status_surat_id == 2) {
        $break_ttd = 1;
    } elseif ($request_surat->lfk_status_surat_id == 3) {
        $break_ttd = 2;
    } elseif ($request_surat->lfk_status_surat_id == 4) {
        $break_ttd = 3;
    } elseif ($request_surat->lfk_status_surat_id == 6) {
        $break_ttd = 100;
    }
    @endphp
    <tr style="text-align: center">
        @foreach ($request_surat->master_surat->detail_ttd as $key => $item)
            @php
                S3Helper::saveAs($item->ttd->ttd, $item->ttd->ttd);
            @endphp
            {{-- {{ dd($item) }} --}}
            <td style="text-align: center;padding-right: 50px">
                @if ($key + 1 < $break_ttd)
                    <img style='padding: 8px;object-fit:contain;' src='{{ public_path('storage/' . $item->ttd->ttd) }}'
                        height='120px'><br>
                @else
                    <div style="height: 120px"></div>
                @endif
                <span><b>{!! @$item->ttd->jabatan_ttd !!}</b><br>{!! @$item->ttd->user->nama !!}</span>
            </td>
        @endforeach
    </tr>
@endsection

@section('tembusan')
    {!! $request_surat->master_surat->tembusan->tembusan_text !!}
@endsection
