<!DOCTYPE html>
<html ng-app="Hotel">
<head>
	<title>Hoteles - <?php echo $titulo ?></title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/res/img/favicon.ico" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/jumbotron-narrow.css">-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/morris-0.4.3.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/hoteles.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/sweetalert.css">
	<link rel="stylesheet" href="<?php echo base_url()?>res/font-awesome/css/font-awesome.min.css">
	
</head>
<body>
	<div class="container-fluid cabeza">
		<div class="container">
			<?php $this->load->view($cabeza);?>
		</div>
	</div>
	<?php $this->load->view($centro);?>
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