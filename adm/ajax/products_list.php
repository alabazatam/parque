
<div class="row">
	<div class="container">
		
		<div class="col-sm-8">
<?php $i = 0;foreach($products_list as $product):?>
			<form name="products_form_<?php echo $i?>" class='products_form'>
			<table class="table-responsive table-bordered">
				<tr>	
					<td width="200"><?php echo strtoupper($product['name']);?></td>
					<td><a class="btn btn-default" onclick="addProducts(<?php echo $product['id_product']?>);">Agregar</a></td>
				</tr>
				



			</table>
			</form>
<?php $i++;endforeach;?>
		</div>	
	</div>	
</div>