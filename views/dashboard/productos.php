<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Iniciar sesión');
?>
        <div id="content" class="container-fluid p-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#save-modal" id="btn_nuevo" style="margin-bottom: 20px;">Nuevo</button>
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

            <div class="modal fade" id="save-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="save-modal">Nuevo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="needs-validation" id="save-form" novalidate>
                            <input id="id_producto" type="hidden" name="id_producto"/>
                            <div class="form-row m-3">
                                <div class="col-md-8 mb-3">
                                    <label for="nombre_producto">Nombre</label>
                                    <input id="nombre_producto" type="text" class="form-control" name="nombre_producto" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="precio_producto">Precio</label>                                   
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                        <span class="input-group-text">0.00</span>
                                        <input id="precio_producto" type="text" name="precio_producto" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-12">
                                    <label>Imagen</label>
                                    <div class="custom-file">
                                        <input id="archivo_producto" type="file" name="archivo_producto" class="custom-file-input" lang="es" accept=".gif, .jpg, .png">
                                        <label class="custom-file-label" for="archivo_producto" data-browse="Elegir">Formatos aceptados: gif, jpg y png</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-3">
                                    <label for="stock_producto">Stock</label>
                                    <input id="stock_producto" type="text" class="form-control" name="stock_producto" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="bodega">Bodega</label>
                                    <select class="custom-select" id="bodega" name="bodega" required>
                                        <option selected disabled value="">Seleccionar...</option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Debe seleccionar almenos 1 bodega
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="categoria_producto">Categoria</label>
                                    <select class="custom-select" id="categoria_producto" name="categoria_producto" required>
                                        <option selected disabled value="">Seleccionar...</option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Debe seleccionar almenos 1 Categoria
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label for="estado_producto">Estado</label>
                                    <select class="custom-select" id="estado_producto" name="estado_producto" required>
                                        <option selected disabled value="">Seleccionar...</option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Debe seleccionar almenos 1 estado
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
Dashboard::footerTemplate('productos.js');
?>