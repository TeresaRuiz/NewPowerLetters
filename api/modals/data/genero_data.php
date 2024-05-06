<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../helpers/validator.php');
// Se incluye la clase padre.
require_once('../../models/handler/genero_handler.php');
/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla CATEGORIA.
 */
class GeneroData extends GeneroHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.
    private $filename = null; // Variable para almacenar el nombre del archivo de imagen.

    /*
     *  Métodos para validar y establecer los datos.
     */
    public function setId($value)
    {
        // Valida que el identificador sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value; // Asigna el valor del identificador.
            return true;
        } else {
            $this->data_error = 'El identificador del género es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    public function setNombre($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El nombre debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->nombre = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setImagen($file, $filename = null)
    {
        // Valida el archivo de imagen.
        if (Validator::validateImageFile($file, 1000)) {
            $this->imagen = Validator::getFilename(); // Asigna el nombre del archivo de imagen.
            return true;
        } elseif (Validator::getFileError()) {
            $this->data_error = Validator::getFileError(); // Almacena mensaje de error.
            return false;
        } elseif ($filename) {
            $this->imagen = $filename; // Asigna un nombre de archivo alternativo.
            return true;
        } else {
            $this->imagen = 'default.png'; // Asigna un valor por defecto.
            return true;
        }
    }

    public function setDescripcion($value, $min = 2, $max = 250)
    {
        // Valida la descripción.
        if (!$value) {
            return true;
        } elseif (!Validator::validateString($value)) {
            $this->data_error = 'La descripción contiene caracteres prohibidos'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->descripcion = $value; // Asigna el valor de la descripción.
            return true;
        } else {
            $this->data_error = 'La descripción debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setFilename()
    {
        // Obtiene el nombre del archivo de imagen de la categoría.
        if ($data = $this->readFilename()) {
            $this->filename = $data['imagen_categoria']; // Asigna el nombre del archivo.
            return true;
        } else {
            $this->data_error = 'Categoría inexistente'; // Almacena mensaje de error.
            return false;
        }
    }

    /*
     *  Métodos para obtener los atributos adicionales.
     */
    public function getDataError()
    {
        return $this->data_error; // Devuelve el mensaje de error.
    }

    public function getFilename()
    {
        return $this->filename; // Devuelve el nombre del archivo de imagen.
    }
}
