<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../helpers/validator.php');
// Se incluye la clase padre.
require_once('../../models/handler/comentarios_handler.php');

/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla LIBROS.
 */
class ComentarioData extends ComentarioHandler
{
    
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.
    private $estados_comentarios = array(array('ACTIVO', 'ACTIVO'), array('BLOQUEADO', 'BLOQUEADO'));
    /*
     * Métodos para validar y establecer los datos.
     */

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

    public function setComentario($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'Dirección debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->comentario = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'Dirección debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setEstado($value)
    {
        if (in_array($value, array_column($this->estados_comentarios, 0))) {
            $this->estado_comentario = $value;
            return true;
        } else {
            $this->data_error = 'Estado incorrecto';
            return false;
        }
    }

    
    /*
     * Métodos para obtener el valor de los atributos adicionales.
     */
    public function getDataError()
    {
        return $this->data_error;
    }

    public function getEstados()
    {
        return $this->estados_comentarios;
    }
}