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
</script>
<script type="text/javascript">
        $(document).ready(function() {
              	document.getElementById('mes').style.display='none'
                document.getElementById('subDiv').style.display='none'
                                    document.getElementById('mesNameCampus').style.display='none'

              	document.getElementById('year').style.display='none'
	             document.getElementById('noResult').style.display='none'
               document.getElementById('divResultNivelUtem').style.display='none'
  	           document.getElementById('calendar').style.display='none'//ocultar=none
        });
</script>
    <script type="text/javascript">/*
        $(document).ready(function() {
        	document.getElementById('divResultNivelUtem').style.display='none'
        	document.getElementById('divResultNivelCampus').style.display='none'

            $("#query").change(function() {
                $("#query option:selected").each(function() { 
                   query=$('#query').val();
                   switch(query) {
						    case "1":
		    					$.post("<?= base_url('/index.php/estadistica/nivelUtem')?>", {
				                        query : query
				                    }, function(data) {
				                     	  //$("#divResult").html(data);
				                     	  data=data.split("/");
				                     	  objeto1=eval('('+data[0]+')');
				                     	  objeto2=eval('('+data[1]+')');
													var pieData = [
																	{
																		value: objeto1,
																		color:"#0b82e7",
																		highlight: "#0c62ab",
																		label: "Asistieron"},
																	{
																		value: objeto2,
																		color: "#e3e860",
																		highlight: "#a9ad47",
																		label: "Ausencia"
																	}
																];
													var ctx = document.getElementById("chart-area").getContext("2d");
													window.myPie = new Chart(ctx).Pie(pieData);

				                    });  
								        document.getElementById('divResultNivelUtem').style.display='block'
        								document.getElementById('divResultNivelCampus').style.display='none'


						        break;
						    case "2":
		    						$.post("<?= base_url('/index.php/estadistica/nivelCampus')?>", {
				                        query : query
				                    }, function(data) {
				                     	 // $("#divResultNivelCampus").html(data);
				                  var asisten=new Array();
				                  var ausente=new Array();
				                  var etiquetas=new Array();
				                     	 objeto=eval('('+data+')');
							                var tot=0;
							                for (i in objeto) {
							                     tot++;
							                 };
							                 var partes=tot/3;//dividido 3 xq son nombres,asistieron,no asistieron

							                 for (var i = 0; i < tot; i++) {
							                	if(i<partes)
							                		etiquetas.push(objeto[i]);
							                	else{
							                		if(i<(partes*2) && i>=partes)
							                			asisten.push(objeto[i]);
							                		else
							                			ausente.push(objeto[i]);
							                	}

							                 };
				                     	  	var barChartData = {
												labels : etiquetas,
												datasets : [
													{
														fillColor : "#6b9dfa",
														strokeColor : "#000000",
														highlightFill: "#1864f2",
														highlightStroke: "#000000",
														data : asisten
													},
													{
														fillColor : "#e9e225",
														strokeColor : "#000000",
														highlightFill : "#ee7f49",
														highlightStroke : "#000000",
														data : ausente
													}
												]

											}
													var ctx2 = document.getElementById("chart-area2").getContext("2d");
													window.myPie = new Chart(ctx2).Bar(barChartData, {responsive:true});
				                    }); 
								        document.getElementById('divResultNivelCampus').style.display='block'
        								document.getElementById('divResultNivelUtem').style.display='none'

						        break;
						    case "3":
						    		break;
						    case "4":

						    		break;		    
						}
                });
            });
        });
*/
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#query").change(function() {//query maestro********************
            	$('#query1 option[selected]').prop('selected', true);

                $("#query option:selected").each(function() { 
                document.getElementById('subDiv').style.display='block'

                  window.query=$('#query').val();
                if(query=="")document.getElementById('subDiv').style.display='none'

                                    document.getElementById('calendar').style.display='none'//muestra el datepicker
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('year').style.display='none'//ocultar=none
                                    document.getElementById('divResultNivelUtem').style.display='none'//ocultar=none
                                    document.getElementById('noResult').style.display='none'//ocultar=none
                                    document.getElementById('mesNameCampus').style.display='none'//ocultar=none

                                   
                document.getElementById("datepicker").value= "";
              $('#selectAnio option[selected]').prop('selected', true);
              $('#selectYear option[selected]').prop('selected', true);
              $('#selectCampus option[selected]').prop('selected', true);


                          
                });
            });
            $("#query1").change(function() {//*********UTEM**********
                $("#query1 option:selected").each(function() {
                  window.query1=$('#query1').val();
                   switch(query1){
                      case "1"://*****DIA******
                                    document.getElementById('calendar').style.display='block'//muestra el datepicker
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('year').style.display='none'//ocultar=none
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('noResult').style.display='none'
                                    document.getElementById('mesNameCampus').style.display='none'



                                    
                        break;
                      case "2"://*****MES******
                                    document.getElementById('mes').style.display='block'
                                    document.getElementById('calendar').style.display='none'//ocultar=none
                                    document.getElementById('year').style.display='none'
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('noResult').style.display='none'
                                  if(query==2){//del campus se despliega el select del mes
                                    document.getElementById('mesNameCampus').style.display='block'

                                  }else{
                                    document.getElementById('mesNameCampus').style.display='none'


                                  }


                        break;
                      case "3"://*****AÑO******
                                    document.getElementById('year').style.display='block'
                                    document.getElementById('calendar').style.display='none'
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('noResult').style.display='none'
                                    document.getElementById('mesNameCampus').style.display='none'



                        break;
                      case "":
                                    document.getElementById('year').style.display='none'
                                    document.getElementById('calendar').style.display='none'
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('noResult').style.display='none'
                                    document.getElementById('mesNameCampus').style.display='none'



                        break;             
                   }
                });
            });
            function dataFalse(texto){
                document.getElementById('divResultNivelUtem').style.display='none'
                document.getElementById('noResult').style.display='block'
                $("#noResult").html(texto);
            }
            function dataTrue(titulo){
                  document.getElementById('divResultNivelUtem').style.display='block'
                  document.getElementById('noResult').style.display='none'
                  document.getElementById('titulo').style.display='block'
                  document.getElementById("titulo").innerHTML = titulo; 
            }
            $("#datepicker").change(function() {
              datepi=$('#datepicker').val();  

              if(query==1)utemDia(datepi);
              if(query==2)campusDia(datepi);
              if(query==3)facultadDia(datepi);
              if(query==4)que4(datepi);
              if(query==5)que5(datepi);

                function utemDia(datepi){
                   $.post("<?= base_url('/index.php/estadistica/nivelUtemDia')?>", {
				              datepi : datepi
				                    }, function(data) {
				                     	  //$("#divResultNivelUtemDia").html(data);
				                     	 if(data==false){
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);

				                     	 }else{ 
				                     	  data=data.split("/");
				                     	  objeto1=eval('('+data[0]+')');
				                     	  objeto2=eval('('+data[1]+')');
				                     	  	piechart(objeto1,objeto2);
                                  var titulo="<h3>Asistencia Por Día UTEM</h3>";
                                  dataTrue(titulo);
										            }
				                    });
                }
                function campusDia(datepi){
                      $.post("<?= base_url('/index.php/estadistica/nivelCampusDia')?>", {
                          datepi : datepi
                       }, function(data) {
                         // $("#divResultNivelCampus").html(data);
                            if(data==false){
                                      var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                      dataFalse(texto);
                                     }else{ 
                                         var asisten=new Array();
                                        var ausente=new Array();
                                        var etiquetas=new Array();
                                             objeto=eval('('+data+')');
                                            var tot=0;
                                            for (i in objeto) {
                                                 tot++;
                                             };
                                             var partes=tot/3;//dividido 3 xq son nombres,asistieron,no asistieron
                                             for (var i = 0; i < tot; i++) {
                                                if(i<partes)
                                                  etiquetas.push(objeto[i]);
                                                else{
                                                  if(i<(partes*2) && i>=partes)
                                                    asisten.push(objeto[i]);
                                                  else
                                                    ausente.push(objeto[i]);
                                                }
                                             };
                                        barrachart(asisten,ausente,etiquetas);
                                        var titulo="<h3>Asistencia Por Campus</h3>";
                                        dataTrue(titulo);
                                     }
                      }); 
                }
                function facultadDia(datepi){
                      $.post("<?= base_url('/index.php/estadistica/nivelFacultadDia')?>", {
                          datepi : datepi
                      }, function(data) {
                         // $("#divResultNivelCampus").html(data);
                                                       // alert(data);
                            if(data==false){
                                      var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                      dataFalse(texto);
                                     }else{ 
                                         var asisten=new Array();
                                        var ausente=new Array();
                                        var etiquetas=new Array();
                                             objeto=eval('('+data+')');
                                            var tot=0;
                                            for (i in objeto) {
                                                 tot++;
                                             };
                                             var partes=tot/3;//dividido 3 xq son nombres,asistieron,no asistieron
                                             var abreviar;
                                             for (var i = 0; i < tot; i++) {
                                                if(i<partes){
                                                           //*******quitar conectores******
                                                               abreviar=objeto[i].split(" ");
                                                               var abreviar2="";
                                                               for (var z = 0; z < abreviar.length; z++) {
                                                                 if(abreviar[z].length>3){
                                                                  abreviar2=abreviar2+" "+abreviar[z];
                                                                 }
                                                               }
                                                              //******* FIN quitar conectores******
                                                              var abreviar3;
                                                               abreviar3=abreviar2.split(" ");
                                                               if(abreviar3.length<=2)
                                                                    etiquetas.push(abreviar3[1]);
                                                                else{
                                                                  etiquetas.push(abreviar3[1]+" "+abreviar3[2]);
                                                                }               
                                                }else{
                                                  if(i<(partes*2) && i>=partes)
                                                    asisten.push(objeto[i]);
                                                  else
                                                    ausente.push(objeto[i]);
                                                }
                                             };
                                           barrachart(asisten,ausente,etiquetas);
                                          var titulo="<h3>Asistencia Por Facultad</h3>";
                                          dataTrue(titulo);
                                     }
                      }); 
                }               
			     	window.myPieGlobal.destroy();
           });//******FIN $("#datepicker").change(function() **********
			     $("#selectAnio").change(function() {
            $("#selectAnio option:selected").each(function() { 
                   window.selectAnio=$('#selectAnio').val();
                   selectCampus=$('#selectCampus').val();
              if(query==1)utemMes(selectAnio);
              if(query==2)campusMes(selectAnio,selectCampus);
              if(query==3)facultadMes(selectAnio);
              if(query==4)que4(datepi);
              if(query==5)que5(datepi);
                function utemMes(selectAnio){
            					$.post("<?= base_url('/index.php/estadistica/nivelUtemMes')?>", {
            						selectAnio : selectAnio
            						 },function(data) {
            						 	if(data==false){
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);
            						 	}else{
                                          var asiste=new Array();
                                          var ausente=new Array();
                                             objeto=eval('('+data+')');
                                            var tot=0;
                                            for (i in objeto) {
                                                 tot++;
                                             };
                                             var partes=tot/2;
                                             for (var i = 0; i < tot; i++) {
                                               if(i<partes)asiste.push(objeto[i]);
                                               else ausente.push(objeto[i]);

                                             };
                                          linechart(asiste,ausente);
                                  var titulo="<h3>Asistencia Por Meses UTEM</h3>";
                                  dataTrue(titulo); 
                          }

            					});
                }
                function campusMes(selectAnio,selectCampus){ 
                      $.post("<?= base_url('/index.php/estadistica/nivelCampusMes')?>", {
                        selectAnio : selectAnio,selectCampus : selectCampus
                         },function(data) {
                          if(data==false){
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);
                          }else{
                                          var asiste=new Array();
                                          var ausente=new Array();
                                             objeto=eval('('+data+')');
                                            var tot=0;
                                            for (i in objeto) {
                                                 tot++;
                                             };
                                             var partes=tot/2;
                                             for (var i = 0; i < tot; i++) {
                                               if(i<partes)asiste.push(objeto[i]);
                                               else ausente.push(objeto[i]);

                                             };
                                          linechart(asiste,ausente);
                                  var titulo="<h3>Asistencia Por Meses Campus </h3>";
                                  dataTrue(titulo); 
                          }

                      });
                }
                function facultadMes(selectAnio){
                      $.post("<?= base_url('/index.php/estadistica/nivelUtemMes')?>", {
                        selectAnio : selectAnio
                         },function(data) {
                          if(data==false || futuro==true){//quiere decir que no hay registros
                          document.getElementById('noResult').style.display='block'
                          document.getElementById("noResult").innerHTML = "Lo lamentamos No hay registros en nuestro sistema para esta fecha"; 
                          document.getElementById('divResultNivelUtem').style.display='none'
                          }else{
                              data=data.split("/");
                                          objeto1=eval('('+data[0]+')');
                                          objeto2=eval('('+data[1]+')');
                            piechart(objeto1,objeto2);                       
                                document.getElementById('divResultNivelUtem').style.display='block'
                              document.getElementById('noResult').style.display='none'
                              document.getElementById('total').style.display='block'
                              document.getElementById("total").innerHTML = "Total Personal: "+(objeto1+objeto2);
                              document.getElementById('titulo').style.display='block'
                              document.getElementById("titulo").innerHTML = "<h3>Asistencia Por Mes UTEM</h3>";     
                          }
                      });
                }    
            window.myPieGlobal.destroy();
                });
            });
    $('#selectMes').change(function(){
      $('#selectMes option:selected').each(function(){
          selectMes=$('#selectMes').val();
          selectCampus=$('#selectCampus').val();
         if(query==2)campusMes(selectAnio,selectCampus);


      });
    });
		$("#selectYear").change(function() {
                $("#selectYear option:selected").each(function() { 
                   selectYear=$('#selectYear').val();
  					$.post("<?= base_url('/index.php/estadistica/nivelUtemYear')?>", {
  						selectYear : selectYear
  						 },function(data) {
  						 	if(data==false){//quiere decir que no hay registros
  							document.getElementById('noResult').style.display='block'
  							document.getElementById('divResultNivelUtem').style.display='none'

				                $("#noResult").html("Lo lamentamos No hay registros en nuestro sistema para este Año");

  						 	}else{
  									data=data.split("/");
				                     	  objeto1=eval('('+data[0]+')');
				                     	  objeto2=eval('('+data[1]+')');
												piechart(objeto1,objeto2);
					  							document.getElementById('divResultNivelUtem').style.display='block'
					  							document.getElementById('noResult').style.display='none'
					  							document.getElementById('total').style.display='block'
					  							document.getElementById('titulo').style.display='block'
					  							document.getElementById("titulo").innerHTML = "<h3>Asistencia Por Año UTEM</h3>";
					  							document.getElementById("total").innerHTML = "Total Personal: "+(objeto1+objeto2);
  							}
  					});
                   	
                });
  window.myPieGlobal.destroy();
            });
    });
