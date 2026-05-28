# Práctica 1 - API REST Laravel (Alumnos)

API REST sencilla para gestionar la tabla `alumno` usando Laravel, Query Builder y validaciones.

## Requisitos

- PHP 8.2 o superior
- Composer
- SQLite (incluido por defecto en el proyecto)

## Comandos utilizados en el desarrollo

### 1. Crear el proyecto Laravel

```bash
composer create-project laravel/laravel .
```

Crea un proyecto Laravel nuevo en la carpeta actual con todas las dependencias.

### 2. Generar la clave de la aplicación

```bash
php artisan key:generate
```

Genera la clave `APP_KEY` en el archivo `.env` (necesaria para la seguridad de Laravel).

### 3. Crear la migración de la tabla alumno

```bash
php artisan make:migration create_alumno_table
```

Crea el archivo de migración en `database/migrations/` para definir la estructura de la tabla.

### 4. Ejecutar las migraciones

```bash
php artisan migrate
```

Crea las tablas en la base de datos según las migraciones (incluida `alumno`).

### 5. Crear el seeder

```bash
php artisan make:seeder AlumnoSeeder
```

Crea la clase que rellena la tabla con datos de ejemplo.

### 6. Ejecutar los seeders

```bash
php artisan db:seed
```

Inserta los alumnos de prueba en la base de datos.

### 7. Crear el controlador

```bash
php artisan make:controller AlumnoController
```

Genera el controlador donde están las funciones de la API.

### 8. Crear el middleware

```bash
php artisan make:middleware ValidarIdNumerico
```

Crea el middleware que comprueba que el `id` de la ruta sea entero y positivo.

### 9. Arrancar el servidor de desarrollo

```bash
php artisan serve
```

Inicia el servidor en `http://127.0.0.1:8000` para probar la API.

## Conexión a la base de datos

El proyecto usa **SQLite**. En el archivo `.env`:

```
DB_CONNECTION=sqlite
```

El fichero de la base de datos está en `database/database.sqlite`.

Para usar **MySQL**, cambia en `.env` algo como:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=root
DB_PASSWORD=
```

Y ejecuta de nuevo `php artisan migrate` y `php artisan db:seed`.

## Rutas de la API

| Método | Ruta | Acción |
|--------|------|--------|
| GET | `/api/alumnos` | Obtener todos los alumnos |
| GET | `/api/alumnos/{id}` | Obtener un alumno por id |
| POST | `/api/alumnos` | Crear un alumno |
| PUT | `/api/alumnos/{id}` | Modificar un alumno |
| DELETE | `/api/alumnos/{id}` | Borrar un alumno |

Las rutas con `{id}` usan el middleware `ValidarIdNumerico`.

## Ejemplos para probar (curl)

**Listar todos:**
```bash
curl http://127.0.0.1:8000/api/alumnos
```

**Obtener por id:**
```bash
curl http://127.0.0.1:8000/api/alumnos/1
```

**Crear:**
```bash
curl -X POST http://127.0.0.1:8000/api/alumnos \
  -H "Content-Type: application/json" \
  -d '{"nombre":"Juan","email":"juan@test.com","password":"1234","sexo":"M","edad":19}'
```

**Modificar:**
```bash
curl -X PUT http://127.0.0.1:8000/api/alumnos/1 \
  -H "Content-Type: application/json" \
  -d '{"nombre":"Ana Actualizada","edad":21}'
```

**Borrar:**
```bash
curl -X DELETE http://127.0.0.1:8000/api/alumnos/1
```

## Estructura principal del proyecto

- `database/migrations/` — Definición de la tabla `alumno`
- `database/seeders/AlumnoSeeder.php` — Datos de ejemplo
- `app/Http/Controllers/AlumnoController.php` — Lógica de la API (Query Builder)
- `app/Http/Middleware/ValidarIdNumerico.php` — Validación del id en rutas
- `routes/api.php` — Rutas REST de alumnos

## Datos del seeder

Los alumnos de prueba tienen contraseña `1234` (guardada hasheada en la base de datos).
