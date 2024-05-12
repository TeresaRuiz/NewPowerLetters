<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');
/*
 *  Clase para manejar el comportamiento de los datos de la tabla CATEGORIA.
 */
class LibrosHandler
{/*
 * Declaración de atributos para el manejo de datos de la tabla TB_LIBROS.
 */
    protected $id = null; // Identificador único del libro.
    protected $titulo = null; // Título del libro.
    protected $id_autor = null; // Identificador del autor (referencia a otra tabla).
    protected $precio = null; // Precio del libro.
    protected $descripcion = null; // Descripción del libro.
    protected $imagen = null; // Nombre del archivo de imagen.
    protected $id_clasificacion = null; // Identificador de la clasificación (referencia a otra tabla).
    protected $id_editorial = null; // Identificador de la editorial (referencia a otra tabla).
    protected $existencias = null; // Cantidad de libros disponibles.
    protected $id_genero = null; // Identificador del género (referencia a otra tabla).

    // Constante para establecer las rutas de las imágenes (si es necesario).
    const RUTA_IMAGEN = '../../images/libros';

    public function searchRows($searchValue)
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT 
                id_libro,
                titulo,
                descripcion,
                precio,
                imagen,
                existencias,
                (SELECT nombre FROM tb_autores WHERE id_autor = tb_libros.id_autor) AS autor,
                (SELECT nombre FROM tb_editoriales WHERE id_editorial = tb_libros.id_editorial) AS editorial,
                (SELECT nombre FROM tb_clasificaciones WHERE id_clasificacion = tb_libros.id_clasificacion) AS clasificacion,
                (SELECT nombre FROM tb_generos WHERE id_genero = tb_libros.id_genero) AS genero
            FROM 
                tb_libros
            WHERE 
                titulo LIKE ? OR 
                descripcion LIKE ?
            ORDER BY 
                titulo';
        $params = array($value, $value);
        return Database::getRows($sql, $params);
    }

    /*
     * Método para insertar un nuevo libro en la tabla TB_LIBROS.
     */
    public function createRow()
    {
        $sql = 'INSERT INTO tb_libros (titulo, id_autor, precio, descripcion, imagen, id_clasificacion, id_editorial, existencias, id_genero)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array(
            $this->titulo,
            $this->id_autor,
            $this->precio,
            $this->descripcion,
            $this->imagen,
            $this->id_clasificacion,
            $this->id_editorial,
            $this->existencias,
            $this->id_genero
        );
        return Database::executeRow($sql, $params);
    }
    
    public function readAll()
    {
        // Consulta SQL para obtener todos los registros de la tabla TB_LIBROS.
        $sql = '
            SELECT 
                id_libro, 
                titulo, 
                precio, 
                descripcion, 
                imagen, 
                existencias, 
                (SELECT nombre FROM tb_autores WHERE id_autor = tb_libros.id_autor) AS autor, 
                (SELECT nombre FROM tb_clasificaciones WHERE id_clasificacion = tb_libros.id_clasificacion) AS clasificacion,
                (SELECT nombre FROM tb_editoriales WHERE id_editorial = tb_libros.id_editorial) AS editorial,
                (SELECT nombre FROM tb_generos WHERE id_genero = tb_libros.id_genero) AS genero
            FROM 
                tb_libros
            ORDER BY 
                titulo
        ';

        // Ejecutar la consulta y devolver los resultados.
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_libro, titulo, descripcion, precio, existencias, imagen, id_clasificacion, id_editorial, id_autor, id_genero
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
            SET titulo = ?, descripcion = ?, precio = ?, existencias = ?, imagen = ?, id_clasificacion = ?, id_editorial = ?, id_autor = ?, id_genero = ?
            WHERE id_libro = ?';
        $params = array($this->titulo, $this->descripcion, $this->precio, $this->existencias, $this->imagen, $this->id_clasificacion, $this->id_editorial, $this->id_autor, $this->id_genero, $this->id);
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