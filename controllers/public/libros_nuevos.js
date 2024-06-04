
const AUTORES_API = 'services/admin/autores.php';
const CLASIFICACION_API = 'services/admin/clasificacion.php';
const EDITORIAL_API = 'services/admin/editoriales.php';
const GENERO_API = 'services/admin/genero.php';
// Constante para completar la ruta de la API.
const LIBROS_API = 'services/public/libros.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const LIBROSN = document.getElementById('librosNuevos');
// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('searchForm');
id_libro_descuento = document.getElementById('id_libro_descuento'),
titulo = document.getElementById('titulo'),
precio = document.getElementById('precio'),
descripcion = document.getElementById('descripcion'),
existencias = document.getElementById('existencias');

// script.js
const LIBROSNS = document.get



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


const muestraLibros = async (form = null) => {
  
    // Se define un objeto con los datos de la categoría seleccionada.
    const FORM = new FormData();
    FORM.append('idClas', PARAMS.get('id'));
    

    (form) ? action = 'searchRows' : action = 'readAll';
    const DATA = await fetchData(LIBROS_API, 'readLibrosGeneros', FORM);
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
        // Se presenta un mensaje de error cuando no existen datos para mostrar.
        console.log(DATA.error);
    }

}



function comboBox(){
   
   
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
   
        
        fillSelect(GENERO_API, 'readAll', 'nombreGEN');
        fillSelect(EDITORIAL_API, 'readAll', 'editorial');
        fillSelect(CLASIFICACION_API, 'readAll', 'clasificacion');
        fillSelect(AUTORES_API, 'readAll', 'autor');
        
    
}


// Llamar a la función para llenar el select
llenarSelect('nombreGEN', comboBox);
llenarSelect('editorial', comboBox);
llenarSelect('clasificacion', comboBox);
llenarSelect('autor', comboBox);


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
