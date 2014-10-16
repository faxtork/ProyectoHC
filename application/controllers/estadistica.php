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
                            $this->load->view('estadistica/infoAsistencia');
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
            $selectMes=$this->input->post('selectMes');
            $selectAnio=$this->input->post('selectAnio');
            $fechaIni=$selectAnio."-".$selectMes."-01";
            $fechaFin=$selectAnio."-".($selectMes+1)."-01";
             $totalMesSi=$this->asistencia_model->totalAsistenciaMes($fechaIni,$fechaFin);
             $totalMesNo=$this->asistencia_model->totalAusenciaMes($fechaIni,$fechaFin);
             if($totalMesSi->asistieron==0 && $totalMesNo->noasistieron==0)
                echo false;
            else{
                    echo  $totalMesSi->asistieron;
                    echo "/";
                    echo $totalMesNo->noasistieron;
            }
       }
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
        public function nivelCampus(){
            $campus=$this->asistencia_model->getCampusName();
            foreach ($campus as $key ) {
                $nameCampus[]=$key->nombre;
                $totalAsist[]=$key->nombre;
            }
            $asistenciaCampus=$this->asistencia_model->totalAsistenciaPorCampus($nameCampus);
            for ($i=0; $i <count($asistenciaCampus) ; $i++) { 
                    foreach ($asistenciaCampus[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                    }
            }
            $NoasistenciaCampus=$this->asistencia_model->totalNoAsistenciaPorCampus($nameCampus);
            for ($i=0; $i <count($NoasistenciaCampus) ; $i++) { 
                    foreach ($NoasistenciaCampus[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                    }
            }
        $consulta=$this->input->post('query');

            //echo $totalAsist;
echo json_encode($totalAsist);




       }
}
?>
