<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('productos');
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

                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th>Descripción</th>
                                        <th>Precio Venta</th>
                                        <th>Precio Compra</th>
                                        <th>Stock Activo</th>
                                        <th>Stock Minímo</th>
                                        <th>Cosecha</th>
                                        <th>Alcohol %</th>
                                        <th>Bodega</th>
                                        <th>Categoria</th>
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
                            <input id="id_producto" class="invisible" name="id_producto"/>
                                <div class="form-row m-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="codigo_producto">Codigo producto</label>
                                        <input id="codigo_producto" type="text" class="form-control" name="codigo_producto" required>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="nombre_producto">Nombre</label>
                                        <input id="nombre_producto" type="text" class="form-control" name="nombre_producto" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="precio_venta">Precio Venta</label>                                   
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                            <span class="input-group-text">0.00</span>
                                            <input id="precio_venta" type="number" name="precio_venta" class="form-control" max="999.99" min="0.01" step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row m-3">
                                    <div class="col-md-8 mb-3">
                                        <label>Imagen</label>
                                        <div class="custom-file">
                                            <input id="archivo_producto" type="file" name="archivo_producto" accept=".gif, .jpg, .png">
                                            <label class="custom-file-label" for="archivo_producto" data-browse="Elegir">Formatos aceptados: gif, jpg y png</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="precio_compra">Precio Compra</label>                                   
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                            <span class="input-group-text">0.00</span>
                                            <input id="precio_compra" type="number" name="precio_compra" class="form-control" max="999.99" min="0.01" step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row m-3">
                                    <div class="col-md-7 mb-3">
                                        <label for="descripcion_producto">Descripción</label>
                                        <input id="descripcion_producto" type="text" class="form-control" name="descripcion_producto" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="cosecha">Cosecha</label>
                                        <input id="cosecha" type="number" class="form-control" name="cosecha" min="1650" step="any" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="alcohol">Alcohol</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="porcentaje">%</span>
                                            </div>
                                            <input id="alcohol" type="number" class="form-control" name="alcohol" max="20" min="5.5" step="0.01" aria-describedby="porcentaje" required>                                        
                                            <div class="invalid-feedback">
                                                Porcentaje vació
                                            </div>
                                        </div>
                                    </div>
                                </div>                       
                                <div class="form-row m-3">
                                    <div class="col-md-3 mb-3">
                                        <label for="stock_minimo">Stock Minímo</label>
                                        <input id="stock_minimo" type="number" class="form-control" name="stock_minimo" max="999999" min="1" step="any" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bodega">Bodega</label>
                                        <select id="bodega" class="custom-select form-control" name="bodega" required>
                                        </select>
                                        <div class="invalid-feedback">
                                            Debe seleccionar almenos 1 Bodega
                                        </div> 
                                    </div>   
                                    <div class="form-group col-md-3">
                                        <label for="categoria">Categoria</label>
                                        <select id="categoria" class="custom-select form-control" name="categoria" required>
                                        </select>
                                        <div class="invalid-feedback">
                                            Debe seleccionar almenos 1 Categoria
                                        </div> 
                                    </div>   
                                    <div class="form-group col-md-3">
                                        <label for="estado_producto">Estado</label>
                                        <select id="estado_producto" class="custom-select form-control" name="estado_producto" required>
                                            <option selected disabled value="">Seleccionar...</option>
                                            <option value="Agotado">Agotado</option>
                                            <option value="En_existencia">En existencia</option>
                                            <option value="Inactivo">Inactivo</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Debe seleccionar almenos 1 Estado
                                        </div> 
                                    </div>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" id="btn_guardar" class="btn btn-dark">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
Dashboard::footerTemplate('productos.js');
?>