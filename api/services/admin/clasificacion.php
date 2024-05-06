<?php
// Se incluye la clase del modelo.
require_once('../../models/data/clasificacion_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $clasificacion = new clasificacionData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'dataset' => null, 'error' => null, 'exception' => null, 'fileStatus' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['idAdministrador']) or true) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'searchRows':
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } elseif ($result['dataset'] = $clasificacion->searchRows()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
                } else {
                    $result['error'] = 'No hay coincidencias';
                }
                break;
            case 'createRow':
                $_POST = Validator::validateForm($_POST);
                if (!$clasificacion->setNombre($_POST['clasificación'])) {
                    $result['error'] = $clasificacion->getDataError();
                } elseif ($clasificacion->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Clasificación creada correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al crear la clasificación';
                }
                break;
            case 'readAll':
                if ($result['dataset'] = $clasificacion->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros';
                } else {
                    $result['error'] = 'No existen clasificaciones de libros registradas';
                }
                break;
            case 'readOne':
                if (!$clasificacion->setId($_POST['idClas'])) {
                    $result['error'] = $clasificacion->getDataError();
                } elseif ($result['dataset'] = $clasificacion->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Genero de zapato inexistente';
                }
                break;
            case 'updateRow':
                $_POST = Validator::validateForm($_POST);
                if (
                    !$clasificacion->setId($_POST['idClas']) or
                    !$clasificacion->setNombre($_POST['clasificación']) or
                    !$clasificacion->setDescripcion($_POST['descripción'])
                ) {
                    $result['error'] = $clasificacion->getDataError();
                } elseif ($clasificacion->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Clasificación del libro modificado correctamente';

                }
                break;

            case 'deleteRow':
                if (!$clasificacion->setId($_POST['idClas'])) {
                    $result['error'] = $clasificacion->getDataError();
                } elseif ($clasificacion->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Clasificación del libro eliminado correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al eliminar la clasificación del zapato';
                }
                break;
            default:
                $result['error'] = 'Acción no disponible dentro de la sesión';
        }
        // Se obtiene la excepción del servidor de base de datos por si ocurrió un problema.
        $result['exception'] = Database::getException();
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('Content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}