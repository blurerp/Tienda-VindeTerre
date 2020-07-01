<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Vin de Terre - Chekout');
?>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="border p-4 rounded" role="alert">¿Soy cliente? <a href="login.php">Haga click aqui</a> para ingresar
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Detalles de facturación</h2>
                <div class="p-3 p-lg-5 border">
                    <div class="form-group">

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_fname" class="text-black">Nombres <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_fname" name="c_fname">
                        </div>
                        <div class="col-md-6">
                            <label for="c_lname" class="text-black">Apellidos<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_lname" name="c_lname">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_companyname" class="text-black">Nombre de la compañia</label>
                            <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_address" class="text-black">Direccion <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_state_country" class="text-black">Departamento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                        </div>
                        <div class="col-md-6">
                            <label for="c_postal_zip" class="text-black">Codigo Postal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                        </div>
                    </div>

                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="c_email_address" class="text-black">Correo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_email_address" name="c_email_address">
                        </div>
                        <div class="col-md-6">
                            <label for="c_phone" class="text-black">Telefono<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="c_order_notes" class="text-black">Notas del pedido</label>
                        <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                    </div>

                </div>
            </div>
            <div class="col-md-6">

                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                        <div class="p-3 p-lg-5 border">

                            <label for="c_code" class="text-black mb-3">Ingresa tu codigo de cupon si tienes uno.</label>
                            <div class="input-group w-75">
                                <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Aplicar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Tu pedido</h2>
                        <div class="p-3 p-lg-5 border">
                            <table class="table site-block-order-table mb-5">
                                <thead>
                                    <th>Producto</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Casillero del diablo <strong class="mx-2">x</strong> 1</td>
                                        <td>$250.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jagermeister<strong class="mx-2">x</strong> 1</td>
                                        <td>$100.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Subtotal del carrito</strong></td>
                                        <td class="text-black">$350.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Total del pedido</strong></td>
                                        <td class="text-black font-weight-bold"><strong>$350.00</strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Transferencia bancaria directa</a></h3>

                                <div class="collapse" id="collapsebank">
                                    <div class="py-2">
                                        <p class="mb-0">Realice su pago directamente en nuestra cuenta bancaria. Utilice su ID de pedido como referencia de pago. Su pedido no se enviará hasta que los fondos se hayan liquidado en nuestra cuenta.</p>
                                    </div>
                                </div>
                            </div>                           

                            <div class="form-group">
                                <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.php'">Realizar pedido</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- </form> -->
    </div>
</div>


<?php
Commerce::footerTemplate('index.js');
?>