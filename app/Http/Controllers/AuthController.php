<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Ruta publica de ejemplo (punto 5 de la practica).
     */
    public function inicio()
    {
        return response()->json([
            'message' => 'API de login por tokens. Usa POST /api/login para autenticarte.',
        ]);
    }

    /**
     * Login con nombre y contraseña (punto 1 de la practica).
     */
    public function login(Request $request)
    {
        // Si ya envia un token valido, respondemos distinto
        $tokenEnviado = $request->bearerToken();

        if ($tokenEnviado !== null && PersonalAccessToken::findToken($tokenEnviado) !== null) {
            return response()->json([
                'message' => 'El usuario ya esta logeado.',
            ]);
        }

        // Validamos los datos recibidos
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscamos el usuario y comprobamos la contraseña
        $user = User::where('name', $request->name)->first();

        if ($user === null || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas.',
            ], 401);
        }

        // Creamos un token nuevo con Sanctum
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login correcto.',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Muestra los datos del usuario logeado (punto 3 de la practica).
     */
    public function usuario(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Cierra sesion eliminando el token (punto 4 de la practica).
     */
    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $accessToken = PersonalAccessToken::findToken($token);

        if ($accessToken !== null) {
            $accessToken->delete();
        }

        return response()->json([
            'message' => 'Sesion cerrada correctamente.',
        ]);
    }
}
