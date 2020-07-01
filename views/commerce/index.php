<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Tu tienda de café');
?>
<div id="carrusel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carrusel" data-slide-to="0" class="active"></li>
        <li data-target="#carrusel" data-slide-to="1"></li>
        <li data-target="#carrusel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="../../resources/img/slider/image1.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Vino Premiums</h5>
                <p>Tenemos los mejores vinos importados desde Chile</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="../../resources/img/slider/img02.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Beneficios para la salud Tomando Vino!</h5>
                <p>¿Sabías que el vino retarda el envejecimiento además de limpiar nuestro paladar y potenciar nuestro cerebro?</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="../../resources/img/slider/img03.png" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>No lo pienses más</h5>
                <p>El elixir de la vida Vin de Terre</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carrusel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carrusel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>
<hr class="my-4 bg-info">
<div class="container">
    <!-- Título para la página web -->
    <h3 class="font-weight-italic text-primary text-center my-4" id="title">Categorias de vinos</h3>
    <!-- Fila para mostrar las categorías disponibles -->
    <div class="row" id="categorias"></div>
</div>

<?php
Commerce::footerTemplate('index.js');
?> 