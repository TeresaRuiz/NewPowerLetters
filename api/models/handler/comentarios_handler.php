<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');
/*
 *	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
 */
class ComentarioHandler
{
    protected $id = null;
    protected $comentario = null;
    protected $estadoComentario = null;

    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT
        c.id_comentario,
        c.comentario,
        c.calificacion,
        c.estado_comentario,
        u.nombre_usuario
    FROM
        tb_comentarios AS c
    JOIN
        tb_detalle_pedidos AS dp ON c.id_comentario = dp.id_comentario
    JOIN
        tb_pedidos AS p ON dp.id_detalle = p.id_detalle
    JOIN
        tb_usuarios AS u ON p.id_usuario = u.id_usuario
    WHERE
        c.comentario LIKE ? OR
        c.estado_comentario LIKE ? OR
        u.nombre_usuario LIKE ?
    ORDER BY
        c.id_comentario;';
        $params = array($value, $value, $value);
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT
        c.id_comentario,
        c.comentario,
        c.calificacion,
        c.estado_comentario,
        u.nombre_usuario
    FROM
        tb_comentarios AS c
        JOIN tb_detalle_pedidos AS dp ON c.id_comentario = dp.id_comentario
        JOIN tb_pedidos AS p ON dp.id_detalle = p.id_detalle
        JOIN tb_usuarios AS u ON p.id_usuario = u.id_usuario
    ORDER BY
        c.id_comentario';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT
        c.id_comentario,
        c.comentario,
        c.calificacion,
        c.estado_comentario,
        u.nombre_usuario,
        l.titulo,
        l.imagen
    FROM
        tb_comentarios AS c
        JOIN tb_detalle_pedidos AS dp ON c.id_comentario = dp.id_comentario
        JOIN tb_pedidos AS p ON dp.id_detalle = p.id_detalle
        JOIN tb_usuarios AS u ON p.id_usuario = u.id_usuario
        JOIN tb_libros AS l ON dp.id_libro = l.id_libro
    WHERE
        c.id_comentario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tb_comentarios
                SET estado_comentario = ?
                WHERE id_comentario = ?';
        $params = array($this->estadoComentario, $this->id);
        return Database::executeRow($sql, $params);
    }

}