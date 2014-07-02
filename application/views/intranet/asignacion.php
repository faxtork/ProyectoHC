<?php 
    date_default_timezone_set("America/Santiago");
    $time  = date("H:i:s");
    $año = date('Y');
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

   // echo "Universidad Tecnologica Metropolitana del Estado de Chile.";echo "<br/>";
     // echo "Son las $time, $fecha";
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jquery.ui.datepicker-es.js"></script>
<script>
$(function () {
 $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
    };
function noExcursion(date){
//var date = new Date();
var day = date.getDay();
// aqui indicamos el numero correspondiente a los dias que ha de bloquearse (el 0 es Domingo, 1 Lunes, etc...) en el ejemplo bloqueo todos menos los lunes y jueves.
//return [(day != 0 && day != 1 && day != 2 && day != 3 && day != 5 && day != 6), ''];
return[(day!=0),'']
};
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({
beforeShowDay: noExcursion,
minDate: "-5D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepicker2").datepicker("option", "minDate", selectedDate);
	}
});
$('#datepicker2').datepicker({
beforeShowDay: noExcursion,
minDate: "-5D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepicker").datepicker("option", "maxDate", selectedDate);
	}
});
});
</script>
<script>
$(function () {
 $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
    };
function noExcursion(date){
//var date = new Date();
var day = date.getDay();
// aqui indicamos el numero correspondiente a los dias que ha de bloquearse (el 0 es Domingo, 1 Lunes, etc...) en el ejemplo bloqueo todos menos los lunes y jueves.
//return [(day != 0 && day != 1 && day != 2 && day != 3 && day != 5 && day != 6), ''];
return[(day!=0),'']
};
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepickergr2").datepicker({
beforeShowDay: noExcursion,
minDate: "-5D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepicker2gr2").datepicker("option", "minDate", selectedDate);
	}
});
$('#datepicker2gr2').datepicker({
beforeShowDay: noExcursion,
minDate: "-5D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepickegr2r").datepicker("option", "maxDate", selectedDate);
	}
});
});
</script>
<script>
$(function () {
 $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
    };
function noExcursion(date){
//var date = new Date();
var day = date.getDay();
// aqui indicamos el numero correspondiente a los dias que ha de bloquearse (el 0 es Domingo, 1 Lunes, etc...) en el ejemplo bloqueo todos menos los lunes y jueves.
//return [(day != 0 && day != 1 && day != 2 && day != 3 && day != 5 && day != 6), ''];
return[(day!=0),'']
};

$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepickergr3").datepicker({
beforeShowDay: noExcursion,
minDate: "-5D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepicker2gr3").datepicker("option", "minDate", selectedDate);
	}
});
$('#datepicker2gr3').datepicker({
beforeShowDay: noExcursion,
minDate: "-5D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepickergr3").datepicker("option", "maxDate", selectedDate);
	}
});
});
</script>
<?php 
	    $atributosFacultad=array( "" => "Selec. Facultad", );
    foreach ($facultades as $facu) {
      $atributosFacultad[$facu->pk]=$facu->facultad;
    }
 ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#facultad").change(function() {
                $("#facultad option:selected").each(function() { 
                   facultad=$('#facultad').val();
                  $.post("<?= base_url('/index.php/intranet/llena_salas')?>", {
                        facultad : facultad
                    }, function(data) {
                        $("#salas").html(data);
                    });
                  	
                  $.post("<?= base_url('/index.php/intranet/llena_depa')?>", {
                        facultad : facultad
                    }, function(data) {
                        $("#depa").html(data);
                    });	

                  $.post("<?= base_url('/index.php/intranet/llena_asig')?>", {
	                        facultad : facultad
	                    }, function(data) {
	                        $("#asig").html(data);
	                    });	
                });
            });
        });
</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#dia").change(function() {
                $("#dia option:selected").each(function() { 
                  	dia=$('#dia').val();
                  	            $("#periodo").change(function() {
					                $("#periodo option:selected").each(function() { 
					                  	perio=$('#periodo').val();
					                  $.post("<?= base_url('/index.php/intranet/comprobarDoc')?>", {
						                        perio : perio , dia : dia
						                    }, function(data) {
						                        $("#salas").html(data);
						                    });		
					                });
					            });
                });
            });
        });

</script>
    <script type="text/javascript">
        $(document).ready(function() {
                  	            $("#periodo").change(function() {
					                $("#periodo option:selected").each(function() { 
					                  	perio=$('#periodo').val();
					                  		            $("#dia").change(function() {
											                $("#dia option:selected").each(function() { 
											                  	dia=$('#dia').val();
					                  $.post("<?= base_url('/index.php/intranet/comprobarDoc')?>", {
						                        perio : perio , dia : dia
						                    }, function(data) {
						                        $("#salas").html(data);
						                    });		
					                });
					            });
                });
            });
        });

