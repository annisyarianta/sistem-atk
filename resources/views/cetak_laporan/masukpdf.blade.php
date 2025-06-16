<!DOCTYPE html>
<html>
<head>
    <title>Laporan ATK Masuk</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <h3>Laporan ATK Masuk</h3>
    <p>Periode: {{ $awal }} - {{ $akhir }}</p>
    <table>
        <thead>
            <tr>
                <th>Nama ATK</th>
                <th>Jumlah Masuk</th>
                <th>Tanggal Masuk</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row->masterAtk->nama_atk }}</td>
                <td>{{ $row->jumlah_masuk }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('d/m/Y') }}</td>
                <td>{{ number_format($row->harga_satuan) }}</td>
                <td>{{ number_format($row->harga_total) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>