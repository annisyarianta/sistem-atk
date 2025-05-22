<?php

namespace App\Http\Controllers;

use App\Models\MasterUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterUnitController extends Controller
{
    public function index()
    {
        $units = MasterUnit::all();
        return view('master_unit.index', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_unit' => 'required|string|max:100|unique:master_unit,nama_unit',
        ], [
            'nama_unit.unique' => 'Nama unit sudah ada, harap gunakan yang lain.',
        ]);

        MasterUnit::create($validated);

        return redirect()->route('master-unit.index')->with('success', 'Data Unit berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $unit = MasterUnit::findOrFail($id);
        return view('master_unit.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $unit = MasterUnit::findOrFail($id);

        $validated = $request->validate([
            'nama_unit' => 'required|string|max:100|unique:master_unit,nama_unit,' . $unit->id_unit . ',id_unit',
        ], [
            'nama_unit.unique' => 'Nama unit sudah ada, harap gunakan yang lain.',
        ]);

        $unit->update($validated);

        return redirect()->route('master-unit.index')->with('success', 'Data Unit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $unit = MasterUnit::findOrFail($id);

        if (
            $unit->users()->exists() ||
            $unit->atkKeluar()->exists() ||
            $unit->beritaAcara()->exists()
        ) {

            return back()->with(
                'used_error',
                'Data Unit tidak dapat dihapus karena masih digunakan.'
            );
        }

        $unit->delete();

        return redirect()->route('master-unit.index')->with('success', 'Data Unit berhasil dihapus.');
    }
}
