<div id="bank_list" class="col-sm-12">
<?php if(count($bank_list)>0):?>
<table class="table-responsive table-bordered">
	<thead>
		<tr>
			<th>Descripción</th>
			<th>Número de cuenta</th>
			<th>País</th>
			<th>ABA</th>
			<th>SWIT</th>
			<th>IBAN</th>
			<th>...</th>
		</tr>
	</thead>
	<?php foreach($bank_list as $bank):?>
		<tr>
			<td><?php echo $bank['name'];?></td>
			<td><?php echo $bank['account_number'];?></td>
			<td><?php echo $bank['id_country'];?></td>
			<td><?php echo $bank['aba'];?></td>
			<td><?php echo $bank['swif'];?></td>
			<td><?php echo $bank['iban'];?></td>
			<td><button onclick="deleteBank(<?php echo $bank['id_bank'];?>,<?php echo $values['id_table'];?>,<?php echo $values['id_primary'];?>)">Eliminar <i class="fa fa-minus-circle"></i></button></td>
		</tr>
    <?php endforeach;?>
</table>
<?php endif;?>
</div>
