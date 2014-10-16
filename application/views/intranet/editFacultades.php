
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Esta es la lista actual de Facultades de la UTEM</h3></div></div>

						<?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form');
						 ?> 					
					    <?php 
						    echo form_open('intranet/modificarFacultad',$attributes);
				    				foreach ($facultades as $sede) {
										echo '<div class="form-group">
											    <label  class="col-sm-2 control-label" id="c">Facultad</label>
											    <div class="col-sm-4">
											  		<div class="input-group">  <span class="input-group-addon"><input type="checkbox" name="accion[]" id="accion" value="'.$sede->pk.'"></span>
													<input class="form-control" readonly="readonly" type="text" value="'.$sede->facultad.'"> <span class="input-group-addon"><span class="icon-check"></span></span></div>
												</div>	
												<label  class="col-sm-1 control-label" id="c">Desc.</label> 
						 						<div class="col-sm-5">
						 							<textarea style="resize:none;" class="form-control" readonly="readonly">'.$sede->descripcion.'</textarea><br>	
												</div>
											</div>
										';
									}				
					     ?>	
											<div class="form-group" >
											    <label  class="col-sm-2 control-label" id="c"></label>
											    <div class="col-sm-4" id="newInput">
												</div>	
												<label  class="col-sm-1 control-label" id="c"></label> 
						 						<div class="col-sm-5" id="newTextarea">						 								
												</div>
											</div>	
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<button type="submit" name="eliminarModificacion"  value="Eliminar" class="btn btn-danger" onclick="return confirmar();">Eliminar <span class="icon-remove icon-white"></span></button>
					<button type="submit" name="editarModificacion" value="Editar" class="btn btn-info">Editar <span class="icon-edit icon-white"></span></button>
					<button type="submit" name="agregarModificacion" value="Agregar" class="btn btn-primary">Agregar <span class="icon-plus-sign icon-white"></span></button>';
					echo form_close();
					 ?>
				</div>
			</div>					
		</div>
	</div>

<script language="JavaScript">
	function confirmar () {
		var bool=false;
		var estado=confirm("¿Está seguro que desea eliminar el registro?");
		if(estado==true)
			bool=true;
	return bool;
	}
</script>

