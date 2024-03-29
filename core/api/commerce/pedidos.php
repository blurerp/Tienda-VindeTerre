<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/pedidos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $pedido = new Pedidos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'session' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['id_cliente'])) {
        $result['session'] = 1;
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {            
            case 'createDetail':
                if ($pedido->setCliente($_SESSION['id_cliente'])) {
                    if ($pedido->readOrder()) {
                        $_POST = $pedido->validateForm($_POST);
                        if ($pedido->setProducto($_POST['id_producto'])) {
                            if ($pedido->setCantidad($_POST['cantidad_detalle'])) {
                                if ($pedido->setPrecio($_POST['precio_producto_det'])) {
                                    if ($pedido->createDetail()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Producto agregado correctamente';
                                    } else {
                                        $result['exception'] = 'Ocurrió un problema al agregar el producto';
                                    }
                                } else {
                                    $result['exception'] = 'Precio incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Cantidad incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Producto incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Ocurrió un problema al obtener el pedido';
                    }
                } else {
                    $result['exception'] = 'Cliente invalido';
                }                    
                break;
            case 'readCart':
                if ($pedido->setCliente($_SESSION['id_cliente'])) {
                    if ($pedido->readOrder()) {
                        if ($result['dataset'] = $pedido->readCart()) {
                            $result['status'] = 1;
                            $_SESSION['id_pedido'] = $pedido->getId();
                        } else {
                            $result['exception'] = 'No tiene productos en su pedido';
                        }
                    } else {
                        $result['exception'] = 'Debe agregar un producto al pedido';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
            case 'readPedidos':      
                if ($pedido->setCliente($_SESSION['id_cliente'])) {
                    if ($result['dataset'] = $pedido->readPedidos()) {
                        $result['status'] = 1;
                        $_SESSION['id_pedido'] = $pedido->getId();
                    } else {
                        $result['exception'] = 'No tiene productos en su pedido';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break; 
                /*if ($pedido->setCliente($_SESSION['id_cliente'])) {                            
                    if ($result['dataset'] = $pedido->readPedidos()) {
                        $result['status'] = 1;                    
                    } else {
                        $result['exception'] = 'Hubo un problema al mostrar los pedidos, vuelva a intentarlo en un momento';
                    }    
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;*/
            case 'updateDetail':
                if ($pedido->setId($_SESSION['id_pedido'])) {
                    $_POST = $pedido->validateForm($_POST);
                    if ($pedido->setIdDetalle($_POST['id_det_pedido'])) {
                        if ($pedido->setCantidad($_POST['cantidad_detalle'])) {
                            if ($pedido->updateDetail()) {
                                $result['status'] = 1;
                                $result['message'] = 'Cantidad modificada correctamente';
                            } else {
                                $result['exception'] = 'Ocurrió un problema al modificar la cantidad';
                            }
                        } else {
                            $result['exception'] = 'Cantidad incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Detalle incorrecto';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
                }
                break;
            case 'deleteDetail':
                if ($pedido->setId($_SESSION['id_pedido'])) {
                    if ($pedido->setIdDetalle($_POST['id_det_pedido'])) {
                        if ($pedido->deleteDetail()) {
                            $result['status'] = 1;
                            $result['message'] = 'Producto removido correctamente';
                        } else {
                            $result['exception'] = 'Ocurrió un problema al remover el producto';
                        }
                    } else {
                        $result['exception'] = 'Detalle incorrecto';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
                }
                break;
            case 'finishOrder':
                if ($pedido->setId($_SESSION['id_pedido'])) {
                    if ($pedido->setEstado('Procesado')) {
                        if ($pedido->setMonto_total($_POST['pago'])) {
                            if ($pedido->updateOrderStatus()) {
                                $result['status'] = 1;
                                $result['message'] = 'Pedido finalizado correctamente';
                            } else {
                                $result['exception'] = 'Ocurrió un problema al finalizar el pedido';
                            }
                        } else {
                            $result['exception'] = 'El Total de la compra es invalido';
                        }                        
                    } else {
                        $result['exception'] = 'Estado incorrecto';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
                }
                break;
            default:
                exit('Acción no disponible dentro de la sesión');
        }
    } else {
        // Se compara la acción a realizar cuando un cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'createDetail':
                $result['exception'] = 'Debe iniciar sesión para agregar el producto al carrito';
                break;
            default:
                exit('Acción no disponible fuera de la sesión');
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>