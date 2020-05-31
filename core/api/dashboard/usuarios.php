<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');


if (isset($_GET['Action'])) {
    session_start();
    
    $usuarios = new Usuarios;

    $result = array('status' => 0, 'message' => null, 'exception' => null);

    if (isset($_SESSION['id_usuario'])) {
        switch ($_GET['action']) {
            case 'logout':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
            case 'readProfile';
                if ($usuario->setId($_SESSION['id_usuario'])) {
                    if ($result['dataset'] = $usuario->readOneUsuario()) {
                    $result['status'] = 1;
                    } else {
                    $result['exception'] = 'Usuario inexistente';
                }
            } else {
                $result['exception'] = 'Usuario incorrecto';
            }
            break;
        case 'editProfile':
            if ($usuario->setId($_SESSION['id_usuario'])) {
                if ($usuario->readOneUsuario()) {
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->setUsuario($_POST('username_profile'))) {
                        if ($usuario->setNombres($_POST('name_profile'))) {
                            if ($usuario->setApellidos($_POST('lastname_profile'))) {
                                if ($usuario->setFecha($_POST('date_profile'))) {
                                    if () {
                                        # code...
                                    }else{

                                    }
                                    if ($usuario->setDui($_POST('dui_profile'))) {
                                        
                                    }
                                }else {
                                    $result['exception'] = $fecha->getDateError();
                                }
                            }else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        }else {
                            $result['exception'] = 'Nombre incorrecto';
                        }
                    }else {
                        $result['exception'] = 'Nombre de Usuario incorrecto';
                    }
                }else{
                    $result['exception'] = 'Usuario inexistente';
                }
            }else {
                # code...
            }
    }
}else{
    exit('Recurso denegado');
}

?>