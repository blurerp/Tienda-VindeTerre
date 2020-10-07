<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Iniciar sesión');
?>

    <div class="container inner">
      <div class="row ">
        <div class="col-md-4 py-5 bg-dark text-white text-center ">
          <div class=" ">
            <div class="card-body">
              <img src="../../resources/img/login.png" style="width:30%">
              <h2 class="py-3">Iniciar sesión</h2>
              <p>Inicia sesión o <a href="signin.php">registrate</a> con 1 solo click!</p>
            </div>
          </div>
        </div>
        <div class="col-md-8 py-5 border">
          <!-- Form de inicio de sesión-->
          <form method="post" class="needs-validation" id="session-form" autocomplete="off" novalidate>
            <div class="form-row m-3">
              <div class="col-md-5 mb-3">
                <label for="email_cliente">Correo Electrónico</label>
                <!-- Campo email-->
                <input id="email_cliente" type="email" class="form-control" maxlength="50" name="email_cliente" required>
              </div>
            </div>
            <div class="form-row m-3">
              <div class="col-md-5 mb-3">
                <label for="contrasena_cliente">Contraseña</label>
                <!-- campo contraseña-->
                <input id="contrasena_cliente" type="password" class="form-control" name="contrasena_cliente" required>
              </div>
            </div>
            <div class="form-row m-3">
              <button type="submit" class="btn btn-dark">Iniciar sesión</button>
            </div>
            <div class="form-row m-3">
              <label>
                <a href="resetpassword.php">¿Has olvidado tu contraseña?</a>
              </label>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php
Commerce::footerTemplate('login.js');
?>