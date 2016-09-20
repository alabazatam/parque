<?php include('../../view_header.php')?>
<?php include('../menu.php')?>
<div class="container" id="">
	
	

	<h1 class="text-center">Generar solicitud</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Descripcion</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Descripcion</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>Acciones</th>
				</tr>
			</tfoot>
		</table>
	<a class="btn btn-default"  href="<?php echo full_url."/adm/solicitudes_fun/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>
</div>
	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/solicitudes_fun/index.php?action=espacios_list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "des_espacio" },
			{ "data": "imagen1" },
			{ "data": "imagen2" },
			{ "data": "imagen3" },
			{ "data": "imagen4" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 1,2,3,4,5 ] }
       ]				
    });
} );

function openImage(image,description){
			//alert(image);
			var html = '';
			
			html+='<div class="col-sm-12 col-md-12"><img src="<?php echo full_url?>/web/files/espacios/'+image+'" width="100%">';
			html+='</img></div>';
			html+='<div class="col-sm-12 col-md-12">';
			html+='<p>' + description + '</p>';
			html+='</div>';			
			$('.modal-body').html(html);
			$('.modal-title').html('');
			$('#myModal').modal('show');	
}

</script>
