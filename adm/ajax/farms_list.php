
<div class="row">
	<div class="container">
		
		<div class="col-sm-8">
<?php $i = 0;foreach($farms_list as $farms):?>
			<form name="farms_form_<?php echo $i?>" class='farms_form'>
			<table class="table-responsive table-bordered" >
				<tr>	
					<td width="200"><?php echo strtoupper($farms['name']);?></td>
					<td><a class="btn btn-default" onclick="addFarms(<?php echo $farms['id_farm']?>);">Agregar</a></td>
				</tr>
			</table>
			</form>
<?php $i++;endforeach;?>
		</div>	
	</div>	
</div>