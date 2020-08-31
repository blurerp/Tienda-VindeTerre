<?php
require('../../helpers/ticket.php');
require('../../models/pedidos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Vin de Terre');

// Se instancia el módelo Categorías para obtener los datos.
$pedido = new Pedidos;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = $actual_link; 
$url_components = parse_url($url); 
parse_str($url_components['query'], $params); 
$id_p = $params['id'];
$msg = "Ocurrio un error fatal al intentar imprimir el pdf";
if ($_SESSION['id_cliente'] == $params['c']) {
    if ($pedido->setId($params['id'])) {
        // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
        if ($dataPedidos = $pedido->readOnePedidoTicket()) {
            // Se establece un color de relleno para los encabezados.
            $pdf->SetFillColor(255, 255, 255);
            // Se establece la fuente para los encabezados.
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Ln();
            // Se imprimen las celdas con los encabezados.            

            $pdf->Cell(60, 10, utf8_decode('Cliente: '.$dataPedidos['nombre_cliente']), 0, 0, 'L', 1);
            $pdf->Cell(60, 10, utf8_decode($dataPedidos['apellido_cliente']), 0, 0, 'L', 1);
            $pdf->Cell(60, 10, utf8_decode('Fecha de Creación: '.$dataPedidos['fecha_pedido']), 0, 1, 'R', 1);        

            $pdf->Cell(60, 10, utf8_decode('Telefono: '.$dataPedidos['telefono_cliente']), 0, 0, 'L', 1);  
            $pdf->Cell(60, 10, '', 0, 0, 'L', 1);          
            $pdf->Cell(60, 10, utf8_decode('Fecha de Entrega: '.$dataPedidos['fecha_entrega']), 0, 1, 'R', 1); 

            $pdf->Cell(60, 10, utf8_decode('Dirección: '.$dataPedidos['direccion_pedido']), 0, 0, 'L', 1);
            $pdf->Cell(60, 10, '', 0, 0, 'L', 1); 
            $pdf->Cell(60, 10, utf8_decode('DUI: '.$dataPedidos['dui_cliente']), 0, 1, 'R', 1);   

            $pdf->Cell(60, 10, utf8_decode('Estado del Pedido: '.$dataPedidos['estado_pedido']), 0, 0, 'L', 1);
            $pdf->Cell(60, 10, utf8_decode('Email: '.$dataPedidos['email_cliente']), 0, 0, 'L', 1);
            $pdf->Cell(60, 10, utf8_decode('Tipo Cliente: '.$dataPedidos['tipo_cliente']), 0, 1, 'R', 1);                        

            $detalle = new Pedidos; 
            if ($detalle->setId($params['id'])) {
                if ($dataDetalles = $detalle->readDetalle()) {  
                    $pdf->SetFillColor(225);
                    // Se establece la fuente para los encabezados.
                    $pdf->SetFont('Helvetica', 'B', 11);
                    // Se imprimen las celdas con los encabezados.
                    $pdf->Cell(40, 10, utf8_decode('CANTIDAD'), 1, 0, 'C', 1);
                    $pdf->Cell(40, 10, utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 1);
                    $pdf->Cell(50, 10, utf8_decode('PRECIO UNITARIO (US$)'), 1, 0, 'C', 1);
                    $pdf->Cell(40, 10, utf8_decode('VENTAS AFECTAS'), 1, 1, 'C', 1);      
                    $pdf->SetFont('Helvetica', '', 11);    
                    foreach ($dataDetalles as $rowDetalle) {
                        $pdf->Cell(40, 10, $rowDetalle['cantidad_detalle'], 1, 0);
                        $pdf->Cell(40, 10, utf8_decode($rowDetalle['descripcion_producto']), 1, 0);
                        $pdf->Cell(50, 10, $rowDetalle['precio_producto_det'], 1, 0);
                        $pdf->Cell(40, 10, ($rowDetalle['precio_producto_det'] * $rowDetalle['cantidad_detalle']), 1, 1);
                    }           
                }  else {
                    $pdf->Cell(0, 10, utf8_decode('Ocurrio un problema al intentar generar el ticket'), 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('Ocurrio un problema al intentar generar el ticket'), 1, 1);
            }
            $pdf->Ln();
            $pdf->Cell(60, 10, utf8_decode('Monto: '.$dataPedidos['monto_total']), 0, 0, 'R', 1);
            // Se establece la fuente para los datos de los productos.           
        } else {
            $pdf->Cell(0, 10, utf8_decode('Ocurrio un problema al intentar generar el ticket'), 1, 1);
        }
    } else {
        $pdf->Cell(0, 10, utf8_decode('Ocurrio un problema al intentar generar el ticket'), 1, 1);
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('Ocurrio un problema al intentar generar el ticket'), 1, 1);
}

    // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
    
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>