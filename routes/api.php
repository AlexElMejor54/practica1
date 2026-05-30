<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rutas publicas (no necesitan estar logeado) - punto 5
Route::get('/inicio', [AuthController::class, 'inicio']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (solo usuarios logeados) - punto 2 y 5
Route::middleware('logged.in')->group(function () {
    Route::get('/usuario', [AuthController::class, 'usuario']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
