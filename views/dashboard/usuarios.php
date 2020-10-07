<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('usuarios');
?>
            <div id="content" class="container-fluid p-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" onclick="openCreateModal()" class="btn btn-success mb-3" data-toggle="modal" data-target="#save-modal" id="btn_nuevo">Nuevo</button>
                    </div>
                </div>     
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tabla" class="table table-striped table-bordered table-condensed" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Nombre</th>                      
                                        <th>Apellidos</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>DUI</th>
                                        <th>Email</th>                                        
                                        <th>Estado</th>
                                        <th>Tipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-rows">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="modal fade" id="save-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="save-modal" style="color: white !important"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" class="needs-validation" id="save-form" enctype="multipart/form-data" autocomplete="off" novalidate>
                            <input id="id_usuario" class="invisible" name="id_usuario"/>
                            <div class="form-row m-3">
                                <div class="col-md-4 mb-3">
                                    <label for="usuario">Usuario</label>
                                    <input id="usuario" type="text" class="form-control" name="usuario" required>
                                </div> 
                                <div class="col-md-4 mb-3">
                                    <label for="contrasena_usuario">Contraseña</label>
                                    <input id="contrasena_usuario" type="password" class="form-control" name="contrasena_usuario" required>
                                </div>      
                                <div class="col-md-4 mb-3">
                                    <label for="confirmar_contrasena">Confirmar contraseña</label>
                                    <input id="confirmar_contrasena" type="password" class="form-control" name="confirmar_contrasena" required>
                                </div>                              
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-3 mb-3">
                                    <label for="nombre_usuario">Nombre</label>
                                    <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" required>
                                </div>      
                                <div class="col-md-3 mb-3">
                                    <label for="apellido_usuario">Apellidos</label>
                                    <input id="apellido_usuario" type="text" class="form-control" name="apellido_usuario" required>
                                </div>                              
                                <div class="col-md-3 mb-3">
                                    <label for="dui_usuario">DUI</label>
                                    <input id="dui_usuario" type="text" class="form-control" name="dui_usuario" required>
                                </div>              
                                <div class="col-md-3 mb-3">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" required>
                                </div>                                                               
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-6 mb-3">
                                    <label for="email_usuario">Email</label>
                                    <input id="email_usuario" type="text" class="form-control" name="email_usuario"required>
                                </div>              
                                <div class="form-group col-md-3">
                                    <label for="tipo_usuario">Tipo Usuario</label>
                                    <select id="tipo_usuario" class="custom-select form-control" name="tipo_usuario" required>
                                    </select>
                                    <div class="invalid-feedback">
                                        Debe seleccionar almenos 1 Tipo de Usuario
                                    </div> 
                                </div>       
                                <div class="form-group col-md-3">
                                    <label for="estado_usuario">Estado</label>
                                    <select id="estado_usuario" class="custom-select form-control" name="estado_usuario" required>
                                        <option selected disabled value="">Seleccionar...</option>
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Debe seleccionar almenos 1 Estado
                                    </div>
                                </div>                                                                                                                                    
                            </div>                              
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                <button type="submit" id="btn_guardar" class="btn btn-dark">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php
Dashboard::footerTemplate('usuarios.js');
?>