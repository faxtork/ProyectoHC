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


/*
							                  $.post("<?= base_url('/index.php/intranet/comprobarDoc')?>", {
								                        dia : dia 
								                    }, function(data) {
								                        $("#comp").html(data);
								                    });*/



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
<style>
	#c{
		text-align:right;
	}
</style>
<?php 
$attributes = array('class' => 'form-horizontal', 'role' => 'form');
 ?>



<div class="well">
	<div class="row-fluid">
		<div class="span12">
			<h1>Semestre Academico</h1>
			<!--<input type="text" id="comp">
			<select name="comp" class="form-control" id="comp"><option value="">Selecione una salaa</option></select>-->

		</div>
	</div>
	<div class="row-fluid"><?= form_open('intranet/llenarReservaSemestre',$attributes);?> 
		<div class="span5">
				<div class="row-fluid">
					<div class="span12">
						<h4>Datos para Curso</h4>
					</div>
				</div>
				<div class="form-group">
				    <label  class="col-sm-3 control-label" id="c">Año</label>
				    <div class="col-sm-9">
				      <p class="form-control-static" ><?php echo $año; ?></p>
				      <input type="hidden" id="ano" name="ano" value="<?php echo $año; ?>">
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
					<h4>Reservas</h4><br><br>
				</div>
			</div>
		
					<div class="form-group">
					    <label  class="col-sm-2 control-label" id="c">Periodo</label>
					    <div class="col-sm-4"><!--algo php para las fechas del la semana-->
				     		<select name="dia" class="form-control" id="dia">
				     			<option value="">Todos los:</option>
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
					      	<select name="periodo" class="form-control" id="periodo" >
							<option value="-1">Selececione un periodo</option>
								<?php 
								    foreach ($periodos as $peri) {
								 		echo'<option value='.$peri->pk.'>'.$peri->pk.'- '.$peri->inicio.' - '.$peri->termino.'</option>';
								    }
								?>
							</select>
					    </div>
					</div>
					<div id="gr"></div>

					<div class="form-group">
					    <label  class="col-sm-2 control-label" id="c">Desde</label>
					    <div class="col-sm-4">
				     	 	<input readonly="readonly" placeholder="Inicio" name="datepickerInicio" class="form-control"  id="datepicker">
					    </div>
					  	<label  class="col-sm-2 control-label" id="c">Hasta</label>
					    <div class="col-sm-4">
				     	 	<input readonly="readonly" placeholder="Final" name="datepickerTermino" class="form-control" type="text" id="datepicker2">
					    </div>
					</div>
					<?= form_submit("btnEnviar", "Enviar","class='btn btn-primary'");  ?>
					     
	<a name="agregarModificacion" type="submit" id="generar" class="btn btn-success" onclick="agregarHijo()"><i class="icon-plus"></i></a>
	<a name="agregarModificacion" type="submit" class="btn btn-success" onclick="quitarHijo()"><i class="icon-minus"></i></a>
			
		</div>
		<?php  echo form_close(); ?>
	</div>  
</div>
					          

<script>
	var gr=1;
	var subgr=0;
function agregarHijo() 
{
 
  subgr++;
  if(gr<=2){
 gr++;
  	var nuevoDiv =document.createElement('div');
    var nuevoLabel = document.createElement('label');
    var nuevoDiv2 = document.createElement('div');
    var nuevohijo = document.createElement('input');
    var nuevoLabel2 = document.createElement('label');
    var nuevoDiv3 = document.createElement('div');
    var nuevohijo2 = document.createElement('textarea');
    var select = document.createElement('select');
    var select2 = document.createElement('select');

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

      select.type='select';
      select.setAttribute('name','dia');
      select.setAttribute('class','form-control');
      select.setAttribute('id','dia');subgr++;
      document.getElementById('subgr'+subgr).appendChild(select);subgr--;

      nuevoLabel2.type='label';
 	  nuevoLabel2.innerHTML='Al';
 	  nuevoLabel2.setAttribute('class','col-sm-2 control-label');
      document.getElementById('gr'+gr).appendChild(nuevoLabel2);

      nuevoDiv3.type='div';
      nuevoDiv3.setAttribute('class','col-sm-4');subgr++;subgr++;
      nuevoDiv3.setAttribute('id','subgr'+subgr);subgr--;subgr--;
      document.getElementById('gr'+gr).appendChild(nuevoDiv3);

      select2.setAttribute('name','periodo');
      select2.setAttribute('class','form-control');
      select2.setAttribute('id','periodo');subgr++;subgr++;
      document.getElementById('subgr'+subgr).appendChild(select2);

     }
}
function quitarHijo(){
		if(gr<=3){
			var o = document.getElementById('gr'+gr);
			o.parentNode.removeChild(o); 
			gr--;
		}
}
</script>