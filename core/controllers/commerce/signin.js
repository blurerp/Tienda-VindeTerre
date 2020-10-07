// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTES = '../../core/api/commerce/clientes.php?action=';

$( document ).ready(function() {
    // Método para generar el token del reCAPTCHA.
    grecaptcha.ready(function() {
        // Se declara e inicializa una variable para guardar la llave pública del reCAPTCHA.
        let publicKey = '6LecoNQZAAAAAAHPv8qNTjXp3bCmcBQpCV5pFmy7';
        // Se obtiene un token para la página web mediante la llave pública.
        grecaptcha.execute( publicKey, { action: 'homepage' } )
        .then(function( token ) {
            // Se asigna el valor del token al campo oculto del formulario
            $( '#g-recaptcha-response' ).val( token );
        });
    });
});

// Evento para realizar el registro de un cliente.
$( '#register-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API_CLIENTES + 'register',
        data: $( '#register-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            sweetAlert( 1, response.message, 'login.php' );
        } else {
            sweetAlert( 2, response.exception, null );
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