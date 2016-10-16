<div class="col-sm-12 col-md-12">

	<div class="alert" id="parcial_espacio"></div>	
	<div class="alert" id="parcial_solicitud"></div>	
		<div class="form-group">
			<div class="col-sm-4 col-md-4">
                                
				<input type="hidden" id="des_status" value="<?php echo $name_status_proximo;?>">	
                     
                        </div>
			<div class="col-sm-4 col-md-4">
				<label for="">Id.Solicitud: <?php if(isset($values['id_solicitud'])) echo $values['id_solicitud']?></label>
				
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Estatus: <?php if(isset($values['status'])) echo $values['status']?></label>
			</div>
		</div>
		<!--datos pago de la solicitud-->
		<div class="form-group" <?php if(isset($values['id_status']) and $values['id_status'] == 4) echo ""; else echo "hidden";?>>
			<div class="col-sm-4 col-md-4">
				<label for="">Referencia bancaria</label>
                                <input type="text" autocomplete="off" readonly="readonly" maxlength="80" class="form-control input-sm" id="referencia_bancaria" placeholder="Referencia bancaria" name="referencia_bancaria" value="<?php if(isset($values['referencia_bancaria'])) echo $values['referencia_bancaria']?>">
			
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Fecha de pago</label>
				<input type="text" autocomplete="off" readonly="readonly" class="form-control input-sm" id="" placeholder="Fecha del pago" name="fec_pago" value="<?php if(isset($values['fec_pago']) and $values['fec_pago']!='') echo $values['fec_pago'];?>">
			
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Comprobante de pago</label>
                                <a target="_blank" href="<?php echo full_url."/web/files/recibo/".$values['recibo']?>"><?php if(isset($values['recibo']) and $values['recibo']!='') echo $values['recibo'];?></a>
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
		
		<?php if(isset($values['id_status']) and $values['id_status']==7):?>
			<div class="col-sm-7 col-md-7 col-sm-offset-5 col-lg-offset-5">
				<br>
				<a class="btn btn-success btn-lg" href="<?php echo full_url?>/adm/planillas/index.php?action=reservacion&id_solicitud=<?php echo $values['id_solicitud']?>" target="_blank"><i class="fa fa-download fa-4x fa-border"></i> Descargar solicitud</a>
			</div>
		<?php endif;?>		
</div>
