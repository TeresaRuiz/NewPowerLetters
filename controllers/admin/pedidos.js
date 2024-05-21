// Constantes para completar las rutas de la API.
const PEDIDO_API = 'services/admin/pedido.php';
// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('searchForm');
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById('tableBody');
const ROWS_FOUND = document.getElementById('rowsFound');
// Constantes para establecer los elementos del formulario de guardar.
const SAVE_FORM = document.getElementById('saveForm'),
    id_pedido = document.getElementById('id_pedido'),
    usuario = document.getElementById('usuario'),
    direccion = document.getElementById('direccion'),
    estadoPedido = document.getElementById('estadoPedido'),
    fecha = document.getElementById('fecha'),
    Detalle = document.getElementById('detalle');

// Método del evento para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    // Llamada a la función para llenar la tabla con los registros existentes.
    fillTable();
});

// Método del evento para cuando se envía el formulario de buscar.
SEARCH_FORM.addEventListener('submit', (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SEARCH_FORM);
    // Llamada a la función para llenar la tabla con los resultados de la búsqueda.
    fillTable(FORM);
});

// Método del evento para cuando se envía el formulario de guardar.
SAVE_FORM.addEventListener('submit', async (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se verifica la acción a realizar.
    (id_pedido.value) ? action = 'updateRow' : action = 'createRow';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(PEDIDO_API, action, FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se cierra la caja de diálogo.
        closeModal();
        // Se muestra un mensaje de éxito.
        sweetAlert(1, DATA.message, true);
        // Se carga nuevamente la tabla para visualizar los cambios.
        fillTable();
    } else {
        sweetAlert(2, DATA.error, false);
    }
});

const fillTable = async (form = null) => {
    // Se inicializa el contenido de la tabla.
    ROWS_FOUND.textContent = '';
    TABLE_BODY.innerHTML = '';
    // Se verifica la acción a realizar.
    (form) ? action = 'searchRows' : action = 'readAll';
    // Petición para obtener los registros disponibles.
    const DATA = await fetchData(PEDIDO_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se recorre el conjunto de registros fila por fila.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
            <tr>
                <td>${row.fecha_pedido}</td>
                <td>${row.direccion_pedido}</td>
                <td>${row.nombre_usuario}</td>
                <td>
                    <div>
                        ${row.estado}
                    </div>
                </td>
                <td class="action-icons">
                    <a onclick="viewDetails(${row.id_pedido})">
                    <i class="ri-eye-fill"></i>
                    </a>
                    <a onclick="openUpdate(${row.id_pedido})">
                    <i class="ri-edit-line"></i>
                    </a>
                </td>
            </tr>
            `;
        });
        // Se muestra un mensaje de acuerdo con el resultado.
        ROWS_FOUND.textContent = DATA.message;
    } else {
        sweetAlert(4, DATA.error, true);
    }

}

const openUpdate = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_pedido', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(PEDIDO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        id_pedido.value = ROW.id_pedido;
        usuario.value = ROW.nombre_usuario;
        direccion.value = ROW.direccion_pedido;
        fillSelect(PEDIDO_API, 'getEstados', 'estadoPedido', ROW.estado);
        fecha.value = ROW.fecha_pedido;

        // Deshabilitar campos que no se pueden editar
        usuario.disabled = true;
        fecha.disabled = true;

        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar un pedido';
    } else {
        sweetAlert(2, DATA.error, false);
    }
}

const viewDetails = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_pedido', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(PEDIDO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        AbrirModalVista();
        MODAL_TITLE.textContent = 'Detalle del pedido';
        // Actualizar los elementos del modal con la información del libro
        document.getElementById('tituloVista').innerText = ROW.titulo;
        document.getElementById('vista').src = `${SERVER_URL}images/libros/${ROW.imagen_libro}`;
        document.getElementById('Cantidad').innerText = ROW.cantidad;
        document.getElementById('Comentario').innerText = ROW.comentario;
        document.getElementById('Cliente').innerText = ROW.nombre_usuario;
        document.getElementById('direccionPedido').innerText = ROW.direccion_pedido;
        document.getElementById('Estado').innerText = ROW.estado;
        document.getElementById('Fecha').innerText = ROW.fecha_pedido;
    } else {
        sweetAlert(2, DATA.error, false);
    }
}