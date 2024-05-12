<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../helpers/validator.php');
// Se incluye la clase padre.
require_once('../../models/handler/libro_handler.php');
/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla LIBROS.
 */
class LibroData extends LibroHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.
    private $filename = null;

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

    public function setTitulo($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El titulo debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->titulo = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'El titulo debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setAutor($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El nombre debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->autor = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setPrecio($value)
    {
        if (Validator::validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            $this->data_error = 'El precio debe ser un número positivo';
            return false;
        }
    }

    public function setDescripcion($value, $min = 2, $max = 250)
    {
        if (!Validator::validateString($value)) {
            $this->data_error = 'La descripción contiene caracteres prohibidos';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->descripcion = $value;
            return true;
        } else {
            $this->data_error = 'La descripción debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setImagen($file, $filename = null)
    {
        if (Validator::validateImageFile($file, 1000)) {
            $this->imagen = Validator::getFileName();
            return true;
        } elseif (Validator::getFileError()) {
            $this->data_error = Validator::getFileError();
            return false;
        } elseif ($filename) {
            $this->imagen = $filename;
            return true;
        } else {
            $this->imagen = 'default.png';
            return true;
        }
    }

    public function setClasificación($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El nombre debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->clasificacion = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setEditorial($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'La editorial debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->editorial = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setExistencias($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->existencias = $value;
            return true;
        } else {
            $this->data_error = 'Las existencias debe ser un número entero positivo';
            return false;
        }
    }

    public function setGenero($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El genero debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->genero = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'El genero debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setFilename()
    {
        if ($data = $this->readFilename()) {
            $this->filename = $data['imagen'];
            return true;
        } else {
            $this->data_error = 'Libro inexistente';
            return false;
        }
    }

    /*
     *  Métodos para obtener el valor de los atributos adicionales.
     */
    public function getDataError()
    {
        return $this->data_error;
    }

    public function getFilename()
    {
        return $this->filename;
    }
}