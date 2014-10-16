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
	<div class="span9">
		<div class="well">
			<div class="row-fluid">
				<div class="span12"><h3>Lista De Usuarios Administradores Que usted a Creado</h3></div>
			</div>
			<div class="row-fluid">
			<h4>Administrador General</h4>
				<div class="span12">
					<div class="mygrid-wrapper-div">
				      <table class="table table-hover-striped" style="text-align:left;" border="0">
				             <thead>
				                    <tr>
				                        <th>Nombre</th>
				                        <th >Rut</th>
				                        <th>Descripcion</th>                 
				                        <th>Editar</th>
				                        <th>Eliminar</th>
				                    </tr> 
				                  </thead>
				                <tbody >
				                
				                     <?php
				                    
				                    foreach ($datosUsersGeneral as $pedi) {
				                        ?>
				                        <?php
				                    echo form_open('admin/editarUserGeneral');

				                        echo '<tr>';
				                        echo '<td >'.$pedi->nombre.'</td>';
				                        echo '<td>'.$pedi->rut.'</td>';
				                        echo '<td>'.$pedi->descripcion.'</td>'; 
				                        
				                                                ?>
				                                               
				                        <input type="hidden" name="pkUser" value="<?php echo $pedi->pk;?>">  
				                        <td>
				                        <button class="btn btn-info" >Editar <span class="icon-edit icon-white"></span></button>
				                    
				                        </td>                        
				                        <td>
													<?php if($_SESSION['adminGeneral']==$pedi->nombre ){
														?>
													   <a disabled="true" class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Eliminar <span class="icon-remove icon-white"></span></a></td>
														<?php
														}else{
															?>
														<a  class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Eliminar <span class="icon-remove icon-white"></span></a></td>
															<?php
														}

														?>
				                        <?php

				                        echo "</tr></form>";
				                        
				                    }
				                    ?>
				                </tbody>
				       </table>
				     </div>  
				</div>
			</div>
			<div class="row-fluid">			<h4>Usuario Administrador</h4>
				<div class="span12">
					<div class="mygrid-wrapper-div">
				      <table class="table table-hover-striped" style="text-align:left;" border="0">
				             <thead>
				                    <tr>
				                        <th>Nombre</th>
				                        <th >Rut</th>
				                        <th>De Campus</th>
				                        <th>Descripcion</th>                 
				                        <th>Editar</th>
				                        <th>Eliminar</th>
				                    </tr> 
				                  </thead>
				                <tbody >
				                
				                     <?php
				                    
				                    foreach ($datosUsers as $pedi) {
				                        ?>
				                        <?php
				                    echo form_open('admin/editarUser');

				                        echo '<tr>';
				                        echo '<td >'.$pedi->nom.'</td>';
				                        echo '<td>'.$pedi->rut.'</td>';
				                        echo '<td>'.$pedi->nombre.'</td>';
				                        echo '<td>'.$pedi->descripcion.'</td>'; 
				                        
				                                                ?>
				                                               
				                        <input type="hidden" name="pkUser" value="<?php echo $pedi->pk;?>"> 

				                        <td>
				                        <button class="btn btn-info" >Editar <span class="icon-edit icon-white"></span></button>
				                    
				                        </td>                        
				                        <td>
													<?php if($_SESSION['adminGeneral']==$pedi->nombre ){
														?>
													   <a disabled="true" class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Eliminar <span class="icon-remove icon-white"></span></a></td>
														<?php
														}else{
															?>
														<a  class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Eliminar <span class="icon-remove icon-white"></span></a></td>
															<?php
														}

														?>
				                        <?php

				                        echo "</tr></form>";
				                        
				                    }
				                    ?>
				                </tbody>
				       </table>
				     </div>  
				</div>
			</div>					
		</div>
</div>
