
<script type="text/javascript">
        $(document).ready(function() {
           
                   periodo = $('#periodo').val();
                   datepicker=$('#datepicker').val();
                   aulafk=$('#aulafk').val();
                    $.post("<?= base_url('/index.php/intranet/getSala2')?>", {
                        periodo : periodo , datepicker : datepicker , aulafk : aulafk
                    }, function(data) {
                        $("#divSala").html(data);
                    });
               
            
        });
</script>
<input type="hidden" name="aulafk" id="aulafk" value="<?php echo $solicitudReserva->sala_fk; ?>">
<script type="text/javascript">
        $(document).ready(function() {
            $("#periodo").change(function() {
                $("#periodo option:selected").each(function() { 
                   periodo = $('#periodo').val();
                   datepicker=$('#datepicker').val();
                    $.post("<?= base_url('/index.php/intranet/getSala')?>", {
                        periodo : periodo , datepicker : datepicker
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
                    $.post("<?= base_url('/index.php/intranet/getAsignaturasDocente')?>", {
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
                  
                    $.post("<?= base_url('/index.php/intranet/getSeccionDeAsignatura')?>", {
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
        dateFormat: 'yy-mm-dd', 
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

  $contenidoPeriodo[$periodoPk]=$solicitudReserva->periodo; 
 foreach ($periodos as $peri) {
                        $maximo = strlen($peri->inicio);
                        $inicio = substr(strrev($peri->inicio),3,$maximo);
                        $termino = substr(strrev($peri->termino),3,$maximo);
                        $inicio=strrev($inicio);
                        $termino=strrev($termino);
    $contenidoPeriodo[$peri->pk] = $peri->pk.'  -  '.$inicio.' - '.$termino;

  }
  

  $contenidoAsignatura[$asig[0]->pk]=$asig[0]->nombre;  
    foreach ($ramos as $ram) {
    $contenidoAsignatura[$ram->pk]=$ram->codigo.' '.$ram->nombre;  
  }

  $contenidoDocentes[$docente->pk]=$docente->nombres." ".$docente->apellidos;
  //$contenidoDocentes=array($pkdocente=>$nombredocente." ".$apellidodocente);
  foreach ($academicos as $acade) {
    $contenidoDocentes[$acade->pk]=$acade->nombres." ".$acade->apellidos;  
  }
  //$contenidoSala=
  $attributes = array('class' => 'form-horizontal', 'role' => 'form'); 

?>

    
<div class="row-fluid">
    <div class="span12 well">
         <?=form_open('intranet/editarReservaFinal',$attributes)?> 
                        <input type="hidden" name="semestre" value="<?php echo $semestre;?>">    
                          <input type="hidden" name="anio" value="<?php echo $anio;?>"> 
                <h4>Editar Reserva</h4><br>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">N° Pedido:</label>
                    <div class="col-sm-5">
                        <?= form_input(array('class'=>'form-control','name'=>'pkPedido','readonly'=>'readonly','value'=>$solicitudReserva->pk));?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Docente:</label>
                    <div class="col-sm-5">
                        <?=form_dropdown('docente',$contenidoDocentes,'','class="form-control" id="docente"')?>
                    </div>
                </div>      
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Asignatura:</label>
                    <div class="col-sm-5">
                       <?=form_dropdown('asignatura',$contenidoAsignatura,'','class="form-control" id="asignatura"')?>
                    </div>
                </div>
               <div class="form-group">
                    <label  class="col-sm-4 control-label">Seccion:</label>
                    <div class="col-sm-5">
                        <?= form_input(array('class'=>'form-control','name'=>'seccion','id'=>'seccion','value'=>$seccion));?>
                    </div>
                </div>
               <div class="form-group">
                    <label  class="col-sm-4 control-label">Fecha:</label>
                    <div class="col-sm-5">
                        <?= form_input(array('class'=>'form-control','name'=>'datepicker','id'=>'datepicker','value'=>$fecha));?>
                    </div>
                </div>
               <div class="form-group">
                    <label  class="col-sm-4 control-label">Periodo:</label>
                    <div class="col-sm-5">
                       <?=form_dropdown('periodo',$contenidoPeriodo,'','class="form-control" id="periodo"')?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Sala:</label>
                    <div class="col-sm-5">
                     <?//=form_dropdown('sala','','','class="form-control" id="divSala"')?>
                     <select name="sala" id="divSala" class="form-control">
                         <option selected value="<?php echo $salaPk;?>"><?php echo $sala;?></option>
                     </select>
                </div>
                <div class="form-group">
                    <div class="col-sm-12"><br>
                        <button class="btn btn-primary" type="submit" value="Enviar" name="btnEditarPedido">Enviar <span class="icon-ok icon-white"></span></button>
                    </div>
                </div>
         <?php form_close();?>
    </div>
</div>
<!--
<div class="well">
  
 <?=form_open('intranet/editarReservaFinal')?>
  
    <h4>Editar Reserva</h4><br>
        <div class="form-group">
            <label  class="col-sm-3 control-label">N° Pedido :</label>
            <div class="col-sm-9">
                <?= form_input(array('name'=>'pkPedido','readonly'=>'readonly','value'=>$pkPedido,'class'=>'form-control'))?>
            </div>
        </div>
     <div class="row">
        <div class="span2">N° Pedido :</div>
        <div class="span3"><?= form_input(array('name'=>'pkPedido','readonly'=>'readonly','value'=>$pkPedido))?></div>
    </div>   
    <div class="row">
         <div class="span2">Docente:</div> <div class="span3"><?=form_dropdown('docente',$contenidoDocentes,'',"id='docente'")?></div>
        </div>
        <div class="row">
            <div class="span2">Asignatura:</div> <div class="span3" ><?=form_dropdown('asignatura',$contenidoAsignatura,'',"id='asignatura'")?>
        </div>
            
        </div>
    <div class="row">
            <div class="span2">Seccion:</div> <div class="span3" id=""><?=form_dropdown('seccion',$contenidoSeccion,'',"id='seccion'")?>
        </div>
            
        </div>
        
        <div class="row">
            <div class="span2">Fecha:</div><div class="span3"><?= form_input(array('name'=>'datepicker','id'=>'datepicker','value'=>$fecha));?></div>
        </div>
        <div class="row">
        <div class="span2">Periodo:</div><div class="span3"><?=form_dropdown('periodo',$contenidoPeriodo,'',"id='periodo'")?></div>
        </div>
        
        <div class="row">
        <div class="span2">Sala :</div> <div class="span3"><?=form_dropdown('sala',array($pksala=>$sala),'',"id='divSala'")?></div>
        </div>
    
    <div class="row">
        <div class="span2"><?= form_submit('btnEditarPedido','Enviar',"class='btn'");?></div>
        
    </div>
     <?php form_close();?>
    
</div>
-->