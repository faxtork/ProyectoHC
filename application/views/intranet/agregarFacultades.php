
<div class="well">
	<div class="row-fluid"><div class="span3"></div><div class="span9"><h3>Agregar Facultades de la UTEM</h3></div></div>
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
						    echo form_open('intranet/agregarFacultad',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-2 control-label" id="c">Facultad</label>
									    <div class="col-sm-4">
											<input class="form-control"  name="addFacultad[]" id="addFacultad[]" type="text">
										</div>	
										<label  class="col-sm-1 control-label" id="c">Desc.</label> 
				 						<div class="col-sm-5">
				 							<textarea class="form-control" name="addDesc[]" id="addDesc[]"></textarea>	
										</div>
									</div>
									<div  id="gr">
										
									</div>
										
								
										
					    	
				</div>
			<div class="row-fluid">
				<div class="span12">
					<?php 
					echo '<input type="submit" name="enviarModificacion" value="Enviar" class="btn btn-primary">';
					echo form_close();
					 ?>
					<input type="submit" name="agregarModificacion" value="Agregar" class="btn btn-success" onclick="agregarHijo()">
				</div>
			</div>					
		</div>
	</div>
</div>
<script>



	var cantidad = 0;
	var gr=1;
function agregarHijo() 
{
  cantidad++;
  gr++;
  	var nuevoDiv =document.createElement('div');
    var nuevoLabel = document.createElement('label');
    var nuevoDiv2 = document.createElement('div');
    var nuevohijo = document.createElement('input');
    var nuevoLabel2 = document.createElement('label');
    var nuevoDiv3 = document.createElement('div');
    var nuevohijo2 = document.createElement('textarea');

      nuevoDiv.type='div';
      nuevoDiv.setAttribute('class','form-group');
      nuevoDiv.setAttribute('id','gr'+gr);
      document.getElementById('gr').appendChild(nuevoDiv);

      nuevoLabel.type='label';
 	  nuevoLabel.innerHTML='Facultad';
 	  nuevoLabel.setAttribute('class','col-sm-2 control-label');
      document.getElementById('gr'+gr).appendChild(nuevoLabel);

      nuevoDiv2.type='div';
      nuevoDiv2.setAttribute('class','col-sm-4');gr++;
      nuevoDiv2.setAttribute('id','gr'+gr); gr--;
      document.getElementById('gr'+gr).appendChild(nuevoDiv2);

      nuevohijo.type = 'text';
	  nuevohijo.setAttribute('class', 'form-control');
	  nuevohijo.name = 'addFacultad[]';
	  nuevohijo.id = 'addFacultad[]';gr++;
	  document.getElementById('gr'+gr).appendChild(nuevohijo);gr--;

	  nuevoLabel2.type='label';
 	  nuevoLabel2.innerHTML='Desc.';
 	  nuevoLabel2.setAttribute('class','col-sm-1 control-label');
      document.getElementById('gr'+gr).appendChild(nuevoLabel2);

      nuevoDiv3.type='div';
      nuevoDiv3.setAttribute('class','col-sm-5');gr++;gr++;
      nuevoDiv3.setAttribute('id','gr'+gr);gr--;gr--;
      document.getElementById('gr'+gr).appendChild(nuevoDiv3);

      nuevohijo2.type = 'textarea';
	  nuevohijo2.setAttribute('class', 'form-control');
	  nuevohijo2.name = 'addDesc[]';
	  nuevohijo2.id = 'addDesc[]';gr++;gr++;
	  document.getElementById('gr'+gr).appendChild(nuevohijo2);

}
</script>