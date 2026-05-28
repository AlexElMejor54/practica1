<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\JsonResponse;

class PublicacionController extends Controller
{
    // GET /publicacion/{id}/autor → autor de la publicación (relación inversa 1:N)
    public function autor(int $publicacion): JsonResponse
    {
        $publicacion = Publicacion::with('user')->findOrFail($publicacion);

        return response()->json([
            'publicacion' => $publicacion->only(['id', 'titulo', 'contenido']),
            'autor' => $publicacion->user->only(['id', 'name', 'email']),
        ]);
    }
}
