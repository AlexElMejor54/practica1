<?php

use App\Http\Controllers\MascotaController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'mensaje' => 'Práctica Laravel - Relaciones Eloquent',
        'rutas' => [
            'GET /user/{id}/mascota' => 'Mascota del usuario (1:1)',
            'GET /user/{id}/publicaciones' => 'Publicaciones del usuario (1:N)',
            'GET /mascota/{id}/usuario' => 'Dueño de la mascota (inversa 1:1)',
            'GET /publicacion/{id}/autor' => 'Autor de la publicación (inversa 1:N)',
        ],
    ]);
});

// Consultar datos relacionados desde el modelo "padre"
Route::get('user/{user}/mascota', [UserController::class, 'mascota']);
Route::get('user/{user}/publicaciones', [UserController::class, 'publicaciones']);

// Consultar datos relacionados desde el modelo "hijo" (relaciones inversas)
Route::get('mascota/{mascota}/usuario', [MascotaController::class, 'usuario']);
Route::get('publicacion/{publicacion}/autor', [PublicacionController::class, 'autor']);
