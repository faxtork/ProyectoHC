<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Consulta extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
            session_start();
			$this->load->model('docente_model');
            $this->load->model('clases_model');

		}
		public function index(){
			$this->load->view('general/headers');
            $this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');
            //*****************BORRAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAR*****************
            //    $_SESSION['usuarioAlumno']='17.680.010-0';
              //  $_SESSION['codigoCarrera'] = '21030';
                //$_SESSION['nombreAlum'] = 'SEBA';
            //*****************
            if(!isset($_SESSION['usuarioAlumno'])){
                redirect('', 'refresh');//si no esta creada
            }else{
                $queCampus=$this->clases_model->getNameCampusXCode($_SESSION['codigoCarrera']);
                $this->load->view('consulta/bienvenido',compact('queCampus'));

            }
            $this->load->view('consulta/header_menu');
            $this->load->view('consulta/fin_header_menu');
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');


		}
		public function academico(){
			$this->load->view('general/headers');
            $this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');
            $codCarrera=$_SESSION['codigoCarrera'];
        	$academico=$this->docente_model->getAcademicoXfacultad($codCarrera);//va a llamara  a extraer a todos los academicos
        	$this->load->view('consulta/bienvenido');
            $this->load->view('consulta/header_menu');
            $this->load->view('consulta/fin_header_menu');
        	$this->load->view('consulta/consultar_academico',compact("academico"));//consulta academico
            
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
		}
		public function res_academico(){ 

			$pk=$this->input->post('docente');
            if ($pk != null) {
                $time=$this->clases_model->getTime();//tiepo de ahora
                $date=$this->clases_model->getDate();//fecha de ahora
                $result=$this->docente_model->academicoSemana($pk,$time,$date);
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('consulta/bienvenido');
                $this->load->view('consulta/header_menu');
                $this->load->view('consulta/ver_academico',compact("result"));//consulta academico
                $this->load->view('consulta/fin_header_menu');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer'); 
            }
            else{
                redirect('consulta/academico');
            }

		}
        public function ahora(){
            $time=$this->clases_model->getTime();
            $date=$this->clases_model->getDate();
            $clases=$this->clases_model->getAhora($time,$date);
            $this->load->view('general/headers');
            $this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');
            $this->load->view('consulta/bienvenido');
            $this->load->view('consulta/header_menu');
            $this->load->view('consulta/consultar_ahora',compact('clases','time','date'));//consulta academico
            $this->load->view('consulta/fin_header_menu');
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');

                }

                
         public function hoy(){
            $date=$this->clases_model->getDate();
            $time=$this->clases_model->getTime();
            $hoy=$this->clases_model->getHoy($time , $date);
            $this->load->view('general/headers');
            $this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');
            $this->load->view('consulta/bienvenido');
            $this->load->view('consulta/header_menu');
            $this->load->view('consulta/consultar_hoy',compact('hoy','time','date'));//consulta academico
            $this->load->view('consulta/fin_header_menu');
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
                }              
	}
 ?>