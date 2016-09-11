	<?php 
		$Country = new Country();
		$country_list = $Country->getListCountry();
	?>

		<tr id='address_list_<?php echo $values['id'];?>'>

			<td>
				<select name='id_country[<?php echo $values['id']?>]' id='id_country_<?php echo $values['id']?>' onchange="updateClientsAddressDetail(<?php echo $values['id'];?>,'id_country_<?php echo $values['id'];?>','id_country')" class="form-control input-sm>
					<option value=''>...</option>
					<?php if(count($country_list)>0):?>
						<?php foreach($country_list as $list):?>
						<option value="<?php echo $list['id_country']?>" ><?php echo $list['name'];?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
			</td>
			<td>
				<input type='text' name='state[<?php echo $values['id']?>]' id='state_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateClientsAddressDetail(<?php echo $values['id'];?>,'state_<?php echo $values['id'];?>','state')" class="form-control input-sm">
			</td>
			<td>
				<textarea  name='address[<?php echo $values['id']?>]' id='address_<?php echo $values['id']?>' onchange="updateClientsAddressDetail(<?php echo $values['id'];?>,'address_<?php echo $values['id'];?>','address')"></textarea>
			</td>
			<td>
				<input type='text' name='code[<?php echo $values['id']?>]' id='code_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateClientsAddressDetail(<?php echo $values['id'];?>,'code_<?php echo $values['id'];?>','code')" class="form-control input-sm">
			</td>
			<td>
				<input type='text' name='tel[<?php echo $values['id']?>]' id='tel_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateClientsAddressDetail(<?php echo $values['id'];?>,'tel_<?php echo $values['id'];?>','tel')" class="form-control input-sm">
			</td>
			<td>
				<input type='text' name='fax[<?php echo $values['id']?>]' id='fax_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateClientsAddressDetail(<?php echo $values['id'];?>,'fax_<?php echo $values['id'];?>','fax')" class="form-control input-sm">
			</td>
			<td>
				<input type='text' name='email[<?php echo $values['id']?>]' id='email_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateClientsAddressDetail(<?php echo $values['id'];?>,'email_<?php echo $values['id'];?>','email')" class="form-control input-sm">
			</td>
			<td>
				<a onclick="deleteAddressDetail(<?php echo $values['id']?>)" class="btn btn-danger">Eliminar</a>
			</td>
		</tr>

