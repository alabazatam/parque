<tr id='plants_list_<?php echo $values['id'];?>'>
	<td><input type='hidden' name='id_plant[<?php echo $values['id_plant']?>]' value='<?php echo $plants_data['id_plant']?>'><?php echo strtoupper($plants_data['name']);?></td>
	<td><a onclick="deletePlantDetail(<?php echo $values['id']?>)" class="btn btn-danger">Eliminar</a></td>
</tr>