
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Modificacion de Asignaturas de la UTEM</h3></div></div>
				<div clas="mygrid-wrapper-div">
						<br><?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'formulario');
						 ?> 					
					    <?php 
						    echo form_open('intranet/updateDpto',$attributes);
				    				for($i=0; $i <count($dptoPk) ; $i++) {//document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled=!document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled
										echo '<div class="form-group">
											    <label  class="col-sm-2 control-label" id="c">Asignatura</label>
											    <div class="col-sm-7">
													<input class="form-control" id="newName[]" name="newName[]" type="text" value="'.$dptoPk[$i][0]->departamento.'"><br>
													<input type="hidden" name="pk[]" value="'.$dptoPk[$i][0]->pk.'">
												</div>	  
											</div>
										';
									}
										
					     ?>		
				</div>
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<button type="submit" name="editDpto" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
					
				</div>
			</div>					
		</div>
</div>
