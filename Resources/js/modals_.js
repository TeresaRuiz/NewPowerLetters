var modal = document.getElementById("myModal");
var MODAL_TITLE = document.getElementById("modalTitle");
var btn = document.querySelector(".add-button");

// Ocultar el modal al cargar la página
modal.style.display = "none";

// Abrir el modal al hacer clic en el botón de añadir
function  AbrirModal() {
    modal.style.display = "block";
};

// Cerrar el modal de añadir al hacer clic en el botón de cierre
function closeModal() {
    modal.style.display = "none";
}
