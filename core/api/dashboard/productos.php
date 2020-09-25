<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/productos.php');

if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $producto = new Productos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (true) { //Cambiar cuando funcione usuarios
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $producto->readAllProductos()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay productos registrados';
                }
                break;
            case 'search':
                $_POST = $producto->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $producto->searchProductos($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
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
            case 'readProductosCategoria':                
                    if ($result['dataset'] = $producto->cantidadProductosCategoria()) {
                        $result['status'] = 1;
                    }else {
                        $result['message'] = 'No hay datos disponibles';
                    }                     
                            
            break;
            case 'create':
                $_POST = $producto->validateForm($_POST);
                if ($producto->setNombre($_POST['nombre_producto'])) {
                    if ($producto->setPrecio_venta($_POST['precio_venta'])) {
                        if (is_uploaded_file($_FILES['archivo_producto']['tmp_name'])) {
                            if ($producto->setImagen($_FILES['archivo_producto'])) {
                                if ($producto->setPrecio_compra($_POST['precio_compra'])) {
                                    if ($producto->setDescripcion_producto($_POST['descripcion_producto'])) {
                                        if ($producto->setCosecha($_POST['cosecha'])) {
                                            if ($_POST['cosecha'] >= 1650 && $_POST['cosecha'] <= date("Y")) {
                                                if ($producto->setAlcohol($_POST['alcohol'])) {
                                                    if ($_POST['alcohol'] >= 5.5 && $_POST['alcohol'] <= 20) {
                                                        if ($producto->setStock_minimo($_POST['stock_minimo'])) {
                                                            if ($_POST['stock_minimo'] <= 999999) {
                                                                if (isset($_POST['bodega'])) {
                                                                    if ($producto->setBodega($_POST['bodega'])) {
                                                                        if (isset($_POST['categoria'])) {
                                                                            if ($producto->setCategoria($_POST['categoria'])) {
                                                                                if ($_POST['estado_producto'] == 'Agotado') {
                                                                                    if ($producto->setEstado($_POST['estado_producto'])) {
                                                                                        if ($producto->createProductos()) {
                                                                                            $result['status'] = 1;
                                                                                            $result['message'] = 'Producto creado correctamente';
                                                                                        } else {
                                                                                            $result['exception'] = Database::getException();
                                                                                        }
                                                                                    } else {
                                                                                        $result['exception'] = 'El estado es incorrecto';
                                                                                    }
                                                                                } else {
                                                                                    $result['exception'] = 'El estado elegido es inválido, seleccione "Agotado" por ser un producto nuevo';
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = 'Categoria inválida';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = 'Seleccione una categoria';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Bodega inválida';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Seleccione una bodega';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Stock Minímo mayor a 999,999';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Stock Minímo invalido';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Porcentaje de Alcohol menor a 5.5% o mayor a 20%';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Porcentaje de Alcohol invalido';
                                                }
                                            } else {
                                                $result['exception'] = 'Año de cosecha ingresado menor a 1650 o mayor a ' . date("Y");
                                            }
                                        } else {
                                            $result['exception'] = 'Año de cosecha invalido';
                                        }
                                    } else {
                                        $result['exception'] = 'Descripción invalida';
                                    }
                                } else {
                                    $result['exception'] = 'Precio Compra invalido';
                                }
                            } else {
                                $result['exception'] = $producto->getImageError();
                            }
                        } else {
                            $result['exception'] = 'Seleccione una imagen';
                        }
                    } else {
                        $result['exception'] = 'Precio Venta invalido';
                    }
                } else {
                    $result['exception'] = 'Nombre invalido';
                }
                break;
            case 'readOne':
                if ($producto->setId($_POST['id_producto'])) {

                    if ($result['dataset'] = $producto->readOneProductos()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            case 'update':
                $_POST = $producto->validateForm($_POST);
                if ($producto->setId($_POST['id_producto'])) {
                    if ($data = $producto->readOneProductos()) {
                        if ($producto->setCodigo_producto($_POST['codigo_producto'])) {
                            if ($producto->setNombre($_POST['nombre_producto'])) {
                                if ($producto->setPrecio_venta($_POST['precio_venta'])) {
                                    if ($producto->setPrecio_compra($_POST['precio_compra'])) {
                                        if ($producto->setDescripcion_producto($_POST['descripcion_producto'])) {
                                            if ($producto->setCosecha($_POST['cosecha'])) {
                                                if ($_POST['cosecha'] >= 1650 && $_POST['cosecha'] <= date("Y")) {
                                                    if ($producto->setAlcohol($_POST['alcohol'])) {
                                                        if ($_POST['alcohol'] >= 5.5 && $_POST['alcohol'] <= 20) {
                                                            if ($producto->setStock_minimo($_POST['stock_minimo'])) {
                                                                if ($_POST['stock_minimo'] <= 999999) {
                                                                    if (isset($_POST['bodega'])) {
                                                                        if ($producto->setBodega($_POST['bodega'])) {
                                                                            if (isset($_POST['categoria'])) {
                                                                                if ($producto->setCategoria($_POST['categoria'])) {
                                                                                    if ($_POST['estado_producto'] == 'Agotado' || 'En existencia' || 'Inactivo') {
                                                                                        if ($producto->setEstado($_POST['estado_producto'])) {
                                                                                            if (is_uploaded_file($_FILES['archivo_producto']['tmp_name'])) {
                                                                                                if ($producto->setImagen($_FILES['archivo_producto'])) {
                                                                                                    if ($producto->updateProductos()) {
                                                                                                        $result['status'] = 1;
                                                                                                        if ($producto->deleteFile($producto->getRuta(), $data['imagen_producto'])) {
                                                                                                            $result['message'] = 'Producto modificado correctamente';
                                                                                                        } else {
                                                                                                            $result['message'] = 'Producto modificado pero no se borro la imagen anterior';
                                                                                                        }
                                                                                                    } else {
                                                                                                        $result['exception'] = Database::getException();
                                                                                                    }
                                                                                                } else {
                                                                                                    $result['exception'] = $producto->getImageError();
                                                                                                }
                                                                                            } else {
                                                                                                if ($producto->updateProductos()) {
                                                                                                    $result['status'] = 1;
                                                                                                    $result['message'] = 'Producto modificado correctamente';
                                                                                                } else {
                                                                                                    $result['exception'] = Database::getException();
                                                                                                }
                                                                                            }
                                                                                        } else {
                                                                                            $result['exception'] = 'El estado es incorrecto';
                                                                                        }
                                                                                    } else {
                                                                                        $result['exception'] = 'El estado elegido es inválido';
                                                                                    }
                                                                                } else {
                                                                                    $result['exception'] = 'Categoria inválida';
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = 'Seleccione una categoria';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = 'Bodega inválida';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Seleccione una bodega';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Stock Minímo mayor a 999,999';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Stock Minímo invalido';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Porcentaje de Alcohol menor a 5.5% o mayor a 20%';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Porcentaje de Alcohol invalido';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Año de cosecha ingresado menor a 1650 o mayor a ' . date("Y");
                                                }
                                            } else {
                                                $result['exception'] = 'Año de cosecha invalido';
                                            }
                                        } else {
                                            $result['exception'] = 'Descripción invalida';
                                        }
                                    } else {
                                        $result['exception'] = 'Precio Compra invalido';
                                    }
                                } else {
                                    $result['exception'] = 'Precio Venta invalido';
                                }
                            } else {
                                $result['exception'] = 'Nombre invalido';
                            }
                        } else {
                            $result['exception'] = 'Codigo invalido';
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            case 'delete':
                if ($producto->setId($_POST['id_producto'])) {
                    if ($data = $producto->readOneProductos()) {
                        if ($producto->deleteProductos()) {
                            $result['status'] = 1;
                            if ($producto->deleteFile($producto->getRuta(), $data['imagen_producto'])) {
                                $result['message'] = 'Producto eliminado correctamente';
                            } else {
                                $result['message'] = 'Producto eliminado pero no se borro la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
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
