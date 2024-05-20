const AUTORES_API = 'services/admin/autores.php';
const CLASIFICACION_API = 'services/admin/clasificacion.php';
const EDITORIAL_API = 'services/admin/editoriales.php';
const GENERO_API = 'services/admin/genero.php';
// Constantes para completar las rutas de la API.
const LIBRO_API = 'services/admin/libros.php';
// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('searchForm');
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById('tableBody');
const ROWS_FOUND = document.getElementById('rowsFound');
// Constantes para establecer los elementos del formulario de guardar.
const SAVE_FORM = document.getElementById('saveForm'),
    id_libro = document.getElementById('id_libro'),
    titulo = document.getElementById('titulo'),
    precio = document.getElementById('precio'),
    descripcion = document.getElementById('descripcion'),
    existencias = document.getElementById('existencias');

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
    (id_libro.value) ? action = 'updateRow' : action = 'createRow';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(LIBRO_API, action, FORM);
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
    const DATA = await fetchData(LIBRO_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se recorre el conjunto de registros fila por fila.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
            <tr>
                <td>${row.titulo_libro}</td>
                <td>${row.descripcion_libro}</td>
                <td><img src="${SERVER_URL}images/libros/${row.imagen}" width="50"></td>
                <td>${row.precio}</td>
                <td>${row.existencias}</td>
                <td class="action-icons">
                    <a onclick="openUpdate(${row.id_libro})">
                        <i class="ri-edit-line"></i>
                    </a>
                    <a onclick="openDelete(${row.id_libro})">
                        <i class="ri-delete-bin-line"></i>
                    </a>
                    <a onclick="viewDetails(${row.id_libro})">
                    <i class="ri-search-eye-line"></i>
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
/*
*   Función para preparar el formulario al momento de insertar un registro.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const openCreate = () => {
    // Se muestra la caja de diálogo con su título.
    modal.style.display = "block";
    MODAL_TITLE.textContent = 'Agregar un nuevo libro';
    // Se prepara el formulario.
    SAVE_FORM.reset();
    fillSelect(GENERO_API, 'readAll', 'nombreGEN');
    fillSelect(EDITORIAL_API, 'readAll', 'editorial');
    fillSelect(CLASIFICACION_API, 'readAll', 'clasificacion');
    fillSelect(AUTORES_API, 'readAll', 'autor');
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
        id_libro.value = ROW.id_libro;
        titulo.value = ROW.titulo_libro;
        precio.value = ROW.precio;
        descripcion.value = ROW.descripcion_libro;
        existencias.value = ROW.existencias;
        fillSelect(GENERO_API, 'readAll', 'nombreGEN', ROW.nombre_genero);
        fillSelect(EDITORIAL_API, 'readAll', 'editorial', ROW.nombre_editorial);
        fillSelect(CLASIFICACION_API, 'readAll', 'clasificacion', ROW.nombre_clasificacion);
        fillSelect(AUTORES_API, 'readAll', 'autor', ROW.nombre_autor);
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar un libro';
    } else {
        sweetAlert(2, DATA.error, false);
    }
}
const viewDetails = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_libro', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(LIBRO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        AbrirModalVista();
        MODAL_TITLE.textContent = 'Detalle de un libro';
        // Actualizar los elementos del modal con la información del libro
        document.getElementById('tituloVista').innerText = ROW.titulo_libro;
        document.getElementById('vista').src = `${SERVER_URL}images/libros/${ROW.imagen}`;
        document.getElementById('precioVista').innerText = ROW.precio;
        document.getElementById('descripcionVista').innerText = ROW.descripcion_libro;
        document.getElementById('existenciasVista').innerText = ROW.existencias;
        document.getElementById('autorVista').innerText = ROW.nombre_autor;
        document.getElementById('clasificacionVista').innerText = ROW.nombre_clasificacion;
        document.getElementById('editorialVista').innerText = ROW.nombre_editorial;
        document.getElementById('generoVista').innerText = ROW.nombre_genero;
    } else {
        sweetAlert(2, DATA.error, false);
    }
};

/*
*   Función asíncrona para eliminar un registro.
*   Parámetros: id (identificador del registro seleccionado).
*   Retorno: ninguno.
*/
const openDelete = async (id) => {
    // Llamada a la función para mostrar un mensaje de confirmación, capturando la respuesta en una constante.
    const RESPONSE = await confirmAction('¿Desea eliminar el libro de forma permanente?');
    // Se verifica la respuesta del mensaje.
    if (RESPONSE) {
        // Se define una constante tipo objeto con los datos del registro seleccionado.
        const FORM = new FormData();
        FORM.append('id_libro', id);
        // Petición para eliminar el registro seleccionado.
        const DATA = await fetchData(LIBRO_API, 'deleteRow', FORM);
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

