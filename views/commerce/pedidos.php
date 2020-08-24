<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Vin de Terre');
?>


<section class="confirmation_part section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="confirmation_tittle">
                    <span>Thank you. Your order has been received.</span>
                </div>
            </div>
            <div class="col-lg-6 col-lx-4">
                <div class="single_confirmation_details">
                    <h4>Informacion del pedido</h4>
                    <ul class="list-group" >
                        <li class="list-group-item">
                            <p>Numero de orden</p><span>: 60235</span>
                        </li>
                        <li class="list-group-item">
                            <p>Estado de pedido</p><span>: Procesado</span>
                        </li>
                        <li class="list-group-item">
                            <p>Fecha de pedido</p><span>: 2020-04-15 23:25:50</span>
                        </li>
                        <li class="list-group-item">
                            <p>Fecha estimada de entrega</p><span>: 2020-04-15 23:55:59</span>
                        </li>
                        <li class="list-group-item">
                            <p>total</p><span>: USD 2210</span>
                        </li>                        
                        <li class="list-group-item">
                            <p>Metodo de pago</p><span>: Efectivo</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-lx-4">
                <div class="single_confirmation_details">
                    <h4>Direccion de envio</h4>
                    <ul class="list-group">
                        <li>
                            <p>Street</p><span>: 56/8</span>
                        </li>
                        <li>
                            <p>city</p><span>: Los Angeles</span>
                        </li>
                        <li>
                            <p>country</p><span>: United States</span>
                        </li>
                        <li>
                            <p>postcode</p><span>: 36952</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-lx-4">
                <div class="single_confirmation_details">
                    <h4>shipping Address</h4>
                    <ul class="list-group">
                        <li>
                            <p>Street</p><span>: 56/8</span>
                        </li>
                        <li>
                            <p>city</p><span>: Los Angeles</span>
                        </li>
                        <li>
                            <p>country</p><span>: United States</span>
                        </li>
                        <li>
                            <p>postcode</p><span>: 36952</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="order_details_iner">
                    <h3>Order Details</h3>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th colspan="2"><span>Pixelstore fresh Blackberry</span></th>
                                <th>x02</th>
                                <th> <span>$720.00</span></th>
                            </tr>
                            <tr>
                                <th colspan="2"><span>Pixelstore fresh Blackberry</span></th>
                                <th>x02</th>
                                <th> <span>$720.00</span></th>
                            </tr>
                            <tr>
                                <th colspan="2"><span>Pixelstore fresh Blackberry</span></th>
                                <th>x02</th>
                                <th> <span>$720.00</span></th>
                            </tr>
                            <tr>
                                <th colspan="3">Subtotal</th>
                                <th> <span>$2160.00</span></th>
                            </tr>
                            <tr>
                                <th colspan="3">shipping</th>
                                <th><span>flat rate: $50.00</span></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" colspan="3">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
Commerce::footerTemplate('login.js');
?>