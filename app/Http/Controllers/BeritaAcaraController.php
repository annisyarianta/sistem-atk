<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use App\Models\MasterUnit;
use App\Models\AtkKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $dataBA = BeritaAcara::with(['atkKeluar.masterAtk', 'unit'])
            ->latest('tanggal_ba', 'desc')
            ->get();
        // $masterAtk = MasterAtk::orderBy('nama_atk')->get();
        // $masterUnit = MasterUnit::orderBy('nama_unit')->get();

        return view('berita_acara.index', compact('dataBA'));
    }

    public function create()
    {
        // $keluar = AtkKeluar::all();
        $unit = MasterUnit::whereIn('id_unit', function ($query) {
            $query->select('id_unit')->from('atkkeluar')->distinct();
        })->get();

        return view('berita_acara.create', [
            'masterUnit' => $unit
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_ba' => 'required|date',
            'referensi' => 'required|string|max:100',
            'id_unit' => 'required|exists:master_unit,id_unit',
            'tanggal_keluar' => 'required|date',
            'diketahui' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'jabatan_penerima' => 'required|string|max:255',
            'kode_barcode' => 'required|string|max:100',
            'lampiran.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $atkKeluarList = AtkKeluar::where('id_unit', $request->id_unit)
            ->where('tanggal_keluar', $request->tanggal_keluar)
            ->whereNull('id_ba')
            ->get();

        if ($atkKeluarList->isEmpty()) {
            return back()->withInput()->with('error', 'Tidak ada data ATK keluar pada periode tersebut.');
        }

        $lampiranFilenames = [];

        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/lampiran'), $filename);
                $lampiranFilenames[] = $filename;
            }
        }

        $beritaAcara = BeritaAcara::create([
            'tanggal_ba' => $request->tanggal_ba,
            'referensi' => $request->referensi,
            'id_unit' => $request->id_unit,
            'tanggal_keluar' => $request->tanggal_keluar,
            'diketahui' => $request->diketahui,
            'penerima' => $request->penerima,
            'jabatan_penerima' => $request->jabatan_penerima,
            'kode_barcode' => $request->kode_barcode,
            'lampiran' => $lampiranFilenames,
        ]);

        foreach ($atkKeluarList as $atk) {
            $atk->id_ba = $beritaAcara->id_ba;
            $atk->save();
        }

        $pdf = Pdf::loadView('berita_acara.pdf', ['beritaAcara' => $beritaAcara->load(['unit', 'atkKeluar'])]);

        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil ditambahkan.');
    }

    public function downloadPdf($id)
    {
        $beritaAcara = BeritaAcara::with(['unit', 'atkKeluar'])->findOrFail($id);
        $pdf = Pdf::loadView('berita_acara.pdf', compact('beritaAcara'));
        $filename = 'berita_acara_' . Str::slug($beritaAcara->referensi) . '.pdf';
        return $pdf->download($filename);
    }

    public function edit($id)
    {
        $beritaAcara = BeritaAcara::findOrFail($id);
        $units = MasterUnit::all();
        $keluar = AtkKeluar::all();
        return view('berita_acara.edit', compact('beritaAcara', 'units', 'keluar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_ba' => 'required|date',
            'referensi' => 'required|string|max:100',
            'diketahui' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'jabatan_penerima' => 'required|string|max:255',
            'kode_barcode' => 'required|string|max:100',
            // 'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $beritaAcara = BeritaAcara::findOrFail($id);
        $beritaAcara->update($request->only([
            'tanggal_ba',
            'referensi',
            'diketahui',
            'penerima',
            'jabatan_penerima',
            'kode_barcode',
            'lampiran'
        ]));

        return redirect()->route('berita-acara.index')->with('success', 'Data Berita Acara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BeritaAcara $beritaAcara)
    {
        //
    }
}
