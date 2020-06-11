<?php 

    class Dashboard
    {   
        public static function headerTemplate($title)
        {
            print('  
                <!doctype html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <title>Dashboard · '.$title.'</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/bootstrap.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/datatables.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/dataTables.bootstrap4.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/all.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/dashboard.css"/>
                    <link type="image/png" rel="icon" href="../../resources/img/logo.png"/>
                </head>
                <body>                 
                <div id="content-wrapper" class="d-flex">
                    <div id="sidebar-container" class="bg-light border-right">
                        <div class="logo">
                            <h4 class="font-weight-bold mb-0">Menu</h4>
                        </div>
                        <div class="menu list-group-flush">
                            <a href="main.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-home p-2 border-0"></i> Tablero</a>
                            <a href="pedidos.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-box-check p-2 border-0"></i> Pedidos</a>                            
                            <button class="dropdown-btn list-group-item list-group-item-action p-3 border=0" style="outline: none;">Inventario 
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-container">
                                <a href="productos.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-cubes p-2 border-0"></i> Productos</a>
                                <a href="bodegas.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-warehouse-alt p-2 border-0"></i> Bodegas</a>
                                <a href="categorias.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="fa fa-elementor p-2 border-0"></i> Categorias</a>                                
                            </div>
                            <a href="usuarios.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-users p-2 border-0"></i> Usuarios</a>
                            <a href="clientes.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-user-friends p-2 border-0"></i> Clientes</a>
                            <a href="entradas.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-shopping-bag p-2 border-0"></i> Entradas</a>                            
                            <a href="proveedores.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="fas fa-exchange p-2 border-0"></i> Proveedores</a>
                            <a href="reclamos.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-exclamation-square p-2 border-0"></i> Reclamos</a>
                            <a href="bitacora.php" class="list-group-item list-group-item-action bg-light p-3 border=0"><i class="far fa-clipboard-list p-2 border-0"></i> Bitacora</a>
                        </div>
                    </div>
            
                    <div id="page-container" class="w-100 bg-light-blue">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                            <div class="container">
                                <button id="menu-toggle" class="btn text-primary" style="background-color: rgba(0, 123, 255, .1) !important; border: 0;">Abrir / cerrar menu</button>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                            
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto">            
                                        <li class="nav-item">
                                            <a class="nav-link" href="main.php">Inicio</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USUARIO</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Mi perfil</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" onclick="signOff()">Cerrar sesión</a>
                                        </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>  
                        </nav>                                 
            ');
            
            $filename = basename($_SERVER['PHP_SELF']); 

            if ($filename != 'main.php') {
                print('                
                    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                        <div class="container">
                            <ul class="navbar-nav mr-auto">            
                                <li class="nav-item">
                                    <a class="nav-link" href="main.php"><h5>Dashboard</h5></a>
                                </li>
                                <li class="nav-item">
                                    <h5 class="mt-2"> / </h5>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="'.$title.'.php"><h5>'.ucwords($title).'</h5></a>
                                </li>
                            </ul>
                        </div>  
                    </nav> 
                ');
            } else {
                print('
                    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                        <div class="container">
                            <ul class="navbar-nav mr-auto">            
                                <li class="nav-item">
                                    <a class="nav-link" href="main.php"><h5>Dashboard</h5></a>
                                </li>
                            </ul>
                        </div>  
                    </nav>
                ');
            }
            /*      
            if (isset($_SESSION['id_usuario'])) {           
                if ($filename != 'index.php') {
                    print('
                        
                    ');
                } else {
                    header('location: main.php');
                }
            } else {          
                if ($filename != 'index.php') {
                    header('location: index.php');
                } else {               
                    print('
                        <header>
                            <a href="index.php">dashboard</a>
                        </header>
                    ');
                }
            }
            */
        }

        public static function headerLogin($title)
        {
            print('  
                <!doctype html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <title>Dashboard · '.$title.'</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/bootstrap.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/datatables.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/dataTables.bootstrap4.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/all.min.css">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/dashboard.css"/>
                    <link type="image/png" rel="icon" href="../../resources/img/logo.png"/>
                </head>
                <body>                                               
            ');

        public static function footerTemplate($controller)
        {
            print('
                <script type="text/javascript" src="../../resources/js/jquery-3.5.1.min.js"></script>
                <script type="text/javascript" src="../../resources/js/popper.min.js"></script>
                <script type="text/javascript" src="../../resources/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../resources/js/datatables.min.js"></script>
                <script type="text/javascript" src="../../core/helpers/components.js"></script>
                <script type="text/javascript" src="../../core/controllers/dashboard/account.js"></script>                
                <script type="text/javascript" src="../../core/controllers/dashboard/'.$controller.'"></script>
            </body>
            </html>
            ');
        }
    } 
?>