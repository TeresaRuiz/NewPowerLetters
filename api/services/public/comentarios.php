<?php
// Se incluye la clase del modelo.
require_once('../../models/data/comentario_data_public.php');

if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'LibroData' para interactuar con los datos relacionados con 'comentarios'.
    $comentariop = new ComentarioDataPublic;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null, // Excepción del servidor de base de datos si es aplicable.
        'fileStatus' => null,
        'cliente' => 0,
        'detalle' => 0,
        'libro' => 0
    ); // Estado de archivo (si es necesario para alguna operación).

    // Verificar si el usuario tiene una sesión iniciada como administrador.

    if (isset($_SESSION['idUsuario'])) {
        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {

            case 'createRow': // Acción para crear un nuevo comentario.
                $_POST = Validator::validateForm($_POST);
                // Validar y establecer los campos necesarios para crear un comentario.
                if (
                    !$comentariop->setLibro($_POST['id_libro']) or
                    !$comentariop->setCalificacion($_POST['calificacion']) or
                    !$comentariop->setComentario($_POST['comentario'])
                ) {
                    $result['error'] = $comentariop->getDataError(); // Obtener mensaje de error si la validación falla.
                } elseif ($comentariop->createComment()) { // Intentar crear un nuevo comentario.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['cliente'] = $_SESSION['idUsuario'];
                    $result['libro'] = $_SESSION['libro'];
                    $result['detalle'] = $_SESSION['idDetalle'];
                    $result['message'] = 'Comentario creado con éxito';
                } else {
                    $result['error'] = 'Debe comprar el producto para comentar'; // Mensaje de error si ocurre un problema.
                }
                break;
            case 'readAll':
                if ($result['dataset'] = $comentariop->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros';
                } else {
                    $result['error'] = 'No existen comentarios registrados';
                }
                break;

                //LLAMADA DE METODO PARA LEER  COMENTARIOS DE UN SOLO LIBRO//
            case 'readOneComment':
                if (!$comentariop->setId($_POST['id_libro'])) {
                    $result['error'] = $comentariop->getDataError();
                } elseif ($result['dataset'] = $comentariop->readOneComent()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros';
                } else {
                    $result['error'] = 'No existen comentarios registrados';
                }
                break;
            case 'readOne':
                if (!$comentariop->setId($_POST['id_comentario'])) {
                    $result['error'] = $comentariop->getDataError();
                } elseif ($result['dataset'] = $comentariop->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Comentario inexistente';
                }
                break;

            case 'updateRow':
                $_POST = Validator::validateForm($_POST);
                if (
                    !$comentariop->setId($_POST['id_comentario'])

                ) {
                    $result['error'] = $comentariop->getDataError();
                } elseif ($comentariop->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Comentario modificado correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar el estado';
                }
                break;

            case 'getEstados':
                if ($result['dataset'] = $comentariop->getEstados()) {
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                } else {
                    $result['error'] = 'No exiten estados disponibles'; // Mensaje si no se encuentran autores.
                }
                break;
        }

        // Capturar cualquier excepción de la base de datos.
        $result['exception'] = Database::getException();

        // Configurar el tipo de contenido para la respuesta y la codificación de caracteres.
        header('Content-type: application/json; charset=utf-8');

        // Convertir el resultado a formato JSON y enviarlo como respuesta.
        print(json_encode($result));
    } else {
        // Si no hay una sesión válida, se devuelve un mensaje de acceso denegado.
        print(json_encode('Acceso denegado'));
    }
} else {
    // Si no se recibe una acción, se devuelve un mensaje de recurso no disponible.
    print(json_encode('Recurso no disponible'));
}
