<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/regalos', function () {
    return 'Lista de regalos';
});

Route::post('/regalos', function () {
    return 'Crear un nuevo regalo';
});

Route::get('/regalos/{id}', function ($id) {
    return "Detalle del regalo con ID: $id";
});

Route::put('/regalos/{id}', function ($id) {
    return "Actualizar el regalo con ID: $id";
});
Route::delete('/regalos/{id}', function ($id) {
    return "Eliminar el regalo con ID: $id";
});
