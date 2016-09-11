
<?php if(count($clients_address_list)>0):?>
	<?php foreach($clients_address_list as $list):?>
		<option value="<?php echo $list['id'];?>"
		<?php if($selected_clients_address['id_client_address2']==$list['id']):?>
				<?php echo "selected='selected'";?>
		<?php endif;?>
		>
			<?php echo $list['country_name']." - ".$list['address'];?>
		</option>
	<?php endforeach;?>
<?php endif;;?>
<?php if(count($clients_address_list)==0):?>
		<option value="">No posee lugares de entrega registrados</option>
<?php endif; ?>
