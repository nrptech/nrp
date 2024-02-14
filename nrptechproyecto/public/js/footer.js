"use strict";

document.addEventListener("DOMContentLoaded", function () {
  let headers = document.querySelectorAll("footer h3");

  headers.forEach(function (header) {
    header.addEventListener("click", function () {
      // Muestra u oculta la lista asociada al h3 clickeado
      let list = this.nextElementSibling;
      let computedStyle = window.getComputedStyle(list);

      if (computedStyle.display === "none") {
        list.style.display = "block";
      } else {
        list.style.display = "none";
      }
    });

    // Agrega la propiedad cursor:pointer al h3 para que se muestre la manita
    header.style.cursor = "pointer";
  });
});

// Ajusta el estilo para móviles usando media queries
let style = document.createElement("style");
style.innerHTML = `
  @media (max-width: 768px) {
    footer ul {
      display: none;
    }
  }
`;
document.head.appendChild(style);
