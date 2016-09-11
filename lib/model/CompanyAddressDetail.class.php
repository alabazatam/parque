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
	class CompanyAddressDetail{
		
		public function __construct() 
		{
			
		}
		public function getCompanyListAddressDetailByCompany($id_company){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_address_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_company=?",$id_company);
			return $q; 				
			
		}		
		
		public function getCompanyAddressDetailById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_address_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_client=?",$values['id_client'])->fetch();
			return $q; 				
			
		}
		function deleteCompanyAddressDetail($id){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_address_detail("id", $id)->delete();
			
			
		}		
		function saveCompanyAddressDetail($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_address_detail()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->company_address_detail()->insert_id();
			return $values['id'];	
			
		}
		function updateCompanyAddressDetail($values){
			unset($values['action'],$values['PHPSESSID'],$values['column_id']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$column_name = $values['column_name'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_address_detail("id", $id)->update(array($column_name=>$values['value']));
			return $q;
			
		}
		public function getListClientsAddressDetail($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_address_detail
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
		public function getListAddressByCompany($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_address_detail
			->select("*,country.name as country_name")
			->join('country',"LEFT JOIN country ON country.id_country = company_address_detail.id_country")
			->where("company_address_detail.status=?",1)
			->and('id_company=?',$values['id_company'])
			->order('id');			
			
			return $q; 				
			
		}

		public function getListCompanyAddressBySale($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales
			->select("*,sales.id_company_address")
			->where('id_sale=?',$values['id_sale'])
			->fetch();
			return $q; 				
			
		}
		public function getListCompanyAddressBySale2($values = null){
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
	