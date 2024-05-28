<?php
// Importar la clase que gestiona los datos relacionados con 'género'.
require_once ('../../models/data/usuario_data.php');

// Verificar si se ha recibido una acción mediante el parámetro 'action' en la URL.
if (isset($_GET['action'])) {
    // Iniciar una nueva sesión o reanudar la existente para utilizar variables de sesión.
    session_start();

    // Crear una instancia de la clase 'UsuarioData' para interactuar con los datos relacionados con 'género'.
    $Usuario = new UsuarioData;
 
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
    if (isset($_SESSION['id_usuario'])) { // 'true' para permitir el acceso durante el desarrollo, cambiar a solo 'isset($_SESSION['idAdministrador'])' en producción.

        // Usar un 'switch' para manejar la acción específica solicitada por el usuario.
        switch ($_GET['action']) {
            case 'searchRows': // Acción para buscar filas (géneros) según un término de búsqueda.
                // Validar el término de búsqueda usando una clase de validación.
                if (!Validator::validateSearch($_POST['search'])) {
                    $result['error'] = Validator::getSearchError(); // Mensaje de error si la validación falla.
                } elseif ($result['dataset'] = $Usuario->searchRows()) { // Buscar filas en la base de datos.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' coincidencias'; // Mensaje con la cantidad de coincidencias encontradas.
                } else {
                    $result['error'] = 'No hay coincidencias'; // Mensaje si no se encontraron resultados.
                }
                break;

            case 'readAll': // Acción para leer todas las filas (géneros).
                if ($result['dataset'] = $Usuario->readAll()) { // Leer todos los géneros de la base de datos.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
                } else {
                    $result['error'] = 'No existen usuarios registrados'; // Mensaje si no se encuentran géneros.
                }
                break;

            case 'readOne': // Acción para leer una fila específica por ID.
                // Validar e ingresar el ID del género.
                if (!$Usuario->setId($_POST['id_usuario'])) {
                    $result['error'] = $Usuario->getDataError(); // Mensaje de error si el ID es inválido.
                } elseif ($result['dataset'] = $Usuario->readOne()) { // Leer el género específico.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                } else {
                    $result['error'] = 'Usuario inexistente'; // Mensaje de error si no se encuentra el género.
                }
                break;

            case 'updateRow':
                // Validar y sanitizar los datos del formulario.
                $_POST = Validator::validateForm($_POST);

                // Verificar y establecer el ID y el estado del usuario a actualizar.
                if (!$Usuario->setId($_POST['id_usuario']) || !$Usuario->setEstado($_POST['estado_cliente'])) {
                    $result['error'] = $Usuario->getDataError(); // Mensaje de error si la validación falla.
                } elseif ($Usuario->updateRow()) { // Intentar actualizar la fila.
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Usuario modificado correctamente'; // Mensaje de éxito.
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar el usuario'; // Mensaje de error si ocurre un problema.
                }
                break;

            default: // Caso por defecto para manejar acciones desconocidas.
                $result['error'] = 'Acción no disponible dentro de la sesión'; // Mensaje si la acción no es válida.
        } else {
            // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
            switch ($_GET['action']) {
                case 'signUp':
                    $_POST = Validator::validateForm($_POST);
                    // Se establece la clave secreta para el reCAPTCHA de acuerdo con la cuenta de Google.
                    $secretKey = '6LdBzLQUAAAAAL6oP4xpgMao-SmEkmRCpoLBLri-';
                    // Se establece la dirección IP del servidor.
                    $ip = $_SERVER['REMOTE_ADDR'];
                    // Se establecen los datos del raCAPTCHA.
                    $data = array('secret' => $secretKey, 'response' => $_POST['gRecaptchaResponse'], 'remoteip' => $ip);
                    // Se establecen las opciones del reCAPTCHA.
                    $options = array(
                        'http' => array('header' => 'Content-type: application/x-www-form-urlencoded\r\n', 'method' => 'POST', 'content' => http_build_query($data)),
                        'ssl' => array('verify_peer' => false, 'verify_peer_name' => false)
                    );
    
                    $url = 'https://www.google.com/recaptcha/api/siteverify';
                    $context = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);
                    $captcha = json_decode($response, true);
    
                    if (!$captcha['success']) {
                        $result['recaptcha'] = 1;
                        $result['error'] = 'No eres humano';
                    } elseif(!isset($_POST['condicion'])) {
                        $result['error'] = 'Debe marcar la aceptación de términos y condiciones';
                    } elseif (
                        !$Usuario->setNombre($_POST['nombreCliente']) or
                        !$Usuario->setUsuario($_POST['usuarioCliente']) or
                        !$Usuario->setCorreo($_POST['correoCliente']) or
                        !$Usuario->setDireccion($_POST['direccionCliente']) or
                        !$Usuario->setTelefono($_POST['telefonoCliente']) or
                        !$Usuario->setClave($_POST['claveCliente'])
                    ) {
                        $result['error'] = $Usuario->getDataError();
                    } elseif ($_POST['claveCliente'] != $_POST['confirmarClave']) {
                        $result['error'] = 'Contraseñas diferentes';
                    } elseif ($Usuario->createRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Cuenta registrada correctamente';
                    } else {
                        $result['error'] = 'Ocurrió un problema al registrar la cuenta';
                    }
                    break;
                case 'logIn':
                    $_POST = Validator::validateForm($_POST);
                    if (!$Usuario->checkUser($_POST['correo'], $_POST['clave'])) {
                        $result['error'] = 'Datos incorrectos';
                    } elseif ($Usuario->checkStatus()) {
                        $result['status'] = 1;
                        $result['message'] = 'Autenticación correcta';
                    } else {
                        $result['error'] = 'La cuenta ha sido desactivada';
                    }
                    break;
                default:
                    $result['error'] = 'Acción no disponible fuera de la sesión';
            }
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