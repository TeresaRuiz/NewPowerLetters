<?php
// Se incluye la clase del modelo.
require_once('../../models/data/libros_descuento_data.php');

if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'LibroData' para interactuar con los datos relacionados con 'libros'.
    $librosdes = new LibroDescuentoData;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null, // Excepción del servidor de base de datos si es aplicable.
        'fileStatus' => null
    ); // Estado de archivo (si es necesario para alguna operación).
    // Verificar si el usuario tiene una sesión iniciada como administrador.

    // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
    switch ($_GET['action']) {
        case 'searchRows':
            if (!Validator::validateSearch($_POST['search'])) {
                $result['error'] = Validator::getSearchError();
            } elseif ($result['dataset'] = $librosdes->searchRows()) {
                $result['status'] = 1;
                $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
            } else {
                $result['error'] = 'No hay coincidencias';
            }
            break;


        case 'readAll':
            if ($result['dataset'] = $librosdes->readAll()) {
                $result['status'] = 1; // Indicar que la operación fue exitosa.
                $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
            } else {
                $result['error'] = 'No existen libros registrados'; // Mensaje si no se encuentran autores.
            }
            break;

        case 'readOne':
            if (!$librosdes->setId($_POST['id_libro'])) {
                $result['error'] = $librosdes->getDataError();
            } elseif ($result['dataset'] = $librosdes->readOne()) {
                $result['status'] = 1;
            } else {
                $result['error'] = 'Libro inexistente';
            }
            break;
    }
    print(json_encode($result));
}
