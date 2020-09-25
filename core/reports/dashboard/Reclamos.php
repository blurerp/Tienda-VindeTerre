<?php
require('../../helpers/report.php');
require('../../models/productos.php');




// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de reclamos de pedidos por estado');

// Se instancia el módelo Categorías para obtener los datos.
$reclamos = new Productos;

// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataReclamos = $reclamos->readAllReclamos1()) {        
    $pdf->SetFillColor(78, 137, 174);    
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Helvetica', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Estado reclamos: Sin Resolver '), 1, 1, 'C', 1);
    // Se recorren los registros ($dataReclamos) fila por fila ($rowReclamos).
    // Se establece un color de relleno para los encabezados.
    $pdf->SetFillColor(255, 163, 114);
    // Se establece la fuente para los encabezados.
    $pdf->SetFont('Helvetica', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->Cell(60, 10, utf8_decode('Numero orden'), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, utf8_decode('Detalle '), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, utf8_decode('Fecha de ingreso'), 1, 0, 'C', 1);   
    $pdf->Cell(46, 10, utf8_decode('Tipo reclamo'), 1, 1, 'C', 1);  
    foreach($dataReclamos as $rowReclamos) {        
        
        
        
          
        // Se establece la fuente para los datos de los productos.
        
        // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
        
            $pdf->SetFont('Helvetica', '', 11);
            // Se imprimen las celdas con los datos de los productos.
            $pdf->Cell(60, 20, utf8_decode($rowReclamos['numero_orden']), 1, 0);
            $pdf->Cell(40, 20, utf8_decode($rowReclamos['detalle']), 1, 0);            
            $pdf->Cell(40, 20, utf8_decode($rowReclamos['fecha_hora_ingreso']), 1, 0);            
            $pdf->Cell(46, 20, utf8_decode($rowReclamos['tipo_reclamo']), 1, 1);            
            
        }
            
   
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay categorías para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>