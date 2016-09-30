<?php include("../../autoload.php");?>	
<?php //include("validator.php");?>
<?php //include("../security/security.php");?>
<?php $action = "";
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
unset($values['PHPSESSID']);
	switch ($action) {
		case "status_changer":
			executeStatusChanger($values);	
		break;
		case "comprobar_disponibilidad":
			executeComprobarDisponibilidad($values);	
		break;
		case "generar_solicitud":
			executeGenerarSolicitud($values);	
		break;
		case "cambiar_ut":
			executeCambiarUt($values);	
		break;
		case "status_name":
			executeStatusName($values);	
		break;
		case "add_invitado":
			executeAddInvitado($values);	
		break;
		case "update_solicitudes_invitados":
			executeUpdateSolicitudesInvitados($values);	
		break;
		case "delete_solicitudes_invitados":
			executeDeleteSolicitudesInvitados($values);	
		break;
	
	
	}
	function executeStatusChanger($values = null)
	{
		$table = $values['table'];
		$column_primary = $values['column_primary'];
		$id = $values['id'];
		$value_change = $values['value_change'];
		$status_changer = status_changer($table,$column_primary, $id,$value_change);
	}
	function executeComprobarDisponibilidad($values = null)
	{
		$id_espacio = $values['id_espacio'];
		$fec_reservacion = $values['fec_reservacion'];
		$Solicitudes = new Solicitudes();
		$cuenta = $Solicitudes->getDisponibilidadEspacioById($id_espacio, $fec_reservacion);
		$array = array('cuenta'=>$cuenta);
		echo json_encode($array);
		
	}
	function executeGenerarSolicitud($values = null)
	{
		$Solicitudes = new Solicitudes();
		$data = $Solicitudes ->saveEspacios($values);
		$array = array("id_solicitud" => $data['id_solicitud']);
		
		echo json_encode($array);
	}
	function executeCambiarUt($values)
	{
		$UT = new UT();
		
		$actualizar = $UT->updateUT($values);
		$array = array("actualizado" =>$actualizar);
		echo json_encode($array);
	}
	function executeStatusName($values)
	{
		$Status = new Status();
		
		$status_name = $Status->getStatusName($values['id_status']);
		$array = array("status_name" =>$status_name);
		echo json_encode($array);
	}
	function executeAddInvitado($values)
	{
            $Parentescos = new Parentescos();
            $parentescos_list = $Parentescos->getParentescosList();
			$id_solicitud = $values['id_solicitud'];
			$SolicitudesInvitados = new SolicitudesInvitados();
			$values = $SolicitudesInvitados ->saveSolicitudesInvitados($values);
			$values['id_solicitud'] = $id_solicitud;
			//print_r($values);
            require('add_invitado.php');
	}
	function executeUpdateSolicitudesInvitados($values)
	{
			$id_solicitud = $values['id_solicitud'];
			$SolicitudesInvitados = new SolicitudesInvitados();
			$SolicitudesInvitados ->updateSolicitudesInvitados($values);
			
			return json_encode(array('status' => '1'));
	}

		function executeDeleteSolicitudesInvitados($values)
	{
			$id_solinvi = $values['id_solinvi'];
			$SolicitudesInvitados = new SolicitudesInvitados();
			$SolicitudesInvitados ->deleteSolicitudesInvitados($id_solinvi);
			
			return json_encode(array('status' => '1'));
	}



