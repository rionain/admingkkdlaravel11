@extends('surat.surat_tugas.template-surat-tugas')

@section('header')
    {!! $surat_tugas->pengaturan_surat_tugas->kop->headerdescription !!}
@endsection
@section('nomor_surat')
    {{ $surat_tugas->nomor_surat ?: '__________' }}
@endsection

@section('tugas')
    {!! $surat_tugas->tugas !!}
@endsection
@section('tanggal_tugas')
    {!! tanggal_indonesia(format_date($surat_tugas->tanggal_tugas)) !!}
@endsection
@section('tempat_tugas')
    {!! $surat_tugas->tempat_tugas !!}
@endsection
@section('petugas')
    {!! $surat_tugas->petugas !!}
@endsection
@section('tanggal_surat')
    {!! $surat_tugas->tanggal_surat !!}
@endsection
@section('tempat_surat')
    {!! $surat_tugas->tempat_surat !!}
@endsection
@section('tempat_penetapan')
    {{ ucfirst($surat_tugas->tempat_penetapan) }}
@endsection
@section('tanggal_penetapan')
    {{ $surat_tugas->tanggal_penetapan }}
@endsection



@section('tanda_tangan')
    @php
        $jumlah_ttd = count($surat_tugas->pengaturan_surat_tugas->detail_ttd);
        $break_ttd = 0;
        if ($surat_tugas->status_surat_id == 2) {
            $break_ttd = 1;
        } elseif ($surat_tugas->status_surat_id == 3) {
            $break_ttd = 2;
        } elseif ($surat_tugas->status_surat_id == 4) {
            $break_ttd = 3;
        } elseif ($surat_tugas->status_surat_id == 6) {
            $break_ttd = 100;
        }
    @endphp
    @foreach ($surat_tugas->pengaturan_surat_tugas->detail_ttd as $key => $item)
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
    {!! $surat_tugas->pengaturan_surat_tugas->tembusan->tembusan_text !!}
@endsection


@section('footer')
    {!! $surat_tugas->pengaturan_surat_tugas->footer->footer !!}
@endsection
