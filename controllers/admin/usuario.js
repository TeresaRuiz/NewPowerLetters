const USUARIO_API = 'services/public/usuario.php';
const SEARCH_FORM = document.getElementById('searchForm');
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById('tableBody');
const ROWS_FOUND = document.getElementById('rowsFound');
const SAVE_FORM = document.getElementById('saveForm'),
    ID_USUARIO = document.getElementById('id_usuario'),
    ESTADO_CLIENTE = document.getElementById('estado_cliente');

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

SAVE_FORM.addEventListener('submit', async (event) => {
    event.preventDefault();
    const FORM = new FormData(SAVE_FORM);
    const DATA = await fetchData(USUARIO_API, 'updateRow', FORM);
    
    if (DATA.status) {
        closeModal();
        sweetAlert(1, DATA.message, true);
        fillTable();
    } else {
        console.error("Error: ", DATA.error);
        sweetAlert(2, DATA.error, false);
    }
});



/*
*   Función asíncrona para llenar la tabla con los registros disponibles.
*   Parámetros: form (objeto opcional con los datos de búsqueda).
*   Retorno: ninguno.
*/
const fillTable = async (form = null) => {
    // Se inicializa el contenido de la tabla.
    ROWS_FOUND.textContent = '';
    TABLE_BODY.innerHTML = '';
    // Se verifica la acción a realizar.
    (form) ? action = 'searchRows' : action = 'readAll';
    // Petición para obtener los registros disponibles.
    const DATA = await fetchData(USUARIO_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se recorre el conjunto de registros fila por fila.
        DATA.dataset.forEach(row => {

            // Determinar el icono y el color según el estado del usuario.
            const estadoIcono = row.estado_cliente == 1
                ? '<i class="ri-checkbox-circle-fill" style="color: green"></i> Activo'
                : '<i class="ri-close-circle-fill" style="color: red"></i> Inactivo';

            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
            <tr>
            <td><img src="${SERVER_URL}images/usuarios/default.png" width="50"></td>
                <td>${row.nombre}</td>
                <td>${row.nombre_usuario}</td>
                <td>${row.correo}</td>
                <td>${row.direccion}</td>
                <td>${row.telefono}</td>
                <td>${estadoIcono}</td>
                <td>${row.fecha_registro}</td>
                <td class="action-icons">
                    <a onclick="openUpdate(${row.id_usuario})">
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
    const FORM = new FormData();
    FORM.append('id_usuario', id);
    const DATA = await fetchData(USUARIO_API, 'readOne', FORM);
    
    if (DATA.status) {
        const ROW = DATA.dataset;
        ID_USUARIO.value = ROW.id_usuario;
        ESTADO_CLIENTE.value = ROW.estado_cliente;
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar estado del usuario';
    } else {
        sweetAlert(2, DATA.exception, false);
    }
};


