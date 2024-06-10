
const AUTORES_API = 'services/public/autores_public.php';
const CLASIFICACION_API = 'services/public/clasificaciones_public.php';
const EDITORIAL_API = 'services/public/editoriales_public.php';
const GENERO_API = 'services/public/genero_public.php';
// Constante para completar la ruta de la API.
const LIBROS_API = 'services/public/libros_descuentos.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const LIBROSN = document.getElementById('librosNuevos');
// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('searchForm');
const searchInput = document.getElementById('search-input2');
id_libro_descuento = document.getElementById('id_libro_descuento'),
    titulo = document.getElementById('titulo'),
    precio = document.getElementById('precio'),
    descripcion = document.getElementById('descripcion'),
    existencias = document.getElementById('existencias');




// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {

    comboBox();
    muestraLibros();

});

// Método del evento para cuando se envía el formulario de buscar.
SEARCH_FORM.addEventListener('submit', (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SEARCH_FORM);
    // Llamada a la función para llenar la tabla con los resultados de la búsqueda.
    muestraLibros(FORM);
});


searchInput.addEventListener('input', () => {
    // Si el input está vacío y se hace clic en la "X" predeterminada
    if (searchInput.value === '') {
        location.reload();
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

                
            <article class="featured__card">

                       <img src="${SERVER_URL}images/libros/${row.imagen}" class="card-img-top" alt="${row.titulo_libro}">
                       <h2 class="featured__title">${row.titulo_libro}</h2>
                       <div class="featured__prices">
                          <span class="featured__discount"> ${row.precio}</span>

                       </div>

                       <div class="featured__prices">
                          <span class="featured__discount"> ${row.nombre_autor}</span>
                       </div>

                        <buttton class="button">Añadir al carrito</buttton>
                        <div class="featured__actions">
                         <button><i class="ri-search-line"></i></button>
                         <button><i class="ri-heart-3-line"></i></button>
                         <a href="detalle_libro.html?id=${row.id_libro}"><button><i class="ri-eye-line"></i></button></a>
                        </div>
                    
                    </article>
            
            `;
        });
    } else {

        sweetAlert(4, DATA.error, true);

    }

}

function comboBox() {
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.

    fillSelect(GENERO_API, 'readAll', 'nombreGEN');
    fillSelect(EDITORIAL_API, 'readAll', 'editorial');
    fillSelect(CLASIFICACION_API, 'readAll', 'clasificacion');
    fillSelect(AUTORES_API, 'readAll', 'autor');

}

function buscar_filtro(precio, nombreGEN) {
    var buscar = '1';
    var parametros = {
        "buscar": buscar,
        "precio": precio,
        "nombreGEN": nombreGEN,
        
    };

    $.ajax({
        data: parametros,
        url: 'api/services/public/libros_descuentos.php',
        type: 'POST',
        timeout: 10000,
        beforeSend: function () {
            // document.getElementById("resultado_busqueda").innerHTML = '<img src="img/load.gif" style="width:120px;">';
        },
        success: function (response) {
            console.log('DENTRO');
            document.getElementById("librosNuevos").innerHTML = response;
        },
        error: function (response, error) {
            console.log('ERROR');
            document.getElementById("librosNuevos").innerHTML = error;
        }
    });
}

const viewDetails = async (id) => {
    // Se define una constante tipo objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('idClas', id);
    // Petición para obtener los datos del registro solicitado.
    const DATA = await fetchData(LIBROS_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se inicializan los campos con los datos.
        const ROW = DATA.dataset;
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
