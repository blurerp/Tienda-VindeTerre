<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Productos por categoría');
?>

<div class="container">
    <!-- Título para la página web -->
    <h4 class="font-weight-bold text-primary text-center" id="title"></h4>
    <!-- Fila para mostrar los productos disponibles por categoría -->
    <div class="row" id="productos"></div>
</div>

<?php
Commerce::footerTemplate('productos.js');
?>