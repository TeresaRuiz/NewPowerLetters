const COMENTARIO_API = 'services/admin/comentario.php';
const SEARCH_FORM = document.getElementById('searchForm');
const TABLE_BODY = document.getElementById('tableBody');
const ROWS_FOUND = document.getElementById('rowsFound');
const SAVE_FORM = document.getElementById('saveForm'),
    id_comentario = document.getElementById('id_comentario'),
    comentario = document.getElementById('comentario'),
    calificacion = document.getElementById('calificacion'),
    estadoComentario = document.getElementById('estadoComentario');

document.addEventListener('DOMContentLoaded', () => {
    fillTable();
});

SEARCH_FORM.addEventListener('submit', (event) => {
    event.preventDefault();
    const FORM = new FormData(SEARCH_FORM);
    fillTable(FORM);
});

SAVE_FORM.addEventListener('submit', async (event) => {
    event.preventDefault();
    const action = id_comentario.value ? 'updateRow' : 'createRow';
    const FORM = new FormData(SAVE_FORM);
    const DATA = await fetchData(COMENTARIO_API, action, FORM);
    if (DATA.status) {
        closeModal();
        sweetAlert(1, DATA.message, true);
        fillTable();
    } else {
        sweetAlert(2, DATA.error, false);
    }
});

const fillTable = async (form = null) => {
    ROWS_FOUND.textContent = '';
    TABLE_BODY.innerHTML = '';
    const action = form ? 'searchRows' : 'readAll';
    const DATA = await fetchData(COMENTARIO_API, action, form);
    if (DATA.status) {
        DATA.dataset.forEach(row => {
            TABLE_BODY.innerHTML += `
            <tr>
                <td>${row.comentario}</td>
                <td>${row.nombre_usuario}</td>
                <td>${getStarsHTML(row.calificacion)}</td>
                <td>
                    <div>
                        ${row.estado_comentario}
                    </div>
                </td>
                <td class="action-icons">
                    <a onclick="viewDetails(${row.id_comentario})">
                    <i class="ri-eye-fill"></i>
                    </a>
                    <a onclick="openUpdate(${row.id_comentario})">
                    <i class="ri-edit-line"></i>
                    </a>
                </td>
            </tr>
            `;
        });
        ROWS_FOUND.textContent = DATA.message;
    } else {
        sweetAlert(4, DATA.error, true);
    }
}

const getStarsHTML = (rating) => {
    let starsHTML = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            starsHTML += '<span class="fa fa-star checked"></span>';
        } else {
            starsHTML += '<span class="fa fa-star"></span>';
        }
    }
    return starsHTML;
}

const openUpdate = async (id) => {
    const FORM = new FormData();
    FORM.append('id_comentario', id);
    const DATA = await fetchData(COMENTARIO_API, 'readOne', FORM);
    if (DATA.status) {
        const ROW = DATA.dataset;
        id_comentario.value = ROW.id_comentario;
        comentario.value = ROW.comentario;
        document.getElementById('calificacionContainer').innerHTML = getStarsHTML(ROW.calificacion);
        fillSelect(COMENTARIO_API, 'getEstados', 'estadoComentario', ROW.estado_comentario);
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar un comentario';
    } else {
        sweetAlert(2, DATA.error, false);
    }
}
