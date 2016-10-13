<?php include("../../autoload.php");?>	
<?php include("../security/security.php");?>
<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "reservacion":
			executeReservacion($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		
	}
	function executeReservacion($values = null)
	{
		$Planillas = new Planillas();
		$Planillas -> reservacion($values);
	}
