	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span3"><div class="well">
								<ul class="nav nav-pills nav-stacked">
									<li class="nav-header"><h3>Configuraciones</h3></li>
									<li class=""><a href="<?= site_url('intranet/editFacultades');?>">Facultades</a></li>
									<li><a href="<?= site_url('intranet/editSalas');?>">Salas</a></li>
									<li><a href="<?= site_url('intranet/editDepartamentos');?>">Departamentos</a></li>
									<li><a href="<?= site_url('intranet/editEscuelas');?>">Escuelas</a></li>
									<li><a href="<?= site_url('intranet/editAsignaturas');?>">Asignaturas</a></li>
									<li><a href="<?= site_url('intranet/editDocnetes');?>">Docentes</a></li>
									<li><a href="<?= site_url('intranet/editPeriodos');?>">Periodos</a></li>
								</ul>
								
								<!--
								<ul class="nav nav-pills nav-stacked">
								 <li class="nav-header"><h3>Configuraciones</h3></li>
									<li class="dropdown">
										<a href="<?= site_url('intranet/editFacultades');?>">Facultades</a>
									</li>
					                <li class="dropdown" >
							            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
							                Salas <span class="caret"></span>
							            </a>
							    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
							    		 <li><a href="#"><b>Navega para tu eleccion</b></a></li>
							              <li class="divider"></li>
							              <li class="dropdown-submenu">
							                <a tabindex="-1" href="#">Facultad</a>
							                <ul class="dropdown-menu">
								            	<?php foreach ($facultades as $facu){ 
									            		echo' <li><a href="'.site_url('intranet/editSalas').'/">'.$facu->facultad.'</a></li>';
									            	}?>
							                </ul>
							              </li>
							            </ul>
							        </li>
							        <li class="dropdown">
							            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
							                Departamentos <span class="caret"></span>
							            </a>
							    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
							    		 <li><a href="#"><b>Navega para tu eleccion</b></a></li>
							              <li class="divider"></li>
							              <li class="dropdown-submenu">
							                <a tabindex="-1" href="#">Facultad</a>
							                <ul class="dropdown-menu">
								            	<?php foreach ($facultades as $facu){ 
									            		echo' <li><a href="#">'.$facu->facultad.'</a></li>';
									            	}?>
							                </ul>
							              </li>
							            </ul>
							        </li>
							        <li class="dropdown">
							            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
							                Escuela <span class="caret"></span>
							            </a>
							    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
							    		 <li><a href="#"><b>Navega para tu eleccion</b></a></li>
							              <li class="divider"></li>
							              <li class="dropdown-submenu">
							                <a tabindex="-1" href="#">Facultad</a>
							                <ul class="dropdown-menu">
								            	<?php foreach ($facultades as $facu){ 
									            		echo' <li><a href="#">'.$facu->facultad.'</a></li>';
									            	}?>
							                </ul>
							              </li>
							            </ul>
							        </li>
							        <li class="dropdown">
							            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
							                Asignatura <span class="caret"></span>
							            </a>
							    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
							    		 <li><a href="#"><b>Navega para tu eleccion</b></a></li>
							              <li class="divider"></li>
							              <li class="dropdown-submenu">
							                <a tabindex="-1" href="#">Facultad</a>
							                <ul class="dropdown-menu">
								            	<?php foreach ($facultades as $facu){ 
									            		echo' <li><a href="#">'.$facu->facultad.'</a></li>';
									            	}?>
							                </ul>
							              </li>
							            </ul>
							        </li>	
							        <li class="dropdown">
							            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
							                Docentes <span class="caret"></span>
							            </a>
							    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
							    		 <li><a href="#"><b>Navega para tu eleccion</b></a></li>
							              <li class="divider"></li>
							              <li class="dropdown-submenu">
							                <a tabindex="-1" href="#">Facultad</a>
							                <ul class="dropdown-menu">
								            	<?php foreach ($facultades as $facu){ 
									            		echo' <li><a href="#">'.$facu->facultad.'</a></li>';
									            	}?>
							                </ul>
							              </li>
							            </ul>
							        </li>
							        <li  class="dropdown"><a href="<?= site_url('intranet/editPeriodos');?>">Periodos</a></li>
							    </ul>	-->				
				</div> </div>

	



