<?php
// Se incluye la clase para trabajar con la base de datos.

require_once ('../../helpers/database.php');
/*
 *  Clase para manejar el comportamiento de los datos de la tabla CATEGORIA.
 */

class EditorialesHandler
{
    /*
 *  Declaración de atributos para el manejo de datos.
 */
    protected $id = null;
    protected $nombre = null;

    public function searchRows()
    {
        // Obtener el valor de búsqueda y envolverlo con comodines para usar con LIKE
        $value = '%' . Validator::getSearchValue() . '%';

        // Definir la consulta SQL para buscar coincidencias en la tabla tb_generos
        $sql = 'SELECT id_editorial, nombre
            FROM tb_editoriales
            WHERE nombre LIKE ?
            ORDER BY nombre'; // Ordenar por nombre para un resultado ordenado

        // Establecer los parámetros para la consulta (el término de búsqueda)
        $params = array($value);

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql, $params);
    }

    // Para crear una nueva fila en tb_generos
    public function createRow()
    {
        // Cambiar el nombre de las columnas y sus valores
        $sql = 'INSERT INTO tb_editoriales (nombre) VALUES (?)';
        $params = array($this->nombre); // Solo necesitamos el nombre
        return Database::executeRow($sql, $params);
    }

    // Para leer todas las filas de tb_generos
    public function readAll()
    {
        // Cambiar las columnas seleccionadas y la tabla
        $sql = 'SELECT id_editorial, nombre FROM tb_editoriales ORDER BY nombre';
        return Database::getRows($sql);
    }

    // Para leer una fila específica por id
    public function readOne()
    {
        // Buscar por id en tb_generos
        $sql = 'SELECT id_editorial, nombre FROM tb_editoriales WHERE id_editorial = ?';
        $params = array($this->id); // Id para filtrar
        return Database::getRow($sql, $params);
    }

    // Para actualizar una fila específica por id
    public function updateRow()
    {
        // Cambiar la consulta SQL para actualizar el nombre
        $sql = 'UPDATE tb_editoriales SET nombre = ? WHERE id_editorial = ?';
        $params = array($this->nombre, $this->id); // Parámetros de actualización
        return Database::executeRow($sql, $params);
    }

    // Para eliminar una fila específica por id
    public function deleteRow()
    {
        // Cambiar la consulta SQL para eliminar por id
        $sql = 'DELETE FROM tb_editoriales WHERE id_editorial = ?';
        $params = array($this->id); // Parámetro para la eliminación de datos
        return Database::executeRow($sql, $params);
    }
}
;
