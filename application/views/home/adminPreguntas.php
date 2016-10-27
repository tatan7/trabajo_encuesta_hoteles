<div class="container-fluid" ng-controller="adminPreguntas" ng-init="initAdminPregunta()">

<div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{tituloPopUp}}</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
              <label for="preguntaTxt">Escriba el texto de la pregunta</label>
              <input type="email" class="form-control" id="preguntaTxt" name="preguntaTxt" ng-model="preguntaTxt" aria-describedby="emailHelp" placeholder="Sea específico con lo que quiere preguntar">
              <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

        <button type="button" class="btn btn-primary" ng-if="update == 0" ng-click="guardarPregunta()">{{textoBtn}}</button><!-- Guardar-->
        <button type="button" class="btn btn-primary" ng-if="update == 1" ng-click="modificarPregunta()">{{textoBtn}}</button><!-- Actualizar-->

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  <div class="container" style="padding:5% ">
      <table class="table">
          <tr>
            <td colspan="2" align="right">
                <button class="btn btn-primary" ng-click="crearPreguntaPop()">NUEVA PREGUNTA</button>
            </td>
          </tr>
          <tr>
            <!--<th>ID PREGUNTA</th>-->
            <th>PREGUNTA</th>
            <th>ACCIONES</th>
          </tr>
          <?php foreach($preguntas as $p){ ?>
          <tr>
            <!--<td><?php echo $p['IdPregunta'] ?></td>-->
            <td><?php echo $p['Enunciado'] ?></td>
            <td>
                <button class="btn btn-primary glyphicon glyphicon-pencil" ng-click="getDataPreguntaSel(<?php echo $p['IdPregunta'] ?>)"></button>
                <button class="btn btn-danger glyphicon glyphicon-trash" ng-click="borrarPregunta(<?php echo $p['IdPregunta'] ?>)"></button>
            </td>
          </tr>
          <?php } ?>

      </table>
  </div>
</div>