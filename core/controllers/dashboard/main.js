// Función para graficar la cantidad de productos por categoría.
function graficaCategorias()
{
    $.ajax({
        dataType: 'json',
        url: API_PRODUCTOS + 'cantidadProductosCategoria',
        data: null
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se remueve la etiqueta canvas asignada para la gráfica.
        if ( response.status ) {
            // Se declaran los arreglos para guardar los datos por gráficar.
            let categorias = [];
            let cantidad = [];
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se asignan los datos a los arreglos.
                categorias.push( row.nombre_categoria );
                cantidad.push( row.cantidad );
            });
            // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
            barGraph( 'chart', categorias, cantidad, 'Cantidad de productos', 'Cantidad de productos por categoría' );
        } else {
            $( '#chart' ).remove();
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