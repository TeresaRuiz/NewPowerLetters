<?php
// Se incluye la clase para validar los datos de entrada.
require_once ('../../helpers/validator.php');
// Se incluye la clase padre.
require_once ('../../models/handler/usuarios_handler.php');

/*
 *   Clase para manejar el encapsulamiento de los datos de la tabla CLIENTE.
 */
class UsuarioData extends UsuarioHandler
{
    // Atributo genérico para manejo de errores.
    private $data_error = null;
    private $filename = null;

    /*
     *   Métodos para validar y establecer los datos.
     */
    public function setId($value)
    {
        // Valida que el identificador sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value; // Asigna el valor del identificador si es válido.
            return true;
        } else {
            $this->data_error = 'El identificador del usuario es incorrecto'; // Almacena mensaje de error si es inválido.
            return false;
        }
    }

    public function setNombre($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfabético.
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'El nombre debe ser un valor alfabético'; // Almacena mensaje de error si es inválido.
            return false;
        }
        // Valida que el nombre tenga una longitud adecuada.
        elseif (Validator::validateLength($value, $min, $max)) {
            $this->nombre = $value; // Asigna el valor del nombre si es válido.
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error si es inválido.
            return false;
        }
    }

    public function setNombreUsuario($value, $min = 2, $max = 50)
    {
        // Valida que el nombre de usuario sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El nombre de usuario debe ser un valor alfanumérico'; // Almacena mensaje de error si es inválido.
            return false;
        }
        // Valida que el nombre de usuario tenga una longitud adecuada.
        elseif (Validator::validateLength($value, $min, $max)) {
            $this->nombreUser = $value; // Asigna el valor del nombre de usuario si es válido.
            return true;
        } else {
            $this->data_error = 'El nombre de usuario debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error si es inválido.
            return false;
        }
    }

    public function setCorreo($value, $min = 8, $max = 100)
    {
        // Valida que el correo sea válido.
        if (!Validator::validateEmail($value)) {
            $this->data_error = 'El correo no es válido'; // Almacena mensaje de error si es inválido.
            return false;
        }
        // Valida que el correo tenga una longitud adecuada.
        elseif (!Validator::validateLength($value, $min, $max)) {
            $this->data_error = 'El correo debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error si es inválido.
            return false;
        }
        // Valida que el correo no esté duplicado en la base de datos.
        elseif ($this->checkDuplicate($value)) {
            $this->data_error = 'El correo ingresado ya existe'; // Almacena mensaje de error si es duplicado.
            return false;
        } else {
            $this->correo = $value; // Asigna el valor del correo si es válido.
            return true;
        }
    }

    public function setClave($value)
    {
        // Valida que la clave cumpla con los requisitos.
        if (Validator::validatePassword($value)) {
            $this->clave = password_hash($value, PASSWORD_DEFAULT); // Asigna la clave encriptada si es válida.
            return true;
        } else {
            $this->data_error = Validator::getPasswordError(); // Almacena mensaje de error si es inválida.
            return false;
        }
    }

    public function setDireccion($value, $min = 2, $max = 250)
    {
        // Valida que la dirección no contenga caracteres prohibidos.
        if (!Validator::validateString($value)) {
            $this->data_error = 'La dirección contiene caracteres prohibidos'; // Almacena mensaje de error si es inválida.
            return false;
        }
        // Valida que la dirección tenga una longitud adecuada.
        elseif (Validator::validateLength($value, $min, $max)) {
            $this->direccion = $value; // Asigna el valor de la dirección si es válida.
            return true;
        } else {
            $this->data_error = 'La dirección debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error si es inválida.
            return false;
        }
    }

    public function setTelefono($value)
    {
        // Valida que el teléfono tenga el formato adecuado.
        if (Validator::validatePhone($value)) {
            $this->telefono = $value; // Asigna el valor del teléfono si es válido.
            return true;
        } else {
            $this->data_error = 'El teléfono debe tener el formato (2, 6, 7)###-####'; // Almacena mensaje de error si es inválido.
            return false;
        }
    }

    public function setImagen($file, $filename = null)
    {
        // Valida que el archivo de imagen sea válido y no exceda los 500 KB.
        if (Validator::validateImageFile($file, 500)) {
            $this->imagen = Validator::getFileName(); // Asigna el nombre del archivo de imagen si es válido.
            return true;
        }
        // Verifica si hubo algún error con el archivo de imagen.
        elseif (Validator::getFileError()) {
            $this->data_error = Validator::getFileError(); // Almacena mensaje de error si hubo algún problema con el archivo.
            return false;
        }
        // Si no se proporciona un nuevo archivo, se mantiene el archivo existente.
        elseif ($filename) {
            $this->imagen = $filename; // Asigna el nombre del archivo de imagen existente.
            return true;
        } else {
            $this->imagen = 'default.png'; // Asigna una imagen por defecto si no se proporciona ninguna.
            return true;
        }
    }

    public function setEstado($value)
    {
        // Valida que el estado sea un valor booleano.
        if (Validator::validateBoolean($value)) {
            $this->estado = $value; // Asigna el valor del estado si es válido.
            return true;
        } else {
            $this->data_error = 'Estado incorrecto'; // Almacena mensaje de error si es inválido.
            return false;
        }
    }

    public function setFecha($value)
    {
        // Valida que la fecha tenga el formato adecuado.
        if (Validator::validateDate($value)) {
            $this->fecha = $value; // Asigna el valor de la fecha si es válido.
            return true;
        } else {
            $this->data_error = 'La fecha de nacimiento es incorrecta'; // Almacena mensaje de error si es inválida.
            return false;
        }
    }

    public function setFilename()
    {
        // Lee el nombre del archivo de imagen de la base de datos.
        if ($data = $this->readFilename()) {
            $this->filename = $data['imagen']; // Asigna el nombre del archivo de imagen si se encuentra.
            return true;
        } else {
            $this->data_error = 'Imagen de usuario inexistente'; // Almacena mensaje de error si no se encuentra la imagen.
            return false;
        }
    }

    /*
     *   Métodos para obtener el valor de los atributos adicionales.
     */
    public function getDataError()
    {
        // Devuelve el mensaje de error almacenado.
        return $this->data_error;
    }

    public function getFilename()
    {
        // Devuelve el nombre del archivo de imagen del usuario.
        return $this->filename;
    }
}