var modal = document.getElementById("myModal");
var modal_ = document.getElementById("myModalView");
var MODAL_TITLE = document.getElementById("modalTitle");
var btn = document.querySelector(".add-button");

// Ocultar el modal al cargar la página
modal.style.display = "none";
// Ocultar el modal al cargar la página
modal_.style.display = "none";

// Abrir el modal al hacer click en el botón de añadir
function  AbrirModal() {
    modal.style.display = "block";
};

function  AbrirModalVista() {
    modal_.style.display = "block";
};

// Cerrar el modal de añadir al hacer click en el botón de cierre
function closeModal() {
    modal.style.display = "none";
}
function closeModalDetalles() {
    modal_.style.display = "none";
}