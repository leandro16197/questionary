<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\generosController;
use App\Http\Controllers\QuestionaryController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/questionary', [QuestionaryController::class, 'store'])->name('questionary.store');
    Route::get('/dashboard', [GenerosController::class, 'getGeneros'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    
});

require __DIR__.'/auth.php';
