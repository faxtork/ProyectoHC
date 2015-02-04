
<?php 
$a_emp = array("0"=>"9",
			"1"=>"6",
			"2"=>"7",
			"3"=>"8",
			"4"=>"9",
			"5"=>"1",
			"6"=>"2",
			"7"=>"3");

$TAMANO_PAGINA = 2;

$pagina = $_GET["pagina"];
if (!$pagina) {
    $inicio = 0;
    $pagina=1;
}
else {
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

$num_total_registros=count($a_emp);

		    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

    if ($total_paginas > 1)
    {

		    //$num = ($pagina + $TAMANO_PAGINA);
    			//$paginas = ($num_ele / #num_elementos_a_mostrar_por_pagina);
		    $num = (($pagina * 3)-1);
		    //$ini = ($num - 2);
		    for($a=$inicio; $a<$num; $a++)
		    {
//		    echo $a_emp[$a];
		    }
		    echo "<br/>";


		    if ($total_paginas > 1){
			    for ($i=1;$i<=$total_paginas;$i++){
			       if ($pagina == $i){
			          //echo $pagina . " ";

			       }else{
			         // echo "<a href='?pagina=" . $i . "'>" . $i . "</a>";
			       }
			    }
			}
	}
 ?>

<?php 


$filas = array("0"=>"9",
			"1"=>"6",
			"2"=>"7",
			"3"=>"8",
			"4"=>"9",
			"5"=>"1",
			"6"=>"2",
			"7"=>"3");
$pagina = $_GET["pagina"];

$por_pagina = 3; // resultados por página
$num_filas = count($filas);// total de resultados ( 30 )
$total_pag = ceil(($num_filas/$por_pagina));//número de páginas ( 3 )    
$filas_chunked = array_chunk($filas,$por_pagina); //3 arrays devueltos
var_dump($filas_chunked);
$pagina = $_GET["pagina"];
if (!$pagina) {
    $pagina=1;
}

//hago el bucle para mostrar los resultados
for ($i = 0; $i < count($filas_chunked[$pagina-1]); $i++ )
{
       echo $filas_chunked[$pagina-1][$i]." "; //etc
}  
echo "<br/>";
		    if ($total_pag > 1){
			    for ($i=1;$i<=$total_pag;$i++){
			       if ($pagina == $i){
			          echo $pagina . " ";

			       }else{
			          echo "<a href='?pagina=" . $i . "'>" . $i . "</a>";
			       }
			    }
			}
 ?>