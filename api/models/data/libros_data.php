<?php
require_once('../../helpers/validator.php');
require_once('../../models/handler/libro_handler.php');

class libroData extends libroHandler
{
    private $data_error = null;

    public function setIdLibro($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id_libro = $value;
            return true;
        } else {
            $this->data_error = 'El identificador del libro es incorrecto';
            return false;
        }
    }

    public function setTitulo($value, $min = 2, $max = 100)
    {
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El título debe ser un valor alfanumérico';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->titulo = $value;
            return true;
        } else {
            $this->data_error = 'El título debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setDescripcion($value, $min = 2, $max = 200)
    {
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'La descripción debe ser un valor alfanumérico';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->descripcion = $value;
            return true;
        } else {
            $this->data_error = 'La descripción debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setIdAutor($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id_autor = $value;
            return true;
        } else {
            $this->data_error = 'El identificador del autor es incorrecto';
            return false;
        }
    }

    public function setPrecio($value)
    {
        if (Validator::validateDecimal($value)) {
            $this->precio = $value;
            return true;
        } else {
            $this->data_error = 'El precio debe ser un valor decimal';
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

    public function setIdClasificacion($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id_clasificacion = $value;
            return true;
        } else {
            $this->data_error = 'El identificador de la clasificación es incorrecto';
            return false;
        }
    }

    public function setIdEditorial($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id_editorial = $value;
            return true;
        } else {
            $this->data_error = 'El identificador de la editorial es incorrecto';
            return false;
        }
    }

    public function getDataError()
    {
        return $this->data_error;
    }
}