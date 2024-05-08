<?php
// Importar la clase que gestiona los datos relacionados con 'género'.
require_once('../../models/data/libros_data.php');

// Verificar si se ha recibido una acción mediante el parámetro 'action' en la URL.
if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'generoData' para interactuar con los datos relacionados con 'género'.
    $libros = new libroData;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación, como una lista de géneros.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null, // Excepción del servidor de base de datos si es aplicable.
        'fileStatus' => null // Estado de archivo (si es necesario para alguna operación).

    );if (isset($_SESSION['idAdministrador']) or true) {
        switch ($_GET['action']) {
            case 'searchRows':
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } elseif ($result['dataset'] = $libro->searchRows()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
                } else {
                    $result['error'] = 'No hay coincidencias';
                }
                break;

            case 'createRow':
                $_POST = Validator::validateForm($_POST);

                if (
                    !$libro->setTitulo($_POST['titulo']) ||
                    !$libro->setIdAutor($_POST['idAutor']) ||
                    !$libro->setPrecio($_POST['precio']) ||
                    !$libro->setDescripcion($_POST['descripcion']) ||
                    !$libro->setImagen($_FILES['imagen']) ||
                    !$libro->setIdClasificacion($_POST['idClas']) ||
                    !$libro->setIdEditorial($_POST['idEditorial']) ||
                    !$libro->setExistencias($_POST['existencias']) ||
                    !$libro->setIdGenero($_POST['idGenero'])
                ) {
                    $result['error'] = $libro->getDataError();
                } elseif ($libro->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Libro creado correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al crear el libro';
                }
                break;

            case 'readAll':
                if ($result['dataset'] = $libro->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros';
                } else {
                    $result['error'] = 'No existen libros registrados';
                }
                break;

            case 'readOne':
                if (!$libro->setIdLibro($_POST['id_libro'])) {
                    $result['error'] = $libro->getDataError();
                } elseif ($result['dataset'] = $libro->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Libro inexistente';
                }
                break;

            case 'updateRow':
                $_POST = Validator::validateForm($_POST);

                if (
                    !$libro->setIdLibro($_POST['id_libro']) ||
                    !$libro->setTitulo($_POST['titulo']) ||
                    !$libro->setIdAutor($_POST['idAutor']) ||
                    !$libro->setPrecio($_POST['precio']) ||
                    !$libro->setDescripcion($_POST['descripcion']) ||
                    !$libro->setImagen($_POST['imagen']) ||
                    !$libro->setIdClasificacion($_POST['idClas']) ||
                    !$libro->setIdEditorial($_POST['idEditorial']) ||
                    !$libro->setExistencias($_POST['existencias']) ||
                    !$libro->setIdGenero($_POST['idGenero'])
                ) {
                    $result['error'] = $libro->getDataError();
                } elseif ($libro->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Libro modificado correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar el libro';
                }
                break;

            case 'deleteRow':
                if (!$libro->setIdLibro($_POST['id_libro'])) {
                    $result['error'] = $libro->getDataError();
                } elseif ($libro->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Libro eliminado correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al eliminar el libro';
                }
                break;

            default:
                $result['error'] = 'Acción no disponible dentro de la sesión';
        }

        $result['exception'] = Database::getException();

        header('Content-type: application/json; charset=utf-8');
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}