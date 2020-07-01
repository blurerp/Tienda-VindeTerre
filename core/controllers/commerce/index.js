// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = '../../core/api/commerce/catalogo.php?action=';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se llama a la función que muestra las categorías disponibles.
    readAllCategorias();
});

// Función para obtener y mostrar las categorías disponibles.
function readAllCategorias()
{
    $.ajax({
        dataType: 'json',
        url: API_CATALOGO + 'readAll'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se muestra un mensaje de error en pantalla.
        if ( response.status ) {
            let content = '';
            let url = '';
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se define una dirección con los datos de cada categoría para mostrar sus productos en otra página web.
                url = `productos.php?id=${row.id_categoria}&nombre=${row.categoria}`;
                // Se crean y concatenan las tarjetas con los datos de cada categoría.
                content += `
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-info mb-3" style="max-width: 18rem;">
                            <img class="card-img-top" src="../../resources/img/categorias/${row.imagen_categoria}" height="300">
                            <div class="card-body text-dark">
                                <h5 class="card-title">${row.categoria}</h5>
                                <a href="${url}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>               
                `;
            });
            // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar las categorías.
            $( '#categorias' ).html( content );
            // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
            $( '.tooltipped' ).tooltip();
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