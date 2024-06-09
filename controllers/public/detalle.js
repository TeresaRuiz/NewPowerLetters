// Constante para completar la ruta de la API.
const LIBROS_API = 'services/public/libros.php';
const PEDIDO_API = 'services/public/pedido.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const LIBROS = document.getElementById('libros');
// Constante para establecer el formulario de agregar un producto al carrito de compras.
const SHOPPING_FORM = document.getElementById('shoppingForm');

document.addEventListener('DOMContentLoaded', async () => {
    const FORM = new FormData();
    FORM.append('idLibro', PARAMS.get('id'));
    const DATA = await fetchData(LIBROS_API, 'readOne', FORM);
    console.log(DATA);
    if (DATA.status) {
        document.getElementById('idLibro').value = DATA.dataset.id_libro;
        document.getElementById('tituloDetalle').textContent = DATA.dataset.titulo_libro;
        document.querySelector('#ImagenDetalle').src = `${SERVER_URL}images/libros/${DATA.dataset.imagen}`;
        document.getElementById('precioDetalle').textContent = `$${DATA.dataset.precio}`;
        document.getElementById('descripcionDetalle').textContent = DATA.dataset.descripcion_libro;
        document.getElementById('autorDetalle').textContent = DATA.dataset.nombre_autor;
        document.getElementById('clasificacionDetalle').textContent = DATA.dataset.nombre_clasificacion;
        document.getElementById('editorialDetalle').textContent = DATA.dataset.nombre_editorial;
        document.getElementById('existenciasProducto').textContent = DATA.dataset.existencias;
        document.getElementById('existenciasProducto').setAttribute('data-existencias', DATA.dataset.existencias);
    } else {
        console.log(DATA.error);
    }

    // Event listener para actualizar existencias al cambiar la cantidad solicitada
    const cantidadInput = document.getElementById('cantidadLibro');
    cantidadInput.addEventListener('input', () => {
        const existencias = parseInt(document.getElementById('existenciasProducto').getAttribute('data-existencias'), 10);
        const cantidadSolicitada = parseInt(cantidadInput.value, 10) || 0;

        if (cantidadSolicitada <= existencias) {
            document.getElementById('existenciasProducto').textContent = existencias - cantidadSolicitada;
        } else {
            document.getElementById('existenciasProducto').textContent = existencias;
        }
    });
});

document.addEventListener('DOMContentLoaded', (event) => {
    const redirectButton = document.getElementById('redirectButton');
    redirectButton.addEventListener('click', () => {
        window.location.href = 'descuento.html';
    });
});

SHOPPING_FORM.addEventListener('submit', async (event) => {
    event.preventDefault();
    const FORM = new FormData(SHOPPING_FORM);
    const existencias = parseInt(document.getElementById('existenciasProducto').getAttribute('data-existencias'), 10);
    const cantidadSolicitada = parseInt(FORM.get('cantidadLibro'), 10);

    if (cantidadSolicitada > existencias) {
        await sweetAlert(2, `No puedes solicitar ${cantidadSolicitada} unidades. Solo hay ${existencias} disponibles.`, false);
        return;
    }

    const DATA = await fetchData(PEDIDO_API, 'createDetail', FORM);
    console.log(DATA);
    if (DATA.status) {
        await sweetAlert(1, DATA.message, false, 'carrito.html');
    } else if (DATA.session) {
        await sweetAlert(2, DATA.error, false);
    } else {
        await sweetAlert(3, DATA.error, true, 'index.html');
    }
    console.log(DATA);
});
