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
		case "ubicaciones_list_json":
			executeUbicacionesListJson($values);	
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
                $values['status'] = '1';
		$values['action'] = 'add';
		$values['errors'] = array();
		require('form_view.php');
	}
	function executeSave($values = null)
	{
		
		$Ubicaciones = new Ubicaciones();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('form_view.php');die;
		}else{		
			$values = $Ubicaciones->saveUbicaciones($values);
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Ubicaciones = new Ubicaciones();
		$values = $Ubicaciones->getUbicacionesById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		$values['errors'] = array();
		require('form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Ubicaciones = new Ubicaciones();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('form_view.php');die;
		}else{
			$id_ubicacion = $values['id_ubicacion'];
			$values = $Ubicaciones->updateUbicaciones($values);
			$values['id_ubicacion'] = $id_ubicacion;
			executeEdit($values,message_created);die;
		}
	}	
	function executeUbicacionesListJson($values)
	{
		$Ubicaciones = new Ubicaciones();
		$ubicacion_list_json = $Ubicaciones ->getUbicacionesList2($values);
		$ubicacion_list_json_cuenta = $Ubicaciones ->getCountUbicacionesList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $ubicacion_list_json_cuenta;
		$array_json['recordsFiltered'] = $ubicacion_list_json_cuenta;
		if(count($ubicacion_list_json)>0)
		{
			foreach ($ubicacion_list_json as $ubicacion) 
			{
				$id_ubicacion = $ubicacion['id_ubicacion'];
				$status = $ubicacion['status'];
				if($status == 0)
				{
                                       
					$onclick = "onclick = ".'"'."status_changer('ubicaciones','id_ubicacion', '$id_ubicacion','1')".'"'."";
 
                                        
					$message_status = "<label class='label label-danger'><a href='#' $onclick>Desactivado</a></label>";
				}
				if($status == 1)
				{
  
					$onclick = "onclick = ".'"'."status_changer('ubicaciones','id_ubicacion', '$id_ubicacion','0')".'"'."";
 
                                        
					$message_status = "<label class='label label-success'><a href='#' $onclick>Activo</a></label>";
				}
				
				$array_json['data'][] = array(
					"id_ubicacion" => $id_ubicacion,
					"nom_ubicacion" => $ubicacion['nom_ubicacion'],
					"status" => $message_status,
                                        "date_created" => $ubicacion['date_created'],
                                        "date_updated" => $ubicacion['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/ubicaciones/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_ubicacion" value="'.$id_ubicacion.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
					"id_ubicacion" => null,
					"nom_ubicacion" => null,
					"status" => "",
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}