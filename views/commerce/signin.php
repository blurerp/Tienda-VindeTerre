<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Registrarse');
?>
<div class="container inner">
  <div class="row ">
    <div class="col-md-4 py-5 bg-primary text-white text-center ">
      <div class=" ">
        <div class="card-body">
          <img src="../../resources/img/register.png" style="width:30%">
          <h2 class="py-3">Crear Cuenta</h2>
          <p>Crea una cuenta en Vin de Terre, el proveedor #1 de vinos en El Salvador, y disfruta de beneficios
            como: Vino exclusivo de la viñera de Chile San Pedro, entre otros...</p>
        </div>
      </div>
    </div>
    <div class="col-md-8 py-5 border">
      <!-- Form de registrarse-->
      <form method="post" class="needs-validation" id="register-form" autocomplete="off" novalidate>
      <input id="g-recaptcha-response" class="invisible" name="g-recaptcha-response"/>
        <div class="form-row m-3">
          <div class="col-md-3 mb-3">
            <label for="nombre_cliente">Usuario</label>
            <!-- Campo usuario-->
            <input id="usuario_cliente" type="text" class="form-control" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,40}" name="usuario_cliente" required>
          </div>
          <div class="col-md-3 mb-3">
            <label for="nombre_cliente">Nombre</label>
            <!-- Campo nombre-->
            <input id="nombre_cliente" type="text" class="form-control" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,40}" name="nombre_cliente" required>
          </div>
          <div class="col-md-3 mb-3">
            <label for="apellido_cliente">Apellidos</label>
            <!-- Campo apellidos-->
            <input id="apellido_cliente" type="text" class="form-control" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,40}" name="apellido_cliente" required>
          </div>
          <div class="col-md-3 mb-3">
            <label for="dui_cliente">DUI</label>
            <!-- Campo Dui-->
            <input id="dui_cliente" type="text" class="form-control" placeholder="00000000-0" pattern="[0-9]{8}[-][0-9]{1}" name="dui_cliente" required>
          </div>
        </div>
        <div class="form-row m-3">
          <div class="col-md-4 mb-3">
            <label for="email_cliente">Email</label>
            <!-- Campo email-->
            <input id="email_cliente" type="text" class="form-control" maxlength="50" name="email_cliente" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="telefono_cliente">Telefóno</label>
            <!-- Campo telefono-->
            <input id="telefono_cliente" type="text" class="form-control" placeholder="0000-0000" pattern="[2,6,7]{1}[0-9]{3}[-][0-9]{4}" name="telefono_cliente" required>
          </div>
          <div class="col-md-3 mb-3">
            <label for="nit_cliente">NIT (opcional)</label>
            <!-- Campo NIT-->
            <input id="nit_cliente" type="text" class="form-control" placeholder="0101-010101-101-1" name="nit_cliente">
          </div>
          <label class="mr-2" for="tipo_cliente">Seleccione Tipo de Cliente:</label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
          
            <label class="btn btn-secondary active">
              <input type="radio" name="tipo_cliente" id="tipo_cliente" value="Persona Natural" checked> Persona Natural
            </label>
            <label class="btn btn-secondary"> 
              <input type="radio" name="tipo_cliente" id="tipo_cliente" value="Empresa"> Empresa
            </label>            
          </div>
        </div>
        <div class="form-row m-3">
          <div class="col-md-4 mb-3">
            <label for="contrasena_cliente">Contraseña</label>
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
          <!-- Campo submit-->
          <button type="submit" name="boton" id="boton" class="btn btn-primary">Registrarte</button>
        </div>
        <div class="form-row m-3">
          <label>
            <small>Al hacer click en Registrarte, aceptas los <a href="terms.php">Terminos y condiciones</a> del servicio</small>
          </label>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?render=6LecoNQZAAAAAAHPv8qNTjXp3bCmcBQpCV5pFmy7"></script>

<?php
Commerce::footerTemplate('signin.js');
?>