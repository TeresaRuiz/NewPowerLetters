// Constante para completar la ruta de la API.
const USUARIO_API = 'services/public/usuario.php';
// Constantes para establecer los elementos del formulario de guardar.
const SAVE_FORM = document.getElementById('signupForm'),
    ID_USUARIO = document.getElementById('id_usuario'),
    NOMBRE_CLIENTE = document.getElementById('nombreCliente'),
    USUARIO_CLIENTE = document.getElementById('usuarioCliente'),
    CORREO_CLIENTE = document.getElementById('correoCliente'),
    DIRECCION_CLIENTE = document.getElementById('direccionCliente'),
    TELEFONO_CLIENTE = document.getElementById('telefonoCliente');
    CLAVE_CLIENTE = document.getElementById('claveAdministrador'),
    CONFIRMAR_CLAVE = document.getElementById('confirmarClave');




// Método del evento para cuando se envía el formulario de guardar.
SAVE_FORM.addEventListener('submit', async (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    try {
        const DATA = await fetchData(USUARIO_API, 'createRow', FORM);
        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se cierra la caja de diálogo.
            SAVE_MODAL.hide();
            // Se muestra un mensaje de éxito.
            sweetAlert(1, DATA.message, true);
            // Se carga nuevamente la tabla para visualizar los cambios.
            fillTable();
        } else {
            sweetAlert(2, DATA.error, false);
        }
    } catch (e) {
        console.log(e)
    }
});


/*
*   Función para preparar el formulario al momento de insertar un registro.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const openCreate = () => {
    // Se muestra la caja de diálogo con su título.
    SAVE_MODAL.show();
    MODAL_TITLE.textContent = 'Crear usuario';
    // Se prepara el formulario.
    SAVE_FORM.reset();
    USUARIO_CLIENTE.disabled = false;
    CLAVE_CLIENTE.disabled = false;
    CONFIRMAR_CLAVE.disabled = false;
}

/*
*   Función asíncrona para preparar el formulario al momento de actualizar un registro.
*   Parámetros: id (identificador del registro seleccionado).
*   Retorno: ninguno.
*/
const openUpdate = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_usuario', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(ADMINISTRADOR_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se muestra la caja de diálogo con su título.
        SAVE_MODAL.show();
        MODAL_TITLE.textContent = 'Actualizar usuario del cliente';
        // Se prepara el formulario.
        SAVE_FORM.reset();
        USUARIO_CLIENTE.disabled = true;
        CLAVE_CLIENTE.disabled = true;
        CONFIRMAR_CLAVE.disabled = true;
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
        ID_USUARIO.value = ROW.id_usuario;
        NOMBRE_CLIENTE.value = ROW.nombre_administrador;
        DIRECCION_CLIENTE.value = ROW.direccion_cliente;
        CORREO_CLIENTE.value = ROW.correo_cliente;
        USUARIO_CLIENTE.value = ROW.usuario_cliente;
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
    const RESPONSE = await confirmAction('¿Desea eliminar el usuario de forma permanente?');
    // Se verifica la respuesta del mensaje.
    if (RESPONSE) {
        // Se define una constante tipo objeto con los datos del registro seleccionado.
        const FORM = new FormData();
        FORM.append('id_usuario', id);
        // Petición para eliminar el registro seleccionado.
        const DATA = await fetchData(ADMINISTRADOR_API, 'deleteRow', FORM);
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