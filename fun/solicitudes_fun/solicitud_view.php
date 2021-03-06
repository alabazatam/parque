<div class="col-sm-12 col-md-12">
	<div class="alert" id="parcial_espacio"></div>
	<div class="alert" id="parcial_solicitud"></div>		
		<div class="form-group">
			<div class="col-sm-4 col-md-4">
                                
				<?php if(isset($observacion) and $observacion!=''):?>
                                    <label for="">Observación:</label>
                                    <div class="alert alert-danger">
                                    
                                    <?php echo $observacion;?>
                                    </div>
                                <?php endif;?>
                            
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Id.Solicitud: <?php if(isset($values['id_solicitud'])) echo $values['id_solicitud']?></label>
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Estatus: <?php if(isset($values['status'])) echo $values['status']?></label>
			</div>
		</div>
		<!--datos pago de la solicitud-->
		<div class="form-group" <?php if(isset($values['id_status']) and $values['id_status'] == 3) echo ""; else echo "hidden";?>>
			<div class="col-sm-4 col-md-4">
				<label for="">Referencia bancaria</label>
				<input type="text" autocomplete="off" required class="form-control input-sm" id="referencia_bancaria" placeholder="Referencia bancaria" name="referencia_bancaria" value="<?php if(isset($values['referencia_bancaria'])) echo $values['referencia_bancaria']?>">
			
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Fecha de pago</label>
                                <input type="text" autocomplete="off" required class="form-control input-sm" id="fec_pago" onkeydown="return false;" placeholder="DD/MM/AAAA" name="fec_pago" value="<?php if(isset($values['fec_pago'])) echo $values['fec_pago']?>">
			
			</div>
			<div class="col-sm-4 col-md-4">
				<label for="">Comprobante de pago</label>
                                <input type="file" name="recibo" class="form-control input-sm" id="recibo">
			
			</div>
		</div>
		<!--fin datos pago-->
		<!--solicitud completada -->
		<?php if(isset($values['id_status']) and $values['id_status']==7):?>
			<div class="col-sm-7 col-md-7 col-sm-offset-5 col-lg-offset-5">
				<br>
				<a class="btn btn-success btn-lg" href="<?php echo full_url?>/fun/planillas/index.php?action=reservacion&id_solicitud=<?php echo $values['id_solicitud']?>" target="_blank"><i class="fa fa-download fa-4x fa-border"></i> Descargar solicitud</a>
			</div>
		<?php endif;?>
		
		
		<!-- Fin solicitud completada-->
</div>