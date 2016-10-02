<?php include("../../autoload.php");?>	
<?php //include("validator.php");?>
<?php include("../security/security.php");?>

<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
$values = array_merge($values,$_FILES);
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "parcial_espacio":
			executeParcialEspacio($values);	
		break;
		case "parcial_solicitud":
			executeParcialSolicitud($values);	
		break;		
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		echo "nada";die;
	}
	function executeParcialEspacio($values = null)
	{
		
		$Espacios = new Espacios();
		
		$data = $Espacios->getEspaciosDescripcionById($values);
		require('espacio_view.php');
	}
	function executeParcialSolicitud($values = null)
	{
		
		$Solicitudes = new Solicitudes();
		
		$data = $Solicitudes->getSolicitudById($values);
		require('solicitud_view.php');
	}
