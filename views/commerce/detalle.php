<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Detalles del producto');
?>
<div class="container">
	<div class="card">
		<div class="row" id="detalle">
			<aside class="col-sm-5 border-right">
				<img id="imagen" class="d-block w-100" src="../../resources/img/unknown.png" height="500">
			</aside>
			<aside class="col-sm-7">
				<article class="card-body p-5">
					<h3 id="nombre_producto" class="title mb-3"></h3>
					<p class="price-detail-wrap">
						<span class="price h3 text-warning">
							<span class="currency">$</span><span id="precio_venta" class="num"></span>
						</span>
					</p>
					<dl class="item-property">
						<dt>Descripción</dt>
						<dd>
							<p id="descripcion_producto"></p>
						</dd>
					</dl>
					<dl class="param param-feature">
						<dt>Cosecha</dt>
						<dd id="cosecha"></dd>
					</dl>
					<dl class="param param-feature">
						<dt>Alcohol (%)</dt>
						<dd id="alcohol"></dd>
					</dl>
					<dl class="param param-feature">
						<dt>Valoración: <h2 id="val"></h2></dt>
						<dd id="valoracion">
							<div class="stars-outer">
								<div class="stars-inner"></div>								
							</div>
						</dd>
					</dl>
					<hr>
					<form method="post" id="shopping-form">
						<input type="number" id="id_producto" name="id_producto" class="invisible"/>
                        <input type="number" id="precio_producto_det" name="precio_producto_det" step="0.01" class="invisible"/>
						<p class="font-weight-bold ml-3">Cantidad</p>
						<div class="input-group">
							<div class="row">
								<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="cantidad_detalle">
									<i class="far fa-minus-square"></i>
								</button>
								<div class="col-md-4">									
									<input type="text" name="cantidad_detalle" id="cantidad_detalle " class="form-control input-number" value="1" min="1" max="1000">									
								</div>
								<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="cantidad_detalle">
									<i class="far fa-plus-square"></i>
								</button>
							</div>							
						</div>  						
						<hr>
						<button type="submit" class="btn btn-lg btn-outline-primary text-uppercase"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>					
					</form>					
				</article>
			</aside>
		</div>
	</div>
</div>

<?php
Commerce::footerTemplate('detalle.js');
?>