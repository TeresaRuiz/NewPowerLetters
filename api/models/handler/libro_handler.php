<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');
/*
 *	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
 */
class LibroHandler
{
    /*
     *   Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $titulo = null;
    protected $autor = null;
    protected $precio = null;
    protected $descripcion = null;
    protected $imagen = null;
    protected $clasificacion = null;
    protected $editorial = null;
    protected $existencias = null;
    protected $genero = null;

    // Constante para establecer la ruta de las imágenes.
    const RUTA_IMAGEN = '../../images/libros/';

    /*
     *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT l.id_libro, l.titulo, l.precio, l.descripcion, l.imagen, a.nombre_autor, c.nombre_clasificacion, e.nombre_editorial, g.nombre_genero, l.existencias
            FROM tb_libros AS l
            INNER JOIN tb_autores AS a ON l.id_autor = a.id_autor
            INNER JOIN tb_clasificaciones AS c ON l.id_clasificacion = c.id_clasificacion
            INNER JOIN tb_editoriales AS e ON l.id_editorial = e.id_editorial
            INNER JOIN tb_generos AS g ON l.id_genero = g.id_genero
            WHERE l.titulo LIKE ? OR l.descripcion LIKE ?
            ORDER BY l.titulo';
        $params = array($value, $value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO tb_libros(titulo, id_autor, precio, descripcion, imagen, id_clasificacion, id_editorial, existencias, id_genero)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->titulo, $this->autor, $this->precio, $this->descripcion, $this->imagen, $this->clasificacion, $this->editorial, $this->existencias, $this->genero);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT l.id_libro, l.titulo, l.descripcion, l.precio, l.imagen, a.nombre_autor, c.nombre_clasificacion, e.nombre_editorial, g.nombre_genero, l.existencias
            FROM tb_libros AS l
            INNER JOIN tb_autores AS a ON l.id_autor = a.id_autor
            INNER JOIN tb_clasificaciones AS c ON l.id_clasificacion = c.id_clasificacion
            INNER JOIN tb_editoriales AS e ON l.id_editorial = e.id_editorial
            INNER JOIN tb_generos AS g ON l.id_genero = g.id_genero
            ORDER BY l.titulo';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_libro, titulo, descripcion, precio, existencias, imagen, id_autor, id_clasificacion, id_editorial, id_genero
            FROM tb_libros
            WHERE id_libro = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readFilename()
    {
        $sql = 'SELECT imagen
            FROM tb_libros
            WHERE id_libro = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tb_libros
            SET imagen = ?, titulo = ?, descripcion = ?, precio = ?, existencias = ?, id_autor = ?, id_clasificacion = ?, id_editorial = ?, id_genero = ?
            WHERE id_libro = ?';
        $params = array($this->imagen, $this->titulo, $this->descripcion, $this->precio, $this->existencias, $this->autor, $this->clasificacion, $this->editorial, $this->genero, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_libros
            WHERE id_libro = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }




}
