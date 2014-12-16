<?php 
class Clases_model extends CI_Model{
    public function getNameCampusXCode($code){
        $query=$this->db->query("select pk,nombre from campus where pk in(select campus_fk from codigocarrera where codigo='".$code."' )");
        return $query->row();
    }
    public function getTime(){
        date_default_timezone_set("America/Santiago");

        $time=date("H:i:s");
        //echo $time=$hour.":".$min.":".$sec;
        $query=$this->db
            ->select('inicio,termino')
            ->from('periodos')
            ->order_by('pk','asc')
            ->get();
       $query=$query->result(); 
        foreach ($query as $per) {
            $ini[]=$per->inicio;
            $ter[]=$per->termino;
         }
         for ($i=0; $i <(count($ter)-1) ; $i++) { 
             if ($time>$ter[$i] && $time<$ini[($i+1)]) {//entrara solo una vez
               // $min=$min+"10";
               $dif=date("H:i:s",strtotime("00:00:00")+strtotime($ter[$i])-strtotime($ini[($i+1)]));
               $div=explode(":", $dif);
                $dd=$div[1];//esta el de al medio osea la diferencia entre horarios de periodos
                $segTime=strtotime($time);
                  $segundos_minutoAnadir=$dd*60;
                   $time=date("H:i:s",$segTime+$segundos_minutoAnadir);
             }
         }
    /*    if (($time>"09:30:00" && $time<"09:40:00")||($time>"11:10:00" && $time<"11:20:00")||($time>"12:50:00" && $time<"13:00:00")||($time>"14:30:00" && $time<"14:40:00")||($time>"16:10:00" && $time<"16:20:00")||($time>"17:50:00" && $time<"18:00:00")||($time>"19:30:00" && $time<"19:00:00")||($time>"20:30:00" && $time<"20:40:00")) {
            $min=$min+"10"; 
            
        }*/
      //  $time=$hour.":".$min.":".$sec;
        //echo $time=$hour.":".$min.":".$sec;
        return $time;
    }

    public function getDate(){
        date_default_timezone_set("America/Santiago");
        $year=date("Y");
        $month=date("n");
        $day=date("j");
        if (strlen($month)==1) {
            $month="0$month";   //una forma de concadenar
        }
        if (strlen($day)==1) {
            $day="0".$day;      //otra forma de concadenar
        }
        $date=$year."-".$month."-".$day;
        return $date;
    }

    public function getAhora($time,$date){
  $codCarrera=$_SESSION['codigoCarrera'];
 //$codCarrera="21002";

        $query=$this->db
            ->select('inicio,termino')
            ->from('periodos')
            ->order_by('pk','asc')
            ->get();
       $query=$query->result(); 
        foreach ($query as $per) {
            $ini[]=$per->inicio;
            $ter[]=$per->termino;
         }
         $inicioPer=$ini[0];
         $terminoPer=$ter[(count($ter)-1)];
                    $suma="1";          //suma un minuto a la hora inicial del periodo   
                    $segTime=strtotime($time);
        if ($day=date("N")<=5 && $day=date("j")>=1) {
            if ($time>=$inicioPer && $time<=$terminoPer) {
            //Esta dentro del limite y si esta en receso automaticamente lo asigna al siguiente periodo 
            //gracias al "if" que hay en la funcion "getTime"
                
            }
            else{//quiere decir que esta fuera de horario
                if ($time>$terminoPer && $time<"23:59:59") {
                   // $time="08:00:01";
                      $segundos_minutoAnadir=$suma*60;
                       $time=date("H:i:s",$segTime+$segundos_minutoAnadir);

                    if ($day=date("j")==5) {//si consulta un dia viernes le dara la rspuesta para el prox lunes
                        $nuevafecha = strtotime ( 'next monday' , strtotime ( $date ) ) ;
                        $date = date ( 'Y-m-d' , $nuevafecha );
                    }
                    else{//o para el siguiente dia
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $date ) ) ;
                        $date = date ( 'Y-m-d' , $nuevafecha );
                    }
                    
                    
                }
                else{   //entra si consulta en la mañana antes deel horario de entrada

                      $segundos_minutoAnadir=$suma*60;
                       $time=date("H:i:s",$segTime+$segundos_minutoAnadir);
                }
            }
        }
        else{
                    $segundos_minutoAnadir=$suma*60;
                       $time=date("H:i:s",$segTime+$segundos_minutoAnadir);
            $nuevafecha = strtotime ('next monday', strtotime ( $date ) ) ;
            $date = date ( 'Y-m-d' , $nuevafecha );
        }

        $query=$this->db->query("SELECT r.estado,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion FROM campus as cam,facultades as fa,departamentos as de,codigocarrera as co,reservas as r,cursos as c,docentes as d,salas as s,asignaturas as a,periodos as p WHERE r.adm_fk is not null and r.curso_fk=c.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk AND p.pk=r.periodo_fk AND p.inicio<='".$time."' AND p.termino>='".$time."' AND r.fecha ='".$date."' AND a.departamento_fk=de.pk AND de.facultad_fk=fa.pk AND fa.campus_fk=cam.pk AND cam.pk=co.campus_fk AND co.codigo='".$codCarrera."' order by c.seccion asc");        
