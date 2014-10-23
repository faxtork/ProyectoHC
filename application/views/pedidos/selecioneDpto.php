<script>
  function validacion(){
    var dptos=document.getElementById('dpto').value;
    if(dptos==""){
            alert("Favor Seleccione un Departamento");
      return false;
    }
  }
</script>
    <div class="well">
      <h3>Bienvenido: <?php echo $_SESSION['bnv']; ?></h3>
      <p>Antes de continuar como es tu primera vez que te logeas en este sistema.</p>
      <p>te pedimos que selecciones el Departamento al cual perteneces</p>
          <div class="form-group">
            <label  class="col-sm-3 control-label" id="c">Departamento: </label>
            <div class="col-sm-5">
              <?php 
              $attributes = array('class' => 'form-horizontal', 'role' => 'form','onsubmit'=>'return validacion()'); 

                echo form_open('pedidos/llenaDptoDoc',$attributes);
                echo '<input type="hidden" value="'.$_SESSION['usuarioProfesor'].'" id="rut" name="rut">';
                  echo'<select name="dpto" class="form-control" id="dpto" >
                    <option value="">Selececione una Departamento</option>';
                    
                          foreach ($dptos as $fila) {
                            
                      
                              echo'<option value='.$fila->pk.'>'.$fila->departamento.'</option>';
                            
                          }
                      
                    echo'</select>';
                
               ?>
            </div>
          </div> 
          <button class="btn btn-primary" type="submit" value="Enviar" name="btnEnviar">Enviar <span class="icon-ok icon-white"></span></button>
   <?php echo form_close(); ?>
          <br><br><br> 
    </div>
