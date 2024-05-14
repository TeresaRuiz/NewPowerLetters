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
    r.comentario AS comentario_resena
FROM
    tb_pedidos AS p
INNER JOIN
    tb_detalle_pedidos AS d ON p.id_pedido = d.id_pedido
LEFT JOIN
    tb_resenias AS r ON d.id_resena = r.id_resena
WHERE
    p.id_pedido = ? OR
    p.id_usuario = ? OR
    p.direccion_pedido LIKE ? OR
    p.estado LIKE ? OR
    p.fecha_pedido LIKE ? OR
    d.id_detalle = ? OR
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
    p.direccion_pedido,
    p.estado,
    p.fecha_pedido,
    d.id_detalle
FROM
    tb_pedidos AS p
INNER JOIN
    tb_detalle_pedidos AS d ON p.id_detalle = d.id_detalle
ORDER BY
    p.fecha_pedido;';
    return Database::getRows($sql);
}

public function readOne()
{
    $sql = 'SELECT
        p.id_pedido,
        p.id_usuario,
        p.direccion_pedido,
        p.estado,
        p.fecha_pedido,
        d.id_detalle
    FROM
        tb_pedidos AS p
    INNER JOIN
        tb_detalle_pedidos AS d ON p.id_detalle = d.id_detalle
    WHERE
        p.id_pedido = ?';
    $params = array($this->id);
    return Database::getRow($sql, $params);
}

}