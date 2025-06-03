<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestAtk;
use App\Models\MasterAtk;
use Illuminate\Support\Facades\Auth;

class RequestAtkController extends Controller
{
    public function index()
    {
        $dataRequest = RequestAtk::with(['masterAtk', 'user'])
            ->orderBy('tanggal_request', 'desc')
            ->get();
        $masterAtk = MasterAtk::orderBy('nama_atk')->get();

        return view('request_atk.index', compact('dataRequest', 'masterAtk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_atk' => 'required|exists:master_atk,id_atk',
            'tanggal_request' => 'required|date',
            'jumlah_request' => 'required|integer|min:1',
        ]);

        RequestAtk::create([
            'id_atk' => $request->id_atk,
            'tanggal_request' => $request->tanggal_request,
            'jumlah_request' => $request->jumlah_request,
            'id_user' => Auth::user()->id_user,
            'status' => 'pending'
        ]);

        return redirect()->route('request-atk.index')->with('success', 'Permohonan ATK berhasil ditambahkan.');
    }
}
