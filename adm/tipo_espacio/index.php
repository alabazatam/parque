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
		case "tipo_espacio_list_json":
			executeUserListJson($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('tipo_espacio_list_view.php');
	}
	function executeNew($values = null)
	{       
                $values['status'] = '1';
		$values['action'] = 'add';
		$values['errors'] = array();
		require('tipo_espacio_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$TipoEspacio = new TipoEspacio();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('tipo_espacio_form_view.php');die;
		}else{		
			$values = $TipoEspacio->saveTipoEspacio($values);
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$TipoEspacio = new TipoEspacio();
		$values = $TipoEspacio->getTipoEspacioById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		$values['errors'] = array();
		require('tipo_espacio_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$TipoEspacio = new TipoEspacio();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('tipo_espacio_form_view.php');die;
		}else{
			$id_tipo_espacio = $values['id_tipo_espacio'];
			$values = $TipoEspacio->updateTipoEspacio($values);
			$values['id_tipo_espacio'] = $id_tipo_espacio;
			executeEdit($values,message_created);die;
		}
	}	
	function executeUserListJson($values)
	{
		$TipoEspacio = new TipoEspacio();
		$tipo_espacio_list_json = $TipoEspacio ->getTipoEspacioList($values);
		$tipo_espacio_list_json_cuenta = $TipoEspacio ->getCountTipoEspacioList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $tipo_espacio_list_json_cuenta;
		$array_json['recordsFiltered'] = $tipo_espacio_list_json_cuenta;
		if(count($tipo_espacio_list_json)>0)
		{
			foreach ($tipo_espacio_list_json as $tipo_espacio) 
			{
				$id_tipo_espacio = $tipo_espacio['id_tipo_espacio'];
				$status = $tipo_espacio['status'];
				if($status == 0)
				{
                                       
					$onclick = "onclick = ".'"'."status_changer('tipo_espacio','id_tipo_espacio', '$id_tipo_espacio','1')".'"'."";
 
                                        
					$message_status = "<label class='label label-danger'><a href='#' $onclick>Desactivado</a></label>";
				}
				if($status == 1)
				{
  
					$onclick = "onclick = ".'"'."status_changer('tipo_espacio','id_tipo_espacio', '$id_tipo_espacio','0')".'"'."";
 
                                        
					$message_status = "<label class='label label-success'><a href='#' $onclick>Activo</a></label>";
				}
				
				$array_json['data'][] = array(
					"id_tipo_espacio" => $id_tipo_espacio,
					"nom_tipo_espacio" => $tipo_espacio['nom_tipo_espacio'],
					"status" => $message_status,
                                        "date_created" => $tipo_espacio['date_created'],
                                        "date_updated" => $tipo_espacio['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/tipo_espacio/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_tipo_espacio" value="'.$id_tipo_espacio.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
					"id_tipo_espacio" => null,
					"nom_tipo_espacio" => null,
					"status" => "",
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}