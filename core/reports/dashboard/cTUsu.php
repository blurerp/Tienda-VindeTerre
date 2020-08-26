<?php
require('../../helpers/report.php');
require('../../models/usuarios.php');




// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Tipo y numero de usuarios Activos & Inactivos');

// Se instancia el módelo Categorías para obtener los datos.
$usuariosA = new Usuarios;
    echo(countTypeUsuarios(1));
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataUsuariosA = $usuariosA->countTypeUsuarios(1)) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(175);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Helvetica', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Usuarios Activos'), 1, 1, 'C', 1);        
        
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(225);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Helvetica', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(100, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
        $pdf->Cell(40, 10, utf8_decode('Imagen'), 1, 0, 'C', 1);
        $pdf->Cell(46, 10, utf8_decode('Precio (US$)'), 1, 1, 'C', 1);
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Helvetica', '', 11);
        // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
        
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(100, 20, utf8_decode($dataUsuariosA['tipo_cliente']), 1, 0);
        $pdf->Cell(40, 20, utf8_decode($dataUsuariosA['occurrences']), 1,0);
        $pdf->Cell(46, 20, $rowProducto['precio_venta'], 1, 1);
                
            
        
    
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay datos para mostrar'), 1, 1);
}

$pdf->Cell(0, 26, utf8_decode('____________________</>____________________'), 0, 1,'C');

$usuariosI = new Usuarios;

// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataUsuariosI = $usuariosI->countTypeUsuarios(2)) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(175);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Helvetica', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Usuarios Activos'), 1, 1, 'C', 1);        
        
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(225);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Helvetica', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(140, 10, utf8_decode('Tipo de usuario'), 1, 0, 'C', 1);
        $pdf->Cell(46, 10, utf8_decode('Numero de usuarios por tipo'), 1, 0, 'C', 1);
        
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Helvetica', '', 11);
        // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
        
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(100, 20, utf8_decode($dataUsuariosI['tipo_cliente']), 1, 0);
        $pdf->Cell(40, 20, utf8_decode($dataUsuariosI['occurrences']), 1,0);
        $pdf->Cell(46, 20, $rowProducto['precio_venta'], 1, 1);
                
            
        
    
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay datos para mostrar'), 1, 1);
}



// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>