<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<?php 
	$Ubicaciones = new Ubicaciones();
	$Ubicaciones_list = $Ubicaciones->getUbicacionesList();
	$TipoPersonal = new TipoPersonal();
	$tipo_personal_list = $TipoPersonal->getTipoPersonalList();
?>
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
	<h1 class="text-center">Usuarios</h1>
	
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		  <div class="col-sm-2 col-sm-offset-10 col-md-2 col-md-offset-10">
			<label for="">Id.Usuario</label>
			<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_user" value="<?php if(isset($values['id_user'])) echo $values['id_user']?>">
		  </div>
	</div>
	<div class="sub-seccion col-sm-12 col-md-12">Datos de usuario</div>
	  <div class="form-group">
		<div class="col-sm-4 col-md-4">  
		<label for="">Login <small class="text-danger">(*)</small></label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" required placeholder="" name="login" value="<?php if(isset($values['login'])) echo $values['login']?>">
		</div>
		<div class="col-sm-4 col-md-4">  
		<label for="">Password <small class="text-danger">(*)</small></label>
		<input autocomplete="off" type="password" id="" class="form-control input-sm" name="password" value="">
		</div>
		<div class="col-sm-4 col-md-4">  
		<label for="">Rol <small class="text-danger">(*)</small></label>
                <select class="form-control input-sm" name="rol">
                    <option value="PER" <?php if(isset($values['rol']) and $values['rol'] =='FUN') echo "selected = 'selected'";?>>Personal</option>
					<option value="ADM" <?php if(isset($values['rol']) and $values['rol'] =='ADM') echo "selected = 'selected'";?>>Administrador</option>
				</select>
		</div>
	  </div>
		<div class="sub-seccion col-sm-12 col-md-12">Datos personales</div>
			<div class="form-group">
				
				<div class="col-sm-3 col-sm-offset-6">
					<label for="">Nacionalidad <small class="text-danger">(*)</small></label>
					<div class="input-group">
					<select name="nationality" class="form-control input-sm">
						<option value="V" <?php if(isset($values['nationality']) and $values['nationality'] =='V') echo "selected = 'selected'";?>>V</option>
						<option value="E" <?php if(isset($values['nationality']) and $values['nationality'] =='E') echo "selected = 'selected'";?>>E</option>
					</select>
					</div>
				</div>
				<div class="col-sm-3 ">
					<div class="input-group">
						<label for="">Cédula <small class="text-danger">(*)</small></label>
						<input type="text" autocomplete="off" class="form-control input-sm" id="document" placeholder="" name="document" required maxlength="10" value="<?php if(isset($values['document'])) echo $values['document']?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3">
				<label for="">Primer nombre <small class="text-danger">(*)</small></label>	
					<div class="input-group">
						<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="first_name" required maxlength="50" value="<?php if(isset($values['first_name'])) echo $values['first_name']?>">
					
					</div>
				</div>
				<div class="col-sm-3">
				<label for="">Segundo nombre </label>	
					<div class="input-group">
						<input type="text" class="form-control input-sm" id="" placeholder="" name="second_name"  maxlength="50" value="<?php if(isset($values['second_name'])) echo $values['second_name']?>">
						
					</div>
				</div>
			</div>	
			<div class="form-group">
				<div class="col-sm-3">
					<label for="">Primer apellido <small class="text-danger">(*)</small></label>	
					<div class="input-group">
						<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="first_last_name" maxlength="50" required  value="<?php if(isset($values['first_last_name'])) echo $values['first_last_name']?>">
					
					</div>
				</div>
				<div class="col-sm-3">
				<label for="">Segundo apellido</label>	
					<div class="input-group">
						<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="second_last_name"  maxlength="50"  value="<?php if(isset($values['second_last_name'])) echo $values['second_last_name']?>">
						
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3">
				<label for="">Teléfono <small class="text-danger">(*)</small></label>	
					<div class="input-group">
						<input type="text" autocomplete="off" required class="form-control input-sm" id="" placeholder="" name="phone" maxlength="11" required  value="<?php if(isset($values['phone'])) echo $values['phone']?>">
					
					</div>
				</div>
				<div class="col-sm-3">
				<label for="">Extensión</label>	
					<div class="input-group">
						<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="phone1"  maxlength="4" value="<?php if(isset($values['phone1'])) echo $values['phone1']?>">
						
					</div>
				</div>
				<div class="col-sm-3">
				<label for="">Correo electrónico <small class="text-danger">(*)</small></label>	
					<div class="input-group">
						<input type="email" autocomplete="off" required class="form-control input-sm" id="mail" placeholder="" name="mail"  maxlength="45" value="<?php if(isset($values['mail'])) echo $values['mail']?>">
						
					</div>
				</div>
			</div>
				<div class="col-sm-3">
				<label for="">Ubicación administrativa <small class="text-danger">(*)</small></label>	
					<div class="input-group">
						<select class="form-control input-sm" id="id_ubicacion" name="id_ubicacion" required>
								<option value="">Seleccione...</option>
							<?php if(isset($Ubicaciones_list) and count($Ubicaciones_list)>0):?>
								<?php foreach($Ubicaciones_list as $list):?>
								<option value="<?php echo $list['id_ubicacion']?>" <?php if(isset($values['id_ubicacion']) and $values['id_ubicacion'] == $list['id_ubicacion'] ) echo "selected='selected'";?>><?php echo $list['nom_ubicacion'];?></option>
								<?php endforeach;?>
							<?php endif;?>
							
							
						</select>
					</div>
				</div>
				<div class="col-sm-12">
				<label for="">Tipo personal <small class="text-danger">(*)</small></label>	
					<div class="input-group">
						<select class="form-control input-sm" id="tipo_personal" name="tipo_personal" required>
								<option value="">Seleccione...</option>
							<?php if(isset($tipo_personal_list) and count($tipo_personal_list)>0):?>
								<?php foreach($tipo_personal_list as $list):?>
								<option value="<?php echo $list['des_tipo_personal']?>" <?php if(isset($values['tipo_personal']) and $values['tipo_personal'] == $list['des_tipo_personal'] ) echo "selected='selected'";?>><?php echo $list['des_tipo_personal'];?></option>
								<?php endforeach;?>
							<?php endif;?>
							
							
						</select>
					</div>
				</div>			
		<div class="form-group">
			<div class="col-sm-6">
			  <label class="label label-danger">
				<input type="radio" name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
				Desactivar
			  </label>
			</div>
			<div class="col-sm-6">
			  <label class="label label-success">
				<input type="radio" name="status" id="status" value="1" <?php if(isset($values['status']) and $values['status'] =='1' ) echo "checked=checked"?>>
				Activar
			  </label>
			</div>
		</div>
	  <div class="form-group">
			<div class="col-sm-6">
				<label autocomplete="off" for="">Fecha creado</label>
				<input autocomplete="off"  type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="date_created" value="<?php if(isset($values['date_created'])) echo $values['date_created']?>">
			</div>
			<div class="col-sm-6">
				<label for="">Fecha modificado</label>
				<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="date_updated" value="<?php if(isset($values['date_updated'])) echo $values['date_updated']?>">
			</div>
		</div>
	  <div class="form-group">
		  <div class="col-sm-12">
			<label class="text-danger">Campos requeridos (*)</label>
		  </div>
	  </div>
	  <div class="form-group">
		  <div class="col-sm-12">
		<a class="btn btn-default"  href="<?php echo full_url."/adm/users/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>

		  </div>
	  </div>
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
	<?php if(isset($values['errors']) and count($values['errors'])>0):?>
		<?php $errors_concat = "";foreach($values['errors'] as $errors): ?>
			<?php $errors_concat.='<i class="fa fa-arrow-circle-right"></i> '.$errors."<br>";?>
		<?php endforeach;?>
		<script>
			$(document).ready(function(){
			$('.modal-body').html('<div class="alert alert-danger" role="alert"><?php echo $errors_concat;?></div>');
			$('.modal-title').html('<i class="fa fa-warning alert alert-warning"> Revise la información cargada</i>');
			$('#myModal').modal('show');	
			});

		
		</script> 
    <?php endif;?>
<?php include('../../view_footer.php')?>