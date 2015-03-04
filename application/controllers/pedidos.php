<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Pedidos extends CI_Controller {

  function __construct() {
    parent::__construct();
      $this->load->model('admin_model');
      $this->load->model('docente_model');


    session_start();   
  }

  public function index(){

    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');



                  //******************BOOOOOORRAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAR*********************
    //$_SESSION['usuarioProfesor']="7.760.554-1";
    //$_SESSION['bnv'] = 'Docente 1';
    //*******************************************************


    if(!isset($_SESSION['usuarioProfesor'])){
      $this->load->view('pedidos/login_docente');
    }
    else{
      $tieneDepto=$this->docente_model->tieneDpto($_SESSION['usuarioProfesor']);
      $tieneDepto=$tieneDepto->departamento_fk;
        if($tieneDepto==null){
               $dptos=$this->admin_model->getdptoAll();//todos los dptos
                $this->load->view('pedidos/selecioneDpto',compact('dptos'));
        }else{
          $this->load->view('pedidos/selecionar_opcionPedidos');
        }

    }
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
  public function llenaDptoDoc(){
    $btn=  $this->input->post('btnEnviar');
    $dpto=  $this->input->post('dpto');
    $rut=  $this->input->post('rut');
    if($btn=="Enviar"){
      $estado=$this->docente_model->guardarDptoDoc($dpto,$rut);
      if($estado==true){
             echo '<script>alert("Has completado el proceso Exitosamente"); </script>';
                          redirect('pedidos',301);     
      }
    }

  }
  public function pedirSala(){

   if(!isset($_SESSION['usuarioProfesor'])){
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
  else{
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $rut=$_SESSION['usuarioProfesor']; 
    $docente=$this->Docente_model->getDocenteRut($rut);
    $asignaturas=$this->Docente_model->getAsignaturaDoc($rut);

    $periodos= $this->Admin_model->getPeriodo();
    $this->load->view('pedidos/selecionar_opcionPedidos');
    $this->load->view('pedidos/pedir_sala',compact("asignaturas","nombreAsignatura","docente","periodos"));     
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');  
  }

}    

public function verPedidos() {

  if(!isset($_SESSION['usuarioProfesor'])){
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
  else{
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $this->load->view('pedidos/selecionar_opcionPedidos');
    
    $docente=$this->Docente_model->getDocenteRut($_SESSION['usuarioProfesor']);
    $asignaturas=$this->Docente_model->getPkAsignatura($docente->pk);
    $this->load->view('pedidos/consultaPorAsignatura',compact("asignaturas",'docente'));
    $asignatura_pk=$this->input->post('asignatura');
    $seccion=  $this->input->post('seccion');
    $pkDocente=$this->input->post('docente');
    if($seccion){
     
      $pedidos=$this->Docente_model->getPedidoSalaDocente($asignatura_pk,$docente->pk,$seccion);
      $this->load->view('pedidos/verPedidos',compact("pedidos","asignatura_pk","seccion"));
    }
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
}

public function editarPedido(){
    $pkdocente=  $this->input->post('pkdocente');

  if(!isset($_SESSION['usuarioProfesor']) ){

    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
  elseif($pkdocente!=null){

    $docente=$this->Docente_model->getDocenteRut($_SESSION['usuarioProfesor']); 

    $asignaturas=$this->Docente_model->getAsignaturaDoc($_SESSION['usuarioProfesor']);

    $periodos= $this->Admin_model->getPeriodo(); 

    $pkPedido=  $this->input->post('pkPedido');
    $pkasignatura=  $this->input->post('pkasignatura');
    $fecha=  $this->input->post('fecha');
    $nombreasignatura=  $this->input->post('nombreasignatura');
    $nombredocente=  $this->input->post('nombredocente');
    $periodo=  $this->input->post('periodo');
    $pksala=  $this->input->post('pksala');
    $sala=  $this->input->post('sala');


    $secciones=$this->Admin_model->getSeccionDeAsignaturaDocente($pkdocente,$pkasignatura);

    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $this->load->view('pedidos/selecionar_opcionPedidos');
    $this->load->view('pedidos/editarPedido',compact("secciones",'asignaturas','periodos','pkPedido','fecha','seccion','pkdocente','pkasignatura','nombreasignatura','nombredocente','periodo','pksala','sala'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }else {redirect('pedidos/verPedidos', 'refresh');}    

}

public function updatePedido() {
  if(!isset($_SESSION['usuarioProfesor'])){
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
  else{

    $pkPedido=  $this->input->post('pkPedido');
    $asignatura=$this->input->post('asignatura');
    $fecha=$this->input->post('fecha');
    $periodo=$this->input->post('periodo');
    $sala=$this->input->post('sala');
    $seccion=$this->input->post('seccion');
    $docente=$this->input->post('docente');
    $esActualizado=$this->Docente_model->updatePedido($pkPedido,$asignatura,$fecha,$periodo,$sala,$seccion,$docente);
    if($esActualizado==true){
     echo '<script>alert("Exito al Actualizar el Pedido"); </script>';
     redirect('pedidos', 'refresh');
   } 
   else{
     echo '<script>alert("A ocurrido un error al actualizar el Pedido"); </script>';
     redirect('pedidos', 'refresh');
   } 
 }
}

public function eliminarPedido($pkPedido=null) {

 if(!isset($_SESSION['usuarioProfesor'])){
  $this->load->view('general/headers');
  $this->load->view('general/menu_principal');
  $this->load->view('general/abre_bodypagina');
  $mensajeAlerta="No ha iniciado sesion!";
  $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
  $this->load->view('general/cierre_bodypagina');
  $this->load->view('general/cierre_footer');

}
else{
  $esEliminado=$this->Docente_model->borrarPedido($pkPedido);
  if($esEliminado==true){
   echo '<script>alert("Exito al eliminar el Pedido"); </script>';
   redirect('pedidos', 'refresh');
 } 
 else{
   echo '<script>alert("A ocurrido un error al eliminar el Pedido"); </script>';
   redirect('pedidos', 'refresh');
 }  

}


}


public function logueoError() {

  if(!isset($_SESSION['usuarioProfesor'])){
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
  else{
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta='Usuario y Clave invalido vuelva a intentar!';
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
}
public function logueoErrorAlum() {

  if(!isset($_SESSION['usuarioAlumno'])){
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('alumnos/login_alum',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
  else{
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta='Usuario y Clave invalido vuelva a intentar!';
    $this->load->view('alumnos/login_alum',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
}
public function salaDisponible() {

  if(!isset($_SESSION['usuarioProfesor'])){
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');

  }
  else{  
    $pkPeriodo= $this->input->post('periodo');
    $fecha=$this->input->post('datepicker');
    $rut=$_SESSION['usuarioProfesor'];
    $campusDoc=$this->docente_model->queCampusDoc($rut);
    $salasDisponibles=$this->Sala_model->getSalasDisponibles($pkPeriodo,$fecha,$campusDoc->pk);
    foreach ($salasDisponibles as $sala) {
     echo '<option value="'.$sala->pk.'">'.$sala->sala.'</option>';
   }     
 }
}


public function guardarPedidoSala(){
 if(!isset($_SESSION['usuarioProfesor'])){
  $this->load->view('general/headers');
   $this->load->view('general/menu_principal'); 
   $this->load->view('general/abre_bodypagina'); 
   $mensajeAlerta="No ha iniciado sesion!";
    $this->load->view('pedidos/login_docente',compact('mensajeAlerta')); 
    $this->load->view('general/cierre_bodypagina'); 
    $this->load->view('general/cierre_footer'); 
  } else{

   $fecha= $this->input->post('datepicker');
    $sala_pk=$this->input->post('sala'); 
    $periodo_pk=$this->input->post('periodo'); 
    $docente_pk=$this->input->post('docente'); 
    $asignatura_pk=$this->input->post('asignatura'); 
    $seccion=$this->input->post('seccion'); 
    if($fecha==null || $sala_pk==null || $periodo_pk==null || $docente_pk==null || $asignatura_pk==null || $seccion==null )
      { 
        //  echo $docente_pk;
        redirect('pedidos/pedirSala');
       }else{ 
          $pedidoSala=$this->Docente_model->guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk,$seccion); 
           if($pedidoSala==true){
             echo '<script>alert("Se ha guardado Exitosamente!"); </script>'; 
             redirect('pedidos', 'refresh');
              } else{ echo '<script>alert("Ha ocurrido un error !"); </script>';
               redirect('pedidos', 'refresh'); 
             } 
       } 
     } 
    }

    public function getSeccionDeAsignatura(){
        
         if(!isset($_SESSION['usuarioProfesor']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
         
        $pkDocente=$this->input->post('docente');
        $pkAsignatura=$this->input->post('asignatura');
        //echo "$pkDocente - $pkAsignatura";
        $secciones=$this->Admin_model->getSeccionDeAsignaturaDocente($pkDocente,$pkAsignatura);
        $option="";
        $option="<option selected='selected' value=''>Seleccionar Sección</option>";
        foreach ($secciones as $sec) {
     
            $option=$option."<option value='".$sec->seccion."'>".$sec->seccion."</option>";
            
           
        }
        echo $option;
            }
    }
    public function miHorario(){
      if(!isset($_SESSION['usuarioProfesor']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
              $rut=$_SESSION['usuarioProfesor'];
              $clasesDoc=$this->docente_model->miSchedule($rut);
                  $this->load->view('general/headers');
                  $this->load->view('general/menu_principal');
                  $this->load->view('general/abre_bodypagina');
                  $this->load->view('pedidos/selecionar_opcionPedidos',compact('clasesDoc'));
                    $this->load->view('pedidos/horario');
                  $this->load->view('general/cierre_bodypagina');
                  $this->load->view('general/cierre_footer');
            }
    }

}
