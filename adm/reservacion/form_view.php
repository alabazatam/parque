<?php include('../../view_header.php')?>
<?php include('../menu.php')?>

	<h1 class="text-center">Generar solicitud</h1>
	
	<div class="container alert alert-info" id="parcial_espacio"> 
			
		
		
	</div>

	
	
	
		<div class="container" id="busqueda">
			<div style="position: relative;">
				<form class="form-inline">
				  <div class="form-group">
					<label for="fec_reservacion">Fecha de reserva</label>
					<input type="text" name="fec_reservacion" class="form-control input-sm" id="fec_reservacion" placeholder="DD/MM/AAAA">
				  </div>
				  <div class="form-group">
					<button type="button" class="btn btn-success" id="comprobar_disponibilidad"><i class="fa fa-eye"></i> Comprobar disponibilidad</button>
				  </div>

				</form>
			</div>
		</div>

<div class="container" id="formulario_solicitud">
	<form class="form-horizontal" action="index.php" method="POST">
      <input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
      <input readonly="readonly" type="hidden" class="form-control input-sm" id="id_espacio" placeholder="" name="id_espacio" value="<?php if(isset($values['id_espacio'])) echo $values['id_espacio']?>">
	  <div class="form-group">
		<div class="alert alert-info">
			<label class="label label-success">Espacio Disponible</label>
			<div>
			<button type="button" class="btn btn-success" id="generar_solicitud"><i class="fa fa-check-circle-o fa-4x"></i> Click aquí para generar solicitud</button>
			</div>
		</div>
	  </div>
    </form>
</div>
	
	<div class="container">
		<a href="<?php echo full_url?>/adm/reservacion/index.php" class=" btn btn-default"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
	</div>
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
		
		
		$('#formulario_solicitud').hide();
		$('#comprobar_disponibilidad').click(function(){
			var id_espacio = $('#id_espacio').val();
			var fec_reservacion = $('#fec_reservacion').val();
			if(fec_reservacion == ''){
				alert('Indique Fecha de reserva');
				return false;
			}
			
			$.getJSON("<?php echo full_url;?>/adm/ajax/index.php?action=comprobar_disponibilidad&id_espacio=" + id_espacio + "&fec_reservacion=" + fec_reservacion, function(data) {
				
				if(data.cuenta == 0)//esta disponible
				{
					$('#busqueda').hide();
					$('#formulario_solicitud').show();
					
				}
				else//no esta disponible
				{	
					alert('Espacio no disponible para la fecha indicada');
					$('#busqueda').show();
					$('#formulario_solicitud').hide();
				}

			});


		});
		
	$('#generar_solicitud').click(function(){
		var id_espacio = $('#id_espacio').val();
		var fec_reservacion = $('#fec_reservacion').val();
		
		if(confirm('¿Está seguro(a) de generar una solicitud de reservación?'))
		{
			$.ajax({
				type: "POST",
				url: '<?php echo full_url?>/adm/ajax/index.php',
				data: { action: "generar_solicitud",id_espacio: id_espacio,fec_reservacion:fec_reservacion},
				success: function(json){
					alert("Solicitud generada satisfactoriamente con el ID: " + json.id_solicitud);
					$(location).attr('href', '<?php echo full_url?>/adm/solicitudes_fun/index.php')
				},

				dataType: 'json'
			});	
		}else
		{
			return false;
		}
		

	});	
			
	});



</script>
