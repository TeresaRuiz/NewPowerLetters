<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../helpers/database.php');

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
    protected $id_detalle = null;

    /*
     * Método para buscar registros en la tabla tb_pedidos.
     */
    public function searchRows()
    {
        // Obtener el valor de búsqueda y envolverlo con comodines para usar con LIKE
        $value = '%' . Validator::getSearchValue() . '%';

        // Definir la consulta SQL para buscar coincidencias en la tabla tb_pedidos
        $sql = 'SELECT
                p.id_pedido,
                p.id_usuario,
                u.nombre_usuario,
                p.direccion_pedido,
                p.estado,
                p.fecha_pedido,
                p.id_detalle
            FROM
                tb_pedidos AS p
            INNER JOIN
                tb_usuarios AS u ON p.id_usuario = u.id_usuario
            WHERE
                p.id_pedido LIKE ? OR
                CAST(p.id_usuario AS CHAR) LIKE ? OR
                u.nombre_usuario LIKE ? OR
                p.direccion_pedido LIKE ? OR
                p.estado LIKE ? OR
                p.fecha_pedido LIKE ?
            ORDER BY
                p.fecha_pedido;';

        // Establecer los parámetros para la consulta (el término de búsqueda)
        $params = array($value, $value, $value, $value, $value, $value);

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
                    d.id_detalle
                FROM
                    tb_pedidos AS p
                INNER JOIN
                    tb_detalle_pedidos AS d ON p.id_detalle = d.id_detalle
                INNER JOIN
                    tb_usuarios AS u ON p.id_usuario = u.id_usuario
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
                    d.id_detalle,
                    l.titulo,
                    l.imagen AS imagen_libro,
                    d.cantidad,
                    r.comentario
                FROM
                    tb_pedidos AS p
                INNER JOIN
                    tb_detalle_pedidos AS d ON p.id_detalle = d.id_detalle
                INNER JOIN
                    tb_usuarios AS u ON p.id_usuario = u.id_usuario
                INNER JOIN
                    tb_libros AS l ON d.id_libro = l.id_libro
                LEFT JOIN
                    tb_comentarios AS r ON d.id_comentario = r.id_comentario  
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
}