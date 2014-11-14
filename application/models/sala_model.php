<?php


 class Sala_model extends CI_Model{

       function __construct() {
           parent::__construct();
       }
        
        public function getSalasDisponibles($pkPeriodo,$fecha,$campusPk) {
            
            $consul="select *
                   from salas 
                   where pk not in (select sala_fk from reservas where periodo_fk='".$pkPeriodo."' and fecha='".$fecha."') AND estado=true AND campus_fk='".$campusPk."' order by pk asc";
            //SELECT pk,sala FROM salas WHERE facultad_fk='1' AND pk not in(select sala_fk from reservas where periodo_fk='1'  and fecha='2014-10-23')
            $query=  $this->db
           ->query($consul);
           return $query->result();
        }
        //***************AFECTA***************
        public function getSalasDisponibles2($pkPeriodo,$fecha,$salaFk) {//$semestre,$ano,$facultadPk,$periodo,$diaIni,$diaFin,$diaElegido
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
                                $query[$j]=$this->db->query("SELECT pk,sala FROM salas WHERE facultad_fk='".$facultadPk."' AND pk in (select sala_fk from reservas where periodo_fk='".$periodo[$z]."'  and fecha='".$fecha."'  AND curso_fk in( SELECT pk FROM cursos WHERE anio='".$ano."' AND semestre='".$semestre."')) order by pk asc;");
                                $query[$j]=$query[$j]->result();
                            }       
                        }
                    }
                }

        if(count($query)==0){//si es true quiere decir que deve retornar todas las salas habiles
             return false;
        }

         return $query;




            $consul="select *
                   from salas 
                   where pk not in (select sala_fk from reservas where periodo_fk=".$pkPeriodo." and fecha='$fecha' and sala_fk!='$salaFk') AND estado=true order by pk asc;";
            
            $query=  $this->db
           ->query($consul);
           return $query->result();
        }
 }
 
 