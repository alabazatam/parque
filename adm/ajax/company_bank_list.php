	<?php 
		$Country = new Country();
		$country_list = $Country->getListCountry();
	?>

		<tr id='company_banks_list_<?php echo $values['id'];?>'>
			<td>
				<input type='text'  name='bank_name[<?php echo $values['id']?>]' id='bank_name_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateCompanyBanksDetail(<?php echo $values['id'];?>,'bank_name_<?php echo $values['id'];?>','bank_name')">

			</td>
			<td>
				<input type='text'  name='number[<?php echo $values['id']?>]' id='number_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateCompanyBanksDetail(<?php echo $values['id'];?>,'number_<?php echo $values['id'];?>','number')">
			</td>
			<td>
				
				<select name='id_country[<?php echo $values['id']?>]' id='id_country_<?php echo $values['id']?>' onchange="updateCompanyBanksDetail(<?php echo $values['id'];?>,'id_country_<?php echo $values['id'];?>','id_country')">
					<option value=''>...</option>
					<?php if(count($country_list)>0):?>
						<?php foreach($country_list as $list):?>
						<option value="<?php echo $list['id_country']?>" ><?php echo $list['name'];?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
			</td>
			<td>
				<input type='text'  name='rif[<?php echo $values['id']?>]' id='rif_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateCompanyBanksDetail(<?php echo $values['id'];?>,'rif_<?php echo $values['id'];?>','rif')">
			</td>
			<td>
				<input type='text'  name='aba[<?php echo $values['id']?>]' id='aba_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateCompanyBanksDetail(<?php echo $values['id'];?>,'aba_<?php echo $values['id'];?>','aba')">
			</td>
			<td>
				<input type='text'  name='swit[<?php echo $values['id']?>]' id='swit_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateCompanyBanksDetail(<?php echo $values['id'];?>,'swit_<?php echo $values['id'];?>','swit')">
			</td>
			<td>
				<input type='text'  name='iban[<?php echo $values['id']?>]' id='iban_<?php echo $values['id']?>' size="20" autocomplete="off" onchange="updateCompanyBanksDetail(<?php echo $values['id'];?>,'iban_<?php echo $values['id'];?>','iban')">
			</td>
			<td>
				<a onclick="deleteCompanyBankDetail(<?php echo $values['id']?>)" class="btn btn-danger">Eliminar</a>
			</td>
		</tr>

