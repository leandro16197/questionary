<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\generosController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MercadoPagoController;
Route::get('/generos',[generosController::class,'index']);

Route::get('/generos/{id}', [generosController::class,'show']);

Route::post('/generos', [generosController::class,'store']);

Route::put('/generos/{id}', [generosController::class, 'update']);

Route::delete('/generos/{id}', [generosController::class, 'delete']);

Route::get('/question/get', [GameController::class, 'getQuestion'])->name('getQuestion');
Route::post('/recibir-pago',[MercadoPagoController::class,'recibirPago']);
