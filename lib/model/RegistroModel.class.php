<?php

 function validarRifRazonSocial($rif,$razonSocial)
 {
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->company_validation_ve
			->select("*")
			->where("rif=?",$rif)
			->and("razonSocial like ?","%$razonSocial%");
			return $q;
 }
 function createTokenRegis($datos)
 {
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users_token()->insert($datos);
	return $q;
 }
 function validarToken($token)
 {
	 $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->users_token
			->select("*")
			->where("Token=?",$token)
			->and("valid = 0")
			->and("timeExpire >=?",date("Y-m-d H:i:s"));
			
			return $q;
 }
 function utilizarToken($token)
 {
	$token = $token;
	$values = array("publicado" => 1,"valid"=>1);
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users_token('token', $token)->update($values);
	return $q;
 }
function GetCompanyValidation($idCompanyValidation)
 {
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')
			->company_validation_ve
			->select("*")
			->where("id=?",$idCompanyValidation);
	return $q;
 } 
 function RegisCompany($values)
 {
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->registered_company()->insert($values);
	return $q;
 }
 function RegisUserForCompany($values)
 {
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->user_for_company()->insert($values);
	return $q;
 }
  function RegisUser($values)
 {
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users()->insert($values);
	return $q;
 }
 function updateCompanyValidation($values)
 {
	$id = $values["id"];
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->company_validation_ve('id', $id)->update($values);
	return $q;
	
 }
function connect($login,$password)
{

		$login = strtoupper($login);
		$password = hash('sha256', $password);
		$valid = true;
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect('tugruero')->users
		->select("count(*) as cuenta")
		->where("login =?", $login)
		->and('password=?',$password)
		->and('status=?',1)
		->fetch();

		if($q['cuenta']==0){
			$valid = false;
		}

		return $valid;

}
function getUserList(){


	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('fedcom')->users
	->select("*");	
	return $q;

}
function getUserId($id_user){


	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('fedcom')->users
	->select("*")
	->where('id_user=?',$id_user)
	->fetch();	
	return $q;

}				
function deleteUser($id_user){


	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('fedcom')->users("id_user", $id_user)->delete();


}		
function addUser($values){


	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('fedcom')->users()->insert($values);

	return $q;

}
function updateUser($values){

	$id_user = $values['id_user'];
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('fedcom')->users("id_user", $id_user)->update($values);

	return $q;

}		


