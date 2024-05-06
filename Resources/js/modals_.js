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

    var viewAuthorModal = document.getElementById("viewAuthorModal");
    var viewSpans = document.querySelectorAll("#viewAuthorModal .close");

    // Ocultar el modal de vista al cargar la página
    viewAuthorModal.style.display = "none";

    // Seleccionar todos los botones que deben abrir el modal de vista
    var viewBtns = document.querySelectorAll(".action-icons a:first-child");

    // Añadir un evento de clic a cada botón para abrir el modal de vista
    viewBtns.forEach(function(viewBtn) {
        viewBtn.onclick = function(event) {
            event.preventDefault(); // Evitar la recarga de la página
            viewAuthorModal.style.display = "block";
        };
    });

    // Cerrar el modal de vista al hacer clic en el botón de cierre
    viewSpans.forEach(function(viewSpan) {
        viewSpan.onclick = function() {
            viewAuthorModal.style.display = "none";
        };
    });

    // Cerrar el modal si se hace clic fuera del contenido del modal
    window.addEventListener("click", function(event) {
        if (event.target == viewAuthorModal) {
            viewAuthorModal.style.display = "none";
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    var viewAuthorModal = document.getElementById("viewAuthorModal");
    var viewBtns = document.querySelectorAll(".action-icons a:first-child");
    var closeBtn = document.querySelector("#viewAuthorModal .close");
    
    // Capturar la información de la tabla y mostrarla en el modal
    viewBtns.forEach(function (btn) {
        btn.addEventListener("click", function (event) {
            event.preventDefault(); // Evitar el comportamiento por defecto
            
            // Obtener la fila que contiene el botón
            var row = event.target.closest("tr");
            
            // Obtener la información de la fila
            var authorName = row.children[1].textContent; // Nombre del autor
            var authorBio = row.children[2].textContent;  // Biografía
            
            // Insertar la información en el modal
            document.getElementById("authorName").textContent = authorName;
            document.getElementById("authorBio").textContent = authorBio;
            
            // Mostrar el modal
            viewAuthorModal.style.display = "block";
        });
    });
    
    // Cerrar el modal al hacer clic en el botón de cierre
    closeBtn.addEventListener("click", function () {
        viewAuthorModal.style.display = "none";
    });
    
    // Cerrar el modal si se hace clic fuera del contenido del modal
    window.addEventListener("click", function (event) {
        if (event.target == viewAuthorModal) {
            viewAuthorModal.style.display = "none";
        }
    });
});

  
