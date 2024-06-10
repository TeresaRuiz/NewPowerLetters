<?php
// Se incluye la clase del modelo.
require_once ('../../models/data/pedido_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $pedido = new PedidoData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'session' => 0, 'message' => null, 'error' => null, 'exception' => null, 'dataset' => null, 'cliente' => 0, 'pedido' => 0);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['idUsuario'])) {
        $result['session'] = 1;
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {
            // Acción para agregar un producto al carrito de compras.
            case 'createDetail':
                $_POST = Validator::validateForm($_POST);
                if (!$pedido->startOrder()) {
                    $result['error'] = 'Ocurrió un problema al iniciar el pedido';
                } elseif (
                    !$pedido->setLibro($_POST['idLibro']) or
                    !$pedido->setCantidad($_POST['cantidadLibro'])
                ) {
                    $result['error'] = $pedido->getDataError();
                } elseif ($pedido->createDetail()) {
                    $result['status'] = 1;
                    $result['message'] = 'Libro agregado correctamente';
                    $result['cliente'] = $_SESSION['idUsuario'];
                    $result['pedido'] = $_SESSION['idPedido'];
                } else {
                    $result['error'] = 'Ocurrió un problema al agregar el libro';
                }
                break;
            // Acción para obtener los productos agregados en el carrito de compras.
            case 'readDetail':
                if ($pedido->getOrder()) {
                    $result['dataset'] = $pedido->readDetail();
                    if ($result['dataset']) {
                        $result['status'] = 1;
                        $result['cliente'] = $_SESSION['idUsuario'];
                        $result['pedido'] = $_SESSION['idPedido'];
                    } else {
                        $result['error'] = 'No existen libros en el carrito';
                    }
                } else {
                    $result['error'] = 'No ha agregado libros al carrito';
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

            // Acción para actualizar la cantidad de un producto en el carrito de compras.
            case 'updateDetail':
                $_POST = Validator::validateForm($_POST);
                if (
                    !$pedido->setIdDetalle($_POST['idDetalle']) or
                    !$pedido->setCantidad($_POST['cantidadLibro'])
                ) {
                    $result['error'] = $pedido->getDataError();
                } else {
                    // Obtener las existencias actuales del libro asociado al detalle del pedido
                    $sqlExistencias = 'SELECT existencias FROM tb_libros WHERE id_libro = (
                                        SELECT id_libro FROM tb_detalle_pedidos WHERE id_detalle = ?)';
                    $paramsExistencias = array($_POST['idDetalle']);
                    $existenciasActuales = Database::getRow($sqlExistencias, $paramsExistencias)['existencias'];
            
                    // Obtener la cantidad anterior del detalle del pedido
                    $sqlCantidadAnterior = 'SELECT cantidad FROM tb_detalle_pedidos WHERE id_detalle = ?';
                    $paramsCantidadAnterior = array($_POST['idDetalle']);
                    $cantidadAnterior = Database::getRow($sqlCantidadAnterior, $paramsCantidadAnterior)['cantidad'];
            
                    // Calcular las nuevas existencias teniendo en cuenta la cantidad anterior y la nueva cantidad
                    $existenciasNuevas = $existenciasActuales + $cantidadAnterior - $_POST['cantidadLibro'];
            
                    // Verificar si la cantidad es igual o menor que las existencias disponibles
                    if ($_POST['cantidadLibro'] <= $existenciasNuevas) {
                        // Actualizar el detalle del pedido
                        $pedido->setIdDetalle($_POST['idDetalle']);
                        $pedido->setCantidad($_POST['cantidadLibro']);
                        if ($pedido->updateDetail()) {
                            // Actualizar las existencias del libro en la tabla tb_libros
                            $sqlUpdateExistencias = 'UPDATE tb_libros SET existencias = ? WHERE id_libro = (
                                                     SELECT id_libro FROM tb_detalle_pedidos WHERE id_detalle = ?)';
                            $paramsUpdateExistencias = array($existenciasNuevas, $_POST['idDetalle']);
                            Database::executeRow($sqlUpdateExistencias, $paramsUpdateExistencias);
            
                            $result['status'] = 1;
                            $result['message'] = 'Cantidad modificada correctamente';
                            $result['cliente'] = $_SESSION['idUsuario'];
                            $result['pedido'] = $_SESSION['idPedido'];
                        } else {
                            $result['error'] = 'Ocurrió un problema al modificar la cantidad';
                        }
                    } else {
                        // La cantidad excede las existencias disponibles, devolver un mensaje de error
                        $result['error'] = 'La cantidad especificada excede las existencias disponibles del libro.';
                    }
                }
                break;
            
            
            // Acción para remover un producto del carrito de compras.
            case 'deleteDetail':
                if (!$pedido->setIdDetalle($_POST['idDetalle'])) {
                    $result['error'] = $pedido->getDataError();
                } elseif ($pedido->deleteDetail()) {
                    $result['status'] = 1;
                    $result['message'] = 'Libro removido correctamente';
                    $result['cliente'] = $_SESSION['idUsuario'];
                    $result['pedido'] = $_SESSION['idPedido'];
                } else {
                    $result['error'] = 'Ocurrió un problema al remover el producto';
                }
                break;
            // Acción para finalizar el carrito de compras.
            case 'finishOrder':
                $result['cliente'] = $_SESSION['idUsuario'];
                $result['pedido'] = $_SESSION['idPedido'];
                if ($pedido->finishOrder()) {
                    $result['status'] = 1;
                    $result['message'] = 'Pedido finalizado correctamente';
                    $result['cliente'] = $_SESSION['idUsuario'];
                    $result['pedido'] = $_SESSION['idPedido'];
                } else {
                    $result['error'] = 'Ocurrió un problema al finalizar el pedido';
                }
                break;

            // Caso para leer el historial de pedidos
            case 'readHistorial':
                $result['dataset'] = $pedido->readHistorial($_SESSION['idUsuario']);
                if ($result['dataset']) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'No tiene pedidos realizados';
                }
                break;


            default:
                $result['error'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando un cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'createDetail':
                $result['error'] = 'Debe iniciar sesión para agregar el producto al carrito';
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
