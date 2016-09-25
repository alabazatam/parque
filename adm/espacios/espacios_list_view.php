<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center">Espacios</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id.Espacio</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Capacidad</th>
					<th>U.T</th>
					<th>Tipo espacio</th>
					<th>Zona/Ubicación</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id.Espacio</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Capacidad</th>
					<th>U.T</th>
					<th>Tipo espacio</th>
					<th>Zona/Ubicación</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</tfoot>
		</table>
	<a class="btn btn-default"  href="<?php echo full_url."/adm/espacios/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>
</div>
	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/espacios/index.php?action=espacios_list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "id_espacio" },
            { "data": "nom_espacio" },
            { "data": "des_espacio" },
			{ "data": "capacidad" },
			{ "data": "ut" },
			{ "data": "nom_tipo_espacio" },
			{ "data": "des_zona_ubicacion" },
            { "data": "status" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 8 ] }
       ]				
    });
} );

</script>
