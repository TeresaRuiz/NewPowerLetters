<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../helpers/database.php');
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
    protected $usuario = null;
    protected $correo = null;
    protected $clave = null;
    protected $telefono = null;
    protected $fecha = null;
    protected $imagen = null;

    /*
     *  Métodos para gestionar la cuenta del administrador.
     */

     public function checkUser($username, $password)
    {
        $sql = 'SELECT id_administrador, user_administrador, clave_administrador
                FROM tb_administradores
                WHERE user_administrador = ?';
        $params = array($username);
        if (!($data = Database::getRow($sql, $params))) {
            return false;
        } elseif (password_verify($password, $data['clave_administrador'])) {
            $_SESSION['idAdministrador'] = $data['id_administrador'];
            $_SESSION['usuarioAdministrador'] = $data['user_administrador'];
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT clave_administrador
                FROM tb_administradores
                WHERE id_administrador = ?';
        $params = array($_SESSION['idAdministrador']);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['clave_administrador'])) {
            return true;
        } else {
            return false;
        }
    }