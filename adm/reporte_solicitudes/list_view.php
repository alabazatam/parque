<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<?php 
	
	$TipoPersonal = new TipoPersonal();
	$tipo_personal_list = $TipoPersonal->getTipoPersonalList();
	$Espacios = new Espacios();
	$espacios_list = $Espacios->getEspaciosListSelect();
	$Ubicaciones = new Ubicaciones();
	$ubicaciones_list = $Ubicaciones->getUbicacionesList();
        $Status = new Status();
        $status_list = $Status->getListStatusSolicitud();
	
	
?>
	<h1 class="text-center">Solicitudes</h1>
        <div class="col-sm-12 col-md-12 alert" style="background-color: #CCC;">
		<div class="col-sm-6 col-md-2">
			<label>Fecha desde: </label>
			<input id="desde" name="desde" type="text">
		</div>
		<div class="col-sm-6 col-md-2">
			<label>Fecha hasta: </label>
			<input id="hasta" name="hasta" type="text">
		</div>
		<div class="col-sm-3 col-md-3">
			<label>Espacio: </label>
			<select id="id_espacio" name='id_espacio' class="form-control input-sm">
				<option value="">Seleccione...</option>
				<?php foreach($espacios_list as $list):?>
					<option value="<?php echo $list['id_espacio'];?>"><?php echo $list['nom_espacio'];?></option>
				<?php endforeach;?>
			</select>
		</div>       
		<div class="col-sm-3 col-md-3">
			<label>Tipo personal: </label>
			<select id="des_tipo_personal" name='des_tipo_personal' class="form-control input-sm">
				<option value="">Seleccione...</option>
				<?php foreach($tipo_personal_list as $list):?>
					<option value="<?php echo $list['des_tipo_personal'];?>"><?php echo $list['des_tipo_personal'];?></option>
				<?php endforeach;?>
			</select>
		</div>

		<div class="col-sm-3 col-md-3">
			<label>Ubicacion administrativa: </label>
			<select id="id_ubicacion" name='id_ubicacion' class="form-control input-sm">
				<option value="">Seleccione...</option>
				<?php foreach($ubicaciones_list as $list):?>
					<option value="<?php echo $list['id_ubicacion'];?>"><?php echo $list['nom_ubicacion'];?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="col-sm-3 col-md-3">
			<label>Cédula: <small>V-12345678</small></label>
                        <input id="cedula" name="cedula" type="text" autocomplete="off" maxlength="12">
		</div>
	<div class="col-sm-12 col-md-12">
			<label>Status:</label>
			<select id="id_status" name='id_status' class="form-control input-sm">
				<option value="">Seleccione...</option>
				<?php foreach($status_list as $list):?>
					<option value="<?php echo $list['id_status'];?>"><?php echo $list['name'];?></option>
				<?php endforeach;?>
			</select>
		</div> 
	</div> 
		<div class="col-sm-2 col-sm-offset-10 ">
			<a id="buscar" class="btn btn-success"><i class="fa fa-filter"></i> Filtrar</a>
		</div>	
	<table id="example" class="table table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id.Solicitud</th>
                                        <th>Cédula</th>
                                        <th>Solicitante</th>
					<th>Espacio</th>
					<th>Fecha de reservación</th>
					<th>Costo</th>
					<th>Status</th>
					<th>Acciones</th>
                                        <th>Tipo de personal</th>
                                        <th>Ubicación administrativa</th>
                                        <th>Fecha de solicitud</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id.Solicitud</th>
                                        <th>Cédula</th>
                                        <th>Solicitante</th>
					<th>Espacio</th>
					<th>Fecha de reservación</th>
					<th>Costo</th>
					<th>Status</th>
					<th>Acciones</th>
                                        <th>Tipo de personal</th>
                                        <th>Ubicación administrativa</th>
                                        <th>Fecha de solicitud</th>
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
        "ajax": {
                    "url":"<?php echo full_url."/adm/reporte_solicitudes/index.php?action=list_json"?>",
                    "data": function(d) {
                    d.desde = $('#desde').val();
                    d.hasta =  $('#hasta').val();
					d.des_tipo_personal = $('#des_tipo_personal').val();
					d.id_espacio = $('#id_espacio').val();
					d.id_ubicacion = $('#id_ubicacion').val();
                                        d.cedula = $('#cedula').val();
                                        d.id_status = $('#id_status').val();
					}
			},	
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],		
		  
        "columns": [
            { "data": "id_solicitud" },
            { "data": "cedula" },
            { "data": "solicitante" },
            { "data": "nom_espacio" },
            { "data": "fec_reservacion" },
            { "data": "costo" },
            { "data": "status" },
            { "data": "actions" },
            { "data": "tipo_personal" },
            { "data": "nom_ubicacion" },
            { "data": "fec_solicitud" },
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 7 ] },
          {
                "targets": [ 8,9,10 ],
                "visible": false
          }
       ]				
    });
	$('#buscar').click(function(){
		 table.draw();
	});

} );

</script>
