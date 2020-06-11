<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/pedidos.php');

if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $pedido = new Pedidos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (true) {//Cambiar cuando funcione usuarios
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $pedido->readAllPedidos()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay pedidos registrados';
                }
                break;
            case 'readAllx':
                if ($pedido->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $pedido->readAllPedidosxCliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Cliente inexistente o no ha realizado un pedido';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
            case 'readOne':
                if ($pedido->setId($_POST['id_pedido'])) {
                    if ($result['dataset'] = $pedido->readOnePedidos()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Pedido inexistente';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
                }
                break;
            case 'readOned':
                if ($pedido->setId($_POST['id_pedido'])) {
                    if ($result['dataset'] = $pedido->readOneDetalle()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Pedido inexistente';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
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