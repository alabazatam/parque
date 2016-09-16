<?php include('../../view_header.php')?>
<?php include('../menu.php')?>


<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
	<h1 class="text-center">Tipo espacio</h1>
	<form class="" action="index.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		 <div class="col-sm-4 col-sm-offset-8">
			<label for="">Id</label>
			<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_tipo_espacio" value="<?php if(isset($values['id_tipo_espacio'])) echo $values['id_tipo_espacio']?>">
		</div>
		</div>
    <div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-6">
				<label for="">Nombre <small class="text-danger">(*)</small></label>		
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="nom_tipo_espacio" value="<?php if(isset($values['nom_tipo_espacio'])) echo $values['nom_tipo_espacio']?>">

				<?php if(isset($values['errors']['nom_tipo_espacio']) and $values['errors']['nom_tipo_espacio']!=''):?>
					<label class="alert alert-danger"><?php echo $values['errors']['nom_tipo_espacio']?></label>
				<?php endif;?>
			</div>
			<div class="col-sm-6">
					
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
		<label class="text-danger">Campos requeridos (*)</label>
		</div>
	</div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/tipo_espacio/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
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