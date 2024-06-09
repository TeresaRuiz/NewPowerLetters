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

  
        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {
            
            case 'readAll': // Acción para leer todas las filas (géneros).
                if ($result['dataset'] = $genero->readAll()) { // Leer todos los géneros de la base de datos.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
                } else {
                    $result['error'] = 'No existen géneros registrados'; // Mensaje si no se encuentran géneros.
                }
                break;
            }

        // Capturar cualquier excepción de la base de datos.
        $result['exception'] = Database::getException();

        // Configurar el tipo de contenido para la respuesta y la codificación de caracteres.
        header('Content-type: application/json; charset=utf-8');

        // Convertir el resultado a formato JSON y enviarlo como respuesta.
        print(json_encode($result));
   

}