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
            $("#campus").change(function() {
                $("#campus option:selected").each(function() { 
                   campus=$('#campus').val();
                  $.post("<?= base_url('/index.php/intranet/llena_salas2')?>", {
                        campus : campus
                    }, function(data) {
                     	  $("#salas").html(data);

                     		if(data==false)
                     		{ 
                     			 $("#salas").html("Selecciona una Facultad o Agrega una nueva Sala Seleccionando una Facultad");
                     		}
                    });
                });
            });
        });
</script>
		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Lista de Salas Campus de la UTEM</h3></div></div>
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
				echo form_open('intranet/modificarSalas',$attributes);  ?>
			<div class="row-fluid">
				<div class="span4">
						<?php
									echo' <div class="form-group">
									<label class="col-sm-3 control-label" id="c">Facultad</label>
									<div class="col-sm-9">
										<select name="campus" class="form-control" id="campus" >
										<option value="">Selececione un Campus</option>
										';
										foreach ($campusName as $fila) {
										
										echo'<option value='.$fila->pk.'>'.$fila->nombre.'</option>';//permite a todos
		
										
										}
										echo'
										</select>
									</div>
									</div>';
									?>
				</div>

				<div class="span8">
					
					<div class="mygrid-wrapper-div"><div id="salas"></div></div>
								
				</div>
			</div><br>
			<div class="row-fluid">
				<div class="span12">
					<?php
					echo '<button type="submit" name="eliminarSalas"  value="Eliminar" class="btn btn-danger" onclick="return confirmar();">Eliminar <span class="icon-remove icon-white"></span></button>
					<button type="submit" name="editarSalas" value="Editar" class="btn btn-info">Editar <span class="icon-edit icon-white"></span></button>
					<button type="submit" name="agregarSalas" value="Agregar" class="btn btn-primary">Agregar <span class="icon-plus-sign icon-white"></span></button>';
					
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
