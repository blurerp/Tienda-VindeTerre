const API_PEDIDO = '../../core/api/commerce/pedidos.php?action=';

$( document ).ready(function() {
    readPedidos();
});

function readPedidos()
{
    $.ajax({
        dataType: 'json',
        url: API_PEDIDO + 'readPedidos'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje y se direcciona a la página principal.
        if ( response.status ) {
            // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
            let content = '';
            // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
            let url = '';
            response.dataset.forEach(function( row ) {  
                url = `ticket.php?id=${row.id_pedido}&c=${row.id_cliente}`;
                let fe = ''; 
                fe += row.fecha_entrega; 
                if (fe == 'null') {
                    content += `                   
                    <div class="col-sm-3 mb-3 m-2">
                        <div class="card" style="width: 18rem;">                            
                            <div class="card-body">
                                <h5 class="card-title">$${row.monto_total}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Total</h6>
                            </div>                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Estado: ${row.estado_pedido}</li>
                                <li class="list-group-item">Fecha de Creación: ${row.fecha_pedido}</li>
                                <li class="list-group-item">Fecha de llegada: El pedido todavia no ha sido entregado, le notificaremos cuando llegue</li>                                
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Ver Detalle</a>
                                <a href="../../core/reports/commerce/${url}" target="_blank" class="card-link">Generar Ticket</a>
                            </div>
                        </div> 
                    </div>                      
                    `;
                } else {                    
                    content += `                   
                    <div class="col-sm-3 mb-3 m-2">
                        <div class="card" style="width: 18rem;">                            
                            <div class="card-body">
                                <h5 class="card-title">$${row.monto_total}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Total</h6>
                            </div>                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Estado: ${row.estado_pedido}</li>
                                <li class="list-group-item">Fecha de Creación: ${row.fecha_pedido}</li>
                                <li class="list-group-item">Fecha de llegada: ${row.fecha_entrega}</li>                                
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Ver Detalle</a>
                                <a href="../../core/reports/commerce/${url}" target="_blank" class="card-link">Generar Ticket</a>
                            </div>
                        </div> 
                    </div>                      
                    `;
                }
                // Se crean y concatenan las filas de la tabla con los datos de cada registro.                
            });
            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
            $( '#pedidos' ).html( content );
        } else {
            // Se presenta un mensaje de error cuando no existen datos para mostrar.
            $( '#title' ).html( `<i class="far fa-times-square"></i><span class="text-danger">${response.exception}</span>` );
        }
    })
    .fail(function( jqXHR ) {
        // Se verifica si la API ha respondido para mostrar la respuesta, de lo contrario se presenta el estado de la petición.
        if ( jqXHR.status == 200 ) {
            console.log( jqXHR.responseText );
        } else {
            console.log( jqXHR.status + ' ' + jqXHR.statusText );
        }
    });
}