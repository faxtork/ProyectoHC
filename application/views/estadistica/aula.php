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
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({
minDate: "-12M, 0D",
maxDate: "0D"
});
});
</script>
<script>
$(document).ready(function() {

        document.getElementById('titulo').style.display='none'
         document.getElementById('noResult').style.display='none'
       document.getElementById('divResultNivelUtem').style.display='none'
       document.getElementById('verResult').style.display='none'
       document.getElementById('facultad').style.display='none'
});
    function dataTrue(titulo){
      document.getElementById('divResultNivelUtem').style.display='block'
       document.getElementById('verResult').style.display='block'
      document.getElementById('noResult').style.display='none'
      document.getElementById('titulo').style.display='block'
      document.getElementById("titulo").innerHTML = titulo;
}      
  function dataFalse(texto){
	    document.getElementById('divResultNivelUtem').style.display='none'
       document.getElementById('verResult').style.display='none'
	    document.getElementById('noResult').style.display='block'
	    $("#noResult").html(texto);
}
</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#query").change(function() {
                $("#query option:selected").each(function() { 
                   query=$('#query').val();
                   if(query=='' || query!=1 || query!=2 || query!=3 || query!=4){
                   	        document.getElementById('titulo').style.display='none'
					        document.getElementById('noResult').style.display='none'
					        document.getElementById('divResultNivelUtem').style.display='none'
					        document.getElementById('verResult').style.display='none'
      						document.getElementById('facultad').style.display='none'
                   }
						    	$.post("<?= base_url('/index.php/estadistica/salasNivel')?>", {
						    		query:query
			                            }, function(data) {
			                            	if(query==1){
					                               if(data==false){
					                                var texto="Lo lamentamos No hay salas Asignadas ni Bloqueadas por el momento";
					                                dataFalse(texto);
					                               }else{ 
					                                data=data.split("/");
					                                objeto1=eval('('+data[0]+')');//bloqueada
					                                objeto2=eval('('+data[1]+')');//asignada
					                                objeto3=eval('('+data[2]+')');//libres (sin asignar)

					                                  piechart(objeto1,objeto2,objeto3);
					                                  var titulo="<h3>Salas - UTEM</h3>";
					                                  dataTrue(titulo);
					                                }
			                            	}
			                            	if(query==2){
				                               if(data==false){
					                                var texto="Lo lamentamos No hay salas Asignadas ni Bloqueadas por el momento";
					                                dataFalse(texto);
					                               }else{ 
		                                         var asignada=new Array();
			                                        var bloqueda=new Array();
			                                        var libres=new Array();
			                                        var etiquetas=new Array();

			                                             objeto=eval('('+data+')');
			                                            var tot=0;
			                                            for (i in objeto) {
			                                                 tot++;
			                                             };
			                                             var partes=tot/4;
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
			                                                    asignada.push(objeto[i]);
			                                                  else
		                                                  		{
		                                                  			if(i>=(partes*2) && i<(partes*3)){
		                                                  				bloqueda.push(objeto[i]);
		                                                  			}else libres.push(objeto[i]);
		                                                  		}
			                                                    
			                                                }
			                                             };
		                                           barrachart(bloqueda,asignada,libres,etiquetas);
		                                          var titulo="<h3>Salas - Campus</h3>";
		                                          dataTrue(titulo);

					                                }
			                            	}
			                            	if(query==3){
				                               if(data==false){
					                                var texto="Lo lamentamos No hay salas Asignadas ni Bloqueadas por el momento";
					                                dataFalse(texto);
					                               }else{ 
		                                         var asignada=new Array();
			                                        var bloqueda=new Array();
			                                        var libres=new Array();
			                                        var etiquetas=new Array();

			                                             objeto=eval('('+data+')');
			                                            var tot=0;
			                                            for (i in objeto) {
			                                                 tot++;
			                                             };
			                                             var partes=tot/4;
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
			                                                    asignada.push(objeto[i]);
			                                                  else
		                                                  		{
		                                                  			if(i>=(partes*2) && i<(partes*3)){
		                                                  				bloqueda.push(objeto[i]);
		                                                  			}else libres.push(objeto[i]);
		                                                  		} 
			                                                }
			                                             };
		                                           barrachart(bloqueda,asignada,libres,etiquetas);
		                                          var titulo="<h3>Salas - Facultad</h3>";
		                                          dataTrue(titulo);
					                                }
			                            	}
			                            	if(query==4){
      											//document.getElementById('facultad').style.display='block'
  											           /* $("#selectFacultad").change(function() {
                											$("#selectFacultad option:selected").each(function() {
	                   											selectFacultad=$('#selectFacultad').val();
	                   											alert(selectFacultad+" "+query);
													    		$.post("<?= base_url('/index.php/estadistica/salasNivel')?>", {
														    		selectFacultad:selectFacultad,query:query
										                            }, function(data) {
										                            			alert(data);
												                               if(data==false){
												                                var texto="Lo lamentamos No hay salas Asignadas ni Bloqueadas por el momento";
												                                dataFalse(texto);
												                               }else{ 
												                                data=data.split("/");
												                                objeto1=eval('('+data[0]+')');//bloqueada
												                                objeto2=eval('('+data[1]+')');//asignada
												                                objeto3=eval('('+data[2]+')');//libres (sin asignar)

												                                  piechart(objeto1,objeto2,objeto3);
												                                  var titulo="<h3>Salas - Departamento</h3>";
												                                  dataTrue(titulo);
												                                }
										                            	});
                											}); 
														});
			                            	*/}

			                            });
                });
