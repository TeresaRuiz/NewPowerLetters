<?php
// Se incluye la clase para validar los datos de entrada.
require_once ('../../helpers/validator.php');
// Se incluye la clase padre.
require_once ('../../models/handler/autores_handler.php');

/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla AUTORES.
 */
class AutoresData extends AutoresHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.

    /*
     *  Métodos para validar y establecer los datos.
     */

    // Método para establecer el ID del autor.
    public function setId($value)
    {
        // Valida que el identificador sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value; // Asigna el valor del identificador.
            return true;
        } else {
            $this->data_error = 'El identificador del autor es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer el nombre del autor.
    public function setNombre($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'El nombre debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Valida la longitud del nombre.
            $this->nombre = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer la biografía del autor.
    public function setBiografia($value, $min = 2, $max = 50)
    {
        // Valida que la biografía sea alfanumérica.
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'La biografia debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Valida la longitud de la biografía.
            $this->biografia = $value; // Asigna el valor de la biografía.
            return true;
        } else {
            $this->data_error = 'La biografia debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    /*
     *  Métodos para obtener los atributos adicionales.
     */

    // Método para obtener el mensaje de error.
    public function getDataError()
    {
        return $this->data_error; // Devuelve el mensaje de error.
    }
}
?>