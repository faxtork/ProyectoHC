<div class="well">
    <div class="row-fluid"><div class="span3"></div><div class="span9"><h3>Esta es la lista Periodos actualmente para la UTEM</h3></div></div>
    <div class="row-fluid">
        <div class="span3">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="<?= site_url('intranet/editFacultades');?>">Facultades</a></li>
                <li ><a href="<?= site_url('intranet/editSalas');?>">Salas</a></li>
                <li><a href="<?= site_url('intranet/editDepartamentos');?>">Departamentos</a></li>
                <li><a href="<?= site_url('intranet/editEscuelas');?>">Escuelas</a></li>
                <li><a href="<?= site_url('intranet/editAsignaturas');?>">Asignaturas</a></li>
                <li><a href="<?= site_url('intranet/editDocnetes');?>">Docentes</a></li>
                <li class="active"><a href="<?= site_url('intranet/editPeriodos');?>">Periodos</a></li>
            </ul>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="span6">
                    <form action="" role="form">
                    <?php
                    foreach ($periodos as $peri) {
                                                $maximo = strlen($peri->inicio);
                        $inicio = substr(strrev($peri->inicio),3,$maximo);
                        $termino = substr(strrev($peri->termino),3,$maximo);
                        $inicio=strrev($inicio);
                        $termino=strrev($termino);
                            echo '<br /><br />';
                            echo'<div class="form-group" >
                                        <label  class="col-sm-2 control-label" id="c">'.$peri->pk.'</label>
                                                    <div class="col-sm-5" id="">
                                                        <input readonly="readonly" id="uno'.($peri->pk-1).'" type="text" class="form-control" value="'.$inicio.'">
                                                    </div>
                                                    <div class="col-sm-5" id="">
                                                      <input readonly="readonly" id="dos'.($peri->pk-1).'" type="text" class="form-control" value="'.$termino.'">
                                                    </div>
                                               </div>';
                    } 
                     ?>
                     <?php echo "<br/><br/>";echo form_submit("btnEnviar", "Enviar","class='btn btn-primary'");  ?>

                     </form>
                </div>
                <div class="span6">
                    <h3>Desfasar</h3>
                        <input type="text" id="desfase" value="5" placeholder="ingrese desfase en minutos">
                        <button type="submit" onclick="Registrar(<?php echo count($periodos);?>);">Desfase</button>
                </div>
        </div>
    </div>
</div>
<script>
function Registrar(cantidad)
{       var ini =new Array();
        var ter =new Array();
        for (var i = 0; i < cantidad; i++) {
            ini[i]=$("#uno"+i).val();
            ter[i]=$("#dos"+i).val();
        };
var inicio = JSON.stringify(ini);
    var desfase = $("#desfase").val();
    $.ajax({
        type: "GET",
        dataType: 'html',
        //url: "xd2.php",
        url: 'https://tesis.informatica.utem.cl/~sesparza/ProyectoHC/index.php/json/verifyUser',
        //data: "u="+ini[1]+"&d="+ter[1]+"&desf="+desfase,
        data: "ini="+inicio+"&desf="+desfase,
        success: function(resp){
                var  obj = JSON.parse(resp);
                for (var i = 0; i < obj.largo; i++) {
                

                    // document.getElementById('uno'+i).value = obj.i; 
                 };
                document.getElementById('uno0').value = obj.uno0; 
                document.getElementById('uno1').value = obj.uno1;
                document.getElementById('uno2').value = obj.uno2;
                document.getElementById('uno3').value = obj.uno3;
                document.getElementById('uno4').value = obj.uno4;
                document.getElementById('uno5').value = obj.uno5;
                document.getElementById('uno6').value = obj.uno6;
                document.getElementById('uno7').value = obj.uno7;
                document.getElementById('uno8').value = obj.uno8;



        } 
    });
}

</script>
