<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtkMasuk;
use App\Models\AtkKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AtkMasukExport;
use App\Exports\AtkKeluarExport;

class CetakLaporanController extends Controller
{
    public function index()
    {
        return view('cetak_laporan.index');
    }

    public function download(Request $request)
    {
        $request->validate([
            'jenis_laporan' => 'required|in:atkmasuk,atkkeluar',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'format' => 'required|in:pdf,excel',
            'id_unit' => 'nullable|exists:master_unit,id_unit',
        ]);

        $jenis = $request->jenis_laporan;
        $awal = $request->tanggal_awal;
        $akhir = $request->tanggal_akhir;
        $format = $request->format;
        $id_unit = $request->id_unit;

        if ($jenis == 'atkmasuk') {
            $data = AtkMasuk::with('masterAtk')
                ->whereBetween('tanggal_masuk', [$awal, $akhir])->orderBy('tanggal_masuk', 'desc')->get();
        } else {
            $query = AtkKeluar::with(['masterAtk', 'unit'])
                ->whereBetween('tanggal_keluar', [$awal, $akhir]);

            if ($request->filled('id_unit')) {
                $query->where('id_unit', $request->id_unit);
            }

            $data = $query->orderBy('tanggal_keluar', 'desc')->get();
        }

        if ($format == 'pdf') {
            $view = $jenis == 'atkmasuk' ? 'cetak_laporan.masukpdf' : 'cetak_laporan.keluarpdf';
            return PDF::loadView($view, compact('data', 'awal', 'akhir', 'id_unit'))->download("laporan-{$jenis}-{$awal}-{$akhir}.pdf");
        } else {
            $export = $jenis == 'atkmasuk'
                ? new AtkMasukExport($awal, $akhir)
                : new AtkKeluarExport($awal, $akhir, $id_unit);

            return Excel::download($export, "laporan-{$jenis}-{$awal}-{$akhir}.xlsx");
        }
    }
}
