<tr id='farms_list_<?php echo $values['id'];?>'>
	<td><input type='hidden' name='id_farm[<?php echo $values['id_farm']?>]' value='<?php echo $farms_data['id_farm']?>'><?php echo strtoupper($farms_data['name']);?></td>
	<td><a onclick="deleteFarmDetail(<?php echo $values['id']?>)" class="btn btn-danger">Eliminar</a></td>
</tr>