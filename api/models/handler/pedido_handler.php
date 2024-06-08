<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');

/*
 * Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
 */
class PedidoHandler
{
    /*
     * Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $id_usuario = null;
    protected $direccion = null;
    protected $estado = null;
    protected $fecha = null;
    protected $libro = null;
    protected $cantidad = null;
    protected $id_detalle = null;

    /*
     * Método para buscar registros en la tabla tb_pedidos.
     */


     public function getOrder()
     {
         $this->estado = 'PENDIENTE';
         $sql = 'SELECT p.id_pedido
                 FROM tb_pedidos AS p
                 JOIN tb_usuarios AS u ON p.id_usuario = u.id_usuario
                 WHERE p.estado = ? AND u.id_usuario = ?';
         $params = array($this->estado, $_SESSION['idUsuario']);
         if ($data = Database::getRow($sql, $params)) {
            $_SESSION['idPedido'] = $data['id_pedido'];
             return true;
         } else {
             return false;
         }
     }
     

    public function startOrder()
    {
        if ($this->getOrder()) {
            return true;
        } else {
            $sql = 'INSERT INTO tb_pedidos(direccion_pedido, id_usuario)
                VALUES((SELECT direccion_usuario FROM tb_usuarios WHERE id_usuario = ?), ?)';
            $params = array($_SESSION['idUsuario'], $_SESSION['idUsuario']);
            // Se obtiene el ultimo valor insertado de la llave primaria en la tabla tb_pedidos.
            if ($_SESSION['idPedido'] = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }

    
    public function createDetail()
    {
        $sql = 'INSERT INTO tb_detalle_pedidos(id_libro, cantidad, precio, id_pedido)
            VALUES(?, ?, (SELECT precio FROM tb_libros WHERE id_libro = ?), ?)';
        $params = array($this->libro, $this->cantidad, $this->libro, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }
    

    // Método para obtener los productos que se encuentran en el carrito de compras.
   public function readDetail()
{
    $sql = 'SELECT dp.id_detalle, l.titulo AS nombre_producto, dp.precio, dp.cantidad
            FROM tb_detalle_pedidos AS dp
            INNER JOIN tb_pedidos AS p ON dp.id_pedido = p.id_pedido
            INNER JOIN tb_libros AS l ON dp.id_libro = l.id_libro
            WHERE p.id_pedido = ?';
    $params = array($_SESSION['idPedido']);
    return Database::getRows($sql, $params);
}



    public function finishOrder()
    {
        $this->estado = 'FINALIZADO';
        $sql = 'UPDATE tb_pedidos
            SET estado = ?
            WHERE id_pedido = ?';
        $params = array($this->estado, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    // Método para actualizar la cantidad de un producto agregado al carrito de compras.
    public function updateDetail()
    {
        $sql = 'UPDATE tb_detalle_pedidos
            SET cantidad = ?
            WHERE id_detalle = ? AND id_pedido = ?';
        $params = array($this->cantidad, $this->id_detalle, $_SESSION['idUsuario']);
        return Database::executeRow($sql, $params);
    }
    public function searchRows()
    {
        // Obtener el valor de búsqueda y envolverlo con comodines para usar con LIKE
        $value = '%' . Validator::getSearchValue() . '%';

        // Definir la consulta SQL para buscar coincidencias en las tablas tb_pedidos, tb_detalle_pedidos y tb_comentarios
        $sql = 'SELECT
                p.id_pedido,
                p.id_usuario,
                u.nombre_usuario,
                p.direccion_pedido,
                p.estado,
                p.fecha_pedido,
                dp.id_detalle,
                dp.id_libro,
                dp.cantidad,
                dp.precio,
                c.id_comentario,
                c.comentario,
                c.calificacion,
                c.estado_comentario
            FROM
                tb_pedidos AS p
            INNER JOIN
                tb_usuarios AS u ON p.id_usuario = u.id_usuario
            LEFT JOIN
                tb_detalle_pedidos AS dp ON p.id_pedido = dp.id_pedido
            LEFT JOIN
                tb_comentarios AS c ON dp.id_detalle = c.id_detalle
            WHERE
                p.id_pedido LIKE ? OR
                CAST(p.id_usuario AS CHAR) LIKE ? OR
                u.nombre_usuario LIKE ? OR
                p.direccion_pedido LIKE ? OR
                p.estado LIKE ? OR
                p.fecha_pedido LIKE ? OR
                dp.id_detalle LIKE ? OR
                dp.id_libro LIKE ? OR
                dp.cantidad LIKE ? OR
                dp.precio LIKE ? OR
                c.id_comentario LIKE ? OR
                c.comentario LIKE ? OR
                c.calificacion LIKE ? OR
                c.estado_comentario LIKE ?
            ORDER BY
                p.fecha_pedido;';

        // Establecer los parámetros para la consulta (el término de búsqueda)
        $params = array(
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value,
            $value
        );

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql, $params);
    }

    /*
     * Método para leer todos los registros de la tabla tb_pedidos.
     */
    public function readAll()
    {
        // Definir la consulta SQL para obtener todos los registros
        $sql = 'SELECT
                p.id_pedido,
                p.id_usuario,
                u.nombre_usuario,
                p.direccion_pedido,
                p.estado,
                p.fecha_pedido,
                dp.id_detalle,
                dp.id_libro,
                dp.cantidad,
                dp.precio,
                c.id_comentario,
                c.comentario,
                c.calificacion,
                c.estado_comentario
            FROM
                tb_pedidos AS p
            INNER JOIN
                tb_usuarios AS u ON p.id_usuario = u.id_usuario
            LEFT JOIN
                tb_detalle_pedidos AS dp ON p.id_pedido = dp.id_pedido
            LEFT JOIN
                tb_comentarios AS c ON dp.id_detalle = c.id_detalle
            ORDER BY
                p.fecha_pedido;';

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql);
    }

    /*
     * Método para leer un registro específico de la tabla tb_pedidos por su id.
     */
    public function readOne()
    {
        // Definir la consulta SQL para obtener un registro específico por id
        $sql = 'SELECT
                    p.id_pedido,
                    p.id_usuario,
                    u.nombre_usuario,
                    p.direccion_pedido,
                    p.estado,
                    p.fecha_pedido,
                    dp.id_detalle,
                    dp.id_libro,
                    dp.cantidad,
                    dp.precio,
                    l.titulo,
                    l.imagen AS imagen_libro,
                    c.id_comentario,
                    c.comentario,
                    c.calificacion,
                    c.estado_comentario
                FROM
                    tb_pedidos AS p
                INNER JOIN
                    tb_usuarios AS u ON p.id_usuario = u.id_usuario
                LEFT JOIN
                    tb_detalle_pedidos AS dp ON p.id_pedido = dp.id_pedido
                LEFT JOIN
                    tb_libros AS l ON dp.id_libro = l.id_libro
                LEFT JOIN
                    tb_comentarios AS c ON dp.id_detalle = c.id_detalle
                WHERE
                    p.id_pedido = ?';

        // Establecer los parámetros para la consulta (id)
        $params = array($this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::getRow($sql, $params);
    }
    /*
     * Método para actualizar un registro específico de la tabla tb_pedidos por su id.
     */
    public function updateRow()
    {
        // Definir la consulta SQL para actualizar los campos dirección y estado
        $sql = 'UPDATE tb_pedidos
                SET direccion_pedido = ?, estado = ?
                WHERE id_pedido = ?';

        // Establecer los parámetros para la consulta (dirección, estado y id)
        $params = array($this->direccion, $this->estado, $this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    public function deleteDetail()
    {
        $sql = 'DELETE FROM tb_detalle_pedidos
            WHERE id_detalle = ? AND id_pedido = ?';
        $params = array($this->id_detalle, $_SESSION['idUsuario']);
        return Database::executeRow($sql, $params);
    }
}
