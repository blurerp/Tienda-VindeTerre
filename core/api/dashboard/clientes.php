<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/clientes.php');

if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $cliente = new Clientes;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (true) {//Cambiar cuando funcione usuarios
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $cliente->readAllClientes()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay clientes registrados';
                }
                break;
            case 'readOne':
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $cliente->readOneClientes()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
            case 'update':              
                if ($cliente->setId($_POST['id_cliente'])){
                    if ($data = $cliente->readOneClientes()) {
                        if($cliente->setEstado_cliente($_POST['estado_cliente'])) {
                            if ($cliente->updateClientes()) {
                                $result['status'] = 1;
                                $result['message'] = 'Estado modificado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Estado invalido';
                        }
                    } else {
                        $result['exception'] = 'Cliente inexistente';
                    }
                }else {
                    $result['exception'] = 'Cliente incorrecto';
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