<table>
    <thead>
        <tr>
            <th>NO</th>
            <th width="20">KATEGORI GEREJA</th>
            <th width="20">GEREJA</th>
            <th width="20">IBADAH</th>
            <th width="10">TANGGAL</th>
            <th width="20">JUMLAH PRIA</th>
            <th width="20">JUMLAH WANITA</th>
            <th width="20">JUMLAH PRIA BARU</th>
            <th width="20">JUMLAH WANITA BARU</th>
            <th width="10">PERSEMBAHAN</th>
            <th width="10">PENDETA</th>
            <th width="10">PENDETA MUDA</th>
            <th width="10">EVANGELIS</th>
            <th width="20">TEMPAT IBADAH</th>
            <th width="40">CATATAN</th>
            {{-- <th width="20">KAKAK PA</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ @$value->ibadah->cabang->kategori_gereja->kategori_gereja }}</td>
                <td>{{ @$value->ibadah->cabang->nama_cabang }}</td>
                <td>{{ @$value->ibadah->nama_ibadah }}</td>
                <td>{{ $value->tanggal }}</td>
                <td>{{ $value->jumlah_pria }}</td>
                <td>{{ $value->jumlah_wanita }}</td>
                <td>{{ $value->jumlah_pria_baru }}</td>
                <td>{{ $value->jumlah_wanita_baru }}</td>
                <td>{{ $value->persembahan }}</td>
                <td>{{ $value->jumlah_pendeta ?: 0 }}</td>
                <td>{{ $value->jumlah_pendeta_muda ?: 0 }}
                </td>
                <td>{{ $value->jumlah_evangelis ?: 0 }}</td>
                <td>
                    @if ($value->tempat_ibadah == 'P')
                        Permanen
                    @elseif ($value->tempat_ibadah == 'SP')
                        Semi Permanen
                    @elseif ($value->tempat_ibadah == 'K')
                        Kontrak
                    @else
                        Tidak ada
                    @endif
                </td>
                <td>{{ $value->catatan }}</td>
                {{-- <td>{{ @$value->kakak_pa->nama }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
