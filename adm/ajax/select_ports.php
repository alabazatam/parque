<?php if(count($ports_list)>0):?>
	<?php foreach($ports_list as $list):?>
		<option value="<?php echo $list['id_port'];?>"
		<?php if(@$values['type']=='in' and @$selected_port['id_port_in']==@$list['id_port']):?>
				<?php echo "selected='selected'";?>
		<?php endif;?>
		<?php if(@$values['type']=='out' and @$selected_port['id_port_out']==@$list['id_port']):?>
				<?php echo "selected='selected'";?>
		<?php endif;?>
		>
			<?php echo $list['name'];?>
		</option>
	<?php endforeach;?>
<?php endif;;?>