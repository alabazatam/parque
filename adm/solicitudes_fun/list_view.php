<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center">Solicitudes</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id.Solicitud</th>
					<th>Espacio</th>
					<th>Fecha de reservación</th>
					<th>Fecha de solicitud</th>
					<th>Capacidad</th>
					<th>U.T</th>
					<th>Costo</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id.Espacio</th>
					<th>Espacio</th>
					<th>Fecha de reservación</th>
					<th>Fecha de solicitud</th>
					<th>Capacidad</th>
					<th>U.T</th>
					<th>Costo</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</tfoot>
		</table>
	<a class="btn btn-default"  href="<?php echo full_url."/adm/reservacion/index.php"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Generar solicitud</a>
</div>
	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/solicitudes_fun/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "id_solicitud" },
            { "data": "nom_espacio" },
			{ "data": "fec_reservacion" },
			{ "data": "fec_solicitud" },
			{ "data": "capacidad" },
			{ "data": "ut" },
			{ "data": "costo" },
            { "data": "status" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 5 ] }
       ]				
    });
} );

</script>
