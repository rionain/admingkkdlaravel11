@extends('surat.surat_keputusan.template-surat-keputusan')

@section('header')
    {!! $request_surat->pengaturan_surat_keputusan->kop->headerdescription !!}
@endsection
@section('nomor_surat')
    {{ $request_surat->nomor_surat ?: '__________' }}
@endsection
@section('jabatan')
    {{ $request_surat->jabatan ?: '__________' }}
@endsection

@section('pembukaan')
    {!! $request_surat->pengaturan_surat_keputusan->pembukaan !!}
@endsection
@section('nama_gereja')
    {!! $request_surat->nama_gereja !!}
@endsection
@section('tanggal_persetujuan')
    {{ tanggal_indonesia(format_date($request_surat->tanggal_persetujuan)) }}
@endsection
@section('nama_lengkap')
    {!! $request_surat->nama_lengkap !!}
@endsection
@section('tempat_lahir')
    {!! $request_surat->tempat_lahir !!}
@endsection
@section('tanggal_lahir')
    {{ tanggal_indonesia(format_date($request_surat->tanggal_lahir)) }}
@endsection

@section('penutupan')
    {!! $request_surat->pengaturan_surat_keputusan->penutupan !!}
@endsection
@section('tempat_penetapan')
    {{ ucfirst($request_surat->tempat_penetapan) }}
@endsection
@section('tanggal_penetapan')
    {{ tanggal_indonesia(format_date($request_surat->tanggal_penetapan)) }}
@endsection



@section('tanda_tangan')
    @php
        $jumlah_ttd = count($request_surat->pengaturan_surat_keputusan->detail_ttd);
        $break_ttd = 0;
        if ($request_surat->status_surat_id == 2) {
            $break_ttd = 1;
        } elseif ($request_surat->status_surat_id == 3) {
            $break_ttd = 2;
        } elseif ($request_surat->status_surat_id == 4) {
            $break_ttd = 3;
        } elseif ($request_surat->status_surat_id == 6) {
            $break_ttd = 100;
        }
    @endphp
    @foreach ($request_surat->pengaturan_surat_keputusan->detail_ttd as $key => $item)
        <div style="flex: 1; text-align: center">
            @if ($key + 1 < $break_ttd)
                <img style='padding: 8px;object-fit:contain;' src='{{ S3Helper::get(@$item->ttd->ttd) }}' height='80px'><br>
            @else
                <div style="height: 80px"></div>
            @endif
            <span><b>{!! @$item->ttd->jabatan_ttd !!}</b><br>{!! @$item->ttd->user->nama !!}</span>
        </div>
    @endforeach
@endsection


@section('tembusan')
    {!! $request_surat->pengaturan_surat_keputusan->tembusan->tembusan_text !!}
@endsection


@section('footer')
    {!! $request_surat->pengaturan_surat_keputusan->footer->footer !!}
@endsection
