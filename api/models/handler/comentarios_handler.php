<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');

/*
 * Clase para manejar el comportamiento de los datos de la tabla COMENTARIOS.
 */
class ComentarioHandler
{
    /*
     * Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $comentario = null;
    protected $estado = null;

    /*
     * Método para buscar registros en la tabla tb_comentarios.
     */
    public function searchRows()
    {
        // Obtener el valor de búsqueda y envolverlo con comodines para usar con LIKE
        $value = '%' . Validator::getSearchValue() . '%';

        // Definir la consulta SQL para buscar coincidencias en la tabla tb_comentarios y tablas relacionadas
        $sql = 'SELECT
                    c.id_comentario,
                    c.comentario,
                    c.calificacion,
                    c.estado_comentario,
                    u.nombre_usuario
                FROM
                    tb_comentarios AS c
                JOIN
                    tb_detalle_pedidos AS dp ON c.id_detalle = dp.id_detalle
                JOIN
                    tb_pedidos AS p ON dp.id_pedido = p.id_pedido
                JOIN
                    tb_usuarios AS u ON p.id_usuario = u.id_usuario
                WHERE
                    c.comentario LIKE ? OR
                    c.estado_comentario LIKE ? OR
                    u.nombre_usuario LIKE ?
                ORDER BY
                    c.id_comentario';

        // Establecer los parámetros para la consulta (el término de búsqueda)
        $params = array($value, $value, $value);

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql, $params);
    }

    /*
     * Método para leer todas las filas de la tabla tb_comentarios.
     */
    public function readAll()
    {
        // Definir la consulta SQL para obtener todos los registros
        $sql = 'SELECT
                    c.id_comentario,
                    c.comentario,
                    c.calificacion,
                    c.estado_comentario,
                    u.nombre_usuario
                FROM
                    tb_comentarios AS c
                JOIN
                    tb_detalle_pedidos AS dp ON c.id_detalle = dp.id_detalle
                JOIN
                    tb_pedidos AS p ON dp.id_pedido = p.id_pedido
                JOIN
                    tb_usuarios AS u ON p.id_usuario = u.id_usuario
                ORDER BY
                    c.id_comentario';

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql);
    }
    /*
     * Método para leer una fila específica de la tabla tb_comentarios por id.
     */
    public function readOne()
    {
        // Definir la consulta SQL para obtener un registro específico por id
        $sql = 'SELECT
                c.id_comentario,
                c.comentario,
                c.calificacion,
                c.estado_comentario,
                u.nombre_usuario,
                dp.id_detalle,
                dp.id_libro,
                dp.cantidad,
                dp.precio,
                l.titulo,
                l.imagen
            FROM
                tb_comentarios AS c
            JOIN
                tb_detalle_pedidos AS dp ON c.id_detalle = dp.id_detalle
            JOIN
                tb_pedidos AS p ON dp.id_pedido = p.id_pedido
            JOIN
                tb_usuarios AS u ON p.id_usuario = u.id_usuario
            JOIN
                tb_libros AS l ON dp.id_libro = l.id_libro
            WHERE
                c.id_comentario = ?';

        // Establecer los parámetros para la consulta (id)
        $params = array($this->id);

        // Ejecutar la consulta y devolver la fila resultante
        return Database::getRow($sql, $params);
    }

    /*
     * Método para actualizar una fila específica de la tabla tb_comentarios por id.
     */
    public function updateRow()
    {
        // Definir la consulta SQL para actualizar el estado del comentario
        $sql = 'UPDATE tb_comentarios
                SET estado_comentario = ?
                WHERE id_comentario = ?';

        // Establecer los parámetros para la consulta (estado y id)
        $params = array($this->estado, $this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }
}