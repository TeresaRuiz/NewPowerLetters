<?php
// Importar la clase que gestiona los datos relacionados con 'género'.
require_once('../../models/data/genero_data.php');

// Verificar si se ha recibido una acción mediante el parámetro 'action' en la URL.
if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'generoData' para interactuar con los datos relacionados con 'género'.
    $genero = new GeneroData;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación, como una lista de géneros.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null, // Excepción del servidor de base de datos si es aplicable.
        'fileStatus' => null // Estado de archivo (si es necesario para alguna operación).
    );

    // Verificar si el usuario tiene una sesión iniciada como administrador.
    if (isset($_SESSION['idAdministrador'])) { // 'true' para permitir el acceso durante el desarrollo, cambiar a solo 'isset($_SESSION['idAdministrador'])' en producción.

        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {
            case 'searchRows': // Acción para buscar filas (géneros) según un término de búsqueda.
                // Validar el término de búsqueda usando una clase de validación.
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError(); // Mensaje de error si la validación falla.
                } elseif ($result['dataset'] = $genero->searchRows()) { // Buscar filas en la base de datos.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias'; // Mensaje con la cantidad de coincidencias encontradas.
                } else {
                    $result['error'] = 'No hay coincidencias'; // Mensaje si no se encontraron resultados.
                }
                break;

            case 'createRow': // Acción para crear una nueva fila (género).
                // Validar los datos del formulario.
                $_POST = Validator::validateForm($_POST);

                // Establecer el nombre del nuevo género.
                if (!$genero->setNombre($_POST['nombreGEN'])) {
                    $result['error'] = $genero->getDataError(); // Obtener mensaje de error si la validación falla.
                } elseif ($genero->createRow()) { // Intentar crear una nueva fila.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Género creado correctamente'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al crear el género'; // Mensaje de error si ocurre un problema al crear.
                }
                break;

            case 'readAll': // Acción para leer todas las filas (géneros).
                if ($result['dataset'] = $genero->readAll()) { // Leer todos los géneros de la base de datos.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
                } else {
                    $result['error'] = 'No existen géneros registrados'; // Mensaje si no se encuentran géneros.
                }
                break;

            case 'readOne': // Acción para leer una fila específica por ID.
                // Validar e ingresar el ID del género.
                if (!$genero->setId($_POST['idGenero'])) {
                    $result['error'] = $genero->getDataError(); // Mensaje de error si el ID es inválido.
                } elseif ($result['dataset'] = $genero->readOne()) { // Leer el género específico.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                } else {
                    $result['error'] = 'Género inexistente'; // Mensaje de error si no se encuentra el género.
                }
                break;

            case 'updateRow': // Acción para actualizar una fila existente.
                // Validar y sanitizar los datos del formulario.
                $_POST = Validator::validateForm($_POST);

                // Verificar y establecer el ID y el nombre del género a actualizar.
                if (
                    !$genero->setId($_POST['idGenero']) ||
                    !$genero->setNombre($_POST['nombreGEN'])
                ) {
                    $result['error'] = $genero->getDataError(); // Mensaje de error si la validación falla.
                } elseif ($genero->updateRow()) { // Intentar actualizar la fila.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Género modificado correctamente'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar el género'; // Mensaje de error si ocurre un problema.
                }
                break;

            case 'deleteRow': // Acción para eliminar una fila por ID.
                // Verificar y establecer el ID del género a eliminar.
                if (!$genero->setId($_POST['idGenero'])) {
                    $result['error'] = $genero->getDataError(); // Mensaje de error si el ID es inválido.
                } elseif ($genero->deleteRow()) { // Intentar eliminar la fila.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Género eliminado correctamente'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al eliminar el género'; // Mensaje de error si ocurre un problema.
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
        print(json_encode($result));
    } else {
        // Si no hay una sesión válida, se devuelve un mensaje de acceso denegado.
        print(json_encode('Acceso denegado'));
    }
} else {
    // Si no se recibe una acción, se devuelve un mensaje de recurso no disponible.
    print(json_encode('Recurso no disponible'));
}