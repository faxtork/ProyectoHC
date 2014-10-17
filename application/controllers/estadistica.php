<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Estadistica extends CI_Controller{

		function __construct()
		{
			parent::__construct();
            session_start();
			$this->load->model('docente_model');
            $this->load->model('clases_model');
            $this->load->model('admin_model');
            $this->load->model('asistencia_model');


        }
        function index(){
        	/*$this->load->view('general/headers');
        	$this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');
            $this->load->view('estadistica/est_bienvenido');
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');  */
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('estadistica/est_bienvenido');
                     $this->load->view('estadistica/data');
                            $this->load->view('estadistica/info');
                     $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

	   }
       public function salas(){
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('estadistica/est_bienvenido');
                     $this->load->view('estadistica/data');
                            $this->load->view('estadistica/aula');
                     $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
       }
       public function asistencia(){
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');   
                $this->load->view('estadistica/est_bienvenido');
                     $this->load->view('estadistica/data');
            $campus=$this->asistencia_model->getCampusName();

                            $this->load->view('estadistica/infoAsistencia',compact('campus'));
                     $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
       }
       public function nivelUtemDia(){
            $fecha=$this->input->post('datepi');
             $total=$this->asistencia_model->totalAsistencia($fecha);
             $totalNo=$this->asistencia_model->totalNoAsistencia($fecha);

             if($total->asistieron==0 && $totalNo->noasistieron==0)
                echo false;
            else{
                    echo  $total->asistieron;
                    echo "/";
                    echo $totalNo->noasistieron;
            }

       }
        public function nivelUtemMes(){
            $selectAnio=$this->input->post('selectAnio');
            $sumSi=0;
            $sumNo=0;

             $totalMesSi=$this->asistencia_model->totalAsistenciaMes2($selectAnio);
             $totalMesNo=$this->asistencia_model->totalAusenciaMes2($selectAnio);

            for ($i=0; $i <count($totalMesSi) ; $i++) { 
                    foreach ($totalMesSi[$i] as $fila) {
                     $mesesAsistio[]=$fila->asistieron;
                       $sumSi=$sumSi+$fila->asistieron;

                    }
            }
            for ($i=0; $i <count($totalMesNo) ; $i++) { 
                    foreach ($totalMesNo[$i] as $fila) {
                     $mesesAusente[]=$fila->asistieron;
                       $sumNo=$sumNo+$fila->asistieron;

                    }
            }

             if($sumNo==0 && $sumSi==0)
                echo false;
            else{
            $merge=array_merge($mesesAsistio,$mesesAusente);
                echo  json_encode($merge);

            }
       }
       /**************/
        public function nivelUtemYear(){
            $selectAnio=$this->input->post('selectYear');
            $yearIni=$selectAnio."-01-01";
            $yearFin=($selectAnio+1)."-01-01";
             $totalYearSi=$this->asistencia_model->totalAsistenciaMes($yearIni,$yearFin);
             $totalYearNo=$this->asistencia_model->totalAusenciaMes($yearIni,$yearFin);
             if($totalYearSi->asistieron==0 && $totalYearNo->noasistieron==0)
                echo false;
            else{
                    echo  $totalYearSi->asistieron;
                    echo "/";
                    echo $totalYearNo->noasistieron;
            }
       }
        public function nivelCampusDia(){
            $fecha=$this->input->post('datepi');
            $campus=$this->asistencia_model->getCampusName();
            $sumSi=0;
            $sumNo=0;

            foreach ($campus as $key ) {
                $nameCampus[]=$key->nombre;
                $totalAsist[]=$key->nombre;
            }

            $asistenciaCampus=$this->asistencia_model->totalAsistenciaPorCampus($nameCampus,$fecha);
            for ($i=0; $i <count($asistenciaCampus) ; $i++) { 
                    foreach ($asistenciaCampus[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }
            $NoasistenciaCampus=$this->asistencia_model->totalNoAsistenciaPorCampus($nameCampus,$fecha);
            for ($i=0; $i <count($NoasistenciaCampus) ; $i++) { 
                    foreach ($NoasistenciaCampus[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else    
         echo json_encode($totalAsist);
            //echo $totalAsist;

       }
    public function nivelCampusMes(){
            $selectAnio=$this->input->post('selectAnio');
            $selectCampusPk=$this->input->post('selectCampus');
            $sumSi=0;
            $sumNo=0;

            $asistenciaCampus=$this->asistencia_model->totalAsistenciaPorCampusMes($selectAnio,$selectCampusPk);
            for ($i=0; $i <count($asistenciaCampus) ; $i++) { 
                    foreach ($asistenciaCampus[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }
            $NoasistenciaCampus=$this->asistencia_model->totalNoAsistenciaPorCampusMes($selectAnio,$selectCampusPk);
            for ($i=0; $i <count($asistenciaCampus) ; $i++) {         
                    foreach ($NoasistenciaCampus[$i] as $fila) {
                       $totalAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }        
    
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else    
         echo json_encode($totalAsist);
            //echo $totalAsist;

       }
       public function nivelFacultadDia(){
                    $fecha=$this->input->post('datepi');
            $facultad=$this->asistencia_model->getFacultadName();
            $sumSi=0;
            $sumNo=0;

            foreach ($facultad as $key ) {
                $nameFacultad[]=$key->facultad;
                $totalAsist[]=$key->facultad;
            }

            $asistenciaFacul=$this->asistencia_model->totalAsistenciaPorFacul($nameFacultad,$fecha);
            for ($i=0; $i <count($asistenciaFacul) ; $i++) { 
                    foreach ($asistenciaFacul[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }
            $ausenciaFacul=$this->asistencia_model->totalNoAsistenciaPorFacul($nameFacultad,$fecha);
            for ($i=0; $i <count($ausenciaFacul) ; $i++) { 
                    foreach ($ausenciaFacul[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }
            if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
                echo false;
            else    
         echo json_encode($totalAsist);
            //echo $totalAsist;
       }
}
?>