</script>
<?php 
$attributes = array('class' => 'form-horizontal', 'role' => 'form');
	foreach ($periodos as $peri){ 
						$maximo = strlen($peri->inicio);
						$inicio = substr(strrev($peri->inicio),3,$maximo);
						$termino = substr(strrev($peri->termino),3,$maximo);
						$inicio=strrev($inicio);
						$termino=strrev($termino);
    $atributosPeriodo[$peri->pk] = $peri->pk.'  -  '.$inicio.' - '.$termino;
    }
 ?>
<div class="well">
	<div class="row-fluid"><?= form_open('intranet/llenarReservaSemestre',$attributes);?> 
		<div class="span5">
				<div class="row-fluid">
					<div class="span12">
						<h4>Creación de Curso</h4>
					</div>
				</div>
				<div class="form-group">
				    <label  class="col-sm-3 control-label">Año</label>
				    <div class="col-sm-9">
					   	<select name="ano" class="form-control" id="ano">
					   		<option value="<?php echo $año-1; ?>"><?php echo $año-1; ?></option>
					   		<option selected value="<?php echo $año; ?>"><?php echo $año; ?></option>
					   	</select>
				    </div>
				</div>
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Semestre</label>
				    <div class="col-sm-9">
				      <select name="semestre" class="form-control" id="semestre"> <option value="1">1</option><option value="2">2</option></select>
				    </div>
				</div>
			    <div class="form-group">
			    	<label  class="col-sm-3 control-label" id="c">Facultad</label>
			    	<div class="col-sm-9">
						<select name="facultad" class="form-control" id="facultad" >
						<option value="">Selececione una Facultad</option>
							<?php 
							    foreach ($facultades as $facu) {
							 		echo'<option value='.$facu->pk.'>'.$facu->facultad.'</option>';
							    }
							 ?>
						</select>
			    	</div>
			  	</div>
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Sala</label>
				    <div class="col-sm-9">
				     	<select name="salas" class="form-control" id="salas"><option value="">Selecione una sala</option></select>
				    </div>
				</div>  
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Depto.</label>
				    <div class="col-sm-9">
				     	<select name="depa" class="form-control" id="depa"><option value="">Selecione un departamento</option></select>
				    </div>
				</div>
			  	<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Asignatura</label>
				    <div class="col-sm-9">
				      	<select name="asig" class="form-control" id="asig"><option value="">Selecione una asignatura</option></select>
				    </div>
				</div>
			  	<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Seccion</label>
				    <div class="col-sm-9">
			     	 	<input name="seccion" class="form-control" type="text" id="seccion">
				    </div>
				</div>
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Docente</label>
				    <div class="col-sm-9">
				      	<select name="docente" class="form-control" id="docente" >
						<option value="-1">Selececione un docente</option>
						<option value="">NN</option>
							<?php 
							    foreach ($academico as $doc) {
							 		echo'<option value='.$doc->pk.'>'.$doc->nombres.' '.$doc->apellidos.'</option>';
							    }
							?>
						</select>
				    </div>
				</div>  
		</div>
		<div class="span7">
			<div class="row-fluid">
				<div class="span12">
					<h4>Asignacion de Horario</h4>
				</div>
			</div>
					<div class="form-group">
					    <label  class="col-sm-2 control-label" id="">Se Repite</label>
					    <div class="col-sm-10">
				     		<select name="repite" class="form-control" id="repite">
				     			<option value="1">Un día</option>
				     			<option value="2">Lunes, Miércoles, Viernes</option>
				     			<option value="3">Martes, Jueves</option>
				     		</select>
				     	</div>
					</div>
				<div id="contenido1">	
					<div class="form-group">
					    <label  class="col-sm-2 control-label" id="c">Periodo</label>
					    <div class="col-sm-4"><!--algo php para las fechas del la semana-->
				     		<select name="dia" class="form-control" id="dia">
				     			<option value="1">Lunes</option>
				     			<option value="2">Martes</option>
				     			<option value="3">Miercoles</option>
				     			<option value="4">Jueves</option>
				     			<option value="5">Viernes</option>
				     			<option value="6">Sabado</option>
				     		</select>
					    </div>
					    <label  class="col-sm-2 control-label" id="c">Al</label> 
					 	<div class="col-sm-4">
					      <!--	<select name="periodo" class="form-control" id="periodo" >-->
								<?php 
								echo form_dropdown('periodo',$atributosPeriodo,'','class="form-control" id="periodo"')
								?>
							<!--</select>-->
					    </div>
					</div>
					<div class="form-group">
					    <label  class="col-sm-2 control-label" id="c">Desde</label>
					    <div class="col-sm-4"> 
				     	 	<input readonly="readonly" placeholder="Inicio" name="datepickerInicio" class="form-control"  id="datepicker">
					    </div>
					  	<div id="hasta" style="display:none;"><label  class="col-sm-2 control-label" id="c">Hasta</label>
					    <div class="col-sm-4">
				     	 	<input readonly="readonly" placeholder="Final" name="datepickerTermino" class="form-control" type="text" id="datepicker2">
					    </div></div>
					</div>
				</div>
				<div id="contenido2" style="display:none;">
					<div class="form-group">
					    <label class="col-sm-2 control-label">Para el</label>
					    <div class="col-sm-4">
					    	<p class="form-control-static" >Lunes</p>
					    </div>					
					    <label  class="col-sm-2 control-label" id="c">Periodo</label> 
					 	<div class="col-sm-4">
								<?php 
								echo form_dropdown('periodo1',$atributosPeriodo,'','class="form-control" id="periodo"')
								?>
					    </div>
					</div>
					<div class="form-group">
					   	<label class="col-sm-2 control-label">Para el</label>
					    <div class="col-sm-4">
					    	<p class="form-control-static" >Miércoles</p>
					    </div>
					    <label  class="col-sm-2 control-label" id="c">Periodo</label> 
					 	<div class="col-sm-4">
								<?php 
								echo form_dropdown('periodo2',$atributosPeriodo,'','class="form-control" id="periodo"')
								?>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">Para el</label>
					    <div class="col-sm-4">
					    	<p class="form-control-static" >Viernes</p>
					    </div>	
					    <label  class="col-sm-2 control-label" id="c">Periodo</label> 
					 	<div class="col-sm-4">
								<?php 
								echo form_dropdown('periodo3',$atributosPeriodo,'','class="form-control" id="periodo"')
								?>
					    </div>
				    
					</div>
					<div class="form-group">
					    <label  class="col-sm-2 control-label" id="c">Desde</label>
					    <div class="col-sm-4">
				     	 	<input readonly="readonly" placeholder="Inicio" name="datepickerInicio2" class="form-control"  id="datepickergr2">
					    </div>
					  	<label  class="col-sm-2 control-label" id="c">Hasta</label>
					    <div class="col-sm-4">
				     	 	<input readonly="readonly" placeholder="Final" name="datepickerTermino2" class="form-control" type="text" id="datepicker2gr2">
					    </div>
					</div>
				</div>
				<div id="contenido3" style="display:none;">
						<div class="form-group">
					    <label class="col-sm-2 control-label">Para el</label>
					    <div class="col-sm-4">
					    	<p class="form-control-static" >Martes</p>
					    </div>						
					    <label  class="col-sm-2 control-label" id="c">Periodo</label> 
					 	<div class="col-sm-4">
								<?php 
								echo form_dropdown('periodo4',$atributosPeriodo,'','class="form-control" id="periodo"')
								?>
					    </div>

					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Para el</label>
					    <div class="col-sm-4">
					    	<p class="form-control-static" >Jueves</p>
					    </div>
					    <label  class="col-sm-2 control-label" id="c">Periodo</label> 
					 	<div class="col-sm-4">
								<?php 
								echo form_dropdown('periodo5',$atributosPeriodo,'','class="form-control" id="periodo"')
								?>  
					    </div>

					</div>
					<div class="form-group">
					    <label  class="col-sm-2 control-label" id="c">Desde</label>
					    <div class="col-sm-4">
				     	 	<input readonly="readonly" placeholder="Inicio" name="datepickerInicio3" class="form-control"  id="datepickergr3">
					    </div>
					  	<label  class="col-sm-2 control-label" id="c">Hasta</label>
					    <div class="col-sm-4">
				     	 	<input readonly="readonly" placeholder="Final" name="datepickerTermino3" class="form-control" type="text" id="datepicker2gr3">
					    </div>
					</div>
				</div>
				</div>
					<?= form_submit("btnEnviar", "Enviar","class='btn btn-primary'");  ?>
					     		
		</div>
		<?php  echo form_close(); ?>
	</div>  
</div>	          
<script>
  


    $(document).ready(function() {
            $("#repite").change(function() {
                $("#repite option:selected").each(function() {
                  	var posicion=document.getElementById('repite').value; //posicion
					//alert(posicion);
					if(posicion==1){

						   $('#contenido1').show();
						   $('#contenido2').hide();
						   $('#contenido3').hide();
						   $('#hasta').hide();

					}
					if(posicion==2){
						 $('#contenido2').show();
						 $('#contenido1').hide();
						 $('#contenido3').hide();
					}
					if(posicion==3){
						 $('#contenido3').show();
						 $('#contenido1').hide();
						 $('#contenido2').hide();
					}
                  });
                });
            });

</script>
