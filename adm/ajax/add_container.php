<tr id='containers_list_<?php echo $values['id'];?>'>
	<td><input type='hidden' name='id_container[<?php echo $values['id_container']?>]' value='<?php echo $containers_data['id_container']?>'><?php echo strtoupper($containers_data['name']);?></td>
	<td><input type='text'  name='number[<?php echo $values['id']?>]' id='number_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateSalesContainersDetail(<?php echo $values['id'];?>,'number_<?php echo $values['id'];?>','number')"></td>
	<td><a onclick="deleteContainerDetail(<?php echo $values['id']?>)" class="btn btn-danger">Eliminar</a></td>
</tr>