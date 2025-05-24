<?php

namespace App\Http\Controllers;

use App\Models\AtkMasuk;
use App\Models\MasterAtk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\LogActivityHelper;
use Illuminate\Support\Facades\Auth;

class AtkMasukController extends Controller
{
    public function index()
    {
        $dataMasuk = AtkMasuk::with('masterAtk')->orderByDesc('tanggal_masuk')->get();
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

        $atkMasuk = AtkMasuk::create($validated);

        LogActivityHelper::add(
            'tambah',
            'ATK Masuk',
            'User dengan ID ' . Auth::id() . ' menambah data ATK Masuk dengan ID ' . $atkMasuk->getKey()
        );

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

        LogActivityHelper::add(
            'edit',
            'ATK Masuk',
            'User dengan ID ' . Auth::id() . ' mengedit data ATK Masuk dengan ID ' . $atkMasuk->getKey()
        );

        return redirect()->route('atk-masuk.index')->with('success', 'Data ATK Masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $atkMasuk = AtkMasuk::findOrFail($id);
        $atkMasuk->delete();

        LogActivityHelper::add(
            'hapus',
            'ATK Masuk',
            'User dengan ID ' . Auth::id() . ' menghapus data ATK Masuk dengan ID ' . $atkMasuk->getKey()
        );

        return redirect()->route('atk-masuk.index')->with('success', 'Data ATK Masuk berhasil dihapus.');
    }
}
