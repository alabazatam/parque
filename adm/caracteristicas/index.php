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
		case "caracteristicas_list_json":
			executeCaracteristicasListJson($values);	
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
		
		$Caracteristicas = new Caracteristicas();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('form_view.php');die;
		}else{		
			$values = $Caracteristicas->saveCaracteristicas($values);
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Caracteristicas = new Caracteristicas();
		$values = $Caracteristicas->getCaracteristicasById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		$values['errors'] = array();
		require('form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Caracteristicas = new Caracteristicas();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('form_view.php');die;
		}else{
			$id_caracteristica = $values['id_caracteristica'];
			$values = $Caracteristicas->updateCaracteristicas($values);
			$values['id_caracteristica'] = $id_caracteristica;
			executeEdit($values,message_created);die;
		}
	}	
	function executeCaracteristicasListJson($values)
	{
		$Caracteristicas = new Caracteristicas();
		$caracteristicas_list_json = $Caracteristicas ->getCaracteristicasList($values);
		$caracteristicas_list_json_cuenta = $Caracteristicas ->getCountCaracteristicasList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $caracteristicas_list_json_cuenta;
		$array_json['recordsFiltered'] = $caracteristicas_list_json_cuenta;
		if(count($caracteristicas_list_json)>0)
		{
			foreach ($caracteristicas_list_json as $caracteristicas) 
			{
				$id_caracteristica = $caracteristicas['id_caracteristica'];
				$status = $caracteristicas['status'];
				if($status == 0)
				{
                                       
					$onclick = "onclick = ".'"'."status_changer('caracteristicas','id_caracteristica', '$id_caracteristica','1')".'"'."";
 
                                        
					$message_status = "<label class='label label-danger'><a href='#' $onclick>Desactivado</a></label>";
				}
				if($status == 1)
				{
  
					$onclick = "onclick = ".'"'."status_changer('caracteristicas','id_caracteristica', '$id_caracteristica','0')".'"'."";
 
                                        
					$message_status = "<label class='label label-success'><a href='#' $onclick>Activo</a></label>";
				}
				
				$array_json['data'][] = array(
					"id_caracteristica" => $id_caracteristica,
					"nom_caracteristica" => $caracteristicas['nom_caracteristica'],
					"status" => $message_status,
                                        "date_created" => $caracteristicas['date_created'],
                                        "date_updated" => $caracteristicas['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/caracteristicas/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_caracteristica" value="'.$id_caracteristica.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
					"id_caracteristica" => null,
					"nom_caracteristica" => null,
					"status" => "",
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}