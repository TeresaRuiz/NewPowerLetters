// Constante para completar la ruta de la API.
const LIBROS_API = 'services/public/libros.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const LIBROS = document.getElementById('libros');

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Se define un objeto con los datos de la categoría seleccionada.
    const FORM = new FormData();
    FORM.append('idClas', PARAMS.get('id'));
    // Petición para solicitar los productos de la categoría seleccionada.
    const DATA = await fetchData(LIBROS_API, 'readLibrosGeneros', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializa el contenedor de productos.
        LIBROS.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las tarjetas con los datos de cada producto.
            LIBROS.innerHTML += `
                <article class="featured__card  swiper-slide">
                    <img src="${SERVER_URL}images/libros/${row.imagen}" class="card-img-top" alt="${row.titulo_libro}">
                    <h2 class="featured__title">${row.titulo_libro}</h2>
                    <div class="featured__prices">
                        <span class="featured__discount"> ${row.precio}</span>
                    </div>
                    <buttton class="button">Añadir al carrito</buttton>
                    <div class="featured__actions">
                        <button><i class="ri-search-line"></i></button>
                        <button><i class="ri-heart-3-line"></i></button>
                        <a href="detalle_libro.html?id=${row.id_libro}"><button><i class="ri-eye-line"></i></button></a>
                    </div>
                </article>
            `;
        });
    } else {
        // Se presenta un mensaje de error cuando no existen datos para mostrar.
        console.log(DATA.error);
    }
});
