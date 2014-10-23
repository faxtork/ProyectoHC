<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

   function __construct() {
        parent::__construct();
        $this->load->library('ws_dirdoc');

    }
  
	public function index()
	{
		//redirect('consulta');
	/*	$rut="15.997.886-9";
		$resultado = $this->ws_dirdoc->consultarDocente($rut);
		print_r($resultado);
*/
		$this->load->view('general/headers');
	    $this->load->view('general/menu_principal');
	    $this->load->view('general/abre_bodypagina');
	    if(!isset($_SESSION['usuarioAlumno'])){
	      $this->load->view('alumnos/login_alum');
	    }
	    else{
	      $this->load->view('consulta/bienvenido');
	    }
	    $this->load->view('general/cierre_bodypagina');
	    $this->load->view('general/cierre_footer');
	}
}

?>
