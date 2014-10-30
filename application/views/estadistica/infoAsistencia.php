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
minDate: "-12M, 0D",
maxDate: "0D"
});
});
</script>


<script type="text/javascript">
        $(document).ready(function() {
              	document.getElementById('mes').style.display='none'
                document.getElementById('subDiv').style.display='none'
                document.getElementById('mesNameCampus').style.display='none'
                document.getElementById('mesNameFacultad').style.display='none'
              	document.getElementById('year').style.display='none'
	             document.getElementById('noResult').style.display='none'
               document.getElementById('divResultNivelUtem').style.display='none'
  	           document.getElementById('calendar').style.display='none'//ocultar=none
                                    document.getElementById('divRut').style.display='none'
                                    document.getElementById('verResult').style.display='none'

        });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#query").change(function() {//query maestro********************
            	$('#query1 option[selected]').prop('selected', true);
                                    document.getElementById('divRut').style.display='none'
                $("#query option:selected").each(function() { 
                document.getElementById('subDiv').style.display='block'

                  window.query=$('#query').val();
                if(query=="")document.getElementById('subDiv').style.display='none'

                                    document.getElementById('calendar').style.display='none'//muestra el datepicker
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('year').style.display='none'//ocultar=none
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('verResult').style.display='none'
                                    document.getElementById('noResult').style.display='none'//ocultar=none
                                    document.getElementById('mesNameCampus').style.display='none'//ocultar=none
                                    document.getElementById('mesNameFacultad').style.display='none'//ocultar=none
                                    document.getElementById('dpto').style.display='none'
                document.getElementById("datepicker").value= "";
              $('#selectAnio option[selected]').prop('selected', true);
              $('#selectYear option[selected]').prop('selected', true);
              $('#selectCampus option[selected]').prop('selected', true);
              $('#selectFacultad option[selected]').prop('selected', true);
                });
            });
            $("#query1").change(function() {//*********UTEM**********
                $("#query1 option:selected").each(function() {
              $('#selectCampus option[selected]').prop('selected', true);
              $('#selectDpto option[selected]').prop('selected', true);
              $('#selectFacultad option[selected]').prop('selected', true);
                document.getElementById("datepicker").value= "";
                  window.query1=$('#query1').val();
                  if((query==5 && query1==1)||(query==5 && query1==2) || (query==5 && query1==3)){
                                    document.getElementById('divRut').style.display='block'
                  }
                   switch(query1){
                      case "1"://*****DIA******

                                    document.getElementById('calendar').style.display='block'//muestra el datepicker
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('year').style.display='none'//ocultar=none
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('verResult').style.display='none'
                                    document.getElementById('noResult').style.display='none'
                                    document.getElementById('mesNameCampus').style.display='none'
                                    document.getElementById('mesNameFacultad').style.display='none'//ocultar=none
                                    document.getElementById('dpto').style.display='none'

                                  if(query==4){//del campus se despliega el select del mes
                                    document.getElementById('mesNameFacultad').style.display='block'

                                  }else{
                                    document.getElementById('mesNameFacultad').style.display='none'
                                  } 
                        break;
                      case "2"://*****MES******
                                    document.getElementById('mes').style.display='block'
                                    document.getElementById('calendar').style.display='none'//ocultar=none
                                    document.getElementById('year').style.display='none'
                                    document.getElementById('verResult').style.display='none'
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('noResult').style.display='none'

                                  if(query==2){//del campus se despliega el select del mes
                                    document.getElementById('mesNameCampus').style.display='block'

                                  }else{
                                    document.getElementById('mesNameCampus').style.display='none'
                                  }
                                  if(query==3 || query==4){//del campus se despliega el select del mes
                                    document.getElementById('mesNameFacultad').style.display='block'

                                  }else{
                                    document.getElementById('mesNameFacultad').style.display='none'
                                  }
                        break;
                      case "3"://*****AÑO******
                                    document.getElementById('year').style.display='block'
                                    document.getElementById('calendar').style.display='none'
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('verResult').style.display='none'
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('noResult').style.display='none'
                                    document.getElementById('mesNameCampus').style.display='none'
                                    document.getElementById('mesNameFacultad').style.display='none'
                                  if(query==2){//del campus se despliega el select del mes
                                    document.getElementById('mesNameCampus').style.display='block'

                                  }else{
                                    document.getElementById('mesNameCampus').style.display='none'
                                  }
                                  if(query==3 || query==4){//del campus se despliega el select del mes
                                    document.getElementById('mesNameFacultad').style.display='block'
                                document.getElementById('dpto').style.display='none'
                                  }else{
                                    document.getElementById('mesNameFacultad').style.display='none'
                                  }
                        break;
                      case "":
                                    document.getElementById('year').style.display='none'
                                    document.getElementById('calendar').style.display='none'
                                    document.getElementById('mes').style.display='none'
                                    document.getElementById('verResult').style.display='none'
                                    document.getElementById('divResultNivelUtem').style.display='none'
                                    document.getElementById('noResult').style.display='none'
                                    document.getElementById('mesNameCampus').style.display='none'
                                    document.getElementById('mesNameFacultad').style.display='none'//ocultar=none
                                    document.getElementById('dpto').style.display='none'
                        break;             
                   }
                });
            });
            function dataFalse(texto){
                document.getElementById('verResult').style.display='block'
                document.getElementById('divResultNivelUtem').style.display='none'
                document.getElementById('noResult').style.display='block'
                $("#noResult").html(texto);
            }
            function dataTrue(titulo){
                      document.getElementById('verResult').style.display='block'
                  document.getElementById('divResultNivelUtem').style.display='block'
                  document.getElementById('noResult').style.display='none'
                  document.getElementById('titulo').style.display='block'
                  document.getElementById("titulo").innerHTML = titulo; 
            }
            $("#datepicker").change(function() {
              datepi=$('#datepicker').val();  
                   selectFacultad=$('#selectFacultad').val();
                   selectRut=$('#user').val();
              if(query==1)utemDia(datepi);
              if(query==2)campusDia(datepi);
              if(query==3)facultadDia(datepi);
              if(query==4)departamentoDia(datepi,selectFacultad);
              if(query==5)docenteDia(datepi,selectRut);

                function utemDia(datepi){
                   $.post("<?= base_url('/index.php/estadistica/nivelUtemDia')?>", {
				              datepi : datepi
				                    }, function(data) {
				                     	 if(data==false){
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);

				                     	 }else{ 
				                     	  data=data.split("/");
				                     	  objeto1=eval('('+data[0]+')');
				                     	  objeto2=eval('('+data[1]+')');
				                     	  	piechart(objeto1,objeto2);
                                  var titulo="<h3>Asistencia Día - UTEM</h3>";
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
                                        var titulo="<h3>Asistencia Día - Campus</h3>";
                                        dataTrue(titulo);
                                     }
                      }); 
                }
                function facultadDia(datepi){
                      $.post("<?= base_url('/index.php/estadistica/nivelFacultadDia')?>", {
                          datepi : datepi
                      }, function(data) {
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
                                          var titulo="<h3>Asistencia Día - Facultad</h3>";
                                          dataTrue(titulo);
                                     }
                      }); 
                }
                function departamentoDia(datepi,selectFacultad){
                      $.post("<?= base_url('/index.php/estadistica/nivelDepartamentoDia')?>", {
                          datepi : datepi, selectFacultad:selectFacultad
                      }, function(data) {
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
                                          var titulo="<h3>Asistencia Dia - Dptos.</h3>";
                                          dataTrue(titulo);
                                     }
                      }); 
                }
                function docenteDia(datepi,selectRut){
                   $.post("<?= base_url('/index.php/estadistica/nivelDocenteDia')?>", {
                      datepi : datepi,selectRut:selectRut
                            }, function(data) {
                               if(data==false){
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);

                               }else{ 
                                data=data.split("/");
                                objeto1=eval('('+data[0]+')');
                                objeto2=eval('('+data[1]+')');
                                  piechart(objeto1,objeto2);
                                  var titulo="<h3>Asistencia Día - Docente</h3>";
                                  dataTrue(titulo);
                                }
                            });
                }               
			     	window.myPieGlobal.destroy();
           });//******FIN $("#datepicker").change(function() **********
			     $("#selectAnio").change(function() {//este es del mes****************+
            $("#selectAnio option:selected").each(function() { 
                   window.selectAnio=$('#selectAnio').val();
                   selectCampus=$('#selectCampus').val();
                   selectFacultad=$('#selectFacultad').val();
                   selectDpto=$('#selectDpto').val();
                   selectRut=$('#user').val();

                   if(selectCampus=='' && selectAnio!='' && query==2){alert("Favor elija un Campus"); $('#selectAnio option[selected]').prop('selected', true);} 
                   if(selectFacultad=='' && selectAnio!='' && query==3){alert("Favor elija una Facultad"); $('#selectAnio option[selected]').prop('selected', true);} 
                  if(selectFacultad=='' && selectAnio!='' && query==4){alert("Favor elija una Facultad"); $('#selectAnio option[selected]').prop('selected', true);} 
                  if(selectDpto=='' && selectAnio!='' && query==4){alert("Favor elija un Departamento"); $('#selectAnio option[selected]').prop('selected', true);} 
              if(query==1)utemMes(selectAnio);
              if(query==2)campusMes(selectAnio,selectCampus);
              if(query==3)facultadMes(selectAnio,selectFacultad);
              if(query==4)departamentoMes(selectAnio,selectDpto);
              if(query==5)docenteMes(selectAnio,selectRut);
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
                                  var titulo="<h3>Asistencia Meses - UTEM</h3>";
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
                                  var titulo="<h3>Asistencia Meses - Campus </h3>";
                                  dataTrue(titulo); 
                          }

                      });
                }
                function facultadMes(selectAnio,selectFacultad){
                      $.post("<?= base_url('/index.php/estadistica/nivelFacultadMes')?>", {
                        selectAnio : selectAnio , selectFacultad : selectFacultad
                         },function(data) {
                          if(data==false){//quiere decir que no hay registros
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
                                        var titulo="<h3>Asistencia Meses - Facultades </h3>";
                                  dataTrue(titulo); 
                          }
                      });
                }
                function departamentoMes(selectAnio,selectDpto){
                      $.post("<?= base_url('/index.php/estadistica/nivelDepartamentoMes')?>", {
                        selectAnio : selectAnio , selectDpto : selectDpto
                         },function(data) {
                          if(data==false){//quiere decir que no hay registros
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
                                      var titulo="<h3>Asistencia Meses - Dptos.</h3>";
                                  dataTrue(titulo);    
                          }
                      });
                }
                function docenteMes(selectAnio,selectRut){
                      $.post("<?= base_url('/index.php/estadistica/nivelDocenteMes')?>", {
                        selectAnio : selectAnio , selectRut : selectRut
                         },function(data) {
                          if(data==false){//quiere decir que no hay registros
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
                                          var titulo="<h3>Asistencia Meses - Docente</h3>";
                                  dataTrue(titulo);     
                          }
                      });
                }     
            window.myPieGlobal.destroy();
                });
            });
		$("#selectYear").change(function() {
        $("#selectYear option:selected").each(function() { 
                   selectFacultad=$('#selectFacultad').val();
                   selectCampus=$('#selectCampus').val();
                   selectYear=$('#selectYear').val(); 
                   selectRut=$('#user').val();                   
                  if(selectCampus=='' && selectYear!='' && query==2){alert("Favor elija un Campus"); $('#selectYear option[selected]').prop('selected', true);} 
                   if(selectFacultad=='' && selectAnio!='' && query==3){alert("Favor elija una Facultad"); $('#selectYear option[selected]').prop('selected', true);} 
                 if(selectFacultad=='' && selectAnio!='' && query==4){alert("Favor elija una Facultad"); $('#selectYear option[selected]').prop('selected', true);} 
              if(query==1)utemYear(selectYear);
              if(query==2)campusYear(selectYear,selectCampus);
              if(query==3)facultadYear1(selectYear,selectFacultad);
             if(query==4)departamentoYear(selectYear,selectFacultad);
             if(query==5)docenteYear(selectYear,selectRut);
              function utemYear(selectYear){ 
        					$.post("<?= base_url('/index.php/estadistica/nivelUtemYear')?>", {
        						selectYear : selectYear
        						 },function(data) {
        						 	if(data==false){//quiere decir que no hay registros
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);
        						 	}else{
        									data=data.split("/");
      				                     	  objeto1=eval('('+data[0]+')');
      				                     	  objeto2=eval('('+data[1]+')');
      												piechart(objeto1,objeto2);
                                          var titulo="<h3>Asistencia Año - UTEM</h3>";
                                  dataTrue(titulo);
        							}
        					});
              }
              function campusYear(selectYear,selectCampus){ 
                  $.post("<?= base_url('/index.php/estadistica/nivelCampusYear')?>", {
                    selectYear : selectYear , selectCampus : selectCampus
                     },function(data) {
                      if(data==false){//quiere decir que no hay registros
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);
                      }else{
                          data=data.split("/");
                                      objeto1=eval('('+data[0]+')');
                                      objeto2=eval('('+data[1]+')');
                              piechart(objeto1,objeto2);
                                          var titulo="<h3>Asistencia Año - Campus</h3>";
                                  dataTrue(titulo);
                      }
                  });
              }
              function facultadYear1(selectYear,selectFacultad){ 
                  $.post("<?= base_url('/index.php/estadistica/nivelFacultadYear')?>", {
                    selectYear : selectYear , selectFacultad : selectFacultad
                     },function(data) {
                      if(data==false){//quiere decir que no hay registros
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);
                      }else{
                          data=data.split("/");
                                      objeto1=eval('('+data[0]+')');
                                      objeto2=eval('('+data[1]+')');
                              piechart(objeto1,objeto2);
                                          var titulo="<h3>Asistencia Año - Facultad</h3>";
                                  dataTrue(titulo);
                      }
                  });
              }
              function departamentoYear(selectYear,selectFacultad){ 
                  $.post("<?= base_url('/index.php/estadistica/nivelDepartamentoYear')?>", {
                    selectYear : selectYear , selectFacultad : selectFacultad
                     },function(data) {
                      if(data==false){//quiere decir que no hay registros
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
                                           radarchart(asisten,ausente,etiquetas);
                                          var titulo="<h3>Asistencia Año - Dptos.</h3>";
                                          dataTrue(titulo);

                          }
                  });
              }
            function docenteYear(selectYear,selectRut){ 
                  $.post("<?= base_url('/index.php/estadistica/nivelDocenteYear')?>", {
                    selectYear : selectYear , selectRut : selectRut
                     },function(data) {
                      alert(data);
                      if(data==false){//quiere decir que no hay registros
                                var texto="Lo lamentamos No hay registros en nuestro sistema para esta fecha";
                                dataFalse(texto);
                      }else{
                          data=data.split("/");
                                      objeto1=eval('('+data[0]+')');
                                      objeto2=eval('('+data[1]+')');
                              piechart(objeto1,objeto2);
                                          var titulo="<h3>Asistencia Año - Docente</h3>";
                                  dataTrue(titulo);
                      }
                  });
              }
        });
       window.myPieGlobal.destroy();
      });
    });
