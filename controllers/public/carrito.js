// Constante para completar la ruta de la API.
const PEDIDO_API = 'services/public/pedido.php';
// Constante para establecer el cuerpo de la tabla.
const TABLE_BODY = document.getElementById('tableBody');
// Constante para el modal.
const MODAL = document.getElementById('myModal');

// Método del evento para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    // Llamada a la función para mostrar el encabezado y pie del documento.
    loadTemplate();
    // Llamada a la función para mostrar los productos del carrito de compras.
    readDetail();

    // Evento para enviar el formulario de cambiar cantidad de producto.
    document.getElementById('saveForm').addEventListener('submit', async (event) => {
        // Se evita recargar la página web después de enviar el formulario.
        event.preventDefault();
        // Constante tipo objeto con los datos del formulario.
        const FORM = new FormData(document.getElementById('saveForm'));
        // Petición para actualizar la cantidad de producto.
        const DATA = await fetchData(PEDIDO_API, 'updateDetail', FORM);
        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se actualiza la tabla para visualizar los cambios.
            readDetail();
            // Se cierra la caja de diálogo del formulario.
            closeModal();
            // Se muestra un mensaje de éxito.
            sweetAlert(1, DATA.message, true);
        } else {
            sweetAlert(2, DATA.error, false);
        }
    });
});

// Método para cerrar el modal.
function closeModal() {
    MODAL.style.display = 'none';
}

// Método para abrir el modal y cargar los datos del producto.
function openModal(idDetalle, cantidadLibro) {
    // Asignar el ID del detalle al formulario.
    document.getElementById('idDetalle').value = idDetalle;
    // Asignar la cantidad del libro al formulario.
    document.getElementById('cantidadLibro').value = cantidadLibro;
    // Mostrar el modal.
    MODAL.style.display = 'block';
}

/*
*   Función para obtener el detalle del carrito de compras.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
async function readDetail() {
    // Petición para obtener los datos del pedido en proceso.
    const DATA = await fetchData(PEDIDO_API, 'readDetail');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializa el cuerpo de la tabla.
        TABLE_BODY.innerHTML = '';
        // Se declara e inicializa una variable para calcular el importe por cada producto.
        let subtotal = 0;
        // Se declara e inicializa una variable para sumar cada subtotal y obtener el monto final a pagar.
        let total = 0;
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            subtotal = row.precio * row.cantidad;
            total += subtotal;
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
                <tr>
                    <td>${row.nombre_producto}</td>
                    <td>${row.precio}</td>
                    <td>${row.cantidad}</td>
                    <td>${subtotal.toFixed(2)}</td>
                    <td>
                        <button type="button" onclick="openUpdate(${row.id_detalle}, ${row.cantidad})" class="btn btn-info btn-custom-info btn-lg">
                            <i class="ri-add-fill"></i>
                        </button>
                        <button type="button" onclick="openDelete(${row.id_detalle})" class="btn btn-danger btn-custom-danger btn-lg">
                            <i class="ri-shopping-cart-2-line"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
        // Se muestra el total a pagar con dos decimales (según las indicaciones).
        document.getElementById('pago').textContent = total.toFixed(2);
    } else {
        sweetAlert(4, DATA.error, false, 'index.html');
    }
}

// Método para abrir la caja de diálogo con el formulario de cambiar cantidad de producto.
function openUpdate(id, quantity) {
    // Se abre la caja de diálogo que contiene el formulario.
    MODAL.style.display = 'block';
    // Se inicializan los campos del formulario con los datos del registro seleccionado.
    document.getElementById('idDetalle').value = id;
    document.getElementById('cantidadLibro').value = quantity;
}

async function finishOrder() {
    // Llamada a la función para mostrar un mensaje de confirmación, capturando la respuesta en una constante.
    const RESPONSE = await confirmAction('¿Está seguro de finalizar el pedido?');
    // Se verifica la respuesta del mensaje.
    if (RESPONSE) {
        // Petición para finalizar el pedido en proceso.
        const DATA = await fetchData(PEDIDO_API, 'finishOrder');
        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            sweetAlert(1, DATA.message, false, 'index.html');
        } else {
            sweetAlert(2, DATA.error, false);
        }
    }
}
/*
*   Función asíncrona para mostrar un mensaje de confirmación al momento de eliminar un producto del carrito.
*   Parámetros: id (identificador del producto).
*   Retorno: ninguno.
*/
async function openDelete(id) {
    // Llamada a la función para mostrar un mensaje de confirmación, capturando la respuesta en una constante.
    const RESPONSE = await confirmAction('¿Está seguro de remover el libro?');
    // Se verifica la respuesta del mensaje.
    if (RESPONSE) {
        // Se define un objeto con los datos del producto seleccionado.
        const FORM = new FormData();
        FORM.append('idDetalle', id);
        // Petición para eliminar un producto del carrito de compras.
        const DATA = await fetchData(PEDIDO_API, 'deleteDetail', FORM);
        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            await sweetAlert(1, DATA.message, true);
            // Se carga nuevamente la tabla para visualizar los cambios.
            readDetail();
        } else {
            sweetAlert(2, DATA.error, false);
        }
    }
}
