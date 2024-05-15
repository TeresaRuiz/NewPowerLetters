<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');
/*
 *	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
 */
class PedidoHandler
{
    /*
     *   Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $id_usuario = null;
    protected $direccion = null;
    protected $estado = null;
    protected $fecha = null;
    protected $id_detalle = null;

    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT
        p.id_pedido,
        p.id_usuario,
        p.direccion_pedido,
        p.estado,
        p.fecha_pedido,
        d.id_detalle,
        r.comentario AS comentario_resena,
        u.nombre_usuario
    FROM
        tb_pedidos AS p
    INNER JOIN
        tb_detalle_pedidos AS d ON p.id_pedido = d.id_pedido
    LEFT JOIN
        tb_comentarios AS r ON d.id_comentario = r.id_comentario
    INNER JOIN
        tb_usuarios AS u ON p.id_usuario = u.id_usuario
    WHERE
        p.id_pedido LIKE ? OR
        p.id_usuario LIKE ? OR
        u.nombre_usuario LIKE ? OR
        p.direccion_pedido LIKE ? OR
        p.estado LIKE ? OR
        p.fecha_pedido LIKE ? OR
        r.comentario LIKE ?
    ORDER BY
        p.fecha_pedido;';
        $params = array($value, $value, $value, $value, $value, $value, $value);
        return Database::getRows($sql, $params);
    }



    public function readAll()
    {
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
        return Database::getRows($sql);
    }

    public function readOne()
    {
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
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
    
    public function updateRow()
    {
        $sql = 'UPDATE tb_pedidos
            SET direccion_pedido = ?, estado = ?
            WHERE id_pedido = ?';
        $params = array($this->direccion, $this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }
}