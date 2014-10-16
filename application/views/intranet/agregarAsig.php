 <script>
 function validacion(){
 	var addAsigName = document.getElementById("addAsigName").value;
 	var addAsigCod = document.getElementById("addAsigCod").value;

	if(addAsigCod=="" || addAsigName==""){
			alert("Favor Rellenar todos los Campos");
			return false;
	}
 }
 </script>
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h4>Agregar asignaturas Para El Dpto. de:</h4> <h2><?php echo $docOtorgado[0]->departamento;  ?></h2></div></div>
						<br><?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'form1','onsubmit'=>'return validacion()');
						 ?> 					
					    <?php 
						    echo form_open('intranet/agregarAsig',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-1 control-label" id="c">Asig.</label>
										    <div class="col-sm-3">
												<input class="form-control"  name="addAsigName" id="addAsigName" type="text">
											</div>
										<label  class="col-sm-1 control-label" id="c">Codigo</label>
										    <div class="col-sm-3">
												<input class="form-control"  name="addAsigCod" id="addAsigCod" type="text">
											</div>
									    <label  class="col-sm-1 control-label" id="c">Desc.</label>
										    <div class="col-sm-3">
												<textarea style="resize:none" class="form-control" placeholder="Opcional" name="addAsigDesc" id="addAsigDesc" type="text"></textarea>
											</div>	
										<?php echo '<input type="hidden" name="pkDpto" value="'.$docOtorgado[0]->pk.'">'; ?>
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
