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
		case "new":
			executeNew($values);	
		break;
		case "add":
			executeSave($values);	
		break;
		case "view":
			executeView($values);	
		break;
		case "update":
			executeUpdate($values);	
		break;		
		case "list_json":
			executeListJson($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('list_view.php');
	}
	function executeNew($values = null)
	{       

	}
	function executeSave($values = null)
	{
		

	}
	function executeView($values = null,$msg = null)
	{
		$UT = new UT();
		$values = $UT->getUTData();
		require('form_view.php');die;
	}
	function executeUpdate($values = null)
	{
		

	}	
	function executeListJson($values)
	{
		$Solicitudes= new Solicitudes();
		$list_json = $Solicitudes->getSolicitudesFunList($values);
		$list_json_cuenta = $Solicitudes->getCountSolicitudesFunList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $solicitud) 
			{
				$id_solicitud= $solicitud['id_solicitud'];
				$id_espacio= $solicitud['id_espacio'];

				
				$array_json['data'][] = array(
					"id_solicitud" => $id_solicitud,
					"nom_espacio" => $solicitud['nom_espacio'],
					"fec_reservacion" => $solicitud['fec_reservacion'],
					"fec_solicitud" => $solicitud['fec_solicitud'],
					"capacidad" => $solicitud['capacidad']." Personas",
					"ut" => $solicitud['ut'],
					"costo" => $solicitud['costo']." Bs",
					"status" => $solicitud['status'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/solicitudes_fun/index.php" >'
                                       .'<input type="hidden" name="action" value="view">  '
                                       .'<input type="hidden" name="id_espacio" value="'.$id_solicitud.'">  '
									   .'<input type="hidden" name="id_espacio" value="'.$id_espacio.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
					"id_solicitud" => null,
					"nom_espacio" => null,
					"fec_reservacion" => null,
					"fec_solicitud" => null,
					"capacidad" => null,
					"ut" => null,
					"costo" => null,
					"status" => null,
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}
