// Constante para completar la ruta de la API en descuentos.
const LIBROS_API = 'services/public/libros.php';
const PEDIDO_API = 'services/public/pedido.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const LIBROS = document.getElementById('libros');
// Constante para establecer el formulario de agregar un producto al carrito de compras.
const SHOPPING_FORM = document.getElementById('shoppingForm');

// Evento que se dispara cuando el DOM ha sido completamente cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Crear un objeto FormData y agregar el parámetro 'idLibro' obtenido de la URL.
    const FORM = new FormData();
    FORM.append('idLibro', PARAMS.get('id'));

    // Hacer una petición a la API para obtener los detalles de un libro específico.
    const DATA = await fetchData(LIBROS_API, 'readOne', FORM);
    console.log(DATA);

    if (DATA.status) {
        // Si la petición fue exitosa, actualizar los elementos del DOM con la información del libro.
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
        // Si la petición no fue exitosa, imprimir el error en la consola.
        console.log(DATA.error);
    }

    // Obtener el elemento del DOM que corresponde al input de cantidad de libros.
    const cantidadInput = document.getElementById('cantidadLibro');

    // Agregar un evento para actualizar las existencias disponibles en tiempo real según la cantidad solicitada.
    cantidadInput.addEventListener('input', () => {
        // Obtener las existencias disponibles y la cantidad solicitada.
        const existencias = parseInt(document.getElementById('existenciasProducto').getAttribute('data-existencias'), 10);
        const cantidadSolicitada = parseInt(cantidadInput.value, 10) || 0;

        // Actualizar el texto de existencias dependiendo de la cantidad solicitada.
        if (cantidadSolicitada <= existencias) {
            document.getElementById('existenciasProducto').textContent = existencias - cantidadSolicitada;
        } else {
            document.getElementById('existenciasProducto').textContent = existencias;
        }
    });
});

// Evento que se dispara cuando el DOM ha sido completamente cargado (otra instancia del mismo evento).
document.addEventListener('DOMContentLoaded', (event) => {
    // Obtener el botón de redirección y agregar un evento de click para redirigir a la página de descuento.
    const redirectButton = document.getElementById('redirectButton');
    redirectButton.addEventListener('click', () => {
        window.location.href = 'descuento.html';
    });
});

// Evento que se dispara cuando se envía el formulario de agregar al carrito.
SHOPPING_FORM.addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevenir el envío del formulario por defecto.
    const FORM = new FormData(SHOPPING_FORM); // Crear un objeto FormData con los datos del formulario.
    const existencias = parseInt(document.getElementById('existenciasProducto').getAttribute('data-existencias'), 10);
    const cantidadSolicitada = parseInt(FORM.get('cantidadLibro'), 10);

    // Verificar si la cantidad solicitada excede las existencias disponibles.
    if (cantidadSolicitada > existencias) {
        await sweetAlert(2, `No puedes solicitar ${cantidadSolicitada} unidades. Solo hay ${existencias} disponibles.`, false);
        return; // Salir de la función si no hay suficientes existencias.
    }

    // Enviar actualización de existencias al servidor.
    const updateForm = new FormData();
    updateForm.append('idLibro', PARAMS.get('id'));
    updateForm.append('cantidad', cantidadSolicitada);

    const updateResponse = await fetchData(LIBROS_API, 'updateExistencias', updateForm);
    if (!updateResponse.status) {
        console.log(updateResponse.error);
        return; // Salir de la función si la actualización de existencias falla.
    }

    // Si la actualización de existencias fue exitosa, proceder a crear el detalle del pedido.
    const DATA = await fetchData(PEDIDO_API, 'createDetail', FORM);
    console.log(DATA);
    if (DATA.status) {
        await sweetAlert(1, DATA.message, false, 'carrito.html'); // Redirigir al carrito si la operación fue exitosa.
    } else if (DATA.session) {
        await sweetAlert(2, DATA.error, false); // Mostrar error si hay problema de sesión.
    } else {
        await sweetAlert(3, DATA.error, true, 'index.html'); // Redirigir al inicio si hay un error crítico.
    }
    console.log(DATA);
});
