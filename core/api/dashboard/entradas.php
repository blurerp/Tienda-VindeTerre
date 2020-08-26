<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/entradas.php');

if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $entrada = new Entradas;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (true) {//Cambiar cuando funcione usuarios
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $entrada->readAllEntrada()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay entradas registradas';
                }
                break;
            case 'search':
                $_POST = $entrada->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $entrada->searchEntrada($_POST['search'])) {
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
                $_POST = $entrada->validateForm($_POST);
                if (isset($_POST['producto'])) {
                    if ($entrada->setProducto($_POST['producto'])) {
                        if ($entrada->setCantidad_ingresar($_POST['cantidad_ingresar'])) {
                            if ($_POST['cantidad_ingresar'] <= 999999) {
                                if (isset($_POST['proveedor'])) {
                                    if ($entrada->setProveedor($_POST['proveedor'])) {
                                        if ($entrada->createEntrada()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Entrada creada correctamente';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Proveedor inválido';
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione un Proveedor';
                                }
                            } else {
                                $result['exception'] = 'Cantidad a ingresar mayor a 999,999';
                            }
                        } else {
                            $result['exception'] = 'Cantidad a ingresar invalida';
                        }
                    } else {
                        $result['exception'] = 'Producto inválido';
                    }
                } else {
                    $result['exception'] = 'Seleccione un Producto';
                }                
                break;
            case 'readOne':
                if ($entrada->setId($_POST['id_entrada'])) {
                    if ($result['dataset'] = $entrada->readOneEntrada()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Entrada inexistente';
                    }
                } else {
                    $result['exception'] = 'Entrada incorrecta';
                }
                break;
            case 'update':
                $_POST = $entrada->validateForm($_POST);
                if ($entrada->setId($_POST['id_entrada'])){
                    if ($data = $entrada->readOneEntrada()) {
                        if (isset($_POST['producto'])) {
                            if ($entrada->setProducto($_POST['producto'])) {
                                if ($entrada->setCantidad_ingresar($_POST['cantidad_ingresar'])) {
                                    if ($_POST['cantidad_ingresar'] <= 999999) {
                                        if (isset($_POST['proveedor'])) {
                                            if ($entrada->setProveedor($_POST['proveedor'])) {
                                                if ($entrada->updateEntrada()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Entrada modificada correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['exception'] = 'Proveedor inválido';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione un Proveedor';
                                        }
                                    } else {
                                        $result['exception'] = 'Cantidad a ingresar mayor a 999,999';
                                    }
                                } else {
                                    $result['exception'] = 'Cantidad a ingresar invalida';
                                }
                            } else {
                                $result['exception'] = 'Producto inválido';
                            }
                        } else {
                            $result['exception'] = 'Seleccione un Producto';
                        }           
                    } else {
                        $result['exception'] = 'Entrada inexistente';
                    }
                }else {
                    $result['exception'] = 'Entrada incorrecta';
                }                
                break;
            case 'delete':
                if ($entrada->setId($_POST['id_entrada'])) {
                    if ($data = $entrada->readOneEntrada()) {
                        if ($entrada->deleteEntrada()) {
                            $result['status'] = 1;
                            $result['message'] = 'Entrada eliminada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Entrada inexistente';
                    }
                } else {
                    $result['exception'] = 'Entrada incorrecta';
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