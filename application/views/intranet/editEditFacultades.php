
<div class="well">
	<div class="row-fluid"><div class="span3"></div><div class="span9"><h3>Modificacion de Facultades de la UTEM</h3></div></div>
	<div class="row-fluid">
		<div class="span3">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="<?= site_url('intranet/editFacultades');?>">Facultades</a></li>
				<li><a href="<?= site_url('intranet/editSalas');?>">Salas</a></li>
				<li><a href="<?= site_url('intranet/editDepartamentos');?>">Departamentos</a></li>
				<li><a href="<?= site_url('intranet/editEscuelas');?>">Escuelas</a></li>
				<li><a href="<?= site_url('intranet/editAsignaturas');?>">Asignaturas</a></li>
				<li><a href="<?= site_url('intranet/editDocnetes');?>">Docentes</a></li>
				<li><a href="<?= site_url('intranet/editPeriodos');?>">Periodos</a></li>
			</ul>
		</div>
		<div class="span9"><br>	
				<div clas="mygrid-wrapper-div">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form');
						 ?> 					
					    <?php 
						    echo form_open('intranet/updateFacultad',$attributes);
				    				for($i=0; $i <count($facultadesPk) ; $i++) {
										echo '<div class="form-group">
											    <label  class="col-sm-2 control-label" id="c">Facultad</label>
											    <div class="col-sm-4">
													<input class="form-control"  name="newFacultad[]" type="text" value="'.$facultadesPk[$i][0]->facultad.'"><br>
													<input type="hidden" name="pk[]" value="'.$facultadesPk[$i][0]->pk.'">
												</div>	
												<label  class="col-sm-1 control-label" id="c">Desc.</label> 
						 						<div class="col-sm-5">
						 							<textarea class="form-control" name="newDescripcion[]">'.$facultadesPk[$i][0]->descripcion.'</textarea><br>	
													
												</div>
											</div>
										';
									}
										
					     ?>		
				</div>
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<input type="submit" name="editarModificacion" value="Enviar" class="btn btn-primary">';
					echo form_close();
					 ?>
					
				</div>
			</div>					
		</div>
	</div>
</div>
