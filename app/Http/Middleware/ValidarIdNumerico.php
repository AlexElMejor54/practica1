<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidarIdNumerico
{
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');

        if (! is_numeric($id) || (int) $id != $id || (int) $id <= 0) {
            return response()->json([
                'mensaje' => 'El id debe ser un número entero positivo.',
            ], 400);
        }

        return $next($request);
    }
}
