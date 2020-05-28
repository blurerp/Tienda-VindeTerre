
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/css/styles.css">

</head>

<body>
    <div class="container-fluid register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
                <h3>Bienvenido</h3>
                <p>No hay un usuario registrado, procede ingresando tus datos ;)</p>

            </div>
            <div class="col-md-9 register-right">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Registrarse</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Usuario *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nombres *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apellidos *" value="" />
                                </div>
                                <div class="form-group">
                                    <span class="small text-secondary">Fecha de nacimiento</span>
                                    <input type="date" class="form-control" placeholder="Fecha de nacimiento *"
                                        value="" />
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Correo *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" minlength="8" maxlength="8" name="txtEmpPhone"
                                        class="form-control" placeholder="Telefono *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" minlength="10" maxlength="10" name="txtEmpPhone"
                                        class="form-control" placeholder="DUI - Formato: 1234567-9 *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Contraseña *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Comfirmar contraseña *"
                                        value="" />
                                </div>

                                

                                <input type="submit" class="btnRegister" value="Registrarse" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript" src="../../resources/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../../resources/js/popper.min.js"></script>
    <script type="text/javascript" src="../../resources/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../resources/js/datatables.min.js"></script>
    <script type="text/javascript" src="../../core/helpers/components.js"></script>
</body>

</html>
