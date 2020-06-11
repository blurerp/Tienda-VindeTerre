<?php
require_once('../../core/helpers/template.php');
Dashboard::headerTemplate('Iniciar sesión');
?>
<div id="content" class="container-fluid p-5">  
    <div class="row justify-content-center">
      <div class="col">
        <div class="jumbotron text-center">          
          <h1 class="display-5">¡Bienvenido Administrador!</h1>
          <hr class="my-4">                  
        </div>
      </div>
    </div>  
</div>
<section class="py-3">
  <div class="row">
    <div class="col-xl-3 col-lg-6">
      <div class="card border-0 shadow-sm shadow-hover">
        <div class="card-body d-flex">
          <div>
            <div class="circle bg-primary rounded-circle d-flex align-self-center mr-3">
              <i class="far fa-shopping-bag text-primary align-self-center mx-auto lead"></i>
            </div>
          </div>
          <div>
            <h5 class="mb-0">3200</h5>
            <small class="text-muted">Ordenes</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card border-0 shadow-sm shadow-hover">
        <div class="card-body d-flex">
          <div>
            <div class="circle bg-primary rounded-circle d-flex align-self-center mr-3">
              <i class="far fa-file-invoice-dollar text-primary align-self-center mx-auto lead"></i>
            </div>
          </div>
          <div>
            <h5 class="mb-0">3200</h5>
            <small class="text-muted">Recibos</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card border-0 shadow-sm shadow-hover">
        <div class="card-body d-flex">
          <div>
            <div class="circle bg-primary rounded-circle d-flex align-self-center mr-3">
              <i class="far fa-user-friends text-primary align-self-center mx-auto lead"></i>
            </div>
          </div>
          <div>
            <h5 class="mb-0">3200</h5>
            <small class="text-muted">Clientes</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card border-0 shadow-sm shadow-hover">
        <div class="card-body d-flex">
          <div>
            <div class="circle bg-primary rounded-circle d-flex align-self-center mr-3">
              <i class="far fa-cubes text-primary align-self-center mx-auto lead"></i>
            </div>
          </div>
          <div>
            <h5 class="mb-0">3200</h5>
            <small class="text-muted">Productos</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>
</div>
<?php
Dashboard::footerTemplate('index.js');
?>