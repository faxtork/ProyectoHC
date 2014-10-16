<div class="well">
<div class="row-fluid">
	<div class="span3"></div>
	<div class="span6">
			<?php 
			        $atributos_Btn=  array(
		            'class'=>'btn btn-primary btn-lg',
		            'type'=>'submit'); 
		            $atributos= array( "" => "Seleccione un Academico", );
					foreach ($academico as $profesor){ 
						$atributos[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; 
					}
						
						
				echo form_open('consulta/res_academico/','role="form"');
				echo '<div class="form-group">
				<label"><h3>Clases por Docente a la semana</h3></label>';
				
				echo form_dropdown('docente', $atributos,'','class="form-control"');
				echo "<br/>";
				//echo form_submit($atributos_Btn, 'Enviar');
				 echo '<button class="btn btn-primary btn-lg" type="submit"  value="Enviar" name="btnEnviar">Enviar <span class="icon-ok icon-white"></span></button>';
		        echo form_close();
			?>
	</div>
	<div class="span3"></div>

</div>
</div>

