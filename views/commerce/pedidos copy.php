<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Historial de Compra');
?>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">        
            <div class="site-blocks-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Cambiar Cantidad</th>
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
Commerce::footerTemplate('pedidos.js');
?>