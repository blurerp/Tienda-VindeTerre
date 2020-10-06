<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Usuarios');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar Cuenta</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">                    
                    <div class="row">
                        <div class="col-md-6">                            
                            <form method="post"  enctype="multipart/form-data" id="profile-form">
                                <input id="id_usuario" type="text" class="d-none" name="id_usuario">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Usuario: </label>
                                    <input id="usuario" type="text" class="form-control is-warning" name="usuario" placeholder="Nombre" >
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Nombre: </label>
                                    <input id="nombre_usuario" type="text" class="form-control is-warning" name="nombre_usuario" placeholder="Nombre" >
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Apellido: </label>
                                    <input id="apellido_usuario" type="text" class="form-control is-warning" name="apellido_usuario" placeholder="Nombre">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Fecha Nacimiento: </label>
                                    <input id="fecha_nacimiento" type="date" class="form-control is-warning" name="fecha_nacimiento" placeholder="Email" readonly=»readonly»>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> DUI:</label>
                                    <input name="dui_usuario" id="dui_usuario" type="text" minlength="10" maxlength="10" class="form-control" placeholder="DUI - Formato: 1234567-9 *" value=""readonly=»readonly» />
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Correo electrónico: </label>
                                    <input id="email_usuario" type="email" class="form-control is-warning" name="email_usuario" placeholder="Email">
                                </div>

                                

                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Guardar cambios</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.col (LEFT) -->
                        <div class="col-md-6">
                            <form action="post" id="password-form">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Contraseña actual: </label>
                                    <input id="clave_actual_1" type="password" class="form-control is-warning" name="clave_actual_1" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i>Confirmar contraseña actual: </label>
                                    <input id="clave_actual_2" type="password" class="form-control is-warning" name="clave_actual_2" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Contraseña nueva: </label>
                                    <input id="clave_nueva_1" type="password" class="form-control is-warning" name="clave_nueva_1" placeholder="Contraseña">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning"><i class="far fa-user"></i> Confirmar contraseña nueva: </label>
                                    <input id="clave_nueva_2" type="password" class="form-control is-warning" name="clave_nueva_2" placeholder="Confirma contraseña">
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Actualizar contraseña</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.col (RIGHT) -->
                    </div>

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <?php
        Dashboard::footerTemplate('asd.js');
        ?>