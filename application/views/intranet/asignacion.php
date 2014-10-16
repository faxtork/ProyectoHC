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
minDate: "0D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepicker2").datepicker("option", "minDate", selectedDate);
	}
});
$('#datepicker2').datepicker({
beforeShowDay: noExcursion,
minDate: "0D",
maxDate: "+7M, 6D",
	onClose: function (selectedDate) {
	$("#datepicker").datepicker("option", "maxDate", selectedDate);
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
                   ano=$('#ano').val();
                   semestre=$('#semestre').val();
                   dia1=$('#dia1').val();
                   dia2=$('#dia2').val();
                   dia3=$('#dia3').val();
                   dia4=$('#dia4').val();
                   dia5=$('#dia5').val();
                   var diaArray=[dia1,dia2,dia3,,dia4,dia5];


                   perio1=$('#periodo1').val();
                   perio2=$('#periodo2').val();
                   perio3=$('#periodo3').val();
                   perio4=$('#periodo4').val();
                   perio5=$('#periodo5').val();
                   var perioArray=[perio1,perio2,perio3,perio4,perio5];

                   var datepickerInicio= document.getElementById('datepicker').value;
                   var datepickerTermino= document.getElementById('datepicker2').value;
                  $.post("<?= base_url('/index.php/intranet/llena_salas')?>", {
                        semestre : semestre, ano : ano, facultad : facultad, perioArray : perioArray, datepickerInicio : datepickerInicio, datepickerTermino:datepickerTermino, diaArray:diaArray
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
	               $.post("<?= base_url('/index.php/intranet/llena_doc')?>", {
	                    semestre : semestre, ano : ano, facultad : facultad, perioArray : perioArray, datepickerInicio : datepickerInicio, datepickerTermino:datepickerTermino, diaArray:diaArray

	                    }, function(data) {
	                        $("#docente").html(data);
	                    });    	
                });
            });
        });
</script>
<script>
$(document).ready(function() {
    $("#dia1").change(function() {$.reset();});
    $("#periodo1").change(function() {$.reset();});
    $("#datepicker").change(function() {$.reset();});
    $("#datepicker2").change(function() {$.reset();});
    $("#ano").change(function() {$.reset();});
    $("#semestre").change(function() {$.reset();});
});
$.reset=function(){
	    $('#facultad option[selected]').prop('selected', true);
    	$('#depa option[selected]').prop('selected', true);
    	$('#asig option[selected]').prop('selected', true);
    	$('#salas option[selected]').prop('selected', true);
}    
 </script>
<?php 
$attributes = array('class' => 'form-horizontal', 'role' => 'form','onsubmit'=>'return validacion()'); 
	foreach ($periodos as $peri){ 
						$maximo = strlen($peri->inicio);
						$inicio = substr(strrev($peri->inicio),3,$maximo);
						$termino = substr(strrev($peri->termino),3,$maximo);
						$inicio=strrev($inicio);
						$termino=strrev($termino);
    $atributosPeriodo[$peri->pk] = $peri->pk.'  -  '.$inicio.' - '.$termino;
    }
 ?>
 <script>
 function validacion(){
 	var facu = document.getElementById("facultad").value;
 	var sala = document.getElementById("salas").value;
 	var depa = document.getElementById("depa").value;
 	var asig = document.getElementById("asig").value;
 	var seccion = document.getElementById("seccion").value;
 	var docente = document.getElementById("docente").value;
 	var datepickerIni = document.getElementById("datepicker").value;
 	var datepickerTer = document.getElementById("datepicker2").value;
	if(facu=="" || sala=="" || depa=="" || asig=="" || docente=="" || seccion=="" || datepickerIni=="" || datepickerTer=="" ){
			alert("Favor Rellenar todos los Campos");
			return false;
	}


 }
 </script>
