"use strict"

document.addEventListener('DOMContentLoaded', function() {
    // Obtén todas las etiquetas h3 dentro de la clase "footer"
    let headers = document.querySelectorAll('.footer h3');

    // Agrega un evento clic a cada encabezado
    headers.forEach(function(header) {
        header.addEventListener('click', function() {
            // Obtiene la lista ul asociada con el encabezado
            let list = header.nextElementSibling;

            // Alternar la clase 'show' para mostrar u ocultar la lista
            list.classList.toggle('show');
        });
    });

    // Agregar un manejador de eventos para cerrar la lista si se hace clic fuera de ella
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.footer')) {
            // Si se hace clic fuera del área del pie de página, oculta todas las listas
            headers.forEach(function(header) {
                let list = header.nextElementSibling;
                list.classList.remove('show');
            });
        }
    });
});
