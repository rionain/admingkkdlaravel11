@extends('template-surat.template-surat-3')

@section('header')
    {!! $request_surat->master_surat->kop->headerdescription !!}
@endsection

@section('footer')
    {!! $request_surat->master_surat->footer->footer !!}
@endsection

@section('no_surat')
    {{ $request_surat->no_surat ?: '__________' }}
@endsection

@section('perihal')
    {!! $request_surat->perihal !!}
@endsection

@section('tujuan')
    {!! $request_surat->nama_diajukan !!}
@endsection

@section('body')
    @foreach ($request_surat->master_surat->detail_body as $item)
        @if ((int) $item->is_input_user == 1)
            <br>
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
            <br>
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
    @foreach ($request_surat->master_surat->detail_ttd as $key => $item)
        {{-- {{ dd($item) }} --}}
        <div style="flex: 1; text-align: center">
            @if ($key + 1 < $break_ttd)
                <img style='padding: 8px;object-fit:contain;' src='{{ S3Helper::get(@$item->ttd->ttd) }}' height='120px'><br>
            @else
                <div style="height: 120px"></div>
            @endif
            <span><b>{!! @$item->ttd->jabatan_ttd !!}</b><br>{!! @$item->ttd->user->nama !!}</span>
        </div>
    @endforeach
@endsection

@section('tembusan')
    {!! $request_surat->master_surat->tembusan->tembusan_text !!}
@endsection
