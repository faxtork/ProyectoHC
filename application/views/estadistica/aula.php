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
        yearSuffix: ''
    };    
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({
minDate: "-12M, 0D",
maxDate: "0D"
});
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
                     			 $("#doc").html("Selecciona otra facultad o Agrega uno nuevo Seleccionando una facultad.");
                     		}
                    });
                });
            });
        });
</script>
    <script type="text/javascript">
        $(document).ready(function() {
        	document.getElementById('dia').style.display='none'
        	document.getElementById('mes').style.display='none'
        	document.getElementById('anio').style.display='none'


            $("#query").change(function() {
                $("#query option:selected").each(function() { 
                   query=$('#query').val();
                   switch(query) {
						    case "1":
						            document.getElementById('dia').style.display='block'
			                   	document.getElementById('mes').style.display='none'
			        					document.getElementById('anio').style.display='none'
						        break;
						    case "2":
		                   		document.getElementById('mes').style.display='block'//ver=block
		                   		document.getElementById('dia').style.display='none'//ocultar=none
	        							document.getElementById('anio').style.display='none'
						        break;
						    case "3":
						    		break;
						    case "4":
						    			document.getElementById('anio').style.display='block'
			                   	document.getElementById('dia').style.display='none'
			        					document.getElementById('mes').style.display='none'
						    		break;		    
					
						}  
                   	

                });
            });
        });
</script>
		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Estadisticas varias para Salas UTEM</h3></div></div>
			<div class="row-fluid">
				<div class="span12">
					<p>Seleccione un tipo de consulta para desplegar la información</p>
					<form class='form-horizontal' role='form'>
							<div class="form-group">
						    	<label  class="col-sm-3 control-label" id="c">Tipo Consulta</label>
						    	<div class="col-sm-8">
									<select name="query" class="form-control" id="query" >
									<option value="">Elejir Consulta</option>
									<option value="1">Día</option>
									<option value="2">Mes</option>
									<option value="3">Semestre</option>
									<option value="4">Año</option>
									</select>
						    	</div>
							</div>
							<div id="dia">
								<div class="form-group">
									<label  class="col-sm-3 control-label" id="c">Selecione un Día: </label>
									<div class="col-sm-4">
	                     			   <input readonly="readonly" class="form-control"  required  type="text" id="datepicker" placeholder="Seleccione Fecha" name="datepicker" />
									</div>
								</div>							
							</div>
							<div id="mes">
								<div class="form-group">
									<label  class="col-sm-3 control-label" id="c">Selecione un Mes: </label>
									<div class="col-sm-4">
										<select name="" class="form-control" id="">
											<?php //ver el tema de si elije un mes futuro tomarlo ocmo pasado o preguntar por año
											for ($i=1; $i <=12 ; $i++) { 
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
											 ?>
										</select>
									</div>
								</div>							
							</div>
							<div id="anio">
								<div class="form-group">
									<label  class="col-sm-3 control-label" id="c">Selecione un Año: </label>
									<div class="col-sm-4">
										<select name="" class="form-control" id="">
											<?php     date_default_timezone_set("America/Santiago");
    													$año = date('Y');
											for ($i=$año; $i >=($año-10) ; $i--) { 
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
											 ?>
										</select>
									</div>
								</div>							
							</div>
					</form>		
				</div>
			</div><br>
		</div>
	</div>
</div></div>

