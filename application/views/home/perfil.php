<div class="container" ng-controller="ctrlPerfil" ng-init="initPerfil()">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h1>Edicion de Perfil</h1>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="imgPerfil">
						<img src="<?php echo base_url(); ?>/res/img/profile.png">
						<button type="button" class="btn btn-defult" ng-click="quitarImagen()">EditarImagen</button>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<form id="Perfil" role="form" ng-submit="editInfo()">
					  <div class="form-group">
					    <label for="ejemplo_email_1">Usuario</label>
					    <input type="text" class="form-control" id="UsuarioEd"
					           placeholder="Introduce tu nuevo usuario" ng-model="UsuarioEd" name="UsuarioEd">
					  </div>
					  <div class="form-group">
					    <label for="ejemplo_password_1">Contraseña</label>
					    <input type="password" class="form-control" id="PassEdit" 
					           placeholder="Contraseña" ng-model="PassEdit" name="PassEdit">
					  </div>
					  <input type="hidden" value="<?php echo $Session['iDlogin'];?>" name="idUsuario" id="idUsuario"/>
					  <button type="submit" class="btn btn-default">Enviar</button>
					</form>
				</div>
			</div>
		</div>	
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="clear"></div>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<div class="GoBoton">
				<button class="btn btn-danger" ng-click="eliminarPerfil()">Eliminar Cuenta</button>
			</div>
		</div>	
	</div>
</div>