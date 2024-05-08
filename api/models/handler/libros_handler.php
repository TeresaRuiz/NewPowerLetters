<?php
require_once('../../helpers/database.php');

class libroHandler
{
    protected $id_libro = null;
    protected $titulo = null;
    protected $id_autor = null;
    protected $precio = null;
    protected $descripcion = null;
    protected $imagen = null;
    protected $id_clasificacion = null;
    protected $id_editorial = null;
    protected $id_administrador = null;
    protected $existencias = null;
    protected $id_genero = null;

    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';

        $sql = 'SELECT l.id_libro, l.titulo, l.precio, l.descripcion, l.imagen, l.existencias,
                    a.nombre AS autor, c.nombre AS clasificacion, e.nombre AS editorial, g.nombre AS genero
                FROM tb_libros l
                JOIN tb_autores a ON l.id_autor = a.id_autor
                JOIN tb_clasificaciones c ON l.id_clasificacion = c.id_clasificacion
                JOIN tb_editoriales e ON l.id_editorial = e.id_editorial
                JOIN tb_generos g ON l.id_genero = g.id_genero
                WHERE l.titulo LIKE ?
                ORDER BY l.titulo';

        $params = array($value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO tb_libros (titulo, id_autor, precio, descripcion, imagen, id_clasificacion, id_editorial, id_administrador, existencias, id_genero)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $params = array($this->titulo, $this->id_autor, $this->precio, $this->descripcion, $this->imagen, $this->id_clasificacion, $this->id_editorial, $this->id_administrador, $this->existencias, $this->id_genero);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT l.id_libro, l.titulo, a.nombre AS autor, l.precio, l.descripcion, l.imagen, c.nombre AS clasificacion, e.nombre AS editorial, g.nombre AS genero
                FROM tb_libros l
                JOIN tb_autores a ON l.id_autor = a.id_autor
                JOIN tb_clasificaciones c ON l.id_clasificacion = c.id_clasificacion
                JOIN tb_editoriales e ON l.id_editorial = e.id_editorial
                JOIN tb_generos g ON l.id_genero = g.id_genero
                ORDER BY l.titulo';

        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT l.id_libro, l.titulo, l.id_autor, l.precio, l.descripcion, l.imagen, l.id_clasificacion, l.id_editorial, l.id_administrador, l.existencias, l.id_genero
                FROM tb_libros l
                WHERE l.id_libro = ?';

        $params = array($this->id_libro);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tb_libros
                SET titulo = ?, id_autor = ?, precio = ?, descripcion = ?, imagen = ?, id_clasificacion = ?, id_editorial = ?, id_administrador = ?, existencias = ?, id_genero = ?
                WHERE id_libro = ?';

        $params = array($this->titulo, $this->id_autor, $this->precio, $this->descripcion, $this->imagen, $this->id_clasificacion, $this->id_editorial, $this->id_administrador, $this->existencias, $this->id_genero, $this->id_libro);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_libros WHERE id_libro = ?';
        $params = array($this->id_libro);
        return Database::executeRow($sql, $params);
    }
}