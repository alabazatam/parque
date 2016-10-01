<div class="col-sm-12 col-md-12">
	
		<div class="form-group">
			<div class="col-sm-4 col-md-4">
				
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Id.Solicitud:</label>
				<?php if(isset($values['id_solicitud'])) echo $values['id_solicitud']?>
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Estatus:</label>
				<div class="alert alert-success"><?php if(isset($values['status'])) echo $values['status']?></div>
			</div>
		</div>
		<!--datos pago de la solicitud-->
		<div class="form-group" <?php if(isset($values['id_status']) and $values['id_status'] == 3) echo ""; else echo "hidden";?>>
			<div class="col-sm-6 col-md-6">
				<label for="">Referencia bancaria</label>
				<input type="text" autocomplete="off" required class="form-control input-sm" id="referencia_bancaria" placeholder="Referencia bancaria" name="referencia_bancaria" value="<?php if(isset($values['referencia_bancaria'])) echo $values['referencia_bancaria']?>">
			
			</div>
			<div class="col-sm-6 col-md-6">
				<label for="">Fecha de pago</label>
				<input type="text" autocomplete="off" required class="form-control input-sm" id="fec_pago"  placeholder="DD/MM/AAAA" name="fec_pago" value="<?php if(isset($values['fec_pago'])) echo $values['fec_pago']?>">
			
			</div>
		</div>
		<!--fin datos pago-->
</div>