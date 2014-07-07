    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intranet extends CI_Controller {


    
    function __construct() {
        parent::__construct();
        session_start();   
        $this->load->model('docente_model');
        $this->load->model('admin_model');
        
    }
    
    function index(){
        
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
              $this->load->view('intranet/loginAdmin');
       if (!isset($_SESSION['usuarioAdmin'])) {
                          
       }
       else{
        redirect('intranet/acceso', 'refresh');
       }
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
    }
    
    public function errorLoguear() {
        
        $this->load->view('general/headers');   
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');  
        $mensajeAlerta='Usuario y Clave Erroneo Vuelva a intentar!';
        $this->load->view('intranet/loginAdmin',  compact('mensajeAlerta'));
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
    }
    public function acceso(){
            if(!isset($_SESSION['usuarioAdmin']))
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
                $this->load->view('intranet/header_menu');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }

    }
    public function academico(){
            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $academico=$this->docente_model->getAcademico(); //extrae de la DB los academicos
                $asignatura=$this->admin_model->getAsignatura();//extrae de la DB las asignaturas
                $salas=$this->admin_model->getSala();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $periodos=$this->Admin_model->getPeriodo();
                $this->load->view('intranet/header_menu');
        //       $this->load->view('intranet/academico_menu',compact('academico','asignatura','periodos'));

             //   $this->load->view('intranet/enlace',compact('periodos','salas','academico','asignatura'));
                    $facultades=$this->admin_model->getFacultad();
                    $this->load->view('intranet/asignacion',compact('facultades','salas','academico','periodos'));
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }


    }
    public function llena_salas(){
         $options = "";
        if($this->input->post('facultad'))
        {
            $facultadPk = $this->input->post('facultad');
            $salas = $this->admin_model->salas($facultadPk);
            foreach($salas as $fila)
            {
                echo'<option value='.$fila->pk.'>'.$fila->sala.'</option>';
            }

        }
    }
        public function llena_salas2(){
         $options = "";
        if($this->input->post('facultad'))
        {
            $facultadPk = $this->input->post('facultad');
            $salas = $this->admin_model->salas($facultadPk);
            foreach($salas as $fila)
            {
                
                            echo'   <div class="form-group">
                                        <label  class="col-sm-2 control-label" id="c">Sala</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">  
                                                <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                                    <input class="form-control" readonly="readonly" type="text" value="'.$fila->sala.'">
                                               
                                            </div>
                                        </div>  
                                        <label  class="col-sm-1 control-label" id="c">Desc.</label> 
                                        <div class="col-sm-5">
                                            <textarea readonly="readonly" class="form-control" name="addDesc[]" id="'.$fila->pk.'">'.$fila->descripcion.'</textarea>  <br />
                                        </div>
                                    </div>';
            }

        }
    }
    public function llena_depa(){
         $options = "";
        if($this->input->post('facultad'))
        {
            $facultadPk = $this->input->post('facultad');
            $depa = $this->admin_model->depa($facultadPk);
            foreach($depa as $fila)
            {
          
                echo'<option value='.$fila->pk.'>'.$fila->departamento.'</option>';
           
            }
        }
    }
    public function llena_asig(){
         $options = "";
        if($this->input->post('facultad'))
        {
            $facultadPk = $this->input->post('facultad');
            $asig = $this->admin_model->asig($facultadPk);
            foreach($asig as $fila)
            {
          
                echo'<option value='.$fila->pk.'>'.$fila->codigo.' '.$fila->nombre.'</option>';
           
            }
        }
    }   
    public function setAcademico(){
            $datos=array(
                'nombres'=>$this->input->post('nombre'),
                'apellidos'=>$this->input->post('apellido'),
                'rut'=>$this->input->post('rut'),
                //'departamento'=>$this->input->post('dpto')
                'departamento_fk'=>1//el uno quiere decir de informatica :S
                );
            $estado=$this->admin_model->setAcademico($datos);
            if($estado==TRUE){
                    echo '<script>alert("Exito al guardar datos de Academico"); </script>';
                     redirect('intranet/academico', 'refresh');
            }
    }
    public function asocia(){
        $datos=array(
            'semestre'=>$this->input->post('semestre'),
            'anio'=>$this->input->post('anio'),
            'asignatura_fk'=>$this->input->post('ramo'),
            'docente_fk'=>$this->input->post('docente'),
            'seccion'=>$this->input->post('seccion')
            );
        $estado=$this->admin_model->asocia($datos);
                    if($estado==TRUE){
                    echo '<script>alert("Asociacion realizada con Exito"); </script>';
                     redirect('intranet/academico', 'refresh');
            }
    }
    public function salas(){

            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                         $academico=$this->docente_model->getAcademico();
                $salas=$this->admin_model->getSala();
                $periodo=$this->admin_model->getPeriodo();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');  
                $pedidos=$this->admin_model->getTodosPedidos();
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/pedidosDocentes',compact('pedidos'));
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }



    }
        public function reservas(){

            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                         $academico=$this->docente_model->getAcademico();
                $salas=$this->admin_model->getSala();
                $periodo=$this->admin_model->getPeriodo();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');  
                $reservas=$this->admin_model->getReserva();
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/verReservas',compact('reservas'));
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }



    }
    public function setSala(){
                $datos=array(
                 'facultad_fk'=>'1',//facultad de ingenieria=1   
                'sala'=>$this->input->post('nombre'),
                );
                $estado=$this->admin_model->setSala($datos);
                    if($estado==TRUE){
                    echo '<script>alert("Sala Ingresada con Exito"); </script>';
                     redirect('intranet/salas', 'refresh');
             }
    }
    public function setSalaAcademico(){
           
            $docentePk=$this->input->post('docente');
            $cursoPk=$this->admin_model->pkCurso($docentePk);//extrae el pk apartir del docente
            if($cursoPk==NULL)
            {
                    echo '<script>alert("Debes asignar un academico con una asignatura previamente"); </script>';
                     redirect('intranet/academico', 'refresh');
            }else{
                         $x=$cursoPk->pk;
                $datos=array(
                'sala_fk'=>$this->input->post('sala'),
                'periodo_fk'=>$this->input->post('periodo'),
                'curso_fk'=>$x,
                'adm_fk'=>'1',//1 por el administrador
                );
                $estado=$this->admin_model->setReserva($datos);
                    if($estado==TRUE){
                    echo '<script>alert("Reserva con Exito"); </script>';
                     redirect('intranet/salas', 'refresh');
             }
            } 
    }
    public function resultadosGral(){//muestra la tabla reserva "todos los datos (sala,periodo, academico etc)"

            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                   $result=$this->admin_model->resultadosGral();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/bienvenido');
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/resultadosGral',compact('result'));
                $this->load->view('intranet/fin_header_menu');               
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }                
    }
    public function eliminar($id=NULL){
        if (!$id) {
            show_404();
        }
        $eliminar = $this->admin_model->delete($id);
        if($eliminar==TRUE)
        {
            echo '<script>alert("Se ha eliminado un registro"); </script>';
            redirect('/intranet/resultadosGral', 'refresh');
        }
    }
    public function editar($id = null){
        $edit=$this->admin_model->getReservas($id);
                $academico=$this->docente_model->getAcademico();
                $asignatura=$this->admin_model->getAsignatura();
                $salas=$this->admin_model->getSala();
                $periodo=$this->admin_model->getPeriodo();
                $cursos=$this->admin_model->getCursos();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $edit=$this->admin_model->getReservas($id);
                $this->load->view('intranet/edit',compact('edit','academico','asignatura','salas','periodo','cursos'));
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
    }
    public function getAsignaturasDocente() {
        
        $pkDocente=$this->input->post('docente');
        $asignaturas=$this->Docente_model->getAsignatura($pkDocente);
        
        foreach ($asignaturas as $asig) {
            echo form_hidden('seccion',$asig->seccion,'',"id='seccion'");
            echo "<option value=".$asig->pk.">".$asig->nombre." sec. ".$asig->seccion."</option>";
        }
    }
    public function getSala(){
        
       $pkPeriodo=$this->input->post('periodo');
       $fecha=$this->input->post('datepicker');
       $salasDisponibles=$this->Sala_model->getSalasDisponibles($pkPeriodo,$fecha);
        foreach ($salasDisponibles as $sala) {
           echo '<option value="'.$sala->pk.'">'.$sala->sala.'</option>';
        } 
       
    }
    
    public function llenarReservaSemestre() {
        //pk admin
            $nombreAdm=$_SESSION['usuarioAdmin'];
            $adm_fk=$this->admin_model->pkAdmin($nombreAdm);

        //fin pk
        //datos para la tabla cursos
            $anio=$this->input->post('ano'); 
            $semestre=$this->input->post('semestre');  
            $asignatura_fk=$this->input->post('asig');
            $seccion=$this->input->post('seccion');
            $docente_fk=$this->input->post('docente'); 
        //fin datos para tabla cursos
        //crear la tabla curso
                     $datos=array(
                        'semestre'=>$semestre,
                        'anio'=>$anio,
                        'asignatura_fk'=>$asignatura_fk,
                        'docente_fk'=>$docente_fk,
                        'seccion'=>$seccion
                        );
                    $estado=$this->admin_model->asocia($datos);
                                if($estado==TRUE){
                                echo '<script>alert("Asociacion realizada con Exito"); </script>';
                                 //redirect('intranet/academico', 'refresh');
                                 }  
        //fin crear tabla curso 
            $maxPkCursos=$this->admin_model->maxPkCurso();//max pk de la tabla curso
            $sala_fk=$this->input->post('salas');                     
        //datos tabla reservas    
            $cantidadPer=$this->input->post('cantidadPer'); //cantidad de periodos agregados
            for ($i=1; $i <= $cantidadPer; $i++) { 
                    $diaElegido[]=$this->input->post('dia'.$i);//los dias que eligio
                    $periodo_fk[]=$this->input->post('periodo'.$i); //los periodos que eligio
            }
            $fechaInicio=$this->input->post('datepickerInicio');
            $fechaTermino=$this->input->post('datepickerTermino');
        $listo=$this->Admin_model->AsignarPorTiempo($fechaInicio,$fechaTermino,$periodo_fk,$diaElegido,$sala_fk,$maxPkCursos,$adm_fk); 

            $depa=$this->input->post('depa'); //mmm hay que ver ver
            $facultad=$this->input->post('facultad');//mmmmmmmmmhay que ver ver  
        //fin datos tabla reservas

             if($listo==TRUE){
                    echo '<script>alert("Exito al guardar las salas"); </script>';
                    redirect('intranet/academico', 'refresh');
            } 
    }
    public function comprobarDoc(){
        $dia=$this->input->post('dia');
        $periodo=$this->input->post('perio');
        if($dia!=null && $periodo!=null){
          //  echo $dia."-".$periodo;
            //consultar por el periodo el dia  y si considen no traer las SALA que se encuentra ocupada y el PROFE
             $queDia=$this->admin_model->fechaReservas();
                 date_default_timezone_set("America/Santiago");
             foreach ($queDia as $key) {
                        $fechats = strtotime($key->fecha); //a timestamp

                        //el parametro w en la funcion date indica que queremos el dia de la semana
                        //lo devuelve en numero 0 domingo, 1 lunes,....
                        switch (date('w', $fechats)){
                            case 0: $bool=0; break;// echo "Domingo"; break;
                            case 1: $bool=1; break;// echo "Lunes"; break;
                            case 2: $bool=2; break;// echo "Martes"; break;
                            case 3: $bool=3; break;// echo "Miercoles"; break;
                            case 4: $bool=4; break;// echo "Jueves"; break;
                            case 5: $bool=5; break;// echo "Viernes"; break;
                            case 6: $bool=6; break;// echo "Sabado"; break;
                        }
                        $queDia2[]=$bool;
                        $quePeriodo[]=$key->periodo_fk;
                        $salaCancelar[]=$key->sala_fk;

             }
             
             $queDia2=array_unique($queDia2);//para quitar los duplicado del array
             $quePeriodo=array_unique($quePeriodo);//para quitar los duplicado del array
             $salaCancelar=array_unique($salaCancelar);//para quitar los duplicado del array
             $loob=0;
             for ($i=0; $i <count($queDia2) ; $i++) { 
                 if($dia==$queDia2[$i] && $periodo==$quePeriodo[$i]){
                   // echo "yes";
                    echo $loob=1;
                 }
                 else echo "no";
             }
             if($loob==1){
                //echo $salaCancelar[0];
                

                for ($i=0; $i <count($salaCancelar) ; $i++) { 
                    $panalSalas=$this->admin_model->getSalaExcp($salaCancelar[$i]);//extrae todas las salas no ocupadas en un periodo

                    foreach($panalSalas as $fila)
                    {         
                        //echo $fila->sala;
                        echo'<option value='.$fila->pk.'>'.$fila->sala.'</option>';          
                    }
                }

             }else{//loob =0
                $salas=$this->admin_model->getSala();
                    foreach($salas as $fila)
                    {         
                        echo $fila->sala;
                       echo'<option value='.$fila->pk.'>'.$fila->sala.'</option>';          
                    }
             }
        }
               /*
       // var_dump($queDia);
                foreach ($queDia as $sala) {
           echo '<option value="">'.$sala->fecha.'</option>';*/
        
    }
     public function aprobarPedido($pk=NULL,$fecha=NULL,$sala=NULL,$pksala=NULL,$nombredocente=NULL,
            $apellidodocente=NULL,$pkdocente=NULL,$asignatura=NULL,$pkasignatura=NULL,$periodo=NULL) {
         
           if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
               
                
            $pedido=array('pk'=>$pk,'fecha'=>$fecha,'sala'=>$sala,'pksala'=>$pksala,'nombredocente'=>$nombredocente,'apellidodocente'=>$apellidodocente,'pkdocente'=>$pkdocente,'asignatura'=>$asignatura,'pkasignatura'=>$pkasignatura,'periodo'=>$periodo);
  
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/aprobarPedido',compact('pedido')); 
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
        
    }
    
    public function aprobarFinal() {
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        
        $pkPedido=$this->input->post('pkPedido');
        $sala=$this->input->post('sala');
        
        $updateReserva=$this->admin_model->aprobarReserva($pkPedido,$sala,$_SESSION['usuarioAdmin']);
        
         if($updateReserva==true){
               echo '<script>alert("Reserva Aprobada"); </script>';
               redirect('intranet', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al aprobar la reserva"); </script>';
               redirect('intranet', 'refresh');
         } 
           
          }    
        
    }
    
    public function eliminarPedido($pkPedido=NULL){
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        
        $eliminarPedido=$this->admin_model->eliminarPedido($pkPedido);
         if($eliminarPedido==true){
               echo '<script>alert("Pedido Eliminado"); </script>';
               redirect('intranet', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al eliminar el pedido"); </script>';
               redirect('intranet', 'refresh');
         } 
            }
    }
    
    
    public function editarReserva($pk=NULL,$fecha=NULL,$sala=NULL,$pksala=NULL,$nombredocente=NULL,
            $apellidodocente=NULL,$pkdocente=NULL,$asignatura=NULL,$pkasignatura=NULL,$periodo=NULL,$seccion=NULL) {
        
          if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                
                $docente=$this->admin_model->getPkDocente($pkdocente); 
                $asignaturas=$this->Docente_model->getAsignatura($docente->pk);
                $periodos= $this->Admin_model->getPeriodo();      
                $pkPedido=$pk;
                $academicos=$this->Docente_model->getAcademico();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/editarReserva',compact("pkPedido","asignaturas","periodos","fecha","docente"
                        ,'pk','fecha','sala','pksala','nombredocente',
            'apellidodocente','pkdocente','asignatura','pkasignatura','periodo','pksala','academicos','seccion'));
              
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
        
    }
    
    public function eliminarReserva($pkReserva) {
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        
        $eliminarReserva=$this->admin_model->eliminarPedido($pkReserva);
        if($eliminarReserva==true){
               echo '<script>alert("Reserva Eliminada"); </script>';
               redirect('intranet', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al eliminar la reserva"); </script>';
               redirect('intranet', 'refresh');
         } 
        
            }
        
    }
    
     public function getSeccionDeAsignatura(){
        
         if(!isset($_SESSION['usuarioAdmin']))
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
           // $pkAsignatura='82';
            echo "$pkDocente - $pkAsignatura";
            $secciones=$this->admin_model->getSeccionDeAsignaturaDocente($pkDocente,$pkAsignatura);
            
            foreach ($secciones as $sec) {
         
                echo "<option value='".$sec->seccion."'>".$sec->seccion."</option>";
                
               
            }
            }
    }
    
    public function editarReservaFinal() {
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $pkPedido=$this->input->post('pkPedido');
                $pkdocente=$this->input->post('docente');
                $pkAsignatura=$this->input->post('asignatura');
                $seccion=$this->input->post('seccion');
                $fecha=$this->input->post('datepicker');
                $periodo=$this->input->post('periodo');
                $pkSala=$this->input->post('sala');
                
                $esEditado=$this->admin_model->editarReserva($pkPedido,$pkdocente,$pkAsignatura,$seccion,$fecha,$periodo,$pkSala);
                if($esEditado==true){
                    echo '<script>alert("Reserva Editada"); </script>';
                    redirect('intranet', 'refresh');
                } 
                else{
                     echo '<script>alert("A ocurrido un error al editar la reserva"); </script>';
                     redirect('intranet', 'refresh');
               }
            }
        
    }    
    public function desconectar() {
        session_destroy();
        redirect('welcome');
    }
    public function config(){
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                 $facultades=$this->admin_model->getFacultad();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('intranet/header_menu');
                     $this->load->view('intranet/data');
                            $this->load->view('intranet/info');
                     $this->load->view('intranet/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
    }
    public function editFacultades(){
    if(!isset($_SESSION['usuarioAdmin']))
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
            $this->load->view('intranet/header_menu');
            $facultades=$this->admin_model->getFacultad();
                 $this->load->view('intranet/data');    
                     $this->load->view('intranet/editFacultades',compact('facultades'));
                 $this->load->view('intranet/cierreData');    
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
        }
    }
    public function modificarFacultad(){

        $btnEditar=$this->input->post('editarModificacion');
        $btnEliminar=$this->input->post('eliminarModificacion');
        $accion=$this->input->post('accion');//array
        $btnAgregar=$this->input->post('agregarModificacion');
        
   
        if($btnAgregar=='Agregar'){
            if(!isset($_SESSION['usuarioAdmin']))
                {
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/nosesion');
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');

                }else{
                    $facultades=$this->admin_model->getFacultad();
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('intranet/header_menu');
                         $this->load->view('intranet/data');    
                             $this->load->view('intranet/agregarFacultades');
                          $this->load->view('intranet/cierreData');       
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }
        }else{
        if ($btnEditar=='Editar' && $accion!=null) {
               if(!isset($_SESSION['usuarioAdmin']))
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
                    $this->load->view('intranet/header_menu');
                    $facultades=$this->admin_model->getFacultad();
                    $facultadesPk=$this->admin_model->getFacultadPk($accion);
                   // var_dump($facultadesPk);
                        $this->load->view('intranet/data');    
                              $this->load->view('intranet/editEditFacultades',compact("facultadesPk"));
                          $this->load->view('intranet/cierreData');         
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }
            }

        elseif ($btnEliminar=='Eliminar' && $accion!=null) {
            # code...
        //entra a eliminar
           $estado=$this->admin_model->eliminarFacultad($accion);
          // var_dump($estado);
           $true=0;
              for ($i=0; $i <count($estado) ; $i++) { 
                if($estado[$i]==true)
                    $true++;
            }
            if($true==count($estado))
                $bool=true;
            else $bool=false;
            if($bool==true){
                echo '<script>alert("Registro Eliminado exitosamente"); </script>';
                redirect('intranet/editFacultades', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron eliminados"); </script>';
                redirect('intranet/editFacultades', 'refresh');
            } 
        }else redirect('intranet/editFacultades');
    }
    }
    public function updateFacultad(){
        $btn=$this->input->post('editarModificacion'); //el boton
        $pk=$this->input->post('pk');//el pk a cambiar los datos
        $newFacultad=$this->input->post('newFacultad');//array
        $newDescripcion=$this->input->post('newDescripcion');//array
        if($btn==null)redirect('intranet/config');
        else{
            $estado=$this->admin_model->updateFacultades($pk,$newFacultad,$newDescripcion);
             
              $true=0;
              for ($i=0; $i <count($estado) ; $i++) { 
                if($estado[$i]==true)
                    $true++;
            }
            if($true==count($estado))
                $bool=true;
            else $bool=false;
            if($bool==true){
                echo '<script>alert("Registro Actualizado exitosamente"); </script>';
                redirect('intranet/editFacultades', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron actualizados"); </script>';
                redirect('intranet/editFacultades', 'refresh');
            } 
        }
    }
    public function agregarFacultad(){
        $addFacultad=$this->input->post('addFacultad');
        $addDesc=$this->input->post('addDesc');
        $btnEnviar=$this->input->post('enviarModificacion');
        if($btnEnviar=='Enviar')
        {
            $estado=$this->admin_model->addFacultades($addFacultad,$addDesc);
                          $true=0;
                      for ($i=0; $i <count($estado) ; $i++) { 
                        if($estado[$i]==true)
                            $true++;
                    }
                    if($true==count($estado))
                        $bool=true;
                    else $bool=false;
                    if($bool==true){
                        echo '<script>alert("Registro Agregado exitosamente"); </script>';
                        redirect('intranet/editFacultades', 'refresh');
                    }else{
                        echo '<script>alert("Algunos elementos no fueron agregados"); </script>';
                        redirect('intranet/editFacultades', 'refresh');
                    }
        }
        else redirect('intranet/editFacultades');
    }
    public function editSalas(){
        if(!isset($_SESSION['usuarioAdmin']))
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
            $this->load->view('intranet/header_menu');
            $salas=$this->admin_model->getSalaPorFk();
            $cantidadFacultad=$this->admin_model->getCantFacu();
            $facultades=$this->admin_model->getFacultad();
                $this->load->view('intranet/data');
                     $this->load->view('intranet/editSalas',compact("salas","cantidadFacultad","facultades"));
                 $this->load->view('intranet/cierreData');          
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
        }
    }
    public function editPeriodos(){
    if(!isset($_SESSION['usuarioAdmin']))
    {
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        $this->load->view('intranet/nosesion');
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');

    }else{
         $periodos=$this->Admin_model->getPeriodo();
         $facultades=$this->admin_model->getFacultad();
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');   
        $this->load->view('intranet/header_menu');
            $this->load->view('intranet/data');
                 $this->load->view('intranet/editperiodo',compact('periodos'));
            $this->load->view('intranet/cierreData');     
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
    }
    }
    public function guardarPeriodo(){
        $btn=$this->input->post('btnEnviar');
            if($btn==null){redirect('intranet/config'); }
            else{
                    $pkUpdate=$this->input->post('pks');
                    $newInicio=$this->input->post('inicio');
                    $newTermino=$this->input->post('termino');
                    $estado=$this->admin_model->addPeriodo($newInicio,$newTermino,$pkUpdate);
             
                     $true=0;
                     for ($i=0; $i <count($estado) ; $i++) { 
                         if($estado[$i]==true)
                             $true++;
                        }
                    if($true==count($estado))
                         $bool=true;
                    else $bool=false;
                    if($bool==true){
                        echo '<script>alert("Periodos Agregados exitosamente"); </script>';
                        redirect('intranet/editPeriodos', 'refresh');
                    }else{
                        echo '<script>alert("Algunos elementos no fueron agregados"); </script>';
                        redirect('intranet/editPeriodos', 'refresh');
                    } 
            
                 }

    }
}