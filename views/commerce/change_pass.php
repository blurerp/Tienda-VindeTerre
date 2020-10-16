<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Actualizar Credenciales');
?>

    <div class="container inner">
      <div class="row ">
        <div class="col-md-4 py-5 bg-dark text-white text-center ">
          <div class=" ">
            <div class="card-body">
              <img src="../../resources/img/login.png" style="width:30%">
              <h2 class="py-3">Precaución</h2>
              <p>Por motivos de seguridad debes actualizar tu contraseña para continuar; esto con el motivo de brindarte un mejor servicio</p>
            </div>
          </div>
        </div>
        <div class="col-md-8 py-5 border">
          <!-- Form de inicio de sesión-->
          <form method="post" class="needs-validation" id="session-form" autocomplete="off" novalidate>
            <div class="form-row m-3">
                <div class="col-md-4 mb-3">
                    <label for="contrasena_cliente">Nueva Contraseña</label>
                    <!-- Campo contraseña-->
                    <input id="contrasena_cliente" type="password" class="form-control" name="contrasena_cliente" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="confirmar_contrasena">Confirmar contraseña</label>
                    <!-- Campo confirmar contraseña-->
                    <input id="confirmar_contrasena" type="password" class="form-control" name="confirmar_contrasena" required>
                </div>
            </div>
            <div class="form-row m-3">
              <button type="submit" class="btn btn-dark">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php
Commerce::footerTemplate('login.js');
?>