		 <script>
 function validacion(){
 	var user = document.getElementById("user").value;
 	var pass = document.getElementById("pass").value;
 	var rut = document.getElementById("rut").value;

	if(user=="" || pass=="" || rut==""){
			alert("Favor Rellenar todos los Campos");
			return false;
	}
 }
 </script>
		<div class="span9"><div class="well">
			<div class="row-fluid"><div class="span12"><h3>Agregar Usuarios administradores</h3></div></div><br>
						<?php 
						$attributes = array('name'=>'form1','class' => 'form-horizontal', 'role' => 'form','onsubmit'=>'return validacion()');
						          $atributos_Rut = array(
							          'name' => 'rut',
							          'id'=>'rut',
							            'value' => set_value('usuario'),
							            'placeholder'=>'Ej: 12.345.678-9',
							            'onblur'=>'return Rut(form1.rut.value)',
							            'class'=>'form-control'
							        );
						 ?> 					
					    <?php 
						    echo form_open('admin/agregarUser',$attributes);?>
				    				<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Usuario</label>
									    <div class="col-sm-5">
											<input class="form-control"  name="user" id="user" type="text">
										</div>	
									</div>
									<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Clave</label>
									    <div class="col-sm-5">
											<input class="form-control"  name="pass" id="pass" type="text">
										</div>	
									</div>
									<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Contacto</label>
									    <div class="col-sm-5">
											<input placeholder="no requerido" class="form-control"  name="contacto" id="contacto" type="text">
										</div>	
									</div>
									<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Rut</label>
									    <div class="col-sm-5">
											<?php echo form_input($atributos_Rut); ?>
										</div>	
									</div>
									<div class="form-group">
									    <label  class="col-sm-4 control-label" id="c">Grado</label>
									    <div class="col-sm-5">
											<select name="grado" id="grado"  class="form-control">
												<option value="0">Administrador general (Mismo nivel que yo)</option>
												<option value="1">Usuario administrador</option>
											</select>
										</div>	
									</div>
									<div id="x">
										<div class="form-group" id="div1">
											<label  class="col-sm-4 control-label" id="c">Para el Campus:</label>
									   		 <div class="col-sm-5" id="div2">
												<select name="campus" class="form-control" id="campus" >
													<?php 
													    foreach ($campus as $camp) {
													 		echo'<option value='.$camp->pk.'>'.$camp->nombre.'</option>';
													    }
													 ?>
												</select>
											</div>	
										</div>
									</div>


			<div class="row-fluid"> 
				<div class="span12">
					<?php 
				echo '<button type="submit" name="enviarUser" value="Enviar" class="btn btn-primary">Enviar <span class="icon-ok icon-white"></span></button>';
					echo form_close();
					 ?>
				</div>
			</div>					
		</div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {
        	document.getElementById('x').style.display='none'
            $("#grado").change(function() {
                $("#grado option:selected").each(function() { 
                   grado=$('#grado').val();
                   if(grado==0){//si es uno desplegar select de facultad
                   	document.getElementById('x').style.display='none'
                   }
                   else 
                   	document.getElementById('x').style.display='block'

                });
            });
        });
</script>