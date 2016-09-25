<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<h1 class="text-center"> Unidad tributaria</h1>
<div class="container">
    <div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-4">
				<label for="">Valor actual <small class="text-danger">(*)</small></label>		
				<input type="text" autocomplete="off" class="form-control input-sm" size="20" maxlength="8" id="valor" placeholder="" name="valor" value="<?php if(isset($values['valor'])) echo $values['valor']?>"  pattern="[0-9]+([\.,][0-9]+)?" oninvalid="setCustomValidity('El campo admite solo números(entre 7 y 9 caracteres)')" oninput="setCustomValidity('')">
				<button class="btn btn-success" type="button" id="cambiar_ut"> Cambiar</button>
			</div>
		</div>
	</div>
</div>

<?php include('../../view_footer.php')?>
<script>
	
	$(document).ready(function(){
		
	$('#cambiar_ut').click(function(){
	var valor = $('#valor').val();
	if(!IsNumeric(valor))
	{
		alert('El Valor actual debe ser numérico');
		return false;
	}
		if(confirm('¿Está seguro(a) de cambiar el valor actual de la unidad tributaria?'))
		{
			$.ajax({
				type: "POST",
				url: '<?php echo full_url?>/adm/ajax/index.php',
				data: { action: "cambiar_ut", valor: valor},
				success: function(json){
					alert("Unidad tributaria actualizada satisfactoriamente");
				},

				dataType: 'json'
			});	
		}else
		{
			return false;
		}
		

	});	
		
	});
function IsNumeric(num) {
     return (num >=0 || num < 0);
}	
</script>
