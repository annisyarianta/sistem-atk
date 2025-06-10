<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ValidasiAtk;
use App\Models\AtkKeluar;
use App\Helpers\LogActivityHelper;
use Illuminate\Support\Facades\Auth;

class ValidasiAtkController extends Controller
{
    public function index()
    {
        $data = ValidasiAtk::whereHas('requestAtk', function ($query) {
            $query->where('status', 'pending');
        })->get();

        return view('validasi_atk.index', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_request' => 'required|numeric|min:1',
        ]);

        $validasi = ValidasiAtk::with('requestAtk')->findOrFail($id);
        $validasi->requestAtk->jumlah_request = $request->jumlah_request;
        $validasi->requestAtk->save();

        LogActivityHelper::add(
            'edit',
            'Validasi ATK',
            'User dengan ID ' . Auth::id() . ' mengedit data Validasi ATK dengan ID ' . $validasi->getKey()
        );

        return redirect()->route('validasi-atk.index')->with('success', 'Jumlah Permohonan ATK berhasil diperbarui');
    }

    public function approve($id)
    {
        $validasi = ValidasiAtk::findOrFail($id);
        $requestAtk = $validasi->requestAtk;
        $requestAtk->status = 'approved';
        $requestAtk->save();

        AtkKeluar::create([
            'id_atk' => $requestAtk->masterAtk->id_atk,
            'jumlah_keluar' => $requestAtk->jumlah_request,
            'tanggal_keluar' => now(),
            'id_unit' => $requestAtk->user->unit->id_unit,
        ]);

        LogActivityHelper::add(
            'approve',
            'Validasi ATK',
            'User dengan ID ' . Auth::id() . ' menyetujui permohonan ATK dengan ID ' . $requestAtk->getKey()
        );

        return redirect()->back()->with('success', 'Permintaan disetujui.');
    }

    public function reject($id)
    {
        $validasi = ValidasiAtk::findOrFail($id);
        $requestAtk = $validasi->requestAtk;
        $requestAtk->status = 'rejected';
        $requestAtk->save();

        LogActivityHelper::add(
            'reject',
            'Validasi ATK',
            'User dengan ID ' . Auth::id() . ' menolak permohonan ATK dengan ID ' . $requestAtk->getKey()
        );

        return redirect()->route('validasi-atk.index');
    }
}
