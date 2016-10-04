<?php


 
 
	function validate($values){
		$errors = array();
		$validator_values = array();
		
		$validator_values['password'] = array(
			
			"minlength" => 6,
			"maxlength" => 12,
			"type" => "text",
			"label" => "Password",
			"required" => false
		);
		$validator_values['phone'] = array(
			
			"minlength" => 10,
			"maxlength" => 15,
			"type" => "number",
			"label" => "Teléfono",
			"required" => true
		);
		$validator_values['phone1'] = array(
			
			"minlength" => 4,
			"maxlength" => 4,
			"type" => "number",
			"label" => "Extensión",
			"required" => false
		);
		$ValidateBase = new ValidateBase();
		$errors = $ValidateBase->validate_base($validator_values, $values);
		$Users = new Users();
		$existe_login = 0;
		if(isset($values['id_user']) and $values['id_user']!='')
		{
			$existe_login = $Users->getLoginExist($values['id_user'],$values['login']);
		}else
		{
			$existe_login = $Users->getLoginExist(null,$values['login']);
		}
		if($existe_login > 0)
		{
			$errors['login'] = "El login indicado ya existe";
		}

		$existe_document = 0;
		if(isset($values['id_user']) and $values['id_user']!='')
		{
			$existe_document = $Users->getDocumentExist($values['id_user'],$values['nationality'],$values['document']);
		}else
		{
			$existe_document = $Users->getDocumentExist(null,$values['nationality'],$values['document']);
		}
		if($existe_document > 0)
		{
			$errors['login'] = "La cédula indicada ya existe";
		}
		
		
		
		
		return $errors;
		
		
	}
	