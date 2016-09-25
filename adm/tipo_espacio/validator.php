<?php


 
 
	function validate($values){
		$errors = array();
		$validator_values = array();
		
		$validator_values['nom_tipo_espacio'] = array(
			
			"minlength" => 3,
			"maxlength" => 100,
			"type" => "text",
			"label" => "Nombre",
			"required" => true
		);	
		$ValidateBase = new ValidateBase();
		$errors = $ValidateBase->validate_base($validator_values, $values);
		return $errors;
		
		
	}
	