
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
            $("#datepicker").change(function() {$('#periodo option[selected]').prop('selected', true);});
        });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#asignatura").change(function() {  $('#seccion option[selected]').prop('selected', true);
                $("#asignatura option:selected").each(function() { 
                   asignatura=$('#asignatura').val();
                   docente = $('#docente').val();
                   if(asignatura==''){  $("#seccion").html('');var x = document.createElement("OPTION");
                     x.setAttribute("value", "");
                         var t = document.createTextNode("Seleccionar Seccion");
                        x.appendChild(t);
                        document.getElementById("seccion").appendChild(x)
                        }
                   else{
                          $.post("<?= base_url('/index.php/pedidos/getSeccionDeAsignatura')?>", {
                                asignatura : asignatura , docente : docente
                            }, function(data) {
                                if(data==false){$('#seccion option[selected]').prop('selected', true);
                                   
                                    }else $("#seccion").html(data);
                            });
                   }

                });
            });
        });
        
</script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
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
$atributos_Nombre=array('name'=>'nombre');
$atributos_Apellido=array('name'=>'Apellido');

    if (isset($nombreAsignatura)) {
        $atributos_OptionAsig=array(''=>'Seleccionar Asignatura',);
        $atributos_OptionSeccion=array(''=>'Seleccionar seccion',);
     //  $atributos_OptionAsig=array(''=>'->Seleccionar Asignatura',);

    }
    if (isset($periodos)) {
        $atributos_OptionPeriodo=array(''=>'Seleccione Periodo',);
       foreach($periodos as $peri) {
           
           $atributos_OptionPeriodo[$peri->periodo]=$peri->pk." - ".$peri->inicio." - ".$peri->termino;
      }
    }
 
    

    
    $atributos_OptionDia=array(
    ''=>'->Seleccione el Dia',
    'optDia1'=>'Lunes',
    'optDia2'=>'Martes',
    'optDia3'=>'Miércoles',
    'optDia4'=>'Jueves',
    'optDia5'=>'Viernes');
 

   $atributos_OptionSala=array();



?>
<div class="well">
    <?php 
    
    if (isset($docente)) {
        ?>
    <div class="row-fluid">
        <div class="span6">
            <h4>Docente</h4>
                    <form class='form-horizontal' role ='form'>
                        <div class="form-group">
                            <label  class="col-lg-6 control-label" id="c"><?= form_label('Nombre:');?></label>
                            <label  class="control-label" id="c"><?=  $docente->nombres;?></label>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-6 control-label" id="c"><?= form_label('Apellido:');?></label>                        
                            <label  class="control-label" id="c"><?=  $docente->apellidos;?></label>                           
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-6 control-label" id="c"><?= form_label('Rut:');?></label>
                            <label  class="control-label" id="c"><?=  $docente->rut;?></label>
                        </div>
                    </form>
                      <?php
                }
                ?>            
        </div>
        <?php  if(count($asignaturas)!=0){
            
            ?>
            <script>
            function validacion(){
                var asignatura = document.getElementById("asignatura").value;
                var seccion = document.getElementById("seccion").value;
                var datepicker = document.getElementById("datepicker").value;
                var periodo = document.getElementById("periodo").value;
                var divSala = document.getElementById("divSala").value;
                if(asignatura=='' || seccion=='' || datepicker=='' || periodo=='' || divSala==''){
                    alert("Favor Completar todos los Campos");
                    return false;
                }

            }
            </script>
        <div class="span6">
            <h4>Pedir Sala</h4>
            <?php $attributes = array('class' => 'form-horizontal', 'role' => 'form','onsubmit'=>'return validacion()'); 
                 echo form_open('pedidos/guardarPedidoSala',$attributes); 
                 echo form_input(array('name'=>'docente','type'=>'hidden','id'=>'docente','value'=>$docente->pk));?>
                <div class="form-group">
                    <label  class="col-lg-6 control-label" id="c">Asignatura: </label>
                    <div class="col-lg-6"> 
                        <select name="asignatura" class="form-control" id="asignatura">
                        <option value="">Seleccionar Asignatura</option>
                            <?php 

                            foreach ($asignaturas as $key) {
                                echo'<option value='.$key->pk.'>'.$key->nombre.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-6 control-label" id="c">Seccion: </label>
                    <div class="col-lg-6"> 
                        <select name="seccion" class="form-control" id="seccion">
                            <option selected="selected" value="">Seleccionar Seccion</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-6 control-label" id="c">Fecha: </label>
                    <div class="col-lg-6"> 
                        <input readonly="readonly" class="form-control"  required  type="text" id="datepicker" placeholder="Seleccione Fecha" name="datepicker" />
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-6 control-label" id="c">Periodo: </label>
                    <div class="col-lg-6"> 
                            <?php 
                                echo form_dropdown('periodo',$atributos_OptionPeriodo,'','class="form-control" id="periodo"');
                             ?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-6 control-label" id="c">Sala apriori: </label>
                    <div class="col-lg-6"> 
                        <select class="form-control" id="divSala" name="sala">
                        <option>Seleccione la sala</option>
                        </select> 
                    </div>
                </div>
            <button type="submit" class="btn btn-primary btn-lg">Enviar <span class="icon-ok icon-white"></span></button>     
            <?php echo form_close(); ?>
        </div>
        <?php }else echo'<script>alert("Aun no tienes Asignaturas Asignadas.")</script>'; ?>
    </div>    
   
  
</div>