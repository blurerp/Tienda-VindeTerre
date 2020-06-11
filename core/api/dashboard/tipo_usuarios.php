<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/tipo_usuarios.php');

if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $tipo_usuario = new Tipo_Usuarios;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    
    if (true) {
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $tipo_usuario->readAllTipo_usuarios()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay tipo usuarios registrados';
                }
            break;   
            default:
                exit('Acción no disponible');
        }
        header('content-type: application/json; charset=utf-8');
        print(json_encode($result));
    } else {
        exit('Acceso no disponible');
    }
} else {
    exit('Recurso denegado');
}

?>