<!DOCTYPE html>
<html>

<head>
    <title>Laporan ATK Keluar</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Laporan ATK Keluar</h3>
    <p>Periode: {{ $awal }} - {{ $akhir }}</p>
    @if ($id_unit)
        <p>Unit: {{ \App\Models\MasterUnit::find($id_unit)->nama_unit ?? '-' }}</p>
    @else
        <p>Unit: Semua Unit</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nama ATK</th>
                <th>Jumlah Keluar</th>
                <th>Tanggal Keluar</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->masterAtk->nama_atk ?? '-' }}</td>
                    <td>{{ $row->jumlah_keluar }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_keluar)->format('d/m/Y') }}</td>
                    <td>{{ $row->unit->nama_unit ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
