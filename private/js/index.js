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

const acordeon = document.getElementsByClassName("contenedor");

for (let i = 0; i < acordeon.length; i++) {
    acordeon[i].addEventListener("click", function () {
        if (this.classList.contains("activa")) {
            // If the clicked element already has "activa", remove it
            this.classList.remove("activa");
        } else {
            // Remove "activa" class from all elements
            for (let j = 0; j < acordeon.length; j++) {
                acordeon[j].classList.remove("activa");
            }
            // Add "activa" class to the clicked element
            this.classList.add("activa");
        }
    });
}
