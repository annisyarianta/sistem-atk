<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterAtkController;


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
});
require __DIR__.'/auth.php';


