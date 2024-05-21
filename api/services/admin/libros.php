<?php
// Se incluye la clase del modelo.
require_once ('../../models/data/libros_data.php');

if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'LibroData' para interactuar con los datos relacionados con 'libros'.
    $libros = new LibroData;

    // Inicializar un arreglo para almacenar el resultado de las operaciones de la API.
    $result = array(
        'status' => 0, // Indicador del estado de la operación, 0 para fallo, 1 para éxito.
        'message' => null, // Mensaje descriptivo del resultado.
        'dataset' => null, // Datos resultantes de la operación.
        'error' => null, // Mensaje de error si ocurre un problema.
        'exception' => null,// Excepción del servidor de base de datos si es aplicable.
        'fileStatus' => null);// Estado de archivo (si es necesario para alguna operación).

    // Verificar si el usuario tiene una sesión iniciada como administrador.
    if (isset($_SESSION['idAdministrador'])) {
        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {
            case 'searchRows':
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError();
                } elseif ($result['dataset'] = $libros->searchRows()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias';
                } else {
                    $result['error'] = 'No hay coincidencias';
                }
                break;

            case 'createRow': // Implementación del caso createRow
                $_POST = Validator::validateForm($_POST);

                // Validar y establecer los campos necesarios para crear un libro.
                if (
                    !$libros->setTitulo($_POST['titulo']) ||
                    !$libros->setAutor($_POST['autor']) ||
                    !$libros->setPrecio($_POST['precio']) ||
                    !$libros->setDescripcion($_POST['descripcion']) ||
                    !$libros->setImagen($_FILES['imagen']) ||
                    !$libros->setClasificación($_POST['clasificacion']) ||
                    !$libros->setEditorial($_POST['editorial']) ||
                    !$libros->setExistencias($_POST['existencias']) ||
                    !$libros->setGenero($_POST['nombreGEN'])
                ) {
                    $result['error'] = $libros->getDataError(); // Obtener mensaje de error si la validación falla.
                } elseif ($libros->createRow()) { // Intentar crear un nuevo libro.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Libro creado con éxito';
                    $result['fileStatus'] = Validator::saveFile($_FILES['imagen'], $libros::RUTA_IMAGEN);
                } else {
                    $result['error'] = 'Ocurrió un problema al crear el libro'; // Mensaje de error si ocurre un problema.
                }
                break;


            case 'readAll':
                if ($result['dataset'] = $libros->readAll()) {
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
                } else {
                    $result['error'] = 'No existen libros registrados'; // Mensaje si no se encuentran autores.
                }
                break;

            case 'readOne':
                if (!$libros->setId($_POST['id_libro'])) {
                    $result['error'] = $libros->getDataError();
                } elseif ($result['dataset'] = $libros->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Libro inexistente';
                }
                break;

                
            case 'updateRow':
                $_POST = Validator::validateForm($_POST);
                if (
                    !$libros->setId($_POST['id_libro']) or
                    !$libros->setFilename() or
                    !$libros->setTitulo($_POST['titulo']) ||
                    !$libros->setAutor($_POST['autor']) ||
                    !$libros->setPrecio($_POST['precio']) ||
                    !$libros->setDescripcion($_POST['descripcion']) ||
                    !$libros->setImagen($_FILES['imagen']) ||
                    !$libros->setClasificación($_POST['clasificacion']) ||
                    !$libros->setEditorial($_POST['editorial']) ||
                    !$libros->setExistencias($_POST['existencias']) ||
                    !$libros->setGenero($_POST['nombreGEN'])
                ) {
                    $result['error'] = $libros->getDataError(); // Mensaje de error si la validación falla.
                } elseif ($libros->updateRow()) { // Intentar actualizar la fila.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Libro modificado correctamente'; // Mensaje de éxito.
                    $result['fileStatus'] = Validator::saveFile($_FILES['imagen'], $libros::RUTA_IMAGEN);
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar el libro'; // Mensaje de error si ocurre un problema.
                }
                break;
            case 'deleteRow': // Acción para eliminar una fila por ID.
                // Verificar y establecer el ID del género a eliminar.
                if (!$libros->setId($_POST['id_libro'])) {
                    $result['error'] = $libros->getDataError(); // Mensaje de error si el ID es inválido.
                } elseif ($libros->deleteRow()) { // Intentar eliminar la fila.
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