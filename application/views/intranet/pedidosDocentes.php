<script>
      $(function() {  
   var window_height = $(window).height(),
   content_height = window_height - 200;
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
    <h4 class="">Pedidos de Profesores</h4>
    <div class="mygrid-wrapper-div">
      <table class="table table-hover-striped" style="text-align:left;">
             <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th>Profesor</th>
                        <th>Apellido</th>
                        <th>Fecha</th>                      
                        <th>Asignatura</th>
                        <th>Periodo</th>
                        <th>Sala</th>
                        <th>Aprobar</th>
                        <th>Estado</th>
                    </tr> 
                  </thead>
                 
                  <tbody>
                
                     <?php
                    foreach ($pedidos as $pedi) { 
                        echo '<tr>';
                        echo '<td>'.$pedi->pk.'</td>';
                        echo '<td>'.$pedi->nombredocente.'</td>';
                        echo '<td>'.$pedi->apellidodocente.'</td>';?>
                        <td><?php  echo extraerFecha($pedi->fecha);?></td> <?php                         
                        echo '<td>'.$pedi->asignatura.'</td>';
                        echo '<td>'.$pedi->periodo.'</td>';
                        echo '<td>'.$pedi->sala.'</td>'; 
                        //echo "<td><a href='".base_url()."index.php/intranet/aprobarPedido/$pedi->pk/$pedi->fecha/$pedi->sala/$pedi->pksala/$pedi->nombredocente/$pedi->apellidodocente/$pedi->pkdocente/$pedi->asignatura/$pedi->pkasignatura/$pedi->periodo' onclick='return confirm('¿Desea editar este Contenido?')' class='btn btn-success' >Aprobar</a></td>";
                        ?>
                        <td><a class="btn btn-primary" href="javascript:void(0);"onclick="aprobar('<?php base_url()?>aprobarFinal/<?php echo $pedi->pk; ?>')">Aprobar <span class="icon-ok icon-white"></span></a></td>
                        <td><a class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Rechazar <span class="icon-remove icon-white"></span></a></td>
                        <?php

                        echo "</tr>";
                    }
                    ?>
                 
                </tbody>
       </table>
        </div>
    
</div>
