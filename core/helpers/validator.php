<?php

class Validator
{
    // Propiedades para manejar la validación de archivos de imagen.
    private $imageError = null;
    private $imageName = null;
    // Propiedades para manejar la validación de fecha.
    private $dateError = null;

    /*
    *   Método para obtener el nombre del archivo de la imagen validada previamente.
    */
    public function getImageName()
    {
        return $this->imageName;
    }

    /*
    *   Método para obtener el error al validar una imagen.
    */
    public function getImageError()
    {
        // Se compara el número del error para establecer un mensaje de error.
        switch ($this->imageError) {
            case 1:
                $error = 'El tipo de la imagen debe ser gif, jpg o png';
                break;
            case 2:
                $error = 'La dimensión de la imagen es incorrecta';
                break;
            case 3:
                $error = 'El tamaño de la imagen debe ser menor a 2MB';
                break;
            case 4:
                $error = 'El archivo de la imagen no existe';
                break;
            default:
                $error = 'Ocurrió un problema con la imagen';
        }
        return $error;
    }

    public function getDateError()
    {
        switch ($this->dateError) {
            case 1:
                $error = 'La edad minima para registrarse es de 18 años';
                break;
        }
        return $error;
    }

    /*
    *   Método para sanear todos los campos de un formulario (quitar los espacios en blanco al principio y al final).
    *
    *   Parámetros: $fields (arreglo con los campos del formulario).
    *   
    *   Retorno: arreglo con los campos saneados del formulario.
    */
    public function validateForm($fields)
    {
        foreach ($fields as $index => $value) {
            $value = trim($value);
            $fields[$index] = $value;
        }
        return $fields;
    }

    /*
    *   Método para validar un numero natural como por ejemplo llave primaria, llave foránea, entre otros.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateNaturalNumber($value)
    {
        // Se verifica que el valor sea un número entero mayor o igual a uno.
        if (filter_var($value, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un archivo de imagen.
    *
    *   Parámetros: $file (archivo de un formulario), $maxWidth (ancho máximo para la imagen) y $maxHeigth (alto máximo para la imagen).
    *   
    *   Retorno: booleano (true si el archivo es correcto o false en caso contrario).
    */
    public function validateImageFile($file, $maxWidth, $maxHeigth)
    {
        // Se verifica si el archivo existe, de lo contrario se establece un número de error.
        if ($file) {
            // Se comprueba si el archivo tiene un tamaño menor o igual a 2MB, de lo contrario se establece un número de error.
            if ($file['size'] <= 2097152) {
                // Se obtienen las dimensiones de la imagen y su tipo.
                list($width, $height, $type) = getimagesize($file['tmp_name']);
                // Se verifica si la imagen cumple con las dimensiones máximas, de lo contrario se establece un número de error.
                if ($width <= $maxWidth && $height <= $maxHeigth) {
                    // Se comprueba si el tipo de imagen es permitido (1 - GIF, 2 - JPG y 3 - PNG), de lo contrario se establece un número de error.
                    if ($type == 1 || $type == 2 || $type == 3) {
                        // Se obtiene la extensión del archivo.
                        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                        // Se establece un nombre único para el archivo.
                        $this->imageName = uniqid() . '.' . $extension;
                        return true;
                    } else {
                        $this->imageError = 1;
                        return false;
                    }
                } else {
                    $this->imageError = 2;
                    return false;
                }
            } else {
                $this->imageError = 3;
                return false;
            }
        } else {
            $this->imageError = 4;
            return false;
        }
    }

