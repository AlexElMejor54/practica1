document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formRegistro');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        Swal.fire({
            title: '¿Crear usuario?',
            text: 'Se registrará el usuario con los datos del formulario.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, crear',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (!result.isConfirmed) return;

            const formData = new FormData(form);

            fetch('../ws/crearUsuario2.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.text().then(t => {
                    try { const d = JSON.parse(t); return { ...d, _ok: res.ok }; } catch (_) { return { _ok: res.ok }; }
                }))
                .then(data => {
                    // Solo éxito si el servidor devuelve success/ok explícito (evita mostrar éxito cuando PHP devuelve error HTML)
                    if (data.success === true || data.ok === true || data.exito === true) {
                        Swal.fire({ title: 'Usuario creado', text: 'El usuario se ha registrado correctamente.', icon: 'success' });
                        form.reset();
                    } else {
                        Swal.fire({ title: 'Error', text: data.message || data.error || data.mensaje || 'No se pudo crear el usuario.', icon: 'error' });
                    }
                })
                .catch(() => {
                    Swal.fire({ title: 'Error', text: 'Error de conexión con el servidor.', icon: 'error' });
                });
        });
    });
});
