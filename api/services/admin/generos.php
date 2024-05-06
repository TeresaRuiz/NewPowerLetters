<?php
// Se incluye la clase del modelo.
require_once('../../models/data/genero_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $genero = new GeneroData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array(
        'status' => 0,
        'message' => null,
        'dataset' => null,
        'error' => null,
        'exception' => null,
        'fileStatus' => null
    );

    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['idAdministrador'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'searchRows':
                // Validar el término de búsqueda
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } else {
                    $genero->setNombre($_POST['search']);
                    $dataset = $genero->searchRows();

                    if ($dataset) {
                        $result['status'] = 1;
                        $result['message'] = 'Se encontraron ' . count($dataset) . ' coincidencias';
                        $result['dataset'] = $dataset;
                    } else {
                        $result['error'] = 'No se encontraron coincidencias';
                    }
                }
                break;

            case 'createRow':
                $_POST = Validator::validateForm($_POST);

                if (!$genero->setNombre($_POST['nombre'])) {
                    $result['error'] = 'Error al establecer el nombre';
                } else {
                    if ($genero->createRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Género creado correctamente';
                    } else {
                        $result['error'] = 'Ocurrió un problema al crear el género';
                    }
                }
                break;

            case 'readAll':
                $dataset = $genero->readAll();
                if ($dataset) {
                    $result['status'] = 1;
                    $result['message'] = 'Se encontraron ' . count($dataset) . ' géneros';
                    $result['dataset'] = $dataset;
                } else {
                    $result['error'] = 'No se encontraron géneros';
                }
                break;

            case 'readOne':
                if (!$genero->setId($_POST['idGenero'])) {
                    $result['error'] = 'ID no válido';
                } else {
                    $dataset = $genero->readOne();
                    if ($dataset) {
                        $result['status'] = 1;
                        $result['dataset'] = $dataset;
                    } else {
                        $result['error'] = 'Género no encontrado';
                    }
                }
                break;

            case 'updateRow':
                $_POST = Validator::validateForm($_POST);

                if (!$genero->setId($_POST['idGenero'])) {
                    $result['error'] = 'ID no válido';
                } elseif (!$genero->setNombre($_POST['nombre'])) {
                    $result['error'] = 'Error al establecer el nombre';
                } else {
                    if ($genero->updateRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Género actualizado correctamente';
                    } else {
                        $result['error'] = 'Ocurrió un problema al actualizar el género';
                    }
                }
                break;

            case 'deleteRow':
                if (!$genero->setId($_POST['idGenero'])) {
                    $result['error'] = 'ID no válido';
                } else {
                    if ($genero->deleteRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Género eliminado correctamente';
                    } else {
                        $result['error'] = 'Ocurrió un problema al eliminar el género';
                    }
                }
                break;

            default:
                $result['error'] = 'Acción no disponible';
                break;
        }

        // Se obtiene la excepción del servidor de base de datos por si ocurrió un problema.
        $result['exception'] = Database::getException();

        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('Content-type: application/json; charset=utf-8');

        // Se imprime el resultado en formato JSON y se retorna al controlador.
        echo json_encode($result);
    } else {
        echo json_encode(array('error' => 'Acceso denegado'));
    }
} else {
    echo json_encode(array('error' => 'Recurso no disponible'));
}
