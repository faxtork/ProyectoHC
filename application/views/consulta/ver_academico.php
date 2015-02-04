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
<?php 
//echo $salida = shell_exec('pg_dump -U sesparza -W -h 146.83.181.9 sesparzadb > basename.sql');
 ?>
<div class="row-fluid"><br>
  <div class="span12">
  
                          <?php 

            if ($result != null) {
                    echo "<table class='table table-hover-striped' style='text-align:left;'>
                       <thead>
                        <tr>
                                <th>Periodo</th>
                                <th>Inicio</th>  
                                <th>Termino</th>
                                <th>Fecha </th>
                                <th>Asignatura</th>
                                <th>Sala</th>
                                <th>Seccion</th>
                                <th>Asistencia</th>
                        </tr> 
                      </thead><tbody>";
                  
                foreach ($result as $profesor) { ?>
                <tr>
                    <td><?= $profesor->periodo;  ?></td>
                    <td><?= $profesor->inicio; ?></td>
                    <td><?= $profesor->termino ;?></td>
                    <td><?php  echo extraerFecha($profesor->fecha);?></td>
                    <td><?= $profesor->nombre ;?></td>
                    <td><?= $profesor->sala ;?></td>
                    <td><?= $profesor->seccion ;?></td>
                    <td><?php if($profesor->estado=='t'){echo "<span class='label label-success'>Presente</span>";}else{echo"<span class='label label-danger'>Ausente</span";} ;?></td>

                </tr>                 
                <?php }
                echo "</tbody></table>";
            }
            else{
               echo "El Profesor no esta impartiendo asignaturas<br>";
            }
        ?>
</div>
</div>