</script>

		<div class="span9">	<div class="well">
			<div class="row-fluid"><div class="span12"><h3>Estadisticas para la asistencia UTEM</h3></div></div>
			<div class="row-fluid">
				<div class="span12">
					<p>Este tipo de consulta solo contempla la asistencia de los docentes</p>
					<p>Seleccione un tipo de consulta para desplegar la información</p>
					<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form','name'=>'form1'); 
          echo form_open('estadistica/descargar',$attributes); ?>
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
                        <option selected="selected" value="">Selecione un Campus</option>
                        <?php     
                          foreach ($campus as $key) {
                            echo'<option value="'.$key->pk.'">'.$key->nombre.'</option>';
                          }
                         ?>
                      </select>
                    </div>
                </div>
              </div>
              <div id="mesNameFacultad">
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
              <script>  
function holas(){
      $('#selectYear option[selected]').prop('selected', true);
}
</script>
							<div id="dpto">

              </div>
              <div id="divRut">
                  <div class="form-group">
                    <label for="usuario" class="col-lg-3 control-label">Rut</label>
                    <div class="col-lg-4">
                      <input type="text" onblur="return Rut(form1.rut.value)" onfocus="holas()" name="rut" value="" placeholder="12.345.678-9" id="user" class="form-control"  />
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
									<div class="col-sm-4">

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

							<!--<div id="noResult"></div>
							<div id="divResultNivelUtem">
								<div id="titulo"></div>
								<canvas id="chart-areaGlobal" width="400" height="400"></canvas>
                <div id="pieLegend"></div>
                <div id="descargar"><br> <?php 
                  
                 // echo '<input type="submit" class="btn btn-success center" onclick="extraer();" name="Descargar" value="Descargar">';
                  //echo '<input type="hidden" id="hidden" name="descargaHidden">';
                  
                 ?></div>
							</div>-->
					<?php echo form_close();?>
				</div>
			</div><!--FIN WELL-->

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
<div id="test"></div>
<script>
  function extraer(){
    document.getElementById("hidden").value=test;
  }
