<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');

/*
 * Clase para manejar el comportamiento de los datos de la tabla EDITORIALES.
 */
class EditorialesHandler
{
    /*
     * Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $nombre = null;

    /*
     * Método para buscar registros en la tabla tb_editoriales.
     */
    public function searchRows()
    {
        // Obtener el valor de búsqueda y envolverlo con comodines para usar con LIKE
        $value = '%' . Validator::getSearchValue() . '%';

        // Definir la consulta SQL para buscar coincidencias en la tabla tb_editoriales
        $sql = 'SELECT id_editorial, nombre
                FROM tb_editoriales
                WHERE nombre LIKE ?
                ORDER BY nombre'; // Ordenar por nombre para un resultado ordenado

        // Establecer los parámetros para la consulta (el término de búsqueda)
        $params = array($value);

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql, $params);
    }

    /*
     * Método para crear una nueva fila en tb_editoriales.
     */
    public function createRow()
    {
        // Definir la consulta SQL para insertar un nuevo registro
        $sql = 'INSERT INTO tb_editoriales (nombre) VALUES (?)';

        // Establecer los parámetros para la consulta (nombre)
        $params = array($this->nombre);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    /*
     * Método para leer todas las filas de tb_editoriales.
     */
    public function readAll()
    {
        // Definir la consulta SQL para obtener todos los registros
        $sql = 'SELECT id_editorial, nombre FROM tb_editoriales ORDER BY nombre';

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql);
    }

    /*
     * Método para leer una fila específica de tb_editoriales por id.
     */
    public function readOne()
    {
        // Definir la consulta SQL para obtener un registro específico por id
        $sql = 'SELECT id_editorial, nombre FROM tb_editoriales WHERE id_editorial = ?';

        // Establecer los parámetros para la consulta (id)
        $params = array($this->id);

        // Ejecutar la consulta y devolver la fila resultante
        return Database::getRow($sql, $params);
    }

    /*
     * Método para actualizar una fila específica de tb_editoriales por id.
     */
    public function updateRow()
    {
        // Definir la consulta SQL para actualizar el nombre
        $sql = 'UPDATE tb_editoriales SET nombre = ? WHERE id_editorial = ?';

        // Establecer los parámetros para la consulta (nombre y id)
        $params = array($this->nombre, $this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    /*
     * Método para eliminar una fila específica de tb_editoriales por id.
     */
    public function deleteRow()
    {
        // Definir la consulta SQL para eliminar por id
        $sql = 'DELETE FROM tb_editoriales WHERE id_editorial = ?';

        // Establecer los parámetros para la consulta (id)
        $params = array($this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }
}
