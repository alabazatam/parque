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

