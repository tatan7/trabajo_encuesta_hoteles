<!DOCTYPE html>
<html ng-app="Hotel">
<head>
	<title>Login - Encuestas</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/res/img/favicon.ico" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/angular-cps.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/morris-0.4.3.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/login.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/sweetalert.css">
	<link rel="stylesheet" href="<?php echo base_url()?>res/font-awesome/css/font-awesome.min.css">
</head>
<body ng-controller="ctrlLogin">
	<div class="container" ng-init="innitLogin()">

	  <form id="LoginForm" class="form-signin" ng-submit="login()">
	    <h2 class="form-signin-heading"><center><i class="logo fa fa-area-chart fa-3x" aria-hidden="true"></i></center><p>Gestion de Encuestas</p></h2>

	    <label for="usuario" class="sr-only">Usuario</label>
	    <input type="text" id="usuario" name="usuario" ng-model="usuario" class="form-control" placeholder="usuario" autofocus>
	    <label for="clave" class="sr-only">Clave</label>
	    <input type="password" id="clave" name="clave" ng-model="clave" class="form-control" placeholder="Clave">
	    <div class="checkbox">
	    </div>
	    <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
	  		<div class="alert alert-danger" ng-show="errorDv" ng-cloak class="ng-cloak">
			  <strong>Error!</strong> {{ mensaje }}
			</div>
	  </form>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/raphael-2.1.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/morris.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/angular.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/Acciones.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/login.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/moment.min.js"></script>
	<script type="text/javascript">
		var configLogin =  {
		    appName: 'Tu comunidad Login',
		    appVersion: 1.0,
		    apiUrl: '<?php echo base_url()?>'
		}
	</script>
</body>
</html>