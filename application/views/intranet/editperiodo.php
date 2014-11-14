<!--<div class="well">
    <div class="row-fluid"><div class="span3"></div><div class="span9"><h3>Esta es la lista Periodos actualmente para la UTEM</h3></div></div>
-->
<?php 
    $attributes = array('class' => 'form-horizontal', 'role' => 'form'); 
 ?>
        <div class="span9"><div class="well">
            <div class="row-fluid"><div class="span12"><h3>Esta es la lista Periodos actualmente para la UTEM</h3></div></div>

            <div class="row-fluid">
                <div class="span7">
                    <h4>Periodos</h4>
                    <?= form_open('intranet/guardarPeriodo',$attributes);?> 
                    <?php
                    foreach ($periodos as $peri) {
                                                $maximo = strlen($peri->inicio);
                        $inicio = substr(strrev($peri->inicio),3,$maximo);
                        $termino = substr(strrev($peri->termino),3,$maximo);
                        $inicio=strrev($inicio);
                        $termino=strrev($termino);

                            echo'<div class="form-group" >
                                        <label  class="col-sm-2 control-label" id="c">'.$peri->pk.'</label>
                                                    <div class="col-sm-5" id="">
                                                        <input name="inicio[]" readonly="readonly" id="uno'.($peri->pk-1).'" type="text" class="form-control" value="'.$inicio.'">
                                                    </div>
                                                    <div class="col-sm-5" id="">
                                                        <input name="termino[]" readonly="readonly" id="dos'.($peri->pk-1).'" type="text" class="form-control" value="'.$termino.'">
                                                    </div>
                                </div>';
                            echo'<input type="hidden" name="pks[]" value="'.$peri->pk.'">';    
                                               
                    } 
                     ?>
                     <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit"  value="Enviar" name="btnEnviar">Enviar <span class="icon-ok icon-white"></span></button>
                        </div>
                      </div>
                     <?php  echo form_close(); ?>
                </div>
                <div class="span5">
                    <h4>Desfasar</h4><br /><br />
                    <p>Puedes desfasar los periodos en minutos,<br> si quieres disminuir el desfase coloca un '-' antes de tu numero</p>
                <br>
                    
                            <div class="input-group">
                              <input type="text" id="desfase" value="5" placeholder="ingrese desfase en minutos" class="form-control">
                              <span class="input-group-btn">
                                    <button type="submit" onclick="Registrar(<?php echo count($periodos);?>);" class='btn btn-default'>Desfase <span class="icon-retweet"></span></button>

                            </span>
                            </div>
                </div>
                <div id="xx"></div>
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
        var perio = ini.concat(ter); //junto las 2 en una cadena
var inicio = JSON.stringify(perio);
//alert(inicio);
//document.getElementById('xx').innerHTML=inicio;
//var termino = JSON.stringify(ter);
//alert(inicio);
    var desfase = $("#desfase").val();
        $.ajax({
        type: "get",
        dataType: 'html',
        cache:false,
       // url: "https://tesis.informatica.utem.cl/~sesparza/ProyectoHC/application/views/intranet/xd2.php",
       // url: 'https://146.83.181.9/~sesparza/ProyectoHC/index.php/json/verifyUser', //error link si se cambia de servidor :(
        url: "<?= base_url('/index.php/json/verifyUser')?>",
        
        //data: "u="+ini[1]+"&d="+ter[1]+"&desf="+desfase,
        data: "ini="+inicio+"&desf="+desfase,
        success: function(resp){
          // alert(resp);
                //var  obj = JSON.parse(resp);
                objeto=eval('('+resp+')');
                //alert(objeto.length);
                var tot=0;
                for (i in objeto) {//alert(objeto[i]);
                     tot++;
                 };
                 var j=0,z=0;
                 for (i in objeto) {
                    if(j<tot/2){ 
                            document.getElementById('uno'+j).value = objeto[i]; 
                    }else{
                            document.getElementById('dos'+z).value = objeto[i];
                            z++; 
                    }
                    j++;  
                 };



        } 
    });
}

</script>



