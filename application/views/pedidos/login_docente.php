
<div class="well">
      <div class="row-fluid">
          <div class="span12">
            <h2>Ingreso Docentes</h2>
            <h5>Solo los profesores pueden acceder.Entrar con USUARIO y PASSWORD de dirdoc!.</h5>
          </div>
      </div>
      <br>
         <?php
         if(isset($mensajeAlerta)){
             echo "<h4>".$mensajeAlerta."</h4>";
         } 
          $atributos_Rut = array(
          'name' => 'rut',
          'id'=>'rut',
            'value' => set_value('usuario'),
            'placeholder'=>'Ej: 12.345.678-9',
            'onblur'=>'return Rut(form1.rut.value)',
            'class'=>'form-control'
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password',
            'placeholder'=>'************',
            'class'=>'form-control'
        );
          $attributes_label1 = array(
            'class' => 'col-lg-3 control-label',
        );
        $atributos_Btn=  array('class'=>'btn btn-primary btn-lg'); 
        $form=array('name'=>'form1','class' => 'form-horizontal', 'role' => 'form');
        
    ?>   
    <div class="row-fluid">
      <div class="span4"></div>
      <div class="span4">
       <?php 
            echo form_open('login/index',$form);
              echo '<div class="form-group">';
                  echo form_label('Rut', 'labelRut',$attributes_label1);
                  echo'<div class="col-lg-9">';
                      echo form_input($atributos_Rut);
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
