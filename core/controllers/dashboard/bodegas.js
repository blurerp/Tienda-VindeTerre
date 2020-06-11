const API_BODEGAS = '../../core/api/dashboard/bodegas.php?action=';

$( document ).ready(function() {
    readRows( API_BODEGAS );
});

function fillTable( dataset )
{
    let content = '';
    dataset.forEach(function( row ) {
        content += `
            <tr>
                <td>${row.direccion_bodega}</td>
                <td>${row.capacidad}</td>
                <td>${row.telefono_bodega}</td>
                <td>
                    <div class="text-center">
                        <div class="btn-group">
                            <button onclick= "openUpdateModal(${row.id_bodega})" class="btn btn-primary btn_editar" data-toggle="modal" data-target="#save-modal">Editar</button>
                            <button onclick= "openDeleteDialog(${row.id_bodega})" class="btn btn-danger btn_eliminar">Eliminar</button>
                        </div>
                    </div>
                </td>
            </tr>
        `;
    });
    $( '#tbody-rows' ).html( content );
}

function openCreateModal()
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#78e08f' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Nueva bodega' );
    $( '#save-modal' ).modal( 'show' );
}

function openUpdateModal( id )
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#4a69bd' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Modificar bodega' );
    $( '#save-modal' ).modal( 'show' );

    $.ajax({
        dataType: 'json',
        url: API_BODEGAS + 'readOne',
        data: { id_bodega: id },
        type: 'post'
    })
    .done(function( response ) {
        if ( response.status ) {
            $( '#id_bodega' ).val( response.dataset.id_bodega );
            $( '#capacidad ' ).val( response.dataset.capacidad );
            $( '#direccion_bodega' ).val( response.dataset.direccion_bodega );
            $( '#telefono_bodega' ).val( response.dataset.telefono_bodega );
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
    if ( $( '#id_bodega' ).val() ) {
        saveRow( API_BODEGAS, 'update', this, 'save-modal' );
    } else {
        saveRow( API_BODEGAS, 'create', this, 'save-modal' );
    }
});

function openDeleteDialog( id )
{
    let identifier = { id_bodega: id };
    confirmDelete( API_BODEGAS, identifier );
}
