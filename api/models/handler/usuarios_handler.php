<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../helpers/database.php');

/*
 * Clase para manejar el comportamiento de los datos de la tabla CLIENTE.
 */
class UsuarioHandler
{
    /*
     * Declaración de atributos para el manejo de datos.
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

    // Constante para establecer la ruta de las imágenes.
    const RUTA_IMAGEN = '../../images/usuarios/';


    /*
     * Método para verificar las credenciales del usuario.
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
     * Método para verificar el estado del usuario.
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

    /*
     * Método para cambiar la contraseña del usuario.
     */
    public function changePassword()
    {
        $sql = 'UPDATE tb_usuarios
            SET clave = ?
            WHERE id_usuario = ?';
        $params = array($this->clave, $this->id);
        return Database::executeRow($sql, $params);
    }

    /*
     * Método para cambiar el estado del usuario.
     */
    public function changeStatus()
    {
        $sql = 'UPDATE tb_usuarios
            SET estado_cliente = ?
            WHERE id_usuario = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    /*
     * Métodos para realizar las operaciones CRUD.
     */

    public function searchRows()
    {
        // Obtener el valor de búsqueda y envolverlo con comodines para usar con LIKE
        $value = '%' . Validator::getSearchValue() . '%';

        // Definir la consulta SQL para buscar coincidencias en la tabla tb_usuarios
        $sql = 'SELECT id_usuario, nombre, nombre_usuario, correo, telefono, direccion, estado_cliente, fecha_registro
            FROM tb_usuarios
            WHERE nombre_usuario LIKE ? OR nombre LIKE ? OR correo LIKE ?
            ORDER BY nombre_usuario';

        // Establecer los parámetros para la consulta (el término de búsqueda)
        $params = array($value, $value, $value);

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Definir la consulta SQL para insertar un nuevo usuario
        $sql = 'INSERT INTO tb_usuarios(nombre, nombre_usuario, correo, telefono, direccion, clave,  fecha_registro)
            VALUES(?, ?, ?, ?, ?, ?, ?)';

        // Establecer los parámetros para la consulta (datos del nuevo usuario)
        $params = array($this->nombre, $this->nombreUser, $this->correo, $this->telefono, $this->direccion, $this->clave, $this->fecha);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        // Definir la consulta SQL para obtener todos los usuarios
        $sql = 'SELECT id_usuario, nombre, nombre_usuario, correo, telefono, direccion, estado_cliente, fecha_registro
            FROM tb_usuarios
            ORDER BY nombre_usuario';

        // Ejecutar la consulta y devolver las filas resultantes
        return Database::getRows($sql);
    }

    public function readOne()
    {
        // Definir la consulta SQL para obtener un usuario específico por su id
        $sql = 'SELECT id_usuario, nombre, nombre_usuario, correo, telefono, direccion, estado_cliente, fecha_registro
            FROM tb_usuarios
            WHERE id_usuario = ?';

        // Establecer los parámetros para la consulta (id del usuario)
        $params = array($this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::getRow($sql, $params);
    }
 
    public function updateRow()
    {
        // Definir la consulta SQL para actualizar el estado de un usuario por su id
        $sql = 'UPDATE tb_usuarios
            SET estado_cliente = ?
            WHERE id_usuario = ?';

        // Establecer los parámetros para la consulta (estado y id del usuario)
        $params = array($this->estado, $this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        // Definir la consulta SQL para eliminar un usuario por su id
        $sql = 'DELETE FROM tb_usuarios
            WHERE id_usuario = ?';

        // Establecer los parámetros para la consulta (id del usuario)
        $params = array($this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::executeRow($sql, $params);
    }

    public function checkDuplicate($value)
    {
        // Definir la consulta SQL para verificar si ya existe un usuario con el correo dado
        $sql = 'SELECT id_usuario
            FROM tb_usuarios
            WHERE correo = ?';

        // Establecer los parámetros para la consulta (correo)
        $params = array($value);

        // Ejecutar la consulta y devolver el resultado
        return Database::getRow($sql, $params);
    }

    public function readFilename()
    {
        // Definir la consulta SQL para obtener el nombre de la imagen de perfil de un usuario por su id
        $sql = 'SELECT imagen
            FROM tb_usuarios
            WHERE id_usuario = ?';

        // Establecer los parámetros para la consulta (id del usuario)
        $params = array($this->id);

        // Ejecutar la consulta y devolver el resultado
        return Database::getRow($sql, $params);
    }
}
