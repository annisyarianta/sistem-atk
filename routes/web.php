<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterAtkController;
use App\Http\Controllers\MasterUnitController;
use App\Http\Controllers\AtkMasukController;
use App\Http\Controllers\AtkKeluarController;


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
    
    Route::get('/master-atk', [MasterAtkController::class, 'index']);
    Route::post('/master-atk/store', [MasterAtkController::class, 'store']);
    Route::get('/master-atk/edit/{id}', [MasterAtkController::class, 'edit']);
    Route::post('/master-atk/update/{id}', [MasterAtkController::class, 'update']);
    Route::get('/master-atk/check-used/{id}', [MasterATKController::class, 'checkUsed']);
    Route::delete('/master-atk/delete/{id}', [MasterAtkController::class, 'destroy']);

    Route::get('/master-unit', [MasterUnitController::class, 'index']);
    Route::post('/master-unit/store', [MasterUnitController::class, 'store']);
    Route::get('/master-unit/edit/{id}', [MasterUnitController::class, 'edit']);
    Route::post('/master-unit/update/{id}', [MasterUnitController::class, 'update']);
    Route::delete('/master-unit/delete/{id}', [MasterUnitController::class, 'destroy']);

    Route::get('/atk-masuk', [AtkMasukController::class, 'index']);
    Route::post('/atk-masuk/store', [AtkMasukController::class, 'store']);
    Route::get('/atk-masuk/edit/{id}', [AtkMasukController::class, 'edit']);
    Route::post('/atk-masuk/update/{id}', [AtkMasukController::class, 'update']);
    Route::delete('/atk-masuk/delete/{id}', [AtkMasukController::class, 'destroy']);

    Route::get('/atk-keluar', [AtkKeluarController::class, 'index']);
    Route::post('/atk-keluar/store', [AtkKeluarController::class, 'store']);
    Route::get('/atk-keluar/edit/{id}', [AtkKeluarController::class, 'edit']);
    Route::post('/atk-keluar/update/{id}', [AtkKeluarController::class, 'update']);
    Route::delete('/atk-keluar/delete/{id}', [AtkKeluarController::class, 'destroy']);
});
require __DIR__.'/auth.php';


