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
       /* $(document).ready(function() {
            $("#facultad").change(function() {
                $("#facultad option:selected").each(function() { 
                   facultad=$('#facultad').val();
                  $.post("<?= base_url('/index.php/intranet/llena_salas2')?>", {
                        facultad : facultad
                    }, function(data) {
                     	  $("#salas").html(data);

                     		if(data==false)
                     		{ 
                     			 $("#salas").html("Selecciona una Facultad o Agrega una nueva Sala Seleccionando una Facultad");
                     		}
                    });
                });
            });
        });*/
</script>
		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Lista de Salas Campus de la UTEM</h3></div></div>
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
				echo form_open('intranet/modificarSalas',$attributes);  ?>
			<div class="row-fluid">
				<div class="span12">
					
					<div class="mygrid-wrapper-div"><div id="salas">
						<?php 
				            foreach($salaXCampus as $fila)
  							  {
        
	                            echo'   <div class="form-group">
	                                        <label  class="col-sm-1 control-label" id="c">Sala</label>
	                                        <div class="col-sm-4">
	                                            <div class="input-group">  
	                                                <span class="input-group-addon"><input type="checkbox" name="accion[]" id="'.$fila->pk.'" value="'.$fila->pk.'"></span>
	                                                    <input class="form-control" readonly="readonly" type="text" value="'.$fila->sala.'">
	                                               
	                                            </div>
	                                        </div>  
	                                        <label  class="col-sm-1 control-label" id="c">Desc.</label> 
	                                        <div class="col-sm-4">
	                                            <textarea style="resize:none;" readonly="readonly" class="form-control" name="addDesc[]" id="'.$fila->pk.'">'.$fila->descripcion.'</textarea>  <br />
	                                        </div>
	                                    </div>';
	           						}
						 ?>
					</div></div>
								
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
