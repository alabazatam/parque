<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<h1 class="text-center"> Solicitudes</h1>

	<div class="container alert alert-info" id="parcial_espacio"> 
	</div>
<form action="index.php" method="post" id="form_solicitud">
<input type="hidden" value="<?php echo $values['id_espacio'];?>" id="id_espacio" name="id_espacio" value="<?php if(isset($values['id_espacio']) and $values['id_espacio']!='') echo $values['id_espacio'];?>">
<input type="hidden" value="<?php echo $values['id_solicitud'];?>" id="id_solicitud" name="id_solicitud" value="<?php if(isset($values['id_solicitud']) and $values['id_solicitud']!='') echo $values['id_solicitud'];?>">
<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>

<div class="container">
	<div>
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#detalle" aria-controls="detalle" role="tab" data-toggle="tab">Detalle solicitud</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="detalle">
				 <?php include('solicitud_view.php');?>
			</div>
	  </div>

	</div>
</div>

<div class="container">
	<a href="<?php echo full_url?>/adm/solicitudes_adm/index.php" class=" btn btn-default"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
	<button type="button" class="btn btn-default" id="aceptar_form"><i class="fa fa-save fa-pull-left fa-border"></i> Aceptar</button>

</div>
</form>



<?php include('../../view_footer.php')?>

<script>

$(document).ready(function(){
	
		var id_espacio = $('#id_espacio').val();	
		
		$.ajax({
			type: "GET",
			url: '<?php echo full_url?>/adm/Parciales/index.php',
			data: { action: "parcial_espacio",id_espacio: id_espacio},
			success: function(html){
				$('#parcial_espacio').html(html);
			},
			//dataType: dataType
		});	
		
		
			
});

	$('#form_solicitud input').on('change', function() {
	   //alert($('input[name=status]:checked', '#form_solicitud').val()); 
	   
			$.ajax({
				type: "POST",
				url: '<?php echo full_url?>/adm/ajax/index.php',
				data: { action: "status_name", id_status: $("input[name=status]:checked").val()},
				success: function(json){
					$('#des_status').val(json.status_name);
				},

				dataType: 'json'
			});		   

			if ($('#devolver').is(':checked')) 
		   {
			   $('#observacion_div').show();
		   }else if($('#cancelar').is(':checked'))
			   $('#observacion_div').show();
			else
		   {
			   $('#observacion_div').hide();
		   }
	   
	   
	   
	});
	
	$('#aceptar_form').click(function(){
		
		if(confirm("¿Esta seguro(a) de cambiar el estatus de la solicitud a: " + $('#des_status').val() + "?"))
		{
			
			$('#form_solicitud').submit();
		}
		
	});
</script>