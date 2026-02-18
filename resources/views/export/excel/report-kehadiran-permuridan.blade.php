<table>
    <thead>
        <tr>
            <th>No</th>
            <th>CATATAN</th>
            <th>KELOMPOK PA</th>
            <th>PEMBIMBING PA</th>
            <th>BAHAN PA</th>
            <th>BAB PA</th>
            <th>KATEGORI GEREJA</th>
            <th>GEREJA</th>
            <th>ANAK PA</th>
            <th>KEHADIRAN</th>
            <th>TANGGAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key_permuridan => $value_permuridan)
            @foreach ($value_permuridan->permuridan_detail as $key_permuridan_detail => $value_permuridan_detail)

                <tr>
                    <td>{{ ++$key_permuridan + $key_permuridan_detail }}</td>
                    <td>{{ $value_permuridan->catatan }}</td>
                    <td>{{ @$value_permuridan->kelompok_pa->nama_kelompok }}</td>
                    <td>{{ @$value_permuridan->kelompok_pa->kakak_pa->nama }}</td>
                    <td>{{ @$value_permuridan->bahan_pa->judul }}</td>
                    <td>{{ @$value_permuridan->bab_pa->bab_pa_name }}</td>
                    <td>{{ @$value_permuridan->cabang->kategori_gereja->kategori_gereja }}</td>
                    <td>{{ @$value_permuridan->cabang->nama_cabang }}</td>
                    <td>{{ @$value_permuridan_detail->anak_pa->nama }}</td>
                    <td>
                        @if ($value_permuridan_detail->flag_hadir == '1')
                            <span class="badge badge-success">Hadir</span>
                        @elseif ($value_permuridan_detail->flag_hadir === "0")
                            <span class="badge badge-danger">Tidak Hadir</span>
                        @else
                            <span class="badge badge-warning"></span>
                        @endif
                    </td>
                    {{-- <td>
                        @if ($value_permuridan_detail->flag_lulus === '1')
                            <span class="badge badge-success">Selesai</span>
                        @elseif ($value_permuridan_detail->flag_lulus == "0")
                            <span class="badge badge-danger">Belum Selesai</span>
                        @else
                            <span class="badge badge-warning"></span>
                        @endif
                    </td> --}}
                    <td>
                        {{ format_date($value_permuridan->created_date, 'D, d F Y') }}</td>
                    <td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
