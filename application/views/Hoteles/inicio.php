<!DOCTYPE html>
<html ng-app="Hotel">
<head>
	<title>Resultados - <?php echo $titulo ?></title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/res/img/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/angular-cps.css">
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/jumbotron-narrow.css">-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/morris-0.4.3.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/hoteles.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/sweetalert.css">
	<link rel="stylesheet" href="<?php echo base_url()?>res/font-awesome/css/font-awesome.min.css">
</head>
<body  ng-controller="ctrlPreguntas" ng-init="initPreguntas()">

	<div class="container-fluid">
		<div class="container-fluid ">
		  <div class="container">
			<div class="row">
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			  <br><br>
				<center><a href="<?php echo base_url(); ?>index/index"><img src="<?php echo base_url() ?>/res/img/<?php echo $inform['Imagenes'] ?>" width="30%"/></a><br><br></center>
			  </div>
		  	</div>
		 </div>
		</div>
	</div>
<div class="container-fluid padding ng-cloak" ng-cloak>
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			
			<div class="alert alert-info text-center">
				Indique su respuesta teniendo en cuenta que: / Indicate your answer considering that:
				<br><br>
				<ol>
					<li  style="display: inline;margin: 0 2% 0 0;"><small> 1 = Malo / Bad </small></li>
					<li  style="display: inline;margin: 0 2% 0 0;"><small> 2 = Regular / Regular </small></li>
					<li  style="display: inline;margin: 0 2% 0 0;"><small> 3 = Aceptable / Acceptable </small></li>
					<li  style="display: inline;margin: 0 2% 0 0;"><small> 4 = Bueno / Good </small></li>
					<li  style="display: inline;margin: 0 2% 0 0;"><small> 5 = Excelente / Excellent </small></li>
				</ol>
			</div>
				
				<div class="alert alert-danger" ng-show="divErro" >
					<strong>Alto!</strong>{{ mensaje }}
				</div>
				<form id="Respuesta" role="form" ng-submit="Respuesta()">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
						    <label for="Nombre">Nombre / Name</label>
						    <input type="text" class="form-control" id="Nombre" ng-model="Nombre" name="Nombre"
						           placeholder="Introduce tu nombre">
						  </div>
						  <div class="form-group">
						    <label for="habitacion">Habitaci&oacute;n / Room</label>
						    <input type="text" class="form-control" id="habitacion" ng-model="habitacion" name="habitacion" placeholder="Introduce tu habitacion">
						  </div>
					</div>
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="SpaceQuestion preguntas " ng-repeat="Pre in Preguntas" rel="{{Pre.IdPregunta}}" >
					  <h4><strong>{{ Pre.Enunciado }}</strong></h4>
					  
					    <label class="radio-inline">
					      <input type="radio" value="1" name="califica{{Pre.IdPregunta}}" id="califica{{Pre.IdPregunta}}" ng-model="calificaPre.IdPregunta" class="res{{Pre.IdPregunta}} califica{{$index}}"> 1
					    </label>
					    <label class="radio-inline">
					      <input type="radio" value="2" name="califica{{Pre.IdPregunta}}" id="califica{{Pre.IdPregunta}}" ng-model="calificaPre.IdPregunta" class="res{{Pre.IdPregunta}} califica{{$index}}" > 2
					    </label>
					    <label class="radio-inline">
					      <input type="radio" value="3" name="califica{{Pre.IdPregunta}}" id="califica{{Pre.IdPregunta}}" ng-model="calificaPre.IdPregunta" class="res{{Pre.IdPregunta}} califica{{$index}}" > 3
					    </label>
					    <label class="radio-inline">
					      <input type="radio" value="4" name="califica{{Pre.IdPregunta}}" id="califica{{Pre.IdPregunta}}" ng-model="calificaPre.IdPregunta" class="res{{Pre.IdPregunta}} califica{{$index}}" > 4
					    </label>
					    <label class="radio-inline">
					      <input type="radio" value="5" name="califica{{Pre.IdPregunta}}" id="califica{{Pre.IdPregunta}}" ng-model="calificaPre.IdPregunta" class="res{{Pre.IdPregunta}} califica{{$index}}" > 5
					    </label>
					    <div class="clear"></div>
					    <br><br>
						<label>Observaciones / observations</label>
						<textarea class="form-control observacion{{Pre.IdPregunta}}" rows="3" cols="1" name="Observa{{Pre.IdPregunta}}" id="Observa{{Pre.IdPregunta}}" ng-model="Observa.IdPregunta"></textarea>
					</div>
				  </div>
				</div>

					<div class="EnviarButton">
				  		<button ng-show="BotonSubmit" type="submit" class="btn btn-primary">Enviar encuesta</button>
					</div>
				</form>

			</div>
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
		</div>

		
	</div>
</div>


<script type="text/javascript">
	var idHotel = "<?php echo $inform['idHotel']; ?>"
</script>
	<?php $this->load->view($pie);?>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/raphael-2.1.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/morris.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/angular.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/Acciones.js"></script>
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









