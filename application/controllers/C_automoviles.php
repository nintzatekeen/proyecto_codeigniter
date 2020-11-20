<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_automoviles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_automoviles');
        
        
        
        
    }
    public function index()
    {       
        /*$plano="abcdPOIUJNM&&&&44444890";
        $encr=$this->encryption->encrypt($plano);
        echo "<p>$encr</p>";
        echo "<p>".$this->encryption->decrypt($encr)."</p>";
        
        exit();*/
        $datos['seleccion']= $this->cargarSeleccion();
            $datos['marcas']= $this->m_automoviles->marcas();
            $datos['coches_marca']= $this->m_automoviles->todosLosCoches();
            $this->load->view('v_cabecera', $datos);
            $this->load->view("v_coches_marca", $datos);
            $this->load->view("v_confirm", $datos);
            $this->load->view('v_pie');
    }
    public function cochesMarca($marca){
        if(isset($_POST['alquilar'])){
            redirect(site_url()."/c_automoviles/alquilar/".$_POST['id']);
        }
       $datos['seleccion']= $this->cargarSeleccion();
       $datos['marcas']= $this->m_automoviles->marcas();
       $datos['coches_marca']= $this->m_automoviles->cochesPorMarca($marca);

       $this->load->view('v_cabecera', $datos);
       $this->load->view("v_coches_marca", $datos);
       $this->load->view("v_confirm", $datos);
       $this->load->view('v_pie');
    }
    public function alquilar($idcoche){
        if(isset($_POST['submit'])){
            $seguro=false;
            if(isset($_POST['seguro']))
                $seguro=true;
            else{
                $seguro=false;
            }
            $dias=$_POST['dias'];
            
            $this->alquilarSesion($idcoche, $seguro, $dias);
        }
        /*if(isset($_POST['confirmar'])){
            $selected=array();
            foreach ($_POST['seleccion'] as $id) {
                $selected[$id]= $this->session->userdata("alquiler")[$id];
            }
            $this->m_automoviles->confirmarAlquiler($this->session->userdata("login")[0], $selected);
            $this->session->unset_userdata("alquiler");
            redirect(site_url()."/c_automoviles/index");
        }*/
        /*$seleccion=false;
        if($this->session->has_userdata("alquiler")){
            $seleccion=array();
            foreach ($this->session->userdata("alquiler") as $idauto => $arr) {
                    $carro=$this->m_automoviles->pillarBuga($idauto);
                    $seleccion[$idauto]=["coche"=>"$carro->marca $carro->modelo", "dias"=>$arr['dias'], "seguro"=>$arr['seguro'], "precio"=>$arr['precio']];
                }
        }*/
        $seleccion= $this->cargarSeleccion();
        $datos['seleccion']=$seleccion;
        $datos['marcas']= $this->m_automoviles->marcas();
        $datos['coche']=$this->m_automoviles->pillarBuga($idcoche);
        $datos['imagenes']=$this->m_automoviles->imagenesCoche($idcoche);
        $this->load->view('v_cabecera', $datos);
        $this->load->view("v_alquilar", $datos);
        $this->load->view("v_confirm", $datos);
        $this->load->view('v_pie');
    }
    public function alquilarTodo(){
        if(isset($_POST['confirmar'])){
            $selected=array();
            if(isset($_POST['seleccion'])){
                foreach ($_POST['seleccion'] as $id) {
                    $selected[$id]= $this->session->userdata("alquiler")[$id];
                }
                $this->m_automoviles->confirmarAlquiler($this->session->userdata("login")[0], $selected);
                $this->session->set_userdata("alquiler", $selected);
                redirect(site_url()."/c_automoviles/confirmacion");
                //$this->session->unset_userdata("alquiler");
            }
            else{
                redirect(site_url()."/c_automoviles/error_seleccion");
            }
        }
    }
    public function error_seleccion(){
        $datos['seleccion']= $this->cargarSeleccion();
        $datos['error']="No ha seleccionado ningún automóvil";
        $datos['marcas']= $this->m_automoviles->marcas();
        $datos['coches_marca']= $this->m_automoviles->todosLosCoches();
        $this->load->view('v_cabecera', $datos);
        $this->load->view("v_error", $datos);
        $this->load->view("v_confirm", $datos);
        $this->load->view('v_pie');
    }
    public function confirmacion(){
        $datos['seleccion']= $this->cargarSeleccion();
        
        $datos['marcas']= $this->m_automoviles->marcas();
        $datos['coches_marca']= $this->m_automoviles->todosLosCoches();
        $this->load->view('v_cabecera', $datos);
        $this->load->view("v_arigato", $datos);
        $this->load->view('v_pie');
    }
    private function cargarSeleccion(){
        $seleccion=false;
        if($this->session->has_userdata("alquiler")){
            $seleccion=array();
            foreach ($this->session->userdata("alquiler") as $idauto => $arr) {
                    $carro=$this->m_automoviles->pillarBuga($idauto);
                    $seleccion[$idauto]=["coche"=>"$carro->marca $carro->modelo", "dias"=>$arr['dias'], "seguro"=>$arr['seguro'], "precio"=>$arr['precio']];
                }
        }
        return $seleccion;
    }
    
    
    public function devoluciones(){
        if(isset($_POST['submit'])){
            $id=$_POST['idauto'];
            $this->m_automoviles->devolverAuto($id);
        }
        $datos['carros']= $this->m_automoviles->todosLosCoches();
        $datos['marcas']= $this->m_automoviles->marcas();
        $this->load->view('v_cabecera', $datos);
        $this->load->view("v_devoluciones", $datos);
        $this->load->view('v_pie'); 
    }
    
    
    public function login(){
        $datos['marcas']= $this->m_automoviles->marcas();
       $datos['coches_marca']= $this->m_automoviles->cochesPorMarca($marca);
       $datos['error']="";
       if(isset($_POST['submit'])){
           if(empty($_POST['username'])){
               $datos['error']="<p style='color:red'>Debe introducir su nombre de usaurio</p>";
           }
           else if(empty($_POST['password'])){
               $datos['error']="<p style='color:red'>Debe introducir su contraseña</p>";
           }
           else{
                $usr=$this->m_automoviles->login($_POST['username'], $_POST['password']);
                if($usr!=null){
                   $this->session->set_userdata("login", [$usr->id, $usr->username]);
                }
                else
                   $datos['error']="<p style='color:red'>No se pudo loguear, por favor, revise sus datos.</p>";
               
               
           }
       }
       $this->load->view('v_cabecera', $datos);
       $this->load->view("v_login", $datos);
       $this->load->view('v_pie');
    }
    public function logout(){
        $this->session->unset_userdata("login");
        redirect(site_url()."/c_automoviles/index");
    }
    
    public function alquilarSesion($idautomovil, $seguro, $dias){
        if(!$this->session->has_userdata("alquiler")){
            $this->session->set_userdata("alquiler", array());
        }
        $alquileres=$this->session->userdata("alquiler");
        $precio= $this->m_automoviles->calcularPrecio($this->session->userdata("login")[0], $this->m_automoviles->pillarBuga($idautomovil)->precio)*$dias;
        $alquileres["$idautomovil"]=["seguro"=>$seguro,"dias"=>$dias, "precio"=>$precio];
        $this->session->set_userdata("alquiler", $alquileres);
    }
    
    public function registro(){
        $datos['error']="";
        $datos['marcas']= $this->m_automoviles->marcas();
        if($this->input->post('submit')){
            $this->form_validation->set_rules("nombre", "nombre", "required");
            $this->form_validation->set_rules("dni", "dni", "max_length[9]|required");
            $this->form_validation->set_rules("username", "username", "required|max_length[50]");
            $this->form_validation->set_rules("password", "password", "required");
            $this->form_validation->set_rules("confirm_pass", "password_conf", "required|matches[password]");
            $this->form_validation->set_rules("email", "email", "required|valid_email");
            $this->form_validation->set_rules("banco", "cuneta_bancaria", "required|max_length[28]");
            if($this->form_validation->run()==false){
                $datos['error']="<p style='color:red'>Datos de registro inválidos<p>";
            }
            else{
                $premium=false;
                if(isset($_POST['premium']))
                    $premium=true;
                $registrado=$this->m_automoviles->registrarUsuario($this->input->post("nombre"),
                        $this->input->post("dni"),
                        $this->input->post("username"),
                        $this->input->post("password"),
                        $this->input->post("email"),
                        $this->input->post("banco"),
                        $premium);
                if($registrado){
                    redirect(site_url()."/c_automoviles/arigato");
                }
                
            }
        }
       $this->load->view('v_cabecera', $datos);
       $this->load->view("v_registro", $datos);
       $this->load->view('v_pie');
    }


    public function arigato(){
        $datos['marcas']= $this->m_automoviles->marcas();
        $this->load->view('v_cabecera', $datos);
        $this->load->view("v_arigato_reg");
        $this->load->view('v_pie');
    }
}
