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
        return AtkMasuk::with('masterAtk')
            ->whereBetween('tanggal_masuk', [$this->awal, $this->akhir])
            ->get()
            ->map(function ($item) {
                return [
                    $item->masterAtk->nama_atk,
                    $item->jumlah_masuk,
                    $item->tanggal_masuk,
                    $item->harga_satuan,
                    $item->harga_total,
                ];
            });
    }

    public function headings(): array
    {
        return ['Nama ATK', 'Jumlah Masuk', 'Tanggal Masuk', 'Harga Satuan', 'Harga Total'];
    }
}