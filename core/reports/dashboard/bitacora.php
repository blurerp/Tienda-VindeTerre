<?php
require('../../helpers/report.php');
require('../../models/bitacora.php');




// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de Acciones CRUD en el sistema');

// Se instancia el módelo Categorías para obtener los datos.
$bitacora = new Bitacora;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataAccion = $bitacora->readAllActions()) {
    echo($dataAccion);
    $pdf->SetFillColor(78, 137, 174);
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Acciones realizadas en el sistema'), 1, 1, 'C', 1);
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    $pdf->SetFillColor(255, 163, 114);
    // Se establece la fuente para los encabezados.
    $pdf->SetFont('Helvetica', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->Cell(126, 10, utf8_decode('Acción'), 1, 0, 'C', 1);
    $pdf->Cell(60, 10, utf8_decode('Fecha'), 1, 1, 'C', 1);
    foreach($dataAccion as $rowAccion){
    // Se establece la fuente para los datos de los productos.
    $pdf->SetFont('Helvetica', '', 11);
    // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
    
    // Se imprimen las celdas con los datos de los productos.
    $pdf->Cell(126, 20, utf8_decode($rowAccion['accion']), 1, 0);
    $pdf->Cell(60, 20, utf8_decode($rowAccion['fecha_hora']), 1, 1);
}
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay acciones para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>