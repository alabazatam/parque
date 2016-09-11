	function status_changer(table,column_primary, id,value_change){
		$.ajax({
			type: "POST",
			url: "../ajax/index.php" ,
			data: { action: "status_changer", table: table , column_primary:column_primary, id : id , value_change : value_change },
			success: function(){	
				var table = $('#example').DataTable();
				table.ajax.reload();
			}
		});

		
		
	}