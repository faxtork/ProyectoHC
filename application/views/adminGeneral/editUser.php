		 <script>
 function validacion(){
 	var user = document.getElementById("user").value;


	if(user==""){
			alert("Favor Rellenar El campo User");
			return false;
	}
 }
 </script>

		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Editar Usuarios administradores</h3></div></div><br>
						<?php 
						$attributes = array('name'=>'form1','class' => 'form-horizontal', 'role' => 'form','onsubmit'=>'return validacion()');
						 ?> 					
					    <?php 
						    echo form_open('admin/updateUser',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Usuario</label>
									    <div class="col-sm-5">
											<input value="<?php echo $datoEditUser->nombre; ?>" class="form-control"  name="user" id="user" type="text">
										</div>	
									</div>
									<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Clave</label>
									    <div class="col-sm-5">
											<input placeholder="EN BLANCO PARA CONSERVAR CLAVE" class="form-control"  name="pass" id="pass" type="text">
										</div>	
									</div>
									<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Contacto</label>
									    <div class="col-sm-5">
											<input value="<?php echo $datoEditUser->contacto; ?>" placeholder="no requerido" class="form-control"  name="contacto" id="contacto" type="text">
										</div>	
									</div>
								<input type="hidden" name="pkEdit" value="<?php echo $datoEditUser->pk; ?>">


			<div class="row-fluid"> 
				<div class="span12">
					<?php 
				echo '<button type="submit" name="enviarUser" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
				</div>
			</div>					
		</div>
</div>
