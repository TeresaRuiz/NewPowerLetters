<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../helpers/validator.php');
// Se incluye la clase padre.
require_once('../../models/handler/pedido_handler.php');
/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla LIBROS.
 */
class PedidoData extends PedidoHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.
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
            $this->data_error = 'El identificador del pedido es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    public function setIdUsuario($value)
    {
        // Valida que el identificador de usuario sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->id_usuario = $value; // Asigna el valor del identificador de usuario.
            return true;
        } else {
            $this->data_error = 'El identificador de usuario es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    public function setDireccion($value, $min = 2, $max = 50)
    {
        // Valida que el nombre sea alfanumérico.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'Dirección debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->direccion = $value; // Asigna el valor del nombre.
            return true;
        } else {
            $this->data_error = 'Dirección debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setEstado($value)
    {
        if (Validator::validateBoolean($value)) {
            $this->estado = $value;
            return true;
        } else {
            $this->data_error = 'Estado incorrecto';
            return false;
        }
    }

    public function setFecha($value)
{
    // Valida el formato de la fecha.
    if (Validator::validateDateTime($value, 'Y-m-d H:i:s')) {
        $this->fecha = $value; // Asigna el valor de la fecha.
        return true;
    } else {
        $this->data_error = 'El formato de fecha debe ser YYYY-MM-DD HH:MM:SS'; // Almacena mensaje de error.
        return false;
    }
}

    public function setIdDetalle($value)
    {
        // Valida que el identificador del detalle sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->id_detalle = $value; // Asigna el valor del identificador del detalle.
            return true;
        } else {
            $this->data_error = 'El identificador del detalle es incorrecto'; // Almacena mensaje de error.
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
}