// Constante para completar la ruta de la API.
const LIBROS_API = 'services/public/libros.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const LIBROS = document.getElementById('libros');
// Constante para establecer el formulario de agregar un producto al carrito de compras.
const SHOPPING_FORM = document.getElementById('shoppingForm');


// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Se define un objeto con los datos de la categoría seleccionada.
    const FORM = new FormData();
    FORM.append('idLibro', PARAMS.get('id'));
    // Petición para solicitar los productos de la categoría seleccionada.
    const DATA = await fetchData(LIBROS_API, 'readOne', FORM);
    console.log(DATA)
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Actualizar los elementos del HTML con la información del libro
        document.getElementById('tituloDetalle').textContent = DATA.dataset.titulo_libro;
        document.querySelector('#ImagenDetalle').src = `${SERVER_URL}images/libros/${DATA.dataset.imagen}`;
        document.getElementById('precioDetalle').textContent = `$${DATA.dataset.precio}`;
        document.getElementById('descripcionDetalle').textContent = DATA.dataset.descripcion_libro;
        document.getElementById('autorDetalle').textContent = DATA.dataset.nombre_autor;
        document.getElementById('clasificacionDetalle').textContent = DATA.dataset.nombre_clasificacion;
        document.getElementById('editorialDetalle').textContent = DATA.dataset.nombre_editorial;
        document.getElementById('existenciasProducto').textContent = DATA.dataset.existencias;
    }
    else {
        // Se presenta un mensaje de error cuando no existen datos para mostrar.
        console.log(DATA.error);
    }
});


// Método del evento para cuando se envía el formulario de agregar un producto al carrito.
SHOPPING_FORM.addEventListener('submit', async (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SHOPPING_FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(PEDIDO_API, 'createDetail', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se constata si el cliente ha iniciado sesión.
    if (DATA.status) {
        sweetAlert(1, DATA.message, false, 'carrito.html');
    } else if (DATA.session) {
        sweetAlert(2, DATA.error, false);
    } else {
        sweetAlert(3, DATA.error, true, 'index.html');
    }
});
