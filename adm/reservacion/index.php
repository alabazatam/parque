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
	require('solicitudes_fun_list_view.php');
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
		$EspaciosImagenes = new EspaciosImagenes();
		if(count($espacios_list_json)>0)
		{
			foreach ($espacios_list_json as $espacio) 
			{
				$id_espacio = $espacio['id_espacio'];
				$espacios_imagenes_list = $EspaciosImagenes->getImagenesEspaciosById($espacio);
				$array_imagenes = array();
				$i = 1;
				$array_imagenes['imagen1'] = '<div class="row">
											<div class="col-xs-12 col-md-12">
											  <a href="#" class="thumbnail">
												<img src="'.full_url.'/web/files/espacios/no_thumb.png" alt="..." width="100">
											  </a>
											</div>
										</div>';	
				$array_imagenes['imagen2'] = '<div class="row">
											<div class="col-xs-12 col-md-12">
											  <a href="#" class="thumbnail">
												<img src="'.full_url.'/web/files/espacios/no_thumb.png" alt="..." width="100">
											  </a>
											</div>
										</div>';
				$array_imagenes['imagen3'] = '<div class="row">
											<div class="col-xs-12 col-md-12">
											  <a href="#" class="thumbnail">
												<img src="'.full_url.'/web/files/espacios/no_thumb.png" alt="..." width="100">
											  </a>
											</div>
										</div>';	
				$array_imagenes['imagen4'] = '<div class="row">
											<div class="col-xs-12 col-md-12">
											  <a href="#" class="thumbnail">
												<img src="'.full_url.'/web/files/espacios/no_thumb.png" alt="..." width="100">
											  </a>
											</div>
										</div>';
					foreach($espacios_imagenes_list as $img):
						
					
					if(isset($img['orden']) and $img['orden'] !='')
					{
						$imagen = $img['imagen'];
						$descripcion = $espacio['des_espacio'];
						$array_imagenes['imagen'.$img['orden']] ='<div class="row">
											<div class="col-xs-12 col-md-12">
											  <a href="#" class="thumbnail">
												<img src="'.full_url.'/web/files/espacios/'.$imagen.'" alt="..." onclick="openImage('."'$imagen'".','."'$descripcion'".')" width="100">
											  </a>
											</div>
										</div>';	
					}
					

					$i++;
					endforeach;	
				
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

					"des_zona_ubicacion" => $espacio['des_zona_ubicacion'],
					"status" => $message_status,
                                        "date_created" => $espacio['date_created'],
                                        "date_updated" => $espacio['date_updated'],
					"actions" => 
                    '<form method="POST" action = "'.full_url.'/adm/reservacion/index.php" >'
                    .'<input type="hidden" name="action" value="new">  '
                    .'<input type="hidden" name="id_espacio" value="'.$id_espacio.'">  '
                    .'<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-check-circle  fa-pull-left"></i> Reservar</button>',
					"nom_tipo_espacio" => $espacio['nom_tipo_espacio'],
					"imagen1" => $array_imagenes['imagen1'], 
					"imagen2" => $array_imagenes['imagen2'], 
					"imagen3" => $array_imagenes['imagen3'], 
					"imagen4" => $array_imagenes['imagen4'] 
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
					"imagen1" => null,
					"imagen2" => null,
					"imagen3" => null,
					"imagen4" => null,
					"nom_tipo_espacio" => null,
					"des_zona_ubicacion" => null,
					"status" => "",
					"actions"=> ""
				);
		}

		echo json_encode($array_json);die;
		
	}