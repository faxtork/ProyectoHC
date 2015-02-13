
    <footer style="background-color: #2c3e50;">

        
   
          <!-- <a class="navbar-brand" href="#"><img  WIDTH="30" HEIGHT="40" src="<?php echo base_url() ?>public/img/logoutem3.png" alt=""></a>-->

    
      
    
      <div class="container-fluid" style="color: #fff;">
        <div class="row-fluid">
          <div class="span12">
<br>
       
            <div row-fluid>
              <div class="span3">             
                 <a  href="http://www.utem.cl" target="_blank"> <img  HEIGHT="70"src="<?php echo base_url() ?>public/img/logo-utem.png" alt=""></a> 
              </div>
              <div class="span3">             
                 <a href="http://postulacion.utem.cl" target="_blank"><img  HEIGHT="70" src="<?php echo base_url() ?>public/img/dirdoc.png" alt=""></a>
              </div>
              <div class="span3">             
                 <a href="http://reko.utem.cl" target="_blank"> <img  HEIGHT="70" src="<?php echo base_url() ?>public/img/reko.png" alt=""></a> 
              </div>
              <div class="span3">             
                 <a href="http://utemvirtual.cl" target="_blank"><img  HEIGHT="70" src="<?php echo base_url() ?>public/img/utemvirtual.png" alt=""> </a>
              </div>
            </div><br> <br><br> 
             <br>
                             <?php 
              date_default_timezone_set("America/Santiago");
              $time  = date("H:i:s");
              $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
              $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
              $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

              echo "Universidad Tecnológica Metropolitana del Estado de Chile - ";
                echo "Son las $time - $fecha";
  ?> 
          </div>
        </div>

      </div>
    </footer>
</body>
</html>
<style>
  html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 160px;
  margin-top: 100px;
}
footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 140px;
  background-color: #f5f5f5;
}
</style>