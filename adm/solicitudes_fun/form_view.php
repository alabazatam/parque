<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<h1 class="text-center"> Solicitudes</h1>
<input type="text" value="<?php echo $values['id_espacio'];?>" id="id_espacio">
	<div class="container alert alert-info" id="parcial_espacio"> 
			
		
		
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
		
		
			
});



</script>