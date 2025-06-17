<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-size: 15px;
        }
        table {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            width: 100%;
            word-wrap: break-word;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            white-space: normal;
            overflow-wrap: break-word;
            word-break: break-word;
            padding: 6px;
        }

        th {
            text-align: center;
        }

        td {
            text-align: center;
        }

        .biru {
            background-color: cornflowerblue;
        }

        .abu {
            background-color: grey;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center; margin-bottom: 0;">LAPORAN ATK MASUK</h2>
    @php
        use Carbon\Carbon;

        $awalFormatted = Carbon::parse($awal)->translatedFormat('j F Y');
        $akhirFormatted = Carbon::parse($akhir)->translatedFormat('j F Y');
    @endphp
    <h3 style="text-align: center; margin-top: 8px; margin-bottom: 25px;">
        Periode : {{ $awalFormatted }} - {{ $akhirFormatted }}
    </h3>

    <table class="tabel">
        <thead>
            <tr class="biru">
                <th style="width: 6%">No.</th>
                <th style="width: 13%">Kode ATK</th>                
                <th style="width: 29%">Nama ATK</th>
                <th style="width: 15%">Tanggal ATK Masuk</th>
                <th style="width: 10%">Jumlah ATK Masuk</th>
                <th style="width: 12%">Harga Satuan</th>
                <th style="width: 15%">Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $row->masterAtk->kode_atk }}</td>
                    <td>{{ $row->masterAtk->nama_atk }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('d/m/Y') }}</td>
                    <td>{{ $row->jumlah_masuk }}</td>
                    <td>{{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->harga_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="grey" style="font-style: italic;">
                <td colspan="6" style="text-align: right;"><b>Grand Total :</b></td>
                <td><b>Rp {{ number_format($data->sum('harga_total'), 0, ',', '.') }}</b></td>
            </tr>
        </tbody>
    </table>
</body>
</html>