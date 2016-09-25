<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<h1 class="text-center"> Solicitudes</h1>
<input type="text" value="<?php echo $values['id_espacio'];?>" id="id_espacio" name="id_espacio" value="<?php if(isset($values['id_espacio']) and $values['id_espacio']!='') echo $values['id_espacio'];?>">
<input type="text" value="<?php echo $values['id_solicitud'];?>" id="id_solicitud" name="id_solicitud" value="<?php if(isset($values['id_solicitud']) and $values['id_solicitud']!='') echo $values['id_solicitud'];?>">
<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	
	<div class="container alert alert-info" id="parcial_espacio"> 
	</div>
<form>
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

</script>