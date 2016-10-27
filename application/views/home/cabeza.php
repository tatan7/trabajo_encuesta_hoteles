<div class="header clearfix">
	<nav>
	  <ul class="nav nav-pills pull-right">
	    <!--<li role="presentation" class="active"><a href="<?php echo base_url(); ?>index/index">Inicio</a></li>-->

	    <li class="dropdown text-primary menuDesp">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	         	<?php echo $_SESSION['Hoteles']['Nombre']." ".$_SESSION['Hoteles']['Apellido'] ?> <b class="glyphicon glyphicon-user text-primary"></b>  <b class="caret text-primary"></b>
	        </a>
	        <ul class="dropdown-menu">
	          <li style="text-align: right"  class="cerrarSession">
	          	<a href="<?php echo base_url()?>index/adminPreguntas">Administrar preguntas</a>
	          </li>
	          <li style="text-align: right"  class="cerrarSession">
	          	<a href="<?php echo base_url()?>index/logout">Cerrar Sesión</a>
	          </li>
 	        </ul>
      	</li>



	  </ul>
	</nav>
	<a href="<?php echo base_url(); ?>index/index" class="Logo">
		<h3> <i class="fa fa-area-chart" aria-hidden="true"></i> Gestión de encuestas</h3>
	</a>
</div>