<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LogLogin;
use Carbon\Carbon;

class LogSuccessfulLogin
{
    /**
     * Tangani event login.
     */
    public function handle(Login $event): void
    {
        LogLogin::where('waktu_login', '<', Carbon::now()->subDays(30))->delete();

        LogLogin::create([
            'id_user' => $event->user->id_user ?? $event->user->id,
            'waktu_login' => Carbon::now(),
        ]);
    }
}