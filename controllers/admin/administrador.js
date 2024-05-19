// Constante para completar la ruta de la API.
const ADMINISTRADOR_API_API = 'services/admin/administrador.php';
// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('searchForm');
// Constantes para establecer los elementos de la tabla.
const TABLE_BODY = document.getElementById('tableBody'),
    ROWS_FOUND = document.getElementById('rowsFound');
// Constantes para establecer los elementos del componente Modal.
const SAVE_FORM = document.getElementById('saveForm'),
    // Constantes para establecer los elementos del formulario de guardar.
    ID_ADMINISTRADOR = document.getElementById('idAdministrador'),
    NOMBRE_ADMINISTRADOR = document.getElementById('nombreAdministrador'),
    USUARIO_ADMINISTRADOR = document.getElementById('UsuarioAdministrador'),
    CORREO_ADMINISTRADOR = document.getElementById('correoAdministrador'),
    CLAVE_ADMINISTRADOR = document.getElementById('claveAdministrador'),
    CONFIRMAR_CLAVE = document.getElementById('confirmarClave');
    TELEFONO_ADMINISTRADOR = document.getElementById('telefono'),
    IMG_ADMINISTRADOR = document.getElementById('imagen');
// Se establece el título de la página web.
document.querySelector('title').textContent = 'Clasificación de libros';

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
    (ID_autor.value) ? action = 'updateRow' : action = 'createRow';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(ADMINISTRADOR_API_API, action, FORM);
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
    const DATA = await fetchData(ADMINISTRADOR_API_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se recorre el conjunto de registros fila por fila.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
                <tr>

                    <td>${row.nombre_administrador}</td>
                    <td>${row.user_administrador}</td>
                    <td>${row.correo_administrador}</td>
                    <td>${row.telefono_adm}</td>
                    <td>${row.imagen}</td>
                    <td>
                        <button type="button" class="btn btn-info" onclick="openUpdate(${row.id_administrador})">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="openDelete(${row.id_administrador})">
                            <i class="bi bi-trash-fill"></i>
                        </button>
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

/*
*   Función para preparar el formulario al momento de insertar un registro.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const openCreate = () => {
    // Se muestra la caja de diálogo con su título.
    //SAVE_MODAL.show();
    modal.style.display = "block";
    MODAL_TITLE.textContent = 'Agregar un nuevo autor';
    // Se prepara el formulario.
    SAVE_FORM.reset();
}

/*
*   Función asíncrona para preparar el formulario al momento de actualizar un registro.
*   Parámetros: id (identificador del registro seleccionado).
*   Retorno: ninguno.
*/
const openUpdate = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('idAdministrador', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(ADMINISTRADOR_API_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {

         // Se prepara el formulario.
         SAVE_FORM.reset();
         USUARIO_ADMINISTRADOR.disabled = true;
         CLAVE_ADMINISTRADOR.disabled = true;
         CONFIRMAR_CLAVE.disabled = true;
        
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        ID_ADMINISTRADOR.value = ROW.id_administrador;
        NOMBRE_ADMINISTRADOR.value = ROW.nombre_administrador;
        USUARIO_ADMINISTRADOR.value = ROW.user_administrador;
        CORREO_ADMINISTRADOR.value = ROW.correo_administrador;
        CLAVE_ADMINISTRADOR.value = ROW.clave_administrador;
        TELEFONO_ADMINISTRADOR.value = ROW.telefono_adm; 
        IMG_ADMINISTRADOR.value = ROW.imagen;
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar autor';
    } else {
        sweetAlert(2, DATA.error, false);
    }
}

/*
*   Función asíncrona para eliminar un registro.
*   Parámetros: id (identificador del registro seleccionado).
*   Retorno: ninguno.
*/
const openDelete = async (id) => {
    // Llamada a la función para mostrar un mensaje de confirmación, capturando la respuesta en una constante.
    const RESPONSE = await confirmAction('¿Desea eliminar al autor de forma permanente?');
    // Se verifica la respuesta del mensaje.
    if (RESPONSE) {
        // Se define una constante tipo objeto con los datos del registro seleccionado.
        const FORM = new FormData();
        FORM.append('idAdministrador', id);
        // Petición para eliminar el registro seleccionado.
        const DATA = await fetchData(ADMINISTRADOR_API_API, 'deleteRow', FORM);
        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se muestra un mensaje de éxito.
            await sweetAlert(1, DATA.message, true);
            // Se carga nuevamente la tabla para visualizar los cambios.
            fillTable();
        } else {
            sweetAlert(2, DATA.error, false);
        }
    }
}