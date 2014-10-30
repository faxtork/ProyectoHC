<div class="well">
	<div class="row-fluid">
		<div class="span12">
			<div class="content">
				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form'); 
  						echo form_open('consulta/res_academico/',$attributes); ?>
					<div class="form-group"><h3>Clases por Docente a la semana</h3>
						<label  class="col-lg-3 control-label" id="c">Busque un Docente:</label>
						<div class="col-sm-6">
		     			   <input  type="text" class="form-control"  id="searchid"  />
		     			   <input type="hidden" name="docente" id="area_code" >
							<ul id="country_list_id"></ul>
						</div>
						<div class="col-sm-3">
							<button class="btn btn-primary btn-lg" type="submit"  value="Enviar" name="btnEnviar">Enviar <span class="icon-ok icon-white"></span></button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function set_item(item,pk) {
// change input value
$('#searchid').val(item);
// hide proposition list
$('#area_code').val(pk);
$('#country_list_id').hide();
}
$(function(){
	$(".form-control").keyup(function() 
	{ 
		var searchid = $(this).val();
		var dataString = 'search='+ searchid;
		if(searchid!='')
		{
			    $.ajax({
			    type: "POST",
			    url: "<?= base_url('/index.php/estadistica/test')?>",
			    data: dataString,
			    cache: false,
			    success: function(html)
			    {
			   // $("#result2").html(html).show();
			   	$('#country_list_id').show();
					$('#country_list_id').html(html);
			    }
			    });
		}return false; 

	});

});

</script>
<style>
.content ul{
	    list-style-type: none;
	    border: 1px solid #eaeaea;
    margin: 0;
    background: #f3f3f3;
    padding: 0;
    color:black;
}
.content ul li:hover {
background: #eaeaea;
 background-color: #d0e9c6;
}
#country_list_id {
display: none;
}
</style>