//arreglar para la wa del isnot null

        return $query->result();
    }

    public function getHoy($time, $date){
          $codCarrera=$_SESSION['codigoCarrera'];
           //$codCarrera="21002";
        if ($day=date("N")<=5 && $day=date("j")>=1) {
            
        }
        else{
            $nuevafecha = strtotime ('next monday', strtotime ( $date ) ) ;
            $date = date ( 'Y-m-d' , $nuevafecha );
        }
        $query=$this->db->query("SELECT r.estado, p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion FROM campus as cam,facultades as fa,departamentos as de,codigocarrera as co,reservas as r,cursos as c,docentes as d,salas as s,asignaturas as a,periodos as p WHERE r.adm_fk is not NULL  AND r.curso_fk=c.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk AND p.pk=r.periodo_fk  AND r.fecha ='".$date."' AND a.departamento_fk=de.pk AND de.facultad_fk=fa.pk AND fa.campus_fk=cam.pk AND cam.pk=co.campus_fk AND co.codigo='".$codCarrera."' order by p.periodo asc");       
        return $query->result();
      
    }
        public function getHoy2($time, $date,$cantPer){
            $campus=$_SESSION['campus'];
        if ($day=date("N")<=5 && $day=date("j")>=1) {
            
        }
        else{
            $nuevafecha = strtotime ('next monday', strtotime ( $date ) ) ;
            $date = date ( 'Y-m-d' , $nuevafecha );
        }
        $condicion=array(
                'r.fecha ='=>$date,
              );
        for ($i=1; $i <=$cantPer ; $i++) { 
        $arrayPadre[($i-1)]=$this->db->query("SELECT  depa.departamento, r.estado,r.pk, p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion
                FROM departamentos as depa, administrador as ad,reservas as r,cursos as c,docentes as d,salas as s,asignaturas as a,periodos as p
                WHERE r.curso_fk=c.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk 
                AND p.pk=r.periodo_fk AND                     
                    r.adm_fk=ad.pk and
                    a.departamento_fk=depa.pk AND
                    ad.campus_fk='$campus' and
                    r.fecha='".$date."' AND p.periodo='".$i."' order by s.pk asc"); 
         $xx[]=$arrayPadre[($i-1)]->result();
        }
      /*  $query=$this->db->query("SELECT p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion
                    FROM reservas as r,cursos as c,docentes as d,salas as s,asignaturas as a,periodos as p
                    WHERE r.curso_fk=c.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk 
                    AND p.pk=r.periodo_fk AND r.fecha='".$date."' AND p.periodo='1' order by s.pk asc"); */      
      /* $query=$this->db
                ->select('p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->where ($condicion)
                ->order_by('s.pk','asc')
                ->get();*/
        //return $query->result();
      
           return $xx;
       


    }
    public function cantPer(){
        $query=$this->db->query("SELECT count(pk) as cantidad FROM periodos");
        return $query->row();
    }
    public function suspender($pkReserva,$motivo){
       $query=$this->db->query("UPDATE reservas SET motivo='".$motivo."',estado=false WHERE pk='".$pkReserva."'");
        return true;
    }
    public function habilitar($pkReserva){
        $query=$this->db->query("UPDATE reservas SET estado=true,motivo='' WHERE pk='".$pkReserva."'");
        return true;
    }






}
 ?>