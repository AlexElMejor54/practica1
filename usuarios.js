const usuarios = [
    { nombre: "Pepe", apellidos: "García López", email: "pepe@gmail.com", edad: 25 },
    { nombre: "María", apellidos: "Sánchez Ruiz", email: "maria@gmail.com", edad: 30 },
    { nombre: "Ana", apellidos: "Pérez Díaz", email: "ana@gmail.com", edad: 22 },
    { nombre: "Pedro", apellidos: "Rodríguez Gómez", email: "pedro@gmail.com", edad: 28 },
    { nombre: "Lucía", apellidos: "Martínez Fernández", email: "lucia@gmail.com", edad: 26 }
];

document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector("#tablaUsuarios tbody");
    const inputBuscador = document.getElementById("buscador");

    // Elementos del Modal
    const modal = document.getElementById('modalEdicion');
    const btnGuardar = document.getElementById('btnGuardar');
    const btnCancelar = document.getElementById('btnCancelar');
    const inNombre = document.getElementById('editNombre');
    const inApellidos = document.getElementById('editApellidos');
    const inEmail = document.getElementById('editEmail');
    const inEdad = document.getElementById('editEdad');

    // Función para mostrar la tabla
    function renderTabla(datos) {
        tbody.innerHTML = "";
        datos.forEach((usuario) => {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td>${usuario.nombre}</td>
                <td>${usuario.apellidos}</td>
                <td>${usuario.email}</td>
                <td>${usuario.edad}</td>
                <td>
                    <button class="editar" data-email="${usuario.email}" style="background-color: #007bff; margin-right:5px;">Editar</button>
                    <button class="eliminar" data-email="${usuario.email}" style="background-color: #dc3545;">Borrar</button>
                </td>
            `;
            tbody.appendChild(fila);
        });

        asignarEventos();
    }

    // Asignar eventos a los botones generados dinámicamente
    function asignarEventos() {
        // Botones Borrar
        document.querySelectorAll(".eliminar").forEach(boton => {
            boton.onclick = function () {
                const email = this.dataset.email;
                if (confirm('¿Seguro que deseas eliminar este usuario?')) {
                    const index = usuarios.findIndex(u => u.email === email);
                    if (index !== -1) usuarios.splice(index, 1);
                    renderTabla(usuarios);
                }
            };
        });

        // Botones Editar
        document.querySelectorAll(".editar").forEach(boton => {
            boton.onclick = function () {
                const email = this.dataset.email;
                const usuario = usuarios.find(u => u.email === email);
                if (usuario) {
                    // Rellenar formulario
                    inNombre.value = usuario.nombre;
                    inApellidos.value = usuario.apellidos;
                    inEmail.value = usuario.email;
                    inEdad.value = usuario.edad;

                    // Mostrar modal
                    modal.style.display = 'flex';
                }
            };
        });
    }

    // Lógica del Modal
    btnCancelar.onclick = () => {
        modal.style.display = 'none';
    };

    btnGuardar.onclick = () => {
        const email = inEmail.value;
        const usuarioIndex = usuarios.findIndex(u => u.email === email);

        if (usuarioIndex !== -1) {
            // Actualizar datos en el array
            usuarios[usuarioIndex].nombre = inNombre.value;
            usuarios[usuarioIndex].apellidos = inApellidos.value;
            usuarios[usuarioIndex].edad = parseInt(inEdad.value);

            // Refrescar tabla y cerrar modal
            renderTabla(usuarios);
            modal.style.display = 'none';
        }
    };

    // Cerrar modal si se hace clic fuera del contenido
    modal.onclick = (e) => {
        if (e.target === modal) modal.style.display = 'none';
    };

    // Buscador
    inputBuscador.addEventListener("input", function () {
        const texto = this.value.toLowerCase();

        if (texto.length < 1) {
            renderTabla(usuarios);
            return;
        }

        const filtrados = usuarios.filter(u =>
            u.nombre.toLowerCase().includes(texto) ||
            u.apellidos.toLowerCase().includes(texto)
        );
        renderTabla(filtrados);
    });

    // Render inicial
    renderTabla(usuarios);
});
