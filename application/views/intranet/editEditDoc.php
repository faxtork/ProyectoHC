
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Modificacion de Docentes de la UTEM</h3></div></div>
				<div clas="mygrid-wrapper-div">
						<br><?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'formulario');
						 ?> 					
					    <?php 
						    echo form_open('intranet/updateDoc',$attributes);
				    				for($i=0; $i <count($docPk) ; $i++) {//document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled=!document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled
										echo '<div class="form-group">
											    <label  class="col-sm-1 control-label" id="c">Nombres</label>
											    <div class="col-sm-3">
													<input class="form-control" id="newName[]" name="newName[]" type="text" value="'.$docPk[$i][0]->nombres.'"><br>
													<input type="hidden" name="pk[]" value="'.$docPk[$i][0]->pk.'">
												</div>	
												<label  class="col-sm-1 control-label" id="c">Apellidos</label> 
						 						<div class="col-sm-3">
						 							<input class="form-control" id="newApellidos[]" name="newApellidos[]" type="text" value="'.$docPk[$i][0]->apellidos.'"><br>	
												</div>
												<label  class="col-sm-1 control-label" id="c">Rut</label> 
						 						<div class="col-sm-3">
						 							<input readonly="readonly" class="form-control" id="newRut[]" name="newRut[]" type="text" value="'.$docPk[$i][0]->rut.'"><br>	
												</div>    
											</div>
										';
									}
										
					     ?>		
				</div>
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<button type="submit" name="editDoc" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
					
				</div>
			</div>					
		</div>
</div>
