<?php
// Se incluye la clase del modelo.
require_once ('../../models/data/comentarios_data.php');

if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'LibroData' para interactuar con los datos relacionados con 'comentarios'.
    $comentario = new ComentarioData;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null,// Excepción del servidor de base de datos si es aplicable.
        'fileStatus' => null
    );// Estado de archivo (si es necesario para alguna operación).

    // Verificar si el usuario tiene una sesión iniciada como administrador.
    if (isset($_SESSION['idAdministrador'])) {
        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {
            case 'searchRows':
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } elseif ($result['dataset'] = $comentario->searchRows()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
                } else {
                    $result['error'] = 'No hay coincidencias';
                }
                break;

            case 'createRow': // Acción para crear un nuevo comentario.
                $_POST = Validator::validateForm($_POST);

                // Validar y establecer los campos necesarios para crear un comentario.
                if (
                    !$comentario->setId($_POST['id_comentario']) or
                    !$comentario->setComentario($_POST['comentario']) or
                    !$comentario->setEstado(isset($_POST['estadoComentario']) ? 1 : 0)
                ) {
                    $result['error'] = $comentario->getDataError(); // Obtener mensaje de error si la validación falla.
                } elseif ($comentario->createRow()) { // Intentar crear un nuevo comentario.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Comentario creado con éxito';
                } else {
                    $result['error'] = 'Ocurrió un problema al crear el comentario'; // Mensaje de error si ocurre un problema.
                }
                break;
            case 'readAll':
                if ($result['dataset'] = $comentario->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros';
                } else {
                    $result['error'] = 'No existen comentarios registrados';
                }
                break;
            case 'readOne':
                if (!$comentario->setId($_POST['id_comentario'])) {
                    $result['error'] = $comentario->getDataError();
                } elseif ($result['dataset'] = $comentario->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Comentario inexistente';
                }
                break;

            case 'updateRow':
                $_POST = Validator::validateForm($_POST);
                if (
                    !$comentario->setId($_POST['id_comentario']) ||
                    !$comentario->setEstado($_POST['estadoComentario'])
                ) {
                    $result['error'] = $comentario->getDataError();
                } elseif ($comentario->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Comentario modificado correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar el estado';
                }
                break;
            case 'getEstados':
                if ($result['dataset'] = $comentario->getEstados()) {
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                } else {
                    $result['error'] = 'No exiten estados disponibles'; // Mensaje si no se encuentran autores.
                }
                break;

            default: // Caso por defecto para manejar acciones desconocidas.
                $result['error'] = 'Acción no disponible dentro de la sesión'; // Mensaje si la acción no es válida.
        }

        // Capturar cualquier excepción de la base de datos.
        $result['exception'] = Database::getException();

        // Configurar el tipo de contenido para la respuesta y la codificación de caracteres.
        header('Content-type: application/json; charset=utf-8');

        // Convertir el resultado a formato JSON y enviarlo como respuesta.
        print (json_encode($result));
    } else {
        // Si no hay una sesión válida, se devuelve un mensaje de acceso denegado.
        print (json_encode('Acceso denegado'));
    }
} else {
    // Si no se recibe una acción, se devuelve un mensaje de recurso no disponible.
    print (json_encode('Recurso no disponible'));
}