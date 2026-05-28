<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller
{
    public function index(): JsonResponse
    {
        $alumnos = DB::table('alumno')
            ->select('id', 'nombre', 'telefono', 'edad', 'email', 'sexo')
            ->get();

        return response()->json($alumnos);
    }

    public function show(int $id): JsonResponse
    {
        $alumno = DB::table('alumno')
            ->select('id', 'nombre', 'telefono', 'edad', 'email', 'sexo')
            ->where('id', $id)
            ->first();

        if (! $alumno) {
            return response()->json(['mensaje' => 'Alumno no encontrado.'], 404);
        }

        return response()->json($alumno);
    }

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:32',
            'telefono' => 'nullable|string|max:16',
            'edad' => 'nullable|integer|min:0',
            'password' => 'required|string|max:64',
            'email' => 'required|email|max:64|unique:alumno,email',
            'sexo' => 'required|string|max:10',
        ]);

        $datos['password'] = Hash::make($datos['password']);
        $datos['created_at'] = now();
        $datos['updated_at'] = now();

        $id = DB::table('alumno')->insertGetId($datos);

        return response()->json([
            'mensaje' => 'Alumno creado correctamente.',
            'id' => $id,
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $existe = DB::table('alumno')->where('id', $id)->exists();

        if (! $existe) {
            return response()->json(['mensaje' => 'Alumno no encontrado.'], 404);
        }

        $datos = $request->validate([
            'nombre' => 'sometimes|required|string|max:32',
            'telefono' => 'nullable|string|max:16',
            'edad' => 'nullable|integer|min:0',
            'password' => 'sometimes|required|string|max:64',
            'email' => 'sometimes|required|email|max:64|unique:alumno,email,'.$id,
            'sexo' => 'sometimes|required|string|max:10',
        ]);

        if (isset($datos['password'])) {
            $datos['password'] = Hash::make($datos['password']);
        }

        $datos['updated_at'] = now();

        DB::table('alumno')->where('id', $id)->update($datos);

        return response()->json(['mensaje' => 'Alumno actualizado correctamente.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $borrados = DB::table('alumno')->where('id', $id)->delete();

        if ($borrados === 0) {
            return response()->json(['mensaje' => 'Alumno no encontrado.'], 404);
        }

        return response()->json(['mensaje' => 'Alumno eliminado correctamente.']);
    }
}
