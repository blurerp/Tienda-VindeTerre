<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Historial de Compra');
?>

<div class="container">
    <!-- Título para la página web -->
    <h4 class="font-weight-bold text-primary text-center" id="title"></h4>
    
    <div class="row" id="pedidos"></div>
</div>

<?php
Commerce::footerTemplate('pedidos.js');
?>