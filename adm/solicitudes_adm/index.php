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
		
		$Espacios = new Espacios();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('espacios_form_view.php');die;
		}else{		
			$values = $Espacios->saveEspacios($values);	
			
			$id_espacio = $values['id_espacio'];
			$EspaciosImagenes = new EspaciosImagenes();
			$array_imagenes = array();
			$carpeta = "../../web/files/espacios/";
			$nombrearchivo = '';
			for($i=1;$i<=4;$i++)
			{
				if(isset($_FILES["file_$i"]['tmp_name']) and $_FILES["file_$i"]['tmp_name']!=''){
						
						$nombrearchivo = "ESPACIO_".$values['id_espacio']."_".$i.".".strtolower(pathinfo($_FILES['file_'.$i]['name'],PATHINFO_EXTENSION));
						//echo $nombrearchivo;
						//echo $_FILES["file_$i"]['tmp_name']."".$i."<br>";
						if (move_uploaded_file($_FILES['file_'.$i]['tmp_name'], $carpeta."".$nombrearchivo))
						{
							
							
							//$EspaciosImagenes->deleteEspaciosImagenes($id_espacio, $i);
							$array_imagenes = array(
								"id_espacio" => $values['id_espacio'],
								"imagen" => $nombrearchivo,
								"orden"=> $i

							);
							$EspaciosImagenes->saveEspaciosImagenes($array_imagenes);
						}
					
				}
			}
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Solicitudes = new Solicitudes();
		$values = $Solicitudes->getSolicitudById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		$values['errors'] = array();
		require('form_view.php');
	}
	function executeUpdate($values = null)
	{
		$Solicitudes = new Solicitudes();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('form_view.php');die;
		}else{	

			$id_solicitud = $values['id_solicitud'];			
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
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/solicitudes_adm/index.php" >'
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
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}
