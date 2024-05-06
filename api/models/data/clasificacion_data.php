<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../helpers/validator.php');
// Se incluye la clase padre.
require_once('../../models/handler/clasificacion_handler.php');
/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla USUARIO.
 */
class clasificacionData extends clasificacionHandler
{
    // Atributo genérico para manejo de errores.
    private $data_error = null;

    /*
     *  Métodos para validar y asignar valores de los atributos.
     */
    public function setId($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            $this->data_error = 'El identificador de la clasificación es incorrecto';
            return false;
        }
    }

    public function setNombre($value, $min = 2, $max = 50)
    {
        // Verificar si la clasificación ya existe en la base de datos
        $checkSql = 'SELECT COUNT(*) as count FROM tb_clasificaciones WHERE nombre = ?';
        $checkParams = array($value);
        $checkResult = Database::getRow($checkSql, $checkParams);
    
        if ($checkResult['count'] > 0) {
            $this->data_error = 'La clasificación ya existe';
            return false;
        }
    
        // Validar el valor y la longitud del nombre de la clasificación
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'El nombre de la clasificación debe ser un valor alfabético';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->nombre = $value;
            return true;
        } else {
            $this->data_error = 'El nombre de la clasificación debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setDescripcion($value, $min = 2, $max = 50)
    {
        // Validar el valor y la longitud del nombre de la clasificación
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'El texto de la descripción debe ser un valor alfabético';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->descripcion = $value;
            return true;
        } else {
            $this->data_error = 'El texto de la descripción debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }
    


    // Método para obtener el error de los datos.
    public function getDataError()
    {
        return $this->data_error;
    }
}
