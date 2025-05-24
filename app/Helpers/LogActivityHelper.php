<?php

namespace App\Helpers;

use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LogActivityHelper
{
    public static function add($aksi, $jenisData, $keterangan)
    {
        LogActivity::create([
            'id_user' => Auth::id(),
            'waktu_aktivitas' => Carbon::now(),
            'aksi' => $aksi,
            'jenis_data' => $jenisData,
            'keterangan' => $keterangan,
        ]);
    }
}