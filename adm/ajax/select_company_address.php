
<?php if(count($company_address_list)>0):?>
	<?php foreach($company_address_list as $list):?>
		<option value="<?php echo $list['id'];?>"
		<?php if($selected_company_address['id_company_address']==$list['id']):?>
				<?php echo "selected='selected'";?>
		<?php endif;?>
		>
			<?php echo $list['country_name']." - ".$list['address'];?>
		</option>
	<?php endforeach;?>
<?php endif;;?>
<?php if(count($company_address_list)==0):?>
		<option value="">No posee lugares de entrega registrados</option>
<?php endif; ?>
