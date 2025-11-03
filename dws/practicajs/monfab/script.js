const elementos = [
  { elemento: "Teclado", descripcion: "Teclado mecánico retroiluminado", categoria: "Periféricos", precio: 45 },
  { elemento: "Ratón", descripcion: "Ratón inalámbrico ergonómico", categoria: "Periféricos", precio: 25 },
  { elemento: "Monitor", descripcion: "Monitor 24'' Full HD", categoria: "Pantallas", precio: 120 },
  { elemento: "Portátil", descripcion: "Portátil con 16 GB RAM", categoria: "Equipos", precio: 950 },
  { elemento: "Auriculares", descripcion: "Auriculares con micrófono", categoria: "Audio", precio: 30 }
];

window.onload = () => {
  const tablaBody = document.querySelector("#tabla-elementos tbody");
  const inputFiltro = document.getElementById("filtro");

  
  function renderTabla(datos) {
    tablaBody.innerHTML = ""; // limpiar
    datos.forEach(item => {
      const fila = document.createElement("tr");

      fila.innerHTML = `
        <td>${item.elemento}</td>
        <td>${item.descripcion}</td>
        <td>${item.categoria}</td>
        <td>${item.precio}</td>
        <td><button class="btn-eliminar">X</button></td>
      `;

    
      fila.querySelector(".btn-eliminar").onclick = () => fila.remove();

      tablaBody.appendChild(fila);
    });
  }

  
  renderTabla(elementos);


  inputFiltro.addEventListener("input", () => {
    const texto = inputFiltro.value.toLowerCase();

    if (texto.length < 3) {
      renderTabla(elementos); 
      return;
    }

    const filtrados = elementos.filter(e =>
      e.elemento.toLowerCase().includes(texto) ||
      e.descripcion.toLowerCase().includes(texto)
    );
    renderTabla(filtrados);
    
    tablaBody.querySelectorAll("tr").forEach(fila => fila.classList.add("resaltado"));
  });
};
