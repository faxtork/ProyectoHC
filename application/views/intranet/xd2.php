<?php
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


$desfase=$_POST['desf'];
$uno = $_POST['u'];
$dos = $_POST['d'];

$uno =funphp($uno,$desfase);
$dos =funphp($dos,$desfase);

$a = array('un' => $uno,
		   'dos'=>$dos );

$x=json_encode($a);
echo $x;

?>
