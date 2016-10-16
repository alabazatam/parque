<?php


 
 
	function validate($values){
		$errors = array();
		$validator_values = array();
		
		/*$validator_values['nom_espacio'] = array(
			
			"minlength" => 3,
			"maxlength" => 100,
			"type" => "text",
			"label" => "Nombre",
			"required" => true
		);
		$validator_values['des_espacio'] = array(
			
			"minlength" => 3,
			"maxlength" => 100,
			"type" => "text",
			"label" => "Descripción",
			"required" => true
		);
		$validator_values['ut'] = array(
			
			"type" => "number",
			"label" => "Unidades tributarias",
			"required" => true
		);
		$validator_values['capacidad'] = array(
			
			"type" => "number",
			"label" => "Capacidad",
			"required" => true
		);	
		$validator_values['id_tipo_espacio'] = array(
			
			"type" => "number",
			"label" => "Tipo espacio",
			"required" => true
		);
		$validator_values['id_zona_ubicacion'] = array(
			
			"type" => "number",
			"label" => "Zona/Ubicación",
			"required" => true
		);	*/	
		$ValidateBase = new ValidateBase();
		$errors = $ValidateBase->validate_base($validator_values, $values);
		return $errors;
		
		
	}
	