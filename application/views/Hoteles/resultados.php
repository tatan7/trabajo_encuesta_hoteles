<!DOCTYPE html>
<html ng-app="Hotel">
<head>
	<title>Resultados - <?php echo $titulo ?></title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/res/img/favicon.ico" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/angular-cps.css">
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/jumbotron-narrow.css">-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/morris-0.4.3.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/hoteles.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/css_bootstrap-datetimepicker.css" media="">

</head>
<body  ng-controller="ctrlResultados" ng-init="initRespuesta()">
	<div class="container-fluid cabeza">
		<div class="container">
			<?php $this->load->view($cabeza);?>
		</div>
	</div>
	<div class="container-fluid present">
		<div class="container-fluid ">
		  <div class="container">
		      <div class="jumbotron jbtrn">
				  <h1>Estadísticas</h1>
				  <p class="lead">A continuación verá gráficas y tablas estadísticas que le ayudarán a saber el estado de la encuesta para su hotel. 
				  </p>
				</div>
		  </div>
		</div>
	</div>
	<div class="container-fluid bodyPage ng-cloak" ng-cloak>
		<div class="container padding">
			<div class="row"  style="margin:0 0 5% 0;">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<center><a href="<?php echo base_url(); ?>index/index"><img src="<?php echo base_url() ?>/res/img/<?php echo $inform['Imagenes'] ?>" width="40%"/></a><br><br></center>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<form class="form-inline">
						<fieldset class="form-group" style="margin:0 0 0 5%">
						    <label for="exampleTextarea">Fecha inicial</label><br>
						    <i class="fa fa-calendar" aria-hidden="true"></i> 
						    <input  type="text" class="form-control boxDate"  ng-model="fechaIni" id="fechaIni" placeholder="Fecha inicial" value="<?php echo date("Y-m-01") ?>">
						</fieldset>
						<fieldset class="form-group" style="margin:0 0 0 5%">
						    <label for="exampleTextarea"></i> Fecha final</label><br>
						    <i class="fa fa-calendar" aria-hidden="true"></i> 
						    <input  type="text" class="form-control boxDate"  ng-model="fechaFin" id="fechaFin" placeholder="Fecha Final" value="<?php echo date("Y-m-d") ?>">
						    <button class="btn btn-primary" ng-click="buscarRes()">Buscar</button>
						</fieldset>
						
					</form>
				</div>	
			</div>
				<div class="row" ng-repeat="Pre in Preguntas"  style="margin:0 0 2% 0;">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					  	<h4><center><strong>{{ Pre.NombrePregunta }}</strong></center></h4>
					    <div >
					    	<div id="morris-area-tree{{ Pre.idPregunta }}">
					    		
					    	</div>
					    </div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<table class="table">
							<tr>
								<th class="text-center" colspan="3">TABLA RESPUESTAS</th>
							</tr>
							<tr>
								<th class="text-left">CALIFICACION</th>
								<th class="text-center">%</th>
								<th class="text-center">CANT</th>
							</tr>
							<tr ng-repeat="pre2 in Pre.datos">
								<td class="text-left"><a class="btn-link btn" ng-click="getPersons(Pre.idPregunta,pre2.calificacion)">{{pre2.label}}</a></td>
								<td class="text-center">{{pre2.value | number}}%</td>
								<td class="text-center">{{pre2.cantidad | number}}</td>
							</tr>
						</table>
					</div>
				</div>
			<div class="reportes">
				<center>
				<a class="btn btn-success" ng-click="exportaExcel('<?php echo base_url(); ?>index/ExportExel/<?php echo $inform['idHotel']; ?>')"><i class="fa fa-file-excel-o fa-lg"></i>  Reporte global</a>
				<a class="btn btn-success" ng-click="exportaExcel('<?php echo base_url(); ?>index/ExportExelPersona/<?php echo $inform['idHotel']; ?>')"><i class="fa fa-file-excel-o fa-lg"></i>  Reporte detallado</a>
				</center>
			</div>
			<script type="text/javascript">
				var idHotelR = "<?php echo $inform['idHotel']; ?>"
			</script>
		</div>
	</div>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript">
		var configLogin =  {
		    appName: 'Tu comunidad Login',
		    appVersion: 1.0,
		    apiUrl: '<?php echo base_url()?>'
		}
	</script>
</body>
</html>