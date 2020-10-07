<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('bodegas');
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
                                        <th>Dirección</th>
                                        <th>Capacidad</th>                                                              
                                        <th>Telefono</th>
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
                            <input id="id_bodega" class="invisible" name="id_bodega"/>
                            <div class="form-row m-3">
                                <div class="col-md-12 mb-3">
                                    <label for="direccion_bodega">Direccion</label>
                                    <input id="direccion_bodega" type="text" class="form-control" name="direccion_bodega" required>
                                </div>                               
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-4 mb-3">
                                    <label for="capacidad">Capacidad</label>
                                    <input id="capacidad" type="number" class="form-control" name="capacidad" max="999999" min="1" step="any" required>
                                </div>                               
                                <div class="col-md-4 mb-3">
                                    <label for="telefono_bodega">Telefóno</label>
                                    <input id="telefono_bodega" type="tel" class="form-control" name="telefono_bodega" placeholder="1234-5678" pattern="[0-9]{4}.[0-9]{4}" required>
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
Dashboard::footerTemplate('bodegas.js');
?>