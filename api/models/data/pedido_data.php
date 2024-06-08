<?php
// Se incluye la clase para validar los datos de entrada.
require_once ('../../helpers/validator.php');
// Se incluye la clase padre.
require_once ('../../models/handler/pedido_handler.php');
/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla PEDIDOS.
 */
class PedidoData extends PedidoHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.
    private $estados = array(
        array('PENDIENTE', 'PENDIENTE'),
        array('FINALIZADO', 'FINALIZADO'),
        array('ENTREGADO', 'ENTREGADO'),
        array('CANCELADO', 'CANCELADO')
    );

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
        // Valida que la dirección sea alfanumérica.
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'La dirección debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->direccion = $value; // Asigna el valor de la dirección.
            return true;
        } else {
            $this->data_error = 'La dirección debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    public function setEstado($value)
    {
        // Valida que el estado sea uno de los permitidos.
        if (in_array($value, array_column($this->estados, 0))) {
            $this->estado = $value;
            return true;
        } else {
            $this->data_error = 'Estado incorrecto'; // Almacena mensaje de error.
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

    public function setLibro($value)
    {
        // Valida que el identificador sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->libro = $value; // Asigna el valor del identificador.
            return true;
        } else {
            $this->data_error = 'El libro del pedido es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    public function setCantidad($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            $this->data_error = 'La cantidad del producto debe ser mayor o igual a 1';
            return false;
        }
    }

    /*
     * Métodos para obtener el valor de los atributos adicionales.
     */
    public function getDataError()
    {
        return $this->data_error; // Devuelve el mensaje de error.
    }

    public function getEstados()
    {
        return $this->estados; // Devuelve los estados permitidos.
    }
}