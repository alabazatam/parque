<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Users
	 *
	 * @author marcos
	 */
	class Users {
		
		public function __construct() 
		{
			
		}
		public function getUsersList($values)
		{	
			$columns = array();
			$columns[0] = 'id_user';
			$columns[1] = 'login';
			$columns[2] = 'password';
			$columns[3] = 'status';
                        $columns[4] = 'date_created';
                        $columns[5] = 'date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(login) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') ";
			}
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("*, DATE_FORMAT(users.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(users.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = users.status")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountUsersList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(login) like upper('%$str%') "
					. "or upper(status.name) like upper('%$str%') ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = users.status")
			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getUserById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_user=?",$values['id_user'])->fetch();
			return $q; 				
			
		}
		function deleteUser($id_user){
			unset($values['action'],$values['PHPSESSID']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users("id_user", $id_user)->delete();
			
			
		}		
		function saveUser($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_user']);
			$values['password'] = hash('sha256', $values['password']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users()->insert($values);
			$values['id_user'] = $ConnectionORM->getConnect()->users()->insert_id();
			return $values;	
			
		}
		function updateUser($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			if(isset($values['password']) and $values['password']!='')
			{
				$values['password'] = hash('sha256', $values['password']);
			}else
			{
				unset($values['password']);
			}
			$id_user = $values['id_user'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users("id_user", $id_user)->update($values);
			return $q;
			
		}
		function activeUserMasterCompany($id_company){		
			$ConnectionORM = new ConnectionORM();
			$status = 1;
			$date_updated = new NotORM_Literal("NOW()");
			//obtengo el usuario master
			$q = $ConnectionORM->getConnect()->users_company
			->select("id_user")->where("id_company=?",$id_company)->fetch();			
			$id_user =  $q['id_user'];
			
			//obtengo datos de la compañia
			$q = $ConnectionORM->getConnect()->company
			->select("*")->where("id=?",$id_company)->fetch();			
			$rif =  $q['rif'];			

			//actualizo el status del usuario master a 1 activo
			$q = $ConnectionORM->getConnect()->users("id_user", $id_user)->update(array('status'=>$status,'date_updated'=>$date_updated));

			//actualizo el status de la permisologia master a 1 activo
			$q = $ConnectionORM->getConnect()->users_perms("id_user", $id_user)->update(array('status'=>$status,'date_updated'=>$date_updated));
			
			//actualizo el users_company  a 1 activo
			$q = $ConnectionORM->getConnect()->users_company->where("id_user=?", $id_user)->and("id_company=?", $id_company)->update(array('status'=>$status,'date_updated'=>$date_updated));
			
			//actualizo el status de la compañia a 1 activo
			$q = $ConnectionORM->getConnect()->company->where("id", $id_company)->update(array('status'=>$status,'date_updated'=>$date_updated));			
			
			//actualizo el status de la company_validation_ve a 1 activo
			$q = $ConnectionORM->getConnect()->company_validation_ve->where("rif", $rif)->update(array('status'=>$status,'validate'=>$status));			

                        //actualizo el status de los arcivos a 1 activo
			$q = $ConnectionORM->getConnect()->company_files->where("id_company", $id_company)->update(array('status'=>$status,'date_updated'=>$date_updated,'validate'=>$status));			
			
		}
		function inactiveUserMasterCompany($id_company){		
			$ConnectionORM = new ConnectionORM();
			$status = 0;
			$date_updated = new NotORM_Literal("NOW()");
			//obtengo el usuario master
			$q = $ConnectionORM->getConnect()->users_company
			->select("id_user")->where("id_company=?",$id_company)->fetch();			
			$id_user =  $q['id_user'];
			
			//obtengo datos de la compañia
			$q = $ConnectionORM->getConnect()->company
			->select("*")->where("id=?",$id_company)->fetch();			
			$rif =  $q['rif'];			

			//actualizo el status del usuario master a 1 activo
			$q = $ConnectionORM->getConnect()->users("id_user", $id_user)->update(array('status'=>$status,'date_updated'=>$date_updated));

			//actualizo el status de la permisologia master a 1 activo
			$q = $ConnectionORM->getConnect()->users_perms("id_user", $id_user)->update(array('status'=>$status,'date_updated'=>$date_updated));
			
			//actualizo el users_company  a 1 activo
			$q = $ConnectionORM->getConnect()->users_company->where("id_user=?", $id_user)->and("id_company=?", $id_company)->update(array('status'=>$status,'date_updated'=>$date_updated));
			
			//actualizo el status de la compañia a 1 activo
			$q = $ConnectionORM->getConnect()->company->where("id", $id_company)->update(array('status'=>$status,'date_updated'=>$date_updated));			
			

		}		
		public function getUsersOperatorList($values)
		{	
			$columns = array();
			$columns[0] = 'id_user';
			$columns[1] = 'login';
			$columns[2] = 'password';
			$columns[3] = 'status';
                        $columns[4] = 'date_created';
                        $columns[5] = 'date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(login) like upper('%$str%')";
			}
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("users.*, DATE_FORMAT(users.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(users.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("users_company","INNER JOIN users_company on users_company.id_user = users.id_user")
			->join("users_perms","INNER JOIN users_perms on users_perms.id_user = users.id_user")
			->order("$column_order $order")
			->where("$where")
			->and("users_company.id_company =?",$values["company"])
			->and("users_perms.id_perms =?",4)
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountUsersOperatorList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(login) like upper('%$str%') ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("count(*) as cuenta")
			->join("users_company","INNER JOIN users_company on users_company.id_user = users.id_user")
			->join("users_perms","INNER JOIN users_perms on users_perms.id_user = users.id_user")
			->where("$where")
			->and("users_company.id_company =?",$values["company"])
			->and("users_perms.id_perms =?",4)
			->fetch();
			return $q['cuenta']; 			
		}
		function saveUserOperator($values){
			
			$user = array("login" => $values["login"],
						  "password" => hash('sha256', $values['password']),
						  "status" => $values["status"],
						  "mail"=>$values["mail"]);
			$user["date_created"] = date("Y-m-d H:i:s");
			$user["date_updated"] = date("Y-m-d H:i:s");
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users()->insert($user);
			$values['id_user'] = $ConnectionORM->getConnect()->users()->insert_id();
			
			$userData = array("first_name"=>$values["first_name"],
							  "second_name"=>$values["second_name"],
							  "first_last_name"=>$values["first_last_name"],
							  "second_last_name"=>$values["second_last_name"],
							  "gender"=>$values["gender"],
							  "nationality"=>$values["nationality"],
							  "document"=>$values["document"],
							  "phone"=>$values["phone"],
							  "id_users" => $values['id_user']);
			$userData['date_created'] = date("Y-m-d H:i:s");
			$userData['date_updated'] = date("Y-m-d H:i:s");
			
			$userPerms = array("id_user" => $values['id_user'],
							   "id_perms" => 4);
			$userCompany = array("id_company" => $_SESSION["id_company"],
								 "id_user" => $values['id_user']);
			$q = $ConnectionORM->getConnect()->users_data()->insert($userData);
			$q = $ConnectionORM->getConnect()->users_perms()->insert($userPerms);
			$q = $ConnectionORM->getConnect()->users_company()->insert($userCompany);
			
			return $values;	
			
		}
		public function getUserOperatorById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("*, DATE_FORMAT(users.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(users.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("users_data","INNER JOIN users_data on users_data.id_users = users.id_user")		
			->where("users.id_user=?",$values['id_user'])->fetch();
			return $q; 				
			
		}
		function updateUserOperator($values){
			unset($values['action'],$values['date_created']);
            $user = array("login" => $values["login"],
						  "status" => $values["status"],
						  "mail"=>$values["mail"]);
			$user["date_created"] = date("Y-m-d H:i:s");
			$user["date_updated"] = date("Y-m-d H:i:s");
			if(isset($values['password']) and $values['password']!='')
			{
				$user['password'] = hash('sha256', $values['password']);
			}else
			{
				unset($values['password']);
			}
			$id_user = $values['id_user'];
			$ConnectionORM = new ConnectionORM();
			
			
			$userData = array("first_name"=>$values["first_name"],
							  "second_name"=>$values["second_name"],
							  "first_last_name"=>$values["first_last_name"],
							  "second_last_name"=>$values["second_last_name"],
							  "gender"=>$values["gender"],
							  "nationality"=>$values["nationality"],
							  "document"=>$values["document"],
							  "phone"=>$values["phone"],
							  "id_users" => $values['id_user']);
			$userData['date_updated'] = date("Y-m-d H:i:s");
			
			
			$q = $ConnectionORM->getConnect()->users_data("id_users", $id_user)->update($userData);
			return $q;
			
		}
		function comparePasswordByUser($values){
			$valid = false;
			$id_user = $values['id_user'];
			$password = hash("sha256", $values['password']);
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("count(*) as cuenta")
			->where("id_user=?",$id_user)
			->and("password=?",$password)
			->fetch();
			$cuenta = $q['cuenta'];
			if($cuenta > 0)
			{
				$valid = true;
			}
			return $valid;
		}		
		function changePassword($values){
			$id_user = $values['id_user'];
			$values['password'] = hash('sha256',$values['new_password']) ;
			unset($values['new_password'],$values['retype_password'],$values['id_user'],$values['action']);
			$values["date_updated"] = date("Y-m-d H:i:s");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users("id_user", $id_user)->update($values);
			return $q;
			
		}
		function getUserByPassword($values){
			
			unset($values['action']);
			$login = $values['login'];
			$password = hash("sha256", $values['password']);
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("*")
			->where("login=?",$login)
			->and("password=?",$password)
			->and('status=?',1)
			->fetch();
			return $q;
		}
	}

