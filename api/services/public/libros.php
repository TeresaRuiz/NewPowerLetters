<?php
// Se incluye la clase del modelo.
require_once ('../../models/data/libros_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se instancia la clase correspondiente.
    $libro = new LibroData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'dataset' => null, 'error' => null, 'exception' => null);
    // Se compara la acción a realizar según la petición del controlador.
    switch ($_GET['action']) {
        case 'readLibrosGeneros':
            if ($result['dataset'] = $libro->readAll()) {
                $result['status'] = 1;
            } else {
                $result['error'] = 'No existen libros para mostrar';
            }
            break;
        case 'readAll':
            if ($result['dataset'] = $libro->readAll()) {
                $result['status'] = 1; // Indicar que la operación fue exitosa.
                $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
            } else {
                $result['error'] = 'No existen libros registrados'; // Mensaje si no se encuentran autores.
            }
            break;
        case 'readOne':
            if (!$libro->setId($_POST['idLibro'])) {
                $result['error'] = $libro->getDataError();
            } elseif ($result['dataset'] = $libro->readOne()) {
                $result['status'] = 1;
            } else {
                $result['error'] = 'Libro inexistente';
            }
            break;
        case 'updateExistencias':
            if ($libro->setId($_POST['idLibro'])) {
                $currentExistencias = $libro->getExistencias();
                if ($currentExistencias !== false) {
                    $newExistencias = $currentExistencias - $_POST['cantidad'];
                    if ($newExistencias >= 0) {
                        $libro->setExistencias($_POST['cantidad']);
                        if ($libro->updateExistencias()) {
                            $result['status'] = 1;
                            $result['message'] = 'Existencias actualizadas correctamente';
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    } else {
                        $result['exception'] = 'Cantidad solicitada mayor a existencias disponibles';
                    }
                } else {
                    $result['exception'] = 'No se pudo obtener las existencias actuales';
                }
            } else {
                $result['exception'] = 'Libro incorrecto';
            }
            break;
        default:
            $result['error'] = 'Acción no disponible';
    }
    // Se obtiene la excepción del servidor de base de datos por si ocurrió un problema.
    $result['exception'] = Database::getException();
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('Content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print (json_encode($result));
} else {
    print (json_encode('Recurso no disponible'));
}
