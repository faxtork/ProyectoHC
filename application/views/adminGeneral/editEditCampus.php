
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Modificación de Campus de la UTEM</h3></div></div>

				<div clas="mygrid-wrapper-div">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form');
						 ?> 					
					    <?php 
						    echo form_open('intranet/updateCampus',$attributes);
				    				for($i=0; $i <count($campusPk) ; $i++) {
										echo '<div class="form-group">
											    <label  class="col-sm-2 control-label" id="c">Campus</label>
											    <div class="col-sm-4">
													<input class="form-control"  name="newCampus[]" type="text" value="'.$campusPk[$i][0]->nombre.'"><br>
													<input type="hidden" name="pk[]" value="'.$campusPk[$i][0]->pk.'">
												</div>	
												<label  class="col-sm-1 control-label" id="c">Desc.</label> 
						 						<div class="col-sm-5">
						 							<textarea style="resize:none;" class="form-control" name="newDescripcion[]">'.$campusPk[$i][0]->descripcion.'</textarea><br>	
													
												</div>
											</div>
										';
									}
										
					     ?>		
				</div>
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<button type="submit" name="editarModificacion" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
					
				</div>
			</div>					
		</div>
</div>