const API_USUARIOS = '../../core/api/dashboard/usuarios.php?action=';
const API_TIPO_USUARIOS = '../../core/api/dashboard/tipo_usuarios.php?action=readAll';

$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows( API_USUARIOS );
});

// Función para llenar la tabla con los datos enviados por readRows().
function fillTable( dataset )
{
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.forEach(function( row ) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.usuario}</td>
                <td>${row.nombre_usuario}</td>
                <td>${row.apellido_usuario}</td>
                <td>${row.fecha_nacimiento}</td>
                <td>${row.dui_usuario}</td>
                <td>${row.email_usuario}</td>
                <td>${row.estado_usuario}</td>
                <td>${row.tipo_usuario}</td>
                <td>
                    <button onclick= "openUpdateModal(${row.id_usuario})" class="btn btn-primary btn_editar" data-toggle="modal" data-target="#save-modal">Editar</button>
                    <button onclick= "openDeleteDialog(${row.id_usuario})" class="btn btn-danger btn_eliminar">Eliminar</button>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    $( '#tbody-rows' ).html( content );
}

function openCreateModal()
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#78e08f' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Nuevo usuario' );
    $( '#save-modal' ).modal( 'show' );
    $( '#usuario' ).prop( 'disabled', false );
    $( '#contrasena_usuario' ).prop( 'disabled', false );
    $( '#confirmar_contrasena' ).prop( 'disabled', false );
    fillSelect( API_TIPO_USUARIOS, 'tipo_usuario', null );
}

function openUpdateModal( id )
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#4a69bd' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Modificar usuario' );
    $( '#save-modal' ).modal( 'show' );
    $( '#usuario' ).prop( 'disabled', true );
    $( '#contrasena_usuario' ).prop( 'disabled', true );
    $( '#confirmar_contrasena' ).prop( 'disabled', true );

    $.ajax({
        dataType: 'json',
        url: API_USUARIOS + 'readOne',
        data: { id_usuario: id },
        type: 'post'
    })
    .done(function( response ) {
        if ( response.status ) {
            $( '#id_usuario' ).val( response.dataset.id_usuario );
            $( '#nombre_usuario' ).val( response.dataset.nombre_usuario );
            $( '#apellido_usuario' ).val( response.dataset.apellido_usuario );
            $( '#fecha_nacimiento ' ).val( response.dataset.fecha_nacimiento );
            $( '#dui_usuario ' ).val( response.dataset.dui_usuario );
            $( '#email_usuario' ).val( response.dataset.email_usuario );
            $( '#estado_usuario' ).val( response.dataset.estado_usuario );
            fillSelect( API_TIPO_USUARIOS, 'tipo_usuario', response.dataset.id_tipo_usuario );
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
    if ( $( '#id_usuario' ).val() ) {
        saveRow( API_USUARIOS, 'update', this, 'save-modal' );
    } else {
        saveRow( API_USUARIOS, 'create', this, 'save-modal' );
    }
});

function openDeleteDialog( id )
{
    let identifier = { id_usuario: id };
    confirmDelete( API_USUARIOS, identifier );
}