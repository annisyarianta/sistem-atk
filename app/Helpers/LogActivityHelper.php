<?php

namespace App\Helpers;

use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LogActivityHelper
{
    public static function add($aksi, $jenisData, $keterangan)
    {
        LogActivity::where('waktu_aktivitas', '<', Carbon::now()->subDays(30))->delete();

        LogActivity::create([
            'id_user' => Auth::id(),
            'waktu_aktivitas' => Carbon::now(),
            'aksi' => $aksi,
            'jenis_data' => $jenisData,
            'keterangan' => $keterangan,
        ]);
    }
}