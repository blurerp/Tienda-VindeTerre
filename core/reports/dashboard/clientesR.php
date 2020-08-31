<?php
require('../../helpers/report.php');
require('../../models/clientes.php');




// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de clientes registrtrados según su tipo y estado');

// Se instancia el módelo Categorías para obtener los datos.
$cliente = new Clientes;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataCliente = $cliente->readC()) {
    $pdf->SetFillColor(78, 137, 174);
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Cliente tipo: Persona Natural'), 1, 1, 'C', 1);
    
    // Se recorren los registros ($dataCliente) fila por fila ($rowCliente).
    
    
    
    foreach ($dataCliente as $rowCategoria) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Helvetica', 'B', 12);                  
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(255, 163, 114);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Helvetica', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(40, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);
        $pdf->Cell(70, 10, utf8_decode('Correo'), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, utf8_decode('Telefono'), 1, 0, 'C', 1);
        $pdf->Cell(46, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Helvetica', '', 11);
        // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
        
            // Se imprimen las celdas con los datos de los productos.
            $pdf->Cell(40, 20, utf8_decode($rowCategoria['usuario_cliente']), 1, 0);
            $pdf->Cell(70, 20, utf8_decode($rowCategoria['email_cliente']), 1, 0);
            $pdf->Cell(30, 20, utf8_decode($rowCategoria['telefono_cliente']), 1, 0);
            $pdf->Cell(46, 20, utf8_decode($rowCategoria['estado_cliente']), 1, 1);
                    
    }
    
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar'), 1, 1);
}

$pdf->Cell(36, 10, utf8_decode(''), 0, 1);


if ($dataCliente = $cliente->readC2()) {
    $pdf->SetFillColor(78, 137, 174);
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Cliente tipo: Empresa'), 1, 1, 'C', 1);
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataCliente as $rowCategoria) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(78, 137, 174);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Helvetica', 'B', 12);       
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(255, 163, 114);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Helvetica', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(40, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);
        $pdf->Cell(70, 10, utf8_decode('Correo'), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, utf8_decode('Telefono'), 1, 0, 'C', 1);
        $pdf->Cell(46, 10, utf8_decode('Estado  '), 1, 1, 'C', 1);
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Helvetica', '', 11);       
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(40, 20, utf8_decode($rowCategoria['usuario_cliente']), 1, 0);
        $pdf->Cell(70, 20, utf8_decode($rowCategoria['email_cliente']), 1, 0);
        $pdf->Cell(30, 20, utf8_decode($rowCategoria['telefono_cliente']), 1, 0);
        $pdf->Cell(46, 20, utf8_decode($rowCategoria['estado_cliente']), 1, 1);
                    
    }
    
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>