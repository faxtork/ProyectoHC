<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {
	public function verifyUser()	{



		    if (isset($_SERVER['HTTP_ORIGIN'])) {  
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
        header('Access-Control-Allow-Credentials: true');  
        header('Access-Control-Max-Age: 86400');   
    }  
      
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  
      
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))  
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  
      
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))  
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");  
    }  


		

		
				function funphp($horaInicial,$minutoAnadir){
				//$horaInicial="08:00";
			//return $horaInicial;
				//$minutoAnadir=5;
				$segundos_horaInicial=strtotime($horaInicial);
				$segundos_horaInicial;
				$segundos_minutoAnadir=$minutoAnadir*60;
				$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
			 	 return $nuevaHora;
				}

		$ini = $_GET['ini'];
		//$fin = $_GET['fin'];
		$desfase=$_GET['desf'];

		//$json=$this->input->post('ini');
		//$desfase=$this->input->post('desf');

		$decodeIni=json_decode($ini);
		$mitad=count($decodeIni)/2;
		$finUno=count($decodeIni)-$mitad;
		//$decodeFin=json_decode($fin);
		//var_dump($decodeIni);
		//var_dump($desfase);
		for ($i="uno0",$j=0; $i <"uno".$finUno; $i++,$j++) {
			$respuestaDesfaseIni[$i]=funphp($decodeIni[$j],$desfase); 
		}
		for ($i="dos0",$j=$mitad; $i <"dos".$finUno; $i++,$j++) {
			$respuestaDesfaseFin[$i]=funphp($decodeIni[$j],$desfase); 
		}
		//var_dump($respuestaDesfaseIni);echo "<br /><br /><br />";
		//var_dump($respuestaDesfaseFin);
		$merge= array_merge($respuestaDesfaseIni, $respuestaDesfaseFin);
//print_r($merge);
		//$respuestaDesfase['largo']=count($respuestaDesfase);
		echo json_encode($merge);
		//echo json_encode($respuestaDesfaseIni);
		//echo json_encode($respuestaDesfaseFin);

	}
}