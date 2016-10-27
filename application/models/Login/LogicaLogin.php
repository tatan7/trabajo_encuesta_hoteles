<?php 
class LogicaLogin  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("Login/DbLogin","loginDb");
        //$this->ci->load->library('securimage');
    } 
    public function getLogin($data)
    {
    	extract($data);
        //var_dump($data);die();
    	$where['Usuario'] 	= $usuario;
    	$where['Clave'] 	= sha1($clave);
    	$where['eliminado'] = 1;
    	$dataLogin	=	$this->ci->loginDb->ConsultaUsuario($where);
    	if(count($dataLogin) > 0)//hay información del usuario logueado
    	{
    		//en este momento debo inicia la session del usuario
    		$_SESSION['Hoteles']	=	$dataLogin[0];
			$salida = array("mensaje"=>"Usuario correcto",
							"data"=>$dataLogin,
							"continuar"=>1);
    	}
    	else
    	{
           $salida = array("mensaje"=>"Usuario o contraseña incorrectos, por favor verifique de nuevo.",
                        "data"=>array(),
                        "continuar"=>0);
    	}
    	return $salida;
    }
    public function getHoteles($idHotel=""){
        $where['Eliminado'] = 0;
        if($idHotel != ""){
            $where['idHotel'] = $idHotel;
        }
        //var_dump($where);die();
        $data = $this->ci->loginDb->ConsultarHoteles($where);
        if(count($data) > 0){
            $salida = array("mensaje"=>"Data hoteles",
                            "data"=>$data,
                            "continuar"=>1);
        }else{
            $salida = array("mensaje"=>"No hay data",
                            "data"=>0,
                            "continuar"=>1);
        }
        return $salida;
    }
    public function GetPreguntas($data){
        extract($data);
        //var_dump($data);die();
        $where['Eliminado'] = $Eliminado;
        $where['Hotel']     = $idHotel;
        //var_dump($where);die();
        $data = $this->ci->loginDb->ConsultaQuest($where);
        if(count($data) > 0){
            $salida = array("mensaje"=>"Data Preguntas",
                            "data"=>$data,
                            "continuar"=>1);
        }else{
            $salida = array("mensaje"=>"No hay data",
                            "data"=>0,
                            "continuar"=>0);
        }
        return $salida;
    }
    public function InsertEncuesta($data){
        extract($data);
        //var_dump($data);die();
        $info['idHotel']        = $idHotel;
        $info['idPregunta']     = $idPregunta;
        $info['nombre']         = $Nombre;
        $info['habitacion']     = $habitacion;
        $info['calificacion']   = $calificacion;
        $info['Observacion']    = $Observa;
        $info['fechaRegistro']  = date("Y-m-d H:i:s");
        $info['fecha']          = date("Y-m-d");
        $info['ip']             = getIP();

        $Inser = $this->ci->loginDb->InsertaEncuesta($info);
        if(count($Inser) > 0){
            $salida = array("mensaje"=>"Encuesta finalizada, con exito",
                            "data"=>$Inser,
                            "continuar"=>1);
        }else{
            $salida = array("mensaje"=>"Error de insercion de respuesta",
                            "data"=>0,
                            "continuar"=>0);
        }
        return $salida;
    }
    public function getRespuesta($data){
        extract($data);
        //var_dump($data);die();
        $opciones[0]['label'] = "Malo";
        $opciones[0]['id']    = "1";
        $opciones[1]['label'] = "Regular";
        $opciones[1]['id']    = "2";
        $opciones[2]['label'] = "Aceptable";
        $opciones[2]['id']    = "3";
        $opciones[3]['label'] = "Bueno";
        $opciones[3]['id']    = "4";
        $opciones[4]['label'] = "Excelente";
        $opciones[4]['id']    = "5";
        $Porcentaje = 100;
        $DataTotal      = array();
        $where['Eliminado'] = 0;
        $where['hotel']   = $idHotel;
        $Consulta = $this->ci->loginDb->ConsultaQuest($where);
        foreach ($Consulta as $value) {

            //var_dump($Consulta);die();
            $CantWhere['idPregunta'] = $value['IdPregunta'];
            $CantWhere['idHotel']    = $idHotel;
            $CantWhere['fecha >=']      = $fechaIni;
            $CantWhere['fecha <=']      = $fechaFin;
            $CantWhere['Eliminado']  = 0;

            $CantidadPersonas = $this->ci->loginDb->getCantidadPersonas($CantWhere);
            //var_dump($CantidadPersonas);//
            $datosOpciones = array();
            for ($i=0; $i < count($opciones); $i++) { 
                $whereQUest['idPregunta']   = $value['IdPregunta'];
                $whereQUest['calificacion'] = $opciones[$i]['id'];
                $whereQUest['idHotel']      = $idHotel;
                $whereQUest['fecha >=']     = $fechaIni;
                $whereQUest['fecha <=']     = $fechaFin;
                $whereQUest['Eliminado']    = 0;
                
                $cantidaPreguntas = $this->ci->loginDb->getCantidadPersonas($whereQUest);
                //echo $cantidaPreguntas[0]['cantidad']."<br>";
                $potjFinal = round((($cantidaPreguntas[0]['cantidad'] * $Porcentaje) / $CantidadPersonas[0]['cantidad']),1);
                $datfinal  = array("label"=>$opciones[$i]['label'],
                                    "value"=>$potjFinal,
                                    "cantidad"=>$cantidaPreguntas[0]['cantidad'],
                                    "calificacion"=>$opciones[$i]['id']);
                array_push($datosOpciones, $datfinal);
            }
            $datosPregunta = array("NombrePregunta" => $value['Enunciado'],
                                    "idPregunta" => $value['IdPregunta'],
                                    "datos"=>$datosOpciones);
            array_push($DataTotal, $datosPregunta);

        }
        //var_dump($DataTotal);
        $salida = array("mensaje"=>"Respuesta Insertada",
                        "data"=>$DataTotal,
                        "continuar"=>1);
        return $salida;
    }
    public function TablaExel($idHotel,$fechaIni,$fechaFin){
        //extract($data);
        //var_dump($data);die();
        $opciones[0]['label'] = "Malo";
        $opciones[0]['id']    = "1";
        $opciones[1]['label'] = "Regular";
        $opciones[1]['id']    = "2";
        $opciones[2]['label'] = "Aceptable";
        $opciones[2]['id']    = "3";
        $opciones[3]['label'] = "Bueno";
        $opciones[3]['id']    = "4";
        $opciones[4]['label'] = "Excelente";
        $opciones[4]['id']    = "5";
        //$where['idHotel']   = $idHotel;
        $Porcentaje = 100;

        $tablaEx = "<table>";
        $tablaEx .= "<thead>";
        $tablaEx .= "<tr>";
        $tablaEx .= "<th>Pregunta</th>";
        foreach ($opciones as $value) {
            $tablaEx .= "<th>".$value['label']."</th>";
        }
        $tablaEx .= "</tr>";
        $tablaEx .= "</thead>";
        $tablaEx .= "<tbody>";
        $DataTotal      = array();
        $where['Eliminado'] = 0;
        $Consulta = $this->ci->loginDb->ConsultaQuest($where);
        foreach ($Consulta as $value) {

            //var_dump($value['Enunciado']);die();
            $CantWhere['idPregunta'] = $value['IdPregunta'];
            $CantWhere['idHotel']    = $idHotel;
            $CantWhere['fecha >=']      = $fechaIni;
            $CantWhere['fecha <=']      = $fechaFin;
            $CantWhere['Eliminado']  = 0;

            $CantidadPersonas = $this->ci->loginDb->getCantidadPersonas($CantWhere);
            //var_dump($CantidadPersonas);//
                $tablaEx .= "<tr>";
                $tablaEx .= "<td>".utf8_decode($value['Enunciado'])."</td>";

            $datosOpciones = array();
            for ($i=0; $i < count($opciones); $i++) { 
                $whereQUest['idPregunta'] = $value['IdPregunta'];
                $whereQUest['calificacion'] = $opciones[$i]['id'];
                $whereQUest['idHotel']    = $idHotel;
                $whereQUest['fecha >=']     = $fechaIni;
                $whereQUest['fecha <=']     = $fechaFin;
                $whereQUest['Eliminado']  = 0;
                
                $cantidaPreguntas = $this->ci->loginDb->getCantidadPersonas($whereQUest);
                //echo $cantidaPreguntas[0]['cantidad']."<br>";
                $potjFinal = round((($cantidaPreguntas[0]['cantidad'] * $Porcentaje) / $CantidadPersonas[0]['cantidad']),1);
                $datfinal  = array("label"=>$opciones[$i]['label'],
                                    "value"=>$potjFinal);
                $tablaEx .= "<td>".$potjFinal." % </td>";
                array_push($datosOpciones, $datfinal);
            }
            $datosPregunta = array("NombrePregunta" => $value['Enunciado'],
                                    "idPregunta" => $value['IdPregunta'],
                                    "datos"=>$datosOpciones);
            array_push($DataTotal, $datosPregunta);

        }
        //var_dump($DataTotal);
        $tablaEx .= "</tr>";
        $tablaEx .= "</tbody>";
        $tablaEx .= "</table>";
        
        return $tablaEx;
    }
    public function TablaExelPersona($idHotel,$fechaIni,$fechaFin){
        $opciones[0]['label'] = "vacio";
        $opciones[1]['label'] = "Malo";
        $opciones[2]['label'] = "Regular";
        $opciones[3]['label'] = "Aceptable";
        $opciones[4]['label'] = "Bueno";
        $opciones[5]['label'] = "Excelente";
        //$where['idHotel']   = $idHotel;
        $Porcentaje = 100;

        $tablaEx = "<table>";
        $tablaEx .= "<thead>";
        $tablaEx .= "<tr>";
        $tablaEx .= "<th>Pregunta</th>";
        $tablaEx .= "<th>Nombre</th>";
        $tablaEx .= "<th>habitacion</th>";
        $tablaEx .= "<th>Respuesta</th>";
        $tablaEx .= "<th>Observacion</th>";
        $tablaEx .= "<th>Fecha Respuesta</th>";
        $tablaEx .= "<th>Hora</th>";
        $tablaEx .= "<th>IP</th>";
        $tablaEx .= "</tr>";
        $tablaEx    .=   "<tbody>";

        $Where['r.idHotel']     = $idHotel;
        $Where['r.fecha >=']    = $fechaIni;
        $Where['r.fecha <=']    = $fechaFin;
        $Where['r.Eliminado']   = 0;
        $Respuestas   = $this->ci->loginDb->getRespuestasAndP($Where);
        //  var_dump($Respuestas);die();

        //$whereQs['Eliminado'] = 0;
        //$Consulta = $this->ci->loginDb->ConsultaQuest($whereQs);

        foreach ($Respuestas as $key => $valueRes) {
            $n = $valueRes['calificacion'];
            $tablaEx    .= "</tr>";
            $tablaEx    .= "<td style='padding: 5px;'>".utf8_decode($valueRes['Enunciado'])."</td>";
            $tablaEx    .= "<td style='padding: 5px;'>".utf8_decode($valueRes['nombre'])."</td>";
            $tablaEx    .= "<td style='padding: 5px;'>".$valueRes['habitacion']."</td>";
            $tablaEx    .= "<td style='padding: 5px;'>".utf8_decode($opciones[$n]['label'])."</td>";
            $tablaEx    .= "<td style='padding: 5px;'>".utf8_decode($valueRes['Observacion'])."</td>";
            $tablaEx    .= "<td style='padding: 5px;'>".formatoFechaEspanol($valueRes['fechaRegistro'])."</td>";
            $tablaEx    .= "<td style='padding: 5px;'>".date('H:m',strtotime($valueRes['fechaRegistro']))."</td>";
            $tablaEx    .= "<td style='padding: 5px;'>".$valueRes['ip']."</td>";

        }
        $tablaEx    .= "</tr>";
        $tablaEx    .=   "</tbody>";
        $tablaEx    .=   "</table>";
        return $tablaEx;

    }
    public function InfoPersona($data){
        extract($data);
        //var_dump($data);die();
        $where['idPregunta']    = $idPregunta;
        $where['calificacion']  = $calificacion;
        $where['idHotel']       = $idHotel;
        $where['fecha >=']      = $fechaIni;
        $where['fecha <=']      = $fechaFin;
        $where['Eliminado']     = 0;

        $Respuestas   = $this->ci->loginDb->getRespuestas($where);

        if(count($Respuestas) > 0){
            $salida = array("mensaje"=>"Respuestas por persona",
                            "data"=>$Respuestas,
                            "continuar"=>1);
        }else{
            $salida = array("mensaje"=>"No hay registro",
                            "data"=>0,
                            "continuar"=>0);
        }
        return $salida;
    }

    public function creaPregunta($data)
    {
        extract($data);
        //var_dump($data);die();
        $insert['Enunciado']    = $pregunta;
        $insert['Hotel']        = $_SESSION['Hoteles']['idHotel'];

        $preguntaInsertada   = $this->ci->loginDb->creaPregunta($insert);

        if(count($preguntaInsertada) > 0)
        {
            $salida = array("mensaje"=>"La pregunta se ha insertado correctamente.",
                            "data"=>$preguntaInsertada,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha logrado insertar la pregunta, intente más tarde",
                            "data"=>0,
                            "continuar"=>0);
        }
        return $salida;
    }

    public function borrarPregunta($data)
    {
        extract($data);
        //var_dump($data);die();
        $where['IdPregunta']    = $idPregunta;
        $update['Eliminado']    = 1;

        $preguntaBorrada   = $this->ci->loginDb->borrarPregunta($where,$update);

        if(count($preguntaBorrada) > 0)
        {
            $salida = array("mensaje"=>"La pregunta se ha eliminado correctamente.",
                            "data"=>$preguntaBorrada,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha logrado eliminar la pregunta, intente más tarde",
                            "data"=>0,
                            "continuar"=>0);
        }
        return $salida;
    }

    public function modificarPregunta($data)
    {
        extract($data);
        //var_dump($data);die();
        $where['IdPregunta']    = $idPregunta;
        $update['Enunciado']    = $pregunta;

        $preguntaBorrada   = $this->ci->loginDb->borrarPregunta($where,$update);

        if(count($preguntaBorrada) > 0)
        {
            $salida = array("mensaje"=>"La pregunta se ha actualizado correctamente.",
                            "data"=>$preguntaBorrada,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha logrado actualizar la pregunta, intente más tarde",
                            "data"=>0,
                            "continuar"=>0);
        }
        return $salida;
    }

    public function getDataPreguntaSel($data)
    {
        extract($data);
        //var_dump($data);die();
        $where['IdPregunta']    = $idPregunta;
        $dataPregunta   = $this->ci->loginDb->ConsultaQuest($where);

        if(count($dataPregunta) > 0)
        {
            $salida = array("mensaje"=>"La pregunta se ha eliminado correctamente.",
                            "data"=>$dataPregunta[0],
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha logrado eliminar la pregunta, intente más tarde",
                            "data"=>0,
                            "continuar"=>0);
        }
        return $salida;
    }
 }
?>