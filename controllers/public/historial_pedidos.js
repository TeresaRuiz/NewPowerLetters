// Constante para completar la ruta de la API de pedidos.
const PEDIDO_API = 'services/public/pedido.php';

// Constante que referencia al elemento del cuerpo de la tabla del historial.
const HISTORIAL_BODY = document.getElementById('historialBody');

// Evento que se dispara cuando el DOM ha sido completamente cargado.
document.addEventListener('DOMContentLoaded', () => {
    loadHistorial(); // Llama a la función para cargar el historial de pedidos.
});

// Función asíncrona para cargar el historial de pedidos.
async function loadHistorial() {
    // Hace una petición a la API para obtener el historial de pedidos.
    const DATA = await fetchData(PEDIDO_API, 'readHistorial');
    if (DATA.status) {
        // Si la petición fue exitosa, limpia el contenido actual del cuerpo de la tabla.
        HISTORIAL_BODY.innerHTML = '';
        // Recorre cada fila del dataset y la añade al cuerpo de la tabla.
        DATA.dataset.forEach(row => {
            HISTORIAL_BODY.innerHTML += `
                <tr>
                    <td>${row.nombre_libro}</td>
                    <td>${row.precio}</td>
                    <td>${row.cantidad}</td>
                    <td>${row.subtotal}</td>
                    <td>${row.estado}</td>
                </tr>
            `;
        });
    } else {
        // Si la petición no fue exitosa, muestra un mensaje de error y redirige al inicio.
        sweetAlert(4, DATA.error, false, 'index.html');
    }
}

function viewDetails(idPedido) {
    // Aquí puedes implementar la lógica para ver los detalles del pedido
    //<td class="action-icons">
    //<a onclick="viewDetails(${row.id_pedido})">
 //   <i class="ri-eye-fill"></i>
    //</a>
//</td>
}

// Función asíncrona para ver los detalles de un pedido específico.
async function viewDetails(idPedido) {
    // Hace una petición a la API para obtener los detalles de un pedido específico.
    const DATA = await fetchData('pedido.php', 'readOne', { id_pedido: idPedido });
    if (DATA.status) {
        let detailsHtml = '';
        // Recorre cada detalle del pedido y lo añade al HTML de detalles.
        DATA.dataset.forEach(detail => {
            detailsHtml += `
                <p>Libro: ${detail.titulo}, Cantidad: ${detail.cantidad}, Subtotal: ${detail.precio * detail.cantidad}</p>
            `;
        });
        // Muestra los detalles en un modal o en una sección específica.
        document.getElementById('detallePedido').innerHTML = detailsHtml;
        // Abre el modal si es necesario.
        document.getElementById('detalleModal').style.display = 'block';
    } else {
        // Si la petición no fue exitosa, muestra un mensaje de error.
        sweetAlert(4, DATA.error, false);
    }
}