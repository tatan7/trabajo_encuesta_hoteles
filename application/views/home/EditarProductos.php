<div class="container" ng-controller="Principal" ng-init="initPrinicipal()">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-1 col-md-4 col-sm-12 col-xs-12">
		<h3>Agregar Nuevo Producto </h3>
		    <div class="alert alert-danger" ng-show='divError'>
		    	<strong>Atenci&oacute;n!</strong><br>{{ msgError }}.
		    </div>
			<form role="form" id="Productos" ng-submit="AgregarPro()">
			  <div class="form-group">
			    <label for="Titulo">Titulo</label>
			    <input type="text" class="form-control" id="Titulo" name="Titulo"  ng-model="Titulo" placeholder="Introduce tu email">
			  </div>
			  <div class="form-group">
			    <label for="Desc">Descripcion</label>
			    <textarea type="text" class="form-control" id="Desc"  name="Desc"  ng-model="Desc" placeholder="Contraseña"></textarea>
			  </div>
			  <div class="form-group">
			    <label for="precio">Precio</label>
			    <input type="number" class="form-control" id="precio"  name="precio"  ng-model="precio" placeholder="Contraseña">
			  </div>
			  <button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
		<div class="col-lg-6 col-lg-offset-1 col-md-6 col-sm-12 col-xs-12">
			<h3>Editar Un producto</h3>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" ng-repeat="pro in Productos">
					<div class="ProductosMos">
						<h4>{{ pro.Titulo }}</h4>
						<div class="clear"></div>
						<div class="botones">
							<button ng-click="EliminarP(pro.idProducto)" class="btn btn-danger">Eliminar</button> 
							<a class="btn btn-success" href="<?php echo base_url() ?>index/EditProduct/{{pro.idProducto}}">Editar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 100px;"></div>
</div>