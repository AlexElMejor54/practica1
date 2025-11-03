const usuarios = [
  { nombre: "Pepe", apellidos: "García López", email: "pepe@gmail.com", edad: 25 },
  { nombre: "María", apellidos: "Sánchez Ruiz", email: "maria@gmail.com", edad: 30 },
  { nombre: "Ana", apellidos: "Pérez Díaz", email: "ana@gmail.com", edad: 22 },
  { nombre: "Pedro", apellidos: "Rodríguez Gómez", email: "pedro@gmail.com", edad: 28 },
  { nombre: "Lucía", apellidos: "Martínez Fernández", email: "lucia@gmail.com", edad: 26 }
];

window.onload = function() {
  const tbody = document.querySelector("#tablaUsuarios tbody");
  const inputBuscador = document.getElementById("buscador");

  function renderTabla(datos) {
    tbody.innerHTML = ""; 
    datos.forEach((usuario, index) => {
      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td>${usuario.nombre}</td>
        <td>${usuario.apellidos}</td>
        <td>${usuario.email}</td>
        <td>${usuario.edad}</td>
        <td><button class="eliminar" data-index="${index}">X</button></td>
      `;
      tbody.appendChild(fila);
    });

    document.querySelectorAll(".eliminar").forEach(boton => {
      boton.onclick = function() {
        this.closest("tr").remove();
      };
    });
  }

  renderTabla(usuarios);

  inputBuscador.addEventListener("input", function() {
    const texto = this.value.toLowerCase();

    if (texto.length < 3) {
      renderTabla(usuarios);
      return;
    }

    const filtrados = usuarios.filter(u =>
      u.nombre.toLowerCase().includes(texto) ||
      u.apellidos.toLowerCase().includes(texto)
    );

    renderTabla(filtrados);

  });

};
