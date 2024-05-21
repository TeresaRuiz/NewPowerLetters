<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');

/*
 *  Clase para manejar el comportamiento de los datos de la tabla administrador.
 */
class AdministradorHandler
{
    /*
     *  Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $nombre = null;
    protected $apellido = null;
    protected $correo = null;
    protected $alias = null;
    protected $clave = null;

    /*
     *  Métodos para gestionar la cuenta del administrador.
     */

    // Método para verificar el usuario y contraseña.
    public function checkUser($username, $password)
    {
        $sql = 'SELECT id_administrador, alias_administrador, clave_administrador
                FROM administrador
                WHERE alias_administrador = ?';
        $params = array($username);
        if (!($data = Database::getRow($sql, $params))) {
            return false; // Devuelve false si no se encuentra el usuario.
        } elseif (password_verify($password, $data['clave_administrador'])) {
            $_SESSION['idAdministrador'] = $data['id_administrador'];
            $_SESSION['aliasAdministrador'] = $data['alias_administrador'];
            return true; // Devuelve true si la contraseña es correcta.
        } else {
            return false; // Devuelve false si la contraseña es incorrecta.
        }
    }

    // Método para verificar la contraseña actual.
    public function checkPassword($password)
    {
        $sql = 'SELECT clave_administrador
                FROM administrador
                WHERE id_administrador = ?';
        $params = array($_SESSION['idAdministrador']);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['clave_administrador'])) {
            return true; // Devuelve true si la contraseña es correcta.
        } else {
            return false; // Devuelve false si la contraseña es incorrecta.
        }
    }

    // Método para cambiar la contraseña.
    public function changePassword()
    {
        $sql = 'UPDATE administrador
                SET clave_administrador = ?
                WHERE id_administrador = ?';
        $params = array($this->clave, $_SESSION['idAdministrador']);
        return Database::executeRow($sql, $params); // Ejecuta la actualización de la contraseña.
    }

    // Método para leer el perfil del administrador.
    public function readProfile()
    {
        $sql = 'SELECT id_administrador, nombre_administrador, apellido_administrador, correo_administrador, alias_administrador
                FROM administrador
                WHERE id_administrador = ?';
        $params = array($_SESSION['idAdministrador']);
        return Database::getRow($sql, $params); // Devuelve los datos del perfil del administrador.
    }

    // Método para editar el perfil del administrador.
    public function editProfile()
    {
        $sql = 'UPDATE administrador
                SET nombre_administrador = ?, apellido_administrador = ?, correo_administrador = ?, alias_administrador = ?
                WHERE id_administrador = ?';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->alias, $_SESSION['idAdministrador']);
        return Database::executeRow($sql, $params); // Ejecuta la actualización del perfil del administrador.
    }

    /*
     *  Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */

    // Método para buscar administradores por nombre o apellido.
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_administrador, nombre_administrador, apellido_administrador, correo_administrador, alias_administrador
                FROM administrador
                WHERE apellido_administrador LIKE ? OR nombre_administrador LIKE ?
                ORDER BY apellido_administrador';
        $params = array($value, $value);
        return Database::getRows($sql, $params); // Devuelve los resultados de la búsqueda.
    }

    // Método para crear un nuevo administrador.
    public function createRow()
    {
        $sql = 'INSERT INTO administrador(nombre_administrador, apellido_administrador, correo_administrador, alias_administrador, clave_administrador)
                VALUES(?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->alias, $this->clave);
        return Database::executeRow($sql, $params); // Ejecuta la inserción de un nuevo administrador.
    }

    // Método para leer todos los administradores.
    public function readAll()
    {
        $sql = 'SELECT id_administrador, nombre_administrador, apellido_administrador, correo_administrador, alias_administrador
                FROM administrador
                ORDER BY apellido_administrador';
        return Database::getRows($sql); // Devuelve todos los administradores.
    }

    // Método para leer un administrador específico.
    public function readOne()
    {
        $sql = 'SELECT id_administrador, nombre_administrador, apellido_administrador, correo_administrador, alias_administrador
                FROM administrador
                WHERE id_administrador = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params); // Devuelve los datos de un administrador específico.
    }

    // Método para actualizar un administrador.
    public function updateRow()
    {
        $sql = 'UPDATE administrador
                SET nombre_administrador = ?, apellido_administrador = ?, correo_administrador = ?
                WHERE id_administrador = ?';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->id);
        return Database::executeRow($sql, $params); // Ejecuta la actualización de un administrador.
    }

    // Método para eliminar un administrador.
    public function deleteRow()
    {
        $sql = 'DELETE FROM administrador
                WHERE id_administrador = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params); // Ejecuta la eliminación de un administrador.
    }
}