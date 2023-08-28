<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::group(['prefix' => 'registros'], function () {
    Route::get('/{id}', [RegistroController::class, 'show'])->name('show');
    Route::get('/', [RegistroController::class, 'index'])->name('index');
    Route::post('/', [RegistroController::class, 'store']);
    Route::put('/{id}', [RegistroController::class, 'update']);
    Route::delete('/{id}', [RegistroController::class, 'destroy']);
});
