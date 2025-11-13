function includeHTML(containerId, filePath) {
  fetch(filePath)
    .then((response) => response.text())
    .then((html) => {
      document.getElementById(containerId).innerHTML = html;
    });
}

// Cargar el header y el footer
includeHTML("header-container", "../view/partials/header.html");
includeHTML("footer-container", "../view/partials/footer.html");

const acordeon = document.getElementsByClassName("contenedor");

for (const item of acordeon) {
    item.addEventListener("click", function () {
        if (this.classList.contains("activa")) {
            // If the clicked element already has "activa", remove it
            this.classList.remove("activa");
        } else {
            // Remove "activa" class from all elements
            Array.from(acordeon).forEach((el) => el.classList.remove("activa"));
            // Add "activa" class to the clicked element
            this.classList.add("activa");
            this.scrollIntoView({ 
                //behavior: "smooth", 
                block: "center" });
        }
    });
}

// Manejo de mensajes de éxito o error en el envío de reseñas
function obtenerParametros() {
    // 1. Obtener la URL actual
    const url = new URL(window.location.href);
    
    // 2. Crear un objeto URLSearchParams a partir de la query string
    const params = new URLSearchParams(url.search);

    const parametrosCapturados = {};

    // 3. Iterar sobre todos los parámetros y guardarlos
    for (const [key, value] of params.entries()) {
        parametrosCapturados[key] = value;
    }

    return parametrosCapturados;
}

const misParametros = obtenerParametros();

if (misParametros.success) {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Your review has been sent successfully.'
    });
}else{
    if (misParametros.error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'There was an error sending your review. Please try again.'
        });
    }
}
