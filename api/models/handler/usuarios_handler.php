<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');
/*
 *	Clase para manejar el comportamiento de los datos de la tabla CLIENTE.
 */
class UsuarioHandler
{
    /*
     *   Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $nombre = null;
    protected $nombreUser = null;
    protected $correo = null;
    protected $clave = null;
    protected $direccion = null;
    protected $telefono = null;
    protected $imagen = null;
    protected $estado = null;
    protected $fecha = null;

    /*
     * Métodos para gestionar la cuenta del cliente.
     */
    public function checkUser($mail, $password)
    {
        $sql = 'SELECT id_usuario, correo, clave, estado_cliente
            FROM tb_usuarios
            WHERE correo = ?';
        $params = array($mail);
        $data = Database::getRow($sql, $params);

        if ($data && password_verify($password, $data['clave'])) {
            $this->id = $data['id_usuario'];
            $this->correo = $data['correo'];
            $this->estado = $data['estado_cliente'];
            return true;
        } else {
            return false;
        }
    }

    /*
     * Métodos para gestionar la cuenta del usuario.
     */
    public function checkStatus()
    {
        if ($this->estado) {
            $_SESSION['idUsuario'] = $this->id;
            $_SESSION['correoUsuario'] = $this->correo;
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $sql = 'UPDATE tb_usuarios
            SET clave = ?
            WHERE id_usuario = ?';
        $params = array($this->clave, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function changeStatus()
    {
        $sql = 'UPDATE tb_usuarios
            SET estado_cliente = ?
            WHERE id_usuario = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }
    /*
     * Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_usuario, nombre, nombre_usuario, correo, telefono, direccion, estado_cliente, fecha_registro
            FROM tb_usuarios
            WHERE nombre_usuario LIKE ? OR nombre LIKE ? OR correo LIKE ?
            ORDER BY nombre_usuario';
        $params = array($value, $value, $value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO tb_usuarios(nombre, nombre_usuario, correo, telefono, direccion, clave, estado_cliente, fecha_registro)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->nombreUser, $this->correo, $this->telefono, $this->direccion, $this->clave, $this->estado, $this->fecha);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_usuario, nombre, nombre_usuario, correo, telefono, direccion, estado_cliente, fecha_registro
            FROM tb_usuarios
            ORDER BY nombre_usuario';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_usuario, nombre, nombre_usuario, correo, telefono, direccion, estado_cliente, fecha_registro
            FROM tb_usuarios
            WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tb_usuarios
            SET nombre = ?, nombre_usuario = ?, correo = ?, telefono = ?, direccion = ?, estado_cliente = ?, fecha_registro = ?
            WHERE id_usuario = ?';
        $params = array($this->nombre, $this->nombreUser, $this->correo, $this->telefono, $this->direccion, $this->estado, $this->fecha, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_usuarios
            WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function checkDuplicate($value)
    {
        $sql = 'SELECT id_usuario
            FROM tb_usuarios
            WHERE correo = ?';
        $params = array($value);
        return Database::getRow($sql, $params);
    }
}

