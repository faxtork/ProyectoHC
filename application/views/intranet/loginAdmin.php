


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
            'id' => 'user',
            'class'=>'form-control'
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password',
            'placeholder'=>'Contraseña',
            'id' => 'pass',
            'class'=>'form-control'
        );
        $atributos_Btn=  array(
            'class'=>'btn btn-primary btn-lg'); 
        $attributes_label1 = array(
            'class' => 'col-lg-3 control-label',
        );
        $attributes_form = array('class' => 'form-horizontal', 'role' => 'form');
    ?>   
    <div class="row-fluid">
      <div class="span4"></div>
      <div class="span4">
       <?php 
            echo form_open('login/validarAdmin',$attributes_form);
              echo '<div class="form-group">';
                  echo form_label('Usuario', 'usuario',$attributes_label1);
                  echo'<div class="col-lg-9">';
                      echo form_input($atributos_Usuario);
                  echo '</div>
              </div>';
              echo '<div class="form-group">';
                  echo form_label('Clave', 'password',$attributes_label1);
                  echo'<div class="col-lg-9">';
                      echo form_input($atributos_Clave);
                  echo '</div>
              </div>';     
              echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".form_submit($atributos_Btn, 'Enviar');
            echo form_close();
        ?>    

      </div>
      <div class="span4"></div>
      <br>
    </div>


  
</div>
