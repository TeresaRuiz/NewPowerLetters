document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none"; // Oculta el modal al cargar la página
});

// Obtener el modal
var modal = document.getElementById("myModal");

// Obtener el botón que abre el modal
var btn = document.querySelector(".add-button");

// Obtener el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando se hace clic en el botón, abrir el modal
btn.onclick = function () {
    modal.style.display = "block";
}

// Cuando se hace clic en <span> (x), cerrar el modal
span.onclick = function () {
    modal.style.display = "none";
}

// Cuando el usuario hace clic en cualquier lugar fuera del botón y del modal, cerrarlo
window.onclick = function (event) {
    if (event.target !== btn && event.target !== modal) {
        modal.style.display = "none";
    }
}
