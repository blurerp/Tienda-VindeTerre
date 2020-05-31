<?php
/**
 * Generador de cadenas alfanumericas aleatorias
 * Para usar en recuperacion de contraseñas
 */


//strength determina la cantidad de caracteres
function generate_string($strength)
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

// Pertenece a strength
echo generate_string(4);



?>