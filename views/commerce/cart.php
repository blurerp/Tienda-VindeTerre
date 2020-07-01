<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Carrito de compra');
?>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-name">Producto</th>
                                <th class="product-price">Precio</th>
                                <th class="product-quantity">Cantidad</th>
                                <th class="product-total">Total</th>
                                <th class="product-update">Cambiar Cantidad</th>
                                <th class="product-remove">Remover</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-rows">
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <a href="index.php" class="btn btn-outline-primary btn-sm btn-block">Seguir comprando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Total a Pagar (US $)</h3>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black" id="pago"></strong>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-lg py-3 btn-block" onclick="finishOrder()">Proceder a Pagar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="item-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Cantidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="item-form" enctype="multipart/form-data">
                <input id="id_det_pedido" class="invisible" name="id_det_pedido" />
                <p class="font-weight-bold ml-3">Cantidad</p>
                <div class="input-group">
                    <div class="row">
                        <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="cantidad_detalle">
                            <i class="far fa-minus-square"></i>
                        </button>
                        <div class="col-md-4">
                            <input type="text" name="cantidad_detalle" id="cantidad_detalle " class="form-control input-number" value="1" min="1" max="1000">
                        </div>
                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="cantidad_detalle">
                            <i class="far fa-plus-square"></i>
                        </button>
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
Commerce::footerTemplate('cart.js');
?>