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
<div class="well">
    <h4 class="">Reservas de Profesores por fecha</h4>
     <div class="mygrid-wrapper-div">
      <table class="table table-hover-striped" style="text-align:left;" border="0">
             <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th >Profesor</th>
                        <th>Apellido</th>
                        <th>Fecha</th>                 
                        <th>Asignatura</th>
                        <th>Seccion</th>
                        <th>Periodo</th>
                        <th>Sala</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr> 
                  </thead>
                <tbody >
                
                     <?php
                    foreach ($reservas as $pedi) {
                      //if($pedi->facultad_fk!=$_SESSION['facultad']){}
                      //else
                      {
                         echo form_open('intranet/editarReser');

                        echo '<tr>';
                        echo '<td >'.$pedi->pk.'</td>';
                        echo '<td>'.$pedi->nombredocente.'</td>';
                        echo '<td>'.$pedi->apellidodocente.'</td>';
                        echo '<td>'.$pedi->fecha.'</td>'; 
                        
                        echo '<td><b>'.$pedi->codigo.'</b> '.$pedi->asignatura.'</td>';
                        echo '<td>'.$pedi->seccion.'</td>';
                        echo '<td>'.$pedi->periodo.'</td>';
                        echo '<td>'.$pedi->sala.'</td>'; 
                                                ?>
                        <input type="hidden" name="pkReserva" value="<?php echo $pedi->pk;?>"> 
                        <input type="hidden" name="pkdocente" value="<?php echo $pedi->pkdocente;?>"> 
                          <input type="hidden" name="seccion" value="<?php echo $pedi->seccion;?>"> 
                          <input type="hidden" name="fecha" value="<?php echo $pedi->fecha;?>">

                          <input type="hidden" name="sala" value="<?php echo $pedi->sala;?>"> 
                          <input type="hidden" name="salaPk" value="<?php echo $pedi->pksala?>"> 
                          <input type="hidden" name="periodoPk" value="<?php echo $pedi->pkperiodo?>"> 

                          <input type="hidden" name="semestre" value="<?php echo $pedi->semestre?>">    
                          <input type="hidden" name="anio" value="<?php echo $pedi->anio?>">    


                                                     

                        <td>
                        <button class="btn btn-info" name="editar" value="Editar">Editar <span class="icon-edit icon-white"></span></button>
                    
                        </td>                        
                        <td><a class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Eliminar <span class="icon-remove icon-white"></span></a></td>
                        <?php

                        echo "</tr></form>";
                      }

                        
                    }
                    ?>
                 
                </tbody>
       </table>

     </div>    
    
</div>
