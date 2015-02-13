<div class="well">		
	<div class="row-fluid">
		<div class="span12">
			<h3>Bienvenido<?php 
			if(isset($_SESSION['usuarioAdmin'])){
				echo ": ".$_SESSION['usuarioAdmin'];echo "<br/>";echo "</h3><p>Administrador para el Campus: <b>".$_SESSION['nombreCampus']."</b></p><h3>";
			}else{
				echo " Administrador General: ".$_SESSION['adminGeneral'];
			}
			

			 ?></h3><h5 class="muted">¿ Que Deseas hacer ?</h5>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="btn-group">
			    <a class="btn btn-default btn-lg" href="<?= site_url('intranet/academico');?>">Asignación Semestre</a>
			    <a class="btn btn-default btn-lg" href="<?= site_url('intranet/salas');?>">Petición Docentes</a>
			   <a class="btn btn-default btn-lg" href="<?= site_url('intranet/reservas');?>">Reservas</a>
			   <a class="btn btn-default btn-lg" href="<?= site_url('intranet/planilla');?>">Planilla</a>
			   <a class="btn btn-default btn-lg" href="<?= site_url('intranet/config');?>">Configuraciones</a>
			</div>
		</div>
	</div>
    <br>
<!--     <button class="btn btn-warning" onclick="location.href='<?= site_url('intranet/desconectar') ?>'" >desconectar</button>
 --></div>

		

