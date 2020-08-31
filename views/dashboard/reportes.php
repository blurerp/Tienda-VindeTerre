<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Reportes');
?>

<div class="list-group">
    <br>


    <a href="../../core/reports/dashboard/productos.php" target="_blank"
        class="list-group-item list-group-item-action list-group-item-primary">Reporte de Stock Activo de productos existentes por categoria.</a>
    <a href="../../core/reports/dashboard/pedidos.php" target="_blank"
        class="list-group-item list-group-item-action list-group-item-secondary">Reporte de pedidos según su estado.</a>
    <a href="../../core/reports/dashboard/clientesR.php" target="_blank" class="list-group-item list-group-item-action list-group-item-primary">Reporte de clientes registrtrados segun su tipo y estado.</a>
    <a href="../../core/reports/dashboard/bitacora.php" target="_blank" class="list-group-item list-group-item-action list-group-item-secondary">Reporte de Acciones CRUD en el sistema</a>
    <a href="../../core/reports/dashboard/Reclamos.php" target="_blank" class="list-group-item list-group-item-action list-group-item-primary">Reporte de reclamos de pedidos por estado</a>

</div>
<?php
Dashboard::footerTemplate('reportes.js');
?>