    /*
    *   Método para validar un correo electrónico.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateEmail($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un dato booleano.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateBoolean($value)
    {
        if ($value == 1 || $value == 0 || $value == true || $value == false) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar una cadena de texto (letras, digitos, espacios en blanco y signos de puntuación).
    *
    *   Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateString($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\,\;\.]{' . $minimum . ',' . $maximum . '}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un dato alfabético (letras y espacios en blanco).
    *
    *   Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateAlphabetic($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{' . $minimum . ',' . $maximum . '}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un dato alfanumérico (letras, dígitos y espacios en blanco).
    *
    *   Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateAlphanumeric($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]{' . $minimum . ',' . $maximum . '}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar un dato monetario.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validateMoney($value)
    {
        // Se verifica que el número tenga una parte entera y como máximo dos cifras decimales.
        if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /**Validacion DUI */

    public function validateDui($value)
    {
        // Se verifica que el número tenga una parte entera y como máximo dos cifras decimales.
        if (preg_match('/^[0-9]{8}+([\-][0-9]{1})?$/', $value)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**Validación numero de telefono */
    public function validateTelefono($value)
    {
        // Se verifica que el número tenga 2 partes de 4 digitos separadas por guión
        if (preg_match('/^[0-9]{4}-[0-9]{4}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /**Validación de URL */ 
    public function validateUrl($value)
    {
        // Se verifica que el url sea valido
        if (preg_match('/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /**Validación de año */
    public function validateYear($value)
    {
        if (preg_match('/^[0-9]{4}$/', $value)) {
            return true;
        } else {
            return false;
        }
    } 

    /**Validación de procentaje */
    public function validatePercentage($value)
    {
        // Se verifica que el número tenga una parte entera y como máximo dos cifras decimales.
        if (preg_match('/^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$/', $value)) {
            return true;
        } else {
            return false;
        }
    }
    /**NO FUNCIONA */
    /**Validacion de fecha nacimiento 
     * Ojo, como para registrarse tiene que ser mayor de edad,
     * No es posible registrarse si tiene menos de 18 años de edad.
     */
    /*function validateDate($value)
    {
        list($ano, $mes, $dia) = explode("/", $value);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0){
            $ano_diferencia--;
            if ($ano_diferencia < 18) {
                $this->dateError=1;
                return false;
            }else{
                return true;
            }
        }
        
    }*/
    /**NO FUNCIONA */

    public function validateNumerodocumento($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\,\;\.\-\_\°]{'.$minimum.','.$maximum.'}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateSatatus($value)
    {
        $est_1 = 'En carrito';
        $est_2 = 'Procesado';
        $est_3 = 'Entregado';
        $est_4 = 'Cancelado';
        if ($value == $est_1 || $value == $est_2 || $value == $est_3 || $value == $est_4) {
            return true;
        } else {
            return false;
        }
    }
    /*
    *   Método para validar una contraseña.
    *
    *   Parámetros: $value (dato a validar).
    *   
    *   Retorno: booleano (true si el valor es correcto o false en caso contrario).
    */
    public function validatePassword($value)
    {
        // Se verifica que la longitud de la contraseña sea de al menos 6 caracteres.
        if (strlen($value) >= 6) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Método para validar la ubicación de un archivo antes de subirlo al servidor.
    *
    *   Parámetros: $file (archivo), $path (ruta del archivo) y $name (nombre del archivo).
    *   
    *   Retorno: booleano (true si el archivo fue subido al servidor o false en caso contrario).
    */
    public function saveFile($file, $path, $name)
    {
        // Se verifica que el archivo exista.
        if ($file) {
            // Se comprueba que la ruta en el servidor exista.
            if (file_exists($path)) {
                // Se verifica que el archivo sea movido al servidor.
                if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
    *   Método para validar la ubicación de un archivo antes de borrarlo del servidor.
    *
    *   Parámetros: $path (ruta del archivo) y $name (nombre del archivo).
    *   
    *   Retorno: booleano (true si el archivo fue borrado del servidor o false en caso contrario).
    */
    public function deleteFile($path, $name)
    {
        // Se verifica que la ruta exista.
        if (file_exists($path)) {
            // Se comprueba que el archivo sea borrado del servidor.
            if (@unlink($path . $name)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
