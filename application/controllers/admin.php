    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {


    
    function __construct() {
        parent::__construct();
        session_start();   
        $this->load->model('docente_model');
        $this->load->model('admin_model');
        $this->load->model('admingeneral_model');
        
    }
    public function users(){
    	    if(!isset($_SESSION['adminGeneral']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
            	//$academico=$this->docente_model->getAcademico(); //extrae de la DB los academicos
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                //|$periodos=$this->Admin_model->getPeriodo();
                $this->load->view('adminGeneral/header_menuGeneral');
                	$this->load->view('adminGeneral/data');
                        $this->load->view('adminGeneral/info');
                    $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
    }
    public function crearUser(){
    	   if(!isset($_SESSION['adminGeneral']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('adminGeneral/header_menuGeneral');
                	$this->load->view('adminGeneral/data');
                    $campus=$this->admin_model->getCampus();
                        $this->load->view('adminGeneral/crearUser',compact('campus'));
                    $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
    }
    public function agregarUser(){
        $btn=$this->input->post('enviarUser'); //el boton
        
        $user=$this->input->post('user');
        $pass=$this->input->post('pass');
        $contacto=$this->input->post('contacto');
        $clave=hash('sha256', trim($pass));
        $rut=$this->input->post('rut');
        $grado=$this->input->post('grado');
        $pkAdmin=$this->admingeneral_model->extraerPkAdmin($_SESSION['adminGeneral']);
        $descripGrado="";
        /*$userServer=$this->admingeneral_model->getUsers();
        for ($i=0; $i <count($userServer) ; $i++) { 
                if($userServer[$i]->nombre==$user){
                    ?>
                    <script>
                    var variablejs = "<?php echo $user; ?>" ;
                    </script>
                    <?php
                   // unset($addFacultad[$j]);//elimina ese reguistro
                    //$addFacultad = array_values($addFacultad);//reordena el array
                     echo '<script>alert("El registo >"+variablejs+"< ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('admin/users', 'refresh');
                }    
        }*/

        if($grado==1){//quiere decir que agrego un usuario administrador
             $campus=$this->input->post('campus');
             $descripGrado="usuario administrador";
        }else{// si entra aca quiere decir que guardara un administradorgeneral
                    if($btn==null)redirect('admin/users');
                    else{
                    $descripGrado="Administrador General";
                        $estado=$this->admingeneral_model->crearUser2($user,$clave,$contacto,$rut,$pkAdmin->pk,$descripGrado);
                        if($estado==true){
                            echo '<script>alert("Un nuevo Administrador General a sido registrado"); </script>';
                            redirect('admin/users', 'refresh');
                        }else{
                            echo '<script>alert("Algunos elementos no fueron Guardados"); </script>';
                            redirect('admin/users', 'refresh');
                        } 
                    }
        }
        if($btn==null)redirect('admin/users');
        else{
            $estado=$this->admingeneral_model->crearUser($pkAdmin->pk,$user,$clave,$contacto,$rut,$campus,$descripGrado);
            if($estado==true){
                echo '<script>alert("Un nuevo usuario a sido registrado"); </script>';
                redirect('admin/users', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron Guardados"); </script>';
                redirect('admin/users', 'refresh');
            } 
        }
    }
    public function lista(){
       if(!isset($_SESSION['adminGeneral']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $pkAdmin=$this->admingeneral_model->extraerPkAdmin($_SESSION['adminGeneral']);
                $datosUsers=$this->admingeneral_model->getDatosUsers($pkAdmin->pk);
                $datosUsersGeneral=$this->admingeneral_model->getDatosUsersGeneral($pkAdmin->pk);
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('adminGeneral/header_menuGeneral');
                    $this->load->view('adminGeneral/data');
                        $this->load->view('adminGeneral/lista',compact('datosUsers','datosUsersGeneral'));
                    $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }  
    }
    public function eliminarPedido($pkPedido=NULL){
        
        if(!isset($_SESSION['adminGeneral']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        
        $eliminarPedido=$this->admingeneral_model->eliminarPedido($pkPedido);
         if($eliminarPedido==true){
               echo '<script>alert("Usuario Eliminado"); </script>';
               redirect('intranet', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al eliminar"); </script>';
               redirect('intranet', 'refresh');
         } 
            }
    }
        public function editarUserGeneral(){
        $pkUserEditar=$this->input->post('pkUser');
        $datoEditUser=$this->admingeneral_model->getDatosUsers2G($pkUserEditar);
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('adminGeneral/header_menuGeneral');
                    $this->load->view('adminGeneral/data');
                        $this->load->view('adminGeneral/editUserGeneral',compact('datoEditUser'));
                    $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
    }
    public function updateUserGeneral(){
        $btn=$this->input->post('enviarUser'); //el boton
        $user=$this->input->post('user');
        $pkEdit=$this->input->post('pkEdit');
       /*  $userServer=$this->admingeneral_model->getUsers();
        for ($i=0; $i <count($userServer) ; $i++) { 
                if($userServer[$i]->nombre==$user){
                    ?>
                    <script>
                    var variablejs = "<?php echo $user; ?>" ;
                    </script>
                    <?php
                   // unset($addFacultad[$j]);//elimina ese reguistro
                    //$addFacultad = array_values($addFacultad);//reordena el array
                     echo '<script>alert("El registo >"+variablejs+"< ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('admin/users', 'refresh');
                }    
        }*/
        $pass=$this->input->post('pass');
        $bool=false;
        if($pass!=""){//si es!= al vacio quiere decir que hay pass, se hashea la nueva pass para ser guardada
            $clave=hash('sha256', trim($pass));
            $bool=true;
        }
        $contacto=$this->input->post('contacto');
        $descripGrado="";

        if($btn==null)redirect('admin/users');
        else{
            if($bool==true){//solo si quiere cambiar su clave
                $estado=$this->admingeneral_model->UpdateUserG($pkEdit,$user,$clave,$contacto);
            }
            else{
                $estado=$this->admingeneral_model->UpdateUser2G($pkEdit,$user,$contacto);

            }
            if($estado==true){
                echo '<script>alert("Usuario Actualizado"); </script>';
                redirect('admin/users', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron Guardados"); </script>';
                redirect('admin/users', 'refresh');
            } 
        }
    }
    public function editarUser(){
        $pkUserEditar=$this->input->post('pkUser');
        $datoEditUser=$this->admingeneral_model->getDatosUsers2($pkUserEditar);
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('adminGeneral/header_menuGeneral');
                    $this->load->view('adminGeneral/data');
                        $this->load->view('adminGeneral/editUser',compact('datoEditUser'));
                    $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
    }
    public function updateUser(){
        $btn=$this->input->post('enviarUser'); //el boton
        $user=$this->input->post('user');
        $pkEdit=$this->input->post('pkEdit');
       /*  $userServer=$this->admingeneral_model->getUsers();
        for ($i=0; $i <count($userServer) ; $i++) { 
                if($userServer[$i]->nombre==$user){
                    ?>
                    <script>
                    var variablejs = "<?php echo $user; ?>" ;
                    </script>
                    <?php
                   // unset($addFacultad[$j]);//elimina ese reguistro
                    //$addFacultad = array_values($addFacultad);//reordena el array
                     echo '<script>alert("El registo >"+variablejs+"< ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('admin/users', 'refresh');
                }    
        }*/
        $pass=$this->input->post('pass');
        $bool=false;
        if($pass!=""){//si es!= al vacio quiere decir que hay pass, se hashea la nueva pass para ser guardada
            $clave=hash('sha256', trim($pass));
            $bool=true;
        }
        $contacto=$this->input->post('contacto');
        $descripGrado="";

        if($btn==null)redirect('admin/users');
        else{
            if($bool==true){//solo si quiere cambiar su clave
                $estado=$this->admingeneral_model->UpdateUser($pkEdit,$user,$clave,$contacto);
            }
            else{
                $estado=$this->admingeneral_model->UpdateUser2($pkEdit,$user,$contacto);

            }
            if($estado==true){
                echo '<script>alert("Usuario Actualizado"); </script>';
                redirect('admin/users', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron Guardados"); </script>';
                redirect('admin/users', 'refresh');
            } 
        }
    }
    public function config(){
                if(!isset($_SESSION['adminGeneral']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('adminGeneral/header_menuGeneral');
                     $this->load->view('adminGeneral/data2');
                            $this->load->view('adminGeneral/info2');
                     $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
 
    }
}