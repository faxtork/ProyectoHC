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
minDate: "-1year",
maxDate: "-1D",
	onClose: function (selectedDate) {
	$("#datepicker2").datepicker("option", "minDate", selectedDate);
	}
});
$('#datepicker2').datepicker({
beforeShowDay: noExcursion,
minDate: "0D",
maxDate: "-1D",
	onClose: function (selectedDate) {
	$("#datepicker").datepicker("option", "maxDate", selectedDate);
	}
});
});
</script>
<script>
function validacion(){
	var datepickerIni = document.getElementById("datepicker").value;
 	var datepickerTer = document.getElementById("datepicker2").value;
 	if(datepickerIni=="" || datepickerTer==""){
 		alert("Favor seleccionar una fecha de entrada.");
 		return false;
 	}
}
</script>
<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form','onsubmit'=>'return validacion()');  ?>
<div class="span9">
	<div class="well">
		<div class="row-fluid"><div class="span12"><h3>Unidad de Reportes</h3></div></div>

	<br><br>
	<h4>Elija un rango de fecha para generar su reporte</h4><br>
		<?= form_open('intranet/descargaReporte',$attributes);?> 
				<div class="form-group">
				    <label  class="col-sm-2 control-label" id="c">Desde</label>
				    <div class="col-sm-4"> 
			     	 	<input readonly="readonly" placeholder="Inicio" name="datepickerInicio" class="form-control"  id="datepicker" >
				    </div>
				  	<label  class="col-sm-2 control-label" id="c">Hasta</label>
				    <div class="col-sm-4">
			     	 	<input readonly="readonly" placeholder="Final" name="datepickerTermino" class="form-control" type="text" id="datepicker2" >
				    </div>
				</div> <br>
					<button class="btn btn-primary" type="submit" value="Enviar" name="btnEnviar">Enviar y Descargar <span class="icon-ok icon-white"></span></button>
		<?= form_close();?>	
	</div>
</div>
