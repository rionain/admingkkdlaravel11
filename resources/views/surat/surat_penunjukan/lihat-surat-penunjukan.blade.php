@extends('surat.surat_penunjukan.template-surat-penunjukan')

@section('header')
    {!! $surat_penunjukan->pengaturan_surat_penunjukan->kop->headerdescription ?? 'HEADER_NOT_SET' !!}
@endsection
@section('nomor_surat')
    {{ $surat_penunjukan->nomor_surat ?: '__________' }}
@endsection

@section('pembukaan')
    {!! $surat_penunjukan->pengaturan_surat_penunjukan->pembukaan ?? '' !!}
@endsection
@section('nama_gereja')
    {!! $surat_penunjukan->nama_gereja !!}
@endsection
@section('alamat_lengkap_gereja')
    {!! $surat_penunjukan->alamat_lengkap_gereja !!}
@endsection
@section('nama_ketua')
    {!! $surat_penunjukan->nama_ketua !!}
@endsection
@section('tempat_lahir_ketua')
    {!! $surat_penunjukan->tempat_lahir_ketua !!}
@endsection
@section('tanggal_lahir_ketua')
    {!! $surat_penunjukan->tanggal_lahir_ketua !!}
@endsection
@section('alamat_ketua')
    {!! $surat_penunjukan->alamat_ketua !!}
@endsection
@section('nama_sekretaris')
    {!! $surat_penunjukan->nama_sekretaris !!}
@endsection
@section('tempat_lahir_sekretaris')
    {!! $surat_penunjukan->tempat_lahir_sekretaris !!}
@endsection
@section('tanggal_lahir_sekretaris')
    {!! $surat_penunjukan->tanggal_lahir_sekretaris !!}
@endsection
@section('alamat_sekretaris')
    {!! $surat_penunjukan->alamat_sekretaris !!}
@endsection
@section('nama_bendahara')
    {!! $surat_penunjukan->nama_bendahara !!}
@endsection
@section('tempat_lahir_bendahara')
    {!! $surat_penunjukan->tempat_lahir_bendahara !!}
@endsection
@section('tanggal_lahir_bendahara')
    {!! $surat_penunjukan->tanggal_lahir_bendahara !!}
@endsection
@section('alamat_bendahara')
    {!! $surat_penunjukan->alamat_bendahara !!}
@endsection
@section('penutupan')
    {!! $surat_penunjukan->pengaturan_surat_penunjukan->penutupan ?? '' !!}
@endsection
@section('tempat_penunjukan')
    {{ ucfirst($surat_penunjukan->tempat_penunjukan) }}
@endsection
@section('tanggal_penunjukan')
    {{ $surat_penunjukan->tanggal_penunjukan }}
@endsection



@section('tanda_tangan')
    @php
        $detail_ttd = $surat_penunjukan->pengaturan_surat_penunjukan->detail_ttd ?? [];
        $jumlah_ttd = count($detail_ttd);
        $break_ttd = 0;
        if ($surat_penunjukan->status_surat_id == 2) {
            $break_ttd = 1;
        } elseif ($surat_penunjukan->status_surat_id == 3) {
            $break_ttd = 2;
        } elseif ($surat_penunjukan->status_surat_id == 4) {
            $break_ttd = 3;
        } elseif ($surat_penunjukan->status_surat_id == 6) {
            $break_ttd = 100;
        }
    @endphp
    @foreach ($detail_ttd as $key => $item)
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
    {!! $surat_penunjukan->pengaturan_surat_penunjukan->tembusan->tembusan_text ?? '' !!}
@endsection


@section('footer')
    {!! $surat_penunjukan->pengaturan_surat_penunjukan->footer->footer ?? '' !!}
@endsection
