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
        c.estado_comentario
    FROM
        tb_comentarios AS c
    WHERE
        c.comentario LIKE ? OR
        c.estado_comentario LIKE ?
    ORDER BY
        c.id_comentario;';
        $params = array($value, $value, $value, $value, $value, $value, $value);
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT
        c.id_comentario,
        c.comentario,
        c.calificacion,
        c.estado_comentario
    FROM
        tb_comentarios AS c
    ORDER BY
        c.id_comentario;';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT
        c.id_comentario,
        c.comentario,
        c.calificacion,
        c.estado_comentario
    FROM
        tb_comentarios AS c
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
