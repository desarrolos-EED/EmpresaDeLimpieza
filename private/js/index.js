function includeHTML(containerId, filePath) {
  fetch(filePath)
    .then((response) => response.text())
    .then((html) => {
      document.getElementById(containerId).innerHTML = html;
    });
}

// Cargar el header y el footer
const BASE_PATH = "./view/partials/";

includeHTML("header-container", `${BASE_PATH}header.html`);
includeHTML("footer-container", `${BASE_PATH}footer.html`);

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
