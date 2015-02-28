 <script>
 function validacion(){
 	var addCampName = document.getElementById("addCampName").value;

	if(addCampName==""){
			alert("Favor Rellenar todos los Campos");
			return false;
	}
 }
 </script>
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h2>Agregar Campus </h2> </div></div>
						<br><?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'form1','onsubmit'=>'return validacion()');
						 ?> 					
					    <?php 
						    echo form_open('intranet/agregarCamp',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-2 control-label" id="c">Nombre</label>
										    <div class="col-sm-4">
												<input class="form-control"  name="addCampName" id="addCampName" type="text">
											</div>
										<label  class="col-sm-2 control-label" id="c">Descripción</label>
										    <div class="col-sm-4">
				 								<textarea style="resize:none;" class="form-control" name="addDesc" id="addDesc"></textarea>	
											</div>

									</div>
							<br>
			<div class="row-fluid"> 
				<div class="span12">
					<?php 
				echo '<button type="submit" name="enviarModificacion" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>

				</div>
			</div>					
		</div>
</div>
