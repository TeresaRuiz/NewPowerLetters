// Constantes para completar la ruta de la API.
const LIBROS_API = 'services/public/libros.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
// Constante para establecer el formulario de agregar un producto al carrito de compras.
const SHOPPING_FORM = document.getElementById('shoppingForm');

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Se define un objeto con los datos de la categoría seleccionada.
    const FORM = new FormData();
    FORM.append('libros', PARAMS.get('id'));
    // Petición para solicitar los productos de la categoría seleccionada.
    const DATA = await fetchData(LIBROS_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
            // Actualizar los elementos del HTML con la información del libro
            document.getElementById('tituloVista').textContent = DATA.dataset.titulo_libro;
            document.querySelector('.book-detail__img').src = `../../resources/img/${DATA.dataset.imagen}`;
            document.getElementById('precioVista').textContent = `$${DATA.dataset.precio}`;
            document.getElementById('descripcionVista').textContent = DATA.dataset.descripcion_libro;
            document.getElementById('autorVista').textContent = DATA.dataset.nombre_autor;
            document.getElementById('clasificacionVista').textContent = DATA.dataset.nombre_clasificacion;
            document.getElementById('editorialVista').textContent = DATA.dataset.nombre_editorial;
        }
     else {
        // Se presenta un mensaje de error cuando no existen datos para mostrar.
        console.log (DATA.error);
    }
});
