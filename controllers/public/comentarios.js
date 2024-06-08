// URL de la API para gestionar los comentarios.
const COMENTARIOS_API = 'services/admin/comentarios.php';

// Elementos del DOM utilizados en el script.
const SEARCH_FORM = document.getElementById('searchForm'); // Formulario de búsqueda.
const TABLE_BODY = document.getElementById('tableBody'); // Cuerpo de la tabla donde se mostrarán los comentarios.
const ROWS_FOUND = document.getElementById('rowsFound'); // Elemento donde se mostrará la cantidad de filas encontradas.

// Elementos del formulario para guardar un comentario.
const SAVE_FORM = document.getElementById('saveForm'), // Formulario para guardar un comentario.
    id_comentario = document.getElementById('id_comentario'), // Campo de entrada para el ID del comentario.
    comentario = document.getElementById('comentario'), // Campo de entrada para el contenido del comentario.
    calificacion = document.getElementById('calificacion'), // Campo de entrada para la calificación del comentario.
    estadoComentario = document.getElementById('estadoComentario'); // Campo de entrada para el estado del comentario.

// Event listener que se ejecuta cuando el contenido del DOM ha sido completamente cargado.
document.addEventListener('DOMContentLoaded', () => {
    fillTable(); // Llama a la función fillTable para llenar la tabla con los comentarios.
});



// Método del evento para cuando se envía el formulario de guardar.
SAVE_FORM.addEventListener('submit', async (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se verifica la acción a realizar.
    const action = (id_comentario.value) ? 'updateRow' : 'createRow';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(COMENTARIO_API, action, FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se cierra la caja de diálogo.
        closeModal();
        // Se muestra un mensaje de éxito.
        sweetAlert(1, DATA.message, true);
        // Se carga nuevamente la tabla para visualizar los cambios.
        muestraLibros();
    } else {
        // Se muestra un mensaje de error.
        sweetAlert(2, DATA.error, false);
    }
});


  
const muestraLibros = async (form = null) => {
    (form) ? action = 'searchRows' : action = 'readAll';
    const DATA = await fetchData(LIBROS_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializa el contenedor de productos.
        LIBROSN.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las tarjetas con los datos de cada producto.
            LIBROSN.innerHTML += `

                    <article class="testimonial__card swiper-slide">

                            
                           <img src="${SERVER_URL}images/libros/${row.imagen}" class="card-img-top" alt="${row.u}">
                      
                           <h2 class="featured__title">${row.u}</h2>
                      
                            <p class="testimonial__description">${row.c}</p>


                            <div class="testimonial__stars">

                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-fill"></i>
                            </div>

                        </article>
            
                        
            `;
        });
    } else {
      
      sweetAlert(4, DATA.error, true);

    }

}

// Función para obtener el HTML de las estrellas basado en la calificación.
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

// Función para abrir el modal de actualización con los datos del comentario.
const openUpdate = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id_comentario', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(COMENTARIO_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        const ROW = DATA.dataset;
        id_comentario.value = ROW.id_comentario;
        comentario.value = ROW.comentario;
        document.getElementById('calificacionContainer').innerHTML = getStarsHTML(ROW.calificacion);
        fillSelect(COMENTARIO_API, 'getEstados', 'estadoComentario', ROW.estado_comentario);
        AbrirModal();
        MODAL_TITLE.textContent = 'Actualizar un comentario';
    } else {
        // Se muestra un mensaje de error.
        sweetAlert(2, DATA.error, false);
    }
}

