<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');

/*
 * Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
 */
class LibroDescuentoHandler
{
    
    protected $id = null;
    protected $titulo = null;
    protected $autor = null;
    protected $clasificacion = null;
    protected $editorial = null;
    protected $genero = null;

    /*
     * Método para buscar registros en la tabla tb_libros.
     */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT
            l.id_libro,
            l.titulo AS titulo_libro,
            l.descripcion AS descripcion_libro,
            l.precio,
            l.imagen,
            a.nombre AS nombre_autor,
            c.nombre AS nombre_clasificacion,
            e.nombre AS nombre_editorial,
            g.nombre AS nombre_genero,
            l.existencias
        FROM
            tb_libros AS l
        INNER JOIN
            tb_autores AS a ON l.id_autor = a.id_autor
        INNER JOIN
            tb_clasificaciones AS c ON l.id_clasificacion = c.id_clasificacion
        INNER JOIN
            tb_editoriales AS e ON l.id_editorial = e.id_editorial
        INNER JOIN
            tb_generos AS g ON l.id_genero = g.id_genero
        WHERE
            l.titulo LIKE ? OR
            l.descripcion LIKE ? OR
            e.nombre LIKE ?
        ORDER BY
            l.titulo;';
        $params = array($value, $value, $value);
        return Database::getRows($sql, $params);
    }
    

    
    /*
     * Método para leer todos los registros de la tabla tb_libros.
     */
    public function readAll()
    {
        $sql = 'SELECT
            l.id_libro,
            l.titulo AS titulo_libro,
            l.descripcion AS descripcion_libro,
            l.precio,
            l.imagen,
            a.id_autor,
            a.nombre AS nombre_autor,
            c.id_clasificacion,
            c.nombre AS nombre_clasificacion,
            e.id_editorial,
            e.nombre AS nombre_editorial,
            g.id_genero,
            g.nombre AS nombre_genero,
            l.existencias
        FROM
            tb_libros AS l
        INNER JOIN
            tb_autores AS a ON l.id_autor = a.id_autor
        INNER JOIN
            tb_clasificaciones AS c ON l.id_clasificacion = c.id_clasificacion
        INNER JOIN
            tb_editoriales AS e ON l.id_editorial = e.id_editorial
        INNER JOIN
            tb_generos AS g ON l.id_genero = g.id_genero
        ORDER BY
            l.titulo;';
        return Database::getRows($sql);
    }

     /*
     * Método para leer un registro específico de la tabla tb_libros por id.
     */
    public function readOne()
    {
        $sql = 'SELECT
            l.id_libro,
            l.titulo AS titulo_libro,
            l.descripcion AS descripcion_libro,
            l.precio,
            l.imagen,
            a.id_autor,
            a.nombre AS nombre_autor,
            c.id_clasificacion,
            c.nombre AS nombre_clasificacion,
            e.id_editorial,
            e.nombre AS nombre_editorial,
            g.id_genero,
            g.nombre AS nombre_genero,
            l.existencias
        FROM
            tb_libros AS l
        INNER JOIN
            tb_autores AS a ON l.id_autor = a.id_autor
        INNER JOIN
            tb_clasificaciones AS c ON l.id_clasificacion = c.id_clasificacion
        INNER JOIN
            tb_editoriales AS e ON l.id_editorial = e.id_editorial
        INNER JOIN
            tb_generos AS g ON l.id_genero = g.id_genero
        WHERE id_libro = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

}

