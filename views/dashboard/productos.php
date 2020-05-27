<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Iniciar sesión');
?>
        <div id="content" class="container-fluid p-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <button id="btn_nuevo" type="button" class="btn btn-success">Nuevo</button>
                    </div>
                </div>     
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tabla_productos" class="table table-striped table-bordered table-condensed" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Bodega</th>
                                        <th>Categoria</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary btn_editar">Editar</button>
                                                    <button class="btn btn-danger btn_eliminar">Eliminar</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>     
            </div>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_crud">
                Launch static backdrop modal
            </button>
            <div class="modal fade" id="modal_crud" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal_crud">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="needs-validation" id="form_productos" novalidate>
                            <div class="form-row m-3">
                                <div class="col-md-8 mb-3">
                                    <label for="validationDefault01">Nombre</label>
                                    <input type="text" class="form-control" id="validationDefault01" required>
                                </div>
                                <div class="col-md-4 my-4">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
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
        </div>
    </div>
<?php
Dashboard::footerTemplate('index.js');
?>