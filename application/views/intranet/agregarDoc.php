 <script>
 function validacion(){
 	var addDocName = document.getElementById("addDocName").value;
 	var addDocApe = document.getElementById("addDocApe").value;
 	var rut = document.getElementById("rut").value;


	if(addDocApe=="" || addDocName=="" || rut==""){
			alert("Favor Rellenar todos los Campos");
			return false;
	}
 }
 </script>
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h4>Agregar Docentes Para El Dpto. de:</h4> <h2><?php echo $docOtorgado[0]->departamento;  ?></h2></div></div>
						<br><?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'form1','onsubmit'=>'return validacion()');
						 ?> 					
					    <?php 
						    echo form_open('intranet/agregarDoc',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-1 control-label" id="c">Nombres</label>
										    <div class="col-sm-3">
												<input class="form-control"  name="addDocName" id="addDocName" type="text">
											</div>
										<label  class="col-sm-1 control-label" id="c">Apellidos</label>
										    <div class="col-sm-3">
												<input class="form-control"  name="addDocApe" id="addDocApe" type="text">
											</div>
									    <label  class="col-sm-1 control-label" id="c">Rut</label>
										    <div class="col-sm-3">
												<input class="form-control" placeholder="Ej: 12.345.678-9" onblur="return Rut(form1.rut.value)" name="rut" id="rut" type="text">
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
