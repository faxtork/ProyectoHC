<?php 
    $atributosPeriodo=array( "" => "Seleccione un Periodo", );
    foreach ($periodos as $peri) {
      $atributosPeriodo[$peri->pk]=$peri->periodo." -> ".$peri->inicio." - ".$peri->termino;

    }

    $js = 'id = "periodo" onChange="message();"';
echo "<script type='text/javascript' > function message(){
	var no=document.getElementById('periodo').value;
		//alert(no);
	document.getElementById('myvalue').value = no;
}
</script>";

  $atributosDocente= array( "" => "Seleccione un Academico", );
    foreach ($academico as $profesor){ 
    $atributosDocente[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; 
    }
	$atributosDocente[count($atributosDocente)]="NN - NN";//agregar un nn por si no le dan docente

    $atributosSalas=array( "" => "Selec. Sala", );
    foreach ($salas as $aula) {
      $atributosSalas[$aula->pk]=$aula->sala;
    }
    $atributosAsignatura= array( "" => "Seleccione una Asignatura", );
                foreach ($asignatura as $ramo){ 
                    $atributosAsignatura[$ramo->pk] = $ramo->nombre." ".$ramo->codigo; }
?>
<style>
	#center{
		text-align:center;
	}
	.nav-tabs > li, .nav-pills > li {
    float:none;
    display:inline-block;
    *display:inline; /* ie7 fix */
     zoom:0; /* hasLayout ie7 trigger */
}
.nav-tabs > li > a {
    margin-right: -20px;
}
.nav-tabs, .nav-pills {
    text-align:center;
}
</style>
<script>
        $(function() {  
   var window_height = $(window).height(),
   content_height = window_height - 200;
   $('.mygrid-wrapper-div').height(content_height);
});

$( window ).resize(function() {
   var window_height = $(window).height(),
   content_height = window_height - 50;
   $('.mygrid-wrapper-div').height(content_height);
});
</script>

<div class="well">
	<div class="row-fluid">
		<div class="span12">
		<h1>Periodo</h1>
			<ul class="nav nav-tabs">
				<?php 
					foreach ($periodos as $peri) {
						$maximo = strlen($peri->inicio);
						$inicio = substr(strrev($peri->inicio),3,$maximo);
						$termino = substr(strrev($peri->termino),3,$maximo);
						$inicio=strrev($inicio);
						$termino=strrev($termino);
						echo "<li><a class='active' href='".site_url('intranet/academico')."'>".$peri->periodo."<br /> (".$inicio." - ".$termino.")"."</a></li>
								";
					}
				 ?>
				
			</ul>
			<ul class="nav nav-tabs" id="center">
			 <!-- <li class="active"><a href="#">Periodo 1</a></li>
			  <li><a href="#">Periodo 2</a></li>
			  <li><a href="#">Periodo 3</a></li>
			  <li><a href="#">Periodo 4</a></li>
			  <li><a href="#">Periodo 5</a></li>
			  <li><a href="#">Periodo 6</a></li>
			  <li><a href="#">Periodo 7</a></li>
			  <li><a href="#">Periodo 8</a></li>
			  <li><a href="#">Periodo 9</a></li>-->

			  	<?php 
/*
				    foreach ($periodos as $peri){ 
				    		echo "<form action=".$_SERVER['PHP_SELF']." method='GET'>
				    			<li class='active'><button class='btn' type='submit'>".$peri->periodo."- (".$peri->inicio." - ".$peri->termino.")"."</button></li>
								<input name='pkpk' type='hidden' value = '".$peri->pk."'/>
			
							</form>";

				 }*/
				 ?>
			</ul>
		</div>
	</div>
	<br>
	<div class="row-fluid">
		<!--<div class="span2">
			<ul class="nav nav-pills nav-stacked">

           Periodo:<?=form_dropdown('periodo',$atributosPeriodo,'',$js );?>

				<?php 

				    foreach ($periodos as $peri){ 
				    		echo "<form action=".$_SERVER['PHP_SELF']." method='GET'>
				    			<li class='active'><button class='btn' type='submit'>".$peri->periodo."- (".$peri->inicio." - ".$peri->termino.")"."</button></li>
								<input name='pkpk' type='hidden' value = '".$peri->pk."'/>
								<br/>
							</form>";
				    		//echo "<li class=''><a href='".base_url()."index.php/intranet/academico/'>".$peri->periodo."- (".$peri->inicio." - ".$peri->termino.")"."</a></li>";				 	}
				 		//echo "<input name='id_cliente' type='hidden' value = '".$peri->pk."'/>";
				 }
				 ?>
			</ul>		
		</div>-->
		<div class="span12">
			<!--<h1>Periodo: <?php echo $numeroPer[1]; ?></h1> 	-->	
		<?php 
			//echo "esto se replica en todo, pero cuando llene el form,</br > preguntara al link si es periodo 1 o periodo 2 y lo guardara<br />";

		 ?>
		<!--<input type="text" value="" id="myvalue" disabled="">-->
		<div class="table-responsive mygrid-wrapper-div">
			<table class="table table-hover-striped" style="text-align:left;" border="0">
				<thead >
					<tr >
						<th id="center">Sala</th>
						<th id="center">Profesor</th>
						<th id="center">Asignatura</th>
						<th id="center">S</th>
						<th id="center">C</th>
						<th id="center">Ent.</th>
						<th id="center">Sal.</th>
						<th id="center">Firma</th>
					</tr>
				</thead>
				<tbody>
				<?php
				//<td>".form_dropdown('sala',$atributosSalas,'style="width:300px"')."</td>

                    foreach ($salas as $aula) {
                    	echo "<tr style='text-align:center;'>
							<td>".$aula->sala."</td>
							<td>".form_dropdown('docente'.$aula->pk.'',$atributosDocente)."</td>
							<td>".form_dropdown('asignatura'.$aula->pk.'',$atributosAsignatura)."</td>
							<td> - </td>
							<td> - </td>
							<td> - </td>
							<td> - </td>
							<td><input type='checkbox' name='firma".$aula->pk."'></td>
                   			";
               }

                ?>    






					</tr>
				</tbody>
			</table>
		</div>			

		</div>
	</div>	
</div>
