<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('entradas');
?>
            <div id="content" class="container-fluid p-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" onclick="openCreateModal()" class="btn btn-success mb-3" data-toggle="modal" data-target="#save-modal" id="btn_nuevo">Nueva Entrada</button>
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
                                        <th>Producto</th>
                                        <th>Cantidad ingresada</th>                      
                                        <th>Fecha y Hora</th>
                                        <th>Proveedor</th>
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
                        <form method="post" class="needs-validation" id="save-form" enctype="multipart/form-data" novalidate>
                            <input id="id_entrada" class="invisible" name="id_entrada"/>
                            <div class="form-row m-3">
                                <div class="form-group col-md-3">
                                    <label for="producto">Producto</label>
                                    <select id="producto" class="custom-select form-control" name="producto" required>
                                    </select>
                                    <div class="invalid-feedback">
                                        Debe seleccionar el producto que sera ingresado
                                    </div> 
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="cantidad_ingresar">Cantidad a ingresar</label>
                                    <input id="cantidad_ingresar" type="number" name="cantidad_ingresar" class="form-control" max="1000000" min="1" step="1">
                                </div>      
                                <div class="form-group col-md-3">
                                    <label for="proveedor">Proveedor</label>
                                    <select id="proveedor" class="custom-select form-control" name="proveedor" required>
                                    </select>
                                    <div class="invalid-feedback">
                                        Debe seleccionar el proveedor del producto
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
Dashboard::footerTemplate('entradas.js');
?>