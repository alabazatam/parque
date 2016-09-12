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
		case "espacios_list_json":
			executeUserListJson($values);	
		break;
		case "change_pass_view":
			executeChangePassView($values);	
		break;
		case "change_pass":
			executeChangePass($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('espacios_list_view.php');
	}
	function executeNew($values = null)
	{       
                $values['status'] = '1';
		$values['action'] = 'add';
		$values['errors'] = array();
		require('espacios_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$Espacios = new Espacios();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('espacios_form_view.php');die;
		}else{		
			$values = $Espacios->saveEspacios($values);			
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Espacios = new Espacios();
		$values = $Espacios->getEspaciosById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		$values['errors'] = array();
		require('espacios_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Espacios = new Espacios();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('espacios_form_view.php');die;
		}else{		
			$values = $Espacios->updateEspacios($values);			
			executeEdit($values,message_created);die;
		}
	}	
	function executeUserListJson($values)
	{
		$Espacios = new Espacios();
		$espacios_list_json = $Espacios ->getEspaciosList($values);
		$espacios_list_json_cuenta = $Espacios ->getCountEspaciosList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $espacios_list_json_cuenta;
		$array_json['recordsFiltered'] = $espacios_list_json_cuenta;
		if(count($espacios_list_json)>0)
		{
			foreach ($espacios_list_json as $espacio) 
			{
				$id_espacio = $espacio['id_espacio'];
				$status = $espacio['status'];
				if($status == 0)
				{
                                       
                $onclick = "onclick = ".'"'."status_changer('espacios','id_espacio', '$id_espacio','1')".'"'."";
 
                                        
					$message_status = "<label class='label label-danger'><a href='#' $onclick>Desactivado</a></label>";
				}
				if($status == 1)
				{
  
					$onclick = "onclick = ".'"'."status_changer('espacios','id_espacio', '$id_espacio','0')".'"'."";
 
                                        
					$message_status = "<label class='label label-success'><a href='#' $onclick>Activo</a></label>";
				}
				
				$array_json['data'][] = array(
					"id_espacio" => $id_espacio,
					"nom_espacio" => $espacio['nom_espacio'],
					"des_espacio" => $espacio['des_espacio'],
					"capacidad" => $espacio['capacidad'],
					"ut" => $espacio['ut'],
					"nom_tipo_espacio" => $espacio['nom_tipo_espacio'],
					"des_zona_ubicacion" => $espacio['des_zona_ubicacion'],
					"status" => $message_status,
                                        "date_created" => $espacio['date_created'],
                                        "date_updated" => $espacio['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/espacios/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_espacio" value="'.$id_espacio.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
					"id_espacio" => null,
					"nom_espacio" => null,
					"des_espacio" => null,
					"capacidad" => null,
					"ut" => null,
					"nom_tipo_espacio" => null,
					"des_zona_ubicacion" => null,
					"status" => "",
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}
	function executeChangePassView($values){
		
		$values['action'] = "change_pass";
		require('change_pass_view.php');
		
	}
	function executeChangePass($values){
		
		
		$Espacios = new Espacios();
		
		if($values['new_password'] != $values['retype_password'])
		{
			$values['error'] = "La clave nueva no coincide al repetirla";
			
		}elseif($values['new_password'] == '' or $values['retype_password']=='')
		{
			$values['error'] = "Debe indicar la clave nueva y repetirla";
		}else{
			$valid = $Espacios->comparePasswordByUser($values);
			if($valid == true)
			{
				$Espacios->changePassword($values);
				$values['msg'] = message_updated;	

			}else
			{
				$values['error'] = "La clave actual no coincide";

			}			
			
			
		}
		
		
		


		require('change_pass_view.php');die;
		//executeChangePass($values);die;
		
		
	}