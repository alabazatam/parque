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
		);		*/
		$ValidateBase = new ValidateBase();
		$errors = $ValidateBase->validate_base($validator_values, $values);
		
                if($values['id_status'] == 3)
                {
                    if(!isset($_FILES["recibo"]['tmp_name']) or $_FILES["recibo"]['tmp_name']=="")
                    {

                       $errors['recibo'] = 'Debe seleccionar el comprobante de pago' ;

                    }  
                }
                //carga de lista de invitados
                if($values['id_status'] == 5)
                {
                    if(!isset($values['cedula']))
                    {

                        $errors['lista'] = 'Debe cargar al menos un invitado';
                            
                    }else
                    {
                        foreach($values['cedula'] as $id=> $value ):

                            if($value == '')
                            {
                               $errors['cedula'] = 'El campo cédula en la lista de invitados no puede estar vacía';
                            }
                            if($values['nombre1'][$id] == '')
                            {
                               $errors['nombre1'] = 'El campo primer nombre en la lista de invitados no puede estar vacío';
                            }
                            if($values['apellido1'][$id] == '')
                            {
                               $errors['apellido1'] = 'El campo primer apellido en la lista de invitados no puede estar vacío';
                            }
                            if($values['id_parentesco'][$id] == '')
                            {
                               $errors['apellido1'] = 'El campo parentesco en la lista de invitados no puede estar vacío';
                            }

                        endforeach;   
                    }

                }
                return $errors;
		
		
	}
	