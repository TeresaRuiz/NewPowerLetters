// URL de la API para gestionar los comentarios.
const COMENTARIOS_API = 'services/admin/comentarios.php';


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



  
const muestraLibros = async (form = null) => {
    (form) ? action = 'searchRows' : action = 'readAll';
    const DATA = await fetchData(COMENTARIOS_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializa el contenedor de productos.
        COMENTARIOS_API.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las tarjetas con los datos de cada producto.
            COMENTARIOS_API.innerHTML += `

                    <article class="testimonial__card swiper-slide">

                            
                           <img src="${SERVER_URL}images/libros/${row.imagen}" class="card-img-top"  alt="image" class="testimonial__img">
                      
                           <h2 class="featured__title">${row.nombre_usuario}</h2>
                      
                            <p class="testimonial__description">${row.comentario}</p>


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




