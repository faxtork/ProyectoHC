<?php 
class Asistencia_model extends CI_Model{
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
			
			for ($i=0; $i <11 ; $i++) { 


					$query[$i]=$this->db->query("select count(estado) as asistieron from reservas where estado=true and fecha>='".$selectAnio."-".($i+1)."-01' AND fecha<'".$selectAnio."-".($i+2)."-01' ");
					$respuesta[$i]=$query[$i]->result();
				
			}

			$query[11]=$this->db->query("select count(estado) as asistieron from reservas where estado=true and fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01' ");
					$respuesta[]=$query[11]->result();
				
			return $respuesta;
		}
		public function totalAusenciaMes2($selectAnio){
			for ($i=0; $i <11 ; $i++) { 
				$query[$i]=$this->db->query("select count(estado) as asistieron from reservas where estado=false and fecha>='".$selectAnio."-".($i+1)."-01' AND fecha<'".$selectAnio."-".($i+2)."-01' ");
				$respuesta[$i]=$query[$i]->result();
			}
						$query[11]=$this->db->query("select count(estado) as asistieron from reservas where estado=false and fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01' ");
					$respuesta[]=$query[11]->result();
			return $respuesta;
		}
	//********
	public function getCampusName(){
		$query=$this->db->query("select pk,nombre from campus");
		return $query->result();
	}
	public function getFacultadName(){
		$query=$this->db->query("select facultad from facultades");
		return $query->result();
	}
	public function totalAsistenciaPorCampus($campusName,$fecha){
		for ($i=0; $i <count($campusName) ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha='".$fecha."' AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where nombre='".$campusName[$i]."')))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalNoAsistenciaPorCampus($campusName,$fecha){
		for ($i=0; $i <count($campusName) ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha='".$fecha."' AND  sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where nombre='".$campusName[$i]."')))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalAsistenciaPorCampusMes($selectAnio,$selectCampusPk){
		 
			for ($i=0; $i <11 ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-".($i+1)."-01' AND fecha<'".$selectAnio."-".($i+2)."-01'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
				$respuesta[$i]=$query[$i]->result();
			}

					$query[11]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
					$respuesta[]=$query[11]->result();
		
		return $respuesta;
	}
	public function totalNoAsistenciaPorCampusMes($selectAnio,$selectCampusPk){
		 
			for ($i=0; $i <11 ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-".($i+1)."-01' AND fecha<'".$selectAnio."-".($i+2)."-01'  AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
				$respuesta[$i]=$query[$i]->result();
			}
			
					$query[11]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha>='".$selectAnio."-12-01' AND fecha<'".($selectAnio+1)."-01-01'   AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where pk='".$selectCampusPk."')))");
					$respuesta[]=$query[11]->result();
		
		return $respuesta;
		
	}
	public function totalAsistenciaPorFacul($faculName,$fecha){
		for ($i=0; $i <count($faculName) ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND 
				fecha='".$fecha."' AND sala_fk in(select pk from salas where facultad_fk in(select pk
				 from facultades where facultad='".$faculName[$i]."'))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
	public function totalNoAsistenciaPorFacul($faculName,$fecha){
		for ($i=0; $i <count($faculName) ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND fecha='".$fecha."' AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where facultad='".$faculName[$i]."'))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
}
?>