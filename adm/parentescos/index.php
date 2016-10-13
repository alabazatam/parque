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
		case "parentescos_list_json":
			executeParentescosListJson($values);	
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
		
		$Parentescos = new Parentescos();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('form_view.php');die;
		}else{		
			$values = $Parentescos->saveParentescos($values);
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Parentescos = new Parentescos();
		$values = $Parentescos->getParentescosById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		$values['errors'] = array();
		require('form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Parentescos = new Parentescos();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('form_view.php');die;
		}else{
			$id_parentesco = $values['id_parentesco'];
			$values = $Parentescos->updateParentescos($values);
			$values['id_parentesco'] = $id_parentesco;
			executeEdit($values,message_created);die;
		}
	}	
	function executeParentescosListJson($values)
	{
		$Parentescos = new Parentescos();
		$parentesco_list_json = $Parentescos ->getParentescosList2($values);
		$parentesco_list_json_cuenta = $Parentescos ->getCountParentescosList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $parentesco_list_json_cuenta;
		$array_json['recordsFiltered'] = $parentesco_list_json_cuenta;
		if(count($parentesco_list_json)>0)
		{
			foreach ($parentesco_list_json as $parentesco) 
			{
				$id_parentesco = $parentesco['id_parentesco'];
				$status = $parentesco['status'];
				if($status == 0)
				{
                                       
					$onclick = "onclick = ".'"'."status_changer('parentescos','id_parentesco', '$id_parentesco','1')".'"'."";
 
                                        
					$message_status = "<label class='label label-danger'><a href='#' $onclick>Desactivado</a></label>";
				}
				if($status == 1)
				{
  
					$onclick = "onclick = ".'"'."status_changer('parentescos','id_parentesco', '$id_parentesco','0')".'"'."";
 
                                        
					$message_status = "<label class='label label-success'><a href='#' $onclick>Activo</a></label>";
				}
				
				$array_json['data'][] = array(
					"id_parentesco" => $id_parentesco,
					"nom_parentesco" => $parentesco['nom_parentesco'],
					"status" => $message_status,
                                        "date_created" => $parentesco['date_created'],
                                        "date_updated" => $parentesco['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/parentescos/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_parentesco" value="'.$id_parentesco.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
					"id_parentesco" => null,
					"nom_parentesco" => null,
					"status" => "",
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}