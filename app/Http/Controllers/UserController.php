<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // GET /user/{id}/mascota → mascota del usuario (relación 1:1)
    public function mascota(int $user): JsonResponse
    {
        $usuario = User::findOrFail($user);
        $mascota = $usuario->mascota;

        if (! $mascota) {
            return response()->json([
                'mensaje' => 'Este usuario no tiene mascota registrada.',
            ], 404);
        }

        return response()->json([
            'usuario' => $usuario->only(['id', 'name', 'email']),
            'mascota' => $mascota,
        ]);
    }

    // GET /user/{id}/publicaciones → publicaciones del usuario (relación 1:N)
    public function publicaciones(int $user): JsonResponse
    {
        $usuario = User::findOrFail($user);

        return response()->json([
            'usuario' => $usuario->only(['id', 'name', 'email']),
            'publicaciones' => $usuario->publicaciones,
        ]);
    }
}
