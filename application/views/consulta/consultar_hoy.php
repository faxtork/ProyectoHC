<div class="row-fluid">
	<div class="span12"><br>
		<?php 
            if ($day=date("N")<=5 && $day=date("j")>=1) {
            
            }
            else{
                echo "Las proximas clases para el dia lunes son:";

            }
            function cortarPeri($ini){
    
                        $maximo = strlen($ini);
                        $inicio = substr(strrev($ini),3,$maximo);
                        $inicio=strrev($inicio);
                        return $inicio;
   
}
            if ($hoy != null) {
                echo "<h3></h3>";
                echo "<table class='table table-hover-striped' style='text-align:left;' >
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
                  
                foreach ($hoy as $aula) { ?>
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
            else {
                echo "No hay clases hoy día ";

            }
        ?>
	</div>
</div>