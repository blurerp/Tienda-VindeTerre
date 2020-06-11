<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('clientes');
?>
            <div id="content" class="container-fluid p-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tabla" class="table table-striped table-bordered table-condensed" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>                                                              
                                        <th>Usuario</th>
                                        <th>Imagen</th>
                                        <th>DUI</th>
                                        <th>Email</th>                                                              
                                        <th>Telefóno</th>
                                        <th>NIT</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
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
<?php
Dashboard::footerTemplate('clientes.js');
?>