<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/proveedores.php');

if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $proveedor = new Proveedores;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (true) {//Cambiar cuando funcione usuarios
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $proveedor->readAllProveedores()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay proveedores registradas';
                }
                break;
            case 'search':
                $_POST = $proveedor->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $proveedor->searchProveedores($_POST['search'])) {
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
                $_POST = $proveedor->validateForm($_POST);
                if ($proveedor->setNombre_proveedor($_POST['nombre_proveedor'])) {
                    if ($proveedor->setCorreo_proveedor($_POST['correo_proveedor'])) {
                        if ($proveedor->setTelefono_proveedor($_POST['telefono_proveedor'])) {
                            if ($proveedor->setDireccion_proveedor($_POST['direccion_proveedor'])) {
                                if ($proveedor->setUrl_proveedor($_POST['url_proveedor'])) {
                                    if ($proveedor->setTipo_documento($_POST['tipo_documento'])) {
                                        if ($proveedor->setNumero_documento($_POST['numero_documento'])) {
                                            if ($proveedor->createProveedores()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Proveedor creado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'Número de documento invalido';
                                        }
                                    } else {
                                        $result['exception'] = 'Tipo de documento invalido';
                                    }
                                } else {
                                    $result['exception'] = 'Link invalido';
                                }
                            } else {
                                $result['exception'] = 'Dirección invalida';
                            }
                        } else {
                            $result['exception'] = 'Telefóno invalido';
                        }
                    } else {
                        $result['exception'] = 'Correo invalido';
                    }
                } else {
                    $result['exception'] = 'Nombre invalido';
                }           
                break;
            case 'readOne':
                if ($proveedor->setId($_POST['id_proveedor'])) {
                    if ($result['dataset'] = $proveedor->readOneProveedores()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Proveedor inexistente';
                    }
                } else {
                    $result['exception'] = 'Proveedor incorrecto';
                }
                break;
            case 'update':
                $_POST = $proveedor->validateForm($_POST);
                if ($proveedor->setId($_POST['id_proveedor'])) {
                    if ($data = $proveedor->readOneProveedores()) {
                        if ($proveedor->setNombre_proveedor($_POST['nombre_proveedor'])) {
                            if ($proveedor->setCorreo_proveedor($_POST['correo_proveedor'])) {
                                if ($proveedor->setTelefono_proveedor($_POST['telefono_proveedor'])) {
                                    if ($proveedor->setDireccion_proveedor($_POST['direccion_proveedor'])) {
                                        if ($proveedor->setUrl_proveedor($_POST['url_proveedor'])) {
                                            if ($proveedor->setTipo_documento($_POST['tipo_documento'])) {
                                                if ($proveedor->setNumero_documento($_POST['numero_documento'])) {
                                                    if ($proveedor->updateProveedores()) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Proveedor modificado correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = 'Número de documento invalido';
                                                }
                                            } else {
                                                $result['exception'] = 'Tipo de documento invalido';
                                            }
                                        } else {
                                            $result['exception'] = 'Link invalido';
                                        }
                                    } else {
                                        $result['exception'] = 'Dirección invalida';
                                    }
                                } else {
                                    $result['exception'] = 'Telefóno invalido';
                                }
                            } else {
                                $result['exception'] = 'Correo invalido';
                            }
                        } else {
                            $result['exception'] = 'Nombre invalido';
                        }           
                    } else {
                        $result['exception'] = 'Proveedor inexistente';
                    }
                } else {
                    $result['exception'] = 'Proveedor incorrecto';
                }            
                break;
            case 'delete':
                if ($proveedor->setId($_POST['id_proveedor'])) {
                    if ($data = $proveedor->readOneProveedores()) {
                        if ($proveedor->deleteProveedores()) {
                            $result['status'] = 1;
                            $result['message'] = 'Proveedor eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Proveedor inexistente';
                    }
                } else {
                    $result['exception'] = 'Proveedor incorrecto';
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