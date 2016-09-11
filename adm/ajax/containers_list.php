
<div class="row">
	<div class="container">
		
		<div class="col-sm-8">
<?php $i = 0;foreach($containers_list as $containers):?>
			<form name="containers_form_<?php echo $i?>" class='containers_form'>
			<table class="table-responsive table-bordered">
				<tr>	
					<td width="200"><?php echo strtoupper($containers['name']);?></td>
					<td><a class="btn btn-default" onclick="addContainers(<?php echo $containers['id_container']?>);">Agregar</a></td>
				</tr>
				



			</table>
			</form>
<?php $i++;endforeach;?>
		</div>	
	</div>	
</div>