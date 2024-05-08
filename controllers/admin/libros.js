// Constantes para completar las rutas de la API.
const LIBRO_API = 'services/admin/libros.php';
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById('tableBody'),
    ROWS_FOUND = document.getElementById('rowsFound');
// Constantes para establecer los elementos del formulario de guardar.
const SAVE_FORM = document.getElementById('saveForm'),
    ID_LIBRO = document.getElementById('idLibro'),
    TITULO = document.getElementById('titulo'),
    ID_AUTOR = document.getElementById('idAutor'),
    PRECIO = document.getElementById('precio'),
    DESCRIPCION = document.getElementById('descripcion'),
    IMAGEN = document.getElementById('imagen'),
    ID_CLASIFICACION = document.getElementById('idClasificacion'),
    ID_EDITORIAL = document.getElementById('idEditorial'),
    EXISTENCIAS = document.getElementById('existencias'),
    ID_GENERO = document.getElementById('idGenero');

// Método del evento para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    // Llamada a la función para llenar la tabla con los registros existentes.
    fillTable();
});

// Método del evento para cuando se envía el formulario de guardar.
SAVE_FORM.addEventListener('submit', async (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se verifica la acción a realizar.
    (ID_LIBRO.value) ? action = 'updateRow' : action = 'createRow';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(LIBRO_API, action, FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se muestra un mensaje de éxito.
        alert('Operación exitosa: ' + DATA.message);
        // Se carga nuevamente la tabla para visualizar los cambios.
        fillTable();
    } else {
        alert('Error: ' + DATA.error);
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
    const DATA = await fetchData(LIBRO_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se recorre el conjunto de registros fila por fila.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
            <tr>
                <td>${row.titulo}</td>
                <td>${row.precio}</td>
                <td>${row.descripcion}</td>
                <td>${row.imagen}</td>
                <td>${row.existencias}</td>
                <td>${row.autor}</td>
                <td class="action-icons">
                <a onclick="openUpdate(${row.id_libro})">
                <i class="ri-eye-line"></i>
                    </a>
                    <a onclick="openUpdate(${row.id_libro})">
                        <i class="ri-edit-line"></i>
                    </a>
                    <a onclick="openDelete(${row.id_libro})">
                        <i class="ri-delete-bin-line"></i>
                    </a>
                </td>
            </tr>
            `;
        });
        // Se muestra un mensaje de acuerdo con el resultado.
        ROWS_FOUND.textContent = DATA.message;
    } else {
        alert('Error: ' + DATA.error);
    }
}

/*
*   Función para preparar el formulario al momento de insertar un registro.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const openCreate = () => {
    // Se muestra la caja de diálogo con su título.
    modal.style.display = "block";
    MODAL_TITLE.textContent = 'Agregar libros';
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
    FORM.append('id_libro', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(LIBRO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        ID_LIBRO.value = ROW.id_libro;
        TITULO.value = ROW.titulo;
        ID_AUTOR.value = ROW.id_autor;
        PRECIO.value = ROW.precio;
        DESCRIPCION.value = ROW.descripcion;
        IMAGEN.value = ROW.imagen;
        ID_CLASIFICACION.value = ROW.id_clasificacion;
        ID_EDITORIAL.value = ROW.id_editorial;
        EXISTENCIAS.value = ROW.existencias;
        ID_GENERO.value = ROW.id_genero;
    } else {
        alert('Error: ' + DATA.error);
    }
}

/*
*   Función asíncrona para eliminar un registro.
*   Parámetros: id (identificador del registro seleccionado).
*   Retorno: ninguno.
*/
const openDelete = async (id) => {
    // Llamada a la función para mostrar un mensaje de confirmación, capturando la respuesta en una constante.
    const RESPONSE = confirm('¿Desea eliminar el libro de forma permanente?');
    // Se verifica la respuesta del mensaje.
    if (RESPONSE) {
        // Se define una constante tipo objeto con los datos del registro seleccionado.
        const FORM = new FormData();
        FORM.append('idGenero', id);
        // Petición para eliminar el registro seleccionado.
        const DATA = await fetchData(GENERO_API, 'deleteRow', FORM);
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