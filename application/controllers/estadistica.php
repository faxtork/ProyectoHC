<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Estadistica extends CI_Controller{

		function __construct()
		{
			parent::__construct();
            session_start();
			$this->load->model('docente_model');
            $this->load->model('clases_model');
        }
        function index(){
        	$this->load->view('general/headers');
        	$this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');
            $this->load->view('estadistica/est_bienvenido');
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');  
        }
	}
?>
