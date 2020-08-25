const API_PROVEEDORES = '../../core/api/dashboard/proveedores.php?action=';

$( document ).ready(function() {
    readRows( API_PROVEEDORES );
});

function fillTable( dataset )
{
    let content = '';
    dataset.forEach(function( row ) {
        content += `
            <tr>
                <td>${row.nombre_proveedor}</td>
                <td>${row.correo_proveedor}</td>
                <td>${row.telefono_proveedor}</td>
                <td>${row.direccion_proveedor}</td>
                <td>${row.url_proveedor}</td>
                <td>${row.tipo_documento}</td>
                <td>${row.numero_documento}</td>
                <td>
                    <div class="text-center">
                        <div class="btn-group">
                            <button onclick= "openUpdateModal(${row.id_proveedor})" class="btn btn-primary btn_editar" data-toggle="modal" data-target="#save-modal">Editar</button>
                            <button onclick= "openDeleteDialog(${row.id_proveedor})" class="btn btn-danger btn_eliminar">Eliminar</button>
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

function openCreateModal()
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#78e08f' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Nuevo proveedor' );
    $( '#save-modal' ).modal( 'show' );
}

function openUpdateModal( id )
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#4a69bd' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Modificar proveedor' );
    $( '#save-modal' ).modal( 'show' );

    $.ajax({
        dataType: 'json',
        url: API_PROVEEDORES + 'readOne',
        data: { id_proveedor: id },
        type: 'post'
    })
    .done(function( response ) {
        if ( response.status ) {
            $( '#id_proveedor' ).val( response.dataset.id_proveedor );
            $( '#nombre_proveedor ' ).val( response.dataset.nombre_proveedor );
            $( '#correo_proveedor' ).val( response.dataset.correo_proveedor );
            $( '#telefono_proveedor' ).val( response.dataset.telefono_proveedor );
            $( '#direccion_proveedor' ).val( response.dataset.direccion_proveedor );
            $( '#url_proveedor' ).val( response.dataset.url_proveedor );
            $( '#tipo_documento' ).val( response.dataset.tipo_documento );
            $( '#numero_documento' ).val( response.dataset.numero_documento );
            M.updateTextFields();
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

$( '#save-form' ).submit(function( event ) {
    event.preventDefault();
    if ( $( '#id_proveedor' ).val() ) {
        saveRow( API_PROVEEDORES, 'update', this, 'save-modal' );
    } else {
        saveRow( API_PROVEEDORES, 'create', this, 'save-modal' );
    }
});

function openDeleteDialog( id )
{
    let identifier = { id_proveedor: id };
    confirmDelete( API_PROVEEDORES, identifier );
}
