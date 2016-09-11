
<?php if(count($company_banks_list)>0):?>
	<?php foreach($company_banks_list as $list):?>
		<option value="<?php echo $list['id'];?>"
		<?php if(isset($selected_company_bank['id_company_bank']) and $selected_company_bank['id_company_bank']==$list['id']):?>
				<?php echo "selected='selected'";?>
		<?php endif;?>
		>
			<?php echo $list['bank_name']." - ".$list['number'];?>
		</option>
	<?php endforeach;?>
<?php endif;;?>
<?php if(count($company_banks_list)==0):?>
		<option value="">No posee cuentas registradas</option>
<?php endif; ?>
