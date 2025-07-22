<?php

use App\Http\Controllers\FincaController;
use App\Http\Controllers\PropietarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas para Propietarios
Route::resource('propietarios', PropietarioController::class);

// Rutas para Fincas
Route::resource('fincas', FincaController::class);

// Rutas API adicionales
Route::prefix('api')->group(function () {
    Route::apiResource('propietarios', PropietarioController::class);
    Route::apiResource('fincas', FincaController::class);
});
