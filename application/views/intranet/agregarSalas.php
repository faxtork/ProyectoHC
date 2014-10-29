		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Agregar Salas Para Campus de: <?php echo $campusOtrorgado->nombre;  ?></h3></div></div>
						<?php 
						$attributes = array('class' => 'form-horizontal', 'role' => 'form');
						 ?> 					
					    <?php 
						    echo form_open('intranet/agregarSala',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-2 control-label" id="c">Sala</label>
									    <div class="col-sm-4">
											<input class="form-control"  name="addSala[]" id="addSala[]" type="text">
										</div>	
										<?php echo '<input type="hidden" name="pkCampus" value="'.$campusOtrorgado->pk.'">'; ?>
									</div>
									<div  id="gr">							
									</div>
			<div class="row-fluid"> 
				<div class="span12">
					<?php 
				echo '<button type="submit" name="enviarModificacion" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
					<a type="submit" name="agregarModificacion" value="Agregar" class="btn btn-success" onclick="agregarHijo()"><i class="icon-chevron-down"></i></a>
					<a name="agregarModificacion" type="submit" class="btn btn-success" onclick="quitarHijo()"><i class="icon-chevron-up"></i></a>

				</div>
			</div>					
		</div>
</div>
<script>
var gr=1;
var subgr=0;
function agregarHijo()
{
subgr++;

 if(gr<=9){
 	gr++;
		var nuevoDiv =document.createElement('div');
		var nuevoLabel = document.createElement('label');
		var nuevoDiv2 = document.createElement('div');
		var nuevohijo = document.createElement('input');


		nuevoDiv.type='div';
		nuevoDiv.setAttribute('class','form-group');
		nuevoDiv.setAttribute('id','gr'+gr);
		document.getElementById('gr').appendChild(nuevoDiv);

		nuevoLabel.type='label';
		nuevoLabel.innerHTML='Sala';
		nuevoLabel.setAttribute('class','col-sm-2 control-label');
		document.getElementById('gr'+gr).appendChild(nuevoLabel);

		nuevoDiv2.type='div';
		nuevoDiv2.setAttribute('class','col-sm-4');subgr++;
		nuevoDiv2.setAttribute('id','subgr'+subgr); subgr--;
		document.getElementById('gr'+gr).appendChild(nuevoDiv2);

		nuevohijo.type = 'text';
		nuevohijo.setAttribute('class', 'form-control');
		nuevohijo.name = 'addSala[]';
		nuevohijo.id = 'addSala[]';subgr++;
		document.getElementById('subgr'+subgr).appendChild(nuevohijo);subgr--;
	}	
}
function quitarHijo(){
		if(gr<=10){
			var o = document.getElementById('gr'+gr);
			o.parentNode.removeChild(o); 
			gr--;
		}
}
</script>