<?php
/**
 * Generador de cadenas alfanumericas aleatorias
 * Para usar en recuperacion de contraseñas
 */

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//strength determina la cantidad de caracteres
function generate_string($input, $strength = 5)
{
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

// Pertenece a $input
echo generate_string($permitted_chars);



?>