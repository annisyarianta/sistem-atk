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
        $daftarAtk = MasterAtk::select(
                'master_atk.id_atk',
                'master_atk.kode_atk',
                'master_atk.nama_atk',
                'master_atk.jenis_atk',
                'master_atk.satuan',
                'master_atk.gambar_atk',
                DB::raw('(SELECT COALESCE(SUM(jumlah_masuk), 0) FROM atkmasuk WHERE atkmasuk.id_atk = master_atk.id_atk) as total_masuk'),
                DB::raw('(SELECT COALESCE(SUM(jumlah_keluar), 0) FROM atkkeluar WHERE atkkeluar.id_atk = master_atk.id_atk) as total_keluar')
            )
            ->orderBy('master_atk.kode_atk')
            ->get()
            ->map(function ($item) {
                $item->stok_saat_ini = $item->total_masuk - $item->total_keluar;
                return $item;
            });

        return view('daftar_atk.index', compact('daftarAtk'));
    }
}