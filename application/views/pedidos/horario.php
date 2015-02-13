<script>
        $(function() {  
   var window_height = $(window).height(),
   content_height = window_height - 350;
   $('.mygrid-wrapper-div').height(content_height);
});

$( window ).resize(function() {
   var window_height = $(window).height(),
   content_height = window_height - 50;
   $('.mygrid-wrapper-div').height(content_height);
});
</script>
 <?php 

function diaSemana($ano,$mes,$dia)
{
    // 0->domingo     | 6->sabado
    $dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
        return $dia;
}
 function Meses($ano,$mes,$dia)
{
    // 0->domingo     | 6->sabado
    $dia= date("n",mktime(0, 0, 0, $mes, $dia, $ano));
        return $dia;
}
function extraerFecha($fech){
    $x=explode("-", $fech);
        $diaSemana = diaSemana($x[0],$x[1],$x[2]);
        $diaMes = Meses($x[0],$x[1],$x[2]);

            date_default_timezone_set("America/Santiago");
            $dias = array("Dom","Lun","Mar","Mie","Jue","Vier","Sáb");
            $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
            $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            echo $fecha=$dias[$diaSemana]." ".$x[2]." de ".$meses[$x[1]-1]. " del ".date('Y') ;
}

 ?>
<div class="well">
    <h3>Clases ordenadas por fecha</h3>
   <div class="mygrid-wrapper-div">
  <table class='table table-hover-striped' border="0" style="text-align:left;">
                   <thead >
                    <tr>
               			<th>Fecha</th>	
                        <th>Asignatura</th>
                        <th>Sala</th>
                        <th>Sección</th>
                        <th>Periodo</th>
                    </tr> 
                  </thead>
	                <tbody>
	                    <?php
	                    foreach ($clasesDoc as $pedi) {
	                        echo '<tr>';?>
	                        <td><?php  echo extraerFecha($pedi->fecha);?></td><?php 
	                        echo '<td>'.$pedi->asignatura.'</td>';
	                        echo '<td>'.$pedi->sala.'</td>'; 
	                        echo '<td>'.$pedi->seccion.'</td>'; 
	                        echo '<td>'.$pedi->periodo.'</td>';
	                                            
	                      echo '</tr>';
	                    }
	                    
	                    ?>

	                </tbody>
 </table>
   </div><br>
</div>
