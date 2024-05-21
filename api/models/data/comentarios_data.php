<?php
// Se incluye la clase para validar los datos de entrada.
require_once ('../../helpers/validator.php');
// Se incluye la clase padre.
require_once ('../../models/handler/comentarios_handler.php');

/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla COMENTARIOS.
 */
class ComentarioData extends ComentarioHandler
{

    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.
    private $estados = array(array('ACTIVO', 'ACTIVO'), array('BLOQUEADO', 'BLOQUEADO')); // Lista de estados posibles.

    /*
     * Métodos para validar y establecer los datos.
     */

    // Método para establecer el ID del comentario.
    public function setId($value)
    {
        // Valida que el identificador sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value; // Asigna el valor del identificador.
            return true;
        } else {
            $this->data_error = 'El identificador del comentario es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer el contenido del comentario.
    public function setComentario($value, $min = 2, $max = 50)
    {
        // Valida que el comentario sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'Comentario debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Valida la longitud del comentario.
            $this->comentario = $value; // Asigna el valor del comentario.
            return true;
        } else {
            $this->data_error = 'Comentario debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer el estado del comentario.
    public function setEstado($value)
    {
        // Valida que el estado esté en la lista de estados posibles.
        if (in_array($value, array_column($this->estados, 0))) {
            $this->estado = $value; // Asigna el estado del comentario.
            return true;
        } else {
            $this->data_error = 'Estado incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }


    /*
     * Métodos para obtener el valor de los atributos adicionales.
     */

    // Método para obtener el mensaje de error.
    public function getDataError()
    {
        return $this->data_error;
    }

    // Método para obtener la lista de estados posibles.
    public function getEstados()
    {
        return $this->estados;
    }
}