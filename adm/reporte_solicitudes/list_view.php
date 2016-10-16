<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<?php 
	
	$TipoPersonal = new TipoPersonal();
	$tipo_personal_list = $TipoPersonal->getTipoPersonalList();
	$Espacios = new Espacios();
	$espacios_list = $Espacios->getEspaciosListSelect();
	$Ubicaciones = new Ubicaciones();
	$ubicaciones_list = $Ubicaciones->getUbicacionesList();
	
	
?>
	<div class="col-sm-12 col-md-12">
		<div class="col-sm-3 col-md-3 alert alert-success" role="alert">Aceptada o Completada</div>
		<div class="col-sm-3 col-md-3 alert alert-warning" role="alert">Esperando por su respuesta</div>
		<div class="col-sm-3 col-md-3 alert alert-info" role="alert">En espera de respuesta de un tercero</div>
		<div class="col-sm-3 col-md-3 alert alert-danger" role="alert">Cancelada</div>


	</div>
	<h1 class="text-center">Solicitudes</h1>
 	<div class="col-sm-12 col-md-12 alert">
		<div class="col-sm-2 col-md-2">
			<label>Fecha desde: </label>
			<input id="desde" name="desde" type="text">
		</div>
		<div class="col-sm-2 col-md-2">
			<label>Fecha hasta: </label>
			<input id="hasta" name="hasta" type="text">
		</div>
		<div class="col-sm-2 col-md-2">
			<label>Tipo personal: </label>
			<select id="id_tipo_personal" name='id_tipo_personal' class="form-control input-sm">
				<option value="">Seleccione...</option>
				<?php foreach($tipo_personal_list as $list):?>
					<option value="<?php echo $list['id_tipo_personal'];?>"><?php echo $list['des_tipo_personal'];?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="col-sm-2 col-md-2">
			<label>Espacio: </label>
			<select id="id_espacio" name='id_espacio' class="form-control input-sm">
				<option value="">Seleccione...</option>
				<?php foreach($espacios_list as $list):?>
					<option value="<?php echo $list['id_espacio'];?>"><?php echo $list['nom_espacio'];?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="col-sm-2 col-md-2">
			<label>Ubicacion administrativa: </label>
			<select id="id_ubicacion" name='id_ubicacion' class="form-control input-sm">
				<option value="">Seleccione...</option>
				<?php foreach($ubicaciones_list as $list):?>
					<option value="<?php echo $list['id_ubicacion'];?>"><?php echo $list['nom_ubicacion'];?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="col-sm-2 col-md-2">
			<label>Espacio: </label>
			<input id="desde" name="desde" type="text">
		</div>
	</div> 
		<div class="col-sm-2 col-sm-offset-10 ">
			<a id="buscar" class="btn btn-success"><i class="fa fa-filter"></i> Filtrar</a>
		</div>	
	<table id="example" class="table table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id.Solicitud</th>
					<th>Espacio</th>
					<th>Fecha de reservación</th>
					<th>Costo</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id.Solicitud</th>
					<th>Espacio</th>
					<th>Fecha de reservación</th>
					<th>Costo</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</tfoot>
		</table>
	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
   var table =  $('#example').DataTable({
		dom: 'Bfrtip',
        "scrollX": true,
        "processing": true,
        "serverSide": true,
		"bFilter": false,
        "ajax": "<?php echo full_url."/adm/reporte_solicitudes/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
			"data": function(d) {
                    d.desde = $('#desde').val();
                    d.hasta =  $('#hasta').val();
					d.id_tipo_personal = $('#id_tipo_personal').val();
					d.id_espacio = $('#id_espacio').val();
					d.id_ubicacion = $('#id_ubicacion').val();
					}
			},
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],		
		"rowCallback": function( row, data, index ) {
            if ( data.id_status == "2" || data.id_status == "4" || data.id_status == "6") 
            {
                    $(row).addClass('alert alert-warning');            
            }else
            if ( data.id_status == "7") 
            {
                $(row).addClass('alert alert-success');
                    //$(row).css("background-color","#DFF0D8");            
            }else
            if ( data.id_status == "8") 
            {
                    $(row).addClass('alert alert-danger');            
            }else
            {
                    $(row).addClass('alert alert-info');            
            }

        },     
        "columns": [
            { "data": "id_solicitud" },
            { "data": "nom_espacio" },
			{ "data": "fec_reservacion" },
			{ "data": "costo" },
            { "data": "status" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 5 ] }
       ]				
    });
	$('#buscar').click(function(){
		 table.draw();
	});

} );

</script>
