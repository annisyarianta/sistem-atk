<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index()
    {
        $logs = LogActivity::orderByDesc('waktu_aktivitas')->get();
        return view('log_activity.index', compact('logs'));
    }
    
}
