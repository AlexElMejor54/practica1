# Práctica 2 — Laravel | Relaciones Eloquent

Proyecto de la asignatura **Desarrollo Web en Entorno Servidor** (2º DAW).  
Implementa relaciones **1:1** y **1:N** entre modelos usando Eloquent, migraciones y rutas REST.

## ¿De qué va el proyecto?

La aplicación gestiona **usuarios**, cada uno con **una mascota** (relación 1:1) y **varias publicaciones** (relación 1:N).  
Las consultas entre modelos relacionados se hacen con el ORM de Laravel, sin escribir SQL a mano.

```
User (usuario)
 ├── mascota        → 1 mascota por usuario   (1:1)
 └── publicaciones  → N publicaciones         (1:N)
```

## Modelos

| Modelo       | Tabla          | Descripción                          |
|-------------|----------------|--------------------------------------|
| `User`      | `users`        | Usuario del sistema                  |
| `Mascota`   | `mascotas`     | Mascota de un usuario (máximo una)   |
| `Publicacion` | `publicacions` | Publicación escrita por un usuario |

### Relaciones Eloquent

**User** (`app/Models/User.php`)
- `mascota()` → `hasOne(Mascota::class)` — relación 1:1
- `publicaciones()` → `hasMany(Publicacion::class)` — relación 1:N

**Mascota** (`app/Models/Mascota.php`)
- `user()` → `belongsTo(User::class)` — inversa 1:1

**Publicacion** (`app/Models/Publicacion.php`)
- `user()` → `belongsTo(User::class)` — inversa 1:N

## Base de datos (migraciones)

- **`mascotas`**: `user_id` con clave foránea y restricción **UNIQUE** (garantiza la relación 1:1).
- **`publicacions`**: `user_id` con clave foránea (varias filas por el mismo usuario, relación 1:N).

## Rutas API

Todas las rutas devuelven **JSON**.

| Método | Ruta | Controlador | Qué hace |
|--------|------|-------------|----------|
| GET | `/` | — | Lista las rutas disponibles |
| GET | `/user/{id}/mascota` | `UserController@mascota` | Mascota del usuario (1:1) |
| GET | `/user/{id}/publicaciones` | `UserController@publicaciones` | Publicaciones del usuario (1:N) |
| GET | `/mascota/{id}/usuario` | `MascotaController@usuario` | Dueño de la mascota (inversa 1:1) |
| GET | `/publicacion/{id}/autor` | `PublicacionController@autor` | Autor de la publicación (inversa 1:N) |

### Ejemplos

```bash
# Mascota del usuario 1 (como indica el enunciado de la práctica)
curl http://127.0.0.1:8000/user/1/mascota

# Publicaciones del usuario 1
curl http://127.0.0.1:8000/user/1/publicaciones

# Usuario dueño de la mascota 1
curl http://127.0.0.1:8000/mascota/1/usuario

# Autor de la publicación 1
curl http://127.0.0.1:8000/publicacion/1/autor
```

## Instalación y puesta en marcha

Requisitos: PHP 8.2+, Composer.

```bash
# 1. Instalar dependencias
composer install

# 2. Configurar entorno (si no existe .env)
cp .env.example .env
php artisan key:generate

# 3. Crear base de datos SQLite y migrar con datos de ejemplo
touch database/database.sqlite
php artisan migrate:fresh --seed

# 4. Arrancar el servidor
php artisan serve
```

Abre en el navegador: `http://127.0.0.1:8000/user/1/mascota`

## Datos de prueba (seeder)

El seeder `RelacionesSeeder` crea:

| Usuario      | Email              | Mascota | Publicaciones |
|-------------|--------------------|---------|---------------|
| Ana García  | ana@example.com    | Luna (perro) | 2 |
| Carlos López | carlos@example.com | Michi (gato) | 1 |

## Estructura del proyecto

```
app/
├── Http/Controllers/
│   ├── UserController.php        # Consultas desde User
│   ├── MascotaController.php     # Consulta inversa 1:1
│   └── PublicacionController.php # Consulta inversa 1:N
└── Models/
    ├── User.php
    ├── Mascota.php
    └── Publicacion.php

database/
├── migrations/                   # Tablas con claves foráneas
└── seeders/RelacionesSeeder.php  # Datos de ejemplo

routes/web.php                    # Definición de rutas
```

## Autor

Alejandro Barberá Castillo — 2º DAW — EFA El Campico
