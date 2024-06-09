<?php
// Se incluye la clase del modelo.
require_once ('../../models/data/pedido_data.php');

if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'PedidoData' para interactuar con los datos relacionados con 'Pedido'.
    $pedido = new PedidoData;

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
    if (isset($_SESSION['idAdministrador'])or true) {
        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {
            case 'searchRows':
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } elseif ($result['dataset'] = $pedido->searchRows()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
                } else {
                    $result['error'] = 'No hay coincidencias';
                }
                break;

            case 'createRow': // Acción para crear un nuevo pedido.
                $_POST = Validator::validateForm($_POST);

                // Validar y establecer los campos necesarios para crear un pedido.
                if (
                    !$pedido->setId($_POST['id_pedido']) or
                    !$pedido->setIdUsuario($_POST['usuario']) or
                    !$pedido->setDireccion($_POST['direccion']) ||
                    !$pedido->setEstado(isset($_POST['estadoProducto']) ? 1 : 0) ||
                    !$pedido->setFecha($_POST['fecha']) ||
                    !$pedido->setIdDetalle($_POST['detalle'])
                ) {
                    $result['error'] = $pedido->getDataError(); // Obtener mensaje de error si la validación falla.
                } elseif ($pedido->createRow()) { // Intentar crear un nuevo pedido.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Pedido creado con éxito';
                } else {
                    $result['error'] = 'Ocurrió un problema al crear el pedido'; // Mensaje de error si ocurre un problema.
                }
                break;

            case 'readAll':
                // Implementación del caso readAll
                if ($result['dataset'] = $pedido->readAll()) {
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
                } else {
                    $result['error'] = 'No existen pedidos registrados'; // Mensaje si no se encuentran autores.
                }
                break;
            case 'readOne':
                // Implementación del caso readOne
                if (!$pedido->setId($_POST['id_pedido'])) {
                    $result['error'] = $pedido->getDataError();
                } elseif ($result['dataset'] = $pedido->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Pedido inexistente';
                }
                break;

            case 'updateRow':
                // Implementación del caso updateRow
                $_POST = Validator::validateForm($_POST);
                if (
                    !$pedido->setId($_POST['id_pedido']) or
                    !$pedido->setDireccion($_POST['direccion']) ||
                    !$pedido->setEstado($_POST['estadoPedido'])
                ) {
                    $result['error'] = $pedido->getDataError(); // Mensaje de error si la validación falla.
                } elseif ($pedido->updateRow()) { // Intentar actualizar la fila.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Pedido modificado correctamente'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar el estado'; // Mensaje de error si ocurre un problema.
                }
                break;
            case 'getEstados':
                if ($result['dataset'] = $pedido->getEstados()) {
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