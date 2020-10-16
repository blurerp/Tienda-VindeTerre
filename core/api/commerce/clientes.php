<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/clientes.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $cliente = new Clientes;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['id_cliente'])) {
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logout':
                if (isset($_SESSION['id_cliente'])) {
                    unset($_SESSION['id_cliente']);
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
            default:
                exit('Acción no disponible dentro de la sesión');
        }
    } else {
        // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'register':
                $_POST = $cliente->validateForm($_POST);
                // Se sanea el valor del token para evitar datos maliciosos.
                $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
                if ($token) {
                    $secretKey = '6LecoNQZAAAAAKoaH9Up328ptosIhL3LzXGVyhUE';
                    $ip = $_SERVER['REMOTE_ADDR'];

                    $data = array(
                        'secret' => $secretKey,
                        'response' => $token,
                        'remoteip' => $ip
                    );

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                        ),
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false
                        )
                    );

                    $url = 'https://www.google.com/recaptcha/api/siteverify';
                    $context  = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);
                    $captcha = json_decode($response, true);

                    if ($captcha['success']) {
                        if ($cliente->setUsuario_cliente($_POST['usuario_cliente'])) {
                            if ($cliente->setNombre_cliente($_POST['nombre_cliente'])) {
                                if ($cliente->setApellido_cliente($_POST['apellido_cliente'])) {
                                    if ($cliente->setDui_cliente($_POST['dui_cliente'])) {
                                        if ($cliente->setEmail_cliente($_POST['email_cliente'])) {
                                            if ($cliente->setTelefono_cliente($_POST['telefono_cliente'])) {
                                                if ($cliente->setNit_cliente($_POST['nit_cliente'])) {
                                                    if($cliente->setTipo_cliente($_POST['tipo_cliente']))
                                                    if ($_POST['contrasena_cliente'] == $_POST['confirmar_contrasena']) {
                                                        if ($cliente->setContrasena_cliente($_POST['contrasena_cliente'])) {
                                                            if ($cliente->createRow()) {
                                                                $result['status'] = 1;
                                                                $result['message'] = 'Cliente registrado correctamente';
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                                //$result['exception'] = 'Ocurrió un problema al registrar el cliente';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Clave menor a 8 caracteres';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Claves diferentes';
                                                    }
                                                } else {
                                                    $result['exception'] = 'NIT invalido';
                                                }
                                            } else {
                                                $result['exception'] = 'Telefóno invalido';
                                            }
                                        } else {
                                            $result['exception'] = 'Correo Electrónico invalido';
                                        }
                                    } else {
                                        $result['exception'] = 'DUI invalido';
                                    }
                                } else {
                                    $result['exception'] = 'Apellidos invalidos';
                                }
                            } else {
                                $result['exception'] = 'Nombres invalidos';
                            }
                        } else {
                            $result['exception'] = 'Usuario invalido';
                        }
                    } else {
                        $result['exception'] = 'No eres un humano';
                    }
                } else {
                    $result['exception'] = 'Ocurrió un problema al cargar el reCAPTCHA';
                }  
                    
                break;
            case 'login':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->checkUser($_POST['email_cliente'])) {
                    if ($cliente->getEstado_cliente() == 'Activo') {
                        if ($cliente->getDias() < 90) {
                            if ($cliente->checkPassword($_POST['contrasena_cliente'])) {
                                $_SESSION['id_cliente'] = $cliente->getId();
                                $_SESSION['email_cliente'] = $cliente->getEmail_cliente();
                                $result['status'] = 1;
                                $result['message'] = 'Autenticación correcta';
                            } else {
                                $result['exception'] = 'Clave incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Por motivos de seguridad debe actualizar su contraseña';                           
                        }
                    } else {
                        $result['exception'] = 'Su cuenta ha sido desactivada';
                    }
                } else {
                    $result['exception'] = 'Correo electronico invalido';
                }
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
