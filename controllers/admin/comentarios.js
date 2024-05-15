// Constantes para completar las rutas de la API.
const COMENTARIO_API = 'services/admin/comentario.php';
// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('searchForm');
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById('tableBody');
const ROWS_FOUND = document.getElementById('rowsFound');
// Constantes para establecer los elementos del formulario de guardar.
const SAVE_FORM = document.getElementById('saveForm'),
    id_comentario = document.getElementById('id_comentario'),
    comentario = document.getElementById('comentario'),
    calificacion = document.getElementById('calificacion'),
    estadoComentario = document.getElementById('estadoComentario')
;
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
    (id_comentario.value) ? action = 'updateRow' : action = 'createRow';
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
                <td>${row.calificacion}</td>
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
        sweetAlert(4, DATA.error, true);
    }

}

const openUpdate = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_comentario', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(COMENTARIO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        id_comentario.value = ROW.id_comentario;
        usuario.value = ROW.nombre_usuario;
        calificacion.value = ROW.calificacion;
        fillSelect(COMENTARIO_API, 'getEstados', 'estadoComentario', ROW.estado_comentario);

         // Deshabilitar campos que no se pueden editar
         usuario.disabled = true;
         calificacion.disabled = true;
         
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar un comentario';
    } else {
        sweetAlert(2, DATA.error, false);
    }
}