</script>
<script>
$(document).ready(function() {
    $("#selectCampus").change(function() {$.reset();});
    $("#dpto").change(function() {$.reset();});
    $("#selectFacultad").change(function() {$.reset();});
});
$.reset=function(){
	    $('#selectAnio option[selected]').prop('selected', true);
                document.getElementById("datepicker").value= "";
      $('#selectYear option[selected]').prop('selected', true);
} 
      $("#selectFacultad").change(function() {
                  $("#selectFacultad option:selected").each(function() {
                   selectFacultad=$('#selectFacultad').val();
                   if((query1==2 && query==4)){
                          $.post("<?= base_url('/index.php/estadistica/llena_Dpto')?>",{
                             selectFacultad : selectFacultad
                          },function(data) {
                    document.getElementById('dpto').style.display='block'
                            if(data==false)
                            { 
                               $("#dpto").html("Selecciona otra Facultad");
                            }else $("#dpto").html(data);
                        });
                       }
      }); 
    });
          
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
					window.datasets = [
						{
							value: var1,
							color:"#0b82e7",
              lineColor: "#0b82e7", 
							highlight: "#0c62ab",
							label: "Asistieron",
              title:'Asistieron'},
						{
							value: var2,
							color: "#e3e860",
              lineColor: "#e3e860",
							highlight: "#a9ad47",
							label: "Ausencia",
              title:'Ausencia'
						},
            ];

    
              var options = {
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
              };
					//	var ctx2 = document.getElementById("chart-areaGlobal").getContext("2d");
					 window.myPieGlobal=new Chart(document.getElementById("chart-areaGlobal").getContext("2d")).Pie(datasets,options);
                      document.getElementById("pieLegend").innerHTML = myPieGlobal.generateLegend();
                      //document.getElementById("descargar").innerHTML = myPieGlobal.toBase64Image();

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
                            data : asisten,
                            label:"Asistieron"
                          },
                          {
                            fillColor : "#e9e225",
                            strokeColor : "#000000",
                            highlightFill : "#ee7f49",
                            highlightStroke : "#000000",
                            data : ausente,
                            label:"Ausencia"
                          }
                        ]
                      }   
              var options = {scaleLineColor:"#000",angleLineColor:"#000",pointLabelFontColor:"#000",scaleFontSize:15,pointLabelFontSize:16,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
              };
          //  var ctx2 = document.getElementById("chart-areaGlobal").getContext("2d");
           window.myPieGlobal=new Chart(document.getElementById("chart-areaGlobal").getContext("2d")).Bar(barChartData,options);
                      document.getElementById("pieLegend").innerHTML = myPieGlobal.generateLegend();
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
                            data : asisten,
                            label:"Asistieron"
                          },
                          {
                            fillColor : "rgba(151,187,205,0.2)",
                            strokeColor : "#e9e225",
                            pointColor : "#faab12",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(151,187,205,1)",
                            data : ausente,
                            label:"Ausencia"
                          }
                        ]
                      }   
              var options = {scaleLineColor:"#000",angleLineColor:"#000",pointLabelFontColor:"#000",scaleFontSize:15,pointLabelFontSize:16,scaleGridLineColor:"#000",
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
              };
          //  var ctx2 = document.getElementById("chart-areaGlobal").getContext("2d");
           window.myPieGlobal=new Chart(document.getElementById("chart-areaGlobal").getContext("2d")).Line(barChartData,options);
                      document.getElementById("pieLegend").innerHTML = myPieGlobal.generateLegend();
  }
  function radarchart(asisten,ausente,etiquetas){
                      var radarChartData = {
                        labels : etiquetas,
                        datasets : [
                          {
                            fillColor :"rgba(52,152,219,0.23)",
                            strokeColor : "rgba(52,152,219,1)",
                            pointColor : "rgba(52,152,219,1)",
                            pointStrokeColor : "rgba(255,255,255,1.00)",
                            data : asisten,
                            label:"Asistieron"
                          },
                          {
                            fillColor :"rgba(46,204,112,0.49)",
                            strokeColor : "rgba(46,204,113,1)",
                            pointColor : "rgba(46,204,113,1)",
                            pointStrokeColor : "rgba(255,255,255,1)",
                            data : ausente,
                            label:"Ausencia"
                          }
                        ]
                      }   
              var options = {scaleLineColor:"#000",angleLineColor:"#000",pointLabelFontColor:"#000",scaleFontSize:15,pointLabelFontSize:16,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
              };
          //  var ctx2 = document.getElementById("chart-areaGlobal").getContext("2d");
           window.myPieGlobal=new Chart(document.getElementById("chart-areaGlobal").getContext("2d")).Radar(radarChartData,options);
                      document.getElementById("pieLegend").innerHTML = myPieGlobal.generateLegend();
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
      ul.line-legend {
          list-style: none outside none;
          float: left;
          margin: 0 0 0 0;
          padding: 0;
          position: relative;
          left: 50%;
      }
      ul.line-legend > li {
          float: left;
          margin-right: 5px;
          padding: 5px;
          position: relative;
          left: -50%;
      }
      ul.radar-legend {
          list-style: none outside none;
          float: left;
          margin: 0 0 0 0;
          padding: 0;
          position: relative;
          left: 50%;
      }
      ul.radar-legend > li {
          float: left;
          margin-right: 5px;
          padding: 5px;
          position: relative;
          left: -50%;
      }
    </style>
