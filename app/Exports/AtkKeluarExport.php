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

        $data = $query->orderBy('tanggal_keluar', 'desc')->get();

        return $data->values()->map(function ($item, $index) {
            return [
                $index + 1,
                $item->masterAtk->kode_atk ?? '-',
                $item->masterAtk->nama_atk ?? '-',
                $item->tanggal_keluar,
                $item->jumlah_keluar,
                $item->unit->nama_unit ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['No.', 'Kode ATK', 'Nama ATK', 'Tanggal ATK Keluar', 'Jumlah ATK Keluar', 'Unit'];
    }
}
