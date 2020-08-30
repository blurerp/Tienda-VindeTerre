// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PEDIDOS = '../../core/api/commerce/pedidos.php?action=';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se llama a la función que obtiene los productos del carrito de compras para llenar la tabla en la vista.
    readCart();
});

// Función para obtener el detalle del pedido (carrito de compras).
function readCart()
{
    $.ajax({
        dataType: 'json',
        url: API_PEDIDOS + 'readCart'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje y se direcciona a la página principal.
        if ( response.status ) {
            // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
            let content = '';
            // Se declara e inicializa una variable para calcular el importe por cada producto.
            let subtotal = 0;
            // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
            let total = 0;
            // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                subtotal = row.precio_producto_det * row.cantidad_detalle ;
                total += subtotal;
                // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                content += `
                    <tr>
                        <td>${row.nombre_producto}</td>
                        <td>${row.precio_producto_det}</td>
                        <td>${row.cantidad_detalle}</td>
                        <td>${subtotal.toFixed(2)}</td>
                        <td>
                            <a href="#" onclick="openUpdateDialog(${row.id_det_pedido}, ${row.cantidad_detalle})" class="btn btn-primary btn-sm"><i class="fas fa-pencil"></i></a>                                                
                        </td>  
                        <td>
                            <a href="#" onclick="openDeleteDialog(${row.id_det_pedido})" class="btn btn-primary btn-sm">X</a>
                        </td>                                      
                    </tr>
                `;
            });
            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
            $( '#tbody-rows' ).html( content );
            // Se muestra el total a pagar con dos decimales.
            $( '#pago' ).text( total.toFixed(2) );
            
        } else {
            sweetAlert( 4, response.exception, 'index.php' );
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

// Función que abre una caja de dialogo (modal) con formulario para modificar la cantidad de producto.
function openUpdateDialog( id, quantity )
{
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    $( '#item-modal' ).modal( 'show' );
    // Se inicializan los campos del formulario con los datos del registro seleccionado previamente.
    $( '#id_det_pedido' ).val( id );
    $( '#cantidad_detalle' ).val( quantity );
}

// Evento para cambiar la cantidad de producto.
$( '#item-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API_PEDIDOS + 'updateDetail',
        data: $( '#item-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se actualiza la tabla en la vista para mostrar la modificación de la cantidad de producto.
            readCart();
            // Se cierra la caja de dialogo (modal).
            $( '#item-modal' ).modal( 'close' );
            sweetAlert( 1, response.message, null );
        } else {
            sweetAlert( 2, response.exception, null );
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
});

// Función que abre una caja de dialogo para confirmar la finalización del pedido.
function finishOrder()
{
    swal({
        title: 'Aviso',
        text: '¿Está seguro de finalizar el pedido?',
        icon: 'info',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function( value ) {
        let totalf = $( '#pago' ).text();
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario no se hace nada.
        if ( value ) {
            $.ajax({
                type: 'post',
                url: API_PEDIDOS + 'finishOrder',
                dataType: 'json',
                data: { pago : totalf }
            })
            .done(function( response ) {
                // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
                if ( response.status ) {
                    sweetAlert( 1, response.message, 'index.php' );
                } else {
                    sweetAlert( 2, response.exception, null );
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
    });
}

// Función que abre una caja de dialogo para confirmar la eliminación de un producto del carrito de compras.
function openDeleteDialog( id )
{
    swal({
        title: 'Advertencia',
        text: '¿Está seguro de remover el producto?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function( value ) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario no se hace nada.
        if ( value ) {
            $.ajax({
                type: 'post',
                url: API_PEDIDOS + 'deleteDetail',
                data: { id_det_pedido: id },
                dataType: 'json'
            })
            .done(function( response ) {
                // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
                if ( response.status ) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de borrar un producto del pedido.
                    readCart();
                    sweetAlert( 1, response.message, null );
                } else {
                    sweetAlert( 2, response.exception, null );
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
    });
}