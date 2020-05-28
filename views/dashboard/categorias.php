<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Categoria');
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
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
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
                        <form class="needs-validation" id="save-form" novalidate>
                            <input id="id_categoria" type="hidden" name="id_producto"/>
                            <div class="form-row m-3">
                                <div class="col-md-8 mb-3">
                                    <label for="nombre_producto">Nombre</label>
                                    <input id="categoria" type="text" class="form-control" name="categoria" required>
                                </div>                               
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-12">
                                    <label>Imagen</label>
                                    <div class="custom-file">
                                        <input id="archivo_categoria" type="file" name="archivo_categoria" accept=".gif, .jpg, .png"/>
                                        <label class="custom-file-label" for="archivo_categoria" data-browse="Elegir">Formatos aceptados: gif, jpg y png</label>
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
        </div>
    </div>
<?php
Dashboard::footerTemplate('categorias.js');
?>