<div class="well">
	<div class="row-fluid"><?= form_open('intranet/llenarReservaSemestre',$attributes);?> 
		<div class="span7">
			<div class="row-fluid">
				<div class="span12">
					<h4>Asignacion de Horario semanal</h4>
				</div>
			</div>
				<div class="form-group">
				    <label  class="col-sm-2 control-label" id="c">Periodo</label>
				    <div class="col-sm-4"><!--algo php para las fechas del la semana-->
			     		<select name="dia1" class="form-control" id="dia1"><!--onChange="this.form.facultad.selectedIndex=0;"-->
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
							echo form_dropdown('periodo1',$atributosPeriodo,'','class="form-control" id="periodo1"')
							?>
						<!--</select>-->
				    </div>
				</div>
				<div  id="gr"></div>
				<div class="form-group">
				    <label  class="col-sm-2 control-label" id="c">Desde</label>
				    <div class="col-sm-4"> 
			     	 	<input readonly="readonly" placeholder="Inicio" name="datepickerInicio" class="form-control"  id="datepicker" >
				    </div>
				  	<label  class="col-sm-2 control-label" id="c">Hasta</label>
				    <div class="col-sm-4">
			     	 	<input readonly="readonly" placeholder="Final" name="datepickerTermino" class="form-control" type="text" id="datepicker2" >
				    </div>
				</div>
					<a type="submit" name="agregarModificacion" value="Agregar" class="btn btn-success" onclick="agregarHijo()"><i class="icon-chevron-down"></i></a>
					<a name="agregarModificacion" type="submit" class="btn btn-success" onclick="quitarHijo()"><i class="icon-chevron-up"></i></a>
		</div>
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
				      <select name="semestre" class="form-control" id="semestre"> <option value="1">1</option><option value="2">2</option><option value="3">3</option></select>
				    </div>
				</div>
			    <div class="form-group">
			    	<label  class="col-sm-3 control-label" id="c">Facultad</label>
			    	<div class="col-sm-9">
						<select name="facultad" class="form-control" id="facultad" >
						<option value="" selected="selected">Selececione una Facultad</option>
							<?php 
							    foreach ($facultades as $facu) {
							    	
							    	if($facu->campus_fk!=$_SESSION['campus']){
							    		echo'<option disabled value='.$facu->pk.'>'.$facu->facultad.'</option>';
							    	}else{
							    		echo'<option value='.$facu->pk.'>'.$facu->facultad.'</option>';
							    	}
							    }
							 ?>
						</select>
			    	</div>
			  	</div>
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Depto.</label>
				    <div class="col-sm-9">
				     	<select name="depa" class="form-control" id="depa"><option selected="selected" value="">Selecione un departamento</option></select>
				    </div>
				</div>
			  	<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Asignatura</label>
				    <div class="col-sm-9">
				      	<select name="asig" class="form-control" id="asig"><option selected="selected" value="">Selecione una asignatura</option></select>
				    </div>
				</div>

			  	<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Seccion</label>
				    <div class="col-sm-9">
			     	 	<input name="seccion" class="form-control" type="text" id="seccion" >
				    </div>
				</div>
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Sala</label>
				    <div class="col-sm-9">
				     	<select name="salas" class="form-control" id="salas"><option selected="selected" value="">Selecione una sala</option></select>
				    </div>
				</div>  
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Docente</label>
				    <div class="col-sm-9">
				      	<select name="docente" class="form-control" id="docente" >
						<option value="" selected="selected">Selececione un docente</option>
							<?php 
							    foreach ($academico as $doc) {
							 		//echo'<option value='.$doc->pk.'>'.$doc->nombres.' '.$doc->apellidos.'</option>';
							    }
							?>
						</select>
				    </div>
				</div>  
		</div>
					
					<button class="btn btn-primary" type="submit" value="Enviar" name="btnEnviar">Enviar <span class="icon-ok icon-white"></span></button>
					<input type="hidden" value="1" id="cantidadPer" name="cantidadPer">
					     		
		</div>
		<?php  echo form_close(); ?>

	</div>  
</div>	          

<script>
var gr=1;
var subgr=0;
function agregarHijo()
{ $.reset();
subgr++;

	 if(gr<=4){
	 	gr++;
	 	document.getElementById("cantidadPer").value = gr;
		var nuevoDiv =document.createElement('div');
		var nuevoLabel = document.createElement('label');
		var nuevoDiv2 = document.createElement('div');
		var nuevohijo = document.createElement('select');
		var nuevoLabel2 = document.createElement('label');
		var nuevoDiv3 = document.createElement('div');
		var nuevohijo2 = document.createElement('select');

		nuevoDiv.type='div';
		nuevoDiv.setAttribute('class','form-group');
		nuevoDiv.setAttribute('id','gr'+gr);
		document.getElementById('gr').appendChild(nuevoDiv);

		nuevoLabel.type='label';
		nuevoLabel.innerHTML='Periodo';
		nuevoLabel.setAttribute('class','col-sm-2 control-label');
		document.getElementById('gr'+gr).appendChild(nuevoLabel);

		nuevoDiv2.type='div';
		nuevoDiv2.setAttribute('class','col-sm-4');subgr++;
		nuevoDiv2.setAttribute('id','subgr'+subgr); subgr--;
		document.getElementById('gr'+gr).appendChild(nuevoDiv2);

		nuevohijo.type = 'select';
		nuevohijo.setAttribute('class', 'form-control');
		nuevohijo.name = 'dia'+gr;
		nuevohijo.id = 'dia'+gr;subgr++;
		document.getElementById('subgr'+subgr).appendChild(nuevohijo);subgr--;

		nuevoLabel2.type='label';
		nuevoLabel2.innerHTML='Al';
		nuevoLabel2.setAttribute('class','col-sm-2 control-label');
		document.getElementById('gr'+gr).appendChild(nuevoLabel2);

		nuevoDiv3.type='div';
		nuevoDiv3.setAttribute('class','col-sm-4');subgr++;subgr++;
		nuevoDiv3.setAttribute('id','subgr'+subgr);subgr--;subgr--;
		document.getElementById('gr'+gr).appendChild(nuevoDiv3);

		nuevohijo2.type = 'select';
		nuevohijo2.setAttribute('class', 'form-control');
		nuevohijo2.name = 'periodo'+gr;
		nuevohijo2.id = 'periodo'+gr;subgr++;subgr++;
		document.getElementById('subgr'+subgr).appendChild(nuevohijo2);

		//-----------------agrega datos a los combos	
		var semana=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
		var sel = document.getElementById("dia"+gr);
		for (var i = 0; i < 6; i++) {
			option = document.createElement("OPTION");
		    option.value = (i+1);
		    option.text = semana[i];
		    sel.add(option);
		};
		var sel2 = document.getElementById("periodo"+gr);
		 var arrayJS=<?php echo json_encode($atributosPeriodo);?>; 
		 for (var i = 1; i <=<?php echo count($atributosPeriodo);?>; i++){
		   	option2 = document.createElement("option");
		    option2.value = i;
		   	option2.text = arrayJS[i];
		    sel2.add(option2);		    		    		    		    		    		    
		   };
	}
}
function quitarHijo(){$.reset();
		if(gr<=5){
			var o = document.getElementById('gr'+gr);
			o.parentNode.removeChild(o); 
			gr--;
			document.getElementById("cantidadPer").value = gr;
		}
}
</script>
