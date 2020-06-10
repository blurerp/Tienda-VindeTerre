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


function validateDate($value)
    {
        list($ano, $mes, $dia) = explode("/", $value);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0){
            $ano_diferencia--;
            if ($ano_diferencia < 18) {                
                echo 'no permitido';
                return $ano_diferencia;
                                
            }else{
                echo 'permitido';   
                return $ano_diferencia;
                
            }
        }
        
    }

    echo validateDate('2002/03/13')
?>