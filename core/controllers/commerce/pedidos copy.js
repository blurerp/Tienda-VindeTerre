const API_PEDIDO = '../../core/api/commerce/pedidos.php?action=';

$( document ).ready(function() {
    readPedidos();
});

function readPedidos2()
{
    $.ajax({
        dataType: 'json',
        url: API_PEDIDO + 'readPedidos'
    })
    .done(function( response ) {
        // Si no hay datos se muestra un mensaje indicando la situación.
        if ( ! response.status ) {
            sweetAlert( 4, response.exception, null );
        }
        response.dataset.forEach(function( row ) {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                <tr>
                    
                </tr>
            `;
        });
        // Se envían los datos a la función del controlador para que llene la tabla en la vista.        
        $( '#tbody-rows' ).html( content );
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
            response.dataset.forEach(function( row ) {
                // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                content += `
                    <tr>
                        <td>${row.monto_total}</td>
                        <td>${row.estado_pedido}</td>
                        <td>${row.fecha_pedido}</td>
                        <td>${row.fecha_entrega}</td>
                        <td>${row.id_pedido}</td>                    
                    </tr>
                `;
            });
            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
            $( '#tbody-rows' ).html( content );
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