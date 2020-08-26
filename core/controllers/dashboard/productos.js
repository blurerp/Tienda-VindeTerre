const API_PRODUCTOS = '../../core/api/dashboard/productos.php?action=';
const API_CATEGORIAS = '../../core/api/dashboard/categorias.php?action=readAll';
const API_BODEGAS = '../../core/api/dashboard/bodegas.php?action=readAll';

$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows( API_PRODUCTOS );
});

function fillTable( dataset )
{
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.forEach(function( row ) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.codigo_producto}</td>
                <td>${row.nombre_producto}</td>
                <td><img src="../../resources/img/productos/${row.imagen_producto}" class="materialboxed" height="100"></td>
                <td>${row.descripcion_producto}</td>
                <td>${row.precio_venta}</td>
                <td>${row.precio_compra}</td>
                <td>${row.stock_activo}</td>
                <td>${row.stock_minimo}</td>
                <td>${row.cosecha}</td>
                <td>${row.alcohol}</td>
                <td>${row.id_bodega}</td>
                <td>${row.categoria}</td>
                <td>${row.estado_producto}</td>                
                <td>
                    <button onclick= "openUpdateModal(${row.id_producto})" class="btn btn-primary btn_editar" data-toggle="modal" data-target="#save-modal">Editar</button>
                    <button onclick= "openDeleteDialog(${row.id_producto})" class="btn btn-danger btn_eliminar">Eliminar</button>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
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
    searchRows( API_PRODUCTOS, this );
});*/

function openCreateModal()
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#78e08f' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Nuevo producto' );
    $( '#archivo_producto' ).prop( 'required', true );
    $( '#save-modal' ).modal( 'show' );
    fillSelect( API_CATEGORIAS, 'categoria', null );
    fillSelect( API_BODEGAS, 'bodega', null );
    var op = document.getElementById("estado_producto").getElementsByTagName("option");
    for (var i = 0; i < op.length; i++) {
        if (op[i].value.toLowerCase() == "agotado") {
            op[i].disabled = false;
        } else {
            op[i].disabled = true;
        }
    }
    $( '#estado_producto' ).prop( 'selectedIndex', 0 )
}

function openUpdateModal( id )
{
    $( '#save-form' )[0].reset();
    $( '.modal-header' ).css( 'background-color', '#4a69bd' );
    $( '.modal-header' ).css( 'color', 'white' );
    $( '.modal-title' ).text( 'Modificar producto' );
    $( '#save-modal' ).modal( 'show' );
    $( '#archivo_producto' ).prop( 'required', false )
    var op = document.getElementById("estado_producto").getElementsByTagName("option");
    for (var i = 0; i < op.length; i++) {
        op[i].disabled = false;
    }
    $.ajax({
        dataType: 'json',
        url: API_PRODUCTOS + 'readOne',
        data: { id_producto: id },
        type: 'post'
    })
    .done(function( response ) {
        if ( response.status ) {
            $( '#id_producto' ).val( response.dataset.id_producto );
            $( '#codigo_producto' ).val( response.dataset.codigo_producto );
            $( '#nombre_producto' ).val( response.dataset.nombre_producto );
            $( '#precio_venta' ).val( response.dataset.precio_venta );
            $( '#precio_compra' ).val( response.dataset.precio_compra );
            $( '#descripcion_producto' ).val( response.dataset.descripcion_producto );
            $( '#cosecha' ).val( response.dataset.cosecha );
            $( '#alcohol' ).val( response.dataset.alcohol );
            $( '#stock_minimo' ).val( response.dataset.stock_minimo );                       
            fillSelect( API_CATEGORIAS, 'categoria', response.dataset.id_categoria );
            fillSelect( API_BODEGAS, 'bodega', response.dataset.id_bodega );
            $( '#estado_producto' ).val( response.dataset.estado_producto ); 
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
    if ( $( '#id_producto' ).val() ) {
        saveRow( API_PRODUCTOS, 'update', this, 'save-modal' );
    } else {
        saveRow( API_PRODUCTOS, 'create', this, 'save-modal' );
    }
});

function openDeleteDialog( id )
{
    let identifier = { id_producto: id };
    confirmDelete( API_PRODUCTOS, identifier );
}