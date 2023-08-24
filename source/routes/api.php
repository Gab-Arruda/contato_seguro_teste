<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::group(['prefix' => 'registros'], function () {
    Route::get('/', [RegistroController::class, 'index']);
    Route::post('/', [RegistroController::class, 'store']);
    Route::get('/{id}', [RegistroController::class, 'show']);
    Route::put('/{id}', [RegistroController::class, 'update']);
    Route::delete('/{id}', [RegistroController::class, 'destroy']);
});
