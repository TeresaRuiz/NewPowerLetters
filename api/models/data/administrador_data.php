<?php
// Se incluye la clase para validar los datos de entrada.
require_once ('../../helpers/validator.php');
// Se incluye la clase padre.
require_once ('../../models/handler/administrador_handler.php');

/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla ADMINISTRADORES.
 */
class AdministradorData extends AdministradorHandler
{
    // Atributo genérico para manejo de errores.
    private $data_error = null;

    /*
     *  Métodos para validar y asignar valores de los atributos.
     */

    // Método para asignar el ID del administrador.
    public function setId($value)
    {
        // Validar que el valor sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            $this->data_error = 'El identificador del administrador es incorrecto';
            return false;
        }
    }

    // Método para asignar el nombre del administrador.
    public function setNombre($value, $min = 2, $max = 50)
    {
        // Validar que el valor sea alfabético.
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'El nombre debe ser un valor alfabético';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Validar la longitud del nombre.
            $this->nombre = $value;
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    // Método para asignar el apellido del administrador.
    public function setApellido($value, $min = 2, $max = 50)
    {
        // Validar que el valor sea alfabético.
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'El apellido debe ser un valor alfabético';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Validar la longitud del apellido.
            $this->apellido = $value;
            return true;
        } else {
            $this->data_error = 'El apellido debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    // Método para asignar el correo del administrador.
    public function setCorreo($value, $min = 8, $max = 100)
    {
        // Validar que el valor sea un correo electrónico válido.
        if (!Validator::validateEmail($value)) {
            $this->data_error = 'El correo no es válido';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Validar la longitud del correo.
            $this->correo = $value;
            return true;
        } else {
            $this->data_error = 'El correo debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    // Método para asignar el alias del administrador.
    public function setAlias($value, $min = 6, $max = 25)
    {
        // Validar que el valor sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El alias debe ser un valor alfanumérico';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Validar la longitud del alias.
            $this->alias = $value;
            return true;
        } else {
            $this->data_error = 'El alias debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    // Método para asignar la clave del administrador.
    public function setClave($value)
    {
        // Validar que la contraseña cumpla con los requisitos.
        if (Validator::validatePassword($value)) {
            // Hashear la contraseña y asignarla.
            $this->clave = password_hash($value, PASSWORD_DEFAULT);
            return true;
        } else {
            // Obtener y asignar el error relacionado con la contraseña.
            $this->data_error = Validator::getPasswordError();
            return false;
        }
    }

    // Método para obtener el error de los datos.
    public function getDataError()
    {
        return $this->data_error;
    }
}