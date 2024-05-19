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
    protected $usuario = null;
    protected $correo = null;
    protected $clave = null;
    protected $telefono = null;
    protected $imagen = null;
    protected $estado = null;

    /*
     *  Métodos para gestionar la cuenta del administrador.
     */

    const RUTA_IMAGEN = '../../images/administradores/';

    public function checkUser($username, $password)
    {
        $sql = 'SELECT id_administrador, correo_administrador, clave_administrador
                FROM tb_administradores
                WHERE correo_administrador = ?';
        $params = array($username);
        if (!($data = Database::getRow($sql, $params))) {
            return false;
        } elseif (password_verify($password, $data['clave_administrador'])) {
            $_SESSION['idAdministrador'] = $data['id_administrador'];
            $_SESSION['correoAdministrador'] = $data['correo_administrador'];
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

    public function changePassword()
    {
        $sql = 'UPDATE tb_administradores
                SET clave_administrador = ?
                WHERE id_administrador = ?';
        $params = array($this->clave, $_SESSION['idAdministrador']);
        return Database::executeRow($sql, $params);
    }



    public function readProfile()
    {
        $sql = 'SELECT id_administrador, nombre_administrador, user_administrador, correo_administrador
                FROM tb_administradores
                WHERE id_administrador = ?';
        $params = array($_SESSION['idAdministrador']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        // Sentencia SQL para actualizar el perfil del administrador.
        $sql = 'UPDATE tb_administradores
            SET nombre_administrador = ?, user_administrador = ?, correo_administrador = ?
            WHERE id_administrador = ?';

        // Parámetros para la consulta preparada.
        $params = array($this->nombre, $this->usuario, $this->correo, $_SESSION['idAdministrador']);

        // Ejecutar la consulta y retornar el resultado.
        return Database::executeRow($sql, $params);
    }
    /*
     *  Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    public function searchRows()
    {
        // Obtener el valor de búsqueda y formatearlo adecuadamente.
        $value = '%' . Validator::getSearchValue() . '%';

        // Consulta SQL para buscar administradores por nombre o nombre de usuario.
        $sql = 'SELECT id_administrador, nombre_administrador, user_administrador, correo_administrador, telefono_adm, fecha_registro, estado_admin
        FROM tb_administradores
        WHERE nombre_administrador LIKE ? OR user_administrador LIKE ?
        ORDER BY nombre_administrador';

        // Parámetros para la consulta preparada.
        $params = array($value, $value);

        // Ejecutar la consulta y retornar los resultados.
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Consulta SQL para insertar un nuevo administrador.
        $sql = 'INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, imagen, fecha_registro, estado_admin)
        VALUES (?, ?, ?, ?, ?, ?, NOW(), 1)';

        // Parámetros para la consulta preparada.
        $params = array($this->nombre, $this->usuario, $this->correo, $this->clave, $this->telefono, $this->imagen, $this->estado);

        // Ejecutar la consulta y retornar el resultado.
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        // Consulta SQL para seleccionar todos los administradores.
        $sql = 'SELECT id_administrador, nombre_administrador, user_administrador, correo_administrador, telefono_adm, imagen, fecha_registro, estado_admin
            FROM tb_administradores
            ORDER BY nombre_administrador';

        // Obtener y retornar los resultados de la consulta.
        return Database::getRows($sql);
    }

    public function readOne()
    {
        // Consulta SQL para seleccionar un administrador por su ID.
        $sql = 'SELECT id_administrador, nombre_administrador, user_administrador, correo_administrador, telefono_adm, fecha_registro, imagen, estado_admin
            FROM tb_administradores
            WHERE id_administrador = ?';

        // Parámetros para la consulta.
        $params = array($this->id);

        // Obtener y retornar el resultado de la consulta.
        return Database::getRow($sql, $params);
    }


    public function updateRow()
    {
        // Consulta SQL para actualizar los datos de un administrador.
        $sql = 'UPDATE tb_administradores
            SET nombre_administrador = ?, user_administrador = ?, correo_administrador = ?
            WHERE id_administrador = ?';
        // Parámetros para la consulta.
        $params = array($this->nombre, $this->usuario, $this->correo, $this->id);
        // Ejecutar la consulta y retornar el resultado.
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        // Consulta SQL para eliminar un administrador por su ID.
        $sql = 'DELETE FROM tb_administradores
            WHERE id_administrador = ?';
        // Parámetros para la consulta.
        $params = array($this->id);
        // Ejecutar la consulta y retornar el resultado.
        return Database::executeRow($sql, $params);
    }

    public function readFilename()
    {
        $sql = 'SELECT imagen
            FROM tb_administradores
            WHERE id_administrador = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
}
