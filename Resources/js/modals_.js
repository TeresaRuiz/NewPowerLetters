document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("myModal");
    var btn = document.querySelector(".add-button");
    var span = document.querySelector("#myModal .close");

    // Ocultar el modal al cargar la página
    modal.style.display = "none";

    // Abrir el modal al hacer clic en el botón de añadir
    btn.onclick = function() {
        modal.style.display = "block";
    };

    // Cerrar el modal de añadir al hacer clic en el botón de cierre
    span.onclick = function() {
        modal.style.display = "none";
    };
});

  
