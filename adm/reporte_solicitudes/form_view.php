<?php include('../../view_header.php')?>
<?php include('../menu.php')?>

<?php
$Status = new Status();	
$status_proximo = '';
$status_regresar = '';
$name_status_proximo = '';
$name_status_regresar = '';
$status_cancelada = false;
	switch($values['id_status'])
	{
		
		case 2;
			$status_proximo = 3;
			//$status_regresar = 1;
                        $status_cancelada = true;
			break;
		case 3;
			//$status_proximo = 4;
			//$status_regresar = 2;
			//$status_cancelada = true;
			break;		
		case 4;
			$status_proximo = 5;
			$status_regresar = 3;
			//$status_cancelada = true;
			break;
		case 5;
			//$status_proximo = 6;
			//$status_regresar = 4;
			//$status_cancelada = true;
			break;	
		case 6;
			$status_proximo = 7;
			$status_regresar = 5;
			//$status_cancelada = true;
			break;	
		case 7;
			//$status_proximo = 8;
			break;
		
	}
			if($status_proximo !='')
			{
				$name_status_proximo = $Status ->getStatusName($status_proximo);
			}
			
			if($status_regresar!='')
			{
				$name_status_regresar= $Status ->getStatusName($status_regresar);	
	
			}	
?>

<h1 class="text-center"> Solicitudes</h1>

<form action="index.php" method="post" id="form_solicitud">
<input type="hidden" value="<?php echo $values['id_espacio'];?>" id="id_espacio" name="id_espacio" value="<?php if(isset($values['id_espacio']) and $values['id_espacio']!='') echo $values['id_espacio'];?>">
<input type="hidden" value="<?php echo $values['id_solicitud'];?>" id="id_solicitud" name="id_solicitud" value="<?php if(isset($values['id_solicitud']) and $values['id_solicitud']!='') echo $values['id_solicitud'];?>">
<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>

<div class="">
	<div>
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#detalle" aria-controls="detalle" role="tab" data-toggle="tab">Detalle solicitud</a></li>
		<li role="presentation" class=""><a href="#invitados" aria-controls="invitados" role="tab" data-toggle="tab">Lista de invitados</a></li>

          </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="detalle">
				 <?php include('solicitud_view.php');?>
			</div>
			<div role="tabpanel" class="tab-pane" id="invitados">
				 <?php include('invitados_view.php');?>
			</div>
	  </div>

	</div>
</div>

<div class="">
	<a href="<?php echo full_url?>/adm/solicitudes_adm/index.php" class=" btn btn-default"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
	
	<?php if($status_proximo!='' or $name_status_regresar !='' or $status_cancelada == true):?>
	<button type="button" class="btn btn-default" id="aceptar_form"><i class="fa fa-save fa-pull-left fa-border"></i> Aceptar</button>
	<?php endif;?>
</div>
</form>



<?php include('../../view_footer.php')?>

<script>

$(document).ready(function(){
	
		var id_espacio = $('#id_espacio').val();	
		var id_solicitud = $('#id_solicitud').val();	
		$.ajax({
			type: "GET",
			url: '<?php echo full_url?>/adm/Parciales/index.php',
			data: { action: "parcial_espacio",id_espacio: id_espacio},
			success: function(html){
				$('#parcial_espacio').html(html);
			},
			//dataType: dataType
		});	
		$.ajax({
			type: "GET",
			url: '<?php echo full_url?>/adm/Parciales/index.php',
			data: { action: "parcial_solicitud",id_solicitud: id_solicitud},
			success: function(html){
				$('#parcial_solicitud').html(html);
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
	<?php if(isset($values['errors']) and count($values['errors'])>0):?>
		<?php $errors_concat = "";foreach($values['errors'] as $errors): ?>
			<?php $errors_concat.='<i class="fa fa-arrow-circle-right"></i> '.$errors."<br>";?>
		<?php endforeach;?>
		<script>
			$(document).ready(function(){
			$('.modal-body').html('<div class="alert alert-danger" role="alert"><?php echo $errors_concat;?></div>');
			$('.modal-title').html('<i class="fa fa-warning alert alert-warning"> Revise la información cargada</i>');
			$('#myModal').modal('show');	
			});

		
		</script> 
    <?php endif;?>