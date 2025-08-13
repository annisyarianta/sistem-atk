<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use App\Models\MasterUnit;
use App\Models\AtkKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Helpers\LogActivityHelper;
use Illuminate\Support\Facades\Auth;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $dataBA = BeritaAcara::with(['atkKeluar.masterAtk', 'unit'])
            ->latest('tanggal_ba', 'desc')
            ->get();

        return view('berita_acara.index', compact('dataBA'));
    }

    public function create()
    {
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
            'referensi' => 'required|string|max:100|unique:berita_acara,referensi',
            'id_unit' => 'required|exists:master_unit,id_unit',
            'tanggal_keluar' => 'required|date',
            'diketahui' => 'required|string|max:255',
            'menyetujui' => 'required|in:Rahaditya Saputra,Dian Hardiansah',
            'penerima' => 'required|string|max:255',
            'jabatan_penerima' => 'required|string|max:255',
            'kode_barcode' => 'nullable|string|max:100',
            'lampiran.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'referensi.unique' => 'No. Nota Dinas sudah pernah digunakan, harap gunakan yang lain.',
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
            'menyetujui' => $request->menyetujui,
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

        LogActivityHelper::add(
            'tambah',
            'Berita Acara',
            'User dengan ID ' . Auth::id() . ' menambah data Berita Acara dengan ID ' . $beritaAcara->getKey()
        );

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
        $beritaAcara = BeritaAcara::findOrFail($id);
        $request->validate([
            'tanggal_ba' => 'required|date',
            'referensi' => 'required|string|max:100|unique:berita_acara,referensi,' . $id . ',id_ba',
            'diketahui' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'menyetujui' => 'required|in:Rahaditya Saputra,Dian Hardiansah',
            'jabatan_penerima' => 'required|string|max:255',
            'kode_barcode' => 'nullable|string|max:100',
            'lampiran.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'referensi.unique' => 'No. Nota Dinas sudah pernah digunakan, harap gunakan yang lain.',
        ]);

        $data = $request->only([
            'tanggal_ba',
            'referensi',
            'diketahui',
            'menyetujui',
            'penerima',
            'jabatan_penerima',
            'kode_barcode',
        ]);

        $lampiranBaru = [];
        if ($request->hasFile('lampiran')) {
            if (is_array($beritaAcara->lampiran)) {
                foreach ($beritaAcara->lampiran as $lama) {
                    $path = public_path('uploads/lampiran/' . $lama);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/lampiran'), $filename);
                $lampiranBaru[] = $filename;
            }

            $data['lampiran'] = $lampiranBaru;
        }

        $beritaAcara->update($data);

        LogActivityHelper::add(
            'edit',
            'Berita Acara',
            'User dengan ID ' . Auth::id() . ' mengedit data Berita Acara dengan ID ' . $beritaAcara->getKey()
        );

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
