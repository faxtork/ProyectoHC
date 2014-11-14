<script>
        $(function() {  
   var window_height = $(window).height(),
   content_height = window_height - 350;
   $('.mygrid-wrapper-div').height(content_height);
});

$( window ).resize(function() {
   var window_height = $(window).height(),
   content_height = window_height - 50;
   $('.mygrid-wrapper-div').height(content_height);
});
</script>
<div class="well">
    <h3>Clases ordenadas por fecha</h3>
   <div class="mygrid-wrapper-div">
  <table class='table table-hover-striped' border="0" style="text-align:left;">
                   <thead >
                    <tr>
               			<th>Fecha</th>	
                        <th>Asignatura</th>
                        <th>Sala</th>
                        <th>Sección</th>
                        <th>Periodo</th>
                    </tr> 
                  </thead>
	                <tbody>
	                    <?php
	                    foreach ($clasesDoc as $pedi) {
	                        echo '<tr>';
	                        echo '<td>'.$pedi->fecha.'</td>';
	                        echo '<td>'.$pedi->asignatura.'</td>';
	                        echo '<td>'.$pedi->sala.'</td>'; 
	                        echo '<td>'.$pedi->seccion.'</td>'; 
	                        echo '<td>'.$pedi->periodo.'</td>';
	                                            
	                      echo '</tr>';
	                    }
	                    
	                    ?>

	                </tbody>
 </table>
   </div><br>
</div>
