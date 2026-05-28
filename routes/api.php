<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Middleware\ValidarIdNumerico;
use Illuminate\Support\Facades\Route;

Route::get('/alumnos', [AlumnoController::class, 'index']);
Route::post('/alumnos', [AlumnoController::class, 'store']);

Route::middleware(ValidarIdNumerico::class)->group(function () {
    Route::get('/alumnos/{id}', [AlumnoController::class, 'show']);
    Route::put('/alumnos/{id}', [AlumnoController::class, 'update']);
    Route::delete('/alumnos/{id}', [AlumnoController::class, 'destroy']);
});
