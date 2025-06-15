<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        .ttd {
            margin-top: 50px;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    {{-- Halaman Berita Acara --}}
    <h3 align="center">BERITA ACARA<br>
        PENGELUARAN BARANG ALAT TULIS KANTOR (ATK)<br>
        UNIT {{ $beritaAcara->unit->nama_unit }}</h3>

    <p>Dengan ini dinyatakan penerimaan Barang Alat Tulis Kantor (ATK) tersebut di bawah ini:</p>

    <table class="table">
        <thead>
            <tr>
                <th><strong>Tanggal Penerimaan</strong></th>
                <th><strong>Dari</strong></th>
                <th><strong>Referensi</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ \Carbon\Carbon::parse($beritaAcara->tanggal_ba)->format('d/m/Y') }}</td>
                <td>{{ $beritaAcara->jabatan_penerima }}</td>
                <td>{{ $beritaAcara->referensi }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>NO.</th>
                <th>KODE ATK</th>
                <th>NAMA ATK</th>
                <th>VOLUME/SATUAN</th>
                <th>KETERANGAN</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beritaAcara->atkKeluar as $index => $atk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $atk->masterAtk->kode_atk ?? '-' }}</td>
                    <td>{{ $atk->masterAtk->nama_atk ?? '-' }}</td>
                    <td>{{ $atk->jumlah_keluar ?? '-' }}</td>
                    <td>{{ $beritaAcara->kode_barcode }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <table style="width:100%; margin-top: 30px;">
            <tr>
                <td align="center">
                    <b>
                        Diketahui :<br>Airport Administration Department Head<br><br><br><br>
                        {{ $beritaAcara->diketahui }}
                    </b>
                </td>
                <td align="center">
                    <b>
                        Telah Diterima Oleh :<br>{{ $beritaAcara->jabatan_penerima }}<br><br><br><br>
                        {{ $beritaAcara->penerima }}
                    </b>
                </td>
            </tr>
        </table>
    </div>

    {{-- Halaman baru untuk lampiran --}}
    <div class="page-break"></div>

    <h3 align="center">DOKUMENTASI PENGELUARAN BARANG ALAT TULIS KANTOR<br>UNIT {{ $beritaAcara->unit->nama_unit }}
    </h3>
    <div style="text-align:center; margin-top: 40px;">
        {{-- <img src="{{ public_path('uploads/lampiran/' . $lampiran) }}" width="400px"> --}}
    </div>

</body>

</html>
