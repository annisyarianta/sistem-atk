<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\ValidasiAtk;
use App\Models\MasterAtk;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        View::composer('layouts.navigation', function ($view) {
            $jumlahValidasi = ValidasiAtk::whereHas('requestAtk', function ($query) {
                $query->where('status', 'pending');
            })->count();

            $jumlahAkanHabis = MasterAtk::all()
                ->filter(function ($atk) {
                    return $atk->stok_saat_ini <= $atk->jumlah_minimum;
                })
                ->count();

            $view->with([
                'jumlahValidasi' => $jumlahValidasi,
                'jumlahAkanHabis' => $jumlahAkanHabis,
            ]);
        });
    }
}
