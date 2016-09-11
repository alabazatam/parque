<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<?php if($_SESSION['rol'] != "ADM"):?>
<script>
    
    $(document).ready(function(){
        
        $(":radio").prop("disabled", true);        
        
    });
</script>    
<?php endif;?>
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
	<h1 class="text-center">Usuarios</h1>
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		<label for="">Id.Usuario</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_user" value="<?php if(isset($values['id_user'])) echo $values['id_user']?>">
	  </div>
	  <div class="form-group">
		<label for="">Login <small class="text-danger">(*)</small></label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="login" value="<?php if(isset($values['login'])) echo $values['login']?>">
	  </div>
	  <div class="form-group">
		<label for="">Password <small class="text-danger">(*)</small></label>
		<input autocomplete="off" type="password" id="" class="form-control input-sm" name="password" value="">
	  </div>
	  <div class="form-group">
		<label for="">Rol <small class="text-danger">(*)</small></label>
                <select class="form-control input-sm" name="rol">
                    <option value="ADM" <?php if(isset($values['rol']) and $values['rol'] =='ADM') echo "selected = 'selected'";?>>Administrador</option>
                    <option value="SEC" <?php if(isset($values['rol']) and $values['rol'] =='SEC') echo "selected = 'selected'";?>>Asistente/Secretaria</option>
                    <option value="REP" <?php if(isset($values['rol']) and $values['rol'] =='REP') echo "selected = 'selected'";?>>Sólo reportes</option>
                </select>
	  </div>
		<div class="form-group">
		  <label class="label label-danger">
			<input type="radio" name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
			Desactivar
		  </label>
		</div>
		<div class="form-group">
		  <label class="label label-success">
			<input type="radio" name="status" id="status" value="1" <?php if(isset($values['status']) and $values['status'] =='1' ) echo "checked=checked"?>>
			Activar
		  </label>
		</div>	
	  <div class="form-group">
		<label autocomplete="off" for="">Fecha creado</label>
		<input autocomplete="off"  type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="date_created" value="<?php if(isset($values['date_created'])) echo $values['date_created']?>">
	  </div>
	  <div class="form-group">
		<label for="">Fecha modificado</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="date_updated" value="<?php if(isset($values['date_updated'])) echo $values['date_updated']?>">
	  </div>
	  <div class="form-group">
			<label class="text-danger">Campos requeridos (*)</label>
	  </div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/users/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
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