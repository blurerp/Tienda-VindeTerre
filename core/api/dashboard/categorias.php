<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/categorias.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $categoria = new Categorias;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (true) {//Cambiar cuando funcione usuarios
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $categoria->readAllCategorias()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay categorías registradas';
                }
                break;
            case 'search':
                $_POST = $categoria->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $categoria->searchCategorias($_POST['search'])) {
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
                $_POST = $categoria->validateForm($_POST);
                if ($categoria->setNombre($_POST['categoria'])) {
                    if (is_uploaded_file($_FILES['archivo_categoria']['tmp_name'])) {
                        if ($categoria->setImagen($_FILES['archivo_categoria'])) {
                            if ($categoria->createCategoria()) {
                                $result['status'] = 1;
                                $result['message'] = 'Categoría creada correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = $categoria->getImageError();
                        }
                    } else {
                        $result['exception'] = 'Seleccione una imagen';
                    }            
                } else {
                    $result['exception'] = 'Nombre incorrecto';
                }
                break;
            case 'readOne':
                if ($categoria->setId($_POST['id_categoria'])) {
                    if ($result['dataset'] = $categoria->readOneCategoria()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Categoría inexistente';
                    }
                } else {
                    $result['exception'] = 'Categoría incorrecta';
                }
                break;
            case 'update':
                $_POST = $categoria->validateForm($_POST);
                if ($categoria->setId($_POST['id_categoria'])) {
                    if ($data = $categoria->readOneCategoria()) {
                        if ($categoria->setNombre($_POST['categoria'])) {
                            if (is_uploaded_file($_FILES['archivo_categoria']['tmp_name'])) {
                                if ($categoria->setImagen($_FILES['archivo_categoria'])) {
                                    if ($categoria->updateCategoria()) {
                                        $result['status'] = 1;
                                        if ($categoria->deleteFile($categoria->getRuta(), $data['imagen_categoria'])) {
                                            $result['message'] = 'Categoría modificada correctamente';
                                        } else {
                                            $result['message'] = 'Categoría modificada pero no se borro la imagen anterior';
                                        }
                                    } else {
                                        $result['exception'] = Database::getException();
                                    } 
                                } else {
                                    $result['exception'] = $categoria->getImageError();
                                }
                            } else {
                                if ($categoria->updateCategoria()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Categoría modificada correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            }
                        } else {
                            $result['exception'] = 'Nombre incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Categoría inexistente';
                    }
                } else {
                    $result['exception'] = 'Categoría incorrecta';
                }
                break;
            case 'delete':
                if ($categoria->setId($_POST['id_categoria'])) {
                    if ($data = $categoria->readOneCategoria()) {
                        if ($categoria->deleteCategoria()) {
                            $result['status'] = 1;
                            if ($categoria->deleteFile($categoria->getRuta(), $data['imagen_categoria'])) {
                                $result['message'] = 'Categoría eliminada correctamente';
                            } else {
                                $result['message'] = 'Categoría eliminada pero no se borro la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Categoría inexistente';
                    }
                } else {
                    $result['exception'] = 'Categoría incorrecta';
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