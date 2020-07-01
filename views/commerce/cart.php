<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Carrito de compra');
?>
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Imagen</th>
                                <th class="product-name">Producto</th>
                                <th class="product-price">Precio</th>
                                <th class="product-quantity">Cantidad</th>
                                <th class="product-total">Total</th>
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
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
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

                        <div class="row">
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

<?php
Commerce::footerTemplate('index.js');
?>