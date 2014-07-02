<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {
	public function verifyUser()	{
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
		$json = $_GET['ini'];
		$desfase=$_GET['desf'];
		$decodeIni=json_decode($json);
		//var_dump($decodeIni);
		//var_dump($desfase);
		for ($i="uno0",$j=0; $i <"uno".count($decodeIni); $i++,$j++) {
			$respuestaDesfase[$i]=funphp($decodeIni[$j],$desfase); 
		}
		$respuestaDesfase['largo']=count($respuestaDesfase);
		//var_dump($respuestaDesfase);
		//echo "<br />";
		//var_dump($respuestaDesfase);
		//$desfase=$_POST['desf'];
		//$uno = $_POST['u'];
		//$dos = $_POST['d'];

		//$uno =funphp($uno,$desfase);
		//$dos =funphp($dos,$desfase);

		//$a = array('un' => $uno,'dos'=>$dos );

		//$x=json_encode($a);
		$x=json_encode($respuestaDesfase);
		echo $x;

	}
}