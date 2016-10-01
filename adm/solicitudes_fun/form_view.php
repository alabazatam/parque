<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<h1 class="text-center"> Solicitudes</h1>

	<div class="container alert alert-info" id="parcial_espacio"> 
	</div>
<form action="index.php" id="formSolicitudFun">
<input type="hidden" value="<?php echo $values['id_espacio'];?>" id="id_espacio" name="id_espacio" value="<?php if(isset($values['id_espacio']) and $values['id_espacio']!='') echo $values['id_espacio'];?>">
<input type="hidden" value="<?php echo $values['id_solicitud'];?>" id="id_solicitud" name="id_solicitud" value="<?php if(isset($values['id_solicitud']) and $values['id_solicitud']!='') echo $values['id_solicitud'];?>">
<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
<input type="hidden" name='id_status' value='<?php if(isset($values['id_status']))echo $values['id_status'];?>'>
	
<div class="container">
	<div>
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#detalle" aria-controls="detalle" role="tab" data-toggle="tab">Detalle solicitud</a></li>
		<?php if(isset($values['id_status']) and $values['id_status'] == 5):?>
		<li role="presentation"><a href="#invitados" aria-controls="invitados" role="tab" data-toggle="tab">Invitados</a></li>
		<?php endif;?>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="detalle">
				 <?php include('solicitud_view.php');?>
			</div>
		  <?php if(isset($values['id_status']) and $values['id_status'] == 5):?>
		  <div role="tabpanel" class="tab-pane" id="invitados">
			  <?php include('invitados_view.php');?>
		  </div>
		  <?php endif;?>
		  
	  </div>

	</div>
	<?php if(isset($values['id_status']) and $values['id_status'] == 5):?>
			<div class="col-sm-12 col-md-12">
				<button type="button" class="btn btn-success" onclick="submitForm(<?php echo $values['id_status'];?>)">Actualizar solicitud</button>
			
			</div>
	<?php endif;?>
	<?php if(isset($values['id_status']) and $values['id_status'] == 3):?>
			<div class="col-sm-12 col-md-12">
				<button type="button" class="btn btn-success" onclick="submitForm(<?php echo $values['id_status'];?>)">Actualizar solicitud</button>
			
			</div>
	<?php endif;?>
</div>

<div class="container">
	<a href="<?php echo full_url?>/adm/solicitudes_fun/index.php" class=" btn btn-default"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
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

function addInvitado(){

    var id_solicitud = $('#id_solicitud').val();

    		$.ajax({
			type: "GET",
			url: '<?php echo full_url?>/adm/ajax/index.php',
			data: { action: "add_invitado",id_solicitud: id_solicitud},
			success: function(html){
				$('#result_invitado').append(html);
			},
			//dataType: dataType
		});    

}
function deleteSolicitudesInvitados(id) {
	
	if(confirm("¿Está seguro(a) de eliminar el registro?")){

		$.ajax({
			type: "POST",
			url: '<?php echo full_url;?>/adm/ajax/index.php',
			data: { action: "delete_solicitudes_invitados",id_solinvi: id},
			success: function(){
				$("#solicitudes_invitados_list_" + id).remove(); 
			}
		});
		  		
	}else{
		return false;
	}

}

	function updateSolicitudesInvitados(id, column_id,column_name)
	{
		$('.mess').html('');
		var value = $("#" + column_id).val();
		
				if(column_name == 'cedula')
				{
					var z1 = /^[0-9]*$/;
					if (value != '' && !z1.test(value)) 
					{ 
							$('#' + column_id).val('');
							alert('Por favor ingrese solamente números para el campo cédula');
							
							return false;
					} 	
				}
	
		
		$.ajax({
			type: "POST",
			url: '<?php echo full_url;?>/adm/ajax/index.php',
			data: { action: "update_solicitudes_invitados",id: id,column_id:column_id,column_name:column_name,value:value,id_solicitud:<?php echo $values['id_solicitud']?>},
			success: function(){
				$('#' + 'mensaje_'+ column_name + '_' + id).html('<i class="fa fa-check-circle alert-success"> Actualizado satisfactoriamente</i>');
				//alert('#' + 'mensaje_'+ column_name + '_' + id);
			}
			
		});		
	}

	function submitForm(status)
	{
		if(status==5)
		{
			if(confirm("¿Está seguro(a) de haber completado su lista de invitados y enviar la información a RRHH?"))
			{
				$('#formSolicitudFun').submit();
			}else
			{
				return false;
			}
		}
		if(status==3)
		{
			if(confirm("¿Está seguro(a) de enviar los datos de pago para la validación por parte de RRHH?"))
			{
				$('#formSolicitudFun').submit();
			}else
			{
				return false;
			}
		}
		

	}
</script>