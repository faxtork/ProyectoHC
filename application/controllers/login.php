<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("ws_helper");
        $this->load->library('form_validation');
        $this->load->library('ws_dirdoc');
      $this->load->model('docente_model');
        
       session_start();
       //session_unset();
    }
  
    
    function index() {//docente
   


        if ($this->input->post()) {
          $rut = $this->input->post("rut", TRUE);//rut
          $p = strtoupper($this->input->post("clave", TRUE));
          $str = hash('sha256', $p);
          //error_log("$rut / $p / $str");
          $resultado = $this->ws_dirdoc->autenticar($rut, $str);
          $docente = $this->ws_dirdoc->consultarDocente($rut);
          $tipo= $docente->tipo;
          $docenteName = $docente->alias;
          $docenteNombres=$docente->nombres;
          $docenteApellidos=$docente->apellidoPaterno." ".$docente->apellidoMaterno;
            if($resultado==true && $tipo=="PROF"){//pasa cuando evalua todas las posibilidaddes
                //  $_SESSION['usuarioProfesor']=  $this->input->post('rut',true);
                      $_SESSION['usuarioProfesor']="8.727.547-7";//BORRAR DESPUES************************************************

                    $_SESSION['bnv'] = $docenteName;
                    //si es un profesor que por primera ves entra al sistema se debe almacenar su rut y datos
                    //pregunto si el profesor que se logeo existe en nuestra BD
                      $queryDoc=$this->docente_model->estaDoc($_SESSION['usuarioProfesor']);
                        if($queryDoc==0){//si es !=0 quiere decir que esta logeado y no crea nada
                           $newDoc=$this->docente_model->alamcenarDocNew($_SESSION['usuarioProfesor'],$docenteNombres,$docenteApellidos);
                          if($newDoc==true){//quiere decir que se guardo
                            redirect('pedidos',301);
                          }else{}//si entra al else hay problemas al crearlo 
                        }else{//si entra aqui es xq esta en la BD antes
                          redirect('pedidos',301);
                        }
                       
                  }
                else{
                   redirect('pedidos/logueoError',301);
                } 
          }
          else{
             redirect('pedidos/logueoError',301);
          }   
         
    } 


    public function validarAdmin() {
        if($this->input->post()){
          $clave=hash('sha256', trim($this->input->post('clave')));
          $nombre=$this->input->post('rut');

           $respuestaLogin1=$this->Admin_model->loguearAdmin($nombre,$clave);
           $respuestaLogin2=$this->Admin_model->loguearAdmin2($nombre,$clave);

            if($respuestaLogin1!=null){ //hay respuesta del usuario administrador
                  
                  $_SESSION['usuarioAdmin']=$this->input->post('rut',true);
                  $_SESSION['rutAdmin']=$respuestaLogin1->rut;
                  $_SESSION['campus']=$respuestaLogin1->campus_fk;//para saber de que campus es el usuarioadmin
                  redirect('intranet/acceso',301); 

            }elseif ($respuestaLogin2!=null) {
                  $_SESSION['adminGeneral']=$respuestaLogin2->nombre;
                  redirect('intranet/acceso',301); 
            }
            else{//no hay respuesta y error al logear
               redirect('intranet/errorLoguear',301);
            }  
        }
    }
    public function alum(){
          if ($this->input->post()) {
          $rut = $this->input->post("rut", TRUE);//rut
          $p = strtoupper($this->input->post("clave", TRUE));
          $str = hash('sha256', $p);
          //error_log("$rut / $p / $str");
          $resultado = $this->ws_dirdoc->autenticar($rut, $str);
          $datosAlum = $this->ws_dirdoc->consultarUltimaFichaEstudiante($rut);

          $codigoCarrera= $datosAlum->nombreCarrera; //Ej:21041 INGENIERÃA CIVIL EN COMPUTACIÃ“N MENC. INFORMÃTICA
          $codigoCarrera=explode(" ",$codigoCarrera);
          $codigoCarrera=$codigoCarrera[0];//extraigo el codigo de carrera Ej:21041
          $nombreAlum=$datosAlum->nombres." ".$datosAlum->apellidoPaterno." ".$datosAlum->apellidoMaterno;

          $tipoAlum=$datosAlum->tipo;
            if($resultado==true && $tipoAlum=="ALUM"){//si pasa porque los datos del logeo estan bien y es alumno
                  $_SESSION['usuarioAlumno']=  $this->input->post('rut',true);
                    $_SESSION['codigoCarrera'] = $codigoCarrera;
                    $_SESSION['nombreAlum'] = $nombreAlum;

                   redirect('consulta',301);
                  }
                else{
                   redirect('pedidos/logueoErrorAlum',301);
                } 
          }
          else{
             redirect('pedidos/logueoErrorAlum',301);
          } 
    }
    public function desconectar() {
        session_destroy();
        redirect('welcome');
    }
    
}

?>