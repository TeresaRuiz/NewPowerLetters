<?php
// Se incluye la clase del modelo.
require_once ('../../models/data/usuario_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $Usuario = new UsuarioData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'session' => 0, 'recaptcha' => 0, 'message' => null, 'error' => null, 'exception' => null, 'fileStatus' => null, 'username' => null);
    // Se verifica si existe una sesión iniciada como usua$Usuario para realizar las acciones correspondientes.
    if (isset($_SESSION['idusua$Usuario'])) {
        $result['session'] = 1;
        // Se compara la acción a realizar cuando un usua$Usuario ha iniciado sesión.
        switch ($_GET['action']) {
            case 'getUser':
                if (isset($_SESSION['correoUsuario'])) {
                    $result['status'] = 1;
                    $result['username'] = $_SESSION['correoUsuario'];
                } else {
                    $result['error'] = 'Correo de usuario indefinido';
                }
                break;
            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
            default:
                $result['error'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando el usua$Usuario no ha iniciado sesión.
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
                } elseif (!isset($_POST['condicion'])) {
                    $result['error'] = 'Debe marcar la aceptación de términos y condiciones';
                } elseif (
                    !$Usuario->setNombre($_POST['nombreUsuario']) or
                    !$Usuario->setNombreUsuario($_POST['usuario']) or
                    !$Usuario->setCorreo($_POST['correoUsuario']) or
                    !$Usuario->setClave($_POST['claveUsuario']) or
                    !$Usuario->setDireccion($_POST['direccionUsuario']) or
                    !$Usuario->setTelefono($_POST['telefonoUsuario']) or
                    !$Usuario->setImagen($_FILES['imagen']) ||
                    !$Usuario->setFecha($_POST['fechaUsuario'])
                ) {
                    $result['error'] = $Usuario->getDataError();
                } elseif ($_POST['claveUsuario'] != $_POST['confirmarClave']) {
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
            case 'readAll':
                if ($result['dataset'] = $Usuario->readAll()) {
                    $result['status'] = 1; // Indicar que la operación fue exitosa.
                    $result['message'] = 'Existen ' . count($result['dataset']) . ' registros'; // Mensaje con la cantidad de registros encontrados.
                } else {
                    $result['error'] = 'No exiten usuarios registrados'; // Mensaje si no se encuentran autores.
                }
                break;

            case 'readOne':
                if (!$libros->setId($_POST['id_usuario'])) {
                    $result['error'] = $libros->getDataError();
                } elseif ($result['dataset'] = $libros->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Usuario inexistente';
                }
                break;
            default:
                $result['error'] = 'Acción no disponible fuera de la sesión';
        }
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