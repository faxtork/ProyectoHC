 <script>
 function validacion(){
 	var addEscuName = document.getElementById("addEscuName").value;

	if(addEscuName==""){
			alert("Favor Rellenar todos los Campos");
			return false;
	}
 }
 </script>
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h4>Agregar Escuela. para el Departamento: </h4> <h2><?php echo $dptoOtrogado[0]->departamento;  ?></h2></div></div>
						<br><?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'form1','onsubmit'=>'return validacion()');
						 ?> 					
					    <?php 
						    echo form_open('intranet/agregarEscu',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-2 control-label" id="c">Escuela</label>
										    <div class="col-sm-4">
												<input class="form-control"  name="addEscuName" id="addEscuName" type="text">
											</div>
									    <label  class="col-sm-2 control-label" id="c">Desc.</label>
										    <div class="col-sm-4">
												<textarea style="resize:none" class="form-control" placeholder="Opcional" name="addEscuDesc" id="addEscuDesc" type="text"></textarea>
											</div>	
										<?php echo '<input type="hidden" name="pkDpto" value="'.$dptoOtrogado[0]->pk.'">'; ?>
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
