<div class="well">		
	<div class="row-fluid">
		<div class="span12">
			<h3>Bienvenido<?php 
				echo " Administrador General: ".$_SESSION['adminGeneral'];
			 ?></h3><h5 class="muted">¿ Que Deseas hacer ?</h5>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="btn-group">
			   <a class="btn btn-default btn-lg" href="<?= site_url('admin/users');?>">Usuarios administradores</a>
			   <a class="btn btn-default btn-lg" href="<?= site_url('admin/config');?>">Configuraciones</a>
			</div>
		</div>
	</div>
    <br>
<!--     <button class="btn btn-warning" onclick="location.href='<?= site_url('intranet/desconectar') ?>'" >desconectar</button>
 --></div>

		

