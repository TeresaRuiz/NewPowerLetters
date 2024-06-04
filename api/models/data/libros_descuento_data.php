<?php
// Se incluye la clase para validar los datos de entrada.
require_once ('../../helpers/validator.php');
// Se incluye la clase padre.
require_once ('../../models/handler/libros_descuentoh.php');

/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla LIBROS.
 */
class LibroDescuentoData extends LibroDescuentoHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.

    /*
     *  Métodos para validar y establecer los datos.
     */

    // Método para establecer el ID del libro.
    public function setId($value)
    {
        // Valida que el identificador sea un número natural.
        if (Validator::validateString($value)) {
            $this->id = $value; // Asigna el valor del identificador.
            return true;
        } else {
            $this->data_error = 'El identificador del libro es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer el título del libro.
    public function setTitulo($value, $min = 2, $max = 50)
    {
        // Valida que el título sea alfanumérico.
        if (!Validator::validateString($value)) {
            $this->data_error = 'El título del libro no existe'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Valida la longitud del título.
            $this->titulo = $value; // Asigna el valor del título.
            return true;
        }
    }

    // Método para establecer el autor del libro.
    public function setAutor($value)
    {
        // Valida que el autor sea un número natural.
        if (Validator::validateString($value)) {
            $this->autor = $value; // Asigna el valor del autor.
            return true;
        } else {
            $this->data_error = 'El autor no existe'; // Almacena mensaje de error.
            return false;
        }
    }

 

    // Método para establecer la clasificación del libro.
    public function setClasificación($value)
    {
        // Valida que la clasificación sea un número natural.
        if (Validator::validateString($value)) {
            $this->clasificacion = $value; // Asigna el valor de la clasificación.
            return true;
        } else {
            $this->data_error = 'La clasificación no existe'; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer la editorial del libro.
    public function setEditorial($value)
    {
        // Valida que la editorial sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->editorial = $value; // Asigna el valor de la editorial.
            return true;
        } else {
            $this->data_error = 'Editorial incorrecta'; // Almacena mensaje de error.
            return false;
        }
    }


    // Método para establecer el género del libro.
    public function setGenero($value)
    {
        // Valida que el género sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->genero = $value; // Asigna el valor del género.
            return true;
        } else {
            $this->data_error = 'Género incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }


    /*
     *  Métodos para obtener el valor de los atributos adicionales.
     */

    // Método para obtener el mensaje de error.
    public function getDataError()
    {
        return $this->data_error;
    }

}
