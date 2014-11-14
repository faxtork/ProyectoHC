
<style>

</style>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= site_url('consulta');?>">Sistema de Asignación</a>
      <!--<img src="<?php echo base_url() ?>public/img/logo.jpg" height="52px">-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="btn btn-primary" href="<?= site_url('consulta');?>">Consulta</a></li>
        <li><a class="btn btn-primary" href="<?= site_url('pedidos');?>">Pedidos</a></li>
        <li><a class="btn btn-primary" href="<?= site_url('intranet');?>">Intranet</a></li>
        <!--<li><a class="btn btn-primary" href="<?= site_url('contacto');?>">Contacto</a></li>-->
        <li><a class="btn btn-primary" href="<?= site_url('estadistica');?>">Estadisticas</a></li>

      </ul>

              <?php

        if (isset($_SESSION['usuarioAdmin']) || isset($_SESSION['usuarioAlumno']) || isset($_SESSION['usuarioProfesor'])) {//si no  estan logeadas pasan al admin general
         
          //echo '<li><a href="'.site_url("login/desconectar").'" class="btn btn-success">Desconectar</a></li>';
           echo'   <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" >
                         <span class="icon-user icon-white"></span> Sesion <b class="caret"></b>
                        </a>
                       <ul class="dropdown-menu">
                        <li><a href="'.site_url("login/desconectar").'"><span class="icon-off"></span> Desconectar</a></li>
                       </ul>
                     </li>
                    </ul>';
        }elseif(isset($_SESSION['adminGeneral']) ){
           echo'   <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" >
                         <span class="icon-user icon-white"></span> Session <b class="caret"></b>
                        </a>
                       <ul class="dropdown-menu">
                        <li><a href="'.site_url("login/desconectar").'"><span class="icon-off"></span> Desconectar</a></li>
                       </ul>
                     </li>
                    </ul>';
        }
        ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</div>




            <script src="http://code.jquery.com/jquery.js"></script>
                    <script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap-collapse.js"></script>
       
