// Constantes para completar las rutas de la API.
const PEDIDO_API = 'services/public/pedido.php';

const HISTORIAL_BODY = document.getElementById('historialBody');

document.addEventListener('DOMContentLoaded', () => {
    loadHistorial();
});

async function loadHistorial() {
    const DATA = await fetchData(PEDIDO_API, 'readHistorial');
    if (DATA.status) {
        HISTORIAL_BODY.innerHTML = '';
        DATA.dataset.forEach(row => {
            HISTORIAL_BODY.innerHTML += `
                <tr>
                    <td>${row.nombre_libro}</td>
                    <td>${row.precio}</td>
                    <td>${row.cantidad}</td>
                    <td>${row.subtotal}</td>
                    <td>${row.estado}</td>
                     <td class="action-icons">
                    <a onclick="viewDetails(${row.id_pedido})">
                    <i class="ri-eye-fill"></i>
                    </a>
                </td>
                </tr>
            `;
        });
    } else {
        sweetAlert(4, DATA.error, false, 'index.html');
    }
}

function viewDetails(idPedido) {
    // Aquí puedes implementar la lógica para ver los detalles del pedido
}

async function viewDetails(idPedido) {
    const DATA = await fetchData('pedido.php', 'readOne', { id_pedido: idPedido });
    if (DATA.status) {
        let detailsHtml = '';
        DATA.dataset.forEach(detail => {
            detailsHtml += `
                <p>Libro: ${detail.titulo}, Cantidad: ${detail.cantidad}, Subtotal: ${detail.precio * detail.cantidad}</p>
            `;
        });
        // Mostrar detalles en un modal o en una sección específica
        document.getElementById('detallePedido').innerHTML = detailsHtml;
        // Abre el modal si es necesario
        document.getElementById('detalleModal').style.display = 'block';
    } else {
        sweetAlert(4, DATA.error, false);
    }
}
