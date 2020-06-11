const API_PEDIDOS = '../../core/api/dashboard/pedidos.php?action=';
const API_CLIENTES = '../../core/api/dashboard/clientes.php?action=readAll';
const API_PRODUCTOS = '../../core/api/dashboard/productos.php?action=readAll';

$( document ).ready(function() {
    readRows( API_PEDIDOS );
});

function fillTable( dataset )
{
    let content = '';
    dataset.forEach(function( row ) {
        content += `
            <tr>
                <td>${row.nombre_cliente}</td>
                <td>${row.apellido_cliente}</td>
                <td>${row.numero_orden}</td>
                <td>${row.monto_total}</td>
                <td>${row.estado_pedido}</td>
                <td>${row.fecha_pedido}</td>
                <td>${row.fecha_entrega}</td>
                <td>${row.direccion_pedido}</td>
                <td>${row.codigo_postal}</td>
                <td>${row.numero_casa_direccion}</td>
                <td>
                    <div class="text-center">
                        <div class="btn-group">                            
                            <button onclick= "actualizarEstado(${row.id_pedido})" class="btn btn-info btn_estado">Cambiar Estado</button>
                            <button onclick= "detallePedido(${row.id_pedido})" class="btn btn-primary btn_pedidos" >Ver Detalle</button>                            
                        </div>
                    </div>
                </td>
            </tr>
        `;
    });
    $( '#tbody-rows' ).html( content );
}
var id_pedd = $row.id_pedido;

$( document ).ready(function() {
        readRows2( API_PEDIDOS, id_pedd );
    });
    function fillTable( dataset )
        {
            let content2 = '';
            dataset.forEach(function( row ) {
                content2 += `
                    <tr>
                        <td>${row.numero_orden}</td>
                        <td>${row.nombre_producto}</td>
                        <td>${row.precio_producto_det}</td>
                        <td>${row.cantidad_detalle}</td>
                    </tr>
                `;
            });
            $( '#tbody-rows2' ).html( content2 );
        }
function detallePedido( id )
{
    $( '.modal-header' ).css( 'background-color', '#b2d4ac' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Detalle Pedido' );
    $( '#save-modal' ).modal( 'show' );

    
}