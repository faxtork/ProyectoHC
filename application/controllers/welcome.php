<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

   function __construct() {
        parent::__construct();
        $this->load->library('ws_dirdoc');

    }
  
	public function index()
	{
		//redirect('consulta');
		/*$rut="18.120.924-0";
		$resultado = $this->ws_dirdoc->consultarUltimaFichaEstudiante($rut);
		print_r($resultado);
		echo $code=$resultado->nombreCarrera;echo "<br />";
		$code=explode(" ",$code);
		echo $code=$code[0];
		echo $resultado->tipo;*/
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
