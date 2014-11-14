
<input type="hidden" name="aulafk" id="aulafk" value="<?php echo $solicitudReserva->sala_fk; ?>">
<input type="hidden" name="aula" id="aula" value="<?php echo $solicitudReserva->sala; ?>">
<script type="text/javascript">
        $(document).ready(function() {
            $("#periodo").change(function() {
                $("#periodo option:selected").each(function() { 
                   periodo = $('#periodo').val();
                   datepicker=$('#datepicker').val();
                   aulafk=$('#aulafk').val();
                   aula=$('#aula').val();

                    $.post("<?= base_url('/index.php/intranet/getSala')?>", {
                        periodo : periodo , datepicker : datepicker, aulafk:aulafk
                    }, function(data) {
                        data='<option value='+aulafk+'>'+aula+'</option>'+data;
                        $("#divSala").html(data);
                    });
                });
            });
            $("#datepicker").change(function() {
            $('#periodo option[selected]').prop('selected', true);

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
    $contenidoSala[$solicitudReserva->sala_fk]=$solicitudReserva->sala;
        foreach ($salasDisponibles as $aula) {
            $contenidoSala[$aula->pk]=$aula->sala;
          }
  $contenidoAsignatura[$asig[0]->pk]=$asig[0]->nombre;  
    foreach ($ramos as $ram) {
    $contenidoAsignatura[$ram->pk]=$ram->codigo.' '.$ram->nombre;  
  }

  $contenidoDocentes[$docente->pk]=$docente->nombres." ".$docente->apellidos;//del que viene atras de la pag
  //$contenidoDocentes=array($pkdocente=>$nombredocente." ".$apellidodocente);
  foreach ($academicos as $acade) {//los demas docentes
    $contenidoDocentes[$acade->pk]=$acade->nombres." ".$acade->apellidos;  
  }

  $attributes = array('id'=>'form1','class' => 'form-horizontal', 'role' => 'form','onsubmit'=>'return validaciones()'); 

?>

 <script>
function validaciones(){
    var seccion = document.getElementById("seccion").value;
    if(seccion==""){
            alert("Favor Rellene con una Seccion");
            return false;
    }else{
    if(window.comp==0)return false;
    else return true
    }
 
}
 </script>

 
 <script>
 $(document).ready(function() {
                                    window.comp=1;

            $("#form1").change(function() {
   var pkPedido = document.getElementById("pkPedido").value;
    var seccion = document.getElementById("seccion").value;
    var datepicker = document.getElementById("datepicker").value;
    var periodo = document.getElementById("periodo").value;
    var divSala = document.getElementById("divSala").value;
                        $.ajax({
                          type: "POST",
                          url: "<?= base_url('/index.php/intranet/comprobarEditReserva')?>",
                          data: {pkPedido : pkPedido,datepicker:datepicker,periodo:periodo,divSala:divSala},
                          cache: false,
                          success: function(data)
                          {
                                  if(data==0)
                                  { 
                                   alert("Estos datos ya se encuentran con este N° Pedido");
                                       window.comp=0;//false
                                  }else {
                                    window.comp=1;
                                  }
                          }
                          });
            });
        });
 </script>
<div class="row-fluid">
    <div class="span12 well">
         <?php echo form_open('intranet/editarReservaFinal',$attributes);?> 
                        <input type="hidden" name="semestre" value="<?php echo $semestre;?>">    
                          <input type="hidden" name="anio" value="<?php echo $anio;?>"> 
                          <input type="hidden" id="cursofk" value="<?php echo $solicitudReserva->curso_fk;?>"> 

                <h4>Editar Reserva</h4><br>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">N° Pedido:</label>
                    <div class="col-sm-5">
                        <?= form_input(array('class'=>'form-control','id'=>'pkPedido','name'=>'pkPedido','readonly'=>'readonly','value'=>$solicitudReserva->pk));?>
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
                        <?= form_input(array('class'=>'form-control','name'=>'datepicker','readonly'=>'readonly','id'=>'datepicker','value'=>$fecha));?>
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
                     <? //= form_dropdown('sala',$contenidoSala,'','class="form-control" id="divSala"')?>
                       <?=form_dropdown('sala',$contenidoSala,'','class="form-control" id="divSala"')?>
                </div>
                <div class="form-group">
                    <div class="col-sm-12"><br>
                        <button class="btn btn-primary" type="submit" value="Enviar" name="btnEditarPedido">Enviar <span class="icon-ok icon-white"></span></button>
                    </div>
                </div>
         <?php echo form_close();?>
    </div>
</div>