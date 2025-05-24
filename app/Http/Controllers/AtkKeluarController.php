<?php

namespace App\Http\Controllers;

use App\Models\AtkKeluar;
use App\Models\MasterAtk;
use App\Models\MasterUnit;
use Illuminate\Http\Request;
use App\Helpers\LogActivityHelper;
use Illuminate\Support\Facades\Auth;

class AtkKeluarController extends Controller
{
    public function index()
    {
        $dataKeluar = AtkKeluar::with(['masterAtk', 'unit'])
            ->latest('tanggal_keluar')
            ->get();
        $masterAtk = MasterAtk::orderBy('nama_atk')->get();
        $masterUnit = MasterUnit::orderBy('nama_unit')->get();

        return view('atk_keluar.index', compact('dataKeluar', 'masterAtk', 'masterUnit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_atk'        => 'required|exists:master_atk,id_atk',
            'jumlah_keluar' => 'required|integer',
            'tanggal_keluar' => 'required|date',
            'id_unit'       => 'required|exists:master_unit,id_unit',
        ]);

        $atkKeluar = AtkKeluar::create($validated);

        LogActivityHelper::add(
            'tambah',
            'ATK Keluar',
            'User dengan ID ' . Auth::id() . ' menambah data ATK Keluar dengan ID ' . $atkKeluar->getKey()
        );

        return redirect()->route('atk-keluar.index')->with('success', 'Data ATK Keluar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $atkKeluar = AtkKeluar::findOrFail($id);
        $masterAtk  = MasterAtk::orderBy('nama_atk')->get();
        $masterUnit  = MasterUnit::orderBy('nama_unit')->get();

        return view('atk_keluar.edit', compact('atkKeluar', 'masterAtk', 'masterUnit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_atk'        => 'required|exists:master_atk,id_atk',
            'jumlah_keluar' => 'required|integer',
            'tanggal_keluar' => 'required|date',
            'id_unit'       => 'required|exists:master_unit,id_unit',
        ]);

        $atkKeluar = AtkKeluar::findOrFail($id);
        $atkKeluar->update($validated);

        LogActivityHelper::add(
            'edit',
            'ATK Keluar',
            'User dengan ID ' . Auth::id() . ' mengedit data ATK Keluar dengan ID ' . $atkKeluar->getKey()
        );

        return redirect()->route('atk-keluar.index')->with('success', 'Data ATK Keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $atkKeluar = AtkKeluar::findOrFail($id);
        $atkKeluar->delete();

        LogActivityHelper::add(
            'hapus',
            'ATK Keluar',
            'User dengan ID ' . Auth::id() . ' menghapus data ATK Keluar dengan ID ' . $atkKeluar->getKey()
        );

        return redirect()->route('atk-keluar.index')->with('success', 'Data ATK keluar berhasil dihapus.');
    }
}
