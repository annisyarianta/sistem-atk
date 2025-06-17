<?php

namespace App\Exports;

use App\Models\AtkMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AtkMasukExport implements FromCollection, WithHeadings
{
    protected $awal, $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function collection()
    {
        $data = AtkMasuk::with('masterAtk')
            ->whereBetween('tanggal_masuk', [$this->awal, $this->akhir])
            ->get();

        $mapped = $data->map(function ($item, $index) {
            return [
                $index + 1,
                $item->masterAtk->kode_atk,
                $item->masterAtk->nama_atk,
                $item->tanggal_masuk,
                $item->jumlah_masuk,
                $item->harga_satuan,
                $item->harga_total,
            ];
        });

        $grandTotal = $data->sum('harga_total');

        $mapped->push([
            '',
            '',
            '',
            '',
            '',
            'Grand Total',
            $grandTotal,
        ]);

        return $mapped;
    }


    public function headings(): array
    {
        return ['No.', 'Kode ATK', 'Nama ATK', 'Tanggal ATK Masuk', 'Jumlah ATK Masuk', 'Harga Satuan', 'Harga Total'];
    }
}
