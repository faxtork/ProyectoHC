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
<?php 
$rango=false;
$bienvenido=0;
	if (@$_GET['per']==NULL) {
		$bienvenido=1; 
	}else{
		    foreach ($periodos as $peri) {
	      	if($peri->periodo==$_GET['per'])
	      	{
	      		$rango=true; 
	      		break;
	      	}
	    }	
	} 
 ?>
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
						echo "<li><a class='active' type='submit' href='".site_url('intranet/academico/?per='.$peri->periodo.'')."'>".$peri->periodo."<br /> (".$inicio." - ".$termino.")"."</a></li>
								";
					}
				 ?>
				
			</ul>
		</div>
	</div>
	<br>
	<div class="row-fluid">
		<div class="span12">
				<?php 
			if ($rango==true) {
				?>
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
			                    foreach ($salas as $aula) {
			                    	echo "<tr style='text-align:center;'>
										<td>".$aula->sala."</td>
										<td>".form_dropdown('docente'.$aula->pk.'',$atributosDocente)."</td>
										<td>".form_dropdown('asignatura'.$aula->pk.'',$atributosAsignatura)."</td>
										<td><input type='text' name='s".$aula->pk."' size='4' maxlength='5'></td>
										<td><input type='text' name='c".$aula->pk."' size='6' maxlength='7'></td>
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
				<?php
			}elseif ($bienvenido==1) {
					echo "<h1>Bienvenido </h1><h4>al sistema de asignacion semestral</h4>
						Elija un periodo para comenzar a agregar datos";
			}else{
				echo '  <script type="text/javascript">
  						window.location="'.site_url('intranet/academico/').'";</script>';
				}
				 ?>
		</div>
	</div>	
</div>
