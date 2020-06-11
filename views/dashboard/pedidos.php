<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('pedidos');
?>
            <div id="content" class="container-fluid p-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tabla" class="table table-striped table-bordered table-condensed" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nombre Cliente</th>
                                        <th>Apellidos Cliente</th>
                                        <th>N° Orden</th>
                                        <th>Monto</th>                                                              
                                        <th>Estado</th>
                                        <th>Fecha creación</th>
                                        <th>Fecha entrega</th>
                                        <th>Dirección</th>                                                              
                                        <th>Codigo Postal</th>
                                        <th>N° de Casa o Domicilio</th>
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
                        <table id="subtabla" class="table table-striped table-bordered table-condensed" style="margin: 20px 0;" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>                                        
                                        <th>N° Orden</th>
                                        <th>Producto</th>                                                              
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-rows2">
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
<?php
Dashboard::footerTemplate('pedidos.js');
?>