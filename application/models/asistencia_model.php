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
		$query=$this->db->query("select count(estado) as noasistieron from reservas where estado=false and fecha>='".$fechaIni."'  AND fecha<'".$fechaFin."'");
		return $query->row();
	}
	public function getCampusName(){
		$query=$this->db->query("select nombre from campus");
		return $query->result();
	}
	public function totalAsistenciaPorCampus($campusName){
		for ($i=0; $i <count($campusName) ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=true AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where nombre='".$campusName[$i]."')))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
		
	}
	public function totalNoAsistenciaPorCampus($campusName){
		for ($i=0; $i <count($campusName) ; $i++) { 
			$query[$i]=$this->db->query("select count(estado) as cantidad from reservas where estado=false AND sala_fk in(select pk from salas where facultad_fk in(select pk from facultades where campus_fk in (select pk from campus where nombre='".$campusName[$i]."')))");
			$respuesta[]=$query[$i]->result();
		}
		return $respuesta;
	}
}
?>