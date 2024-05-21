<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');

/*
 * Clase para manejar el comportamiento de los datos de la tabla AUTORES.
 */
class AutoresHandler
{
    /*
     * Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $nombre = null;
    protected $biografia = null;

    /*
     * Método para buscar registros en la tabla tb_autores.
     */
    public function searchRows()
    {
        // Obtener el valor de búsqueda y envolverlo con comodines para usar con LIKE
        $value = '%' . Validator::getSearchValue() . '%';

        // Definir la consulta SQL para buscar coincidencias en la tabla tb_autores
        $sql = 'SELECT id_autor, nombre, biografia
                FROM tb_autores
                WHERE nombre LIKE ?
                ORDER BY nombre'; // Ordenar por nombre para un resultado ordenado

        // Establecer los parámetros para la consulta (el término de búsqueda)
        $params = array($value);

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql, $params);
    }

    /*
     * Método para crear una nueva fila en la tabla tb_autores.
     */
    public function createRow()
    {
        // Definir la consulta SQL para insertar un nuevo registro
        $sql = 'INSERT INTO tb_autores (nombre, biografia) VALUES (?, ?)';
        // Establecer los parámetros para la consulta (nombre y biografía)
        $params = array($this->nombre, $this->biografia);
        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    /*
     * Método para leer todas las filas de la tabla tb_autores.
     */
    public function readAll()
    {
        // Definir la consulta SQL para obtener todos los registros
        $sql = 'SELECT id_autor, nombre, biografia FROM tb_autores ORDER BY nombre';
        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql);
    }

    /*
     * Método para leer una fila específica de la tabla tb_autores por id.
     */
    public function readOne()
    {
        // Definir la consulta SQL para obtener un registro específico por id
        $sql = 'SELECT id_autor, nombre, biografia FROM tb_autores WHERE id_autor = ?';
        // Establecer los parámetros para la consulta (id)
        $params = array($this->id);
        // Ejecutar la consulta y devolver la fila resultante
        return Database::getRow($sql, $params);
    }

    /*
     * Método para eliminar una fila específica de la tabla tb_autores por id.
     */
    public function deleteRow()
    {
        // Definir la consulta SQL para eliminar un registro por id
        $sql = 'DELETE FROM tb_autores WHERE id_autor = ?';
        // Establecer los parámetros para la consulta (id)
        $params = array($this->id);
        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    /*
     * Método para actualizar una fila específica de la tabla tb_autores por id.
     */
    public function updateRow()
    {
        // Definir la consulta SQL para actualizar un registro
        $sql = 'UPDATE tb_autores SET nombre = ?, biografia = ? WHERE id_autor = ?';
        // Establecer los parámetros para la consulta (nombre, biografía, id)
        $params = array($this->nombre, $this->biografia, $this->id);
        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }
}