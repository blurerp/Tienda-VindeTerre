const API_CLIENTES = '../../core/api/dashboard/clientes.php?action=';

$( document ).ready(function() {
    readRows( API_CLIENTES );
});

function fillTable( dataset )
{
    let content = '';
    dataset.forEach(function( row ) {
        content += `
            <tr>
                <td>${row.nombre_cliente}</td>
                <td>${row.apellido_cliente}</td>
                <td>${row.usuario_cliente}</td>
                <td><img src="../../resources/img/clientes/${row.foto_cliente}" class="materialboxed" height="100"></td>
                <td>${row.dui_cliente}</td>
                <td>${row.email_cliente}</td>
                <td>${row.telefono_cliente}</td>
                <td>${row.nit_cliente}</td>
                <td>${row.tipo_cliente}</td>
                <td>${row.estado_cliente}</td>
                <td>
                    <div class="text-center">
                        <div class="btn-group">                            
                            <button onclick= "actualizarEstado(${row.id_cliente})" class="btn btn-info btn_estado">Cambiar Estado</button>
                            <button onclick= "pedidosRealizados(${row.id_cliente})" class="btn btn-primary btn_pedidos" >Ver Pedidos</button>                            
                        </div>
                    </div>
                </td>
            </tr>
        `;
    });
    $( '#tbody-rows' ).html( content );
}

function actualizarEstado( id )
{
    $.ajax({
        dataType: 'json',
        url: API_CLIENTES + 'readOne',
        data: { id_cliente: id },
        type: 'post'
    })
    .done(function( response ) {
        if ( response.status ) {
            var estado_c = response.dataset.estado_cliente;
            var estado_activo = 'Activo';
            var estado_inactivo = 'Inactivo';
            if (estado_c == estado_activo) {
                $.ajax({
                    dataType: 'json',
                    url: API_CLIENTES + 'update',
                    data: { id_cliente: id,  estado_cliente: estado_inactivo},
                    type: 'post'
                })
                .done(function( response ) {
                    if ( response.status ) {
                        sweetAlert(1, 'Estado actualizado correctamente', null)
                        $.ajax({
                            dataType: 'json',
                            url: API_CLIENTES + 'readAll'
                        })
                        .done(function( response ) {
                            // Si no hay datos se muestra un mensaje indicando la situación.
                            if ( ! response.status ) {
                                sweetAlert( 4, response.exception, null );
                            }
                            // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                            fillTable( response.dataset );
                        })
                        .fail(function( jqXHR ) {
                            // Se verifica si la API ha respondido para mostrar la respuesta, de lo contrario se presenta el estado de la petición.
                            if ( jqXHR.status == 200 ) {
                                console.log( jqXHR.responseText );
                            } else {
                                console.log( jqXHR.status + ' ' + jqXHR.statusText );
                            }
                        });
                    } else {
                        sweetAlert( 2, response.exception, null );
                    }
                })
                .fail(function( jqXHR ) {
                    if ( jqXHR.status == 200 ) {
                        console.log( jqXHR.responseText );
                    } else {
                        console.log( jqXHR.status + ' ' + jqXHR.statusText );
                    }
                });
            }  else if (estado_c == estado_inactivo) {
                $.ajax({
                    dataType: 'json',
                    url: API_CLIENTES + 'update',
                    data: { id_cliente: id,  estado_cliente: estado_activo},
                    type: 'post'
                })
                .done(function( response ) {
                    if ( response.status ) {
                        sweetAlert(1, 'Estado actualizado correctamente', null)
                        $.ajax({
                            dataType: 'json',
                            url: API_CLIENTES + 'readAll'
                        })
                        .done(function( response ) {
                            // Si no hay datos se muestra un mensaje indicando la situación.
                            if ( ! response.status ) {
                                sweetAlert( 4, response.exception, null );
                            }
                            // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                            fillTable( response.dataset );
                        })
                        .fail(function( jqXHR ) {
                            // Se verifica si la API ha respondido para mostrar la respuesta, de lo contrario se presenta el estado de la petición.
                            if ( jqXHR.status == 200 ) {
                                console.log( jqXHR.responseText );
                            } else {
                                console.log( jqXHR.status + ' ' + jqXHR.statusText );
                            }
                        });
                    } else {
                        sweetAlert( 2, response.exception, null );
                    }
                })
                .fail(function( jqXHR ) {
                    if ( jqXHR.status == 200 ) {
                        console.log( jqXHR.responseText );
                    } else {
                        console.log( jqXHR.status + ' ' + jqXHR.statusText );
                    }
                });
            } else {
                sweetAlert( 2, 'El estado es invalido', null );
            }
        } else {
            sweetAlert( 2, response.exception, null );
        }
    })
    .fail(function( jqXHR ) {
        if ( jqXHR.status == 200 ) {
            console.log( jqXHR.responseText );
        } else {
            console.log( jqXHR.status + ' ' + jqXHR.statusText );
        }
    });
}