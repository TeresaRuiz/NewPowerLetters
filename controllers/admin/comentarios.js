// URL de la API para gestionar los comentarios.
const COMENTARIO_API = 'services/admin/comentario.php';

// Elementos del DOM utilizados en el script.
const SEARCH_FORM = document.getElementById('searchForm'); // Formulario de búsqueda.
const TABLE_BODY = document.getElementById('tableBody'); // Cuerpo de la tabla donde se mostrarán los comentarios.
const ROWS_FOUND = document.getElementById('rowsFound'); // Elemento donde se mostrará la cantidad de filas encontradas.

// Elementos del formulario para guardar un comentario.
const SAVE_FORM = document.getElementById('saveForm'), // Formulario para guardar un comentario.
    id_comentario = document.getElementById('id_comentario'), // Campo de entrada para el ID del comentario.
    comentario = document.getElementById('comentario'), // Campo de entrada para el contenido del comentario.
    calificacion = document.getElementById('calificacion'), // Campo de entrada para la calificación del comentario.
    estadoComentario = document.getElementById('estadoComentario'); // Campo de entrada para el estado del comentario.

// Event listener que se ejecuta cuando el contenido del DOM ha sido completamente cargado.
document.addEventListener('DOMContentLoaded', () => {
    fillTable(); // Llama a la función fillTable para llenar la tabla con los comentarios.
});

// Método del evento para cuando se envía el formulario de búsqueda.
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
    const action = (id_comentario.value) ? 'updateRow' : 'createRow';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(COMENTARIO_API, action, FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se cierra la caja de diálogo.
        closeModal();
        // Se muestra un mensaje de éxito.
        sweetAlert(1, DATA.message, true);
        // Se carga nuevamente la tabla para visualizar los cambios.
        fillTable();
    } else {
        // Se muestra un mensaje de error.
        sweetAlert(2, DATA.error, false);
    }
});

// Función para llenar la tabla con los datos.
const fillTable = async (form = null) => {
    // Se inicializa el contenido de la tabla.
    ROWS_FOUND.textContent = '';
    TABLE_BODY.innerHTML = '';
    // Se verifica la acción a realizar.
    const action = (form) ? 'searchRows' : 'readAll';
    // Petición para obtener los registros disponibles.
    const DATA = await fetchData(COMENTARIO_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se recorre el conjunto de registros fila por fila.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
            <tr>
                <td>${row.comentario}</td>
                <td>${row.nombre_usuario}</td>
                <td>${getStarsHTML(row.calificacion)}</td>
                <td>
                    <div>
                        ${row.estado_comentario}
                    </div>
                </td>
                <td class="action-icons">
                    <a onclick="viewDetails(${row.id_comentario})">
                        <i class="ri-eye-fill"></i>
                    </a>
                    <a onclick="openUpdate(${row.id_comentario})">
                        <i class="ri-edit-line"></i>
                    </a>
                </td>
            </tr>
            `;
        });
        // Se muestra un mensaje de acuerdo con el resultado.
        ROWS_FOUND.textContent = DATA.message;
    } else {
        // Se muestra un mensaje de error.
        sweetAlert(4, DATA.error, true);
    }
}

// Función para obtener el HTML de las estrellas basado en la calificación.
const getStarsHTML = (rating) => {
    let starsHTML = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            starsHTML += '<span class="fa fa-star checked"></span>';
        } else {
            starsHTML += '<span class="fa fa-star"></span>';
        }
    }
    return starsHTML;
}

// Función para abrir el modal de actualización con los datos del comentario.
const openUpdate = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_comentario', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(COMENTARIO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        const ROW = DATA.dataset;
        id_comentario.value = ROW.id_comentario;
        comentario.value = ROW.comentario;
        document.getElementById('calificacionContainer').innerHTML = getStarsHTML(ROW.calificacion);
        fillSelect(COMENTARIO_API, 'getEstados', 'estadoComentario', ROW.estado_comentario);
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar un comentario';
    } else {
        // Se muestra un mensaje de error.
        sweetAlert(2, DATA.error, false);
    }
}

// Función para ver los detalles del comentario.
const viewDetails = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_comentario', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(COMENTARIO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        AbrirModalVista();
        MODAL_TITLE.textContent = 'Detalle del comentario';
        // Actualizar los elementos del modal con la información del comentario.
        document.getElementById('tituloVista').innerText = ROW.titulo;
        document.getElementById('vista').src = `${SERVER_URL}images/libros/${ROW.imagen}`;
        document.getElementById('Cliente').innerText = ROW.nombre_usuario;
        document.getElementById('calificacionContainerView').innerHTML = getStarsHTML(ROW.calificacion);
        document.getElementById('Comentario').innerText = ROW.comentario;
        document.getElementById('Estado').innerText = ROW.estado_comentario;
    } else {
        // Se muestra un mensaje de error.
        sweetAlert(2, DATA.error, false);
    }
}