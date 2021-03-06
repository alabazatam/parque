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
			
			

			if(isset($values['id_caracteristica']) and count($values['id_caracteristica']))
			{
				$id_caracterisca = $values['id_caracteristica'];
			}
			$values = $Espacios->saveEspacios($values);	
			
			$id_espacio = $values['id_espacio'];
			$EspaciosCaracteristicas = new EspaciosCaracteristicas();
			$EspaciosCaracteristicas->deleteEspaciosCaracteristicas($id_espacio);
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
			
			if(isset($id_caracterisca) and count($id_caracterisca))
			{
				
				foreach($id_caracterisca as $key => $valor)
				{
					
					$values['id_caracteristica'] = $valor;
					$EspaciosCaracteristicas->saveEspaciosCaracteristicas($values);
				}
			}
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Espacios = new Espacios();
		$values = $Espacios->getEspaciosById($values);
		$EspaciosImagenes = new EspaciosImagenes();
		
		$imagenes = $EspaciosImagenes ->getImagenesEspaciosById($values);
		
		$i = 0;
		$imagenes_list = array();
		foreach($imagenes as $img){
			$imagenes_list[$i]['orden'] = $img['orden'];
			$imagenes_list[$i]['imagen'] = $img['imagen'];
		
			$i++;
		}
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

			$id_espacio = $values['id_espacio'];
			//elimino las caracteristicas para volver a crear las que seleccione
			
			$EspaciosCaracteristicas = new EspaciosCaracteristicas();
			$EspaciosCaracteristicas->deleteEspaciosCaracteristicas($id_espacio);
			if(isset($values['id_caracteristica']) and count($values['id_caracteristica']))
			{
				$id_caracterisca = $values['id_caracteristica'];
			}
			$values = $Espacios->updateEspacios($values);
			$values['id_espacio'] = $id_espacio;
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
							$EspaciosImagenes->deleteEspaciosImagenes($id_espacio, $i);
							$array_imagenes = array(
								"id_espacio" => $values['id_espacio'],
								"imagen" => $nombrearchivo,
								"orden"=> $i

							);
							$EspaciosImagenes->saveEspaciosImagenes($array_imagenes);
						}
					
				}
			}
			
			//print_r($values);die;
			if(isset($id_caracterisca) and count($id_caracterisca))
			{
				foreach($id_caracterisca as $key => $valor)
				{
					$values['id_caracteristica'] = $valor;;
					$EspaciosCaracteristicas->saveEspaciosCaracteristicas($values);
				}
			}
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
