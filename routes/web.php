<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterAtkController;
use App\Http\Controllers\MasterUnitController;
use App\Http\Controllers\AtkMasukController;
use App\Http\Controllers\AtkKeluarController;
use App\Http\Controllers\DaftarAtkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestAtkController;
use App\Http\Controllers\ValidasiAtkController;
use App\Http\Controllers\LogLoginController;
use App\Http\Controllers\LogActivityController;


Route::aliasMiddleware('role', RoleMiddleware::class);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    /* ---------- Daftar ATK ---------- */
    Route::resource('daftar-atk', DaftarAtkController::class)
        ->only(['index'])
        ->names('daftar-atk');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    /* ---------- Dashboard ---------- */
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    /* ---------- Profile ---------- */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---------- Master ATK ---------- */
    Route::resource('master-atk', MasterAtkController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update',
            'destroy'
        ])
        ->parameters(['master-atk' => 'atk'])
        ->names('master-atk');

    Route::get('master-atk/check-used/{id}', [MasterATKController::class, 'checkUsed'])
        ->name('master-atk.check-used');

    /* ---------- Master Unit ---------- */
    Route::resource('master-unit', MasterUnitController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update',
            'destroy'
        ])
        ->parameters(['master-unit' => 'id'])
        ->names('master-unit');

    /* ---------- ATK Masuk ---------- */
    Route::resource('atk-masuk', AtkMasukController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update',
            'destroy'
        ])
        ->parameters(['atk-masuk' => 'id'])
        ->names('atk-masuk');

    /* ---------- ATK Keluar ---------- */
    Route::resource('atk-keluar', AtkKeluarController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update',
            'destroy'
        ])
        ->parameters(['atk-keluar' => 'id'])
        ->names('atk-keluar');

    /* ---------- Kelola User ---------- */
    Route::resource('kelola-user', UserController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update',
            'destroy'
        ])->parameters(['kelola-user' => 'id'])
        ->names('kelola-user');

    /* ---------- Validasi ATK ---------- */
    Route::resource('validasi-atk', ValidasiAtkController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update'
        ])->parameters(['validasi-atk' => 'id'])
        ->names('validasi-atk');
    Route::put('validasi-atk/{id}/approve', [ValidasiAtkController::class, 'approve'])->name('validasi-atk.approve');
    Route::put('validasi-atk/{id}/reject', [ValidasiAtkController::class, 'reject'])->name('validasi-atk.reject');

    /* ---------- Log Login ---------- */
    Route::resource('log-login', LogLoginController::class)
        ->only(['index'])
        ->names('log-login');

    /* ---------- Log Activity ---------- */
    Route::resource('log-activity', LogActivityController::class)
        ->only(['index'])
        ->names('log-activity');
});

Route::middleware(['auth', 'verified', 'role:staff'])->group(function () {
    /* ---------- Permohonan ATK ---------- */
    Route::resource('request-atk', RequestAtkController::class)
        ->only([
            'index',
            'store'
        ])->parameters(['request-atk' => 'id'])
        ->names('request-atk');
});

require __DIR__ . '/auth.php';
