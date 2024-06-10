// URL de la API para gestionar los comentarios.
const COMENTARIOS_API = 'services/public/comentarios.php';
const ComentarioContenedor = document.getElementById('comentarioContenedor')

// Elementos del formulario para guardar un comentario.
const SAVE_FORM = document.getElementById('saveForm');

// Event listener que se ejecuta cuando el contenido del DOM ha sido completamente cargado.
document.addEventListener('DOMContentLoaded', () => {
    showsBooks(); // Llama a la función fillTable para llenar la tabla con los comentarios.
});




// Método del evento para cuando se envía el formulario de guardar.
SAVE_FORM.addEventListener('submit', async (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    const notas = document.getElementsByName('star');
    let seleccion = null;
    for (const nota of notas) {
        if (nota.checked) {
            seleccion = nota.value;
            break;
        }
    }
    console.log(PARAMS.get('id'));
    console.log(seleccion);
    // Se verifica la acción a realizar.
    // const action = (id_comentario.value) ? 'updateRow' : 'createRow';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    FORM.append('id_libro', PARAMS.get('id'));
    FORM.append('calificacion', seleccion);
    console.log(FORM);
    // Petición para guardar los datos del formulario.
    const DATA = await fetchData(COMENTARIOS_API, 'createRow', FORM);
    console.log(DATA);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se muestra un mensaje de éxito.
        sweetAlert(1, DATA.message, true);
        // Se carga nuevamente la tabla para visualizar los cambios.
        showsBooks();
    } else {
        // Se muestra un mensaje de error.
        sweetAlert(2, DATA.error, false);
    }
});




const showsBooks = async (form = null) => {
    // (form) ? action = 'searchRows' : action = 'readOneComment';
    form = new FormData();
    form.append('id_libro', PARAMS.get('id'));
    const DATA = await fetchData(COMENTARIOS_API, 'readOneComment', form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializa el contenedor de productos.
        ComentarioContenedor.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las tarjetas con los datos de cada producto.
            ComentarioContenedor.innerHTML += `

                    <article class="featured__card">

                           <img src="${SERVER_URL}images/usuarios/${row.imagen}" class="card-img-top"  alt="image" class="testimonial__img">
                      
                           <h2 class="featured__title">${row.nombre_usuario}</h2>
                      
                            <p class="testimonial__description">${row.comentario}</p>

                            <br><br>
                            <div class="testimonial__stars">
                            ${getStarsHTML(row.calificacion)}
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