</script>

		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Estadisticas varias para la asistencia UTEM</h3></div></div>
			<div class="row-fluid">
				<div class="span12">
					<p>Este tipo de consulta solo contempla la asistencia de los docentes</p>
					<p>Seleccione un tipo de consulta para desplegar la información</p>
					<form class='form-horizontal' role='form'>
							<div class="form-group">
						    	<label  class="col-sm-3 control-label" id="c">Nivel: </label>
						    	<div class="col-sm-8">
									<select name="query" class="form-control" id="query" >
  									<option selected="selected" value="">Elegir Consulta</option>
  									<option value="1">UTEM</option>
  									<option value="2">Campus</option>
  									<option value="3">Facultad</option>
  									<option value="4">Departamento</option>
  									<option value="5">Docente</option>
									</select>
						    	</div>
							</div>
              <div id="subDiv">
  							<div class="form-group">
  						    	<label  class="col-sm-3 control-label" id="c">Tipo Consulta</label>
  						    	<div class="col-sm-8">
  									<select name="query1" class="form-control" id="query1" >
  										<option selected="selected" value="">Elegir Consulta</option>
  										<option value="1">Día</option>
  										<option value="2">Mes</option>
  										<option value="3">Año</option>
  									</select>
  						    	</div>
  							</div>
              </div>
              <div id="mesNameCampus">
                <div class="form-group">
                  <label  class="col-sm-3 control-label" id="c">Elegir Campus: </label>
                    <div class="col-sm-8">
                      <select name="selectCampus" class="form-control" id="selectCampus">
                        <option selected="selected" value="">Selecione un campus</option>
                        <?php     
                          foreach ($campus as $key) {
                            echo'<option value="'.$key->pk.'">'.$key->nombre.'</option>';
                          }
                         ?>
                      </select>
                    </div>
                </div>
              </div>

							
							<div id="calendar">
								<div class="form-group">
									<label  class="col-sm-3 control-label" id="c">Selecione un Día: </label>
									<div class="col-sm-4">
	                     			   <input readonly="readonly" class="form-control"    type="text" id="datepicker" placeholder="Seleccione Fecha" name="datepicker" />
									</div>
								</div>
							</div>
							<div id="mes">
								<div class="form-group">
									<label  class="col-sm-3 control-label" id="c">Año: </label>
									<div class="col-sm-3">

										<select name="selectAnio" class="form-control" id="selectAnio">
											<option selected="selected" value="">Selecione un Año</option>
											<?php     date_default_timezone_set("America/Santiago");
    													$año = date('Y');
											for ($i=$año; $i >=($año-5) ; $i--) { 
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
											 ?>
										</select>
									</div>
								</div>								
							</div>
							<div id="year">
								<div class="form-group">
									<label  class="col-sm-3 control-label" id="c">Año: </label>
									<div class="col-sm-4">

										<select name="selectYear" class="form-control" id="selectYear">
											<option selected="selected" value="">Selecione un Año</option>
											<?php     date_default_timezone_set("America/Santiago");
    													$año = date('Y');
											for ($i=$año; $i >=($año-5) ; $i--) { 
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
											 ?>
										</select>
									</div>
								</div>

							</div>

							<div id="noResult"></div>
							<div id="divResultNivelUtem">
								<div id="titulo"></div>
								<canvas id="chart-areaGlobal" width="300" height="300"></canvas>
								<div id="total"></div>	
                <div id="chartt"></div>
							</div>
					</form>		
				</div>
			</div><br>
		</div>
	</div>
</div></div>
<script>
$(document).ready(function() {
    $("#selectCampus").change(function() {$.reset();});


});
$.reset=function(){
	    $('#selectAnio option[selected]').prop('selected', true);


}    
 </script>
 <script>
 function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function piechart(var1,var2){
						var pieData2 = [
						{
							value: var1,
							color:"#0b82e7",
							highlight: "#0c62ab",
							label: "Asistieron"},
						{
							value: var2,
							color: "#e3e860",
							highlight: "#a9ad47",
							label: "Ausencia"
						}
					];
						var ctx2 = document.getElementById("chart-areaGlobal").getContext("2d");
						window.myPieGlobal=new Chart(ctx2).Pie(pieData2);
	}
  function barrachart(asisten,ausente,etiquetas){
                  var barChartData = {
                        labels : etiquetas,
                        datasets : [
                          {
                            fillColor : "#6b9dfa",
                            strokeColor : "#000000",
                            highlightFill: "#1864f2",
                            highlightStroke: "#000000",
                            data : asisten
                          },
                          {
                            fillColor : "#e9e225",
                            strokeColor : "#000000",
                            highlightFill : "#ee7f49",
                            highlightStroke : "#000000",
                            data : ausente
                          }
                        ]

                      }   
                          var ctx2 = document.getElementById("chart-areaGlobal").getContext("2d");
                          window.myPieGlobal = new Chart(ctx2).Bar(barChartData,{responsive:false});
                            /*var legend = myPieGlobal.generateLegend();

                          //and append it to your page somewhere
                          $('#chartt').append(legend);*/
  }
    function linechart(asisten,ausente){
                  var barChartData = {
                        labels : ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],//["90","30","10","80","15"],
                        datasets : [
                          {
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "#6b9dfa",
                            pointColor : "#1e45d7",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : asisten
                          },
                          {
                            fillColor : "rgba(151,187,205,0.2)",
                            strokeColor : "#e9e225",
                            pointColor : "#faab12",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(151,187,205,1)",
                            data : ausente
                          }
                        ]

                      }   
                          var ctx2 = document.getElementById("chart-areaGlobal").getContext("2d");
                          window.myPieGlobal = new Chart(ctx2).Line(barChartData);
                            /*var legend = myPieGlobal.generateLegend();

                          //and append it to your page somewhere
                          $('#chartt').append(legend);*/
  }
 </script>
