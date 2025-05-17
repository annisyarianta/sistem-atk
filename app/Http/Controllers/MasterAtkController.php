<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterAtk;
use Illuminate\Support\Facades\Storage;

class MasterAtkController extends Controller
{
    public function index()
    {
        $data = MasterAtk::all();
        return view('master_atk.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_atk' => 'required|string|max:255',
            'kode_atk' => 'required|string|max:100|unique:master_atk,kode_atk',
            'jenis_atk' => 'required|in:habis_pakai,tidak_habis_pakai',
            'satuan' => 'required|string|max:50',
            'gambar_atk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'kode_atk.unique' => 'Kode ATK sudah ada, harap gunakan yang lain.',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar_atk')) {
            $path = $request->file('gambar_atk')->store('images', 'public');
            $gambar = $path;
        }

        MasterAtk::create([
            'nama_atk' => $request->nama_atk,
            'kode_atk' => $request->kode_atk,
            'jenis_atk' => $request->jenis_atk,
            'satuan' => $request->satuan,
            'gambar_atk' => $gambar,
        ]);

        return redirect('/master-atk')->with('success', 'Data ATK berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $atk = MasterAtk::findOrFail($id);
        return view('master_atk.edit', compact('atk'));
    }

    public function update(Request $request, $id)
    {
        $atk = MasterAtk::findOrFail($id);

        $request->validate([
            'nama_atk' => 'required|string|max:255',
            'kode_atk' => 'required|string|max:100|unique:master_atk,kode_atk,' . $id . ',id_atk',
            'jenis_atk' => 'required|in:habis_pakai,tidak_habis_pakai',
            'satuan' => 'required|string|max:50',
            'gambar_atk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'kode_atk.unique' => 'Kode ATK sudah ada, harap gunakan yang lain.',
        ]);

        if ($request->hasFile('gambar_atk')) {
            if ($atk->gambar_atk && Storage::disk('public')->exists($atk->gambar_atk)) {
                Storage::disk('public')->delete($atk->gambar_atk);
            }

            $path = $request->file('gambar_atk')->store('images', 'public');
            $atk->gambar_atk = $path;
        }

        $atk->nama_atk = $request->nama_atk;
        $atk->kode_atk = $request->kode_atk;
        $atk->jenis_atk = $request->jenis_atk;
        $atk->satuan = $request->satuan;
        $atk->save();

        return redirect('/master-atk')->with('success', 'Data ATK berhasil diperbarui.');
    }

    public function checkUsed($id)
    {
        $digunakanDiMasuk = \App\Models\AtkMasuk::where('id_atk', $id)->exists();
        $digunakanDiKeluar = \App\Models\AtkKeluar::where('id_atk', $id)->exists();
        $digunakanDiRequest = \App\Models\RequestAtk::where('id_atk', $id)->exists();

        $canDelete = !($digunakanDiMasuk || $digunakanDiKeluar || $digunakanDiRequest);

        return response()->json(['can_delete' => $canDelete]);
    }


    public function destroy($id)
    {
        $atk = MasterAtk::findOrFail($id);

        if ($atk->gambar_atk && Storage::disk('public')->exists($atk->gambar_atk)) {
            Storage::disk('public')->delete($atk->gambar_atk);
        }

        $atk->delete();

        return redirect('/master-atk')->with('success', 'Data ATK berhasil dihapus.');
    }
}
