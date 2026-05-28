<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\JsonResponse;

class MascotaController extends Controller
{
    // GET /mascota/{id}/usuario → dueño de la mascota (relación inversa 1:1)
    public function usuario(int $mascota): JsonResponse
    {
        $mascota = Mascota::with('user')->findOrFail($mascota);

        return response()->json([
            'mascota' => $mascota->only(['id', 'nombre', 'tipo', 'edad']),
            'usuario' => $mascota->user->only(['id', 'name', 'email']),
        ]);
    }
}
