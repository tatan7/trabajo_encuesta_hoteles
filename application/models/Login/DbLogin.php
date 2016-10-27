<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DbLogin extends CI_Model {

    private $TablePReguntas     =   "";
    private $tableHoteles       =   "";
    private $tableRespuestas    =   "";
    private $tablelogin         =   "";
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->TablePReguntas   = "preguntas";        
        $this->tableHoteles     = "hoteles";        
        $this->tableRespuestas  = "respuestas";        
        $this->tablelogin       = "login";        
    }
    public function ConsultarHoteles($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableHoteles);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function ConsultaQuest($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->TablePReguntas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();   
    }
    public function InsertaEncuesta($info){
        $this->db->insert($this->tableRespuestas,$info);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function creaPregunta($info){
        $this->db->insert($this->TablePReguntas,$info);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function borrarPregunta($where,$info){
        $this->db->where($where);
        $this->db->update($this->TablePReguntas,$info);
        //echo $this->db->last_query();die();
        return $this->db->affected_rows();
    }
    public function getRespuestas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRespuestas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();   
    }
    public function getCantidadPersonas($where){
        $this->db->select("count(idPregunta) as cantidad");
        $this->db->where($where);
        $this->db->from($this->tableRespuestas);
        $id = $this->db->get();
        //print_r($this->db->last_query())."<br>";
        return $id->result_array();   
    }
    public function getRespuestasAndP($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRespuestas." r");
        $this->db->join($this->TablePReguntas." p","r.idPregunta=p.idPregunta","INNER");
        $this->db->order_by("r.habitacion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();   
    }
    public function ConsultaUsuario($where) 
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablelogin);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    /*
    public function InsertNewR($info)
    {
        $this->db->insert($this->login,$info);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function ActualizaUSuario($where,$info){
        $this->db->where($where);
        $this->db->update($this->login,$info);
        //echo $this->db->last_query();die();
        return $this->db->affected_rows();
    }
    public function GetProductos($where) 
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->TableProductos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function InsertProduct($where){
        $this->db->insert($this->TableProductos,$where);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();   
    }
    public function DeletProduc($where,$info){
        $this->db->where($where);
        $this->db->update($this->TableProductos,$info);
        //echo $this->db->last_query();die();
        return $this->db->affected_rows();
    }*/
}
 ?>