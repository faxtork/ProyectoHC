<?php

   class Admin_model extends CI_Model{

       function __construct() {
           parent::__construct();
       }
    
     public function loguearAdmin($nombre, $clave) {
        $where = array("nombre" => $nombre, "clave" => $clave);
        $query = $this->db
                ->select('*')
                ->from('administrador')
                ->where($where)
                ->get();
        return $query->row();
     }
          public function loguearAdmin2($nombre, $clave) {
        $where = array("nombre" => $nombre, "clave" => $clave);
        $query = $this->db
                ->select('*')
                ->from('administradorgeneral')
                ->where($where)
                ->get();
        return $query->row();
     }
     public function getAsignatura(){
            $query=$this->db
                ->select('pk,codigo,nombre')
                ->from('asignaturas')
                ->get();
        return $query->result();
     }
    public function getAsignaturaXCampus($campusPk){
            $query=$this->db->query("select pk,nombre,codigo from asignaturas where departamento_fk in(select pk from departamentos where facultad_fk in(select pk from facultades where campus_fk ='".$campusPk."'))");
        return $query->result();
     }
     public function setAcademico($datos){
        $this->db->insert('docentes',$datos);
            return true;
     }
     public function asocia($datos){
        $this->db->insert('cursos',$datos);
         return true;
     }
     public function getSala(){
        $cond=array('estado'=>'true');
      $query=$this->db
            ->select('pk,sala')
            ->from('salas')
             ->where($cond)
            ->order_by('pk','asc')
            ->get();
        return $query->result();  
     }
      public function getPeriodo(){
      $query=$this->db
            ->select('pk,periodo,inicio,termino')
            ->from('periodos')
            ->order_by('pk','asc')
            ->get();
        return $query->result();  
     }
     public function setSala($datos){
              $this->db->insert('salas',$datos);
         return true;
     }
     public function pkCurso($pk){
        $cond=array('docente_fk'=>$pk);
        $query=$this->db
                    ->select('MAX(pk) as pk')
                    ->from ('cursos')
                    ->where($cond)
                    ->get();
        return $query->row(); 
     }
     public function getCursos(){
            $query=$this->db
                    ->select('pk,asignatura_fk,docente_fk,seccion')
                    ->from ('cursos')
                    ->get();
        return $query->result(); 
     }
     public function setReserva($datos){
                $this->db->insert('reservas',$datos);
         return true;
     }
     public function resultadosGral(){
            $query=$this->db
                ->select('r.pk,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->order_by('r.periodo_fk','asc')
                ->get();
        return $query->result();
     }
    public function delete($id){
            $this->db->delete('reservas', array('pk' => $id));
            return true;
     }
     public function getReservas($pk){
            $condicion=array('r.pk'=>$pk);
              $query=$this->db
                ->select('r.curso_fk,sala_fk,r.periodo_fk,r.pk,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->where($condicion)
                ->get();
        return $query->row();
       
     }
     public function edit($id){
            $query = $this->db
                ->select("pk,sala_fk,rut,contacto")
                ->from("reservas")
                ->where(array('pk' =>$id))
                ->get ();
                return $query->row();
     }
        public function AsignarPorTiempo($fechaInicio,$fechaTermino,$periodo_fk,$diaElegido,$sala_fk,$maxPkCursos,$adm_fk){
            date_default_timezone_set("America/Santiago");
            $fechaIni=strtotime($fechaInicio);
            $fechaFin=strtotime($fechaTermino);

            for($i=$fechaIni; $i<=$fechaFin; $i+=86400){//recorre cada dia del inicio hasta el fin
                    $fecha=date("Y-m-d", $i);
                    $dia=date("w", strtotime($fecha));//saca el dia en cada recorrido
                    for ($j=0; $j <count($diaElegido) ; $j++) { 
                        if($dia==$diaElegido[$j]){
                                    $data = array(
                                       'fecha' => "$fecha",
                                       'sala_fk' => $sala_fk,
                                       'periodo_fk' => $periodo_fk[$j],
                                       'curso_fk' => $maxPkCursos->maxpk,
                                       'adm_fk' =>$adm_fk->pk,);
                                    $this->db->insert('reservas', $data); 
                        }
                    }
                }
            return true;
        }        
        public function getTodosPedidos($campus) {
                  date_default_timezone_set("America/Santiago");
          $fechaHoy=date("Y-m-d");//solo muestra los datos de aqui en adelante
         $query=$this->db
              ->query("SELECT r.pk,r.fecha,s.sala,s.pk AS pksala,d.nombres AS nombredocente,d.apellidos AS apellidodocente,d.pk AS pkdocente,a.nombre AS asignatura,a.pk AS pkasignatura,p.periodo,p.pk AS pkperiodo 
                    FROM administrador as ad,reservas as r,salas as s,docentes as d,cursos as c,asignaturas as a,periodos as p WHERE 
                    r.adm_fk is NULL and
                    s.pk=r.sala_fk and 
                    c.pk=r.curso_fk and 
                    p.pk=r.periodo_fk and 
                    d.pk=c.docente_fk and 
                    a.pk=c.asignatura_fk  and
                    ad.campus_fk='$campus'
                    AND  r.fecha>='$fechaHoy'
                    ORDER BY pk DESC");
       return $query->result();
     }
     public function comprobarReserva($pkPedido,$fecha,$periodo,$sala){
        $query=$this->db->query("select * from reservas where  pk!='".$pkPedido."'and fecha='".$fecha."' and sala_fk='".$sala."' and periodo_fk='".$periodo."' ");
        return $query->num_rows();
     }
    public function editarReserva($semestre,$anio,$pkPedido,$pkdocente,$pkAsignatura,$seccion,$fecha,$periodo,$pkSala) {
        $this->db->query("update cursos set asignatura_fk='$pkAsignatura', docente_fk='$pkdocente',seccion='$seccion' where pk=(SELECT curso_fk FROM reservas WHERE pk='$pkPedido')");
        //update de la tabla cursos y ahora reserva
         $this->db->//falta adm_fk
                 query("UPDATE reservas  SET "
                       ."sala_fk='$pkSala', "
                       ."periodo_fk=(SELECT pk FROM periodos WHERE periodo='$periodo'), "
                       ."curso_fk= (SELECT pk FROM cursos WHERE pk=(select curso_fk from reservas where pk='$pkPedido')) ,"
                       . "fecha='$fecha' "
                       ." WHERE pk=$pkPedido");
         return true;
         
     }
     public function aprobarReserva($pkPedido,$adm) {
         
         $query=  $this->db->query("UPDATE reservas"
                 . " SET adm_fk=".$adm." "
                 . "WHERE pk=".$pkPedido."");   
         return true;
     }
     public function  fkAdminn($adm){
        $query=$this->db->query("SELECT pk FROM administrador WHERE rut='".$adm."' limit 1");
        return $query->row();
     }
     public function registrar($pkPedido,$fkAdm){
                          date_default_timezone_set("America/Santiago");
          $fechaHoy=date("Y-m-d");//solo muestra los datos de aqui en adelante
        $query=$this->db->query("INSERT INTO bitacora VALUES('".$pkPedido."','','".$fechaHoy."','".$fkAdm."')");
        return  $query;
     }
     public function pedidoEstado($pkAdm){
                                  date_default_timezone_set("America/Santiago");
          $fechaHoy=date("Y-m-d");//solo muestra los datos de aqui en adelante
        $query=$this->db->query("select pk from bitacora where administrador_fk='".$pkAdm."' AND fecha=>'".$fechaHoy."'");
        return $query->result();
     }
     public  function extraePediXPk($pkPedidos,$campus){
        date_default_timezone_set("America/Santiago");
          $fechaHoy=date("Y-m-d");//solo muestra los datos de aqui en adelante

        for ($i=0; $i <count($pkPedidos) ; $i++) { 
             $query[$i]=$this->db
              ->query("SELECT r.pk,r.fecha,s.sala,s.pk AS pksala,d.nombres AS nombredocente,d.apellidos AS apellidodocente,d.pk AS pkdocente,a.nombre AS asignatura,a.pk AS pkasignatura,p.periodo,p.pk AS pkperiodo 
                    FROM administrador as ad,reservas as r,salas as s,docentes as d,cursos as c,asignaturas as a,periodos as p WHERE 
                    r.pk='".$pkPedidos[$i]."' and
                    s.pk=r.sala_fk and 
                    c.pk=r.curso_fk and 
                    p.pk=r.periodo_fk and 
                    d.pk=c.docente_fk and 
                    a.pk=c.asignatura_fk  and
                    ad.campus_fk='$campus'
                    AND  r.fecha>='$fechaHoy'
                    ORDER BY pk DESC");
              $query[$i]=$query[$i]->result();
        }
        return $query;

     }
     public function eliminarPedido($pkPedido) {
         
        $this->db->delete('reservas',array('pk'=>$pkPedido));
         return true;
                 
     }
     
     public function getReserva() {
         date_default_timezone_set("America/Santiago");
          $fechaHoy=date("Y-m-d");//solo muestra los datos de aqui en adelante
          $campus=$_SESSION['campus'];
         $query=$this->db
                ->query("SELECT c.seccion,a.codigo,r.pk,r.fecha,s.sala,s.pk AS pksala,d.nombres AS nombredocente,d.apellidos AS apellidodocente,d.pk AS pkdocente,a.nombre AS asignatura,a.pk AS pkasignatura,c.seccion,p.periodo,p.pk AS pkperiodo, c.anio AS anio,c.semestre AS semestre
                     FROM administrador as ad,reservas as r,salas as s,docentes as d,cursos as c,asignaturas as a,periodos as p WHERE
                    r.adm_fk is not NULL and
                    s.pk=r.sala_fk and
                    c.pk=r.curso_fk and
                    p.pk=r.periodo_fk and
                    d.pk=c.docente_fk and
                    a.pk=c.asignatura_fk and
                    r.adm_fk=ad.pk and
                    ad.campus_fk='$campus'

                    AND  r.fecha>='$fechaHoy'
                    ORDER BY r.fecha asc");
        return $query->result();
     }
     
     

     
     public function getPkDocente($pkDocente) {
         $query=$this->db->query("SELECT * FROM docentes WHERE pk=$pkDocente ");
         return $query->row();
     }
      
     public function getSeccionDeAsignaturaDocente($pkDocente,$pkAsignatura) {
         $query=$this->db
                 ->query("SELECT seccion FROM cursos WHERE docente_fk=$pkDocente AND asignatura_fk=$pkAsignatura group by seccion;");
         return $query->result();
     }

    public function getFacultad(){
        $query=$this->db
            ->select('*')
            ->from('facultades')
            ->order_by('pk','asc')
            ->get();
        return $query->result();
         }
    public function getCampus(){
    $query=$this->db
        ->select('pk,nombre,descripcion')
        ->from('campus')
        ->order_by('pk','asc')
        ->get();
    return $query->result();
     }     
          /*public function salas($facultadPk){//***************AFECTA***************
            $query=$this->db
            ->query("SELECT pk,sala,estado,descripcion FROM salas WHERE facultad_fk=$facultadPk order by pk asc;");
            return $query->result();
            } */
            //***************AFECTANO***************
    public function salasAsignacion($semestre,$ano,$campusPk,$periodo,$diaIni,$diaFin,$diaElegido){// muestra las bloqueadas y las que estan ocupadas
            date_default_timezone_set("America/Santiago");
            $fechaIni=strtotime($diaIni);
            $fechaFin=strtotime($diaFin);
            $bool=false;
            $query=array();
            for($i=$fechaIni; $i<=$fechaFin; $i+=86400){//recorre cada dia del inicio hasta el fin
                    $fecha=date("Y-m-d", $i);
                    $dia=date("w", strtotime($fecha));//saca el dia en cada recorrido
                    for ($j=0; $j <count($diaElegido) ; $j++) { 
                        if($dia==$diaElegido[$j]){//una vez que coincidan pregunta si esta ocupada en la tabla de la DB
                            for ($z=0; $z <count($periodo) ; $z++) { 
                                //$query[$j]=$this->db->query("SELECT pk,sala FROM salas WHERE facultad_fk='".$facultadPk."' AND pk in (select sala_fk from reservas where periodo_fk='".$periodo[$z]."'  and fecha='".$fecha."') order by pk asc;");
   //retorna solamente las salas ocupadas
                                $query[$j]=$this->db->query("SELECT pk,sala,descripcion FROM salas WHERE campus_fk='".$campusPk."' AND pk in (select sala_fk from reservas where periodo_fk='".$periodo[$z]."'  and fecha='".$fecha."'  AND curso_fk in( SELECT pk FROM cursos WHERE anio='".$ano."' AND semestre='".$semestre."')) order by pk asc;");
                                $query[$j]=$query[$j]->result();
                            }       
                        }
                    }
                }

        if(count($query)==0){//si es true quiere decir que deve retornar todas las salas habiles
             return false;
        }

         return $query;
    } 
    /*public function bloqueadaAula($facultadPk){//***************AFECTA***************NOSEOCUPA
        $query=$this->db
        ->query("SELECT pk,sala FROM salas WHERE facultad_fk='".$facultadPk."' AND estado=false order by pk asc;");
         return $query->result();
    }*/
    public function docIn($pkOcupada){
        for ($i=0; $i <count($pkOcupada) ; $i++) { 
            $query[$i]=$this->db->query("select pk from docentes where pk in(select docente_fk from cursos where pk in (select curso_fk from reservas where sala_fk='".$pkOcupada[$i]."'))");
            $query[$i]=$query[$i]->result();
        }
        return $query;
    }//***************AFECTA***************NO
    public function getSalaCampus($campusPk){//todas las salas menos las bloqueadas
        $query=$this->db
            ->query("SELECT pk,sala,descripcion FROM salas WHERE campus_fk='".$campusPk."' AND estado=true order by pk asc;");
         return $query->result();
    }
    public function getSalaCampus2($campusPk){//todas las salas menos las bloqueadas
        $query=$this->db
            ->query("SELECT pk,sala,descripcion FROM salas WHERE campus_fk='".$campusPk."' order by pk asc;");
         return $query->result();
    }
    public function depa($facultadPk){
            $query=$this->db
                 ->query("SELECT pk,departamento FROM departamentos WHERE facultad_fk=$facultadPk order by pk asc;");
         return $query->result();
    }
    public function asig($campusPk){
            $query=$this->db
                 ->query("SELECT pk, codigo, nombre FROM asignaturas WHERE departamento_fk in(SELECT pk FROM departamentos where facultad_fk in (SELECT pk from facultades where campus_fk='".$campusPk."')) order by nombre asc");
                  //  ->query("SELECT pk,codigo FROM asignaturas order by pk asc");
         return $query->result();
    }
    public function doc($facultadPk){
            $query=$this->db
                 ->query("select pk,nombres,apellidos from docentes where departamento_fk in (select pk from departamentos where facultad_fk in (select pk from facultades where pk='".$facultadPk."')) order by nombres asc");
            return $query->result();
    }
        public function docXdepa($depaFk){
            $query=$this->db
                 ->query("select pk,nombres,apellidos from docentes where departamento_fk='".$depaFk."' order by nombres asc");
            return $query->result();
    }          
    public function pkAdmin($nombreAdm){
            $query=$this->db
                ->query("SELECT pk FROM administrador WHERE nombre='$nombreAdm';");
            return $query->row();    
    }
    public function maxPkCurso(){
            $query=$this->db
                ->query("SELECT max(pk) as maxPk FROM cursos;");//laultima pk ingresada
            return $query->row(); 
    }
    public function fechaReservas(){
            $query=$this->db
                ->query("SELECT fecha,periodo_fk,sala_fk FROM reservas;");
            return $query->result();
    }
    public function getSalaExcp($pk){
            $query=$this->db
                ->query("SELECT pk,sala FROM salas where pk!=$pk AND estado=true ");
            return $query->result();
    }
    public function eliminarFacultad($accion){
        for ($i=0; $i <count($accion) ; $i++) { 
            $query[]=$this->db->query("DELETE FROM facultades WHERE pk=".$accion[$i]."");
            
        }
        return $query;
    }
    public function getFacultadPk($pk){
        for ($i=0; $i <count($pk) ; $i++) { 
             $query[$i]=$this->db->query("SELECT pk,facultad,descripcion FROM facultades where pk=".$pk[$i]."");
            $query[$i]=$query[$i]->result();
        }
        
             return $query;   
    }
    public function getFacultadPk2($pk){
             $query=$this->db->query("SELECT pk,facultad FROM facultades where pk=".$pk."");
             return $query->result();   
    }
    public function getNameCampus($pk){
            $query=$this->db->query("SELECT pk,nombre FROM campus WHERE pk='".$pk."'");
            return $query->row();

    }
    public function updateFacultades($pk,$newFacultad,$newDescripcion){
        for ($i=0; $i <count($pk) ; $i++) { 
            $query[]=$this->db->query("UPDATE facultades SET facultad='".$newFacultad[$i]."', descripcion='".$newDescripcion[$i]."' WHERE pk='".$pk[$i]."'");
            
        }
        return $query; 
    }
    public function addFacultades($addFacultad,$addDesc,$campus_fk){
        for ($i=0; $i <count($addDesc) ; $i++) { 
            $query[]=$this->db->query("INSERT INTO facultades VALUES(DEFAULT,'".$addFacultad[$i]."','".$addDesc[$i]."','".$campus_fk."')");
            
        }
        return $query;
    }
    public function addSalas($addSala,$pkCampus){
        for ($i=0; $i <count($addSala) ; $i++) { 
            $query[]=$this->db->query("INSERT INTO salas VALUES(DEFAULT,'".$pkCampus."','".$addSala[$i]."')");
            
        }
        return $query;
    }
        public function addPeriodo($newInicio,$newTermino,$pkUpdate){
            for ($i=0; $i <count($pkUpdate) ; $i++) { 
            $query[]=$this->db->query("UPDATE periodos SET inicio='".$newInicio[$i]."',termino='".$newTermino[$i]."' WHERE pk='".$pkUpdate[$i]."'");
                
            }
            return $query;
        }
        public function getCantFacu(){
             $query=$this->db->query("SELECT count(pk) as cantFacu FROM  facultades");
              return $query->row();    
        }
       /* public function getSalaPorFk(){ ***************AFECTA***************RAROOOOOOOOOOOOOOO
           for ($i=1; $i <=4 ; $i++) { 
                $query[$i]=$this->db->query("SELECT sala FROM salas WHERE campus_fk='".$i."'");
                $query[$i]=$query[$i]->result();
           }
           return $query;
        }*/
        public function getSalaPk($pk){
        for ($i=0; $i <count($pk) ; $i++) { 
             $query[$i]=$this->db->query("SELECT pk,sala,estado,descripcion FROM salas where pk=".$pk[$i]." ");
            $query[$i]=$query[$i]->result();
            }
        
             return $query;   
         }
         public function updateSalas($pk,$newSala,$newDescripcion,$estadoArray){//
            for ($i=0; $i <count($estadoArray) ; $i++) { 
                if($estadoArray[$i]==0){//quiere decir que hay que bloquear la sala
                    $query[]=$this->db->query("UPDATE salas SET sala='".$newSala[$i]."', descripcion='".$newDescripcion[$i]."',estado='false' WHERE pk='".$pk[$i]."'");
                }else
                    $query[]=$this->db->query("UPDATE salas SET sala='".$newSala[$i]."', descripcion='".$newDescripcion[$i]."',estado='true' WHERE pk='".$pk[$i]."'"); 

            }
                return $query; 
         }
         public function eliminarSala($accion){
                for ($i=0; $i <count($accion) ; $i++) { 
                    $query[]=$this->db->query("DELETE FROM salas WHERE pk=".$accion[$i]."");
                }
                return $query; 
         }
         public function save($periodo,$date,$pkAdm){
        $query=$this->db->query("SELECT s.sala, (d.nombres,d.apellidos)as Profesor , a.nombre as asignatura,c.seccion,depa.departamento,p.periodo
                FROM departamentos as depa, reservas as r,cursos as c,docentes as d,salas as s,asignaturas as a,periodos as p
                WHERE r.curso_fk=c.pk AND a.departamento_fk=depa.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk 
                AND p.pk=r.periodo_fk AND r.fecha='".$date."' AND p.periodo='".$periodo."' AND r.adm_fk='".$pkAdm."' order by s.pk asc"); 
        return $query->result();
         }
        public function save2($fechaIni,$fechaFin,$pkAdm){
        $query=$this->db->query("SELECT r.fecha,s.sala,(d.nombres,d.apellidos)as Profesor, a.nombre as asignatura,c.seccion,depa.departamento,p.periodo,r.estado as Asistencia
                FROM departamentos as depa, reservas as r,cursos as c,docentes as d,salas as s,asignaturas as a,periodos as p
                WHERE r.curso_fk=c.pk AND a.departamento_fk=depa.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk 
                AND p.pk=r.periodo_fk AND r.fecha>='".$fechaIni."' AND r.fecha<='".$fechaFin."' AND r.adm_fk='".$pkAdm."' order by r.pk asc"); 
        return $query->result();
         }
         public function getdpto($campus_fk){
            $query=$this->db->query("select pk,departamento from departamentos where facultad_fk in(select pk FROM facultades WHERE campus_fk='".$campus_fk."') order by departamento asc;");
            return $query->result();
         }
         public function getDocPorFacu($pk){
            $query=$this->db->query("select pk,nombres,apellidos,rut from docentes where departamento_fk in(select pk FROM departamentos WHERE facultad_fk='".$pk."') order by pk asc;");
            return $query->result();
         }
          public function getDocPorFacu2($pk){
            $query=$this->db->query("select pk,nombres,apellidos,rut from docentes where departamento_fk in(select pk from departamentos where facultad_fk in(select facultad_fk from departamentos where pk='".$pk."')) order by pk asc");
            return $query->result();
         }
        public function getDocPorDpto($pk){
            $query=$this->db->query("select pk,nombres,apellidos,rut from docentes where departamento_fk='".$pk."' order by nombres asc;");
            return $query->result();
         }
        public function getAsigPorDpto($pk){
            $query=$this->db->query("select pk,codigo,nombre from asignaturas where departamento_fk='".$pk."' order by pk asc;");
            return $query->result();
        } 
         public function getNameDpto($pk){
            $query=$this->db->query("select pk,departamento from departamentos where pk='".$pk."' order by pk asc;");
            return $query->result();
         }
         public function agregarDocente($pkDpto,$addDocName,$addDocApe,$addDocRut){
            $query=$this->db->query("INSERT INTO docentes VALUES(DEFAULT,'".$addDocName."','".$addDocApe."','".$addDocRut."','".$pkDpto."')");
            return $query;
         }
         public function agregarAsig($pkDpto,$addAsigName,$addAsigCod,$addAsigDesc){
            $query=$this->db->query("INSERT INTO asignaturas VALUES(DEFAULT,'".$pkDpto."','".$addAsigCod."','".$addAsigName."','".$addAsigDesc."')");
            return $query;            
         }
        public function getDocEdit($pk){
            for ($i=0; $i <count($pk) ; $i++) { 
                 $query[$i]=$this->db->query("SELECT pk,nombres,apellidos,rut FROM docentes where pk=".$pk[$i]." ");
                $query[$i]=$query[$i]->result();
            }
             return $query;   
         }
        public function getAsigEdit($pk){
            for ($i=0; $i <count($pk) ; $i++) { 
                 $query[$i]=$this->db->query("SELECT pk,codigo,nombre FROM asignaturas where pk=".$pk[$i]." ");
                $query[$i]=$query[$i]->result();
            }
             return $query; 
        } 
         public function updateDocentes($pk,$newName,$newApellidos){
                function quitar_tildes($cadena) {
                $no_permitidas= array ("Ñ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
                $permitidas= array ("ñ","a","e","i","o","u","A","E","I","O","U","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
                $texto = str_replace($no_permitidas, $permitidas ,$cadena);
                return $texto;
                }
            for ($i=0; $i <count($pk) ; $i++) { 
                    $query[]=$this->db->query("UPDATE docentes SET nombres='".ucwords(strtolower(quitar_tildes($newName[$i])))."', apellidos='".ucwords(strtolower(quitar_tildes($newApellidos[$i])))."' WHERE pk='".$pk[$i]."'"); 
            }
                return $query; 
         }
        public function updateAsignaturas($pk,$newName,$newCodigo){
                function quitar_tildes($cadena) {
                $no_permitidas= array ("Ñ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
                $permitidas= array ("ñ","a","e","i","o","u","A","E","I","O","U","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
                $texto = str_replace($no_permitidas, $permitidas ,$cadena);
                return $texto;
                }
            for ($i=0; $i <count($pk) ; $i++) { 
                    $query[]=$this->db->query("UPDATE asignaturas SET nombre='".ucwords(strtolower(quitar_tildes($newName[$i])))."', codigo='".strtoupper($newCodigo[$i])."' WHERE pk='".$pk[$i]."'"); 
            }
                return $query; 
        } 
         public function eliminarDocente($accion){
            for ($i=0; $i <count($accion) ; $i++) { 
                $query[]=$this->db->query("DELETE FROM docentes WHERE pk=".$accion[$i]."");
            }
            return $query;
         }
        public function eliminarAsig($accion){
            for ($i=0; $i <count($accion) ; $i++) { 
                $query[]=$this->db->query("DELETE FROM asignaturas WHERE pk=".$accion[$i]."");
            }
            return $query;
         }
         public function getdptoAll(){
            $query=$this->db->query("select pk,departamento from departamentos order by departamento asc;");
            return $query->result();
         }
          public function getdocAll(){
            $query=$this->db->query("select pk,nombres,apellidos,rut from docentes order by pk asc;");
            return $query->result();
         }
           
   }
?>

