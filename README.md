# Calculadora de IMC

Práctica de **Desarrollo Web en Entorno Cliente** — Angular.

## Descripción

Aplicación que calcula el Índice de Masa Corporal (IMC). Permite introducir nombre, sexo, peso y altura, mostrar un mensaje personalizado y guardar un listado con todos los cálculos de la sesión.

## Comandos utilizados

| Comando | Para qué sirve |
|---------|----------------|
| `npx @angular/cli@19 new calculadora-imc --routing=false --style=css --ssr=false` | Crea un proyecto Angular nuevo con CSS y sin rutas ni SSR. |
| `cd calculadora-imc` | Entra en la carpeta del proyecto. |
| `npm install` | Instala las dependencias (se ejecuta solo al crear el proyecto). |
| `npx ng generate component components/indicador-numerico --skip-tests` | Crea el componente del indicador con botones + y −. |
| `npx ng generate component components/selector-sexo --skip-tests` | Crea el componente para elegir el sexo. |
| `npx ng generate component components/listado-resultados --skip-tests` | Crea el componente que muestra el historial de cálculos. |
| `ng serve` o `npm start` | Arranca el servidor de desarrollo en `http://localhost:4200`. |
| `ng build` | Compila la aplicación para producción en la carpeta `dist/`. |

## Estructura del proyecto

- `app.component` — Formulario principal y lógica del IMC.
- `indicador-numerico` — Peso y altura con `@Input` / `@Output`.
- `selector-sexo` — Botones Hombre / Mujer con `@Input` / `@Output`.
- `listado-resultados` — Historial con `@Input` y directivas `*ngFor` y `*ngIf`.
- `models/resultado-imc.ts` — Interfaz TypeScript del resultado.

## Requisitos de la práctica

- Mínimo 3 componentes propios (app + 3 hijos).
- Decoradores `@Input` y `@Output`.
- Directivas: `*ngIf`, `*ngFor`, `[(ngModel)]`, `[ngClass]`.
- Interfaz TypeScript `ResultadoImc`.

## Cómo ejecutar

```bash
cd calculadora-imc
npm start
```

Abre el navegador en **http://localhost:4200**.

## Fórmula del IMC

```
IMC = peso (kg) / (altura en metros)²
```

- Menor de 18.5 → por debajo del peso ideal  
- Entre 18.5 y 24.9 → peso ideal  
- 25 o más → por encima del peso ideal  
