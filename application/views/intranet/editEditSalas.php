		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Modificacion de Salas de la UTEM</h3></div></div>

				<div clas="mygrid-wrapper-div">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'formulario', 'onClick'=>"estado()");
						 ?> 					
					    <?php 
						    echo form_open('intranet/updateSalas',$attributes);
				    				for($i=0; $i <count($salasPk) ; $i++) {//document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled=!document.formulario.newDescripcion'.$salasPk[$i][0]->pk.'.disabled
										echo '<div class="form-group">
											    <label  class="col-sm-2 control-label" id="c">Sala</label>
											    <div class="col-sm-3">
													<input class="form-control"  name="newSala[]" type="text" value="'.$salasPk[$i][0]->sala.'"><br>
													<input type="hidden" name="pk[]" value="'.$salasPk[$i][0]->pk.'">
												</div>
												<label  class="col-sm-2 control-label"  id="yesnos'.$salasPk[$i][0]->pk.'" >Cancelar Sala</label> 
						 						<div class="col-sm-1">
						 						';
						 						if($salasPk[$i][0]->estado=='t')//true es que esta habil
						 							echo'<input onclick="yesno(\'smoking'.$salasPk[$i][0]->pk.'\',\'yesnos'.$salasPk[$i][0]->pk.'\',\'newDescripcion'.$salasPk[$i][0]->pk.'\');" id="smoking'.$salasPk[$i][0]->pk.'"  type="checkbox"  name="chk[]" value="'.$salasPk[$i][0]->pk.'" >';													
						 						else
						 							echo'<input checked onclick="yesno(\'smoking'.$salasPk[$i][0]->pk.'\',\'yesnos'.$salasPk[$i][0]->pk.'\',\'newDescripcion'.$salasPk[$i][0]->pk.'\');" id="smoking'.$salasPk[$i][0]->pk.'"  type="checkbox"  name="chk[]" value="'.$salasPk[$i][0]->pk.'" >';	
						 						echo'
												</div>	
												<label  class="col-sm-1 control-label" id="c">Desc.</label> 
						 						<div class="col-sm-3">
						 							<textarea style="resize:none;" class="form-control" name="newDescripcion[]" id="newDescripcion'.$salasPk[$i][0]->pk.'" >'.$salasPk[$i][0]->descripcion.'</textarea><br>	
													
												</div>  
											</div>
										';
									}
										
					     ?>		
				</div>
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<button type="submit" name="editSalas" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
					
				</div>
			</div>					
		</div>
</div>
<script>
	function yesno(thecheckbox, thelabel,thearea) { 
    
    var checkboxvar = document.getElementById(thecheckbox);
    var labelvar = document.getElementById(thelabel);
    var textarea =document.getElementById(thearea);
    if (!checkboxvar.checked) {
    	//textarea.innerHTML = "bu";
        labelvar.innerHTML = "Cancelar Sala";
        
    }
    else {
        labelvar.innerHTML = "Habilitar";
    }
}
</script>