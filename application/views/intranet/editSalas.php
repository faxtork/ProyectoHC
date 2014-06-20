<div class="well">
	<div class="row-fluid"><div class="span3"></div><div class="span9"><h3>Esta es la lista actual de Facultades de la UTEM</h3></div></div>
	<div class="row-fluid">
		<div class="span3">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="<?= site_url('intranet/editFacultades');?>">Facultades</a></li>
				<li class="active"><a href="<?= site_url('intranet/editSalas');?>">Salas</a></li>
				<li><a href="<?= site_url('intranet/editDepartamentos');?>">Departamentos</a></li>
				<li><a href="<?= site_url('intranet/editEscuelas');?>">Escuelas</a></li>
				<li><a href="<?= site_url('intranet/editAsignaturas');?>">Asignaturas</a></li>
				<li><a href="<?= site_url('intranet/editDocnetes');?>">Docentes</a></li>
				<li><a href="<?= site_url('intranet/editPeriodos');?>">Periodos</a></li>
			</ul>
		</div>
		<div class="span9"><br>	
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
													<input class="form-control" readonly="readonly" type="text" value="'.$sede->facultad.'"><br></div>
												</div>	
												<label  class="col-sm-1 control-label" id="c">Desc.</label> 
						 						<div class="col-sm-5">
						 							<textarea class="form-control" readonly="readonly">'.$sede->descripcion.'</textarea><br>	
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
					echo '<input type="submit" name="eliminarModificacion"  value="Eliminar" class="btn btn-danger" onclick="return confirmar();">
					<input type="submit" name="editarModificacion" value="Editar" class="btn btn-info">
					<input type="submit" name="agregarModificacion" value="Agregar" class="btn btn-primary">';
					echo form_close();
					 ?>
				</div>
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

