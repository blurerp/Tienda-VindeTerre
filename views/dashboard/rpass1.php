<?php
require_once('../../core/helpers/template.php');
Dashboard::headerLogin('Recuperar cuenta');
?>
<div id="background"></div>
<div id="container">
  <div class="box">
    <div class="container inner">
      <div class="row p1">
        <div class="col">
          <div id="logo">
            <img src="../../resources/img/logo.png">
          </div>
          <h3 class="text-center">Recuperar Contraseña</h3>
          <form method="post" class="needs-validation" id="recover-form-1" autocomplete="off" novalidate>
            <div class="input-group input-focus mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="far fa-user-alt"></i></span>
              </div>
              <input name="r_email_usuario" id="email_usuario" type="email" placeholder="Email" class="form-control border-left-0" required>
            </div>

            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-primary col-12 text-white" style="margin-bottom: 20px;">Ingresar</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row p2">
        <div class="col">
          <div id="logo">
            <img src="../../resources/img/logo.png">
          </div>
          <h3 class="text-center">Codigo de Confirmación</h3>
          <form method="post" class="needs-validation" id="recover-form-2" autocomplete="off" novalidate>
            <div class="input-group input-focus mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="far fa-key"></i></span>
              </div>
              <input name="codigo_pass_usuario" id="codigo_pass_usuario" type="text" placeholder="Codigo" class="form-control border-left-0" required>
            </div>

            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-primary col-12 text-white" style="margin-bottom: 20px;">Confirmar</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row p3">
        <div class="col">
          <div id="logo">
            <img src="../../resources/img/logo.png">
          </div>
          <h3 class="text-center">Nueva contraseña</h3>
          <form method="post" class="needs-validation" id="recover-form-3" autocomplete="off" novalidate>

            <div class="input-group input-focus mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="far fa-key"></i></span>
              </div>
              <input name="r_clave_1" id="r_clave_1" type="password" placeholder="Contraseña" class="form-control border-left-0" required>
            </div>
            <div class="input-group input-focus mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="far fa-key"></i></span>
              </div>
              <input name="r_clave_2" id="r_clave_2" type="password" placeholder="Confirmar contraseña" class="form-control border-left-0" required>
            </div>

            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-primary col-12 text-white" style="margin-bottom: 20px;">Confirmar</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
Dashboard::footerTemplate('recoverPass.js');
?>