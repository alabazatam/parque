<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of ClientsAddressDetail
	 *
	 * @author marcos
	 */
	class ClientsAddressDetail{
		
		public function __construct() 
		{
			
		}
		public function getClientsListAddressDetailByClient($id_client){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_client=?",$id_client);
			return $q; 				
			
		}		
		
		public function getClientsAddressDetailById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_client=?",$values['id_client'])->fetch();
			return $q; 				
			
		}
		function deleteClientsAddressDetail($id){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail("id", $id)->delete();
			
			
		}		
		function saveClientsAddressDetail($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->ClientsAddressDetail()->insert_id();
			return $values['id'];	
			
		}
		function updateClientsAddressDetail($values){
			unset($values['action'],$values['PHPSESSID'],$values['column_id']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$column_name = $values['column_name'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail("id", $id)->update(array($column_name=>$values['value']));
			return $q;
			
		}
		public function getListClientsAddressDetail($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
		public function getListAddressByClient($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail
			->select("*,country.name as country_name")
			->join('country',"LEFT JOIN country ON country.id_country = clients_address_detail.id_country")
			->where("clients_address_detail.status=?",1)
			->and('id_client=?',$values['id_client'])
			->order('id');			
			
			return $q; 				
			
		}
		public function getListClientsAddressBySale($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales
			->select("*,sales.id_client_address")
			->where('id_sale=?',$values['id_sale'])
			->fetch();
			return $q; 				
			
		}
		public function getListClientsAddressBySale2($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales
			->select("*,sales.id_client_address2")
			->where('id_sale=?',$values['id_sale'])
			->fetch();
			return $q; 				
			
		}
		public function getAddressBySale($id_client_address2){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients_address_detail
			->select("*,country.name as country_name")
			->join('country',"LEFT JOIN country ON country.id_country = clients_address_detail.id_country")
			->where("clients_address_detail.id=?",$id_client_address2)
			->fetch();	
			return $q; 				
			
		}
	}
	