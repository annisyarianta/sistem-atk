<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-size: 13px;
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

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center; margin-bottom: 0;">BERITA ACARA</h2>
    <h2 style="text-align: center; width: 100%;  margin-top: 0; margin-bottom: 0;">PENGELUARAN BARANG ALAT TULIS KANTOR
        (ATK)</h2>
    <h2 style="text-align: center; width: 100%;  margin-top: 0; margin-bottom: 8px;">UNIT
        {{ strtoupper($beritaAcara->unit->nama_unit) }}</h2>
    <h2 style="text-align: center; border-bottom: 2px solid black; width: 100%;  margin-top: 0;"></h2>

    <p style="font-size: 15px">Dengan ini dinyatakan penerimaan Barang Alat Tulis Kantor (ATK) tersebut di bawah ini:
    </p>
    <table class="tabel">
        <thead>
            <tr>
                <th style="width: 20%">Tanggal Penerimaan</th>
                <th style="width: 45%">Dari</th>
                <th style="width: 35%">Referensi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ \Carbon\Carbon::parse($beritaAcara->tanggal_ba)->format('d/m/Y') }}</td>
                <td>{{ $beritaAcara->unit->nama_unit }}</td>
                <td>{{ $beritaAcara->referensi }}</td>
            </tr>
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr class="biru">
                <th style="width: 7%">NO.</th>
                <th style="width: 13%">KODE ATK</th>
                <th style="width: 44%">NAMA ATK</th>
                <th style="width: 11%">VOLUME/SATUAN</th>
                <th style="width: 25%">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            <tr class="biru" style="font-style: italic; font-size: 11px;">
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
            </tr>
            @foreach ($beritaAcara->atkKeluar as $index => $ba)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $ba->masterAtk->kode_atk ?? '-' }}</td>
                    <td>{{ $ba->masterAtk->nama_atk ?? '-' }}</td>
                    <td>{{ $ba->jumlah_keluar ?? '-' }} {{ $ba->masterAtk->satuan }}</td>
                    <td>{{ $beritaAcara->kode_barcode }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <table style="border: none">
        <thead>
            <tr>
                <th style="border: none">Diketahui :</th>
                <th style="border: none"></th>
                <th style="border: none">Telah Diterima Oleh :</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-bottom: 80px; border: none"><b>Asst. Manager of <br>Finance & Human Resources</b>
                </td>
                <td style="padding-bottom: 80px; border: none"><b></b></td>
                <td style="padding-bottom: 80px; border: none"><b>{{ $beritaAcara->jabatan_penerima }}</b></td>
            </tr>
            <tr>
                <td style="border: none"><b><u>{{ $beritaAcara->diketahui }}</u></b></td>
                <td style="border: none"><b><u></u></b></td>
                <td style="border: none"><b><u>{{ $beritaAcara->penerima }}</u></b></td>
            </tr>
        </tbody>
    </table>

    {{-- Halaman baru untuk lampiran --}}
    <div class="page-break"></div>

    @if ($beritaAcara->lampiran && is_array($beritaAcara->lampiran))
        @foreach (array_chunk($beritaAcara->lampiran, 4) as $chunk)
            <div
                style="border: 2px solid black; padding: 15px; margin-top: 20px; box-sizing: border-box;">

                <table style="width: 100%; text-align: center; border-collapse: collapse; border: none;">
                    @for ($i = 0; $i < 2; $i++)
                        <tr>
                            @for ($j = 0; $j < 2; $j++)
                                @php
                                    $index = $i * 2 + $j;
                                @endphp
                                <td style="padding: 10px; border: none; vertical-align: top;">
                                    @if (isset($chunk[$index]))
                                        <img src="{{ public_path('uploads/lampiran/' . $chunk[$index]) }}"
                                            style="width: 100%; max-width: 250px; height: auto; border: none;">
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </table>

                <div style="border: 2px solid black; padding: 10px; box-sizing: border-box; margin-top: 25px;">
                    <h3 style="text-align: center; margin: 0; font-size: 18px;">
                        DOKUMENTASI PENGELUARAN BARANG ALAT TULIS KANTOR<br>
                        UNIT {{ strtoupper($beritaAcara->unit->nama_unit) }}
                    </h3>
                </div>

            </div>
        @endforeach
    @endif

</body>

</html>
