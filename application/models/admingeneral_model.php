 <?php

   class Admingeneral_model extends CI_Model{

       function __construct() {
           parent::__construct();
       }
    public function extraerPkAdmin($nombre){
    	 $query=$this->db->query("SELECT pk FROM administradorgeneral WHERE nombre='$nombre'");
    	 return $query->row();
    }
    public function crearUser($pkAdmin,$user,$pass,$contacto,$rut,$campus,$descripGrado){
    	$query=$this->db->query("INSERT INTO administrador VALUES(DEFAULT,'".$user."','".$pass."','".$contacto."','".$rut."','".$pkAdmin."','".$campus."','".$descripGrado."')");
    	return $query;
    }
    public function crearUser2($user,$clave,$contacto,$rut,$pkAdmin,$descripGrado){
        $query=$this->db->query("INSERT INTO administradorgeneral VALUES(DEFAULT,'".$user."','".$clave."','".$contacto."','".$rut."','".$descripGrado."','".$pkAdmin."')");
        return $query;
    }
    public function getUsers(){
    	$query=$this->db->query("SELECT nombre FROM administrador");
    	return $query->result();
    }
    public function getDatosUsers($pkk){
    	    	$query=$this->db->query("SELECT ad.pk,ad.nombre as nom,ad.rut,ad.descripcion,ca.nombre,administradorgeneral_fk FROM administrador as ad,campus as ca WHERE ad.administradorgeneral_fk='".$pkk."' and ad.campus_fk=ca.pk ORDER BY ad.pk ASC");
    	return $query->result();
    }
    public function getDatosUsersGeneral($pkk){
                $query=$this->db->query("SELECT pk,nombre,rut,descripcion FROM administradorgeneral WHERE administradorgeneral_fk='".$pkk."' ORDER BY pk ASC");
        return $query->result();
    }

    public function eliminarPedido($pkPedido) {
        $this->db->delete('administrador',array('pk'=>$pkPedido));
         return true;             
    }
    public function getDatosUsers2($pkEdit){
    		$query=$this->db->query("SELECT pk,nombre,contacto FROM administrador WHERE pk='".$pkEdit."'");
    	return $query->row();
    }
    public function getDatosUsers2G($pkEdit){
            $query=$this->db->query("SELECT pk,nombre,contacto FROM administradorgeneral WHERE pk='".$pkEdit."'");
        return $query->row();
    }
    public function UpdateUser($pkAdmin,$user,$clave,$contacto){
    	$query=$this->db->query("UPDATE administrador SET nombre='".$user."',clave='".$clave."',contacto='".$contacto."' WHERE pk='".$pkAdmin."'");
    	 return true;
    }
    public function UpdateUser2($pkAdmin,$user,$contacto){
    	    	$query=$this->db->query("UPDATE administrador SET nombre='".$user."',contacto='".$contacto."' WHERE pk='".$pkAdmin."'");
    	 return true;
    }
    public function UpdateUserG($pkAdmin,$user,$clave,$contacto){
        $query=$this->db->query("UPDATE administradorgeneral SET nombre='".$user."',clave='".$clave."',contacto='".$contacto."' WHERE pk='".$pkAdmin."'");
         return true;
    }
    public function UpdateUser2G($pkAdmin,$user,$contacto){
                $query=$this->db->query("UPDATE administradorgeneral SET nombre='".$user."',contacto='".$contacto."' WHERE pk='".$pkAdmin."'");
         return true;
    }
    public function getDptoPorFacu($facu){
            $query=$this->db->query("SELECT pk,departamento FROM departamentos WHERE facultad_fk='".$facu."' ORDER BY pk ASC");
        return $query->result();
    }
    public function getFacultadName($pk){
            $query=$this->db->query("select pk,facultad from facultades where pk='".$pk."' order by pk asc;");
            return $query->result();        
    }
    public function getDptoName($pk){
            $query=$this->db->query("select pk,departamento from departamentos where pk='".$pk."' order by pk asc;");
            return $query->result();          
    }
    public function agregarDpto($addAsigName,$addAsigDesc,$pkFacu){
            $query=$this->db->query("INSERT INTO departamentos VALUES(DEFAULT,'".$pkFacu."','".$addAsigName."','".$addAsigDesc."')");
            return $query;
    }
    public function getDptoEdit($pk){
        for ($i=0; $i <count($pk) ; $i++) { 
             $query[$i]=$this->db->query("SELECT pk,departamento FROM departamentos where pk=".$pk[$i]." ");
            $query[$i]=$query[$i]->result();
        }
         return $query; 
    }
    public function updateDepartamento($pk,$newName){
             for ($i=0; $i <count($pk) ; $i++) { 
                    $query[]=$this->db->query("UPDATE departamentos SET departamento='".$newName[$i]."' WHERE pk='".$pk[$i]."'"); 
            }
                return $query;        
    }
    public function eliminarDpto($accion){
        for ($i=0; $i <count($accion) ; $i++) { 
            $query[]=$this->db->query("DELETE FROM departamentos WHERE pk=".$accion[$i]."");
        }
        return $query;
    }
    public function getEscuPorDpto($dpto){
        $query=$this->db->query("SELECT pk,escuela FROM escuelas WHERE departamento_fk='".$dpto."' ORDER BY pk ASC");
        return $query->result();        
    }
    public function agregarEscu($addEscuName,$addEscuDesc,$pkDpto){
        $query=$this->db->query("INSERT INTO escuelas VALUES(DEFAULT,'".$pkDpto."','".$addEscuName."','".$addEscuDesc."')");
        return $query;            
    }
    public function getEscuEdit($pk){
        for ($i=0; $i <count($pk) ; $i++) { 
             $query[$i]=$this->db->query("SELECT pk,escuela FROM escuelas where pk=".$pk[$i]." ");
            $query[$i]=$query[$i]->result();
        }
         return $query; 
    }
    public function updateEscuelas($pk,$newName){
             for ($i=0; $i <count($pk) ; $i++) { 
                    $query[]=$this->db->query("UPDATE escuelas SET escuela='".$newName[$i]."' WHERE pk='".$pk[$i]."'"); 
            }
                return $query;        
    }
    public function eliminarEscu($accion){
        for ($i=0; $i <count($accion) ; $i++) { 
            $query[]=$this->db->query("DELETE FROM escuelas WHERE pk=".$accion[$i]."");
        }
        return $query;
    }               
}
?>