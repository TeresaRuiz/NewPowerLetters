<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../helpers/database.php');
/*
 *  Clase para manejar el comportamiento de los datos de la tabla administrador.
 */
class clasificacionHandler
{
    /*
     *  Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $nombre = null;
    protected $descripcion = null;

    /*
     *  Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_clasificacion, nombre, descripcion
                FROM tb_clasificaciones
                WHERE nombre LIKE ?
                ORDER BY nombre';
        $params = array($value);
        return Database::getRows($sql, $params);
    }
    
    public function createRow()
    {
        $sql = 'INSERT INTO tb_clasificaciones(nombre)
                VALUES(?)';
        $params = array($this->nombre);
        return Database::executeRow($sql, $params);
    }
    
//Llamar los datos de la base de datos 
    public function readAll()
    {
        $sql = 'SELECT id_clasificacion, nombre, descripcion
                FROM tb_clasificaciones';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_clasificacion, nombre, descripcion
                FROM tb_clasificaciones
                WHERE id_clasificacion = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tb_clasificaciones
                SET nombre = ?
                WHERE id_clasificacion = ?';
        $params = array($this->nombre, $this->id);
        return Database::executeRow($sql, $params);
    }
    

    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_clasificaciones
                WHERE id_clasificacion = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
    
}
