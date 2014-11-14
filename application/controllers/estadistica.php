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
            $this->load->library("excel");
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
                     $facultades=$this->asistencia_model->getFacultadName();
                            $this->load->view('estadistica/aula',compact('facultades'));
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
            $facultades=$this->asistencia_model->getFacultadName();


                            $this->load->view('estadistica/infoAsistencia',compact('campus','facultades'));
                     $this->load->view('adminGeneral/cierreData');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
       }
        //***********************UTEM******************
       public function nivelUtemDia(){
           if($this->input->post('datepi'))
            {
                $fecha=$this->input->post('datepi');
                 $total=$this->asistencia_model->totalAsistencia($fecha);
                 $totalNo=$this->asistencia_model->totalNoAsistencia($fecha);
                 $totalTotal=$total->asistieron+$totalNo->noasistieron;
                 $siTotal=@round(($total->asistieron/$totalTotal)*100);
                 $noTotal=@round(($totalNo->noasistieron/$totalTotal)*100);


                 if($total->asistieron==0 && $totalNo->noasistieron==0)
                    echo false;
                else{
                        echo  $siTotal;
                        echo "/";
                        echo $noTotal;
                }

           }
   }
        public function nivelUtemMes(){
                                   if($this->input->post('selectAnio'))
        {
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
            //
            for ($i=0; $i <count($mesesAsistio) ; $i++) { 
                $arrayTotalAsistio[]=@round(($mesesAsistio[$i]/($mesesAsistio[$i]+$mesesAusente[$i]))*100);
                $arrayTotalAusencia[]=@round(($mesesAusente[$i]/($mesesAsistio[$i]+$mesesAusente[$i]))*100);

            }
            //
             if($sumNo==0 && $sumSi==0)
                echo false;
            else{
            $merge=array_merge($arrayTotalAsistio,$arrayTotalAusencia);
                echo  json_encode($merge);

            }
       }
   }
        public function nivelUtemYear(){
                         date_default_timezone_set("America/Santiago");
        if($this->input->post('selectYear'))
        {              
            $selectAnio=$this->input->post('selectYear');
            $añoHoy=date('Y');
            if($selectAnio==$añoHoy){//si el que elije son iguales se toma la fecha final hoy menos un dia
                    $fechaHoy=date('Y-m-j');//fecha de hoy
                    $yearIni=$selectAnio."-01-01";  
                        $nuevafecha = strtotime ( '-1 day' , strtotime ( $fechaHoy ) ) ;
                        $fechaMenos = date ( 'm-j' , $nuevafecha );//hoy menos un dia
                    $yearFin=$selectAnio."-".$fechaMenos;
            }else{
                $yearIni=$selectAnio."-01-01";  
                $yearFin=($selectAnio+1)."-01-01";  

            }
             $totalYearSi=$this->asistencia_model->totalAsistenciaMes($yearIni,$yearFin);
             $totalYearNo=$this->asistencia_model->totalAusenciaMes($yearIni,$yearFin);
                 $totalTotal=$totalYearSi->asistieron+$totalYearNo->noasistieron;

                 $siTotal=@round(($totalYearSi->asistieron/$totalTotal)*100);
                 $noTotal=@round(($totalYearNo->noasistieron/$totalTotal)*100);


                 if($totalYearSi->asistieron==0 && $totalYearNo->noasistieron==0)
                    echo false;
                else{
                        echo  $siTotal;
                        echo "/";
                        echo $noTotal;
                }
       }}
        //***********************FIN UTEM******************
        //***********************CAMPUS******************
        public function nivelCampusDia(){
        if($this->input->post('datepi'))
        {              
            $fecha=$this->input->post('datepi');
            $campus=$this->asistencia_model->getCampusName();
            $sumSi=0;
            $sumNo=0;

            foreach ($campus as $key ) {
                $nameCampus[]=$key->nombre;
                $name[]=$key->nombre;
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
                       
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }
            //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            // 
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else{
                        $merge=array_merge($name,$arrayTotalAsistio);
                        $merge2=array_merge($merge,$arrayTotalAusencia);
                        echo json_encode($merge2);
        }    
       }}
    public function nivelCampusMes(){
                if($this->input->post('selectAnio'))
        { 
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
            for ($i=0; $i <count($NoasistenciaCampus) ; $i++) {         
                    foreach ($NoasistenciaCampus[$i] as $fila) {
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }
            //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            //        
    
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else{
            $merge=array_merge($arrayTotalAsistio,$arrayTotalAusencia);
         echo json_encode($merge);

        }    
            //echo $totalAsist;

       }}
        public function nivelCampusYear(){
             date_default_timezone_set("America/Santiago");
                if($this->input->post('selectYear'))
        { 
            $selectAnio=$this->input->post('selectYear');
            $selectCampusPk=$this->input->post('selectCampus');

            $añoHoy=date('Y');
            if($selectAnio==$añoHoy){//si el que elije son iguales se toma la fecha final hoy menos un dia
                    $fechaHoy=date('Y-m-j');//fecha de hoy
                    $yearIni=$selectAnio."-01-01";  
                        $nuevafecha = strtotime ( '-1 day' , strtotime ( $fechaHoy ) ) ;
                        $fechaMenos = date ( 'm-j' , $nuevafecha );//hoy menos un dia
                    $yearFin=$selectAnio."-".$fechaMenos;
            }else{
                $yearIni=$selectAnio."-01-01";  
                $yearFin=($selectAnio+1)."-01-01";  

            }

            $asistenciaCampus=$this->asistencia_model->totalAsistenciaPorCampusAnio($yearIni,$yearFin,$selectCampusPk);

            $NoasistenciaCampus=$this->asistencia_model->totalNoAsistenciaPorCampusAnio($yearIni,$yearFin,$selectCampusPk);
                 $totalTotal=$asistenciaCampus->cantidad+$NoasistenciaCampus->cantidad;
             
                 $siTotal=@round(($asistenciaCampus->cantidad/$totalTotal)*100);
                 $noTotal=@round(($NoasistenciaCampus->cantidad/$totalTotal)*100);


                 if($asistenciaCampus->cantidad==0 && $NoasistenciaCampus->cantidad==0)
                    echo false;
                else{
                        echo  $siTotal;
                        echo "/";
                        echo $noTotal;
                }


            //echo $totalAsist;

       }}
       //***********************FIN CAMPUS******************
        //***********************FACULTAD******************
       public function nivelFacultadDia(){
                       if($this->input->post('datepi'))
        {
                    $fecha=$this->input->post('datepi');
            $facultad=$this->asistencia_model->getFacultadName();
            $sumSi=0;
            $sumNo=0;

            foreach ($facultad as $key ) {
                $nameFacultad[]=$key->facultad;
                $name[]=$key->facultad;
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
                       
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }
            //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            // 
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else{
                        $merge=array_merge($name,$arrayTotalAsistio);
                        $merge2=array_merge($merge,$arrayTotalAusencia);
                        echo json_encode($merge2);
        } 
            //echo $totalAsist;
       }
   }
       public function nivelFacultadMes(){
                if($this->input->post('selectAnio'))
        {
            $selectAnio=$this->input->post('selectAnio');
            $selectFacultad=$this->input->post('selectFacultad');
            
            $sumSi=0;
            $sumNo=0;

            $asistenciaCampus=$this->asistencia_model->totalAsistenciaPorFacultadMes($selectAnio,$selectFacultad);
            for ($i=0; $i <count($asistenciaCampus) ; $i++) { 
                    foreach ($asistenciaCampus[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }
            $NoasistenciaCampus=$this->asistencia_model->totalNoAsistenciaPorFacultadMes($selectAnio,$selectFacultad);
            for ($i=0; $i <count($NoasistenciaCampus) ; $i++) {         
                    foreach ($NoasistenciaCampus[$i] as $fila) {
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }        
            //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            //  
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else{
                 $merge=array_merge($arrayTotalAsistio,$arrayTotalAusencia);
                echo json_encode($merge);
         }
       }
   }
       public function nivelFacultadYear(){
           date_default_timezone_set("America/Santiago");
                if($this->input->post('selectYear'))
        {
            $selectAnio=$this->input->post('selectYear');
            $selectFacultad=$this->input->post('selectFacultad');

            $añoHoy=date('Y');
            if($selectAnio==$añoHoy){//si el que elije son iguales se toma la fecha final hoy menos un dia
                    $fechaHoy=date('Y-m-j');//fecha de hoy
                    $yearIni=$selectAnio."-01-01";  
                        $nuevafecha = strtotime ( '-1 day' , strtotime ( $fechaHoy ) ) ;
                        $fechaMenos = date ( 'm-j' , $nuevafecha );//hoy menos un dia
                    $yearFin=$selectAnio."-".$fechaMenos;
            }else{
                $yearIni=$selectAnio."-01-01";  
                $yearFin=($selectAnio+1)."-01-01";  

            }
            $sumSi=0;
            $sumNo=0;

            $asistenciaCampus=$this->asistencia_model->totalAsistenciaPorFacultadAnio($yearIni,$yearFin,$selectFacultad);

            $NoasistenciaCampus=$this->asistencia_model->totalNoAsistenciaPorFacultadAnio($yearIni,$yearFin,$selectFacultad);

                 $totalTotal=$asistenciaCampus->cantidad+$NoasistenciaCampus->cantidad;
             
                 $siTotal=@round(($asistenciaCampus->cantidad/$totalTotal)*100);
                 $noTotal=@round(($NoasistenciaCampus->cantidad/$totalTotal)*100);


                 if($asistenciaCampus->cantidad==0 && $NoasistenciaCampus->cantidad==0)
                    echo false;
                else{
                        echo  $siTotal;
                        echo "/";
                        echo $noTotal;
                } 
       }}
        //***********************FIN FACULTAD******************

       public function llena_Dpto(){
                 $options = "";
        if($this->input->post('selectFacultad'))
        {
            $facultadPk = $this->input->post('selectFacultad');
            $depa = $this->asistencia_model->getDptoPk($facultadPk);
           $options='<div class="form-group">
                        <label  class="col-sm-3 control-label" id="c">Elegir Dpto: </label>
                         <div class="col-sm-8">
                             <select name="selectDpto" class="form-control" id="selectDpto">
                             <option selected="selected" value="">Selecione un departamento</option>';
            foreach($depa as $fila)
            {
          
                $options .='<option value='.$fila->pk.'>'.$fila->departamento.'</option>';
           
            }
            $options.='</select></div></div>';
            echo $options;
        }
       }
       //***********************DPTO******************
       public function nivelDepartamentoDia(){
                if($this->input->post('datepi'))
        {
            $fecha=$this->input->post('datepi');
            $facultad=$this->input->post('selectFacultad');
            $dptoPkXFacul=$this->asistencia_model->getDptoPk($facultad);
            $sumSi=0;
            $sumNo=0;

            foreach ($dptoPkXFacul as $key ) {
                $dptoPk[]=$key->pk;
                $name[]=$key->departamento;
            }

            $asistenciaDpto=$this->asistencia_model->totalAsistenciaPorDpto($dptoPk,$fecha);
            for ($i=0; $i <count($asistenciaDpto) ; $i++) { 
                    foreach ($asistenciaDpto[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }

            $ausenciaDpto=$this->asistencia_model->totalNoAsistenciaPorDpto($dptoPk,$fecha);
            for ($i=0; $i <count($ausenciaDpto) ; $i++) { 
                    foreach ($ausenciaDpto[$i] as $fila) {
                       
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }
            //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            // 
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else{
                        $merge=array_merge($name,$arrayTotalAsistio);
                        $merge2=array_merge($merge,$arrayTotalAusencia);
                        echo json_encode($merge2);
        } 
       }}
       public function nivelDepartamentoMes(){
                if($this->input->post('selectAnio'))
        {        
            $selectAnio=$this->input->post('selectAnio');
            $selectDpto=$this->input->post('selectDpto');
            $sumSi=0;
            $sumNo=0;

            $asistenciaCampus=$this->asistencia_model->totalAsistenciaPorDptoMes($selectAnio,$selectDpto);
            for ($i=0; $i <count($asistenciaCampus) ; $i++) { 
                    foreach ($asistenciaCampus[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }
            $NoasistenciaCampus=$this->asistencia_model->totalNoAsistenciaPorDptoMes($selectAnio,$selectDpto);
            for ($i=0; $i <count($NoasistenciaCampus) ; $i++) {         
                    foreach ($NoasistenciaCampus[$i] as $fila) {
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }        
            //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            //  
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else{
            $merge=array_merge($arrayTotalAsistio,$arrayTotalAusencia);
            echo json_encode($merge);
        }    
       }}
       public function nivelDepartamentoYear(){
           date_default_timezone_set("America/Santiago");
        if($this->input->post('selectYear'))
        {
            $selectAnio=$this->input->post('selectYear');
            $selectFacultad=$this->input->post('selectFacultad');
            $dptoPkXFacul=$this->asistencia_model->getDptoPk($selectFacultad);
            foreach ($dptoPkXFacul as $key ) {
                $dptoPk[]=$key->pk;
                $name[]=$key->departamento;
            }
             
            $añoHoy=date('Y');
            if($selectAnio==$añoHoy){//si el que elije son iguales se toma la fecha final hoy menos un dia
                    $fechaHoy=date('Y-m-j');//fecha de hoy
                    $yearIni=$selectAnio."-01-01";  
                        $nuevafecha = strtotime ( '-1 day' , strtotime ( $fechaHoy ) ) ;
                        $fechaMenos = date ( 'm-j' , $nuevafecha );//hoy menos un dia
                    $yearFin=$selectAnio."-".$fechaMenos;
            }else{
                $yearIni=$selectAnio."-01-01";  
                $yearFin=($selectAnio+1)."-01-01";  

            }
            $sumSi=0;
            $sumNo=0;

            $asistenciaDpto=$this->asistencia_model->totalAsistenciaPorDptoAnio($yearIni,$yearFin,$dptoPk);
            for ($i=0; $i <count($asistenciaDpto) ; $i++) { 
                    foreach ($asistenciaDpto[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }
            $ausenciaDpto=$this->asistencia_model->totalNoAsistenciaPorDptoAnio($yearIni,$yearFin,$dptoPk);
            for ($i=0; $i <count($ausenciaDpto) ; $i++) {         
                    foreach ($ausenciaDpto[$i] as $fila) {
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            } 
           //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            // 
        if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
            echo false;
        else{
                        $merge=array_merge($name,$arrayTotalAsistio);
                        $merge2=array_merge($merge,$arrayTotalAusencia);
                        echo json_encode($merge2);
        } 
        } 
       }
       //***********************FIN DPTO******************
      //*******************DOCENTE*********************
       public function nivelDocenteDia(){
        if($this->input->post('datepi')){
                $fecha=$this->input->post('datepi');
                $rut=$this->input->post('selectRut');
            $total=$this->asistencia_model->totalAsistenciaPorDocenteDia($fecha,$rut);
             $totalNo=$this->asistencia_model->totalNoAsistenciaPorDocenteDia($fecha,$rut);

           
                 $totalTotal=$total->cantidad+$totalNo->cantidad;
             
                 $siTotal=@round(($total->cantidad/$totalTotal)*100);
                 $noTotal=@round(($totalNo->cantidad/$totalTotal)*100);


                 if($total->cantidad==0 && $totalNo->cantidad==0)
                    echo false;
                else{
                        echo  $siTotal;
                        echo "/";
                        echo $noTotal;
                } 
        }
       }
       public function nivelDocenteMes(){
        if($this->input->post('selectAnio')){
                $selectAnio=$this->input->post('selectAnio');
                $selectRut=$this->input->post('selectRut');
            $sumSi=0;
            $sumNo=0;
            $asistenciaDoc=$this->asistencia_model->totalAsistenciaPorDocMes($selectAnio,$selectRut);
            for ($i=0; $i <count($asistenciaDoc) ; $i++) { 
                    foreach ($asistenciaDoc[$i] as $fila) {
                       
                       $totalAsist[]=$fila->cantidad;
                       $sumSi=$sumSi+$fila->cantidad;
                    }
            }
            $ausenciaDoc=$this->asistencia_model->totalNoAsistenciaPorDocMes($selectAnio,$selectRut);
            for ($i=0; $i <count($ausenciaDoc) ; $i++) {         
                    foreach ($ausenciaDoc[$i] as $fila) {
                       $totalNoAsist[]=$fila->cantidad;
                       $sumNo=$sumNo+$fila->cantidad;


                    }
            }        
            //
            for ($i=0; $i <count($totalAsist) ; $i++) { 
                $arrayTotalAsistio[]=@round(($totalAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);
                $arrayTotalAusencia[]=@round(($totalNoAsist[$i]/($totalAsist[$i]+$totalNoAsist[$i]))*100);

            }
            //     
            if($sumNo==0 && $sumSi==0)//si es asi es xq no hay nada
                echo false;
            else{
            $merge=array_merge($arrayTotalAsistio,$arrayTotalAusencia);
             echo json_encode($merge);
            }    
        }
       }
       public function nivelDocenteYear(){
           date_default_timezone_set("America/Santiago");
        if($this->input->post('selectYear')){
                $selectAnio=$this->input->post('selectYear');
                $rut=$this->input->post('selectRut');
            $añoHoy=date('Y');
            if($selectAnio==$añoHoy){//si el que elije son iguales se toma la fecha final hoy menos un dia
                    $fechaHoy=date('Y-m-j');//fecha de hoy
                    $yearIni=$selectAnio."-01-01";  
                        $nuevafecha = strtotime ( '-1 day' , strtotime ( $fechaHoy ) ) ;
                        $fechaMenos = date ( 'm-j' , $nuevafecha );//hoy menos un dia
                    $yearFin=$selectAnio."-".$fechaMenos;
            }else{
                $yearIni=$selectAnio."-01-01";  
                $yearFin=($selectAnio+1)."-01-01";  

            }
            $asistenciaDoc=$this->asistencia_model->totalAsistenciaPorDocAnio($yearIni,$yearFin,$rut);
            $ausenciaDoc=$this->asistencia_model->totalNoAsistenciaPorDocAnio($yearIni,$yearFin,$rut);
           
                 $totalTotal=$asistenciaDoc->cantidad+$ausenciaDoc->cantidad;
             
                 $siTotal=@round(($asistenciaDoc->cantidad/$totalTotal)*100);
                 $noTotal=@round(($ausenciaDoc->cantidad/$totalTotal)*100);


                 if($asistenciaDoc->cantidad==0 && $ausenciaDoc->cantidad==0)
                    echo false;
                else{
                        echo  $siTotal;
                        echo "/";
                        echo $noTotal;}
                    

       }}
       //*******************FIN DOCENTE*********************
       public function descargar(){
        $tipo=$this->input->post("descargaHidden");
       $fecha=$this->input->post('datepicker');
       $fecha="2014-10-14";


             $this->excel->setActiveSheetIndex(0);
             $total=$this->asistencia_model->totalAsistencia($fecha);
             $totalNo=$this->asistencia_model->totalNoAsistencia($fecha);
                 $a1[0]=$total;
                 $a1[1]=$totalNo;
                // $total2=array_merge($a1,$a2);
        print_r($a1);
         $this->excel->stream('prueba2.xls', $a1);
       }
       //****FIN info asistencia******
       public function salasNivel(){
        if($this->input->post("query")){
            $consulta=$this->input->post("query");
            switch ($consulta) {
                case '1'://NIVEL UTEM
                    $cantidadSalasUtem=$this->asistencia_model->cantSalasUtem();
                    $cantidadSalasUtemBloqueadas=$this->asistencia_model->cantSalasUtemBloqueada();
                $cantidadBloqueada=$cantidadSalasUtemBloqueadas->cantidad;
                $cantidadHabiles=$cantidadSalasUtem->cantidad;
                $cantidadTotaldeSalasUTEM=$cantidadHabiles+$cantidadBloqueada;//=100%
                            $Campus=$this->asistencia_model->getCampusName();
                            foreach ($Campus as $key) {
                               $pkCampus[]=$key->pk;
                            }
                            $salasAsignadas=$this->asistencia_model->cantSalasUtemAsignadas($pkCampus);   //para toda la UTEM
                                for ($i=0; $i <count($salasAsignadas) ; $i++) { 
                                        foreach ($salasAsignadas[$i] as $key) {
                                           if(isset($key->sala_fk))$salafk[]=$key->sala_fk;

                                        }
                                }
                $cantidadSalasAsignadas=count($salafk);    
                $cantidadSalasLibres=$cantidadHabiles-$cantidadSalasAsignadas;
                        echo @round(($cantidadBloqueada/$cantidadTotaldeSalasUTEM)*100);
                        echo "/";
                        echo @round(($cantidadSalasAsignadas/$cantidadTotaldeSalasUTEM)*100);
                        echo "/";
                        echo @round(($cantidadSalasLibres/$cantidadTotaldeSalasUTEM)*100);
                    break;
                case '2'://NIVEL CAMPUS
                    $Campus=$this->asistencia_model->getCampusName();
                    foreach ($Campus as $key) {
                       $totalAsist[]=$key->nombre;
                       $pkCampus[]=$key->pk;
                    }
                    $sumSi=0;
                    $sumNo=0;
                    $cantidadSalasXCampus=$this->asistencia_model->cantSalasUtemAsignadas($pkCampus); 
                        for ($i=0; $i <count($cantidadSalasXCampus) ; $i++) { 
                                $cantAsignada[]=count($cantidadSalasXCampus[$i]);
                        }
                    $cantidadSalasCampus=$this->asistencia_model->cantSalasCampus($pkCampus);
                        for ($i=0; $i <count($cantidadSalasCampus) ; $i++) { 
                                        $cantHabiles[]=$cantidadSalasCampus[$i]->cantidad;
                                   $sumSi=$sumSi+$cantidadSalasCampus[$i]->cantidad;
                        }
                        for ($i=0; $i <count($cantAsignada) ; $i++) { 
                            $cantLibres[]=$cantHabiles[$i]-$cantAsignada[$i];
                        }
                    $cantidadSalasCampusBloqueadas=$this->asistencia_model->cantSalasCampusBloqueada($pkCampus);
                        for ($i=0; $i <count($cantidadSalasCampusBloqueadas) ; $i++) { 
                                        $cantBloqueada[]=$cantidadSalasCampusBloqueadas[$i]->cantidad;
                                   $sumNo=$sumNo+$cantidadSalasCampusBloqueadas[$i]->cantidad;
                        }
                        //
                        for ($i=0; $i <count($totalAsist) ; $i++) { 
                            $arrayTotalAsignada[]=@round(($cantAsignada[$i]/($cantAsignada[$i]+$cantBloqueada[$i]+$cantLibres[$i]))*100);
                            $arrayTotalBloqueada[]=@round(($cantBloqueada[$i]/($cantAsignada[$i]+$cantBloqueada[$i]+$cantLibres[$i]))*100);
                            $arrayTotalLibres[]=@round(($cantLibres[$i]/($cantAsignada[$i]+$cantBloqueada[$i]+$cantLibres[$i]))*100);
                        }
                        // 
                        $supra=array_merge(array_merge(array_merge($totalAsist,$arrayTotalAsignada),$arrayTotalBloqueada),$arrayTotalLibres);
                    if($sumSi==0 && $sumNo==0) echo false;
                    else{
                        echo json_encode($supra);                      
                    }
                    break;
                case '3'://NIVEL FACULTAD
                    $facultad=$this->asistencia_model->getFacultadName();
                    foreach ($facultad as $key) {
                       $totalAsist[]=$key->facultad;
                       $pkFacultad[]=$key->pk;
                    }
                    $sumSi=0;
                    $sumNo=0; 
                    $cantidadSalasXFacul=$this->asistencia_model->cantSalasFaculAsignadas($pkFacultad); 
                        for ($i=0; $i <count($cantidadSalasXFacul) ; $i++) { 
                                
               /*-->*/               $cantAsignada[]=count($cantidadSalasXFacul[$i]);
                                    foreach ($cantidadSalasXFacul[$i] as $key ) {
                                        $pkSalas[]=$key->sala_fk;
                                    }
                        }
                        //echo json_encode($pkSalas);
                    $cantidadSalasFacultad=$this->asistencia_model->cantSalasFacultad($pkFacultad);
                        for ($i=0; $i <count($cantidadSalasFacultad) ; $i++) { 
                                   $cantHabiles[]=$cantidadSalasFacultad[$i]->cantidad;
                                   $sumSi=$sumSi+$cantidadSalasFacultad[$i]->cantidad;
                        }
                        for ($i=0; $i <count($cantAsignada) ; $i++) { 
                            $cantLibres[]=$cantHabiles[$i]-$cantAsignada[$i];
                        }

                    $cantidadSalasFacultadBloqueadas=$this->asistencia_model->cantSalasFacultadBloqueada($pkFacultad);
                        for ($i=0; $i <count($cantidadSalasFacultadBloqueadas) ; $i++) { 
                                   $cantBloqueada[]=$cantidadSalasFacultadBloqueadas[$i]->cantidad;
                                   $sumNo=$sumNo+$cantidadSalasFacultadBloqueadas[$i]->cantidad;
                        }
                        //
                        for ($i=0; $i <count($totalAsist) ; $i++) { 
                            $arrayTotalAsignada[]=@round(($cantAsignada[$i]/($cantAsignada[$i]+$cantBloqueada[$i]+$cantLibres[$i]))*100);
                            $arrayTotalBloqueada[]=@round(($cantBloqueada[$i]/($cantAsignada[$i]+$cantBloqueada[$i]+$cantLibres[$i]))*100);
                            $arrayTotalLibres[]=@round(($cantLibres[$i]/($cantAsignada[$i]+$cantBloqueada[$i]+$cantLibres[$i]))*100);
                        }
                        // 
                        $supra=array_merge(array_merge(array_merge($totalAsist,$arrayTotalAsignada),$arrayTotalBloqueada),$arrayTotalLibres);

                    if($sumSi==0 && $sumNo==0) echo false;
                    else{
                        echo json_encode($supra);                      
                    }
                    break;
                case '4'://NIVEL DPTO
                     /*   $selectFacultad=$this->input->post('selectFacultad');
                    $getDpto=$this->asistencia_model->getDptoPk($selectFacultad);
                    foreach ($getDpto as $key) {
                       $totalAsist[]=$key->departamento;
                       $pkDpto[]=$key->pk;
                    }
                    $sumSi=0;
                    $sumNo=0; 
                    $cantidadSalaXDpto=$this->asistencia_model->cantSalasDptoAsignadas($pkDpto); 
                        for ($i=0; $i <count($cantidadSalaXDpto) ; $i++) { 
                          $cantAsignada[]=count($cantidadSalaXDpto[$i]);
                        }
                    $cantidadSalaDpto=$this->asistencia_model->cantSalasDepartamento($pkDpto);
                        for ($i=0; $i <count($cantidadSalaDpto) ; $i++) { 
                                   $cantHabiles[]=$cantidadSalaDpto[$i]->cantidad;
                                   $sumSi=$sumSi+$cantidadSalaDpto[$i]->cantidad;
                        }
                        for ($i=0; $i <count($cantAsignada) ; $i++) { 
                            $cantLibres[]=$cantHabiles[$i]-$cantAsignada[$i];
                        }

                    $cantidadSalasFacultadBloqueadas=$this->asistencia_model->cantSalasFacultadBloqueada($pkDpto);
                        for ($i=0; $i <count($cantidadSalasFacultadBloqueadas) ; $i++) { 
                                   $cantBloqueada[]=$cantidadSalasFacultadBloqueadas[$i]->cantidad;
                                   $sumNo=$sumNo+$cantidadSalasFacultadBloqueadas[$i]->cantidad;
                        }
                    $supra=array_merge(array_merge(array_merge($totalAsist,$cantAsignada),$cantBloqueada),$cantLibres);

                    if($sumSi==0 && $sumNo==0) echo false;
                    else{
                        echo json_encode($supra);                      
                    }*/
                    break;
            }
        }
       }
       public function test(){
        $dato=ucwords($this->input->post('search'));
        $consulta=$this->asistencia_model->docen($dato);
        foreach ($consulta as $key) {
        $dat=$key->nombres.' '.$key->apellidos;
        $pk=$key->pk;
        if($dat!=''){
            //echo "<li>".$dat."</li>";
            //echo "$".$pk."$";
                   $country_name = str_replace($dato, '<b>'.$dato.'</b>', $dat);
                    echo '<li onclick="set_item(\''.$dat.'\',\''.$pk.'\')">'.$country_name.'</li>';
        }

        }

// add new option
       }
}
?>
