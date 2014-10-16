



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
            echo form_open('contacto/enviar');

              echo form_label('Nombre','nombre')."&nbsp";
              echo form_input('nombre',set_value('nombre'),"id='nombre'")."<br>";
              echo form_label('Apellido','apellido');
              echo form_input('apellido',set_value('apellido'),"id='nombre'")."<br>";
              echo form_label('Asunto','asunto')."&nbsp&nbsp";
              echo form_input('asunto',set_value('asunto'),"id='nombre'")."<br>";
              echo form_label('Mensaje','mensaje');
              echo form_textarea('comentario',set_value('comentario'),"id='textoAreaMensaje'","placeholder='Escriba mensaje ...'");
              echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".form_submit($atributos_Btn, 'Enviar');
            echo form_close();
            /*width: 214px height:91px*/
        ?>      
      </div>
      <div class="span4">
      <?php
                      if (isset($errores)) {
                        if(isset($errores['error_nombre']) && strlen($errores['error_nombre'])>0){
            echo "<div class='alert alert-danger'>".$errores['error_nombre']."</div>";
        }
          if(isset($errores['error_apellido']) && strlen($errores['error_apellido'])>0 ){
            echo "<div class='alert alert-error'>".$errores['error_apellido']."</div>"; 
        }
        if(isset($errores['error_asunto'])&& strlen($errores['error_asunto'])>0){
            echo "<div class='alert alert-error'>".$errores['error_asunto']."</div>"; 
        }
        if(isset($errores['error_comentario'])&& strlen($errores['error_comentario'])>0){
            echo "<div class='alert alert-error'>".$errores['error_comentario']."</div>"; 
        }
            }
            ?>
      </div>
      <br>
    </div>


  
