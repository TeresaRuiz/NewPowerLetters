// Constante para completar la ruta de la API.
const ADMINISTRADOR_API = 'services/admin/administrador.php';
// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('searchForm');
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById('tableBody');
const ROWS_FOUND = document.getElementById('rowsFound');
    // Constantes para establecer los elementos del formulario de guardar.
const SAVE_FORM = document.getElementById('saveForm'),
nombreAdministrador = document.getElementById('nombreAdministrador'),
UsuarioAdministrador = document.getElementById('UsuarioAdministrador'),
correoAdministrador = document.getElementById('correoAdministrador'),
claveAdministrador = document.getElementById('claveAdministrador'),
confirmarClave = document.getElementById('confirmarClave'),
telefono = document.getElementById('telefono'),
fecha = document.getElementsBy('fecha_registro');