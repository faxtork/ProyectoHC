
<?php 
   function paginar($v, $l, $p) {//vector,cantidad x pag,numero de pagina
		   $paginas = ceil(count($v) / $l);
		   // CONDICION DE INICIO
		$inicio = ($p-1)*$l;
		      
		// CONDICION DE FINAL
		$final = $p*$l;
		// MOSTRAMOS LOS ITEMS RESPECTIVOS
		   for ($i=$inicio; $i<$final; $i++) {
		         if (isset($v[$i]))
		            echo "<div id='item'>$i.- $v[$i]</div>";
		         else 
		            break;
		      }
		      echo '<ul id="resultados" class="pagination">';
		      // LISTAMOS LAS PÁGINAS
		       //------- flechita izquiera
		        if ($p>1)
		      	   echo "<li><a href=".site_url('intranet/editSalas')."?p=".($p-1).">&laquo</a></li>";
		      	else
		      	   echo "<li class='disabled'><a href='#'>&laquo</a></li>";
				//-------cierre flechita izquiera
				      for ($i=1; $i<=$paginas; $i++) {
				         if ($i == $p)
				            echo "<li class='disabled'><a href='#'>$i</a></li>";
				         else 
				            echo "<li><a href=".site_url('intranet/editSalas')."?p=".$i.">$i</a></li>";

				      }
		      	//-------- flechita derecha
		        if ($p<$paginas)
	            	echo "<li><a href=".site_url('intranet/editSalas')."?p=".($p+1).">&raquo</a></li>";
	            else 
	          	    echo "<li class='disabled'><a href='#'>&raquo</a></li>";
	          	//-------cierre flechita izquiera
		      echo '</ul>';
		return;
		   
		}
 ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#facultad").change(function() {
                $("#facultad option:selected").each(function() { 
                   facultad=$('#facultad').val();
                  $.post("<?= base_url('/index.php/intranet/llena_salas2')?>", {
                        facultad : facultad
                    }, function(data) {
                     	  $("#salas").html(data);
                     	//alert(data);
                    });
                });
            });
        });
</script>
		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Lista de Salas por Facultad de la UTEM</h3></div></div>
			<div class="row-fluid">
				<div class="span4">
						<?php
						$attributes = array('class' => 'form-horizontal', 'role' => 'form');
						echo form_open('intranet/',$attributes);
						echo'	<div class="form-group">
							    	<label  class="col-sm-3 control-label" id="c">Facultad</label>
							    	<div class="col-sm-9">
										<select name="facultad" class="form-control" id="facultad" >
										<option value="">Selececione una Facultad</option>
											';
											    foreach ($facultades as $facu) {
											 		echo'<option value='.$facu->pk.'>'.$facu->facultad.'</option>';
											    }
											echo'
										</select>
							    	</div>
							  	</div>';
						?>
				</div>
				<div class="span8">
					<div id="salas"></div>
					<?php echo form_close(); ?>				
				</div>
			</div>

						 
					    <?php //var_dump($salas);
					    //echo $salas[1][1]->sala;
					    foreach ($salas as $aula) {
					    	//echo $aula->sala."<br/>";
					    }
					   // echo $cantidadFacultad->cantfacu;
						   // echo form_open('intranet/',$attributes);
						     /* if (isset($_GET['p']))
							      $p = $_GET['p'];
							   else 
							      $p=1;
							  $contador=0;
							  foreach ($salas as $aula) {
							  	if($aula->facultad_fk==1){
							  		$caja[($aula->pk-1)]=$aula->sala;
							  	}
							  	if($contador < $cantidadFacultad->$cantfacu){
							  		
							  		$contador++;
							  	}
							  	
							  }
							  // paginar($caja, 10, $p);

							   			echo '<div class="form-group">
											    <label  class="col-sm-2 control-label" id="c">Facultad</label>
											    <div class="col-sm-4">
											  		<div class="input-group">  <span class="input-group-addon"><input type="checkbox" name="accion[]" id="accion" value="1"></span>
													<input class="form-control" readonly="readonly" type="text" value="xd"> <span class="input-group-addon"><span class="icon-check"></span></span></div>
												</div>	
												<label  class="col-sm-1 control-label" id="c">Desc.</label> 
						 						<div class="col-sm-5">
						 							<textarea class="form-control" readonly="readonly">xd</textarea><br>	
												</div>
											</div>
										';*/
					     ?>	


			<div class="row-fluid">
				<div class="span12">
					<?php
					echo '<button type="submit" name="eliminarModificacion"  value="Eliminar" class="btn btn-danger" onclick="return confirmar();">Eliminar <span class="icon-remove icon-white"></span></button>
					<button type="submit" name="editarModificacion" value="Editar" class="btn btn-info">Editar <span class="icon-edit icon-white"></span></button>
					<button type="submit" name="agregarModificacion" value="Agregar" class="btn btn-primary">Agregar <span class="icon-plus-sign icon-white"></span></button>';
				//	echo form_close();
					 ?>
				</div>
			</div>
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
