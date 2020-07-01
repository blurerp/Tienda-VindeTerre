// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = '../../core/api/commerce/catalogo.php?action=';
const API_PEDIDOS = '../../core/api/commerce/pedidos.php?action=';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams( location.search );
    // Se obtienen los datos localizados por medio de las variables.
    const ID = params.get( 'id' );
    // Se llama a la función que muestra el detalle del producto seleccionado previamente.
    readOneProducto( ID );
});

// Función para obtener y mostrar los datos del producto seleccionado.
function readOneProducto( id )
{
    $.ajax({
        dataType: 'json',
        url: API_CATALOGO + 'readOne',
        data: { id_producto: id },
        type: 'post'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se muestra un mensaje de error en pantalla.
        if ( response.status ) {
            // Se colocan los datos en la tarjeta de acuerdo al producto seleccionado previamente.
            $( '#imagen' ).prop( 'src', '../../resources/img/productos/' + response.dataset.imagen_producto );
            $( '#nombre_producto' ).text( response.dataset.nombre_producto );
            $( '#descripcion_producto' ).text( response.dataset.descripcion_producto );
            $( '#precio_venta' ).text( response.dataset.precio_venta  );
            $( '#cosecha' ).text( response.dataset.cosecha );
            $( '#alcohol' ).text( response.dataset.alcohol );
            $( '#precio_venta' ).text( response.dataset.precio_venta );
            $( '#val' ).text( response.dataset.puntuacion );
            const starTotal = 5;
            const starPercentage = (response.dataset.puntuacion / starTotal) * 100;
            const starPercentageRounded = `${(Math.round(starPercentage / 10) * 10)}%`;
            document.querySelector(`#valoracion .stars-inner`).style.width = starPercentageRounded; 
            // Se asignan los valores a los campos ocultos del formulario.
            $( '#id_producto' ).val( response.dataset.id_producto );
            $( '#precio_producto_det' ).val( response.dataset.precio_venta );
        } else {
            // Se presenta un mensaje de error cuando no existen datos para mostrar.
            $( '#title' ).html( `<i class="far fa-times-square"></i><span class="text-danger">${response.exception}</span>` );
            // Se limpia el contenido del div sino existen datos para mostrar.
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

// Evento para agregar un producto al carrito de compras.
$( '#shopping-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API_PEDIDOS + 'createDetail',
        data: $( '#shopping-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje.
        if ( response.status ) {
            sweetAlert( 1, response.message, 'cart.php' );
        } else {
            // Se verifica si el usuario ha iniciado sesión para mostrar algún error ocurrido, de lo contrario se direcciona para que se autentique. 
            if ( response.session ) {
                sweetAlert( 2, response.exception, null );
            } else {
                sweetAlert( 3, response.exception, 'login.php' );
            }
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