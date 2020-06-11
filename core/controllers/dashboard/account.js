const API = '../../core/api/dashboard/usuarios.php?action=';

function checkUsuarios() {
    $.ajax({
        dataType: 'json',
        url: API + 'readAll'

    })
        .done(function (response) {

            let current = window.location.pathname;

            if (current == '/Tienda-vindeterre/views/dashboard/register.php') {
                
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

}