<div class="row-fluid">
	<div class="span12"><br>
		<?php 

            if ($day=date("N")<=5 && $day=date("j")>=1) {
                if ($time>="08:15" && $time<="22:15") {
                //Esta dentro del limite y si esta en receso automaticamente lo asigna al siguiente periodo 
                //gracias al "if" que hay en la funcion "getTime"
                   
                }

                else{
                    if ($time>"22:15:00" && $time<"23:59:59") {
                        if ($day=date("j")==5) {//pregunta si es viernes
                            echo "Las proximas clases para el día lunes son: ";
                        }
                        else{
                            echo "La clases para mañana son:";
                        }
                    }
                    else{
                    }
                }
            }
            elseif ($day=date("N")==7) {//por domingo
               echo "La clases para mañana son: ";
            }else{
                echo "Las proximas clases para el día lunes son: ";

            }
function cortarPeri($ini){
    
                        $maximo = strlen($ini);
                        $inicio = substr(strrev($ini),3,$maximo);
                        $inicio=strrev($inicio);
                        return $inicio;
   
}

            if ($clases != null) {
                echo "<h3></h3>";
                echo "<table class='table table-hover-striped'style='text-align:left;'  >
                       <thead>
                        <tr>
                            <th>Periodo</th>
                            <th>Inicio</th>  
                            <th>Término</th>
                            <th>Nombre</th>
                            <th>Asignatura</th>
                            <th>Sala</th>
                            <th>Sección</th>
                            <th>Asistencia</th>
                        </tr> 
                      </thead><tbody>";
                  
                foreach ($clases as $aula) { ?>
                    <tr>
                        <td><?= $aula->periodo;  ?></td>
                        <td><?= cortarPeri($aula->inicio); ?></td>
                        <td><?= cortarPeri($aula->termino) ;?></td>
                        <td><?= $aula->nombres." ".$aula->apellidos;?></td>
                        <td><?= $aula->nombre ;?></td>
                        <td><?= $aula->sala ;?></td>
                        <td><?= $aula->seccion ;?></td>
                        <td><?php if($aula->estado=='t'){echo "<span class='label label-success'>Presente</span>";}else{echo"<span class='label label-danger'>Ausente</span";} ;?></td>

                    </tr>
                    <?php 
                }
                echo "</tbody></table>";
            } 
            else echo "No hay clases, recomendamos consultar por día o profesor";
        ?>
	</div>
</div>