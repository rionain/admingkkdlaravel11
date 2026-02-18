@extends('emails.template')
@section('title')
    Pemberitahuan event
@endsection
@section('content')
    <style>
        #tabel {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #tabel td,
        #tabel th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #tabel tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #tabel tr:hover {
            background-color: #ddd;
        }

        #tabel th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

    </style>
    <h2 style="text-align: center">Pemberitahuan event</h2>
    <div style="">
        <table id="tabel">
            <tr>
                <th width="20%">Nama event</th>
                <td>{{ $event->nama_event }}</td>
            </tr>
            <tr>
                <th width="20%">Tanggal event</th>
                <td>
                    @if ($event->tanggal_event_mulai === $event->tanggal_event_selesai)
                        {{ tanggal_indonesia($event->tanggal_event_mulai) }}
                    @else
                        {{ tanggal_indonesia($event->tanggal_event_mulai) }} -
                        {{ tanggal_indonesia($event->tanggal_event_selesai) }}
                    @endif
                </td>
            </tr>
            <tr>
                <th width="20%">Jam</th>
                <td>{{ format_date($event->jam_event_mulai, 'H:i') }} -
                    {{ format_date($event->jam_event_selesai, 'H:i') }}
                </td>
            </tr>
            <tr>
                <th width="20%">Catatan</th>
                <td>{{ $event->catatan }}</td>
            </tr>
            <tr>
                <th width="20%">Cabang</th>
                <td>{{ $event->cabang->nama_cabang }}</td>
            </tr>
        </table>

    </div>
    <br>
    <p style="text-align: justify">
        E-mail ini dibuat otomatis, mohon tidak membalas. Jika butuh bantuan, silakan hubungi sinode
        Care.
    </p>
@endsection
