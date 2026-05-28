<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('alumno')->insert([
            [
                'nombre' => 'Ana García',
                'telefono' => '600111222',
                'edad' => 20,
                'password' => Hash::make('1234'),
                'email' => 'ana@ejemplo.com',
                'sexo' => 'F',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Luis Martín',
                'telefono' => null,
                'edad' => 22,
                'password' => Hash::make('1234'),
                'email' => 'luis@ejemplo.com',
                'sexo' => 'M',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María López',
                'telefono' => '611333444',
                'edad' => null,
                'password' => Hash::make('1234'),
                'email' => 'maria@ejemplo.com',
                'sexo' => 'F',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
