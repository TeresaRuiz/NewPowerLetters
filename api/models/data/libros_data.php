<?php
// Se incluye la clase para validar los datos de entrada.
require_once ('../../helpers/validator.php');
// Se incluye la clase padre.
require_once ('../../models/handler/libro_handler.php');

/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla LIBROS.
 */
class LibroData extends LibroHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null; // Variable para almacenar mensajes de error.
    private $filename = null; // Nombre del archivo de imagen.

    /*
     *  Métodos para validar y establecer los datos.
     */

    // Método para establecer el ID del libro.
    public function setId($value)
    {
        // Valida que el identificador sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
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
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El título debe ser un valor alfanumérico'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Valida la longitud del título.
            $this->titulo = $value; // Asigna el valor del título.
            return true;
        } else {
            $this->data_error = 'El título debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer el autor del libro.
    public function setAutor($value)
    {
        // Valida que el autor sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->autor = $value; // Asigna el valor del autor.
            return true;
        } else {
            $this->data_error = 'El autor es incorrecto'; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer el precio del libro.
    public function setPrecio($value)
    {
        // Valida que el precio sea un número válido.
        if (Validator::validateMoney($value)) {
            $this->precio = $value; // Asigna el valor del precio.
            return true;
        } else {
            $this->data_error = 'El precio debe ser un número positivo'; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer la descripción del libro.
    public function setDescripcion($value, $min = 2, $max = 250)
    {
        // Valida que la descripción sea una cadena de caracteres válida.
        if (!Validator::validateString($value)) {
            $this->data_error = 'La descripción contiene caracteres prohibidos'; // Almacena mensaje de error.
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) { // Valida la longitud de la descripción.
            $this->descripcion = $value; // Asigna el valor de la descripción.
            return true;
        } else {
            $this->data_error = 'La descripción debe tener una longitud entre ' . $min . ' y ' . $max; // Almacena mensaje de error.
            return false;
        }
    }

    // Método para establecer la imagen del libro.
    public function setImagen($file, $filename = null)
    {
        // Valida el archivo de imagen y su tamaño.
        if (Validator::validateImageFile($file, 500)) {
            $this->imagen = Validator::getFileName(); // Asigna el nombre de archivo de imagen generado.
            return true;
        } elseif (Validator::getFileError()) {
            $this->data_error = Validator::getFileError(); // Almacena mensaje de error si hay algún error en el archivo.
            return false;
        } elseif ($filename) {
            $this->imagen = $filename; // Utiliza el nombre de archivo proporcionado.
            return true;
        } else {
            $this->imagen = 'default.png'; // Utiliza una imagen predeterminada si no se proporciona ninguna.
            return true;
        }
    }

    // Método para establecer la clasificación del libro.
    public function setClasificación($value)
    {
        // Valida que la clasificación sea un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->clasificacion = $value; // Asigna el valor de la clasificación.
            return true;
        } else {
            $this->data_error = 'Clasificación incorrecta'; // Almacena mensaje de error.
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

    // Método para establecer las existencias del libro.
    public function setExistencias($value)
    {
        // Valida que las existencias sean un número natural.
        if (Validator::validateNaturalNumber($value)) {
            $this->existencias = $value; // Asigna el valor de las existencias.
            return true;
        } else {
            $this->data_error = 'Las existencias deben ser un número entero positivo'; // Almacena mensaje de error.
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

    // Método para establecer el nombre del archivo de imagen.
    public function setFilename()
    {
        // Lee el nombre de archivo del libro.
        if ($data = $this->readFilename()) {
            $this->filename = $data['imagen']; // Asigna el nombre de archivo obtenido.
            return true;
        } else {
            $this->data_error = 'Libro inexistente';
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

    // Método para obtener el nombre del archivo de imagen.
    public function getFilename()
    {
        return $this->filename;
    }
}
