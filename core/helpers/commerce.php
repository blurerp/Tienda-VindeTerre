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
            <title>Dashboard · '.$title.'</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link type="text/css" rel="stylesheet" href="../../resources/css/bootstrap.min.css">
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
                    <header>
                    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <a class="navbar-brand" href="index.php">
                        <img src="../../resources/img/logo.png" height="50" alt="vindeterre logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Vinos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">Acerca de Nosotros</a>
                        </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <div class="searchbar">
                            <input class="search_input" type="text" name="buscar" id="buscar" placeholder="Buscar...">
                            <a href="search.php" class="search_icon"><i class="fas fa-search"></i></a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><span><i class="far fa-shopping-cart"></i></span></a>
                        </li>
                        <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Mi cuenta</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="pedidos.php" class="dropdown-item">Mis pedidos</a>
                                <a href="#" class="dropdown-item">Editar perfil</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" onclick="logOut()" class="dropdown-item">Cerrar sesión</a>
                            </div>
                        </li>
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
                    <header>
                    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <a class="navbar-brand" href="index.php">
                        <img src="../../resources/img/logo.png" height="50" alt="vindeterre logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Vinos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">Acerca de Nosotros</a>
                        </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <div class="searchbar">
                            <input class="search_input" type="text" name="buscar" id="buscar" placeholder="Buscar...">
                            <a href="search.php" class="search_icon"><i class="fas fa-search"></i></a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signin.php">Crear cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Iniciar sesión</a>
                        </li>          
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
            <script type="text/javascript" src="../../resources/js/popper.min.js"></script>
            <script type="text/javascript" src="../../resources/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../../core/helpers/components.js"></script>
            <script type="text/javascript" src="../../core/controllers/commerce/account.js"></script>
            <script type="text/javascript" src="../../core/controllers/commerce/'.$controller.'"></script>
            </body>            
            </html>
        ');
    }
}
?> 