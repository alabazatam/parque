<?php
$Status = new Status();	
$status_proximo = '';
$status_regresar = '';
$name_status_proximo = '';
$name_status_regresar = '';
$status_cancelada = false;
	switch($values['id_status'])
	{
		
		case 2;
			$status_proximo = 3;
			//$status_regresar = 1;
			break;
		case 3;
			$status_proximo = 4;
			$status_regresar = 2;
			$status_cancelada = true;
			break;		
		case 4;
			$status_proximo = 5;
			$status_regresar = 3;
			$status_cancelada = true;
			break;
		case 5;
			$status_proximo = 6;
			$status_regresar = 4;
			$status_cancelada = true;
			break;	
		case 6;
			$status_proximo = 7;
			$status_regresar = 5;
			$status_cancelada = true;
			break;	
		case 7;
			//$status_proximo = 8;
			break;
		
	}
			if($status_proximo !='')
			{
				$name_status_proximo = $Status ->getStatusName($status_proximo);
			}
			
			if($status_regresar!='')
			{
				$name_status_regresar= $Status ->getStatusName($status_regresar);	
	
			}	
?>

<div class="col-sm-12 col-md-12">
	
		<div class="form-group">
			<div class="col-sm-4 col-md-4">
				<input type="hidden" id="des_status" value="<?php echo $name_status_proximo;?>">	
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Id.Solicitud:</label>
				<?php if(isset($values['id_solicitud'])) echo $values['id_solicitud']?>
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Estatus:</label>
				<div class="alert alert-info"><?php if(isset($values['status'])) echo $values['status']?></div>
			</div>
		</div>
		<!--datos pago de la solicitud-->
		<div class="form-group" <?php if(isset($values['id_status']) and $values['id_status'] == 4) echo ""; else echo "hidden";?>>
			<div class="col-sm-6 col-md-6">
				<label for="">Referencia bancaria</label>
				<input type="text" autocomplete="off" readonly="readonly" required class="form-control input-sm" id="referencia_bancaria" placeholder="Referencia bancaria" name="referencia_bancaria" value="<?php if(isset($values['referencia_bancaria'])) echo $values['referencia_bancaria']?>">
			
			</div>
			<div class="col-sm-6 col-md-6">
				<label for="">Fecha de pago</label>
				<input type="text" autocomplete="off" readonly="readonly" required class="form-control input-sm" id="" placeholder="Fecha del pago" name="fec_pago" value="<?php if(isset($values['fec_pago']) and $values['fec_pago']!='') echo $values['fec_pago'];?>">
			
			</div>
		</div>
		<!--fin datos pago-->
		<div class="form-group">
			<div class="col-sm-12">
				<?php if($status_proximo !=''):?>
				<div class="col-sm-4 alert alert-success">
					<label class="">Cambiar solicitud a : <?php echo $name_status_proximo;?></label>
						<input type="radio" class="" name="status" value="<?php if(isset($status_proximo)) echo $status_proximo;?>" id="aceptar" checked="checked">
							
					
				</div>
				<?php endif;?>
				<?php if($status_regresar!=''):?>
				<div class="col-sm-4 alert alert-warning">
					<label class="">Devolver solicitud a: <?php echo $name_status_regresar;?></label>
						<input type="radio" class="" name="status" value="<?php if(isset($status_regresar)) echo $status_regresar;?>" id="devolver">
							
					
				</div>
				<?php endif;?>
				<?php if($status_cancelada == true):?>
				<div class="col-sm-4 alert alert-danger" >
						<label >Cambiar solicitud a : Cancelada</label>
						<input type="radio" class="" name="status" value="8" id="cancelar">
							
					
				</div>
				<?php endif;?>
			</div>
		</div>	
		<div class="form-group" hidden id="observacion_div">
			
			<div class="col-sm-12 col-md-12">
				<label class="" for="">Observación</label>
				<textarea name="observacion" id="observacion" class="form-control input-sm" placeholder="Observación"><?php if(isset($values['observacion']) and $values['observacion']!='') echo $values['observacion']; ?></textarea>
			</div>
		</div>		
		
		
</div>
