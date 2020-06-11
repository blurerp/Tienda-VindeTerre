<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/bodegas.php');

if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $bodega = new Bodegas;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (true) {//Cambiar cuando funcione usuarios
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $bodega->readAllBodegas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay bodegas registradas';
                }
                break;
            case 'search':
                $_POST = $bodega->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $bodega->searchBodegas($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se encontraron '.$rows.' coincidencias';
                        } else {
                            $result['message'] = 'Solo existe una coincidencia';
                        }
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                $_POST = $bodega->validateForm($_POST);
                if($bodega->setcapacidad($_POST['capacidad'])) {
                    if($bodega->setDireccion_bodega($_POST['direccion_bodega'])) {
                        if($bodega->setTelefono_bodega($_POST['telefono_bodega'])) {
                            if ($bodega->createBodegas()) {
                                $result['status'] = 1;
                                $result['message'] = 'Bodega creada correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Telefóno invalido, utilize el formato apropiado';
                        }
                    } else {
                        $result['exception'] = 'Dirección invalida';
                    }
                } else {
                    $result['exception'] = 'Capacidad invalida';
                }
                break;
            case 'readOne':
                if ($bodega->setId($_POST['id_bodega'])) {
                    if ($result['dataset'] = $bodega->readOneBodegas()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Bodega inexistente';
                    }
                } else {
                    $result['exception'] = 'Bodega incorrecta';
                }
                break;
            case 'update':
                $_POST = $bodega->validateForm($_POST);
                if ($bodega->setId($_POST['id_bodega'])){
                    if ($data = $bodega->readOneBodegas()) {
                        if($bodega->setcapacidad($_POST['capacidad'])) {
                            if($bodega->setDireccion_bodega($_POST['direccion_bodega'])) {
                                if($bodega->setTelefono_bodega($_POST['telefono_bodega'])) {
                                    if ($bodega->updateBodegas()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Bodega modificada correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Telefóno invalido, utilize el formato apropiado';
                                }
                            } else {
                                $result['exception'] = 'Dirección invalida';
                            }
                        } else {
                            $result['exception'] = 'Capacidad invalida';
                        }
                    } else {
                        $result['exception'] = 'Bodega inexistente';
                    }
                }else {
                    $result['exception'] = 'Bodega incorrecta';
                }
                break;
            case 'delete':
                if ($bodega->setId($_POST['id_bodega'])) {
                    if ($data = $bodega->readOneBodegas()) {
                        if ($bodega->deleteBodegas()) {
                            $result['status'] = 1;
                            $result['message'] = 'Bodega eliminada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Bodega inexistente';
                    }
                } else {
                    $result['exception'] = 'Bodega incorrecta';
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