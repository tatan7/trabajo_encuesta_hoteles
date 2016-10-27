<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct() 
    {
    	parent::__construct();
    	$this->load->model("Login/LogicaLogin", "login");

    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		if(isset($_SESSION['Hoteles'])){
			$DataHoteles	=	$this->login->getHoteles($_SESSION['Hoteles']['idHotel']);
			$variablesHome['titulo'] 	= "Home";
			$variablesHome['cabeza'] 	=  $this->cabeza();
			$variablesHome['Datain'] 	=  $DataHoteles['data'];
			$variablesHome['centro'] 	=  "home/inicio";
			$variablesHome['pie'] 	 	=  $this->pie();
			$this->load->view('home/index', $variablesHome);
		}else{
			$this->login();
		}
	}
	public function hoteles($idHotel=""){
		/*if(isset($_SESSION['Hoteles']))
		{*/
			if($idHotel != ""){
				$DataHoteles	=	$this->login->getHoteles($idHotel);
				$variablesHome['inform'] 	=  $DataHoteles['data'][0];
			}
			$variablesHome['titulo'] 	= "Hotel";
			$variablesHome['cabeza'] 	=  $this->cabeza();
			$variablesHome['centro'] 	=  "Hoteles/Inicio";
			$variablesHome['pie'] 	 	=  $this->pie();
			$this->load->view('Hoteles/inicio', $variablesHome);
		/*}else{
			$this->login();
		}*/
	}
	public function login(){
		$variablesHome['titulo'] 	= "Inicio";
		//$variablesHome['cabeza'] 	=  $this->cabezaLogin();
		$variablesHome['centro'] 	=  "login/login";
		//$variablesHome['pie'] 	 	=  $this->pie();
		$this->load->view('login/login', $variablesHome);
	}
	public function GetPreguntas(){
		$DataPReguntas	=	$this->login->GetPreguntas($_POST);
		echo json_encode($DataPReguntas);
	}
	public function startSession(){
		//die();
		$dataLogin	=	$this->login->getLogin($_POST);
		echo json_encode($dataLogin);
		//die("Buenas");
	}
	public function logout(){
		unset($_SESSION['Hoteles']);
		if(!isset($_SESSION['Hoteles']))
		{
			echo "<script>document.location='".base_url()."index'</script>";
		}
		else
		{
			echo "<script>document.location='".base_url()."index'</script>";
		}	
	}
	public function gracias(){
		$variablesHome['titulo'] 	= "Gracias";
		$variablesHome['cabeza'] 	=  $this->cabeza();
		$variablesHome['centro'] 	=  "Hoteles/Gracias";
		$variablesHome['pie'] 	 	=  $this->pie();
		$this->load->view('home/index', $variablesHome);
	}
	public function InsertaRespuesas(){
		$dataEncuesta	=	$this->login->InsertEncuesta($_POST);
		echo json_encode($dataEncuesta);
	}
	public function GetRespuestas(){
		$RespueEncuesta	=	$this->login->getRespuesta($_POST);
		//die("dsaknfkjas");
		echo json_encode($RespueEncuesta);
	}
	public function ExportExel($idHotel,$fechaIni,$fechaFin){
		$RespueEncuesta	=	$this->login->TablaExel($idHotel,$fechaIni,$fechaFin);
		//die("dsaknfkjas");
		header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=PorcentajesEncuesta.xls");
		echo $RespueEncuesta;
		die();
	}
	public function ExportExelPersona($idHotel,$fechaIni,$fechaFin){
		$Total	=	$this->login->TablaExelPersona($idHotel,$fechaIni,$fechaFin);
		header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=PorcentajesEncuesta.xls");
		echo $Total;
		die();
	}
	public function Resultados($idHotel=""){
		if(isset($_SESSION['Hoteles'])){

			if($idHotel != "")
			{
				$DataHoteles	=	$this->login->getHoteles($idHotel);
				$variablesHome['inform'] 	=  $DataHoteles['data'][0];
			}
			$variablesHome['titulo'] 	=  $DataHoteles['data'][0]['NombreHotel'];
			$variablesHome['cabeza'] 	=  $this->cabeza();
			$variablesHome['centro'] 	=  "Hoteles/Resultados";
			$variablesHome['pie'] 	 	=  $this->pie();
			$this->load->view('Hoteles/resultados', $variablesHome);
		}else{
			$this->login();
		}
	}
	public function cabeza(){
		return 'home/cabeza';	
	}
	public function cabezaLogin(){
		return 'home/cabezaLogin';	
	}
	public function pie(){
		return 'home/pie';	
	}

	public function getPersonCalifica()
	{
		$dataEncuesta	=	$this->login->InfoPersona($_POST);
		echo json_encode($dataEncuesta);
	}



	public function adminPreguntas()
	{
		if(isset($_SESSION['Hoteles']))
		{
			$arreglo  = array("Eliminado"=>0,
							  "idHotel"=>$_SESSION['Hoteles']['idHotel']);

			$listaPreguntas	=	$this->login->GetPreguntas($arreglo);

			$variablesHome['titulo'] 	= "Admin preguntas";
			$variablesHome['cabeza'] 	=  $this->cabeza();
			$variablesHome['preguntas'] 	=  $listaPreguntas['data'];
			$variablesHome['centro'] 	=  "home/adminPreguntas";
			$variablesHome['pie'] 	 	=  $this->pie();
			$this->load->view('home/index', $variablesHome);
		}
		else
		{
			$this->login();
		}
	}

	public function creaPregunta()
	{
		$dataEncuesta	=	$this->login->creaPregunta($_POST);
		echo json_encode($dataEncuesta);
	}

	public function borrarPregunta()
	{
		$borrarPregunta	=	$this->login->borrarPregunta($_POST);
		echo json_encode($borrarPregunta);
	}

	public function modificarPregunta()
	{
		$borrarPregunta	=	$this->login->modificarPregunta($_POST);
		echo json_encode($borrarPregunta);
	}
	public function getDataPreguntaSel()
	{
		$borrarPregunta	=	$this->login->getDataPreguntaSel($_POST);
		echo json_encode($borrarPregunta);
	}
}