<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckLoggedIn
{
    /**
     * Comprueba si el usuario esta logeado mediante el token.
     * No usamos el middleware de Sanctum, lo hacemos a mano.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Obtenemos el token que viene en la cabecera Authorization
        $token = $request->bearerToken();

        if ($token === null) {
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        // 2. Buscamos el token en la base de datos
        $accessToken = PersonalAccessToken::findToken($token);

        if ($accessToken === null) {
            return response()->json(['message' => 'Token invalido.'], 401);
        }

        // 3. Si el token es valido, guardamos el usuario en la peticion
        $user = $accessToken->tokenable;
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        // 4. Dejamos continuar la peticion
        return $next($request);
    }
}
