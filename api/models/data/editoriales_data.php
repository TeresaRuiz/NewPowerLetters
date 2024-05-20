<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../helpers/validator.php');
// Se incluye la clase padre.
require_once('../../models/handler/editoriales_handler.php');
/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla CATEGORIA.
 */
class editorialData extends editorialesHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.

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
        if (!Validator::validateAlphabetic($value)) {
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

    /*
     *  Métodos para obtener los atributos adicionales.
     */
    public function getDataError()
    {
        return $this->data_error; // Devuelve el mensaje de error.
    }
}
