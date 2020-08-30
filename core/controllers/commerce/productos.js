// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = '../../core/api/commerce/catalogo.php?action=';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams( location.search );
    // Se obtienen los datos localizados por medio de las variables.
    const ID = params.get( 'id' );
    const NAME = params.get( 'nombre' );
    // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    readProductosCategoria( ID, NAME );
});

/*
    const starTotal = 5;
    for(const rating in ratings) {  
    // 2
    const starPercentage = (ratings[rating] / starTotal) * 100;
    // 3
    const starPercentageRounded = `${(Math.round(starPercentage / 10) * 10)}%`;
    // 4
    document.querySelector(`.${rating} .stars-inner`).style.width = starPercentageRounded; 
    }
*/

// Función para obtener y mostrar los productos de acuerdo a la categoría seleccionada.
function readProductosCategoria( id, categoria )
{    
    $.ajax({
        dataType: 'json',
        url: API_CATALOGO + 'readProductosCategoria',
        data: { id_categoria: id },
        type: 'post'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se muestra un mensaje de error en pantalla.
        if ( response.status ) {
            let content = '';
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se crean y concatenan las tarjetas con los datos de cada producto.
                content += `                    
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../../resources/img/productos/${row.imagen_producto}" height="300">
                            <div class="card-body">
                                <p class="card-title text-center">${row.nombre_producto}</p>
                                <h5 class="card-text text-center">$${row.precio_venta}</h5>
                                <p class="text-center"><a class="btn btn-success mt-3" href="detalle.php?id=${row.id_producto}" role="button">Comprar</a></p>                                                                                                                
                            </div>
                        </div>
                    </div>                     
                `;
            });
            
            // Se asigna como título la categoría de los productos.
            $( '#title' ).text( `Categoría: ${categoria}` );
            // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar los productos.
            $( '#productos' ).html( content );
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