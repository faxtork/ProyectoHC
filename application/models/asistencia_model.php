<?php 
class Asistencia_model extends CI_Model{
	public function docen($dato){
		$query=$this->db->query("select pk,nombres,apellidos from docentes where nombres LIKE '$dato%' OR apellidos LIKE '$dato%'");
		return $query->result();
	}
	public function totalAsistencia($fecha){
		$query=$this->db->query("select count(estado) as asistieron from reservas where estado=true and fecha='".$fecha."'");
		return $query->row();
	}
	public function totalNoAsistencia($fecha){
		$query=$this->db->query("select count(estado) as noasistieron from reservas where estado=false and fecha='".$fecha."'");
		return $query->row();
	}
	public function totalAsistenciaMes($fechaIni,$fechaFin){
		$query=$this->db->query("select count(estado) as asistieron from reservas where estado=true and fecha>='".$fechaIni."' AND fecha<'".$fechaFin."'");
		return $query->row();
	}
	public function totalAusenciaMes($fechaIni,$fechaFin){
		$query=$this->db->query("select count(estado) as noasistieron from reservas where estado=false and fecha>='".$fechaIni."' AND fecha<'".$fechaFin."'");
		return $query->row();
	}
	//********
		public function totalAsistenciaMes2($selectAnio){
			             date_default_timezone_set("America/Santiago");

		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($yearHoy==$selectAnio){
		 		for ($i=1; $i <$month ; $i++) { 
				$query[($i-1)]=$this->db->query("select count(estado) as asistieron from reservas where estado=true and fecha>='".$selectAnio."-".($i)."-01' AND fecha<'".$selectAnio."-".($i+1)."-01' ");
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				$query[($i-1)]=$this->db->query("select count(estado) as asistieron from reservas where estado=true and fecha>='".$selectAnio."-".($i)."-01' AND fecha<'".$selectAnio."-".($i+1)."-01' ");
					$respuesta[]=$query[($i-1)]->result();
				}

			$query[12]=$this->db->query("select count(estado) as asistieron from reservas where estado=true and fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01' ");
					$respuesta[]=$query[12]->result();
		 	}

				
			return $respuesta;
		}
		public function totalAusenciaMes2($selectAnio){
			             date_default_timezone_set("America/Santiago");

		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($yearHoy==$selectAnio){
		 		for ($i=1; $i <$month ; $i++) { 
				$query[($i-1)]=$this->db->query("select count(estado) as asistieron from reservas where estado=false and fecha>='".$selectAnio."-".($i)."-01' AND fecha<'".$selectAnio."-".($i+1)."-01' ");
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				$query[($i-1)]=$this->db->query("select count(estado) as asistieron from reservas where estado=false and fecha>='".$selectAnio."-".($i)."-01' AND fecha<'".$selectAnio."-".($i+1)."-01' ");
					$respuesta[]=$query[($i-1)]->result();
				}

						$query[12]=$this->db->query("select count(estado) as asistieron from reservas where estado=false and fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01' ");
					$respuesta[]=$query[12]->result();
		 	}

			return $respuesta;
		}
	//********
	public function getCampusName(){
		$query=$this->db->query("select pk,nombre from campus");
		return $query->result();
	}
	public function getFacultadName(){
		$query=$this->db->query("select pk,facultad from facultades");
		return $query->result();
	}
	public function getDptoPk($pk){
		$query=$this->db->query("select pk,departamento from departamentos WHERE facultad_fk='".$pk."' order by pk asc");
		return $query->result();
	}
	public function totalAsistenciaPorCampus($campusName,$fecha){//***************AFECTANO***************
		for ($i=0; $i <count($campusName) ; $i++) { 
			//$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha='".$fecha."' AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where nombre='".$campusName[$i]."')))");
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha='".$fecha."' AND adm_fk in (select pk from administrador where campus_fk in (select pk from campus where nombre='".$campusName[$i]."'))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalNoAsistenciaPorCampus($campusName,$fecha){//***************AFECTANO***************
		for ($i=0; $i <count($campusName) ; $i++) { 
			//$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha='".$fecha."' AND  sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where nombre='".$campusName[$i]."')))");
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha='".$fecha."' AND adm_fk in (select pk from administrador where campus_fk in (select pk from campus where nombre='".$campusName[$i]."'))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalAsistenciaPorCampusMes($selectAnio,$selectCampusPk){//***************AFECTANO***************
             date_default_timezone_set("America/Santiago");

		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");	
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");
					
					$respuesta[]=$query[($i-1)]->result();
				}
					//$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");
					$respuesta[]=$query[12]->result();
		 	}

		
		return $respuesta;
	}
	public function totalNoAsistenciaPorCampusMes($selectAnio,$selectCampusPk){//***************AFECTANO***************
		 
             date_default_timezone_set("America/Santiago");
		
		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");	
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");
					
					$respuesta[]=$query[($i-1)]->result();
				}
					//$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");
					$respuesta[]=$query[12]->result();
		 	}
		return $respuesta;
	}
	public function totalAsistenciaPorFacul($faculName,$fecha){//***************AFECTANO***************
		for ($i=0; $i <count($faculName) ; $i++) { 
			//$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND 
			//	fecha='".$fecha."' AND sala_fk in(select pk from salas where facultad_fk in(select pk
			//	 from facultades where facultad='".$faculName[$i]."'))");
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND 
				fecha='".$fecha."' AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk in(select pk
				 from facultades where facultad='".$faculName[$i]."'))))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalNoAsistenciaPorFacul($faculName,$fecha){//***************AFECTANO***************
		for ($i=0; $i <count($faculName) ; $i++) { 
			//$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha='".$fecha."' AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where facultad='".$faculName[$i]."'))");
						$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND 
				fecha='".$fecha."' AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk in(select pk
				 from facultades where facultad='".$faculName[$i]."'))))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalAsistenciaPorCampusAnio($yearIni,$yearFin,$selectCampusPk){//***************AFECTANO***************
		//$query=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
		$query=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");
		return $query->row();
	}
	public function totalNoAsistenciaPorCampusAnio($yearIni,$yearFin,$selectCampusPk){//***************AFECTANO***************
		//$query=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
		$query=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND adm_fk in(select pk from administrador where campus_fk='".$selectCampusPk."')");
		return $query->row();
	}



	public function totalAsistenciaPorFacultadMes($selectAnio,$selectFacultad){//***************AFECTANO***************
             date_default_timezone_set("America/Santiago");

		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
				
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
				
					$respuesta[]=$query[($i-1)]->result();
				}

					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
					$respuesta[]=$query[12]->result();
		 	}

		
		return $respuesta;
	}
	public function totalNoAsistenciaPorFacultadMes($selectAnio,$selectFacultad){//***************AFECTANO***************
		 
             date_default_timezone_set("America/Santiago");
		
		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
				
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
				
					$respuesta[]=$query[($i-1)]->result();
				}

					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
					$respuesta[]=$query[12]->result();
		 	}
		return $respuesta;
	}
	public function totalAsistenciaPorFacultadAnio($yearIni,$yearFin,$selectFacultad){//***************AFECTANO***************
		$query=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
		return $query->row();
	}
	public function totalNoAsistenciaPorFacultadAnio($yearIni,$yearFin,$selectFacultad){//***************AFECTANO***************
		$query=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk ='".$selectFacultad."')))");
		return $query->row();
	}
	public function totalAsistenciaPorDpto($dptoPk,$fecha){//***************AFECTANO***************
		for ($i=0; $i <count($dptoPk) ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND 
				fecha='".$fecha."' AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk='".$dptoPk[$i]."'))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalNoAsistenciaPorDpto($dptoPk,$fecha){//***************AFECTANO***************
		for ($i=0; $i <count($dptoPk) ; $i++) { 
			//$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha='".$fecha."' AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where facultad='".$faculName[$i]."'))");
						$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND 
				fecha='".$fecha."' AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk='".$dptoPk[$i]."'))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalAsistenciaPorDptoMes($selectAnio,$pkDpto){//***************AFECTANO***************
             date_default_timezone_set("America/Santiago");

		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$pkDpto."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$pkDpto."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}

					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$pkDpto."'))");
					$respuesta[]=$query[12]->result();
		 	}

		
		return $respuesta;
	}
	public function totalNoAsistenciaPorDptoMes($selectAnio,$pkDpto){//***************AFECTANO***************
		 
             date_default_timezone_set("America/Santiago");
		
		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$pkDpto."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$pkDpto."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}

					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$pkDpto."'))");
					$respuesta[]=$query[12]->result();
		 	}
		return $respuesta;
	}
	public function totalAsistenciaPorDptoAnio($yearIni,$yearFin,$dptoPk){//***************AFECTANO***************
	 	for ($i=0; $i <count($dptoPk) ; $i++) { 
		//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$dptoPk[$i]."'))");
		
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;	
	}
	public function totalNoAsistenciaPorDptoAnio($yearIni,$yearFin,$dptoPk){//***************AFECTANO***************
	 	for ($i=0; $i <count($dptoPk) ; $i++) { 
		//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND curso_fk in (select pk from cursos where asignatura_fk in (select pk from asignaturas where departamento_fk ='".$dptoPk[$i]."'))");
		
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;	
	}
	public function totalAsistenciaPorDocenteDia($fecha,$rut){
		$query=$this->db->query(" select count(estado) as cantidad from reservas where estado=true AND fecha='".$fecha."' AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
				return $query->row();
	}
		public function totalNoAsistenciaPorDocenteDia($fecha,$rut){
		$query=$this->db->query(" select count(estado) as cantidad from reservas where estado=false AND fecha='".$fecha."' AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
				return $query->row();
	}
	public function totalAsistenciaPorDocMes($selectAnio,$rut){//***************AFECTANO***************
             date_default_timezone_set("America/Santiago");

		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}

					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
					$respuesta[]=$query[12]->result();
		 	}

		
		return $respuesta;
	}
	public function totalNoAsistenciaPorDocMes($selectAnio,$rut){//***************AFECTANO***************
		 
             date_default_timezone_set("America/Santiago");
		
		 	$month=date('m');
		 	$yearHoy=date('Y');
		 	if($selectAnio==$yearHoy){//si es este mismo año hasta este mes
			 	for ($i=1; $i <$month ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}
		 	}else{
		 		for ($i=1; $i <12 ; $i++) { 
				//$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND sala_fk in(select pk from salas where facultad_fk ='".$selectFacultad."')");
				$query[($i-1)]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".$i."-01' AND fecha<'".$selectAnio."-".($i+1)."-01'  AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
				
					$respuesta[]=$query[($i-1)]->result();
				}

					$query[12]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
					$respuesta[]=$query[12]->result();
		 	}
		return $respuesta;
	}
	public function totalAsistenciaPorDocAnio($yearIni,$yearFin,$rut){//***************AFECTANO***************
		$query=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
		return $query->row();
	}
	public function totalNoAsistenciaPorDocAnio($yearIni,$yearFin,$rut){//***************AFECTANO***************
		$query=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$yearIni."' AND fecha<'".$yearFin."'  AND curso_fk in (select pk from cursos where docente_fk in (select pk from docentes where rut='".$rut."'))");
		return $query->row();
	}
	//**************aula***********
	public function totalAulaOcupada($fecha){
		$query=$this->db->query("select sala_fk from reservas where fecha='".$fecha."' and sala_fk in(select pk from salas where estado=true) group by sala_fk order by sala_fk asc");
		return $query->result();
	}
	public function cantSalasUtem(){
		$query=$this->db->query("select count(pk) as cantidad from salas where estado=true");
		return $query->row();
	}
	public function cantSalasUtemBloqueada(){
		$query=$this->db->query("select count(pk) as cantidad from salas where estado=false");
		return $query->row();
	}
	public function cantSalasUtemAsignadas($pkCampus){
		for ($i=0; $i <count($pkCampus) ; $i++) { 
			$query[$i]=$this->db->query("select sala_fk from reservas where curso_fk in(select pk from cursos where docente_fk in(select pk from docentes where departamento_fk in(select pk from departamentos where facultad_fk in(select pk from facultades where campus_fk='".$pkCampus[$i]."')))) group by sala_fk");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function cantSalasFaculAsignadas($pkFacultad){
		for ($i=0; $i <count($pkFacultad) ; $i++) { 
			$query[$i]=$this->db->query("select sala_fk from reservas where curso_fk in(select pk from cursos where docente_fk in(select pk from docentes where departamento_fk in(select pk from departamentos where facultad_fk ='".$pkFacultad[$i]."'))) group by sala_fk");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function cantSalasCampus($pkCampus){
		for ($i=0; $i <count($pkCampus) ; $i++) { 
			$query[$i]=$this->db->query("select count(pk) as cantidad from salas where estado=true AND campus_fk ='".$pkCampus[$i]."'");
			$respuesta[]=$query[$i]->row();
		}
		return $respuesta;
	}
	public function cantSalasCampusBloqueada($pkCampus){
		for ($i=0; $i <count($pkCampus) ; $i++) { 
			$query[$i]=$this->db->query("select count(pk) as cantidad from salas where estado=false AND campus_fk ='".$pkCampus[$i]."'");
			$respuesta[]=$query[$i]->row();
		}
		return $respuesta;
	}
	public function cantSalasFacultad($pkFacultad){
		for ($i=0; $i <count($pkFacultad) ; $i++) { 
			$query[$i]=$this->db->query("select count(pk) as cantidad from salas where estado=true and campus_fk in (select campus_fk from facultades where pk='".$pkFacultad[$i]."')");
			$respuesta[]=$query[$i]->row();
		}
		return $respuesta;
	}
	public function cantSalasFacultadBloqueada($pkFacultad){
		for ($i=0; $i <count($pkFacultad) ; $i++) { 
			$query[$i]=$this->db->query("select count(pk) as cantidad from salas where estado=false AND campus_fk in (select campus_fk from facultades where pk='".$pkFacultad[$i]."')");
			$respuesta[]=$query[$i]->row();
		}
		return $respuesta;
	}
	public function cantSalasDptoAsignadas($pkDpto){
		for ($i=0; $i <count($pkFacultad) ; $i++) { 
			$query[$i]=$this->db->query("select sala_fk from reservas where curso_fk in(select pk from cursos where docente_fk in(select pk from docentes where departamento_fk ='".$pkDpto[$i]."')) group by sala_fk");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function cantSalasDepartamento($pkDpto){
		for ($i=0; $i <count($pkFacultad) ; $i++) { 
			$query[$i]=$this->db->query("select count(pk) as cantidad from salas where estado=true and campus_fk in (select campus_fk from facultades where pk='".$pkFacultad[$i]."')");
			$respuesta[]=$query[$i]->row();
		}
		return $respuesta;
	}
}
?>