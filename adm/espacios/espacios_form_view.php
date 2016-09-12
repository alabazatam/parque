<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<?php
	$ZonaUbicacion = new ZonaUbicacion();
	$zonas_list = $ZonaUbicacion->getZonaUbicacionListSelect($values);
	
	$TipoEspacio = new TipoEspacio();
	$tipo_espacio_list = $TipoEspacio->getTipoEspacioListSelect($values);	
?>


<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
	<h1 class="text-center">Espacios</h1>
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		 <div class="col-sm-4 col-sm-offset-8">
			<label for="">Id.Espacio</label>
			<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_espacio" value="<?php if(isset($values['id_espacio'])) echo $values['id_espacio']?>">
		</div>
		</div>
    <div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-4">
				<label for="">Nombre <small class="text-danger">(*)</small></label>		
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="nom_espacio" value="<?php if(isset($values['nom_espacio'])) echo $values['nom_espacio']?>">

				<?php if(isset($values['errors']['nom_espacio']) and $values['errors']['nom_espacio']!=''):?>
					<label class="alert alert-danger"><?php echo $values['errors']['nom_espacio']?></label>
				<?php endif;?>
			</div>

			<div class="col-sm-4">
					<label for="">Descripción <small class="text-danger">(*)</small></label>
					<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="des_espacio" value="<?php if(isset($values['des_espacio'])) echo $values['des_espacio']?>">
					<?php if(isset($values['errors']['des_espacio']) and $values['errors']['des_espacio']!=''):?>
						<label class="alert alert-danger"><?php echo $values['errors']['des_espacio']?></label>
					<?php endif;?>
			</div>
			<div class="col-sm-4">
					
			</div>
		</div>
	</div>
    <div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-4">
				<label for="">Capacidad <small class="text-danger">(*)</small></label>		
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="capacidad" value="<?php if(isset($values['capacidad'])) echo $values['capacidad']?>">

				<?php if(isset($values['errors']['capacidad']) and $values['errors']['capacidad']!=''):?>
					<label class="alert alert-danger"><?php echo $values['errors']['capacidad']?></label>
				<?php endif;?>
			</div>

			<div class="col-sm-4">
				<label for="">Unidades tributarias <small class="text-danger">(*)</small></label>
				<input autocomplete="off" type="number" class="form-control input-sm" id="" placeholder="" name="ut" value="<?php if(isset($values['ut'])) echo $values['ut']?>">
				<?php if(isset($values['errors']['ut']) and $values['errors']['ut']!=''):?>
					<label class="alert alert-danger"><?php echo $values['errors']['ut']?></label>
				<?php endif;?>
			</div>
			<div class="col-sm-4">
				<label for="">Precio</label>
				<input autocomplete="off" type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="precio" value="<?php if(isset($values['precio'])) echo $values['precio']?>">
				<?php if(isset($values['errors']['precio']) and $values['errors']['precio']!=''):?>
					<label class="alert alert-danger"><?php echo $values['errors']['precio']?></label>
				<?php endif;?>
			</div>
		</div>
	</div>
    <div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-4">
				<label for="">Tipo espacio <small class="text-danger">(*)</small></label>		
				<select name="id_tipo_espacio"  class="form-control input-sm">
					<option>Seleccione...</option>
					<?php if(isset($tipo_espacio_list) and count($tipo_espacio_list)>0):?>
					<?php foreach($tipo_espacio_list as $list):?>
					<option value="<?php echo $list['id_tipo_espacio']?>" <?php if(isset($values['id_tipo_espacio']) and $values['id_tipo_espacio']== $list['id_tipo_espacio']) echo "selected = 'selected'";?>><?php echo $list['nom_tipo_espacio'];?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>

				<?php if(isset($values['errors']['id_tipo_espacio']) and $values['errors']['id_tipo_espacio']!=''):?>
					<label class="alert alert-danger"><?php echo $values['errors']['id_tipo_espacio']?></label>
				<?php endif;?>
			</div>

			<div class="col-sm-4">
				<label for="">Zona/Ubicación <small class="text-danger">(*)</small></label>	
				<select name="id_zona_ubicacion"  class="form-control input-sm">
					<option>Seleccione...</option>
				<?php if(isset($zonas_list) and count($zonas_list)>0):?>
					<?php foreach($zonas_list as $list):?>
					<option value="<?php echo $list['id_zona_ubicacion']?>" <?php if(isset($values['id_zona_ubicacion']) and $values['id_zona_ubicacion']== $list['id_zona_ubicacion']) echo "selected = 'selected'";?>><?php echo $list['des_zona_ubicacion'];?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
					<?php if(isset($values['errors']['id_zona_ubicacion']) and $values['errors']['id_zona_ubicacion']!=''):?>
						<label class="alert alert-danger"><?php echo $values['errors']['id_zona_ubicacion']?></label>
					<?php endif;?>
			</div>
			<div class="col-sm-4">
					
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-6">
				<label class="label label-danger">
					<input type="radio" name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
						Inactivo
				</label>
			</div>
			<div class="col-sm-6">
				<label class="label label-success">
					<input type="radio" name="status" id="status" value="1" <?php if(isset($values['status']) and $values['status'] =='1' ) echo "checked=checked"?>>
						Activo
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-6">
				<label autocomplete="off" for="">Fecha creado</label>
				<input autocomplete="off"  type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="date_created" value="<?php if(isset($values['date_created'])) echo $values['date_created']?>">
			</div>
			<div class="col-sm-6">
				<label for="">Fecha modificado</label>
				<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="date_updated" value="<?php if(isset($values['date_updated'])) echo $values['date_updated']?>">
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
		<label class="text-danger">Campos requeridos (*)</label>
		</div>
	</div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/espacios/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>
	<?php if(isset($values['msg']) and $values['msg']!=''):?>
        <script>
			$(document).ready(function(){
			$('.modal-body').html('<div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>');
			$('.modal-title').html('');
			$('#myModal').modal('show');	
			});

		
		</script>
    <?php endif;?>
	</form>
</div>
<?php include('../../view_footer.php')?>