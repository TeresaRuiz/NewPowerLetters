<?php
// Se incluye la clase del modelo.
require_once('../../models/data/editoriales_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $editorial = new EditorialData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'dataset' => null, 'error' => null, 'exception' => null, 'fileStatus' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['idAdministrador'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'searchRows':
                // Implementación del caso searchRows
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } elseif ($result['dataset'] = $editorial->searchRows()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
                } else {
                    $result['error'] = 'No hay coincidencias';
                }
                break;
            case 'createRow':
                // Implementación del caso createRow
                $_POST = Validator::validateForm($_POST);
                if (!$editorial->setNombre($_POST['editorial'])) {
                    $result['error'] = $editorial->getDataError();
                } elseif ($editorial->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Editorial creada correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al crear la editorial';
                }
                break;
            case 'readAll':
                // Implementación del caso readAll
                if ($result['dataset'] = $editorial->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros';
                } else {
                    $result['error'] = 'No existen editoriales registradas';
                }
                break;
            case 'readOne':
                // Implementación del caso readOne
                if (!$editorial->setId($_POST['idEditorial'])) {
                    $result['error'] = $editorial->getDataError();
                } elseif ($result['dataset'] = $editorial->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Editorial inexistente';
                }
                break;
            case 'updateRow':
                // Implementación del caso updateRow
                $_POST = Validator::validateForm($_POST);
                if (
                    !$editorial->setId($_POST['idEditorial']) or
                    !$editorial->setNombre($_POST['editorial'])
                ) {
                    $result['error'] = $editorial->getDataError();
                } elseif ($editorial->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Editorial modificada correctamente';
                    // Se asigna el estado del archivo después de actualizar.
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar la editorial';
                }
                break;
            case 'deleteRow':
                // Implementación del caso deleteRow
                if (!$editorial->setId($_POST['idEditorial'])) {
                    $result['error'] = $editorial->getDataError();
                } elseif ($editorial->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Editorial eliminada correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al eliminar la editorial';
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