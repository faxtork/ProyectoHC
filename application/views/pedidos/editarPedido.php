
<script type="text/javascript">
        $(document).ready(function() {
            $("#periodo").change(function() {
                $("#periodo option:selected").each(function() { 
                   periodo = $('#periodo').val();
                   datepicker=$('#datepicker').val();
                    $.post("<?= base_url('/index.php/pedidos/salaDisponible')?>", {
                        periodo : periodo ,datepicker : datepicker
                    }, function(data) {
                        $("#divSala").html(data);
                    });
                });
            });
        });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#docente").change(function() {
                $("#docente option:selected").each(function() { 
                   docente = $('#docente').val();
                    $.post("<?= base_url('/index.php/pedidos/getAsignaturasDocente')?>", {
                        docente : docente
                    }, function(data) {
                        $("#asignatura").html(data);
                    });
                });
            });
        });
        
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#asignatura").change(function() {
                $("#asignatura option:selected").each(function() { 
                   asignatura=$('#asignatura').val();
                   docente = $('#docente').val();
                  
                    $.post("<?= base_url('/index.php/pedidos/getSeccionDeAsignatura')?>", {
                        asignatura : asignatura , docente : docente
                    }, function(data) {
                        $("#seccion").html(data);
                    });
                });
            });
        });
        
</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jquery.ui.datepicker-es.js"></script>
<script type="text/javascript">

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
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };    
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({
minDate: "0D",
maxDate: "+1M, 5D"
});
});
</script>

<?php
function cortarPeri($ini){
    
                        $maximo = strlen($ini);
                        $inicio = substr(strrev($ini),3,$maximo);
                        $inicio=strrev($inicio);
                        return $inicio;
   
}

   $contenidoPeriodo=array($periodo=>$periodo,);
 foreach ($periodos as $peri) {
    $contenidoPeriodo[$peri->pk]=$peri->periodo." - ".cortarPeri($peri->inicio)." - ".cortarPeri($peri->termino);
  }
  $contenidoAsignatura=array($pkasignatura=>$nombreasignatura,);
 
  foreach ($asignaturas as $asig) {
    $contenidoAsignatura[$asig->pk]=$asig->nombre;
 }
 
 //$contenidoSeccion=array($seccion=>$seccion);

 foreach ($secciones as $secc) {
    $contenidoSeccion[$secc->seccion]=$secc->seccion;
}
   
 
?>

    
<div class="well">
<div class="row-fluid">
<div class="span12">
 <?=form_open(base_url('index.php/pedidos/updatePedido'))?>
                  <h4>Editar Pedido</h4><br>
    <?=  form_input(array('type'=>'hidden','name'=>'docente','id'=>'docente','value'=>$pkdocente))?>

                <div class="form-group">
                    <label  class="col-sm-4 control-label">N° Pedido:</label>
                    <div class="col-sm-5">
                        <?= form_input(array('class'=>'form-control','id'=>'pkPedido','name'=>'pkPedido','readonly'=>'readonly','value'=>$pkPedido));?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Asignatura:</label>
                    <div class="col-sm-5">
                        <?= form_dropdown('asignatura',$contenidoAsignatura,'',"id='asignatura' class='form-control'")?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Seccion:</label>
                    <div class="col-sm-5">
                        <?= form_dropdown('seccion',$contenidoSeccion,'',"id='seccion' class='form-control'")?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Fecha:</label>
                    <div class="col-sm-5">
                        <?= form_input(array('name'=>'fecha','value'=>$fecha),'',"id='datepicker' class='form-control'")?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Periodo:</label>
                    <div class="col-sm-5">
                        <?= form_dropdown('periodo',$contenidoPeriodo,'',"id='periodo' class='form-control'")?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Sala:</label>
                    <div class="col-sm-5">
                        <?= form_dropdown('sala',array($pksala=>$sala),'',"id='divSala' class='form-control'");?>
                    </div>
                </div><br> 
                <div class="form-group">
                    <div class="col-sm-12">
                    <?= form_submit('btnEditarPedido','Enviar',"class='btn btn-primary btn-lg'");?>
                    </div>
                </div>
<?php form_close();?>

     
    </div>
</div>
</div>