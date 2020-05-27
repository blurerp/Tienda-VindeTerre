<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Iniciar sesión');
?>
    <div id="background"></div>
    <div id="container">
        <div class="box">
            <div class="container inner">
                <div class="row">
                    <div class="col">
                        <div id="logo">
                            <img src="../../resources/img/logo.png">
                        </div>
                        <h3 class="text-center">Iniciar Sesión</h3>
                        <form class="needs-validation" id="sesion-form" novalidate>
                            <div class="input-group input-focus mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white"><i class="far fa-user-alt"></i></span>
                                </div>
                                <input type="text" placeholder="Usuario" class="form-control border-left-0" required>
                            </div>
                            <div class="input-group input-focus mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white"><i class="far fa-key"></i></span>
                                </div>
                                <input type="password" placeholder="Contraseña" class="form-control border-left-0" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary col-12 text-white" style="margin-bottom: 20px;">Ingresar</button></a>
                                </div>
                            </div>  
                        </form>                                                  
                    </div>
                </div>                   
            </div>
        </div>
    </div>
<?php
Dashboard::footerTemplate('index.js');
?>