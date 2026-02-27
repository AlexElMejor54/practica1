# Ventajas y desventajas: CDN vs librerías en local

## Usar un CDN (Content Delivery Network)

### Ventajas
- **No descargas archivos**: No ocupas espacio en tu proyecto ni en tu servidor.
- **Caché compartida**: Si el usuario ya visitó otra web que usa el mismo CDN, el navegador puede tener la librería en caché y cargarla más rápido.
- **Actualizaciones sencillas**: Cambiando la versión en la URL puedes usar una versión nueva sin tocar tu código.
- **Menor carga en tu servidor**: Las peticiones de la librería van al CDN, no a tu hosting.

### Desventajas
- **Dependencia externa**: Si el CDN cae o va lento, tu web puede dejar de funcionar bien (por ejemplo, las alertas de SweetAlert2).
- **Requiere internet**: En entornos sin conexión o muy restringidos la librería no cargará.
- **Privacidad**: El navegador hace una petición a un dominio de terceros (el CDN), lo que puede ser un problema en proyectos con requisitos estrictos de privacidad.

---

## Descargar la librería en local

### Ventajas
- **Funciona sin internet**: Una vez cargada la página desde tu servidor, la librería está disponible aunque no haya conexión.
- **No dependes de terceros**: Si el CDN tiene problemas, a ti no te afecta.
- **Control de versión**: Usas siempre la misma versión que descargaste; no cambia sin que tú lo decidas.
- **Privacidad**: No se hacen peticiones a dominios externos para cargar la librería.

### Desventajas
- **Más trabajo**: Tienes que descargar los archivos y actualizarlos manualmente cuando quieras cambiar de versión.
- **Menos aprovechamiento de caché**: Cada sitio sirve su propia copia, no se comparte caché entre diferentes webs.
- **Más peso en tu servidor**: Los archivos de la librería se sirven desde tu hosting y ocupan espacio en el repositorio.
