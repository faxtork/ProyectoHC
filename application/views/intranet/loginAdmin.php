


<div class="well">
      <div class="row-fluid">
          <div class="span12">
            <h2>Ingreso Administrador</h2>
            <h5>&nbsp</h5>
          </div>
      </div>
      <br>
    <?php 
    if(isset($mensajeAlerta)){
        echo "<h4>".$mensajeAlerta."</h4><br>";
    }
      
           $atributos_Usuario = array(
          'name' => 'rut',
            'value' => set_value('usuario'), 
            'placeholder'=>'Usuario',
            'id' => 'user'
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password',
            'placeholder'=>'Contraseña',
            'id' => 'pass'
        );
        $atributos_Btn=  array(
            'class'=>'btn btn-primary btn-lg'); 
    
    ?>   
    <div class="row-fluid">
      <div class="span4"></div>
      <div class="span4">
       <?php 
            echo form_open('login/validarAdmin');
              echo form_label('Usuario', 'usuario');
              echo form_input($atributos_Usuario)."<br>";
              echo "&nbsp&nbsp&nbsp&nbsp".form_label('Clave', 'password');
              echo form_input($atributos_Clave)."<br>";
              echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".form_submit($atributos_Btn, 'Enviar');
            echo form_close();
        ?>      
      </div>
      <div class="span4"></div>
      <br>
    </div>


  
</div>
