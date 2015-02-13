<?php 
if(count($pedidos)!=0){
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
<div class="well">
   <div class="mygrid-wrapper-div">
  <table class='table table-hover-striped'border="0" style="text-align:left;">
                   <thead >
                    <tr>
                        <th>N° Pedido</th>
                        <th>Asignatura</th>
                        <th >Fecha</th>
                        <th>Sala</th>
                        
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr> 
                  </thead>
                 
                <tbody>
                    
                    <?php
echo form_open('pedidos/editarPedido');
                    foreach ($pedidos as $pedi) {
                        echo '<tr>';
                        echo '<td>'.form_label($pedi->pk).'</td>';
                        echo '<td>'.form_label($pedi->nombreasignatura).'</td>';?>
                        <td><?php echo form_label(extraerFecha($pedi->fecha)); ?></td><?php  
                        echo '<td>'.form_label($pedi->sala).'</td>'; 
                        echo '<td>'.form_label($pedi->periodo).'</td>';
                        //         <button class="btn btn-info" name="editar" value="Editar">Editar <span class="icon-edit icon-white"></span></button>

                      if($pedi->adm_fk==NULL){
                          echo "<td><span class='label label-info'>Pendiente</span></td>";
                          
                          ?>
                         
                          <td><button class="btn btn-info" name="editar" value="Editar">Editar <span class="icon-edit icon-white"></span></button></td>
                           <input type="hidden" name="pkPedido" value="<?php echo $pedi->pk;?>"> 
                           <input type="hidden" name="pkdocente" value="<?php echo $pedi->pkdocente;?>"> 
                           <input type="hidden" name="pkasignatura" value="<?php echo $pedi->pkasignatura;?>"> 
                           <input type="hidden" name="fecha" value="<?php echo $pedi->fecha;?>"> 
                           <input type="hidden" name="seccion" value="<?php echo $seccion;?>"> 
                           <input type="hidden" name="nombreasignatura" value="<?php echo  $pedi->nombreasignatura;?>"> 
                           <input type="hidden" name="nombredocente" value="<?php echo  $pedi->nombredocente;?>"> 
                           <input type="hidden" name="periodo" value="<?php echo  $pedi->periodo;?>"> 
                           <input type="hidden" name="pksala" value="<?php echo  $pedi->pksala;?>"> 
                           <input type="hidden" name="sala" value="<?php echo  $pedi->sala;?>"> 


                            
                          <td><a href='javascript:void(0);' onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk?>')" class='btn btn-danger' >Eliminar <span class="icon-remove icon-white"></span></a></td>  
                     <?php }
                      else{
                          echo "<td><span class='label label-success'>Aprobado</span></td>";
                          echo '<td></td>';
                          //echo "<td><a href='".  base_url()."index.php/pedidos/eliminarPedido/$pedi->pk' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn btn-danger' >Eliminar</a></td>";
                      }                      
                      echo '</tr>';
                    }
                  echo "</form>";  
                    ?>
                </tbody>
 </table>
   </div><br><br>
</div>
<?php }else{
  echo "<script>alert('Lo siento Antes debes pedir una Sala.')</script>";
}