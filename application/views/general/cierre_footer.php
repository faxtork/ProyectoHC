
    <footer style="background-color: #2c3e50;">
      <div class="container" style="color: #fff;"><br>
        <?php 
              date_default_timezone_set("America/Santiago");
              $time  = date("H:i:s");
              $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
              $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
              $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

              echo "Universidad Tecnologica Metropolitana del Estado de Chile - ";
                echo "Son las $time - $fecha";
  ?> 
        <br>
              <a href="http://www.utem.cl" target="_blank">UTEM</a> <span class="divider">/</span>
              <a href="http://postulacion.utem.cl" target="_blank">Dirdoc</a> <span class="divider">/</span>
              <a href="http://reko.utem.cl" target="_blank">Reko</a> <span class="divider">/</span>
              <a href="http://www.cftutem.cl" target="_blank">CFTUTEM</a> <span class="divider">/</span>
              <a href="http://utemvirtual.cl" target="_blank">UTEM Virtual</a> <span class="divider">/</span>
         
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
  margin-bottom: 100px;
  margin-top: 100px;
}
footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 80px;
  background-color: #f5f5f5;
}
</style>