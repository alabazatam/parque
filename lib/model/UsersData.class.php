<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of UsersDatas
	 *
	 * @author marcos
	 */
	class UsersData {
		
		public function __construct() 
		{
			
		}
		public function getUsersDataById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data
			->select("*")
			->where("users.id_user=?",$values['id_user'])
			->join("users","INNER JOIN users on users.id_user = users_data.id_user")
			->fetch();
			return $q; 				
			
		}
		function deleteUsersData($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data("id", $id)->delete();
			
			
		}		
		function saveUsersData($values){
			unset($values['PHPSESSID']);
			unset($values['action']);
            $values['date_created'] = new NotORM_Literal("NOW()");
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data()->insert($values);
			$values['id_user'] = $ConnectionORM->getConnect()->users_data()->insert_id();
			
			return $values;	
			
		}
		function updateUsersData($values){
			unset($values['PHPSESSID']);
			unset($values['action'],$values['date_created'],$values['login']);
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$id_users_data = $values['id_user'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data("id_user", $id_users_data)->update($values);
			return $q;
			
		}
		public function getMasterByIdCompany($id_company){
						
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data
			->select("*")
			->join("users","INNER JOIN users on users.id_user = users_data.id_users")
			->join("users_company","INNER JOIN users_company on users_company.id_user = users_data.id_users")
			->join("users_perms","INNER JOIN users_perms on users_perms.id_user = users_data.id_users")
			->where("users_company.id_company=?",$id_company)
			->and('users_perms.id_perms=?',3)
			->fetch();
			
			return $q;
			}
	}
	