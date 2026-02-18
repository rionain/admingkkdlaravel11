<table>
    <thead>
        <tr>
            <th>No</th>
            <th>KATEGORI GEREJA</th>
            <th>GEREJA</th>
            <th>KOMSEL</th>
            <th>TANGGAL KOMSEL</th>
            <th>JUMLAH PRIA</th>
            <th>JUMLAH WANITA</th>
            <th>JUMLAH PRIA BARU</th>
            <th>JUMLAH WANITA BARU</th>
            <th>CATATAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ @$value->komsel->cabang->kategori_gereja->kategori_gereja }}</td>
                <td>{{ @$value->komsel->cabang->nama_cabang }}</td>
                <td>{{ @$value->komsel->nama_komsel }}</td>
                <td>{{ $value->komsel_date }}</td>
                <td>{{ $value->jumlah_pria }}</td>
                <td>{{ $value->jumlah_wanita }}</td>
                <td>{{ $value->jumlah_pria_baru }}</td>
                <td>{{ $value->jumlah_wanita_baru }}</td>
                <td>{{ $value->catatan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
