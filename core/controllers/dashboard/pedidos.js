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
    $('#tabla').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    })
}
