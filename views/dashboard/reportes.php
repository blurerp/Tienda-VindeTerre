<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Reportes');
?>

<div class="list-group">
    <br>


    <a href="../../core/reports/dashboard/productos.php" target="_blank"
        class="list-group-item list-group-item-action list-group-item-primary">Reporte de productos que estan 'En existencia'.</a>
    <a href="../../core/reports/dashboard/pedidos.php" target="_blank"
        class="list-group-item list-group-item-action list-group-item-secondary">Reporte de pedidos según su estado.</a>
    <a href="../../core/reports/dashboard/clientesR.php" target="_blank" class="list-group-item list-group-item-action list-group-item-primary">Reporte de clientes registrtrados segun su tipo y estado.</a>
    <a href="../../core/reports/dashboard/Reclamos.php" target="_blank" class="list-group-item list-group-item-action list-group-item-secondary">Reporte de reclamos por mes.
        list group item</a>
    <a href="../../core/reports/dashboard/muni_pais" target="_blank" class="list-group-item list-group-item-action list-group-item-primary">Reporte de pedidos segun cada departemento.
        list group item</a>

</div>
<?php
Dashboard::footerTemplate('reportes.js');
?>