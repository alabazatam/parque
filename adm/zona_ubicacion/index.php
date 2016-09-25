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
		case "zona_ubicacion_list_json":
			executeUserListJson($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('zona_ubicacion_list_view.php');
	}
	function executeNew($values = null)
	{       
                $values['status'] = '1';
		$values['action'] = 'add';
		$values['errors'] = array();
		require('zona_ubicacion_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$ZonaUbicacion = new ZonaUbicacion();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('zona_ubicacion_form_view.php');die;
		}else{		
			$values = $ZonaUbicacion->saveZonaUbicacion($values);
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$ZonaUbicacion = new ZonaUbicacion();
		$values = $ZonaUbicacion->getZonaUbicacionById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		$values['errors'] = array();
		require('zona_ubicacion_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$ZonaUbicacion = new ZonaUbicacion();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('zona_ubicacion_form_view.php');die;
		}else{
			$id_zona_ubicacion = $values['id_zona_ubicacion'];
			$values = $ZonaUbicacion->updateZonaUbicacion($values);
			$values['id_zona_ubicacion'] = $id_zona_ubicacion;
			executeEdit($values,message_created);die;
		}
	}	
	function executeUserListJson($values)
	{
		$ZonaUbicacion = new ZonaUbicacion();
		$zona_ubicacion_list_json = $ZonaUbicacion ->getZonaUbicacionList($values);
		$zona_ubicacion_list_json_cuenta = $ZonaUbicacion ->getCountZonaUbicacionList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $zona_ubicacion_list_json_cuenta;
		$array_json['recordsFiltered'] = $zona_ubicacion_list_json_cuenta;
		if(count($zona_ubicacion_list_json)>0)
		{
			foreach ($zona_ubicacion_list_json as $zona_ubicacion) 
			{
				$id_zona_ubicacion = $zona_ubicacion['id_zona_ubicacion'];
				$status = $zona_ubicacion['status'];
				if($status == 0)
				{
                                       
					$onclick = "onclick = ".'"'."status_changer('zona_ubicacion','id_zona_ubicacion', '$id_zona_ubicacion','1')".'"'."";
 
                                        
					$message_status = "<label class='label label-danger'><a href='#' $onclick>Desactivado</a></label>";
				}
				if($status == 1)
				{
  
					$onclick = "onclick = ".'"'."status_changer('zona_ubicacion','id_zona_ubicacion', '$id_zona_ubicacion','0')".'"'."";
 
                                        
					$message_status = "<label class='label label-success'><a href='#' $onclick>Activo</a></label>";
				}
				
				$array_json['data'][] = array(
					"id_zona_ubicacion" => $id_zona_ubicacion,
					"des_zona_ubicacion" => $zona_ubicacion['des_zona_ubicacion'],
					"status" => $message_status,
                                        "date_created" => $zona_ubicacion['date_created'],
                                        "date_updated" => $zona_ubicacion['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/zona_ubicacion/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_zona_ubicacion" value="'.$id_zona_ubicacion.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
					"id_zona_ubicacion" => null,
					"des_zona_ubicacion" => null,
					"status" => "",
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}