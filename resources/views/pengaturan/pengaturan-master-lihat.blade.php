@extends('template-surat.template-surat')

@section('header')
    {!! $master_surat->kop->headerdescription !!}
@endsection

@section('footer')
    {!! $master_surat->footer->footer !!}
@endsection

@section('no_surat')
    No Surat
@endsection

@section('perihal')
    Perihal
@endsection

@section('body')
    @foreach ($master_surat->detail_body as $item)
        @if ((int) $item->is_input_user == 1)
            <br>
            <table style='margin-left:50px'>
                <tr>
                    <td>Nama</td>
                    <td style="padding: 0 10px">:</td>
                    <td>Mohamad Alfin Nahrowi</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td style="padding: 0 10px">:</td>
                    <td>Jr. Cikapayang No. 632, Padang</td>
                </tr>
            </table>
            <br>
        @else
            {!! $item->template_body->html_body !!}
        @endif
    @endforeach
@endsection

@section('tanda_tangan')
    @foreach ($master_surat->detail_ttd as $item)
        <div style="flex: 1; text-align: center">
            <img style='padding: 8px;object-fit:contain;' src='{{ S3Helper::get($item->ttd->ttd) }}' height='120px'><br>
            <span><b>{!! $item->ttd->jabatan_ttd !!}</b><br>{!! @$item->ttd->user->nama !!}</span>
        </div>
    @endforeach
@endsection

@section('tembusan')
    {!! $master_surat->tembusan->tembusan_text !!}
@endsection
