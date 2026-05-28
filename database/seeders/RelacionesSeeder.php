<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RelacionesSeeder extends Seeder
{
    public function run(): void
    {
        $ana = User::create([
            'name' => 'Ana García',
            'email' => 'ana@example.com',
            'password' => Hash::make('password'),
        ]);

        Mascota::create([
            'user_id' => $ana->id,
            'nombre' => 'Luna',
            'tipo' => 'perro',
            'edad' => 3,
        ]);

        Publicacion::create([
            'user_id' => $ana->id,
            'titulo' => 'Mi primer día con Luna',
            'contenido' => 'Hoy adopté a Luna, es muy juguetona.',
        ]);

        Publicacion::create([
            'user_id' => $ana->id,
            'titulo' => 'Paseo por el parque',
            'contenido' => 'Fuimos al parque y conoció a más perros.',
        ]);

        $carlos = User::create([
            'name' => 'Carlos López',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password'),
        ]);

        Mascota::create([
            'user_id' => $carlos->id,
            'nombre' => 'Michi',
            'tipo' => 'gato',
            'edad' => 2,
        ]);

        Publicacion::create([
            'user_id' => $carlos->id,
            'titulo' => 'Michi aprende trucos',
            'contenido' => 'Le enseñé a sentarse y ya lo hace bien.',
        ]);
    }
}
