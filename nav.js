document.addEventListener('DOMContentLoaded', function () {
    fetch('nav.html')
        .then(response => response.text())
        .then(data => {
            document.body.insertAdjacentHTML('afterbegin', data);

            // Identificar ruta actual y aplicar estilo
            // Obtenemos el nombre del archivo actual (ej: html1.html)
            const path = window.location.pathname;
            const page = path.split("/").pop();

            const links = document.querySelectorAll('nav ul li a');

            links.forEach(link => {
                const href = link.getAttribute('href');
                if (href === page || (page === '' && href === 'html1.html')) {
                    link.style.fontWeight = 'bold';
                    link.style.color = '#000';
                    link.style.borderBottom = '2px solid #3366cc';
                }
            });
        })
        .catch(error => console.error('Error cargando el navbar:', error));
});
