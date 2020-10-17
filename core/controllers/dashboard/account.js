const API = '../../core/api/dashboard/usuarios.php?action=';

function checkUsuarios() {
    $.ajax({
        dataType: 'json',
        url: API + 'readAll'

    })
        .done(function (response) {

            let current = window.location.pathname;

            if (current == '/Tienda-VindeTerre/views/dashboard/register.php') {
                
                if (response.status) {
                    sweetAlert(3, response.message, 'index.php');
                } else {
                    sweetAlert(4, 'Debe crear un usuario', null);
                }

            } else {
                
                if (response.status) {
                    sweetAlert(4, 'Debe autenticarse para ingresar', null);
                } else {
                    sweetAlert(3, response.exception, 'register.php');
                }
            }
        })
        .fail(function (jqXHR) {
            if (jqXHR.status == 200) {
                console.log(jqXHR.responseText);
            } else {
                console.log(jqXHR.status + ' ' + jqXHR.statusText);
            }
        });
}
    //Funcion de cerrar sesión de usuario.
    function signOff() {
        swal({
            title: 'Advertencia',
            text: '¿Quiere cerrar la sesión?',
            icon: 'warning',
            buttons: ['Cancelar', 'Aceptar'],
            closeOnClickOutside: false,
            closeOnEsc: false
        })
            .then(function (value) {
                // Se verifica si fue cliqueado el botón Aceptar para hacer la petición de cerrar sesión, de lo contrario se continua con la sesión actual.
                if (value) {
                    $.ajax({
                        dataType: 'json',
                        url: API + 'logout'
                    })
                        .done(function (response) {
                            // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
                            if (response.status) {
                                sweetAlert(1, response.message, 'index.php');
                            } else {
                                sweetAlert(2, response.exception, null);
                            }
                        })
                        .fail(function (jqXHR) {
                            // Se verifica si la API ha respondido para mostrar la respuesta, de lo contrario se presenta el estado de la petición.
                            if (jqXHR.status == 200) {
                                console.log(jqXHR.responseText);
                            } else {
                                console.log(jqXHR.status + ' ' + jqXHR.statusText);
                            }
                        });
                } else {
                    sweetAlert(4, 'Puede continuar con la sesión', null);
                }
            });
    }
    //Funcion de cerrar sesión de usuario por inactividad.
    function signOffInactivity() {
        swal({
            title: 'Advertencia',
            text: 'La sesion se cerrara por inactividad, por favor inicie session de nuevo',
            icon: 'warning',            
            closeOnClickOutside: false,
            closeOnEsc: false
        })
            .then(function (value) {
                // Se verifica si fue cliqueado el botón Aceptar para hacer la petición de cerrar sesión, de lo contrario se continua con la sesión actual.
                if (value) {
                    $.ajax({
                        dataType: 'json',
                        url: API + 'logout'
                    })
                        .done(function (response) {
                            // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
                            if (response.status) {
                                sweetAlert(1, response.message, 'index.php');
                            } else {
                                sweetAlert(2, response.exception, null);
                            }
                        })
                        .fail(function (jqXHR) {
                            // Se verifica si la API ha respondido para mostrar la respuesta, de lo contrario se presenta el estado de la petición.
                            if (jqXHR.status == 200) {
                                console.log(jqXHR.responseText);
                            } else {
                                console.log(jqXHR.status + ' ' + jqXHR.statusText);
                            }
                        });
                } else {
                    sweetAlert(4, 'Puede continuar con la sesión', null);
                }
            });
    }

    // Función para mostrar el formulario de editar perfil con los datos del usuario que ha iniciado sesión.
$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar los campos. Se encuentra en el archivo components.js
    $.ajax({
        dataType: 'json',
        url: API + 'readProfile'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se inicializan los campos del formulario con los datos del usuario que ha iniciado sesión.
            $( '#usuario' ).val( response.dataset.usuario );
            $( '#nombre_usuario' ).val( response.dataset.nombre_usuario );
            $( '#apellido_usuario' ).val( response.dataset.apellido_usuario);
            $( '#fecha_nacimiento' ).val( response.dataset.fecha_nacimiento);
            $( '#dui_usuario' ).val( response.dataset.dui_usuario);
            $( '#email_usuario' ).val( response.dataset.email_usuario );
            
            // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
            
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


// Evento para editar el perfil del usuario que ha iniciado sesión.
$( '#profile-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API + 'editProfile',
        data: $( '#profile-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se cierra la caja de dialogo (modal) que contiene el formulario para editar perfil, ubicado en el archivo de las plantillas.
            
            sweetAlert( 1, response.message, 'main.php' );
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

// Evento para cambiar la contraseña del usuario que ha iniciado sesión.
$( '#password-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API + 'password',
        data: $( '#password-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se cierra la caja de dialogo (modal) que contiene el formulario para cambiar contraseña, ubicado en el archivo de las plantillas.
            $( '#password-modal' ).modal( 'close' );
            sweetAlert( 1, response.message, null );
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




/**
 * Document   : Auto Logout Script
 * Description: Force a logout automatically after a certain amount of time using HTML/JQuery/PHP. 

*/


$(function()
{

    function timeChecker()
    {
        setInterval(function()
        {
            var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");  
            timeCompare(storedTimeStamp);
        },3000);
    }


    function timeCompare(timeString)
    {
        var maxMinutes  = 0.10;  //GREATER THEN 1 MIN.
        var currentTime = new Date();
        var pastTime    = new Date(timeString);
        var timeDiff    = currentTime - pastTime;
        var minPast     = Math.floor( (timeDiff/10000) ); 

        if( minPast > maxMinutes)
        {
            sessionStorage.removeItem("lastTimeStamp");
            signOffInactivity();
            
            return false;
        }else
        {
            //JUST ADDED AS A VISUAL CONFIRMATION
            console.log(currentTime +" - "+ pastTime+" - "+minPast+" min past");
        }
    }

    if(typeof(Storage) !== "undefined") 
    {
        $(document).mousemove(function()
        {
            var timeStamp = new Date();
            sessionStorage.setItem("lastTimeStamp",timeStamp);
        });

        timeChecker();
    }  
});//END JQUERY

