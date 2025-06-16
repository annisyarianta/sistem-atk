<?php

namespace App\Exports;

use App\Models\AtkKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AtkKeluarExport implements FromCollection, WithHeadings
{
    protected $awal, $akhir, $id_unit;

    public function __construct($awal, $akhir, $id_unit = null)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
        $this->id_unit = $id_unit;
    }

    public function collection()
    {
        $query = AtkKeluar::with(['masterAtk', 'unit'])
            ->whereBetween('tanggal_keluar', [$this->awal, $this->akhir]);

        if ($this->id_unit) {
            $query->where('id_unit', $this->id_unit);
        }

        return $query->get()->map(function ($item) {
            return [
                $item->masterAtk->nama_atk ?? '-',
                $item->jumlah_keluar,
                $item->tanggal_keluar,
                $item->unit->nama_unit ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama ATK', 'Jumlah Keluar', 'Tanggal Keluar', 'Unit'];
    }
}
