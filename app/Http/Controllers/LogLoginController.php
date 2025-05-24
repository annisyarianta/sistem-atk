<?php

namespace App\Http\Controllers;

use App\Models\LogLogin;
use Illuminate\Http\Request;

class LogLoginController extends Controller
{
    /**
     * Tampilkan daftar log login.
     */
    public function index()
    {
        // Ambil data log beserta relasi user, urut terbaru, paginasi 10/baris
        $logs = LogLogin::with('user')
            ->orderByDesc('waktu_login')
            ->paginate(10);

        return view('log_login.index', compact('logs'));
    }
}