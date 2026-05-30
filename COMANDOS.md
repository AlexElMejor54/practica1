# Comandos del proyecto Pokédex

## Requisitos previos

- Node.js (versión LTS)
- Angular CLI instalado globalmente:

```bash
npm install -g @angular/cli
```

## Creación del proyecto

```bash
ng new pokedex --routing --style=scss
cd pokedex
```

## Instalación de dependencias

```bash
npm install
```

## Servidor de desarrollo

Levanta la aplicación en `http://localhost:4200`:

```bash
ng serve
```

También se puede usar:

```bash
npm start
```

## Generación de componentes y servicios

Durante el desarrollo se crearon los archivos manualmente, pero con el CLI se habrían usado comandos como:

```bash
ng generate service services/pokemon
ng generate component components/navbar
ng generate component components/pokemon-card
ng generate component pages/dashboard
ng generate component pages/pokemon-list
ng generate component pages/pokemon-detail
```

## Compilar para producción

```bash
ng build
```

Los archivos generados quedan en la carpeta `dist/pokedex`.

## Ejecutar tests

```bash
ng test
```

## Estructura principal

- `src/app/services/pokemon.service.ts` — Peticiones HTTP a la PokéAPI
- `src/app/models/` — Interfaces TypeScript de las respuestas
- `src/app/pages/` — Vistas: dashboard, listado y detalle
- `src/app/components/` — Componentes reutilizables: navbar y tarjeta de Pokémon
- `src/app/app.routes.ts` — Configuración de rutas

## Rutas de la aplicación

| Ruta | Descripción |
|------|-------------|
| `/` | Dashboard con Pokémon aleatorios y buscador |
| `/lista` | Listado paginado (20 por página) |
| `/pokemon/:idOrName` | Detalle de un Pokémon |
