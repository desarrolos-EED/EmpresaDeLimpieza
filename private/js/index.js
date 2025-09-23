function includeHTML(containerId, filePath) {
    fetch(filePath)
      .then((response) => response.text())
      .then((html) => {
        document.getElementById(containerId).innerHTML = html;
      });
  }

  // Cargar el header y el footer
  includeHTML("header-container", "./view/partials/header.html");
  includeHTML("footer-container", "view/partials/footer.html");

  document.addEventListener('DOMContentLoaded', () => {
    // Selecciona todos los botones que actúan como títulos de sección
    const titulos = document.querySelectorAll('.acordeon .titulo');

    // Itera sobre cada título para añadir un "escuchador de eventos"
    titulos.forEach(titulo => {
        titulo.addEventListener('click', () => {
            // El elemento de contenido es el siguiente hermano del botón
            const contenido = titulo.nextElementSibling;
            
            // Cierra todos los demás paneles que estén activos
            document.querySelectorAll('.acordeon .titulo.activo').forEach(activeTitulo => {
                if (activeTitulo !== titulo) {
                    activeTitulo.classList.remove('activo');
                    activeTitulo.nextElementSibling.classList.remove('desplegado');
                }
            });

            // Alterna la clase 'activo' en el título que se ha clicado
            titulo.classList.toggle('activo');
            
            // Alterna la clase 'desplegado' en el contenido asociado
            // Esto activa o desactiva la animación CSS de mostrar/ocultar
            contenido.classList.toggle('desplegado');
        });
    });
});