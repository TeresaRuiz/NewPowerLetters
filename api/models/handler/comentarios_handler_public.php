<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');

/*
 * Clase para manejar el comportamiento de los datos de la tabla COMENTARIOS.
 */
class ComentarioHandlerPublic
{
    /*
     * Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $comentario = null;
    protected $calificacion = null;
    protected $libros = null;

    /*
     * Método para buscar registros en la tabla tb_comentarios.
     */
    public function createRow()
    {
        $sql = 'INSERT INTO tb_comentarios(comentario, calificacion)
            VALUES(?, ?)';
        $params = array($this->comentario, $this->calificacion);
        return Database::executeRow($sql, $params);
    }

    public function updateRow()
    {
        // Definir la consulta SQL para actualizar el estado del comentario
        $sql = 'UPDATE tb_comentarios
                SET calificacion = ?
                WHERE id_comentario = ?';

        // Establecer los parámetros para la consulta (estado y id)
        $params = array($this->calificacion, $this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
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

    public function verificarCompra()
    {
        $sql = 'SELECT dp.id_detalle
        FROM tb_detalle_pedidos dp
        INNER JOIN tb_pedidos p ON dp.id_pedido = p.id_pedido
        WHERE p.id_usuario = ?
        AND dp.id_libro = ?
        AND p.estado = "Entregado"
        ORDER BY dp.id_detalle DESC
        LIMIT 1;';
        $params = array($_SESSION['idUsuario'], $this->libros);
        if ($data = Database::getRow($sql, $params)) {
            $_SESSION['idDetalle'] = $data['id_detalle'];
            return true;
        } else {
            return false;
        }
    }
 
   public function crearComentario(){
      if($this->verificarCompra()){
        // Se realiza una subconsulta para obtener el precio del producto.
        $sql = 'INSERT INTO tb_comentarios(calificacion, comentario, id_detalle)
                VALUES(?, ?, ?)';
        $params = array($this->calificacion, $this->comentario, $_SESSION['idDetalle']);
        return Database::executeRow($sql, $params);
      }
      else{
         return false;
      }
   }
}