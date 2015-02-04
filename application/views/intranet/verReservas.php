<?php 
$TAMANO_PAGINA = 100;
$pagina = @$_GET["pagina"];
if (!$pagina) {
    $inicio = 0;
    $pagina=1;
}
else {
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

$num_total_registros=count($reservas);
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
$filas_chunked = array_chunk($reservas,$TAMANO_PAGINA); //3 arrays devueltos
 ?>
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
if($num_total_registros>0){
 ?>

<div class="well">
    <h4 class="">Reservas de Profesores por Fecha</h4>
     <div class="mygrid-wrapper-div">
      <table class="table table-hover-striped" style="text-align:left;" border="0">
             <thead>
                    <tr>
                        <th>Reserva</th>
                        <th >Profesor</th>
                        <th>Apellido</th>
                        <th>Fecha</th>   
                        <th>Codigo</th>                               
                        <th>Asignatura</th>
                        <th>Sec.</th>
                        <th>Periodo</th>
                        <th>Sala</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr> 
                  </thead>
                <tbody >
                
                     <?php
                     for ($i = 0; $i < @count($filas_chunked[$pagina-1]); $i++ ){
                                  $fe=$filas_chunked[$pagina-1][$i]->fecha;
                                          echo form_open('intranet/editarReser');
                                          echo '<tr>';
                                          echo '<td >'.$filas_chunked[$pagina-1][$i]->pk.'</td>';
                                          echo '<td>'.$filas_chunked[$pagina-1][$i]->nombredocente.'</td>';
                                          echo '<td>'.$filas_chunked[$pagina-1][$i]->apellidodocente.'</td>';
                                        //  echo '<td>'.extraerFecha($fe).'</td>'; 
                                          ?><td><?php echo extraerFecha($fe);?></td><?php 

                                          
                                          echo '<td><b>'.$filas_chunked[$pagina-1][$i]->codigo.'</b></td>';
                                          echo '<td>'.$filas_chunked[$pagina-1][$i]->asignatura.'</td>';
                                          echo '<td>'.$filas_chunked[$pagina-1][$i]->seccion.'</td>';
                                          echo '<td>'.$filas_chunked[$pagina-1][$i]->periodo.'</td>';
                                          echo '<td>'.$filas_chunked[$pagina-1][$i]->sala.'</td>'; 
                                                                  ?>
                                          <input type="hidden" name="pkReserva" value="<?php echo $filas_chunked[$pagina-1][$i]->pk;?>"> 
                                          <input type="hidden" name="pkdocente" value="<?php echo $filas_chunked[$pagina-1][$i]->pkdocente;?>"> 
                                            <input type="hidden" name="seccion" value="<?php echo $filas_chunked[$pagina-1][$i]->seccion;?>"> 
                                            <input type="hidden" name="fecha" value="<?php echo $filas_chunked[$pagina-1][$i]->fecha;?>">

                                            <input type="hidden" name="sala" value="<?php echo $filas_chunked[$pagina-1][$i]->sala;?>"> 
                                            <input type="hidden" name="salaPk" value="<?php echo $filas_chunked[$pagina-1][$i]->pksala?>"> 
                                            <input type="hidden" name="periodoPk" value="<?php echo $filas_chunked[$pagina-1][$i]->pkperiodo?>"> 

                                            <input type="hidden" name="semestre" value="<?php echo $filas_chunked[$pagina-1][$i]->semestre?>">    
                                            <input type="hidden" name="anio" value="<?php echo $filas_chunked[$pagina-1][$i]->anio?>">    
                                          <td>
                                          <button class="btn btn-info" name="editar" value="Editar">Editar <span class="icon-edit icon-white"></span></button>
                                      
                                          </td>                        
                                          <td><a class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarreservasdo/<?php echo $filas_chunked[$pagina-1][$i]->pk; ?>')">Eliminar <span class="icon-remove icon-white"></span></a></td>
                                          <?php

                                          echo "</tr></form>";
                    }
  
                    ?>
                 
                </tbody>
       </table>
     </div>    
    <?php 
              if ($total_paginas > 1){
                      for ($i=1;$i<=$total_paginas;$i++){
                         if ($pagina == $i){
                                        echo'<ul class="pagination">';
                                        echo "<li><a href='?pagina=" . $i . "'>" . $i . "</a></li>";
                                        echo'</ul>';
                         }else{
                                        echo'<ul class="pagination">';
                                        echo "<li><a href='?pagina=" . $i . "'>" . $i . "</a></li>";
                                        echo'</ul>';
                         }
                      }
                    }
echo "<br />";
    echo "Número de registros encontrados: " . $num_total_registros . "<br>";
    echo "Se muestran páginas de " . $TAMANO_PAGINA . " registros cada una<br>";
    echo "Mostrando la página " . $pagina . " de " . $total_paginas;
 ?>
</div>
<?php }else{
  echo "<script type='text/javascript'>alert('Aun no tiene reservas, Asigne una clase primero.');</script>";
  redirect('intranet/academico', 'refresh');
} ?>