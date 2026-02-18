<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Catatan</th>
            <th>Kelompok PA</th>
            <th>Pembimbing PA</th>
            <th>Bahan PA</th>
            <th>BAB PA</th>
            <th>Cabang</th>
            <th>Anak PA</th>
            <th>Kehadiran</th>
            {{-- <th>Selesai</th> --}}
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ @$value->permuridan->catatan }}</td>
                <td>{{ @$value->permuridan->kelompok_pa->nama_kelompok }}</td>
                <td>{{ @$value->permuridan->kelompok_pa->kakak_pa->nama }}</td>
                <td>{{ @$value->permuridan->bahan_pa->judul }}</td>
                <td>{{ @$value->permuridan->bab_pa->bab_pa_name }}</td>
                <td>{{ @$value->permuridan->cabang->nama_cabang }}</td>
                <td>{{ @$value->anak_pa->nama }}</td>
                <td>
                    @if ($value->flag_hadir)
                        Hadir
                    @else
                        Tidak Hadir
                    @endif
                </td>
                {{-- <td>
                    @if ($value->flag_lulus)
                        Selesai
                    @else
                        Belum Selesai
                    @endif
                </td> --}}
                <td>
                    {{ format_date($value->permuridan->created_date, 'D, d F Y') }}</td>
                <td>
            </tr>
        @endforeach
    </tbody>
</table>
