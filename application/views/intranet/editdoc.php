<script>
        $(function() {  
   var window_height = $(window).height(),
   content_height = window_height - 200;
   $('.mygrid-wrapper-div').height(content_height);
});

$( window ).resize(function() {
   var window_height = $(window).height(),
   content_height = window_height - 50;
   $('.mygrid-wrapper-div').height(content_height);
});
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#dpto").change(function() {
                $("#dpto option:selected").each(function() { 
                   dpto=$('#dpto').val();
                  $.post("<?= base_url('/index.php/intranet/llena_docDpto')?>", {
                        dpto : dpto
                    }, function(data) {
                     	  $("#doc").html(data);

                     		if(data==false)
                     		{ 
                     			 $("#doc").html("Selecciona otro departamento o Agrega uno nuevo Seleccionando una Dpto.");
                     		}
                    });
                });
            });
        });
</script>
		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Lista de Docentes por Dpto. de Campus UTEM</h3></div></div>
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
				echo form_open('intranet/modificarDoc',$attributes);  ?>
			<div class="row-fluid">
				<div class="span4">
						<?php
						
	
						echo'	<div class="form-group">
							    	<label  class="col-sm-3 control-label" id="c">Dpto.</label>
							    	<div class="col-sm-8">
										<select name="dpto" class="form-control" id="dpto" >
										<option value="">Seleccione un Dpto</option>
											';
											    foreach ($getDptos as $depa) {

											    		echo'<option value='.$depa->pk.'>'.$depa->departamento.'</option>';
											    												
											    	    }
											echo'
										</select>
							    	</div>
							  	</div>';
						?>

				</div>
				<div class="span8">
					
					<div class="mygrid-wrapper-div"><div id="doc"></div></div>
								
				</div>
			</div><br>
			<div class="row-fluid">
				<div class="span12">
					<?php
					echo '<button type="submit" name="eliminarDoc"  value="Eliminar" class="btn btn-danger" onclick="return confirmar();">Eliminar <span class="icon-remove icon-white"></span></button>
					<button type="submit" name="editarDoc" value="Editar" class="btn btn-info">Editar <span class="icon-edit icon-white"></span></button>
					<button type="submit" name="agregarDoc" value="Agregar" class="btn btn-primary">Agregar <span class="icon-plus-sign icon-white"></span></button>';
					
					 ?>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div></div>
<script language="JavaScript">
	function confirmar () {
		var bool=false;
		var estado=confirm("¿Está seguro que desea eliminar el registro?");
		if(estado==true)
			bool=true;
	return bool;
	}
</script>
