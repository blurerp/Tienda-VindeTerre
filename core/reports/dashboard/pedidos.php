<?php
require('../../helpers/report.php');
require('../../models/pedidos.php');


// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de pedidos según su estado');

// Se instancia el módelo Categorías para obtener los datos.
$pedidos = new Pedidos;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataPedidos = $pedidos->readAllPedidos()) {
    
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataPedidos as $rowPedidos) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(78, 137, 174);        
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Helvetica', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Estado: '.$rowPedidos['estado_pedido']), 1, 1, 'C', 1);                 
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(255, 163, 114);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Helvetica', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(40, 10, utf8_decode('Numero orden'), 1, 0, 'C', 1);
        $pdf->Cell(50, 10, utf8_decode('Nombre cliente'), 1, 0, 'C', 1);
        $pdf->Cell(50, 10, utf8_decode('Fecha pedido'), 1, 0, 'C', 1);
        
        $pdf->Cell(46, 10, utf8_decode('Monto total'), 1, 1, 'C', 1);                

        // Se establece la fuente para los datos de los pedidos.
        $pdf->SetFont('Helvetica', '', 11);
       
        
        $pdf->SetFillColor(232, 222, 210);
        // Se imprimen las celdas con los datos de los pedidos.
        $pdf->Cell(40, 20, utf8_decode($rowPedidos['numero_orden']), 1, 0);
        $pdf->Cell(50, 20, utf8_decode($rowPedidos['nombre_cliente']), 1, 0);
        $pdf->Cell(50, 20, utf8_decode($rowPedidos['fecha_pedido']), 1, 0);        
        $pdf->Cell(46, 20, utf8_decode('$'.$rowPedidos['monto_total']), 1, 1);
                    
        $pdf->Cell(36, 10, utf8_decode(''), 0, 1);
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay categorías para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>