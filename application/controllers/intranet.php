    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intranet extends CI_Controller {


    
    function __construct() {
        parent::__construct();
        session_start();   
        $this->load->model('docente_model');
        $this->load->model('sala_model');
        $this->load->model('admin_model');
        $this->load->model('admingeneral_model');
        $this->load->model('clases_model');
        $this->load->library("excel");
    }
    
    function index(){
        
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
              $this->load->view('intranet/loginAdmin');
       if (!isset($_SESSION['usuarioAdmin'])) {
            if(isset($_SESSION['adminGeneral']))
                redirect('intranet/acceso', 'refresh');
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
            if(!isset($_SESSION['usuarioAdmin']))//entra cuando no existe la sesion de usuario admin
            {
                if(!isset($_SESSION['adminGeneral'])){
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/nosesion');//no hay sesion
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }else{
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('adminGeneral/header_menuGeneral');
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }
            }else{
                $nameCampus=$this->admin_model->getNameCampus($_SESSION['campus']);
                $_SESSION['nombreCampus']=$nameCampus->nombre;
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
            $campusPk=$_SESSION['campus'];
            $facultadPk = $this->input->post('facultad');
            $ano = $this->input->post('ano');
            $semestre = $this->input->post('semestre');

            $periodo = $this->input->post('perioArray');//array con los periodos
            $dia = $this->input->post('diaArray');//array con los dias (1,2,3,4,5,6)

            $datepickerInicio = $this->input->post('datepickerInicio');
            $datepickerTermino = $this->input->post('datepickerTermino');
        $todasSalas=$this->admin_model->getSalaCampus($campusPk);//todas las salas menos las bloqueadas
           // $aulaCancelada=$this->admin_model->bloqueadaAula($facultadPk);
            foreach ($todasSalas as $value) {
                $salaHabil[]=$value->sala;
                $pk[]=$value->pk."/".$value->descripcion;
               // $titles[]=$value->descripcion;
            }

            $salasInhabil = $this->admin_model->salasAsignacion($semestre,$ano,$campusPk,$periodo,$datepickerInicio,$datepickerTermino,$dia);//trae todas las salas inhabilitadas excepto las bloqueadas
            if($salasInhabil==false){//no hay salas ocupadas
                $aulaOcupada=array();
            }else{//quiere decir que vienen salas ocupadas
                for ($i=0; $i <count($salasInhabil) ; $i++) { 
                    if(empty($salasInhabil[$i])){}
                    else{
                        foreach ($salasInhabil[$i] as $fila) {
                                $aulaOcupada[]=$fila->sala;
                                $pkOcupada[]=$fila->pk;
                        } 
                    }
             
                }
            }
            $pkOcupada =@array_values(array_unique($pkOcupada));
            $pk =@array_values(array_unique($pk));
          //  $title =@array_values(array_unique($title));

            $aulaOcupada =@array_values(array_unique($aulaOcupada));

            for ($i=0; $i <count($salaHabil) ; $i++) { 
               for ($j=0; $j <count($aulaOcupada) ; $j++) { 
                   if($salaHabil[$i]==$aulaOcupada[$j]){
                    unset($salaHabil[$i]);
                    unset($pk[$i]);
                  //  unset($title[$i]);

                                $salaHabil=array_values($salaHabil);
                                $pk=array_values($pk);
                              //  $title=array_values($title);

                   }
               }
            }    
            $salaHabil=array_values($salaHabil);
            $pk=array_values($pk);
          //  $title=array_values($title);


for($i=0;$i<count($pk);$i++){
$resultados[]=explode("/",$pk[$i]);
}

for($i=0;$i<count($resultados);$i++){
    $pk2[]=$resultados[$i][0];
    $title[]=$resultados[$i][1];
}




            $options="";
            $options='<option selected="selected" value="">Selecione una sala</option>';
            for ($i=0; $i <count($salaHabil) ; $i++) { 
               $options.='<option title="'.$title[$i].'" value="'.$pk2[$i].'">'.$salaHabil[$i].'</option>';
            }
            echo $options;
            
        }
    }
       public function llena_salas2(){
         $options = "";
        if($this->input->post('campus'))
        {
            $campusPk = $this->input->post('campus');
            $salas = $this->admin_model->getSalaCampus2($campusPk);
            foreach($salas as $fila)
            {
                
                            echo'   <div class="form-group">
                                        <label  class="col-sm-1 control-label" id="c">Sala</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">  
                                                <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                                    <input class="form-control" readonly="readonly" type="text" value="'.$fila->sala.'">
                                               
                                            </div>
                                        </div>  
                                        <label  class="col-sm-1 control-label" id="c">Desc.</label> 
                                        <div class="col-sm-4">
                                            <textarea style="resize:none;" readonly="readonly" class="form-control" name="addDesc[]" id="'.$fila->pk.'">'.$fila->descripcion.'</textarea>  <br />
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
            $options='<option selected="selected" value="">Selecione un departamento</option>';
            foreach($depa as $fila)
            {
          
                $options .='<option value='.$fila->pk.'>'.$fila->departamento.'</option>';
           
            }
            echo $options;
        }
    }
    public function llena_asig(){
         $options = "";
        if($this->input->post('facultad'))
        {
            $facultadPk = $this->input->post('facultad');
            $asig = $this->admin_model->asig($facultadPk);
            $options='<option selected="selected" value="">Selecione una asignatura</option>';
            foreach($asig as $fila)
            {
          
                $options .='<option value='.$fila->pk.'>'.$fila->codigo.' '.$fila->nombre.'</option>';
           
            }
            echo $options;
        }
    }
    public function llena_doc(){
                 $options = "";
        if($this->input->post('facultad'))
        {
            $facultadPk = $this->input->post('facultad');
                        $ano = $this->input->post('ano');
            $semestre = $this->input->post('semestre');

            $periodo = $this->input->post('perioArray');//array con los periodos
            $dia = $this->input->post('diaArray');//array con los dias (1,2,3,4,5,6)

            $datepickerInicio = $this->input->post('datepickerInicio');
            $datepickerTermino = $this->input->post('datepickerTermino');
            $doc = $this->admin_model->doc($facultadPk);//todos los doc de una facultad
            foreach ($doc as $prof) {
                $docenteXFacu[]=$prof->nombres." ".$prof->apellidos;
                $docPk[]=$prof->pk;
            }
            $salasInhabil = $this->admin_model->salasAsignacion($semestre,$ano,$facultadPk,$periodo,$datepickerInicio,$datepickerTermino,$dia);//trae todas las salas inhabilitadas excepto las bloqueadas
                if($salasInhabil==false){//no hay salas ocupadas
                $pkOcupada=array();
                }else{//quiere decir que vienen salas ocupadas
                    for ($i=0; $i <count($salasInhabil) ; $i++) { 
                        if(empty($salasInhabil[$i])){}
                        else{
                            foreach ($salasInhabil[$i] as $fila) {
                                    $pkOcupada[]=$fila->pk;
                            } 
                        }
                 
                    }
                }
            $pkOcupada =@array_values(array_unique($pkOcupada));
            $docenteInhabil=$this->admin_model->docIn($pkOcupada);//trae la pk del docenteinhabil
            for ($i=0; $i <count($docenteInhabil) ; $i++) { 
                    foreach ($docenteInhabil[$i] as $fila) {
                            $docPkOcupado[]=$fila->pk;
                    }
            }
            $docPkOcupado =@array_values(array_unique($docPkOcupado));

            for ($i=0; $i <count($docPk) ; $i++) { 
               for ($j=0; $j <count($docPkOcupado) ; $j++) { 
                   if($docPk[$i]==$docPkOcupado[$j]){
                    unset($docenteXFacu[$i]);
                    unset($docPk[$i]);
                                $docenteXFacu=array_values($docenteXFacu);
                                $docPk=array_values($docPk);
                   }
               }
            } 

            $options='<option value="" selected="selected">Selececione un docente</option>';
            for ($i=0; $i <count($docenteXFacu) ; $i++) { 
            
                $options .='<option value='.$docPk[$i].'>'.$docenteXFacu[$i].'</option>';
            }
            echo $options;
        }
    }   
   /* public function setAcademico(){
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
    }*/
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
                       $campusPk=$_SESSION['campus']; 
                $pedidos=$this->admin_model->getTodosPedidos($campusPk);
                $this->load->view('intranet/header_menu');
                  /*  if(count($pedidos)==0)//si es 0 quiere decir que lo aprobo o lo elimino
                    {
                        $fkadmin=$this->Admin_model->fkAdminn($_SESSION['rutAdmin']);
                        $getPedidoEstado=$this->Admin_model->pedidoEstado($fkadmin->pk);//si lo encuentra aqui es xq lo aprobo
                        foreach ($getPedidoEstado as $key) {
                            $pkPedidos[]=$key->pk;
                        }
                        $extraePedi=$this->Admin_model->extraePediXPk($pkPedidos,$campusPk);
                        $this->load->view('intranet/pedidosDocentes',compact('pedidos'));
                        
                    }else{*/
                        $this->load->view('intranet/pedidosDocentes',compact('pedidos'));
                  //  } 
                
                
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
                  //       $academico=$this->docente_model->getAcademico();
                //$salas=$this->admin_model->getSala();
                //$periodo=$this->admin_model->getPeriodo();
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
       $salaPk=$this->input->post('aulafk');

       $campusPk=$_SESSION['campus'];
       $salasDisponibles=$this->Sala_model->getSalasDisponibles($pkPeriodo,$fecha,$campusPk);
        foreach ($salasDisponibles as $aula) {
            //if($aula->pk!=$salaPk)
           echo '<option value="'.$aula->pk.'">'.$aula->sala.'</option>';
        } 
       
    }
        public function getSala2(){//$semestre,$ano,$facultadPk,$periodo,$diaIni,$diaFin,$diaElegido
        
       $pkPeriodo=$this->input->post('periodo');
       $fecha=$this->input->post('datepicker');
       $salaFk=$this->input->post('aulafk');
       $salasDisponibles=$this->Sala_model->getSalasDisponibles2($pkPeriodo,$fecha,$salaFk);
        foreach ($salasDisponibles as $aula) {
            if($aula->pk!=$salaFk)
                echo '<option value="'.$aula->pk.'">'.$aula->sala.'</option>';
            else
                 echo '<option selected value="'.$aula->pk.'">'.$aula->sala.'</option>';

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
   /* public function comprobarDoc(){

                 $options = "";
        
       
            $facultadPk = $this->input->post('facultad');
            $salas = $this->admin_model->salas($facultadPk);
            foreach($salas as $fila)
            {
                echo'<option value='.$fila->pk.'>'.$fila->sala.'</option>';
            }

        

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

        
    }*/
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
    
    public function aprobarFinal($pkPedido=NULL) {
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        $fkadmin=$this->Admin_model->fkAdminn($_SESSION['rutAdmin']);
           // $pkPedido=$this->input->post('pkPedido');
            $updateReserva=$this->admin_model->aprobarReserva($pkPedido,$fkadmin->pk);
                
            $bita=$this->Admin_model->registrar($pkPedido,$fkadmin->pk);
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
    
    
    public function editarReser() {
        
          if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{  
                if($this->input->post('editar')=='Editar'){
                        $pkdocente=$this->input->post('pkdocente');//PK DEL DOCENTE
                        $campus=$_SESSION['campus'];
                        $pk=$this->input->post('pkReserva');
                        $solicitudReserva=$this->admin_model->getReservas($pk);


                        $fecha=$this->input->post('fecha');
                                                $docente=$this->admin_model->getPkDocente($pkdocente); //todos los datos de un docente
                        $academicos=$this->Docente_model->getAcademicoXCampus($campus);//todos los academicos

                        $asig=$this->Docente_model->getPkAsignatura($docente->pk);//saco la asignatura que tiene el docente
                        $ramos=$this->admin_model->getAsignaturaXCampus($campus);//extrae todas las asignaturas


                        $seccion=$this->input->post('seccion');
                        $sala=$this->input->post('sala');
                        $salaPk=$this->input->post('salaPk');
                        $periodoPk=$this->input->post('periodoPk');
       $salasDisponibles=$this->Sala_model->getSalasDisponibles($periodoPk,$fecha,$campus);


                        $pkPedido=$pk; 
                        $periodos= $this->Admin_model->getPeriodo();    
                        $semestre=$this->input->post('semestre');
                        $anio=$this->input->post('anio');
                        
                           // $aula=9;
                        $this->load->view('general/headers');
                        $this->load->view('general/menu_principal');
                        $this->load->view('general/abre_bodypagina');
                        $this->load->view('intranet/header_menu');
                        $this->load->view('intranet/editarReserva',compact('salasDisponibles','semestre','anio','periodoPk','sala','salaPk','seccion','fecha','asig','ramos','docente','periodos','academicos','solicitudReserva'));
                      
            //$this->load->view('intranet/editarReserva');

                        $this->load->view('general/cierre_bodypagina');
                        $this->load->view('general/cierre_footer');
                }else{
                    redirect('intranet/reservas', 'refresh');
                }

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
    public function comprobarEditReserva(){
        $pkPedido=$this->input->post('pkPedido');
        $fecha=$this->input->post('datepicker');
        $periodo=$this->input->post('periodo');
        $sala=$this->input->post('divSala');
        if($pkPedido!=null){
            $estado=$this->admin_model->comprobarReserva($pkPedido,$fecha,$periodo,$sala);
            if($estado>=1) echo 0;//0=false
            else echo 1;
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
                $semestre=$this->input->post('semestre');
                $anio=$this->input->post('anio');

                
                $esEditado=$this->admin_model->editarReserva($semestre,$anio,$pkPedido,$pkdocente,$pkAsignatura,$seccion,$fecha,$periodo,$pkSala);
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
                if(!isset($_SESSION['adminGeneral'])){
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
                        $this->load->view('adminGeneral/header_menuGeneral');
                             $this->load->view('adminGeneral/data2');
                                    $this->load->view('adminGeneral/info2');
                             $this->load->view('adminGeneral/cierreData');
                        $this->load->view('general/cierre_bodypagina');
                        $this->load->view('general/cierre_footer');
                }

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

    public function editFacultades(){//solo el admin general modifica facultades
            if(!isset($_SESSION['adminGeneral'])){
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
            $facultades=$this->admin_model->getFacultad();
                 $this->load->view('adminGeneral/data2');    
                     $this->load->view('intranet/editFacultades',compact('facultades'));
                 $this->load->view('adminGeneral/cierreData');    
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
            if(!isset($_SESSION['adminGeneral']))
                {
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/nosesion');
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');

                }else{
                    $campus=$this->admin_model->getCampus();
                    $facultades=$this->admin_model->getFacultad();
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('adminGeneral/header_menuGeneral');
                         $this->load->view('adminGeneral/data2');    
                             $this->load->view('intranet/agregarFacultades',compact('campus'));
                          $this->load->view('adminGeneral/cierreData');       
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }
        }else{
        if ($btnEditar=='Editar' && $accion!=null) {
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
                    $facultades=$this->admin_model->getFacultad();
                    $facultadesPk=$this->admin_model->getFacultadPk($accion);
                   // var_dump($facultadesPk);
                        $this->load->view('adminGeneral/data2');    
                              $this->load->view('intranet/editEditFacultades',compact("facultadesPk"));
                          $this->load->view('adminGeneral/cierreData');         
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
    public function modificarSalas(){
        $btnEditar=$this->input->post('editarSalas');
        $btnEliminar=$this->input->post('eliminarSalas');
        $accion=$this->input->post('accion');//array , checkbox, trae pk de los seleccionados
        $btnAgregar=$this->input->post('agregarSalas');
        

       // if ($facultadSeleccionada==null) {
         //   redirect('intranet/editSalas', 'refresh');
        //}
        if($btnAgregar=='Agregar'){
            if(!isset($_SESSION['usuarioAdmin']))
                {
                    if(!isset($_SESSION['adminGeneral'])){
                            $this->load->view('general/headers');
                            $this->load->view('general/menu_principal');
                            $this->load->view('general/abre_bodypagina');
                            $this->load->view('intranet/nosesion');
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }else{
                         $campusPertenece=$this->input->post('campus');

                            $campusOtrorgado=$this->admin_model->getNameCampus($campusPertenece);                        
                            $this->load->view('general/headers');
                            $this->load->view('general/menu_principal');
                            $this->load->view('general/abre_bodypagina');   
                            $this->load->view('adminGeneral/header_menuGeneral');
                                 $this->load->view('adminGeneral/data2');  
                                     $this->load->view('intranet/agregarSalas',compact('campusOtrorgado'));
                                  $this->load->view('adminGeneral/cierreData');       
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }

                }else{
                    $campusPertenece=$_SESSION['campus'];
                    $campusOtrorgado=$this->admin_model->getNameCampus($campusPertenece);                        
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('intranet/header_menu');
                         $this->load->view('intranet/data');  
                             $this->load->view('intranet/agregarSalas',compact('campusOtrorgado'));
                          $this->load->view('intranet/cierreData');       
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }
        }else{
               if ($btnEditar=='Editar' && $accion!=null) {
                           if(!isset($_SESSION['usuarioAdmin']))
                            {
                                if(!isset($_SESSION['adminGeneral'])){
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
                                        $salasPk=$this->admin_model->getSalaPk($accion);
                                            $this->load->view('adminGeneral/data2');    
                                                  $this->load->view('intranet/editEditSalas',compact("salasPk"));
                                              $this->load->view('adminGeneral/cierreData');         
                                        $this->load->view('general/cierre_bodypagina');
                                        $this->load->view('general/cierre_footer');
                                }

                            }else{
                                $this->load->view('general/headers');
                                $this->load->view('general/menu_principal');
                                $this->load->view('general/abre_bodypagina');   
                                $this->load->view('intranet/header_menu');
                                $salasPk=$this->admin_model->getSalaPk($accion);
                                    $this->load->view('intranet/data');    
                                          $this->load->view('intranet/editEditSalas',compact("salasPk"));
                                      $this->load->view('intranet/cierreData');         
                                $this->load->view('general/cierre_bodypagina');
                                $this->load->view('general/cierre_footer');
                            }
               }
               elseif($btnEliminar=='Eliminar' && $accion!=null) {
                          $estado=$this->admin_model->eliminarSala($accion);
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
                         redirect('intranet/editSalas', 'refresh');
                     }else{
                         echo '<script>alert("Algunos elementos no fueron eliminados"); </script>';
                         redirect('intranet/editSalas', 'refresh');
                     } 
               }else redirect('intranet/editSalas');
        }
    }
    public function updateFacultad(){
        $btn=$this->input->post('editarModificacion'); //el boton
        $pk=$this->input->post('pk');//el pk a cambiar los datos
        $newFacultad=$this->input->post('newFacultad');//array
        $newDescripcion=$this->input->post('newDescripcion');//array
        for ($i=0; $i <count($newFacultad) ; $i++) { 
            if($newFacultad[$i]=="" || $newDescripcion[$i]==""){
                        echo '<script>alert("Favor Rellene todos los campos"); </script>';
                         redirect('intranet/editFacultades', 'refresh');
            }

        }
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
    public function updateSalas(){
        $btn=$this->input->post('editSalas'); //el boton
        $pk=$this->input->post('pk');//el pk a cambiar los datos
        $newSala=$this->input->post('newSala');//array
        $newDescripcion=$this->input->post('newDescripcion');//array
        $chk=$this->input->post('chk');//array de los checkbox solo los seleccionados
        for ($i=0; $i <count($newSala) ; $i++) { 
            if($newSala[$i]=="" || $newDescripcion[$i]==""){
                        echo '<script>alert("Favor Rellene todos los campos"); </script>';
                         redirect('intranet/editSalas', 'refresh');
            }

        }
        for ($i=0; $i <count($pk)  ; $i++) { 
           $estadoArray[$i]=1;
        }
        for ($i=0; $i <count($chk) ; $i++) { 
           for ($j=0; $j <count($pk) ; $j++) { 
              if($pk[$j]==$chk[$i]){
               $estadoArray[$j]=0;
              }
           }
        }
        if($btn==null)redirect('intranet/config');
        else{
            $estado=$this->admin_model->updateSalas($pk,$newSala,$newDescripcion,$estadoArray);
             
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
                redirect('intranet/editSalas', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron actualizados"); </script>';
                redirect('intranet/editSalas', 'refresh');
            } 
        }
    }
    public function agregarFacultad(){
        $campus_fk=$this->input->post('campus');

        $addFacultad=$this->input->post('addFacultad');
        $addDesc=$this->input->post('addDesc');
        $btnEnviar=$this->input->post('enviarModificacion');
        for ($i=0; $i <count($addFacultad) ; $i++) { 
            if($addFacultad[$i]==null){
                echo '<script>alert("Favor Rellenar todos los Campos"); </script>';
                redirect('intranet/editFacultades', 'refresh');
            }
        }
        $facultadServer=$this->admin_model->getFacultad();
        for ($i=0; $i <count($facultadServer) ; $i++) { 
            for ($j=0; $j <count($addFacultad) ; $j++) { 
                if($facultadServer[$i]->facultad==$addFacultad[$j]){
                    ?>
                    <script>
                    var variablejs = "<?php echo $addFacultad[$j]; ?>" ;
                    </script>
                    <?php
                   // unset($addFacultad[$j]);//elimina ese reguistro
                    //$addFacultad = array_values($addFacultad);//reordena el array
                     echo '<script>alert("El registo >"+variablejs+"< ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('intranet/editFacultades', 'refresh');
                }

            }
        }
        /*if(count($addFacultad==0)){//al eliminar un registro del array x si queda vacio
            redirect('intranet/editFacultades', 'refresh');
        }*/
        if($btnEnviar=='Enviar')
        {
            $estado=$this->admin_model->addFacultades($addFacultad,$addDesc,$campus_fk);
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
    public function agregarSala(){
        $addSala=$this->input->post('addSala');
        $pkCampus=$this->input->post('pkCampus');
        $btnEnviar=$this->input->post('enviarModificacion');
        for ($i=0; $i <count($addSala) ; $i++) { 
            if($addSala[$i]==null){
                echo '<script>alert("Favor Rellenar todos los Campos"); </script>';
                redirect('intranet/editSalas', 'refresh');
            }
        }
        $salaServer=$this->admin_model->getSala();
        for ($i=0; $i <count($salaServer) ; $i++) { 
            for ($j=0; $j <count($addSala) ; $j++) { 
                if($salaServer[$i]->sala==$addSala[$j]){
                    ?>
                    <script>
                    var variablejs = "<?php echo $addSala[$j]; ?>" ;
                    </script>
                    <?php
                    //unset($addSala[$j]);//elimina ese reguistro
                    //$salaServer = array_values($salaServer);//reordena el array
                     echo '<script>alert("El registo >"+variablejs+"< ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('intranet/editSalas', 'refresh');
                }

            }
        }
        if($btnEnviar=='Enviar')
        {
            $estado=$this->admin_model->addSalas($addSala,$pkCampus);
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
                        redirect('intranet/editSalas', 'refresh');
                    }else{
                        echo '<script>alert("Algunos elementos no fueron agregados"); </script>';
                        redirect('intranet/editSalas', 'refresh');
                    }
        }
        else redirect('intranet/editSalas');
    }
    public function editSalas(){
        if(!isset($_SESSION['usuarioAdmin']))
        {
            if(!isset($_SESSION['adminGeneral'])){
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
            else{
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('adminGeneral/header_menuGeneral');
                    //$salas=$this->admin_model->getSalaPorFk();
                    //$cantidadFacultad=$this->admin_model->getCantFacu();
                    $campusName=$this->admin_model->getCampus();
                        $this->load->view('adminGeneral/data2');
                             $this->load->view('adminGeneral/editSalas',compact("campusName"));
                         $this->load->view('adminGeneral/cierreData');          
                    $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
            }
        }else{
            $this->load->view('general/headers');
            $this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');   
            $this->load->view('intranet/header_menu');
            //$salas=$this->admin_model->getSalaPorFk();
               // $cantidadFacultad=$this->admin_model->getCantFacu();
                $salaXCampus=$this->admin_model->getSalaCampus2($_SESSION['campus']);
                $this->load->view('intranet/data');
                     $this->load->view('intranet/editSalas',compact("salaXCampus"));
                 $this->load->view('intranet/cierreData');          
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
        }
    }
    public function editPeriodos(){
    if(!isset($_SESSION['adminGeneral']))
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
        $this->load->view('adminGeneral/header_menuGeneral');
            $this->load->view('adminGeneral/data2');
                 $this->load->view('intranet/editperiodo',compact('periodos'));
            $this->load->view('adminGeneral/cierreData');     
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
    public function planilla(){
            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                    $date=$this->clases_model->getDate();
                    $time=$this->clases_model->getTime();

                    $cantPeriodo=$this->clases_model->cantPer();
                    $hoy=$this->clases_model->getHoy2($time , $date,$cantPeriodo->cantidad);
                 // var_dump($hoy);
                 //  echo $cantPeriodo->cantidad;
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/mostrarPlanilla',compact('hoy','time','date','cantPeriodo'));//consulta academico
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
    }
    public function descargar(){
        $descargar=$this->input->post('Descargar');
        $periodo=$this->input->post('periodoHidden');
        $date=$this->clases_model->getDate();
        if($descargar=="Descargar"){
           $this->excel->setActiveSheetIndex(0);
            $data=$this->admin_model->save($periodo,$date);
         $this->excel->stream('prueba1.xls', $data);
        }
    }
    public function suspencion(){
            $btnSuspender=$this->input->post('suspender');
            $pkReserva=$this->input->post('pkReserva');
            $motivo=$this->input->post('motivo');
            $motivo="suspendida por: ".$motivo;
            if($btnSuspender=="suspender"){ 
              $estado=$this->clases_model->suspender($pkReserva,$motivo);
              if ($estado==true) {
                    echo '<script>alert("Clase Suspendida con Exito"); </script>';
                    redirect('intranet/planilla', 'refresh');
              }else {
                    echo '<script>alert("Alguna Clase no fue Suspendida"); </script>';
                    redirect('intranet/planilla', 'refresh');
              }
            }else{
                redirect('intranet/planilla', 'refresh');
            }

    }
    public function habilitar($pkPedido=NULL){
        if(!isset($_SESSION['usuarioAdmin'])){
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/nosesion');
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');

        }else{
            
            $estado=$this->clases_model->habilitar($pkPedido);
             if($estado==true){
                   echo '<script>alert("Registro Habilitado"); </script>';
                   redirect('intranet/planilla', 'refresh');
              } 
              else{
                   echo '<script>alert("A ocurrido un error al habilitar el pedido"); </script>';
                   redirect('intranet/planilla', 'refresh');
             } 
        }
    }
    public function editDocentes(){
        if(!isset($_SESSION['usuarioAdmin'])){
                    if(!isset($_SESSION['adminGeneral'])){
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
                            //$facultad=2;///VEER MAAAS TAAARDEEEE!!!!!!!!!!!***********************
                            $getDptos=$this->admin_model->getdptoAll();//bien xq es el admingeneral :D                       
                                $this->load->view('adminGeneral/data2');
                                     $this->load->view('adminGeneral/editdoc',compact('getDptos'));
                                 $this->load->view('adminGeneral/cierreData');          
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }
        }
        else{
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');   
        $this->load->view('intranet/header_menu');
        $campus_fk=$_SESSION['campus'];
        $getDptos=$this->admin_model->getdpto($campus_fk);
            $this->load->view('intranet/data');
                 $this->load->view('intranet/editdoc',compact('getDptos'));
             $this->load->view('intranet/cierreData');          
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        }
    }
        public function llena_docDpto(){
            if($this->input->post('dpto'))
            {
                $dpto = $this->input->post('dpto');//id
                $getDoc = $this->admin_model->getDocPorDpto($dpto);
                foreach($getDoc as $fila)
                {
                    
                                echo'   <div class="form-group">
                                            <label  class="col-sm-2 control-label" id="c">Docente</label>
                                            <div class="col-lg-8">
                                                <div class="input-group">  
                                                    <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                                        <input class="form-control" readonly="readonly" type="text" value="'.$fila->nombres." ".$fila->apellidos.'">
                                                   
                                                </div>
                                            </div>  
                                        </div>';
                }

            
            }
     }
    public function llena_docDptoGral(){
            if($this->input->post('facu'))
            {
                $pkFacultad = $this->input->post('facu');//id
                $getDoc = $this->admin_model->getDocPorFacu($pkFacultad);
                foreach($getDoc as $fila)
                {
                    
                                echo'   <div class="form-group">
                                            <label  class="col-sm-2 control-label" id="c">Docente</label>
                                            <div class="col-lg-8">
                                                <div class="input-group">  
                                                    <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                                        <input class="form-control" readonly="readonly" type="text" value="'.$fila->nombres." ".$fila->apellidos.'">
                                                   
                                                </div>
                                            </div>  
                                        </div>';
                }

            
            }
     }
         public function llena_docDptoGral2(){
            if($this->input->post('dpto'))
            {
                $pkDpto = $this->input->post('dpto');//id
                $getDoc = $this->admin_model->getDocPorDpto($pkDpto);
                foreach($getDoc as $fila)
                {
                    
                                echo'   <div class="form-group">
                                            <label  class="col-sm-2 control-label" id="c">Docente</label>
                                            <div class="col-lg-8">
                                                <div class="input-group">  
                                                    <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                                        <input class="form-control" readonly="readonly" type="text" value="'.$fila->nombres." ".$fila->apellidos.'">
                                                   
                                                </div>
                                            </div>  
                                        </div>';
                }

            
            }
     }
     public function modificarDoc(){
        $btnEditar=$this->input->post('editarDoc');
        $btnEliminar=$this->input->post('eliminarDoc');
        $accion=$this->input->post('accion');//array , checkbox, trae pk de los seleccionados
        $btnAgregar=$this->input->post('agregarDoc');
        $dptoSeleccionada=$this->input->post('dpto');
        if($dptoSeleccionada==null)$dptoSeleccionada=$this->input->post('facu');

        if ($dptoSeleccionada==null) {
            redirect('intranet/editDocentes', 'refresh');
        }
        if($btnAgregar=='Agregar'){
            if(!isset($_SESSION['usuarioAdmin']))
                {
                    if(!isset($_SESSION['adminGeneral'])){
                            $this->load->view('general/headers');
                            $this->load->view('general/menu_principal');
                            $this->load->view('general/abre_bodypagina');
                            $this->load->view('intranet/nosesion');
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }else{
                    $docOtorgado=$this->admin_model->getNameDpto($dptoSeleccionada);                                              
                            $this->load->view('general/headers');
                            $this->load->view('general/menu_principal');
                            $this->load->view('general/abre_bodypagina');   
                            $this->load->view('adminGeneral/header_menuGeneral');
                                 $this->load->view('adminGeneral/data2');  
                                     $this->load->view('adminGeneral/agregarDoc',compact('docOtorgado'));
                                  $this->load->view('adminGeneral/cierreData');       
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }

                }else{
                    $docOtorgado=$this->admin_model->getNameDpto($dptoSeleccionada);                        
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('intranet/header_menu');
                         $this->load->view('intranet/data');  
                             $this->load->view('intranet/agregarDoc',compact('docOtorgado'));
                          $this->load->view('intranet/cierreData');       
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }
        }else{
               if ($btnEditar=='Editar' && $accion!=null) {
                           if(!isset($_SESSION['usuarioAdmin']))
                            {
                                if(!isset($_SESSION['adminGeneral'])){
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
                                        $docPk=$this->admin_model->getDocEdit($accion);
                                            $this->load->view('adminGeneral/data2');    
                                                  $this->load->view('intranet/editEditDoc',compact("docPk"));
                                              $this->load->view('adminGeneral/cierreData');         
                                        $this->load->view('general/cierre_bodypagina');
                                        $this->load->view('general/cierre_footer');
                                }

                            }else{
                                $this->load->view('general/headers');
                                $this->load->view('general/menu_principal');
                                $this->load->view('general/abre_bodypagina');   
                                $this->load->view('intranet/header_menu');
                                $docPk=$this->admin_model->getDocEdit($accion);
                                    $this->load->view('intranet/data');    
                                          $this->load->view('intranet/editEditDoc',compact("docPk"));
                                      $this->load->view('intranet/cierreData');         
                                $this->load->view('general/cierre_bodypagina');
                                $this->load->view('general/cierre_footer');
                            }
               }
               elseif($btnEliminar=='Eliminar' && $accion!=null) {
                          $estado=$this->admin_model->eliminarDocente($accion);
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
                         redirect('intranet/editDocentes', 'refresh');
                     }else{
                         echo '<script>alert("Algunos elementos no fueron eliminados"); </script>';
                         redirect('intranet/editDocentes', 'refresh');
                     } 
               }else redirect('intranet/editDocentes');
        }
     }
     public function agregarDoc(){
        $addDocName=ucwords(strtolower($this->input->post('addDocName')));
        $addDocApe=ucwords(strtolower($this->input->post('addDocApe')));
        $addDocRut=$this->input->post('rut');

        $pkDpto=$this->input->post('pkDpto');
        $btnEnviar=$this->input->post('enviarModificacion');

 
        $docServer=$this->admin_model->getdocAll();

        //////////

        for ($i=0; $i <count($docServer) ; $i++) { 
                if($docServer[$i]->rut==$addDocRut){
                    ?>
                    <script>
                    var variablejs = "<?php echo $docServer[$i]->rut; ?>" ;
                    </script>
                    <?php
                    //unset($addSala[$j]);//elimina ese reguistro
                    //$salaServer = array_values($salaServer);//reordena el array
                     echo '<script>alert("El registo > "+variablejs+" < ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('intranet/editDocentes', 'refresh');
                }
        }
        if($btnEnviar=="Enviar"){
            $estado=$this->admin_model->agregarDocente($pkDpto,$addDocName,$addDocApe,$addDocRut);
            if($estado==true){
                echo '<script>alert("Registro Agregado exitosamente"); </script>';
                 redirect('intranet/editDocentes', 'refresh');
            }
        }else redirect('intranet/editDocentes');
     }
     public function updateDoc(){
        $btn=$this->input->post('editDoc'); //el boton
        $pk=$this->input->post('pk');//el pk a cambiar los datos
        $newName=$this->input->post('newName');//array
        $newApellidos=$this->input->post('newApellidos');//array
        for ($i=0; $i <count($newName) ; $i++) { 
            if($newName[$i]=="" || $newApellidos[$i]==""){
                        echo '<script>alert("Favor Rellene todos los campos"); </script>';
                         redirect('intranet/editDocentes', 'refresh');
            }

        }

        if($btn==null)redirect('intranet/config');
        else{
            $estado=$this->admin_model->updateDocentes($pk,$newName,$newApellidos);
             
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
                redirect('intranet/editDocentes', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron actualizados"); </script>';
                redirect('intranet/editDocentes', 'refresh');
            } 
        }
     }
    public function editAsignaturas(){
       if(!isset($_SESSION['usuarioAdmin'])){
                    if(!isset($_SESSION['adminGeneral'])){
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
                            $getDptos=$this->admin_model->getdptoAll();//bien xq es el admingeneral :D
                                $this->load->view('adminGeneral/data2');
                                     $this->load->view('intranet/editasig',compact('getDptos'));
                                 $this->load->view('adminGeneral/cierreData');          
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }
        }
        else{
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');   
        $this->load->view('intranet/header_menu');
        $campus_fk=$_SESSION['campus'];
        $getDptos=$this->admin_model->getdpto($campus_fk);
            $this->load->view('intranet/data');
                 $this->load->view('intranet/editasig',compact('getDptos'));
             $this->load->view('intranet/cierreData');          
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        } 
    }
    public function llena_docDpto2(){
        if($this->input->post('dpto'))
        {
            $dpto = $this->input->post('dpto');//id
            $getDoc = $this->admin_model->getAsigPorDpto($dpto);
            foreach($getDoc as $fila)
            {
                
                            echo'   <div class="form-group">
                                        <label  class="col-sm-2 control-label" id="c">Asignatura</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">  
                                                <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                                    <input class="form-control" readonly="readonly" type="text" value="'.$fila->codigo." ".$fila->nombre.'">
                                               
                                            </div>
                                        </div>  
                                    </div>';
            }

        
        }
    }
    public function modificarAsig(){
        $btnEditar=$this->input->post('editarAsig');
        $btnEliminar=$this->input->post('eliminarAsig');
        $accion=$this->input->post('accion');//array , checkbox, trae pk de los seleccionados
        $btnAgregar=$this->input->post('agregarAsig');
        $dptoSeleccionada=$this->input->post('dpto');

        if ($dptoSeleccionada==null) {
            redirect('intranet/editAsignaturas', 'refresh');
        }
        if($btnAgregar=='Agregar'){
            if(!isset($_SESSION['usuarioAdmin']))
                {
                    if(!isset($_SESSION['adminGeneral'])){
                            $this->load->view('general/headers');
                            $this->load->view('general/menu_principal');
                            $this->load->view('general/abre_bodypagina');
                            $this->load->view('intranet/nosesion');
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }else{
                            $docOtorgado=$this->admin_model->getNameDpto($dptoSeleccionada);                        
                            $this->load->view('general/headers');
                            $this->load->view('general/menu_principal');
                            $this->load->view('general/abre_bodypagina');   
                            $this->load->view('adminGeneral/header_menuGeneral');
                                 $this->load->view('adminGeneral/data2');  
                                     $this->load->view('intranet/agregarAsig',compact('docOtorgado'));
                                  $this->load->view('adminGeneral/cierreData');       
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }

                }else{
                    $docOtorgado=$this->admin_model->getNameDpto($dptoSeleccionada);                        
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('intranet/header_menu');
                         $this->load->view('intranet/data');  
                             $this->load->view('intranet/agregarAsig',compact('docOtorgado'));
                          $this->load->view('intranet/cierreData');       
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
                }
        }else{
               if ($btnEditar=='Editar' && $accion!=null) {
                           if(!isset($_SESSION['usuarioAdmin']))
                            {
                                if(!isset($_SESSION['adminGeneral'])){
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
                                        $asigPk=$this->admin_model->getAsigEdit($accion);
                                            $this->load->view('adminGeneral/data2');    
                                                  $this->load->view('intranet/editEditAsig',compact("asigPk"));
                                              $this->load->view('adminGeneral/cierreData');         
                                        $this->load->view('general/cierre_bodypagina');
                                        $this->load->view('general/cierre_footer');
                                }

                            }else{
                                $this->load->view('general/headers');
                                $this->load->view('general/menu_principal');
                                $this->load->view('general/abre_bodypagina');   
                                $this->load->view('intranet/header_menu');
                                $asigPk=$this->admin_model->getAsigEdit($accion);
                                    $this->load->view('intranet/data');    
                                          $this->load->view('intranet/editEditAsig',compact("asigPk"));
                                      $this->load->view('intranet/cierreData');         
                                $this->load->view('general/cierre_bodypagina');
                                $this->load->view('general/cierre_footer');
                            }
               }
               elseif($btnEliminar=='Eliminar' && $accion!=null) {
                          $estado=$this->admin_model->eliminarAsig($accion);
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
                         redirect('intranet/editAsignaturas', 'refresh');
                     }else{
                         echo '<script>alert("Algunos elementos no fueron eliminados"); </script>';
                         redirect('intranet/editAsignaturas', 'refresh');
                     } 
               }else redirect('intranet/editAsignaturas');
        }
     }
    public function agregarAsig(){
        $addAsigName=ucwords(strtolower($this->input->post('addAsigName')));
        $addAsigCod=strtoupper($this->input->post('addAsigCod'));//codigo a mayusculas
        $addAsigDesc=ucwords(strtolower($this->input->post('addAsigDesc')));

        $pkDpto=$this->input->post('pkDpto');
        $btnEnviar=$this->input->post('enviarModificacion');
        $asigServer=$this->admin_model->getAsigPorDpto($pkDpto);
//verifico si no esta ingresado el codigo de la asignatura antes
        for ($i=0; $i <count($asigServer) ; $i++) { 
                if($asigServer[$i]->codigo==$addAsigCod){
                    ?>
                    <script>
                    var variablejs = "<?php echo $asigServer[$i]->codigo; ?>" ;
                    </script>
                    <?php
                    //unset($addSala[$j]);//elimina ese reguistro
                    //$salaServer = array_values($salaServer);//reordena el array
                     echo '<script>alert("El registo > "+variablejs+" < ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('intranet/editAsignaturas', 'refresh');
                }
        }
//fin verificacion        
        if($btnEnviar=="Enviar"){
            $estado=$this->admin_model->agregarAsig($pkDpto,$addAsigName,$addAsigCod,$addAsigDesc);
            if($estado==true){
                echo '<script>alert("Registro Agregado exitosamente"); </script>';
                 redirect('intranet/editAsignaturas', 'refresh');
            }
        }else redirect('intranet/editAsignaturas');
     }
     public function updateAsig(){
        $btn=$this->input->post('editAsig'); //el boton
        $pk=$this->input->post('pk');//el pk a cambiar los datos
        $newName=$this->input->post('newName');//array
        $newCodigo=$this->input->post('newCodigo');//array
        for ($i=0; $i <count($newName) ; $i++) { 
            if($newName[$i]=="" || $newCodigo[$i]==""){
                        echo '<script>alert("Favor Rellene todos los campos"); </script>';
                         redirect('intranet/editAsignaturas', 'refresh');
            }

        }

        if($btn==null)redirect('intranet/config');
        else{
            $estado=$this->admin_model->updateAsignaturas($pk,$newName,$newCodigo);
             
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
                redirect('intranet/editAsignaturas', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron actualizados"); </script>';
                redirect('intranet/editAsignaturas', 'refresh');
            } 
        }        
     }
     public function editDepartamentos(){
        if(!isset($_SESSION['adminGeneral'])){
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
                $facultades=$this->admin_model->getFacultad();
                     $this->load->view('adminGeneral/data2');    
                         $this->load->view('adminGeneral/editDpto',compact('facultades'));
                     $this->load->view('adminGeneral/cierreData');    
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
     }
     public function llena_dptoFacu(){
        if($this->input->post('facu'))
            {
                $facu = $this->input->post('facu');//id
                $getDpto = $this->admingeneral_model->getDptoPorFacu($facu);
                foreach($getDpto as $fila)
                {
                    
                                echo'   <div class="form-group">
                                            <label  class="col-sm-3 control-label" id="c">Departamento</label>
                                            <div class="col-lg-7">
                                                <div class="input-group">  
                                                    <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                                        <input class="form-control" readonly="readonly" type="text" value="'.$fila->departamento.'">
                                                   
                                                </div>
                                            </div>  
                                        </div>';
                }

            
            }
     }
     public function modificarDpto(){
        $btnEditar=$this->input->post('editarDpto');
        $btnEliminar=$this->input->post('eliminarDpto');
        $accion=$this->input->post('accion');//array , checkbox, trae pk de los seleccionados
        $btnAgregar=$this->input->post('agregarDpto');
        $facuSeleccionada=$this->input->post('facu');

        if ($facuSeleccionada==null) {
            redirect('intranet/editDepartamentos', 'refresh');
        }
        if($btnAgregar=='Agregar'){
            if(!isset($_SESSION['adminGeneral'])){
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/nosesion');
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
            }else{
                    $facuOtorgado=$this->admingeneral_model->getFacultadName($facuSeleccionada);                        
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('adminGeneral/header_menuGeneral');
                         $this->load->view('adminGeneral/data2');  
                             $this->load->view('adminGeneral/agregarDpto',compact('facuOtorgado'));
                          $this->load->view('adminGeneral/cierreData');       
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
            }


        }else{
               if ($btnEditar=='Editar' && $accion!=null) {
                    if(!isset($_SESSION['adminGeneral'])){
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
                            $dptoPk=$this->admingeneral_model->getDptoEdit($accion);
                                $this->load->view('adminGeneral/data2');    
                                      $this->load->view('adminGeneral/editEditDpto',compact("dptoPk"));
                                  $this->load->view('adminGeneral/cierreData');         
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }
               }
               elseif($btnEliminar=='Eliminar' && $accion!=null) {
                          $estado=$this->admingeneral_model->eliminarDpto($accion);
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
                         redirect('intranet/editDepartamentos', 'refresh');
                     }else{
                         echo '<script>alert("Algunos elementos no fueron eliminados"); </script>';
                         redirect('intranet/editDepartamentos', 'refresh');
                     } 
               }else redirect('intranet/editDepartamentos');
        }        
     }
     public function agregarDpto(){
        $addAsigName=$this->input->post('addDptoName');
        $addAsigDesc=$this->input->post('addDptoDesc');
        $pkFacu=$this->input->post('pkFacu');
        $btnEnviar=$this->input->post('enviarModificacion');
        $asigServer=$this->admingeneral_model->getDptoPorFacu($pkFacu);
//verifico si no esta ingresado el codigo de la asignatura antes
        for ($i=0; $i <count($asigServer) ; $i++) { 
                if($asigServer[$i]->departamento==$addAsigName){
                    ?>
                    <script>
                    var variablejs = "<?php echo $asigServer[$i]->departamento; ?>" ;
                    </script>
                    <?php
                    //unset($addSala[$j]);//elimina ese reguistro
                    //$salaServer = array_values($salaServer);//reordena el array
                     echo '<script>alert("El registo > "+variablejs+" < ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('intranet/editDepartamentos', 'refresh');
                }
        }
//fin verificacion        
        if($btnEnviar=="Enviar"){
            $estado=$this->admingeneral_model->agregarDpto($addAsigName,$addAsigDesc,$pkFacu);
            if($estado==true){
                echo '<script>alert("Registro Agregado exitosamente"); </script>';
                 redirect('intranet/editDepartamentos', 'refresh');
            }
        }else redirect('intranet/editDepartamentos');        
     }
     public function updateDpto(){
        $btn=$this->input->post('editDpto'); //el boton
        $pk=$this->input->post('pk');//el pk a cambiar los datos
        $newName=$this->input->post('newName');//array
        for ($i=0; $i <count($newName) ; $i++) { 
            if($newName[$i]==""){
                        echo '<script>alert("Favor Rellene todos los campos"); </script>';
                         redirect('intranet/editDepartamentos', 'refresh');
            }
        }
        if($btn==null)redirect('intranet/config');
        else{
            $estado=$this->admingeneral_model->updateDepartamento($pk,$newName);
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
                redirect('intranet/editDepartamentos', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron actualizados"); </script>';
                redirect('intranet/editDepartamentos', 'refresh');
            } 
        }        
     }
     public function editEscuelas(){
        if(!isset($_SESSION['adminGeneral'])){
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
                $dptos=$this->admin_model->getdptoAll();
                     $this->load->view('adminGeneral/data2');    
                         $this->load->view('adminGeneral/editEscu',compact('dptos'));
                     $this->load->view('adminGeneral/cierreData');    
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
     }
     public function llena_escuDpto(){
        if($this->input->post('dpto'))
            {
                $dpto = $this->input->post('dpto');//id
                $getDpto = $this->admingeneral_model->getEscuPorDpto($dpto);
                foreach($getDpto as $fila)
                {
                    echo'   <div class="form-group">
                                <label  class="col-sm-3 control-label" id="c">Escuela</label>
                                <div class="col-lg-7">
                                    <div class="input-group">  
                                        <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
                                            <input class="form-control" readonly="readonly" type="text" value="'.$fila->escuela.'">
                                       
                                    </div>
                                </div>  
                            </div>';
                }
            }
     }
     public function modificarEscu(){
        $btnEditar=$this->input->post('editarEscu');
        $btnEliminar=$this->input->post('eliminarEscu');
        $accion=$this->input->post('accion');//array , checkbox, trae pk de los seleccionados
        $btnAgregar=$this->input->post('agregarEscu');
        $dptoSeleccionada=$this->input->post('dpto');

        if ($dptoSeleccionada==null) {
            redirect('intranet/editEscuelas', 'refresh');
        }
        if($btnAgregar=='Agregar'){
            if(!isset($_SESSION['adminGeneral'])){
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/nosesion');
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
            }else{
                    $dptoOtrogado=$this->admingeneral_model->getDptoName($dptoSeleccionada);                        
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');   
                    $this->load->view('adminGeneral/header_menuGeneral');
                         $this->load->view('adminGeneral/data2');  
                             $this->load->view('adminGeneral/agregarEscu',compact('dptoOtrogado'));
                          $this->load->view('adminGeneral/cierreData');       
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
            }


        }else{
               if ($btnEditar=='Editar' && $accion!=null) {
                    if(!isset($_SESSION['adminGeneral'])){
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
                            $escuPk=$this->admingeneral_model->getEscuEdit($accion);
                                $this->load->view('adminGeneral/data2');    
                                      $this->load->view('adminGeneral/editEditEscu',compact("escuPk"));
                                  $this->load->view('adminGeneral/cierreData');         
                            $this->load->view('general/cierre_bodypagina');
                            $this->load->view('general/cierre_footer');
                    }
               }
               elseif($btnEliminar=='Eliminar' && $accion!=null) {
                          $estado=$this->admingeneral_model->eliminarEscu($accion);
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
                         redirect('intranet/editEscuelas', 'refresh');
                     }else{
                         echo '<script>alert("Algunos elementos no fueron eliminados"); </script>';
                         redirect('intranet/editEscuelas', 'refresh');
                     } 
               }else redirect('intranet/editEscuelas');
        }        
     }
     public function agregarEscu(){
        $addEscuName=$this->input->post('addEscuName');
        $addEscuDesc=$this->input->post('addEscuDesc');
        $pkDpto=$this->input->post('pkDpto');
        $btnEnviar=$this->input->post('enviarModificacion');
        $asigServer=$this->admingeneral_model->getEscuPorDpto($pkDpto);
//verifico si no esta ingresado el codigo de la asignatura antes
        for ($i=0; $i <count($asigServer) ; $i++) { 
                if($asigServer[$i]->escuela==$addEscuName){
                    ?>
                    <script>
                    var variablejs = "<?php echo $asigServer[$i]->escuela; ?>" ;
                    </script>
                    <?php
                    //unset($addSala[$j]);//elimina ese reguistro
                    //$salaServer = array_values($salaServer);//reordena el array
                     echo '<script>alert("El registo > "+variablejs+" < ya esta ingresado en el sistema");</script>';//agregar que facultad es
                    redirect('intranet/editEscuelas', 'refresh');
                }
        }
//fin verificacion        
        if($btnEnviar=="Enviar"){
            $estado=$this->admingeneral_model->agregarEscu($addEscuName,$addEscuDesc,$pkDpto);
            if($estado==true){
                echo '<script>alert("Registro Agregado exitosamente"); </script>';
                 redirect('intranet/editEscuelas', 'refresh');
            }
        }else redirect('intranet/editEscuelas');        
     }
     public function updateEscu(){
        $btn=$this->input->post('editEscu'); //el boton
        $pk=$this->input->post('pk');//el pk a cambiar los datos
        $newName=$this->input->post('newName');//array
        for ($i=0; $i <count($newName) ; $i++) { 
            if($newName[$i]==""){
                        echo '<script>alert("Favor Rellene todos los campos"); </script>';
                         redirect('intranet/editEscuelas', 'refresh');
            }
        }
        if($btn==null)redirect('intranet/config');
        else{
            $estado=$this->admingeneral_model->updateEscuelas($pk,$newName);
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
                redirect('intranet/editEscuelas', 'refresh');
            }else{
                echo '<script>alert("Algunos elementos no fueron actualizados"); </script>';
                redirect('intranet/editEscuelas', 'refresh');
            } 
        }        
     }
     public function reportes(){
            if(!isset($_SESSION['usuarioAdmin']))
            {
                    $this->load->view('general/headers');
                    $this->load->view('general/menu_principal');
                    $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/nosesion');
                    $this->load->view('general/cierre_bodypagina');
                    $this->load->view('general/cierre_footer');
            }else{
                 //$facultades=$this->admin_model->getFacultad();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('intranet/header_menu');
                     $this->load->view('intranet/data');
                            $this->load->view('intranet/infoReportes');
                     $this->load->view('intranet/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
     }
     public function descargaReporte(){
        $btn=$this->input->post('btnEnviar');
        $fechaIni=$this->input->post('datepickerInicio');
        $fechaFin=$this->input->post('datepickerTermino');
        if($btn=="Enviar"){
            $this->excel->setActiveSheetIndex(0);
            $data=$this->admin_model->save2($fechaIni,$fechaFin);
           // var_dump($data);
            $this->excel->stream2('prueba2.xls', $data);

        }


     }       
}