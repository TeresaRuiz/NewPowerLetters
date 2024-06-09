// Constante para completar la ruta de la API.
const PEDIDO_API = 'services/public/pedido.php';
// Constante para establecer el cuerpo de la tabla.
const TABLE_BODY = document.getElementById('tableBody');
// Constante para el modal.
const MODAL = document.getElementById('myModalView');

// Método del evento para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    // Llamada a la función para mostrar el encabezado y pie del documento.
    loadTemplate();
    // Llamada a la función para mostrar los productos del carrito de compras.
    readDetail();
});

// Método para cerrar el modal.
function closeModalDetalles() {
    MODAL.style.display = 'none';
}

// Método para abrir el modal y cargar los datos del producto.
function openModalDetalles() {
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
                        <a onclick="viewDetails(${row.id_detalle})">
                            <i class="ri-eye-fill"></i>
                        </a>
                    </td>
                </tr>
            `;
        });
        // Se muestra el total a pagar con dos decimales.
        document.getElementById('pago').textContent = total.toFixed(2);
    } else {
        sweetAlert(4, DATA.error, false, 'index.html');
    }
}

const viewDetails = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_detalle', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(PEDIDO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset[0]; // Asegúrate de que estás obteniendo el primer elemento del dataset.
        openModalDetalles();
        document.getElementById('modalTitle').textContent = 'Detalle del pedido';
        // Actualizar los elementos del modal con la información del libro.
        document.getElementById('tituloVista').innerText = ROW.titulo;
        document.getElementById('vista').src = `${SERVER_URL}images/libros/${ROW.imagen_libro}`;
        document.getElementById('Cantidad').innerText = ROW.cantidad;
        document.getElementById('Cliente').innerText = ROW.nombre_usuario;
        document.getElementById('direccion').innerText = ROW.direccion_pedido;
        document.getElementById('Estado').innerText = ROW.estado;
        document.getElementById('Fecha').innerText = ROW.fecha_pedido;
    } else {
        sweetAlert(2, DATA.error, false);
    }
}
