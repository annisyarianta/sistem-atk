<?php

namespace App\Http\Controllers;

use App\Models\AtkMasuk;
use App\Models\MasterAtk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AtkMasukController extends Controller
{
    public function index()
    {
        $dataMasuk = AtkMasuk::with('masterAtk')->orderByDesc('tanggal_masuk')->paginate(10);
        $masterAtk = MasterAtk::orderBy('nama_atk')->get();

        return view('atk_masuk.index', compact('dataMasuk', 'masterAtk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_atk'        => 'required|exists:master_atk,id_atk',
            'jumlah_masuk'  => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'harga_satuan'  => 'required|integer',
        ]);

        $validated['harga_total'] = $validated['jumlah_masuk'] * $validated['harga_satuan'];

        AtkMasuk::create($validated);

        return redirect()->route('atk-masuk.index')->with('success', 'Data ATK Masuk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $atkMasuk   = AtkMasuk::findOrFail($id);
        $masterAtk  = MasterAtk::orderBy('nama_atk')->get();

        return view('atk_masuk.edit', compact('atkMasuk', 'masterAtk'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_atk'        => 'required|exists:master_atk,id_atk',
            'jumlah_masuk'  => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'harga_satuan'  => 'required|integer',
        ]);

        $validated['harga_total'] = $validated['jumlah_masuk'] * $validated['harga_satuan'];

        $atkMasuk = AtkMasuk::findOrFail($id);
        $atkMasuk->update($validated);

        return redirect()->route('atk-masuk.index')->with('success', 'Data ATK Masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $atkMasuk = AtkMasuk::findOrFail($id);
        $atkMasuk->delete();

        return redirect()->route('atk-masuk.index')->with('success', 'Data ATK Masuk berhasil dihapus.');
    }
}
