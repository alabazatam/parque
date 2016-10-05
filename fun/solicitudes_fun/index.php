<?php include("../../autoload.php");?>	
<?php include("validator.php");?>
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
		case "edit":
			executeEdit($values);	
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
       
		$values['action'] = 'add';
		$values['errors'] = array();
		require('form_view.php');
	}
	function executeSave($values = null)
	{
		
	}
	function executeEdit($values = null,$msg = null)
	{
		
                $errors = @$values['errors'];
                        
		$Solicitudes = new Solicitudes();
		$values = $Solicitudes->getSolicitudById($values);
		$SolicitudesInvitados = new SolicitudesInvitados();
		$solicitudes_invitados_list = $SolicitudesInvitados ->getSolicitudesInvitadosList($values);
                $SolicitudesMovimientos = new SolicitudesMovimientos();
                $observacion = $SolicitudesMovimientos->getObservacion($values);
                $values['action'] = 'update';
                $values['msg'] = $msg;
                $values['errors'] = $errors;
                        
		require('form_view.php');
	}
	function executeUpdate($values = null)
	{
		$Solicitudes = new Solicitudes();
		$errors = validate($values);
                //echo $values['id_status'];die;
                        
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
                        executeEdit($values);die;
		}else{	
                    
			$id_solicitud= $values['id_solicitud'];	
			if(isset($values['id_status']) and  $values['id_status']== 5)
			{
				$values['status'] = 6;//status a cambiar
			}
			if(isset($values['id_status']) and  $values['id_status']== 3)
			{
				$values['status'] = 4;//status a cambiar
			}
			$carpeta = "../../web/files/recibo/";
			$nombrearchivo = '';
                        if(isset($_FILES["recibo"]['tmp_name']) and $_FILES["recibo"]['tmp_name']!=''){
						
                                $nombrearchivo = "recibo_".$values['id_solicitud'].".".strtolower(pathinfo($_FILES['recibo']['name'],PATHINFO_EXTENSION));
                                //echo $nombrearchivo;
				//echo $_FILES["file_$i"]['tmp_name']."".$i."<br>";
				if (move_uploaded_file($_FILES['recibo']['tmp_name'], $carpeta."".$nombrearchivo))
				{

				
				}
			$values['recibo'] = $nombrearchivo; 		
			}  
			$values = $Solicitudes->updateSolicitud($values);
			$values['id_solicitud'] = $id_solicitud;
			executeEdit($values,message_created);die;
		}
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
                                        "id_status" => $solicitud['id_status'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/fun/solicitudes_fun/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_solicitud" value="'.$id_solicitud.'">  '
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
                                        "id_status" => null,
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}
