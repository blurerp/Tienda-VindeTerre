const API_CATEGORIAS = '../../core/api/dashboard/categorias.php?action=';

$( document ).ready(function() {
    readRows( API_CATEGORIAS );
});

function fillTable( dataset )
{
    let content = '';
    dataset.forEach(function( row ) {
        content += `
            <tr>
                <td><img src="../../resources/img/categorias/${row.imagen_categoria}" class="materialboxed" height="100"></td>
                <td>${row.categoria}</td>
                <td>
                    <div class="text-center">
                        <div class="btn-group">
                            <button onclick= "openUpdateModal(${row.id_categoria})" class="btn btn-primary btn_editar" data-toggle="modal" data-target="#save-modal">Editar</button>
                            <button onclick= "openDeleteDialog(${row.id_categoria})" class="btn btn-danger btn_eliminar">Eliminar</button>
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
/*
// Evento para mostrar los resultados de una búsqueda.
$( '#search-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows( API_CATEGORIAS, this );
});*/

function openCreateModal()
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#78e08f' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Nueva categoría' );
    $( '#archivo_categoria' ).prop( 'required', true );
    $( '#save-modal' ).modal( 'show' );
    $( '#save-modal' ).modal( 'novalidate' );
}

function openUpdateModal( id )
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#4a69bd' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Modificar categoría' );
    $( '#archivo_categoria' ).prop( 'required', false );
    $( '#save-modal' ).modal( 'show' );

    $.ajax({
        dataType: 'json',
        url: API_CATEGORIAS + 'readOne',
        data: { id_categoria: id },
        type: 'post'
    })
    .done(function( response ) {
        if ( response.status ) {
            $( '#id_categoria' ).val( response.dataset.id_categoria );
            $( '#categoria' ).val( response.dataset.categoria );
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
    if ( $( '#id_categoria' ).val() ) {
        saveRow( API_CATEGORIAS, 'update', this, 'save-modal' );
    } else {
        saveRow( API_CATEGORIAS, 'create', this, 'save-modal' );
    }
});

function openDeleteDialog( id )
{
    let identifier = { id_categoria: id };
    confirmDelete( API_CATEGORIAS, identifier );
}