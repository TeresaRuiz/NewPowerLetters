// Se establece la ruta de la API para interactuar con los usuarios.
const USUARIO_API = 'services/public/usuario.php';

// Se obtienen referencias a los elementos del DOM necesarios.
const SEARCH_FORM = document.getElementById('searchForm'); // Formulario de búsqueda.
const TABLE_BODY = document.getElementById('tableBody'); // Cuerpo de la tabla.
const ROWS_FOUND = document.getElementById('rowsFound'); // Elemento para mostrar el número de filas encontradas.
const SAVE_FORM = document.getElementById('saveForm'); // Formulario de guardado.
const ID_USUARIO = document.getElementById('id_usuario'); // Campo oculto para el ID del usuario.
const ESTADO_CLIENTE = document.getElementById('estado_cliente'); // Campo para el estado del cliente.

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
    // Se crea un objeto FormData con los datos del formulario de guardado.
    const FORM = new FormData(SAVE_FORM);
    // Se realiza una petición para actualizar el registro del usuario.
    const DATA = await fetchData(USUARIO_API, 'updateRow', FORM);

    // Se comprueba si la respuesta es satisfactoria.
    if (DATA.status) {
        // Se cierra el modal de guardado.
        closeModal();
        // Se muestra un mensaje de éxito.
        sweetAlert(1, DATA.message, true);
        // Se vuelve a llenar la tabla para mostrar los cambios.
        fillTable();
    } else {
        // Si hay un error, se muestra en la consola y como alerta.
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
    // Se inicializa el contenido de la tabla y el contador de filas encontradas.
    ROWS_FOUND.textContent = '';
    TABLE_BODY.innerHTML = '';
    // Se determina la acción a realizar: buscar o leer todos los registros.
    const action = (form) ? 'searchRows' : 'readAll';
    // Se realiza una petición para obtener los registros de usuarios.
    const DATA = await fetchData(USUARIO_API, action, form);

    // Se verifica si la respuesta fue exitosa.
    if (DATA.status) {
        // Se recorren los registros y se generan las filas de la tabla.
        DATA.dataset.forEach(row => {

            // Determinar el icono y el color según el estado del usuario.
            const estadoIcono = row.estado_cliente == 1
                ? '<i class="ri-checkbox-circle-fill" style="color: green"></i> Activo'
                : '<i class="ri-close-circle-fill" style="color: red"></i> Inactivo';

            // Se crea y concatena una fila de la tabla por cada registro.
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
        // Se muestra un mensaje con el número de filas encontradas.
        ROWS_FOUND.textContent = DATA.message;
    } else {
        // Si hubo un error, se muestra en la consola y como alerta.
        sweetAlert(4, DATA.error, true);
    }
}

/*
*   Función para abrir el formulario de actualización de estado del usuario.
*   Parámetros: id (identificador del usuario).
*   Retorno: ninguno.
*/
const openUpdate = async (id) => {
    // Se crea un objeto FormData con el ID del usuario.
    const FORM = new FormData();
    FORM.append('id_usuario', id);
    // Se realiza una petición para obtener los datos del usuario seleccionado.
    const DATA = await fetchData(USUARIO_API, 'readOne', FORM);

    // Se verifica si la respuesta fue exitosa.
    if (DATA.status) {
        // Se obtienen los datos del usuario y se actualizan en el formulario de actualización.
        const ROW = DATA.dataset;
        ID_USUARIO.value = ROW.id_usuario;
        ESTADO_CLIENTE.value = ROW.estado_cliente;
        // Se abre el modal de actualización de estado.
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar estado del usuario';
    } else {
        // Si hubo un error, se muestra en la consola y como alerta.
        sweetAlert(2, DATA.exception, false);
    }
}