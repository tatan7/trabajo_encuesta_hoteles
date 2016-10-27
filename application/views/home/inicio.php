
<div class="container-fluid present">
    <div class="container">
        <div class="jumbotron jbtrn">
        <h1>Bienvenido!</h1>
        <p class="lead">M&oacute;dulo de satisfacci&oacute;n del usuario. 
        <br>Mediremos la experiencia del hu&eacute;sped dentro de los hoteles por medio de una encuesta.
        </p>
      </div>
    </div>
</div> 

<div class="container padding">  
    <div class="row marketing">
      <?php foreach ($Datain as $key => $value) { ?>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 HoSpace">
          <h3><strong><?php echo $value['NombreHotel']; ?></strong></h3>
          <img src="<?php echo base_url(); ?>res/img/<?php echo $value['Imagenes'] ?>" alt="Hoteles imagenes" class="img-thumbnail">
          <div class="clear"></div>
          <!--<p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>--><br>
          <center>
          <a class="btn btn-primary" href="<?php echo base_url() ?>index/hoteles/<?php echo $value['idHotel'] ?>">VER ENCUESTA</a>
          <a class="btn btn-success" href="<?php echo base_url(); ?>index/Resultados/<?php echo $value['idHotel'] ?>">RESULTADOS</a>
          </center>
        </div>  
      <?php } ?>
    </div>
</div>