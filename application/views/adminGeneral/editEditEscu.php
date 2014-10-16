
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Modificacion de Escuelas de la UTEM</h3></div></div>
				<div clas="mygrid-wrapper-div">
						<br><?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'formulario');
						 ?> 					
					    <?php 
						    echo form_open('intranet/updateEscu',$attributes);
				    				for($i=0; $i <count($escuPk) ; $i++) {//document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled=!document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled
										echo '<div class="form-group">
											    <label  class="col-sm-2 control-label" id="c">Escuela</label>
											    <div class="col-sm-8">
													<input class="form-control" id="newName[]" name="newName[]" type="text" value="'.$escuPk[$i][0]->escuela.'"><br>
													<input type="hidden" name="pk[]" value="'.$escuPk[$i][0]->pk.'">
												</div>	  
											</div>
										';
									}
										
					     ?>		
				</div>
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<button type="submit" name="editEscu" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
					
				</div>
			</div>					
		</div>
</div>