window.myPie.destroy();	
            });
        });
</script>
		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Estadisticas varias para Salas UTEM</h3></div></div>
			<div class="row-fluid">
				<div class="span12">
					<p>Seleccione un tipo de consulta para desplegar la información</p>
					<form class='form-horizontal' role='form'>
							<div class="form-group">
						    	<label  class="col-sm-3 control-label" id="c">Tipo Consulta</label>
						    	<div class="col-sm-8">
									<select name="query" class="form-control" id="query" >
									<option value="">Elegir Consulta</option>
									<option value="1">UTEM</option>
									<option value="2">Campus</option>
									<option value="3">Facultad</option>
									<!--<option value="4">Departamento</option>-->
									</select>
						    	</div>
							</div>
			              <div id="facultad">
			                <div class="form-group">
			                  <label  class="col-sm-3 control-label" id="c">Elegir Facultad: </label>
			                    <div class="col-sm-8">
			                      <select name="selectFacultad" class="form-control" id="selectFacultad">
			                        <option selected="selected" value="">Selecione un Facultad</option>
			                        <?php     
			                          foreach ($facultades as $key) {
			                            echo'<option value="'.$key->pk.'">'.$key->facultad.'</option>';
			                          }
			                         ?>
			                      </select>
			                    </div>
			                </div>
			              </div>
					</form>		
				</div>
			</div><br>
		</div>
		<div class="row-fluid" id="verResult">
			<div class="span12">
				<div class="well">
					<div id="noResult"></div>
						<div id="divResultNivelUtem">
							<div id="titulo"></div>
							<canvas id="chart-areaGlobal" width="400" height="400"></canvas>
			                <div id="pieLegend"></div>
						</div><br>
				</div>
			</div>
		</div>
	</div>
</div></div>
<script>
	function piechart(var1,var2,var3){
					window.datasets = [
						{
							value: var1,
							color:"#0b82e7",
              				lineColor: "#0b82e7", 
							highlight: "#0c62ab",
							label: "Inhabilitada (%)",
              				title:'Inhabilitada'},
						{
							value: var2,
							color: "#e3e860",
              				lineColor: "#e3e860",
							highlight: "#a9ad47",
							label: "Asignadas (%)",
              				title:'Asignadas '
						},
						{
							value: var3,
							color:"#cc2e3b",
              				lineColor: "#cc2e3b", 
							highlight: "#a9ad00",
							label: "Desocupada (%)",
              				title:'Desocupada'},			
            ];
              var options = {
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
              };
					 window.myPie=new Chart(document.getElementById("chart-areaGlobal").getContext("2d")).Pie(datasets,options);
                      document.getElementById("pieLegend").innerHTML = myPie.generateLegend();
	}
  function barrachart(bloqueda,asignada,libres,etiquetas){
                  var barChartData = {
                        labels : etiquetas,
                        datasets : [
                          {
                            fillColor : "#e9e225",
                            strokeColor : "#000000",
                            highlightFill : "#ee7f49",
                            highlightStroke : "#000000",
                            data : bloqueda,
                            label:"Inhabilitada (%)"
                          },
                          {
                            fillColor : "#6b9dfa",
                            strokeColor : "#000000",
                            highlightFill: "#1864f2",
                            highlightStroke: "#000000",
                            data : asignada,
                            label:"Asigandas (%)"
                          },
                                                    {
                            fillColor : "#cc2e3b",
                            strokeColor : "#000000",
                            highlightFill : "#a9ad00",
                            highlightStroke : "#000000",
                            data : libres,
                            label:"Desocupada (%)"
                          }
                        ]
                      }   
              var options = {scaleLineColor:"#000",angleLineColor:"#000",pointLabelFontColor:"#000",scaleFontSize:15,pointLabelFontSize:16,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
              };
           window.myPie=new Chart(document.getElementById("chart-areaGlobal").getContext("2d")).Bar(barChartData,options);
                      document.getElementById("pieLegend").innerHTML = myPie.generateLegend();
  }
</script>
 <style>
      .center {
          margin-left: auto;
          margin-right: auto;
          text-align: center;
      }
      ul.pie-legend {
          list-style: none outside none;
          float: left;
          margin: 0 0 0 0;
          padding: 0;
          position: relative;
          left: 50%;
      }
      ul.pie-legend > li {
          float: left;
          margin-right: 5px;
          padding: 5px;
          position: relative;
          left: -50%;
      }
      ul.bar-legend {
          list-style: none outside none;
          float: left;
          margin: 0 0 0 0;
          padding: 0;
          position: relative;
          left: 50%;
      }
      ul.bar-legend > li {
          float: left;
          margin-right: 5px;
          padding: 5px;
          position: relative;
          left: -50%;
      }
 </style>   