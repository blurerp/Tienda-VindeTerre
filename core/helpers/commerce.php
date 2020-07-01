<?php
/*
*   Clase para definir las plantillas de las páginas web del sitio público.
*/
class Commerce
{
    /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        session_start();
        // Se imprime el código HTML para el encabezado del documento.
        print('
            <!doctype html>
            <html lang="es">  
            <head>
            <meta charset="utf-8">
            <title>'.$title.'</title>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="../../resources/fonts/icomoon/style.css">        

            <link type="text/css" rel="stylesheet" href="../../resources/css/bootstrap.min.css">
            <link rel="stylesheet" href="../../resources/css/magnific-popup.css">
            <link rel="stylesheet" href="../../resources/css/jquery-ui.css">
            <link rel="stylesheet" href="../../resources/css/owl.carousel.min.css">
            <link rel="stylesheet" href="../../resources/css/owl.theme.default.min.css">
            <link rel="stylesheet" href="../../resources/css/aos.css">
            <link rel="stylesheet" href="../../resources/css/style.css?v=<?php echo(rand()); ?>">
            <link type="text/css" rel="stylesheet" href="../../resources/css/all.min.css">
            <link type="text/css" rel="stylesheet" href="../../resources/css/commerce.css" />             
            <link type="image/png" rel="icon" href="../../resources/img/logo.png" />             
            </head>
            <body class="d-flex flex-column">
        ');
        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de cliente para mostrar el menú de opciones, de lo contrario se muestra otro menú.
        if (isset($_SESSION['id_cliente'])) {
            // Se verifica si la página web actual es diferente a login.php y register.php, de lo contrario se direcciona a index.php
            if ($filename != 'login.php' && $filename != 'signin.php') {
                print('            
                <div class="site-wrap">
                    <header class="site-navbar" role="banner">
                        <div class="site-navbar-top">
                            <div class="container">
                                <div class="row align-items-center">
            
                                    <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                                        <form action="" class="site-block-top-search">
                                            <span class="icon icon-search2"></span>
                                            <input type="text" class="form-control border-0" placeholder="Buscar...">
                                        </form>
                                    </div>
            
                                    <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                                        <div class="site-logo">
                                            <a href="index.php" class="js-logo-clone">Vin De Terre</a>
                                        </div>
                                    </div>
            
            
                                    <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                                        <div class="site-top-icons">
                                            <ul>
                                                <li>
                                                    <div class="site-navigation text-right text-md-center" role="navigation">
                            
                                                        <ul class="site-menu js-clone-nav d-none d-md-block">
                                                            
                                                            <li class="has-children">
                                                                <a href="about.php"><span class="icon icon-person"></a>
                                                                <ul class="dropdown">
                                                                    <li><a href="login.php">Tu cuenta</a></li>
                                                                    
                                                                    <li><a href="signin.php">Cerrar Sesión</a></li>                                                                    
                                                                </ul>
                                                            </li>                                    
                                                        </ul>                            
                                                </div>
                                                </li>
                                                
                                                <li>
                                                    <a href="cart.php" class="site-cart">
                                                        <span class="icon icon-shopping_cart"></span>
                                                        <span class="count">+9</span>
                                                    </a>
                                                </li>
                                                <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                                        class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <div class="container">
                                <ul class="site-menu js-clone-nav d-none d-md-block">
                                    <li class="has-children active">
                                        <a href="index.html">Inicio</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Menu One</a></li>
                                            <li><a href="#">Menu Two</a></li>
                                            <li><a href="#">Menu Three</a></li>
                                            <li class="has-children">
                                                <a href="#">Sub Menu</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">Menu One</a></li>
                                                    <li><a href="#">Menu Two</a></li>
                                                    <li><a href="#">Menu Three</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="about.php">Sobre Nosotros</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Menu One</a></li>
                                            <li><a href="#">Menu Two</a></li>
                                            <li><a href="#">Menu Three</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop.html">Vinos</a></li>
            
                                    <li><a href="contact.html">Contacto</a></li>
                                </ul>
                            </div>
                        </nav>
                    </header>
                    <main class="container-fluid flex-fill">
                ');
            } else {
                header('location: index.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'cart.php') {
                print('
                <div class="site-wrap">
                    <header class="site-navbar" role="banner">
                        <div class="site-navbar-top">
                            <div class="container">
                                <div class="row align-items-center">
            
                                    <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                                        <form action="" class="site-block-top-search">
                                            <span class="icon icon-search2"></span>
                                            <input type="text" class="form-control border-0" placeholder="Buscar...">
                                        </form>
                                    </div>
            
                                    <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                                        <div class="site-logo">
                                            <a href="index.php" class="js-logo-clone">Vin De Terre</a>
                                        </div>
                                    </div>
            
            
                                    <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                                        <div class="site-top-icons">
                                            <ul>
                                                <li>
                                                    <div class="site-navigation text-right text-md-center" role="navigation">
                            
                                                        <ul class="site-menu js-clone-nav d-none d-md-block">
                                                            
                                                            <li class="has-children">
                                                                <a href="#"><span class="icon icon-person"></a>
                                                                <ul class="dropdown">
                                                                    <li><a href="login.php">Iniciar sesión</a></li>
                                                                    <li><a href="signin.php">Crear Cuenta</a></li>                                                                    
                                                                </ul>
                                                            </li>                                    
                                                        </ul>                            
                                                </div>
                                                </li>
                                                
                                                <li>
                                                    <a href="cart.php" class="site-cart">
                                                        <span class="icon icon-shopping_cart"></span>
                                                        <span class="count">+9</span>
                                                    </a>
                                                </li>
                                                <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                                        class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <div class="container">
                                <ul class="site-menu js-clone-nav d-none d-md-block">
                                    <li class="has-children active">
                                        <a href="index.html">Inicio</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Menu One</a></li>
                                            <li><a href="#">Menu Two</a></li>
                                            <li><a href="#">Menu Three</a></li>
                                            <li class="has-children">
                                                <a href="#">Sub Menu</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">Menu One</a></li>
                                                    <li><a href="#">Menu Two</a></li>
                                                    <li><a href="#">Menu Three</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="about.php">Sobre Nosotros</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Menu One</a></li>
                                            <li><a href="#">Menu Two</a></li>
                                            <li><a href="#">Menu Three</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop.html">Vinos</a></li>
            
                                    <li><a href="contact.html">Contacto</a></li>
                                </ul>
                            </div>
                        </nav>
                    </header>
                    <main class="container-fluid flex-fill">
                ');
            } else {
                header('location: login.php');
            }
        }
    }

    /*
    *   Método para imprimir la plantilla del pie.
    *
    *   Parámetros: $controller (nombre del archivo que sirve como controlador de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function footerTemplate($controller)
    {
        // Se imprime el código HTML para el pie del documento.
        print('
            </main>
            <footer>
            <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                <h3>Mapa del sitio</h3>
                <ul class="list-unstyled  two-column">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php">Productos</a></li>
                    <li><a href="categorias.php">Categorias</a></li>
                    <li><a href="aboutus.php">Acerca de Nosotros</a></li>
                </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                <h3>Información</h3>
                <dl class="row">
                    <dt class="col-sm-3">Dirección</dt>
                </dl>
                <dl class="row">
                    <dd class="col-sm-9">Calle la Mascota, #102, San Salvador, San Salvador, El Salvador</dd>
                </dl>
                <dl class="row">
                    <dt class="col-sm-3">Telefóno</dt>
                </dl>
                <dl class="row">
                    <dd class="col-sm-9">+503 7732-3184</dd>
                </dl>
                <dl class="row">
                    <dt class="col-sm-3">Correo Electrónico</dt>
                </dl>
                <dl class="row">
                    <dd class="col-sm-9">rodrigo-pineda@hotmail.com</dd>
                </dl>
                </div>
                <div class="col-lg-4">
                <h3>Redes Sociales</h3>
                <ul class="list-unstyled socila-list">
                    <li><i class="fab fa-facebook" style="font-size: 48px;"></i></li>
                    <li><i class="fab fa-twitter" style="font-size: 48px;"></i></li>
                    <li><i class="fab fa-discord" style="font-size: 48px;"></i></li>
                </ul>
                </div>
            </div>
            </div>
            <div class="copyright text-center">
            Derechos Resevados &copy; 2020 <span>Vin de Terre</span>
            </div>
            </footer>
            <script type="text/javascript" src="../../resources/js/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="../../resources/js/jquery-ui.js"></script>
            <script type="text/javascript" src="../../resources/js/popper.min.js"></script>
            <script type="text/javascript" src="../../resources/js/bootstrap.min.js"></script>            
            <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                
            <script type="text/javascript" src="../../core/controllers/commerce/account.js"></script>
            <script type="text/javascript" src="../../resources/js/owl.carousel.min.js"></script>
            <script type="text/javascript" src="../../resources/js/jquery.magnific-popup.min.js"></script>            
            <script type="text/javascript" src="../../resources/js/aos.js"></script>
            <script type="text/javascript" src="../../core/controllers/commerce/'.$controller.'"></script>
            <script type="text/javascript" src="../../resources/js/main.js"></script>
            </body>            
            </html>
        ');
    }
}
?>