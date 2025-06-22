<?php

namespace App\Http\Controllers;

use App\Models\MasterAtk;
use App\Models\AtkMasuk;
use App\Models\AtkKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarAtkController extends Controller
{
    public function index()
    {
        $daftarAtk = MasterAtk::orderBy('kode_atk')->get();

        return view('daftar_atk.index', compact('daftarAtk'));
    }
}