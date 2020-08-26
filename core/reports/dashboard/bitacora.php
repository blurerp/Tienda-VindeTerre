<?php
require('../../helpers/report.php');
require('../../models/bitacora.php');




// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Acciones CRUD en tablas de la base de datos');

// Se instancia el módelo Categorías para obtener los datos.
$bitacora = new Bodegas;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataCategorias = $bitacora->readAllActions()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataCategorias as $rowCategoria) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(175);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Helvetica', 'B', 12);
        // Se imprime una celda con el nombre de la fecha.
        $pdf->Cell(0, 10, utf8_decode('Fecha y hora: '.$rowCategoria['fecha_hora']), 1, 1, 'C', 1);
        // Se instancia el módelo Productos para obtener los datos.
        
        
            // Se verifica si existen registros (bitacora) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $bitacora->readAllActions()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Helvetica', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(186, 10, utf8_decode('Acción'), 1, 1, 'C', 1);
                
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Helvetica', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(186, 20, utf8_decode($rowProducto['accion']), 1,1);

                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay acciones'), 1, 1);
            }
        
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay fechas para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>