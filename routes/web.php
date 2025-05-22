<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterAtkController;
use App\Http\Controllers\MasterUnitController;
use App\Http\Controllers\AtkMasukController;
use App\Http\Controllers\AtkKeluarController;
use App\Http\Controllers\DaftarAtkController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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

    /* ---------- Daftar ATK ---------- */
    Route::resource('daftar-atk', DaftarAtkController::class)
        ->only(['index'])
        ->names('daftar-atk');

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
});
require __DIR__ . '/auth.php';
