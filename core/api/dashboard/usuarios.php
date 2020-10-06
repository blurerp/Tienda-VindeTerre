<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Usuarios;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logout':
                if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombre_usuario'])) {
                    unset($_SESSION['id_usuario']);
                    unset($_SESSION['nombre_usuario']);
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
            case 'readProfile':
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
                        if ($usuario->setNombres($_POST['nombre_usuario'])) {
                            if ($usuario->setApellidos($_POST['apellido_usuario'])) {
                                if ($usuario->setCorreo($_POST['email_usuario'])) {
                                    if ($usuario->setUsuario($_POST['usuario'])) {
                                        if ($usuario->editProfile()) {
                                            $_SESSION['nombre_usuario'] = $usuario->getUsuario();
                                            $result['status'] = 1;
                                            $result['message'] = 'Perfil modificado correctamente';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'password':
                if ($usuario->setId($_SESSION['id_usuario'])) {
                    $_POST = $usuario->validateForm($_POST);
                    if ($_POST['clave_actual_1'] == $_POST['clave_actual_2']) {
                        if ($usuario->setClave($_POST['clave_actual_1'])) {
                            if ($usuario->checkPassword($_POST['clave_actual_1'])) {
                                if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                    if ($_POST['clave_actual_1'] != $_POST['clave_nueva_1']) {
                                        if ($usuario->setClave($_POST['clave_nueva_1'])) {
                                            if ($usuario->changePassword()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Contraseña cambiada correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave actual y clave nueva no pueden ser iguales';
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Clave actual menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Claves actuales diferentes';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'readAll':
                if ($result['dataset'] = $usuario->readAllUsuarios()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
                break;
            case 'search':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuario->searchUsuarios($_POST['search'])) {
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
            case 'create':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setUsuario($_POST['usuario'])) {
                    if ($_POST['contrasena_usuario'] == $_POST['confirmar_contrasena']) {
                        if ($usuario->setClave($_POST['contrasena_usuario'])) {
                            if ($usuario->setNombres($_POST['nombre_usuario'])) {
                                if ($usuario->setApellidos($_POST['apellido_usuario'])) {
                                    if ($usuario->setFecha($_POST['fecha_nacimiento'])) {
                                        if ($usuario->setDui($_POST['dui_usuario'])) {
                                            if ($usuario->setCorreo($_POST['email_usuario'])) {
                                                if ($_POST['estado_usuario'] == 'Activo' || 'Inactivo') {
                                                    if ($usuario->setEstado($_POST['estado_usuario'])) {
                                                        if (isset($_POST['tipo_usuario'])) {
                                                            if ($usuario->setTipo($_POST['tipo_usuario'])) {
                                                                if ($usuario->createUsuario()) {
                                                                    $result['status'] = 1;
                                                                    $result['message'] = 'Usuario creado correctamente';
                                                                } else {
                                                                    $result['exception'] = Database::getException();
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Tipo de usuario inválido';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Seleccione un tipo de usuario';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'El estado es incorrecto';
                                                    }
                                                } else {
                                                    $result['exception'] = 'El estado elegido es inválido';
                                                }
                                            } else {
                                                $result['exception'] = 'Correo electrónico inválido';
                                            }
                                        } else {
                                            $result['exception'] = 'DUI inválido';
                                        }
                                    } else {
                                        $result['exception'] = 'La fecha de nacimiento es invalida';
                                    }
                                } else {
                                    $result['exception'] = 'Apellidos incorrectos';
                                }
                            } else {
                                $result['exception'] = 'Nombres inválido';
                            }
                        } else {
                            $result['exception'] = 'Clave menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Las Contraseñas no coinciden';
                    }
                } else {
                    $result['exception'] = 'Nombre de usuario invalido';
                }
                break;
            case 'readOne':
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($result['dataset'] = $usuario->readOneUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'update':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($data = $usuario->readOneUsuario()) {
                        if ($usuario->setNombres($_POST['nombre_usuario'])) {
                            if ($usuario->setApellidos($_POST['apellido_usuario'])) {
                                if ($usuario->setFecha($_POST['fecha_nacimiento'])) {
                                    if ($usuario->setDui($_POST['dui_usuario'])) {
                                        if ($usuario->setCorreo($_POST['email_usuario'])) {
                                            if ($_POST['estado_usuario'] == 'Activo' || 'Inactivo') {
                                                if ($usuario->setEstado($_POST['estado_usuario'])) {
                                                    if ($usuario->setTipo($_POST['tipo_usuario'])) {
                                                        if ($usuario->updateUsuario()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Usuario modificado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Tipo de usuario inválido';
                                                    }
                                                } else {
                                                    $result['exception'] = 'El estado es incorrecto';
                                                }
                                            } else {
                                                $result['exception'] = 'El estado elegido es inválido';
                                            }
                                        } else {
                                            $result['exception'] = 'Correo electrónico inválido';
                                        }
                                    } else {
                                        $result['exception'] = 'DUI inválido';
                                    }
                                } else {
                                    $result['exception'] = 'La fecha de nacimiento es invalida';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres inválido';
                        }
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario invalido';
                }
                break;
            case 'delete':
                if ($_POST['id_usuario'] != $_SESSION['id_usuario']) {
                    if ($usuario->setId($_POST['id_usuario'])) {
                        if ($usuario->readOneUsuario()) {
                            if ($usuario->deleteUsuario()) {
                                $result['status'] = 1;
                                $result['message'] = 'Usuario eliminado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;
            default:
                exit('Acción no disponible log');
        }
    } else {
        // Se compara la acción a realizar cuando el administrador no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($usuario->readAllUsuarios()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existe al menos un usuario registrado';
                } else {
                    $result['exception'] = 'No existen usuarios registrados';
                }
                break;
            case 'register':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNombres($_POST['nombre_usuario'])) {
                    if ($usuario->setApellidos($_POST['apellido_usuario'])) {
                        if ($usuario->setCorreo($_POST['email_usuario'])) {
                            if ($usuario->setUsuario($_POST['usuario'])) {
                                if ($usuario->setFecha($_POST['fecha_nacimiento'])) {
                                    if ($usuario->setDui($_POST['dui_usuario'])) {
                                        if ($_POST['contrasenia_usuario'] == $_POST['contrasenia_usuario2']) {
                                            if ($usuario->setClave($_POST['contrasenia_usuario'])) {
                                                if ($usuario->createUsuario()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Usuario registrado correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['exception'] = 'Clave menor a 6 caracteres';
                                            }
                                        } else {
                                            $result['exception'] = 'Claves diferentes';
                                        }
                                    } else {
                                        $result['exception'] = 'DUI incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Fecha incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Usuario incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'login':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->checkAlias($_POST['nombre_usuario'])) {
                    if ($usuario->checkPassword($_POST['clave'])) {
                        $_SESSION['id_usuario'] = $usuario->getId();
                        $_SESSION['nombre_usuario'] = $usuario->getUsuario();
                        $result['status'] = 1;
                        $result['message'] = 'Autenticación correcta';
                    } else {
                        $result['exception'] = 'Clave incorrecta';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            default:
                exit('Acción no disponible  ');
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    exit('Recurso denegado');
}
