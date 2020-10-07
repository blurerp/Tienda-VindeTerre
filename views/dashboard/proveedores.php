<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('proveedores');
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
                                        <th>Nombre</th>
                                        <th>Email</th>                      
                                        <th>Telefono</th>
                                        <th>Dirección</th>
                                        <th>Link</th>                      
                                        <th>Tipo de Documento</th>
                                        <th>N° Documento</th>
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
                            <input id="id_proveedor" class="invisible" name="id_proveedor"/>
                            <div class="form-row m-3">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_proveedor">Nombre</label>
                                    <input id="nombre_proveedor" type="text" class="form-control" name="nombre_proveedor" required>
                                </div>     
                                <div class="col-md-6 mb-3">
                                    <label for="correo_proveedor">Email</label>
                                    <input id="correo_proveedor" type="text" class="form-control" name="correo_proveedor" required>
                                </div>                           
                            </div>                 
                            <div class="form-row m-3">                                                       
                                <div class="col-md-7 mb-3">
                                    <label for="direccion_proveedor">Dirección</label>
                                    <input id="direccion_proveedor" type="text" class="form-control" name="direccion_proveedor" required>
                                </div>                                   
                                <div class="col-md-5 mb-3">                                
                                    <label for="url_proveedor">Link</label>
                                    <input id="url_proveedor" type="text" class="form-control" name="url_proveedor" maxlength="300" required>
                                </div>  
                            </div>  
                            <div class="form-row m-3">                                                       
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_documento">Tipo de Documento</label>
                                    <input id="tipo_documento" type="text" class="form-control" name="tipo_documento" required>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="numero_documento">N° Documento</label>
                                    <input id="numero_documento" type="text" class="form-control" name="numero_documento" required>
                                </div>  
                                <div class="col-md-3 mb-3">                                
                                    <label for="telefono_proveedor">Telefóno</label>
                                    <input id="telefono_proveedor" type="text" class="form-control" name="telefono_proveedor" required>
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
Dashboard::footerTemplate('proveedores.js');
?>