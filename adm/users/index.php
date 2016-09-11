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
		case "users_list_json":
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
	require('users_list_view.php');
	}
	function executeNew($values = null)
	{       
                $values['status'] = '1';
		$values['action'] = 'add';
		require('users_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$Users = new Users();
		$values = $Users->saveUser($values);
		executeEdit($values,message_created);die;
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Users = new Users();
		$values = $Users->getUserById($values);
		$values['action'] = 'update';
                $values['msg'] = $msg;
		require('users_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Users = new Users();
		$Users->updateUser($values);		
		executeEdit($values,message_updated);die;
	}	
	function executeUserListJson($values)
	{
		$Users = new Users();
		$users_list_json = $Users ->getUsersList($values);
		$users_list_json_cuenta = $Users ->getCountUsersList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $users_list_json_cuenta;
		$array_json['recordsFiltered'] = $users_list_json_cuenta;
		if(count($users_list_json)>0)
		{
			foreach ($users_list_json as $user) 
			{
				$id_user = $user['id_user'];
				$status = $user['status'];
				if($status == 0)
				{
                                        $onclick = "";
                                        if($_SESSION['rol'] == "ADM")
                                        {
                                            $onclick = "onclick = ".'"'."status_changer('users','id_user', '$id_user','1')".'"'."";
 
                                        }
					$message_status = "<label class='label label-danger'><a href='#' $onclick>Desactivado</a></label>";
				}
				if($status == 1)
				{
                                        $onclick = "";
                                        if($_SESSION['rol'] == "ADM")
                                        {
                                            $onclick = "onclick = ".'"'."status_changer('users','id_user', '$id_user','0')".'"'."";
 
                                        }
					$message_status = "<label class='label label-success'><a href='#' $onclick>Activo</a></label>";
				}
				
				$array_json['data'][] = array(
					"id_user" => $id_user,
					"login" => $user['login'],
					"password" => "******",
					"status" => $message_status,
                                        "date_created" => $user['date_created'],
                                        "date_updated" => $user['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/users/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_user" value="'.$id_user.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("id_user"=>null,"login"=>"","password"=>"","status"=>"","date_created"=>"","date_updated"=>"","actions"=>"");
		}

		echo json_encode($array_json);die;
		
	}
	function executeChangePassView($values){
		
		$values['action'] = "change_pass";
		require('change_pass_view.php');
		
	}
	function executeChangePass($values){
		
		
		$Users = new Users();
		
		if($values['new_password'] != $values['retype_password'])
		{
			$values['error'] = "La clave nueva no coincide al repetirla";
			
		}elseif($values['new_password'] == '' or $values['retype_password']=='')
		{
			$values['error'] = "Debe indicar la clave nueva y repetirla";
		}else{
			$valid = $Users->comparePasswordByUser($values);
			if($valid == true)
			{
				$Users->changePassword($values);
				$values['msg'] = message_updated;	

			}else
			{
				$values['error'] = "La clave actual no coincide";

			}			
			
			
		}
		
		
		


		require('change_pass_view.php');die;
		//executeChangePass($values);die;
		
		
	}