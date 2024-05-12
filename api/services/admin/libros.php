<?php
// Importar la clase que gestiona los datos relacionados con 'libros'.
require_once ('../../models/data/libros_data.php');

// Verificar si se ha recibido una acción mediante el parámetro 'action' en la URL.
if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'LibroData' para interactuar con los datos relacionados con 'libros'.
    $libros = new LibrosData;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null // Excepción del servidor de base de datos si es aplicable.
    );

    // Verificar si el usuario tiene una sesión iniciada como administrador.
    if (isset($_SESSION['idAdministrador'])) {
        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {
            case 'searchRows':
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } elseif ($result['dataset'] = $producto->searchRows()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
                } else {
                    $result['error'] = 'No hay coincidencias';
                }
                break;

            case 'createRow': // Acción para crear un nuevo libro.
                $_POST = Validator::validateForm($_POST);

                // Validar y establecer los campos necesarios para crear un libro.
                if (
                    !$libros->setTitulo($_POST['titulo']) ||
                    !$libros->setPrecio($_POST['precio']) ||
                    !$libros->setDescripcion($_POST['descripcion']) ||
                    !$libros->setImagen($_FILES['imagen']) ||
                    !$libros->setExistencias($_POST['existencias'])
                ) {
                    $result['error'] = $libros->getDataError(); // Obtener mensaje de error si la validación falla.
                } elseif ($libros->createRow()) { // Intentar crear un nuevo libro.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Libro creado con éxito'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al crear el libro'; // Mensaje de error si ocurre un problema.
                }
                break;

            case 'readAll': // Acción para leer todos los libros.
                if ($result['dataset'] = $libros->readAll()) { // Leer todos los libros de la base de datos.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Se encontraron ' . count($result['dataset']) . ' libros'; // Mensaje con la cantidad de libros encontrados.
                } else {
                    $result['error'] = 'No se encontraron libros'; // Mensaje si no se encuentran libros.
                }
                break;

            case 'readOne': // Acción para leer un libro específico por ID.
                if (!$libros->setId($_POST['id'])) {
                    $result['error'] = $libro->getDataError(); // Mensaje de error si el ID es inválido.
                } elseif ($result['dataset'] = $libros->readOne()) { // Leer el libro específico.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                } else {
                    $result['error'] = 'Libro no encontrado'; // Mensaje de error si no se encuentra el libro.
                }
                break;

            case 'updateRow': // Acción para actualizar un libro existente.
                $_POST = Validator::validateForm($_POST);

                // Validar y establecer los campos necesarios para actualizar el libro.
                if (
                    !$libros->setId($_POST['id_libro']) ||
                    !$libros->setTitulo($_POST['titulo']) ||
                    !$libros->setPrecio($_POST['precio']) ||
                    !$libros->setDescripcion($_POST['descripcion']) ||
                    !$libros->setImagen($_FILES['imagen']) ||
                    !$libros->setExistencias($_POST['existencias'])
                ) {
                    $result['error'] = $libros->getDataError(); // Mensaje de error si la validación falla.
                } elseif ($libros->updateRow()) { // Intentar actualizar el libro.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Libro actualizado correctamente'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al actualizar el libro'; // Mensaje de error si ocurre un problema.
                }
                break;

            case 'deleteRow': // Acción para eliminar un libro por ID.
                if (!$libro->setId($_POST['id_libro'])) {
                    $result['error'] = $libros->getDataError(); // Mensaje de error si el ID es inválido.
                } elseif ($libros->deleteRow()) { // Intentar eliminar el libro.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Libro eliminado correctamente'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al eliminar el libro'; // Mensaje de error si ocurre un problema.
                }
                break;

            default: // Caso por defecto para manejar acciones desconocidas.
                $result['error'] = 'Acción no disponible dentro de la sesión'; // Mensaje si la acción no es válida.
        }

        // Capturar cualquier excepción de la base de datos.
        $result['exception'] = Database::getException();

        // Configurar el tipo de contenido para la respuesta y la codificación de caracteres.
        header('Content-Type: application/json; charset=utf-8');

        // Convertir el resultado a formato JSON y enviarlo como respuesta.
        print (json_encode($result));
    } else {
        // Si no hay una sesión válida, se devuelve un mensaje de acceso denegado.
        print (json_encode(array('error' => 'Acceso denegado')));
    }
} else {
    // Si no se recibe una acción, se devuelve un mensaje de recurso no disponible.
    print (json_encode(array('error' => 'Recurso no disponible')));
}
;
