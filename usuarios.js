let usuarios = [];

document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector("#tablaUsuarios tbody");
    const inputBuscador = document.getElementById("buscador");
    const modal = document.getElementById('modalEdicion');
    const btnGuardar = document.getElementById('btnGuardar');
    const btnCancelar = document.getElementById('btnCancelar');
    const inNombre = document.getElementById('editNombre');
    const inApellidos = document.getElementById('editApellidos');
    const inEmail = document.getElementById('editEmail');
    const inEdad = document.getElementById('editEdad');

    function renderTabla(datos) {
        tbody.innerHTML = "";
        datos.forEach((usuario) => {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td>${usuario.nombre}</td>
                <td>${usuario.apellidos}</td>
                <td>${usuario.email}</td>
                <td>${usuario.edad != null ? usuario.edad : (usuario.telefono || '-')}</td>
                <td>
                    <button class="editar" data-email="${usuario.email}" data-id="${usuario.id || ''}" style="background-color: #007bff; margin-right:5px;">Editar</button>
                    <button class="eliminar" data-email="${usuario.email}" data-id="${usuario.id || ''}" style="background-color: #dc3545;">Borrar</button>
                </td>
            `;
            tbody.appendChild(fila);
        });
        asignarEventos();
    }

    function asignarEventos() {
        document.querySelectorAll(".eliminar").forEach(boton => {
            boton.onclick = function () {
                const id = this.dataset.id;
                if (!id) {
                    Swal.fire({ title: 'Error', text: 'Falta el id del usuario.', icon: 'error' });
                    return;
                }
                Swal.fire({
                    title: '¿Borrar usuario?',
                    text: 'Esta acción no se puede deshacer.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, borrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (!result.isConfirmed) return;
                    fetch('../ws/deleteUsuario.php?id=' + encodeURIComponent(id))
                        .then(r => r.json().catch(() => ({})))
                        .then(data => {
                            if (data && (data.success || data.ok)) {
                                Swal.fire({ title: 'Eliminado', text: 'Usuario eliminado correctamente.', icon: 'success' });
                                cargarUsuarios();
                            } else {
                                Swal.fire({ title: 'Error', text: (data && data.message) || data.error || 'No se pudo eliminar.', icon: 'error' });
                            }
                        })
                        .catch(() => Swal.fire({ title: 'Error', text: 'Error de conexión.', icon: 'error' }));
                });
            };
        });

        document.querySelectorAll(".editar").forEach(boton => {
            boton.onclick = function () {
                const email = this.dataset.email;
                const id = this.dataset.id;
                const usuario = usuarios.find(u => u.email === email);
                if (usuario) {
                    inNombre.value = usuario.nombre;
                    inApellidos.value = usuario.apellidos;
                    inEmail.value = usuario.email;
                    inEdad.value = usuario.edad != null ? usuario.edad : (usuario.telefono || '');
                    modal.dataset.editId = id || '';
                    modal.style.display = 'flex';
                }
            };
        });
    }

    btnCancelar.onclick = () => { modal.style.display = 'none'; };

    btnGuardar.onclick = () => {
        const id = modal.dataset.editId;
        if (!id) {
            Swal.fire({ title: 'Error', text: 'Falta el id del usuario.', icon: 'error' });
            return;
        }
        Swal.fire({
            title: '¿Guardar cambios?',
            text: 'Se actualizará el usuario en la base de datos.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (!result.isConfirmed) return;
            const body = new URLSearchParams({
                nombre: inNombre.value,
                apellidos: inApellidos.value,
                email: inEmail.value,
                telefono: inEdad.value
            });
            fetch('../ws/modificarUsuario.php?id=' + encodeURIComponent(id), {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body
            })
                .then(r => r.json().catch(() => ({})))
                .then(data => {
                    if (data && (data.success || data.ok)) {
                        Swal.fire({ title: 'Guardado', text: 'Usuario actualizado correctamente.', icon: 'success' });
                        modal.style.display = 'none';
                        cargarUsuarios();
                    } else {
                        Swal.fire({ title: 'Error', text: (data && data.message) || data.error || 'No se pudo actualizar.', icon: 'error' });
                    }
                })
                .catch(() => Swal.fire({ title: 'Error', text: 'Error de conexión.', icon: 'error' }));
        });
    };

    modal.onclick = (e) => { if (e.target === modal) modal.style.display = 'none'; };

    function cargarUsuarios() {
        fetch('../ws/getUsuario.php')
            .then(r => r.json())
            .then(data => {
                usuarios = (data && data.data) ? data.data : (Array.isArray(data) ? data : (data.usuarios || data.datos || []));
                const texto = inputBuscador.value.toLowerCase();
                const filtrados = texto.length < 1
                    ? usuarios
                    : usuarios.filter(u =>
                        (u.nombre || '').toLowerCase().includes(texto) ||
                        (u.apellidos || '').toLowerCase().includes(texto)
                    );
                renderTabla(filtrados);
            })
            .catch(() => {
                Swal.fire({ title: 'Error', text: 'No se pudieron cargar los usuarios.', icon: 'error' });
                renderTabla([]);
            });
    }

    inputBuscador.addEventListener("input", function () {
        const texto = this.value.toLowerCase();
        const filtrados = texto.length < 1
            ? usuarios
            : usuarios.filter(u =>
                (u.nombre || '').toLowerCase().includes(texto) ||
                (u.apellidos || '').toLowerCase().includes(texto)
            );
        renderTabla(filtrados);
    });

    cargarUsuarios();
});
